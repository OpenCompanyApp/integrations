# Upstash Redis — Lua API Reference

## get_key

Retrieve the value stored at a Redis key. Returns null if the key does not exist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to retrieve. |

### Examples

```lua
local result = app.integrations.upstash.get_key({
  key = "user:1234:session"
})

if result.value then
  print("Value: " .. result.value)
else
  print("Key not found")
end
```

---

## set_key

Store a key-value pair in Redis. Optionally set a TTL (time-to-live) in seconds so the key expires automatically.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to set. |
| `value` | string | yes | The value to store. |
| `ex` | integer | no | Time-to-live in seconds. Key will be deleted automatically after this duration. |

### Examples

```lua
app.integrations.upstash.set_key({
  key = "config:theme",
  value = "dark"
})
```

```lua
-- With 60-second TTL
app.integrations.upstash.set_key({
  key = "cache:weather:amsterdam",
  value = '{"temp": 18, "condition": "cloudy"}',
  ex = 60
})
```

---

## delete_key

Delete a key from Redis. Returns the number of keys that were removed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to delete. |

### Examples

```lua
local result = app.integrations.upstash.delete_key({
  key = "temp:data"
})

print("Deleted: " .. tostring(result.deleted))
```

---

## list_keys

List Redis keys matching a glob-style pattern. Defaults to `"*"` to list all keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pattern` | string | no | Glob-style pattern to match keys against. Default: `"*"`. |

### Examples

```lua
local result = app.integrations.upstash.list_keys({
  pattern = "user:*"
})

print("Found " .. result.count .. " keys")
for _, key in ipairs(result.keys) do
  print("  " .. key)
end
```

```lua
-- List all keys
local result = app.integrations.upstash.list_keys()
print("Total keys: " .. result.count)
```

---

## list_databases

List all Redis databases in the Upstash account. Returns database IDs, names, regions, and endpoints.

### Parameters

None.

### Examples

```lua
local databases = app.integrations.upstash.list_databases()

for _, db in ipairs(databases) do
  print(db.database_name .. " — " .. db.region .. " — " .. db.endpoint)
end
```

---

## get_database

Get details for a specific Upstash Redis database by ID, including endpoint, region, and usage stats.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Upstash database ID. |

### Examples

```lua
local db = app.integrations.upstash.get_database({
  id = "abc12345-xxxx-yyyy-zzzz"
})

print("Name: " .. db.database_name)
print("Region: " .. db.region)
print("Endpoint: " .. db.endpoint)
```

---

## get_current_user

Get current team information from Upstash, including team name, members, and plan details.

### Parameters

None.

### Examples

```lua
local team = app.integrations.upstash.get_current_user()

print("Team: " .. team.name)
print("Plan: " .. (team.plan or "free"))
```

---

## Multi-Account Usage

If you have multiple upstash accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.upstash.function_name({...})

-- Explicit default (portable across setups)
app.integrations.upstash.default.function_name({...})

-- Named accounts
app.integrations.upstash.production.function_name({...})
app.integrations.upstash.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
