import json
import httplib2
import sys

apiUrl = 'http://www.freegeoip.net/json/'+ sys.argv[1] +''
h = httplib2.Http()
response, content = h.request(apiUrl, 'GET')
results = json.loads(content)
output = ''

order = {
    'country': 1,
    'city': 2,
    'region_name': 3,
    'region_code': 4,
    'longitude': 5,
    'latitude': 6,
    'ip': 7,
}

sorted_keys = sorted(results, key=order.get)
sorted_results = [(k, results[k]) for k in sorted_keys]

for key, value in sorted_results:
    if key == 'city':
        output = value

print output




