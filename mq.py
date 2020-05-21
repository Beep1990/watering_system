#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import mysql.connector
import time
import paho.mqtt.client as mqtt
import RPi.GPIO as gpio

def gpioSetup():
	
	gpio.setmode(gpio.BCM)
	gpio.setup(4, gpio.OUT)

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

def connectionStatus(client, userdata, flags, rc):
	mqttClient.subscribe("rpi/gpio")

def messageDecoder(client, userdata, msg):
	message = msg.payload.decode(encoding='UTF-8')
	
	if message == "on":
		gpio.output(4, gpio.HIGH)
		db_add ()
		print("Podlewanie włączone!")
	elif message == "off":
		gpio.output(4, gpio.LOW)
		print("Podlewanie wyłączone!")
	else:
		print("Nieznane polecenie!")

gpioSetup()

clientName = "RPI"
serverAddress = "192.168.0.106"

mqttClient = mqtt.Client(clientName)

mqttClient.on_connect = connectionStatus
mqttClient.on_message = messageDecoder

mqttClient.connect(serverAddress)
mqttClient.loop_forever()
