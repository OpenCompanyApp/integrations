# Samsara — Lua API Reference

## list_vehicles

List fleet vehicles from Samsara. Returns vehicle details including name, VIN, make, model, year, and GPS location.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of vehicles to return per page (default: 100, max: 512) |
| `after` | string | no | Pagination cursor — pass the `pagination.endCursor` value from a previous response to fetch the next page |

### Examples

```lua
-- List first page of vehicles
local result = app.integrations.samsara.list_vehicles({limit = 50})

for _, vehicle in ipairs(result.data) do
  print(vehicle.name .. " — " .. (vehicle.vin or "no VIN"))
end

-- Fetch next page
if result.pagination and result.pagination.hasNextPage then
  local next = app.integrations.samsara.list_vehicles({
    limit = 50,
    after = result.pagination.endCursor
  })
end
```

---

## get_vehicle

Get detailed information about a specific vehicle by its Samsara ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Samsara vehicle ID (e.g., `"123456789012345"`) |

### Examples

```lua
local vehicle = app.integrations.samsara.get_vehicle({id = "123456789012345"})
print(vehicle.name)
print("VIN: " .. vehicle.vin)
print("Location: " .. vehicle.gps.latitude .. ", " .. vehicle.gps.longitude)
```

---

## list_drivers

List fleet drivers from Samsara. Returns driver details including name, username, email, phone, and driver license info.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of drivers to return per page (default: 100, max: 512) |
| `after` | string | no | Pagination cursor — pass the `pagination.endCursor` value from a previous response to fetch the next page |

### Examples

```lua
-- List all drivers
local result = app.integrations.samsara.list_drivers()

for _, driver in ipairs(result.data) do
  print(driver.name .. " — " .. (driver.username or "no username"))
end
```

---

## get_driver

Get detailed information about a specific driver by their Samsara ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Samsara driver ID (e.g., `"123456789012345"`) |

### Examples

```lua
local driver = app.integrations.samsara.get_driver({id = "987654321098765"})
print(driver.name)
print("Email: " .. (driver.email or "N/A"))
print("License: " .. (driver.licenseNumber or "N/A"))
```

---

## list_sensors

List IoT sensors from Samsara. Returns sensor details including name, type, model, connectivity, and current readings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sensors to return per page (default: 100, max: 512) |
| `after` | string | no | Pagination cursor — pass the `pagination.endCursor` value from a previous response to fetch the next page |

### Examples

```lua
-- List all sensors
local result = app.integrations.samsara.list_sensors()

for _, sensor in ipairs(result.data) do
  print(sensor.name .. " — " .. sensor.model)
end
```

---

## get_current_user

Get the currently authenticated Samsara user profile. No parameters required.

### Examples

```lua
local user = app.integrations.samsara.get_current_user({})
print("Logged in as: " .. user.email)
print("Organization: " .. (user.organizationName or "N/A"))
```

---

## Common Workflows

### Get all vehicles across all pages

```lua
local all_vehicles = {}
local cursor = nil
local has_more = true

while has_more do
  local params = {limit = 512}
  if cursor then
    params.after = cursor
  end

  local result = app.integrations.samsara.list_vehicles(params)

  if result.data then
    for _, v in ipairs(result.data) do
      table.insert(all_vehicles, v)
    end
  end

  if result.pagination and result.pagination.hasNextPage then
    cursor = result.pagination.endCursor
  else
    has_more = false
  end
end

print("Total vehicles: " .. #all_vehicles)
```

### Find a vehicle by VIN

```lua
local target_vin = "1HGBH41JXMN109186"
local found = nil
local cursor = nil

repeat
  local params = {limit = 512}
  if cursor then params.after = cursor end

  local result = app.integrations.samsara.list_vehicles(params)

  if result.data then
    for _, v in ipairs(result.data) do
      if v.vin == target_vin then
        found = v
        break
      end
    end
  end

  if not found and result.pagination and result.pagination.hasNextPage then
    cursor = result.pagination.endCursor
  else
    cursor = nil
  end
until found or not cursor

if found then
  print("Found: " .. found.name .. " (ID: " .. found.id .. ")")
else
  print("Vehicle with VIN " .. target_vin .. " not found")
end
```

### Verify API connectivity

```lua
local user = app.integrations.samsara.get_current_user({})
print("Connected to Samsara as " .. user.email)
```

---

## Notes

- All list endpoints support cursor-based pagination using `after` and `limit` parameters
- The maximum page size is 512 items; use pagination to retrieve larger datasets
- API token must have appropriate scopes for each endpoint (e.g., `vehicles:read`, `drivers:read`, `sensors:read`)
- Rate limits apply — see the [Samsara API docs](https://developers.samsara.com/docs/rate-limits) for current limits

---

## Multi-Account Usage

If you have multiple Samsara accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.samsara.list_vehicles({limit = 50})

-- Explicit default (portable across setups)
app.integrations.samsara.default.list_vehicles({limit = 50})

-- Named accounts
app.integrations.samsara.us_fleet.list_vehicles({limit = 50})
app.integrations.samsara.eu_fleet.list_vehicles({limit = 50})
```

All functions are identical across accounts — only the credentials differ.
