# Moon phase report — Lua API Reference

## celestial_lunar_eclipse

Get lunar eclipse data for a specific date — eclipse type, magnitude, gamma, contact times (P1-P4, U1-U4), and semi-durations..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | ISO date (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_lunar_eclipse({
  date = ""
})
```

## celestial_moon_info

Get moon position, illumination, and visibility from a specific location..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `latitude` | number | yes | Observer latitude (-90 to 90). |
| `longitude` | number | yes | Observer longitude (-180 to 180). |
| `date` | string | no | ISO date or datetime (e.g.  |
| `timezone` | string | no | Timezone for display (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_moon_info({
  latitude = 0
  longitude = 0
  date = ""
})
```

## celestial_moon_phase

Get current moon phase, illumination percentage, age, zodiac sign, and dates of next new/full moon..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | no | ISO date or datetime (e.g.  |
| `timezone` | string | no | Timezone for display (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_moon_phase({
  date = ""
  timezone = ""
})
```

## celestial_night_sky

Get what\.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `latitude` | number | yes | Observer latitude (-90 to 90). |
| `longitude` | number | yes | Observer longitude (-180 to 180). |
| `timezone` | string | no | Timezone for display (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_night_sky({
  latitude = 0
  longitude = 0
  timezone = ""
})
```

## celestial_planet_position

Get planet altitude/azimuth, zodiac position, and rise/set times. Set planet to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `latitude` | number | yes | Observer latitude (-90 to 90). |
| `longitude` | number | yes | Observer longitude (-180 to 180). |
| `planet` | string | no | Planet name:  |
| `date` | string | no | ISO date or datetime (e.g.  |
| `timezone` | string | no | Timezone for display (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_planet_position({
  latitude = 0
  longitude = 0
  planet = ""
})
```

## celestial_solar_eclipse

Get solar eclipse data for a specific date and location — eclipse type, obscuration, contacts, and magnitude..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | ISO date (e.g.  |
| `latitude` | number | yes | Observer latitude (-90 to 90). |
| `longitude` | number | yes | Observer longitude (-180 to 180). |

### Example

```lua
local result = app.integrations.celestial.celestial_solar_eclipse({
  date = ""
  latitude = 0
  longitude = 0
})
```

## celestial_sun_info

Get sunrise/sunset times, solar altitude/azimuth, twilight phase, day length, and zodiac position for a location..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `latitude` | number | yes | Observer latitude (-90 to 90). |
| `longitude` | number | yes | Observer longitude (-180 to 180). |
| `date` | string | no | ISO date or datetime (e.g.  |
| `timezone` | string | no | Timezone for display (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_sun_info({
  latitude = 0
  longitude = 0
  date = ""
})
```

## celestial_time_info

Get astronomical time data — Julian Day, sidereal time (GMST/GAST), and equation of time..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | no | ISO date or datetime (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_time_info({
  date = ""
})
```

## celestial_zodiac_report

Get all celestial bodies mapped to zodiac signs with alignments for a given date..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | no | ISO date or datetime (e.g.  |

### Example

```lua
local result = app.integrations.celestial.celestial_zodiac_report({
  date = ""
})
```
