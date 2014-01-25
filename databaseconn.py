#!/usr/bin/env python
# -*- coding: utf-8 -*-

import MySQLdb
import json


# read json file
ficheroTiempo = "times.txt"


def insertProduct(id_maquina, boton, pago, gratis, test):
    db.execute(
        """INSERT INTO Producto VALUES (%s, %s, %s, %s, %s)""", (id_maquina, boton, pago, gratis, test))

connect = MySQLdb.connect(
    host='127.0.0.1', user='adminkVRFJrB', passwd="gDLVUniSBVss", port=3307,
    db="cafeteros")
db = connect.cursor()
data = []

fo = open(ficheroTiempo)
for i in fo:
    fjson = open(i.strip() + ".json")
    data.append(json.load(fjson))
fo.close()

print(data)

# for i, j in zip(data["Tecla"], range(1, len(data["Tecla"]))):
#     insertProduct(data["Codigo de la Maquina"], j, int(data["Tecla"][j][
#                   str(j)][0]), int(data["Tecla"][j][str(j)][1]),
                  # int(data["Tecla"][j][str(j)][2]))
