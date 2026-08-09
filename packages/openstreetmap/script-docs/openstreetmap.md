# OpenStreetMap

Namespace: `openstreetmap`

Use this integration for public OpenStreetMap workflows: Nominatim geocoding,
Nominatim lookup/details, Overpass QL data queries, service status checks, and
stable OSM object/map URLs.

## Authentication

The read-only public APIs used by this integration require no credentials.
Requests include a descriptive `User-Agent` header.

## Tools

- `openstreetmap_nominatim_search`: forward geocode free-form or structured
  addresses.
- `openstreetmap_nominatim_reverse`: reverse geocode latitude/longitude.
- `openstreetmap_nominatim_lookup`: look up `N123,W456,R789` object IDs.
- `openstreetmap_nominatim_details`: inspect a Nominatim place.
- `openstreetmap_nominatim_status`: check Nominatim status.
- `openstreetmap_overpass_query`: run Overpass QL. Include `[out:json]` when
  you want JSON parsed into tool output.
- `openstreetmap_overpass_status`: check Overpass status.
- `openstreetmap_object_url`: build node/way/relation URLs.
- `openstreetmap_map_url`: build coordinate map URLs.

## Usage Notes

Nominatim public instances have usage-policy limits. Keep requests specific,
cache results in host applications when appropriate, and pass `email` for
heavy or repeated use. Overpass query results can be large; always bound
queries by area, bounding box, or limit.

## Examples

```js
var places = tools.openstreetmap_nominatim_search({
  q: "Brandenburg Gate Berlin",
  limit: 3,
  addressdetails: true,
  extratags: true,
})

var reverse = tools.openstreetmap_nominatim_reverse({
  lat: 52.5163,
  lon: 13.3777,
  zoom: 18,
  addressdetails: true,
})

var cafes = tools.openstreetmap_overpass_query({
  query: String.raw`,
    [out:json][timeout:25];
    node["amenity"="cafe"](52.51,13.37,52.52,13.39);
    out center 20;
  `
})
```