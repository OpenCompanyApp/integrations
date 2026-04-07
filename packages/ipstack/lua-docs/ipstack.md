# IPstack — Lua API Reference

## lookup_ip

Look up geolocation data for a single IP address. Returns country, region, city, coordinates, and more.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | The IPv4 or IPv6 address to look up (e.g., `"134.201.250.155"`) |
| `language` | string | no | Response language code (e.g., `"en"`, `"de"`, `"fr"`) |

### Examples

```lua
local result = app.integrations.ipstack.lookup_ip({
  ip = "134.201.250.155"
})

if result.found ~= false then
  print(result.country_name)
  print(result.region_name)
  print(result.city)
  print(result.latitude .. ", " .. result.longitude)
end
```

---

## lookup_bulk

Look up geolocation data for multiple IP addresses at once (up to 50). Returns an array of geolocation results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ips` | array | yes | Array of IP addresses (max 50, e.g., `{"134.201.250.155", "72.229.28.185"}`) |
| `language` | string | no | Response language code (e.g., `"en"`, `"de"`, `"fr"`) |

### Examples

```lua
local result = app.integrations.ipstack.lookup_bulk({
  ips = { "134.201.250.155", "72.229.28.185", "110.174.165.78" }
})

for _, entry in ipairs(result) do
  print(entry.ip .. " → " .. entry.country_name .. ", " .. entry.city)
end
```

---

## check_location

Check if an IP address is located in a specific country or region. Returns geolocation data with a `location_match` boolean.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | The IP address to check (e.g., `"134.201.250.155"`) |
| `country_code` | string | no | ISO 3166-1 alpha-2 country code to match (e.g., `"US"`, `"DE"`, `"JP"`) |
| `region_code` | string | no | Region or state code to match (e.g., `"CA"`, `"TX"`) |

At least one of `country_code` or `region_code` must be provided.

### Examples

```lua
-- Check if an IP is in the US
local result = app.integrations.ipstack.check_location({
  ip = "134.201.250.155",
  country_code = "US"
})

print("Location match: " .. tostring(result.location_match))
print("Country: " .. result.country_name)
```

```lua
-- Check if an IP is in California, US
local result = app.integrations.ipstack.check_location({
  ip = "134.201.250.155",
  country_code = "US",
  region_code = "CA"
})
```

---

## get_timezone

Get timezone information for an IP address, including timezone ID, current time, and UTC offset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | The IP address to look up timezone for (e.g., `"134.201.250.155"`) |

### Examples

```lua
local result = app.integrations.ipstack.get_timezone({
  ip = "134.201.250.155"
})

if result.found ~= false then
  print("Timezone: " .. result.timezone.id)
  print("Current time: " .. result.timezone.current_time)
  print("UTC offset: " .. result.timezone.utc_offset)
end
```

---

## get_currency

Get local currency information for an IP address, including currency code, name, symbol, and exchange rates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | The IP address to look up currency for (e.g., `"134.201.250.155"`) |

### Examples

```lua
local result = app.integrations.ipstack.get_currency({
  ip = "134.201.250.155"
})

if result.found ~= false then
  print("Currency: " .. result.currency.name .. " (" .. result.currency.code .. ")")
  print("Symbol: " .. result.currency.symbol)
end
```

---

## get_connection

Get connection and ISP information for an IP address, including ASN, ISP name, and organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | The IP address to look up connection info for (e.g., `"134.201.250.155"`) |

### Examples

```lua
local result = app.integrations.ipstack.get_connection({
  ip = "134.201.250.155"
})

if result.found ~= false then
  print("ISP: " .. result.connection.isp)
  print("ASN: " .. result.connection.asn)
  print("Organization: " .. result.connection.org)
end
```

---

## get_current_user

Detect and geolocate the current requesting IP address. Useful for identifying the caller's own location without knowing their IP.

### Parameters

None.

### Examples

```lua
local result = app.integrations.ipstack.get_current_user({})

if result.found ~= false then
  print("Your IP: " .. result.ip)
  print("Your location: " .. result.country_name .. ", " .. result.city)
end
```

---

## Multi-Account Usage

If you have multiple IPstack accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ipstack.lookup_ip({ ip = "134.201.250.155" })

-- Explicit default (portable across setups)
app.integrations.ipstack.default.lookup_ip({ ip = "134.201.250.155" })

-- Named accounts
app.integrations.ipstack.production.lookup_ip({ ip = "134.201.250.155" })
app.integrations.ipstack.staging.get_timezone({ ip = "134.201.250.155" })
```

All functions are identical across accounts — only the credentials differ.
