#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import MySQLdb

from fuzzywuzzy import fuzz
from fuzzywuzzy import process

# Connexion database
db = MySQLdb.connect(host="ns3296046.ovh.net", # your host, usually localhost
                     user="djscrave", # your username
                      passwd="OLBypJ_Oeba5B", # your password
                      db="wks") # name of the data base

# You must create a Cursor object
cur = db.cursor()

# get Ville & Tolerance
ville  = 'Lyon'
tolerance = 2

# Request
cur.execute("""
            SELECT nom_ville FROM villes WHERE LEFT(nom_ville,1) = %s AND CHAR_LENGTH(nom_ville) <= %s AND CHAR_LENGTH(nom_ville) > %s
            """,  (ville[:1] , len(ville) + tolerance, len(ville) - tolerance))

choices = []
for row in cur.fetchall() :
    raw = row[0]
    choices.append(raw)
	

suggests =  process.extract(ville, choices, limit=5)

suggesting = []
for suggest in suggests:
    print suggest[0]
