
import time
import requests
import RPi.GPIO as GPIO
from time import sleep

from Crypto.Hash import SHA256
from time import time as millsec

# Welke pin van de Raspberry gebruikt wordt
knop1_pin = 40
knop2_pin = 16
knop3_pin = 12
led1groen_pin = 38
led1rood_pin = 37
led2groen_pin = 22
led2rood_pin = 18
led3groen_pin = 35
led3rood_pin = 33

# Setup
GPIO.setmode(GPIO.BOARD)
GPIO.setup(knop1_pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.setup(knop2_pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.setup(knop3_pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.setup(led1groen_pin, GPIO.OUT)
GPIO.setup(led1rood_pin, GPIO.OUT)
GPIO.setup(led2groen_pin, GPIO.OUT)
GPIO.setup(led2rood_pin, GPIO.OUT)
GPIO.setup(led3groen_pin, GPIO.OUT)
GPIO.setup(led3rood_pin, GPIO.OUT)
Button_state1=False
Button_state2=False
Button_state3=False
payload = None
old_payload = None
server_ip = "127.0.0.1"

SECRET = "6423834HeuEHUADd679ii7e67990YEu"

def encrypt():
    nowtime = int(millsec())
    toHash = (str(nowtime) + SECRET).encode('utf-8')
    return nowtime, SHA256.new(toHash)

#loop voor licht besturing
while(1):
    if GPIO.input(knop1_pin)== 0:
        if Button_state1==0:
            print("parkeerplek 1 op verdieping 2 is bezet")
            #payload= {"id": "Parkeerplaats 1", "verdieping": "Verdieping 2", "status": "Bezet"}
            GPIO.output(led1rood_pin, True)
            GPIO.output(led1groen_pin, False)
            Button_state1=True
            sleep(.5)
        else:
            print("parkeerplek 1 op verdieping 2 is vrij")
            GPIO.output(led1groen_pin, True)
            GPIO.output(led1rood_pin, False)
            #payload= {"id": "Parkeerplaats 1", "verdieping": "Verdieping 2", "status": "Vrij"}
            Button_state1=False
            sleep(.5)
    if GPIO.input(knop2_pin) == 0:
        if Button_state2 == 0:
            print("parkeerplek 2 op verdieping 2 is bezet")
            #payload = {"id": "Parkeerplaats 2", "verdieping": "Verdieping 2", "status": "Bezet"}
            GPIO.output(led2groen_pin, False)
            GPIO.output(led2rood_pin, True)
            Button_state2 = True
            sleep(.5)
        else:
            print("parkeerplek 2 op verdieping 2 is vrij")
            GPIO.output(led2groen_pin, True)
            GPIO.output(led2rood_pin, False)
            #payload = {"id": "Parkeerplaats 2", "verdieping": "Verdieping 2", "status": "vrij"}
            Button_state2 = False
            sleep(.5)
    if GPIO.input(knop3_pin) == 0:
        if Button_state3 == 0:
            print("parkeerplek 3 op verdieping 2 is bezet")
            #payload = {"id": "Parkeerplaats 3", "verdieping": "Verdieping 2", "status": "Bezet"}
            GPIO.output(led3groen_pin, False)
            GPIO.output(led3rood_pin, True)
            Button_state3 = True
            sleep(.5)
        else:
            print("parkeerplek 3 op verdieping 2 is vrij")
            GPIO.output(led3groen_pin, True)
            GPIO.output(led3rood_pin, False)
            #payload = {"id": "Parkeerplaats 3", "verdieping": "Verdieping 2", "status": "vrij"}
            Button_state3 = False
            sleep(.5)
    if old_payload != payload or payload != None:
        nowtime, hash_text = encrypt()
        payload.update({'verify_time' : nowtime, 'hash' : hash_text})
        requests.post(server_ip + "/managers/spotManager.php", paramas=payload)
        old_payload = payload