from geopy import geocoders
import sys

search  = sys.argv[1]
g = geocoders.GoogleV3()
place, (lat, lng) = g.geocode(search)
print float(lat)
print float(lng)

