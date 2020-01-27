import time
from Cryptodome.Hash import SHA256
from time import time as millsec

SECRET = "6423834HeuEHUADd679ii7e67990YEu"

def encrypt():
    nowtime = int(millsec())
    toHash = (str(nowtime) + SECRET).encode('utf-8')
    return nowtime, SHA256.new(toHash)

nowtime, test = encrypt()
print(nowtime)
print(test.hexdigest())