import RPi.GPIO  as GPIO
import time

channel = 4

GPIO.setmode(GPIO.BCM)
GPIO.setup(channel, GPIO.OUT)

def podlewanie (pin):
	GPIO.output(pin, GPIO.HIGH)


def koniec (pin):
	GPIO.output(pin, GPIO.LOW)


if __name__ == '__main__':
	try:
		koniec(channel)
		time.sleep(2)
		GPIO.cleanup()
	except KeyboardInterrupt:
		GPIO.cleanup()
