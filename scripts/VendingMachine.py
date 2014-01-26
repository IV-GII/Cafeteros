# -*- coding: utf-8 -*-

import re
import json
import datetime


class VendingMachine:

    """
    Clase que representa la máquina de cafe
    que estamos gestionando. Dicha clase
    contiene informacion sobre:
    - Nombre del Fabricante
    - Modelo
    - Revision del fireware de la máquina
    - Codigo de la máquina
    - Número de Impresion
    - Contador de todos los cafes del inicio
    - Los diferentes cafes con la informacion de la venta
    que corresponde al cafe que se ha vendido
    - La maquina emite 8 precios diferentes.
    - Averias de la maquina
    """

    def __init__(self, filename):
        """
        Constructor de la clase. Dicha clase inicializa
        todo relacionado con el fichero. Se estructura
        de manera organizada, para poder ser grabada
        en las bases de datos


        filename
          El nombre del fichero a parsear. Dicho fichero
          es el fichero de estadisticas que manda la máquina
          al rasperry pi
        """
        self.pagoList = []
        self.gratisList = []
        self.testList = []
        self.errorsList = []
        self.priceList = []
        self.vasoMantenido = ""
        self.vasoUsado = ""
        self.codigoMachina = ""
        self.numeroDeImpresion = ""
        self.contador = ""
        self.identifiers = {
            "Nombre de Fabricante": None,
            "Modelo": None,
            "Revision del Firmware": None,
            "Codigo de la Maquina": None,
            "Numero de Impresion": None,
            "Contador de todos los cafes del inicio del tiempo": None,
            "Tecla": [],
            "Vaso f.n.": None,
            "Vaso mant.": None,
            "Precio": [],
            "Errores": []
        }
        self.identifiers = self.parseFile(filename)

    def parseFile(self, fileName):
        """
        Metodo creado para parsear el fichero de estadisticas
        de la máquina de cafe. Se guarda todo en una estructura
        que se va a guardar en la base de datos, para poder ser
        visto en la página
        """
        bigLine = "======================="
        smallLine = "-----------------------"
        onlyNewLine = " \n"
        f = open(fileName)
        lines = [line for line in f]
        for i in range(len(lines)):
            cleanLine = lines[i].strip()
            if bigLine not in lines[i] and smallLine not in lines[i] and lines[i] != onlyNewLine:
                    numeroDeImpresionRegex = re.search(
                        "Impresion N\.\s+=\s+(\d+)$", cleanLine)
                    contadorRegex = re.search(
                        "Contador\s+=\s+(\d+)$", cleanLine)
                    codigoRegex = re.search(
                        "Codigo D\. A\.\s+= (\d+)$", cleanLine)
                    pagoRegex = re.search("Pag\.=\s+(\d+)$", cleanLine)
                    gratisRegex = re.search("Gra\.=\s+(\d+)$", cleanLine)
                    testRegex = re.search("Test=\s+(\d+)$", cleanLine)
                    priceRegex = re.search("Prc\. \d+ =\s+(\d+)$", cleanLine)
                    errorRegex = re.search("Er\..+=\s+(\d+)$", cleanLine)
                    cupUsedRegex = re.search("Vaso f.n. =\s+(\d+)$", cleanLine)
                    cupMaintainedRegex = re.search(
                        "Vaso mant.=\s+(\d+)$", cleanLine)
                    if numeroDeImpresionRegex:
                        self.identifiers[
                            "Numero de Impresion"] = numeroDeImpresionRegex.group(1)
                    if codigoRegex:
                        self.identifiers[
                            u"Codigo de la Maquina"] = codigoRegex.group(1)
                    if contadorRegex:
                        self.identifiers[
                            "Contador de todos los cafes del inicio del tiempo"] = contadorRegex.group(1)
                    if pagoRegex:
                        self.pagoList.append(pagoRegex.group(1))
                    if gratisRegex:
                        self.gratisList.append(gratisRegex.group(1))
                    if testRegex:
                        self.testList.append(testRegex.group(1))
                    if priceRegex:
                        self.priceList.append(priceRegex.group(1))
                    if errorRegex:
                        self.errorsList.append(errorRegex.group(1))
                    if cupUsedRegex:
                        self.identifiers["Vaso f.n."] = cupUsedRegex.group(1)
                    if cupMaintainedRegex:
                        self.identifiers[
                            "Vaso mant."] = cupMaintainedRegex.group(1)
            if i == 2:
                self.identifiers["Nombre de Fabricante"] = cleanLine
            if i == 3:
                self.identifiers["Modelo"] = cleanLine
            if i == 4:
                self.identifiers["Revision del Firmware"] = cleanLine
        for i in range(len(self.pagoList)):
            self.identifiers["Tecla"].append(
                {i+1: (self.pagoList[i], self.gratisList[i], self.testList[i])})
        for i in range(len(self.priceList)):
            self.identifiers["Precio"].append({i+1: self.priceList[i]})
        for i in range(len(self.errorsList)):
            self.identifiers["Errores"].append({i+1: self.errorsList[i]})
        return self.identifiers

    def saveToFile(self):
        date = datetime.datetime.now()
        with open(str(date.year) + str(date.month) + str(date.day) + "-" + str(
                  date.time().hour) + str(date.time().minute) + str(date.time().second) + ".json", "w") as fo:
            json.dump(self.identifiers, fo)
        timesFile = open("times.txt", "a")
        timesFile.write(str(date.year) + str(date.month) + str(date.day) + "-" + str(
                        date.time().hour) + str(date.time().minute) + str(date.time().second)+"\n")
        fo.close()
        timesFile.close()
