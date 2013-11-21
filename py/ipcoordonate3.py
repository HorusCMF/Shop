import json
import httplib2
import sys


apiUrl = 'http://api.ipinfodb.com/v3/ip-city/?key=2e059099c3be5bc49712f4e03e54aa2a0c4539a578fc8e63d9193b21f5582b4c&ip='+ sys.argv[1] +'&format=json'
h = httplib2.Http()
response, content = h.request(apiUrl, 'GET')
results = json.loads(content)
output = ''

order = {
    'cityName': 1,
}

sorted_keys = sorted(results, key=order.get)
sorted_results = [(k, results[k]) for k in sorted_keys]

for key, value in sorted_results:
    if key == 'cityName':
        output = value

print output




