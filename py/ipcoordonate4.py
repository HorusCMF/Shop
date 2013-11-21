import sys
import pygeoip

gi = pygeoip.GeoIP('/usr/local/share/GeoIP/GeoLiteCity.dat', pygeoip.MEMORY_CACHE)


results = gi.record_by_addr(sys.argv[1])
order = {
    'city': 1,
}
output = ''
sorted_keys = sorted(results, key=order.get)
sorted_results = [(k, results[k]) for k in sorted_keys]

for key, value in sorted_results:
    if key == 'city':
        output = value

print output

