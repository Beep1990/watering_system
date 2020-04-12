#!/usr/bin/env python
import sys
import mysql.connector
import time
import RPi.GPIO  as GPIO

channel = 4

GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

def db_add():

    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="M@rco12345",
    database="watering_system"

    )
    cursor = mydb.cursor()
    sql = "INSERT INTO wh (wdate, duration) VALUES (NOW(), 'Uruchomienie manualne')"
    cursor.execute(sql)
    mydb.commit()

if True:
    db_add ()
    

def podlewanie (pin):
	GPIO.output(pin, GPIO.HIGH)

if __name__ == '__main__':
	try:
		podlewanie(channel)
	except KeyboardInterrupt:
		GPIO.cleanup()
