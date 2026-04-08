# NASA — Lua API Reference

## get_apod

Get the NASA Astronomy Picture of the Day (APOD).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | no | Specific date in YYYY-MM-DD format (defaults to today) |
| `start_date` | string | no | Start date for a range in YYYY-MM-DD format |
| `end_date` | string | no | End date for a range in YYYY-MM-DD format |

Use `date` for a single entry, or `start_date` + `end_date` for multiple days.

### Examples

```lua
-- Today's APOD
local result = app.integrations.nasa.get_apod({})

print(result.title)
print(result.explanation)
print("Image: " .. result.url)
print("HD: " .. (result.hdurl or "N/A"))
```

```lua
-- APOD for a specific date
local result = app.integrations.nasa.get_apod({
  date = "2025-06-15"
})

print(result.title)
```

```lua
-- APOD for a date range
local result = app.integrations.nasa.get_apod({
  start_date = "2025-06-01",
  end_date = "2025-06-07"
})

for _, entry in ipairs(result.entries) do
  print(entry.date .. ": " .. entry.title)
end

print("Total: " .. result.count .. " entries")
```

---

## get_mars_rover_photos

Get photos from Mars rovers (Curiosity, Opportunity, Spirit, Perseverance).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `rover` | string | yes | Rover name: `"curiosity"`, `"opportunity"`, `"spirit"`, or `"perseverance"` |
| `sol` | integer | no | Martian day (sol) number. Use this OR `earth_date` |
| `earth_date` | string | no | Earth date in YYYY-MM-DD format. Use this OR `sol` |
| `camera` | string | no | Camera abbreviation (e.g., `"FHAZ"`, `"MAST"`, `"NAVCAM"`) |
| `page` | integer | no | Page number (default 1, 25 photos per page) |

### Camera Abbreviations

| Code | Camera |
|------|--------|
| FHAZ | Front Hazard Avoidance Camera |
| RHAZ | Rear Hazard Avoidance Camera |
| MAST | Mast Camera |
| CHEMCAM | Chemistry and Camera Complex |
| MAHLI | Mars Hand Lens Imager |
| MARDI | Mars Descent Imager |
| NAVCAM | Navigation Camera |
| PANCAM | Panoramic Camera |
| MINITES | Miniature Thermal Emission Spectrometer |

### Example

```lua
local result = app.integrations.nasa.get_mars_rover_photos({
  rover = "curiosity",
  sol = 1000,
  camera = "MAST"
})

print("Found " .. result.count .. " photos from " .. result.rover)

for _, photo in ipairs(result.photos) do
  print(photo.earth_date .. " | " .. photo.camera.full_name)
  print("  " .. photo.img_src)
end
```

```lua
-- By Earth date
local result = app.integrations.nasa.get_mars_rover_photos({
  rover = "perseverance",
  earth_date = "2025-03-15"
})
```

---

## get_asteroids

Get Near Earth Objects (asteroids) for a date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | no | Start date in YYYY-MM-DD format (defaults to today) |
| `end_date` | string | no | End date in YYYY-MM-DD format (max 7 days after start_date) |

### Example

```lua
local result = app.integrations.nasa.get_asteroids({
  start_date = "2025-06-01",
  end_date = "2025-06-08"
})

print("Total asteroids: " .. result.total_asteroids)

for date, asteroids in pairs(result.near_earth_objects) do
  print("\n" .. date .. ":")
  for _, ast in ipairs(asteroids) do
    local hazardous = ast.is_potentially_hazardous and " ⚠️" or ""
    print("  " .. ast.name .. hazardous)
    if ast.close_approach then
      print("    Distance: " .. math.floor(ast.close_approach.miss_distance_km) .. " km")
      print("    Speed: " .. math.floor(ast.close_approach.velocity_km_s) .. " km/s")
    end
  end
end
```

---

## get_asteroid

Get detailed information about a specific asteroid by its NASA ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The asteroid's NASA ID (find IDs with `get_asteroids`) |

### Example

```lua
local result = app.integrations.nasa.get_asteroid({
  id = "2534304"
})

print("Name: " .. result.name)
print("Potentially hazardous: " .. tostring(result.is_potentially_hazardous))
print("Diameter: " .. result.estimated_diameter_km.min .. " – " .. result.estimated_diameter_km.max .. " km")

if result.close_approaches then
  print("Close approaches:")
  for _, approach in ipairs(result.close_approaches) do
    print("  " .. approach.date .. " — " .. math.floor(approach.miss_distance_km) .. " km from " .. approach.orbiting_body)
  end
end
```

---

## search_images

Search the NASA Image and Video Library.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | yes | Search query (e.g., `"moon landing"`, `"Mars"`, `"Saturn rings"`) |
| `media_type` | string | no | Filter: `"image"`, `"video"`, or `"audio"` |
| `page` | integer | no | Page number (default 1) |

### Example

```lua
local result = app.integrations.nasa.search_images({
  q = "black hole",
  media_type = "image"
})

print("Total results: " .. result.total_hits)

for _, item in ipairs(result.items) do
  print(item.title)
  print("  " .. (item.thumbnail or "no image"))
  print("  Date: " .. (item.date_created or "unknown"))
end
```

---

## get_current_user

Get the current NASA API configuration status.

### Parameters

None.

### Example

```lua
local info = app.integrations.nasa.get_current_user({})

print(info.service)
print(info.message)
print("Configured: " .. tostring(info.configured))
print(info.note)
```
