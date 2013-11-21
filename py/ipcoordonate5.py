def get_location(self, query): 
    params = { }
    params[ 'key' ] = "AIzaSyDG5qJqL0AOJe9N7ggMb3FRE3dyav7OG0k" # the actual key, of course, is not provided here
    params[ 'sensor' ] = "false"
    params[ 'address' ] = 'Paris'

    params = urllib.urlencode( params )
    print "http://maps.googleapis.com/maps/api/geocode/json?%s" % params

    try:
        f = urllib.urlopen( "http://maps.googleapis.com/maps/api/geocode/json?%s" % params )

get_location()