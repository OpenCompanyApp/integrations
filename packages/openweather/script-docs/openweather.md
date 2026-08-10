# OpenWeather

Namespace: `openweather`

OpenWeather provides current weather, 5 day / 3 hour forecast, One Call 3.0, air pollution, and geocoding data. All tools require an OpenWeather API key. Some One Call 3.0 tools require the API key to have access to the One Call subscription product.

## Location Lookups

Prefer coordinates when possible. Current weather and 5 day forecast also accept legacy selectors such as `q`, `id`, or `zip`.

```js
var places = openweather.geocoding_direct({
  q: "Berlin,DE",
  limit: 1,
})

var weather = openweather.current_weather({
  lat: 52.52,
  lon: 13.41,
  units: "metric",
})
```
## Weather And Forecasts

- `openweather_current_weather` returns the current `/data/2.5/weather` response for coordinates or a legacy city selector.
- `openweather_forecast_5_day` returns the `/data/2.5/forecast` list of 3 hour forecast periods.
- `openweather_one_call` returns One Call 3.0 current, minutely, hourly, daily, and alert sections unless excluded.
- `openweather_one_call_timemachine` returns One Call 3.0 data for a Unix timestamp.
- `openweather_one_call_day_summary` returns the One Call 3.0 daily aggregation for `date`.
- `openweather_one_call_overview` returns OpenWeather's overview summary output for a coordinate pair.

Use `exclude` as an array; the integration sends it as the comma-separated value OpenWeather expects.

```js
var daily = openweather.one_call({
  lat: 52.52,
  lon: 13.41,
  exclude: [ "current", "minutely", "hourly" ],
  units: "metric",
})
```
## Air Pollution

Air pollution tools require `lat` and `lon`. History additionally requires Unix timestamps:

```js
var pollution = openweather.air_pollution_history({
  lat: 52.52,
  lon: 13.41,
  start: 1704067200,
  ["end"]: 1704153600,
})
```
## Return Shape

The integration returns parsed OpenWeather JSON with minimal normalization. OpenWeather fields such as `weather`, `main`, `wind`, `list`, `components`, `coord`, `lat`, and `lon` keep their upstream names. API errors are returned as tool errors with the OpenWeather message when available.

Advanced official parameters can be passed through `query`, but top-level tool arguments override duplicate keys from `query`.
