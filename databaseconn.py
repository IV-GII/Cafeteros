#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Descripción: Insertar los datos en la base de datos

import MySQLdb
import json
from databaseinfo import *

# read json file
ficheroTiempo = "times.txt"


def insertMachineInfo(id_maquina, model, firmware, fabricante, n_cafes, vasos_totales, vasos_mantenido, n_impresion):
    db.execute(
        """INSERT INTO maquinas VALUES (%s, %s, %s, %s, %s, %s, %s, %s)""", (id_maquina, model, firmware, fabricante, n_cafes, vasos_totales, vasos_mantenido, n_impresion))


def insertProduct(id_maquina, boton, pago, gratis, test):
    db.execute(
        """INSERT INTO Producto VALUES (%s, %s, %s, %s, %s)""", (id_maquina, boton, pago, gratis, test))


def insertPrice(id_maquina, precio1, precio2, precio3, precio4, precio5, precio6, precio7, precio8):
    db.execute(
        """
        INSERT INTO precio VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s)
        """,
        (id_maquina, precio1, precio2, precio3,
         precio4, precio5, precio6, precio7, precio8)
    )


def insertError(id_maquina, er1, er2, er3, er4, er5, er6, er7, er8, er9, er10, er11, er12, er13, er14, er15):
    db.execute(
        """
        INSERT INTO errores VALUES (%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s)
        """,
        (id_maquina, er1, er2, er3, er4, er5, er6, er7, er8, er9, er10, er11, er12, er13, er14, er15))


# Conexión con base de datos
connect = MySQLdb.connect(
    host=OPENSHIFT_MYSQL_DB_HOST, user=OPENSHIFT_MYSQL_DB_USERNAME, passwd=OPENSHIFT_MYSQL_DB_PASSWORD, port=OPENSHIFT_MYSQL_DB_PORT,
    db="cafeteros")
db = connect.cursor()
data = []

fo = open(ficheroTiempo)
for i in fo:
    fjson = open(i.strip() + ".json")
    data.append(json.load(fjson))
fo.close()


# Tabla de Precio
for jsonInfo in data:
    pr1 = jsonInfo["Precio"][0][str(1)]
    pr2 = jsonInfo["Precio"][1][str(2)]
    pr3 = jsonInfo["Precio"][2][str(3)]
    pr4 = jsonInfo["Precio"][3][str(4)]
    pr5 = jsonInfo["Precio"][4][str(5)]
    pr6 = jsonInfo["Precio"][5][str(6)]
    pr7 = jsonInfo["Precio"][6][str(7)]
    pr8 = jsonInfo["Precio"][7][str(8)]
    insertPrice(jsonInfo["Codigo de la Maquina"],
                pr1, pr2, pr3, pr4, pr5, pr6, pr7, pr8)

# Tabla de errores
for jsonInfo in data:
    er1 = jsonInfo["Errores"][0][str(1)]
    er2 = jsonInfo["Errores"][1][str(2)]
    er3 = jsonInfo["Errores"][2][str(3)]
    er4 = jsonInfo["Errores"][3][str(4)]
    er5 = jsonInfo["Errores"][4][str(5)]
    er6 = jsonInfo["Errores"][5][str(6)]
    er7 = jsonInfo["Errores"][6][str(7)]
    er8 = jsonInfo["Errores"][7][str(8)]
    er9 = jsonInfo["Errores"][8][str(9)]
    er10 = jsonInfo["Errores"][9][str(10)]
    er11 = jsonInfo["Errores"][10][str(11)]
    er12 = jsonInfo["Errores"][11][str(12)]
    er13 = jsonInfo["Errores"][12][str(13)]
    er14 = jsonInfo["Errores"][13][str(14)]
    er15 = jsonInfo["Errores"][14][str(15)]
    insertError(jsonInfo["Codigo de la Maquina"], er1, er2, er3, er4,
                er5, er6, er7, er8, er9, er10, er11, er12, er13, er14, er15)


# Tabla de Tecla
for jsonInfo in data:
    for tecla, number in zip(jsonInfo["Tecla"], range(1, len(jsonInfo["Tecla"])+1)):
        pago = int(tecla[str(number)][0])
        gratis = int(tecla[str(number)][1])
        test = int(tecla[str(number)][2])
        insertProduct(
            jsonInfo["Codigo de la Maquina"], number, pago, gratis, test)

# Tabla de maquinas
for jsonInfo in data:
    insertMachineInfo(
        jsonInfo["Codigo de la Maquina"],
        jsonInfo["Modelo"],
        jsonInfo["Revision del Firmware"],
        jsonInfo["Nombre de Fabricante"],
        len(jsonInfo["Tecla"]),
        jsonInfo["Vaso f.n."],
        jsonInfo["Vaso mant."],
        jsonInfo["Numero de Impresion"]
    )
