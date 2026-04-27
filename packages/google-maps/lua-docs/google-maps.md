# Google Maps — Lua API Reference

Use `app.integrations.google_maps` to geocode addresses, search places, inspect place details, get directions, and calculate distance matrices.

## google_maps_geocode_address

Convert an address into geographic coordinates.

```lua
local result = app.integrations.google_maps.google_maps_geocode_address({
  address = "1600 Amphitheatre Parkway, Mountain View, CA",
  region = "us",
  language = "en"
})
```

## google_maps_reverse_geocode

Convert latitude and longitude into address results.

```lua
local result = app.integrations.google_maps.google_maps_reverse_geocode({
  latitude = 37.422,
  longitude = -122.084
})
```

## google_maps_search_places

Search places with optional location, radius, type, price, and open-now filters.

```lua
local result = app.integrations.google_maps.google_maps_search_places({
  query = "coffee near Brussels",
  type = "cafe",
  open_now = true
})
```

## google_maps_get_place_details

Fetch details for a Google Place ID. Use `fields` to keep responses focused.

```lua
local result = app.integrations.google_maps.google_maps_get_place_details({
  place_id = "ChIJN1t_tDeuEmsRUsoyG83frY4",
  fields = { "name", "formatted_address", "geometry", "rating" }
})
```

## google_maps_get_directions

Get directions between two locations.

```lua
local result = app.integrations.google_maps.google_maps_get_directions({
  origin = "Brussels Central Station",
  destination = "Atomium, Brussels",
  mode = "transit"
})
```

## google_maps_get_distance_matrix

Calculate distances and durations for origin-destination pairs.

```lua
local result = app.integrations.google_maps.google_maps_get_distance_matrix({
  origins = { "Brussels", "Antwerp" },
  destinations = { "Ghent", "Leuven" },
  units = "metric"
})
```

## google_maps_get_current_user

Verify credentials and estimate the current requester location through the Geolocation API.

```lua
local result = app.integrations.google_maps.google_maps_get_current_user({})
```
