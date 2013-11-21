#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import MySQLdb

from fuzzywuzzy import fuzz
from fuzzywuzzy import process


# Connexion database
db = MySQLdb.connect(host="localhost", # your host, usually localhost
                     user="djscrave", # your username
                      passwd="OLBypJ_Oeba5B", # your password
                      db="wks") # name of the data base

# You must create a Cursor object
cur = db.cursor()

# get Ville & Tolerance
ville  = sys.argv[1]
tolerance = 1


# Request
cur.execute("""
            SELECT nom_ville,code_postal FROM villes WHERE LEFT(nom_ville,1) = %s AND  CHAR_LENGTH(nom_ville) <= %s AND  CHAR_LENGTH(nom_ville) >= %s
            """,  (ville[:1] , len(ville) + tolerance, len(ville) - tolerance))

choices = []
for row in cur.fetchall() :
    choices.append(row[1] + ' ' + row[0])


suggests =  process.extract(ville, choices, limit=3)

for suggest in suggests:
	print suggest[0]
