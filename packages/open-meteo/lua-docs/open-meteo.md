# Open-Meteo

Open-Meteo tools are exposed under `app.integrations.open_meteo`. The integration uses public Open-Meteo APIs and requires no credentials for standard non-commercial use.

## Coverage

- `open_meteo_forecast` - `https://api.open-meteo.com/v1/forecast`
- `open_meteo_model_forecast` - `https://api.open-meteo.com/v1/{model_endpoint}`
- `open_meteo_historical_weather` - `https://archive-api.open-meteo.com/v1/archive`
- `open_meteo_historical_forecast` - `https://historical-forecast-api.open-meteo.com/v1/forecast`
- `open_meteo_ensemble` - `https://ensemble-api.open-meteo.com/v1/ensemble`
- `open_meteo_seasonal_forecast` - `https://seasonal-api.open-meteo.com/v1/seasonal`
- `open_meteo_climate` - `https://climate-api.open-meteo.com/v1/climate`
- `open_meteo_marine` - `https://marine-api.open-meteo.com/v1/marine`
- `open_meteo_air_quality` - `https://air-quality-api.open-meteo.com/v1/air-quality`
- `open_meteo_satellite_radiation` - `https://satellite-api.open-meteo.com/v1/satellite-radiation`
- `open_meteo_flood` - `https://flood-api.open-meteo.com/v1/flood`
- `open_meteo_elevation` - `https://api.open-meteo.com/v1/elevation`
- `open_meteo_geocoding_search` - `https://geocoding-api.open-meteo.com/v1/search`
- `open_meteo_geocoding_get` - `https://geocoding-api.open-meteo.com/v1/get`

## Usage Notes

Pass official Open-Meteo query parameters as top-level tool arguments. For less common or newly added parameters, pass them inside `query`; top-level arguments override matching keys in `query`. Array values are encoded as comma-separated lists, matching Open-Meteo's documented variable selection style.

Most weather endpoints require `latitude` and `longitude`. Historical and climate endpoints also require `start_date` and `end_date`. Climate calls require `models` and `daily`. Geocoding search uses `name`, while geocoding get uses `id`.

`open_meteo_model_forecast` accepts `model_endpoint`, for example `gfs`, `ecmwf`, `icon`, `meteofrance`, `ukmo`, `jma`, `kma`, `metno`, `gem`, `bom`, `cma`, `knmi`, `dmi`, or `meteoitalia`.

## Examples

```lua
local forecast = app.integrations.open_meteo.open_meteo_forecast({
  latitude = 52.52,
  longitude = 13.41,
  hourly = { "temperature_2m", "precipitation" },
  daily = { "temperature_2m_max", "temperature_2m_min" },
  timezone = "Europe/Berlin"
})

local berlin = app.integrations.open_meteo.open_meteo_geocoding_search({
  name = "Berlin",
  count = 5,
  language = "en"
})

local air = app.integrations.open_meteo.open_meteo_air_quality({
  latitude = 52.52,
  longitude = 13.41,
  hourly = { "pm10", "pm2_5", "us_aqi" }
})
```

Responses are decoded Open-Meteo JSON responses. Open-Meteo may return a JSON object with `error = true` and `reason`; the integration converts that into a tool error.
