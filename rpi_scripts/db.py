#!/usr/bin/python
import sys
import Adafruit_DHT
import mysql.connector
import time
from RPi import GPIO


def db_add(temp, hum):

    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="M@rco12345",
    database="watering_system"

    )
    mycursor = mydb.cursor()
    sql = "INSERT INTO `sensor`(`data`, `temp`, `hum`) VALUES (now(), %s, %s)"
    val = (temp, hum)
    mycursor.execute(sql, val)
    mydb.commit()


while True:
    hum, temp = Adafruit_DHT.read_retry(11, 17)
    db_add (temp, hum)
    time.sleep(1800)

