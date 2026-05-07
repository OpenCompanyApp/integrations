# IPstack Lua Reference

Namespace: `ipstack`

This integration covers the three official IPstack endpoint shapes:

- Standard lookup: `GET /{ip}`
- Bulk lookup: `GET /{ip1},{ip2}`
- Requester lookup: `GET /check`

All tools return IPstack's JSON response directly. Optional fields can request nested response sections such as `location`, `timezone`, `currency`, `connection`, and `security`.

## `ipstack.lookup_ip`

Look up one IP address or domain.

```lua
local result = app.integrations.ipstack.lookup_ip({
  ip = "134.201.250.155",
  fields = { "main", "location", "timezone" },
  language = "en"
})
```

Optional parameters:

- `fields`: array of field names.
- `hostname`: boolean, requests hostname lookup.
- `security`: boolean, requests the paid security module.
- `language`: response language code, such as `en`, `de`, `fr`, or `pt-br`.

## `ipstack.lookup_bulk`

Look up up to 50 IP addresses or domains in one request.

```lua
local result = app.integrations.ipstack.lookup_bulk({
  ips = { "134.201.250.155", "72.229.28.185" },
  fields = { "main", "connection" }
})
```

Bulk lookup is plan-dependent in IPstack.

## `ipstack.lookup_requester`

Detect and geolocate the IP address making the API request.

```lua
local result = app.integrations.ipstack.lookup_requester({
  fields = { "main", "location" }
})
```

## Notes

IPstack represents timezone, currency, connection, and security data as optional response fields on the lookup endpoints. They are not separate API operations, so this package exposes them through `fields` rather than separate tools.
