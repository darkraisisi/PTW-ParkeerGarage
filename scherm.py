from tkinter import *
import requests
import socket
import hashlib
from time import time as millsec

root = Tk()
root.title("Parkeergarage")
root.resizable(False, False)

ip = "http://145.89.160.167"
naam = "/ptw/server/"
url = ip + naam
headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
SECRET = "6423834HeuEHUADd679ii7e67990YEu"
jsontemp = "{'id': '2', 'garage': '1', 'level': '1', 'number': '2', 'occupation': '0', 'reserve_untill': '27-01-20 13:55:16'}"


def genHash():
    nowtime = int(millsec())
    m = hashlib.sha256()
    m.update((str(nowtime) + SECRET).encode('utf-8'))
    return nowtime, m.hexdigest()


def mainloop():
    change_vrijeplekken(request_vrijeplekken(1))
    root.after(1000,mainloop)


def getIP():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("8.8.8.8", 80))
    return s.getsockname()[0]


def show_secondframe():
    defaultFrame.pack_forget()
    secondFrame.pack(fill='both', expand=True)
    setClosestSpaceLabel()


def show_defaultframe():
    secondFrame.pack_forget()
    defaultFrame.pack(fill="both", expand=True)


def change_vrijeplekken(aantalVrijePlekken):
    aantalPlekken.config(state='normal')
    aantalPlekken.delete(0, END)
    aantalPlekken.insert(0, aantalVrijePlekken)
    aantalPlekken.config(state='readonly')


def request_vrijeplekken(id):
    time, hash = genHash()
    r = requests.post(url=url+"spot/get_amount_free_from_garage",data={"garage_id":id,"hash":hash,"verify_time":time})
    plekken = r.text
    if int(plekken) == 0:
        nieuweAuto.config(state="disabled")
    else:
        nieuweAuto.config(state="normal")
    return r.text


def request_closestfreespace(id):
    time, hash = genHash()
    r = requests.post(url = url+"spot/get_recommended_spot_from_garage", data = {"garage_id":id,"hash":hash,"verify_time":time})
    print(r.json())

    for i in r.json():
        if i == "level":
            verdieping = r.json()[i]
        elif i == "number":
            plaats = r.json()[i]

    return verdieping, plaats


def setClosestSpaceLabel():
    verdieping, plaats = request_closestfreespace(1)
    plek.config(text=("Verdieping "+ str(verdieping) + ", plek " + str(plaats)))


"Frame instellingen"
defaultFrame = Frame(master=root, height='300', width='500', bg="white")
defaultFrame.pack_propagate(False)
defaultFrame.pack(fill="both", expand=True)

secondFrame = Frame(master=root, height='300', width='500', bg="white")
secondFrame.pack_propagate(False)

"Vormgeving defaultframe"
headerText = Label(master=defaultFrame, text='Welkom', bg='white smoke', fg='black', font=('Helvetica', 16))
headerText.pack(fill='x')

defaultGrid = Frame(master=defaultFrame, bg="white")
defaultGrid.pack()

defaultLabel = Label(master=defaultGrid, text="Aantal vrije plekken:", bg='white', width='20', height='3', font=('Helvetica', 18))
defaultLabel.grid(row=0, column=0, padx=0, pady=0)

defaultSpace = Label(master=defaultGrid, bg='white', width='20', height='1')
defaultSpace.grid(row=1, column=0, padx=0, pady=0)

nieuweAuto = Button(defaultFrame, text="Nieuwe auto",command=show_secondframe, width=20)
nieuweAuto.pack()

aantalPlekken = Entry(master=defaultGrid, text='', justify='center', font=('Helvetica', 16), bg='white', fg='black', width='6')
aantalPlekken.grid(row=2, column=0, padx=0, pady=20)
aantalPlekken.insert(0,"")
aantalPlekken.config(state='readonly')


"Vormgeving secondframe"
headerText2 = Label(master=secondFrame, text='Dit is de dichtstbijzijnde plek:', bg='white smoke', fg='black', font=('Helvetica', 16))
headerText2.pack(fill='x')

secondGrid = Frame(master=secondFrame, bg="white")
secondGrid.pack()

secondSpace = Label(master=secondGrid, bg='white', width='20', height='2')
secondSpace.grid(row=0, column=0, padx=0, pady=0)

plek = Label(master=secondGrid, bg='white', width='20', height='5', font=('Helvetica', 18))
plek.grid(row=1, column=0, padx=0, pady=0)


b = Button(secondFrame, text="Terug",command=show_defaultframe, width=20)
b.pack()


"Overig"
change_vrijeplekken(request_vrijeplekken(1))
print(getIP())

root.eval('tk::PlaceWindow . center')


root.after(1000,mainloop)
root.mainloop()


