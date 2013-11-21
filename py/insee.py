#!/usr/bin/python
import urllib
import sys
from HTMLParser import HTMLParser
import logging

def get_cp(txtCommune,cdep=None):
  params = urllib.urlencode({'txtCommune':txtCommune, 'selCritere':'CP'})
  f = urllib.urlopen('http://www.laposte.fr/sna/rubrique.php3?id_rubrique=59&recalcul=oui', params)
  reponse = f.read().decode('iso-8859-1')
  f.close()
  i = 0
  while i > -1:
    i = reponse.find('onclick=window.open')
    if i > -1 :
      j = reponse.find('false;',i)
      reponse = reponse[:i] + reponse[j+len('false;'):]
  p = MyParser(cdep)
  p.feed(reponse)
  p.close()
  print reponse
  return p.cp_found

class MyParser (HTMLParser):
  result_found=False
  tag = None
  cdep = None
  cp_found = []

  def __init__(self, cdep):
    HTMLParser.__init__(self)
    self.cdep = cdep
    self.tag = None
    self.result_found = False
    self.cp_found= []

  def handle_starttag(self, tag, attrs):
    for a,v in  attrs:
      if a == 'class':
        if v  =='resultat':
           self.result_found=True
           self.tag = tag

  def handle_endtag(self, tag):
    if self.result_found:
      if tag == self.tag:
        self.result_found=False

  def handle_data(self,data):
    if self.result_found :
      if self.cdep:
        if data.startswith(self.cdep) :
          self.cp_found.append(data)
      else:
        self.cp_found.append(data)

def normalize_commune(art, ncc):
  logging.info("normalizing %s %s" % (art, ncc))
  resu=None
  if art:
    resu = art.strip('(').strip(')').strip("'")
  if resu:
    resu = "%s %s" % (resu, ncc)
  else:
    resu = ncc
  resu = resu.replace('-',' ').replace('SAINT','ST').replace("'"," ")
  return resu
