import geopy
import geopy.distance
from geopy import geocoders

g = geocoders.GeoNames()


_, pt1 = g.geocode('Lyon, 69200')
_, pt2 = g.geocode('Paris, 75001')

dist = geopy.distance.distance(pt1, pt2).km

print dist
