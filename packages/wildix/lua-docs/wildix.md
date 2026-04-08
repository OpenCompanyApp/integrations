# Wildix — Lua API Reference

## list_calls

List call records from the Wildix PBX with optional pagination and date filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of call records to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `date_from` | string | no | Start date for filtering calls (ISO 8601, e.g. "2026-01-01") |
| `date_to` | string | no | End date for filtering calls (ISO 8601, e.g. "2026-01-31") |

### Examples

#### List recent calls

```lua
local result = app.integrations.wildix.list_calls({
  limit = 10,
  page = 1
})

for _, call in ipairs(result.calls or {}) do
  print(call.id .. ": " .. call.status)
end
```

#### Filter calls by date range

```lua
local result = app.integrations.wildix.list_calls({
  date_from = "2026-01-01",
  date_to = "2026-01-31",
  limit = 50
})
```

---

## get_call

Get detailed information about a specific call record.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the call record |

### Example

```lua
local result = app.integrations.wildix.get_call({ id = "call-123" })
print("Duration: " .. result.duration .. "s")
print("From: " .. result.from)
print("To: " .. result.to)
```

---

## list_extensions

List PBX extensions configured in the Wildix system.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of extensions to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.wildix.list_extensions({
  limit = 50,
  page = 1
})

for _, ext in ipairs(result.extensions or {}) do
  print(ext.id .. ": " .. ext.name)
end
```

---

## get_extension

Get detailed information about a specific PBX extension.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the extension |

### Example

```lua
local result = app.integrations.wildix.get_extension({ id = "ext-456" })
print("Extension: " .. result.number)
print("User: " .. result.user_name)
```

---

## list_users

List users configured in the Wildix PBX system.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.wildix.list_users({
  limit = 50,
  page = 1
})

for _, user in ipairs(result.users or {}) do
  print(user.id .. ": " .. user.name .. " <" .. user.email .. ">")
end
```

---

## get_current_user

Get the profile of the currently authenticated Wildix user. No parameters required.

### Example

```lua
local result = app.integrations.wildix.get_current_user({})
print("Logged in as: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Wildix accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wildix.list_calls({...})

-- Explicit default (portable across setups)
app.integrations.wildix.default.list_calls({...})

-- Named accounts
app.integrations.wildix.office.list_calls({...})
app.integrations.wildix.support.list_calls({...})
```

All functions are identical across accounts — only the credentials differ.
