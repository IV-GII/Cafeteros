#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys
from VendingMachine import *


if __name__ == '__main__':
    try:
        coffeeMachine = VendingMachine(sys.argv[1])
        coffeeMachine.saveToFile()
    except IndexError:
        print("Se requiere un argumento de linea de comando")
