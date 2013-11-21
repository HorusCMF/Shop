#!/usr/bin/env python
# -*- coding: utf-8 -*-

import geopy
import geopy.distance
import sys

pt1 = geopy.Point(sys.argv[1].replace(",", "."), sys.argv[2].replace(",", "."))
pt2 = geopy.Point(sys.argv[3].replace(",", "."), sys.argv[4].replace(",", "."))

dist = geopy.distance.distance(pt1, pt2).km

print dist
