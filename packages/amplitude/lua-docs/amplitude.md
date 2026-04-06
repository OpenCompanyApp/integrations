# Amplitude Analytics — Lua API Reference

## list_events

List events from Amplitude, optionally filtered by user, device, or time range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no | Filter by Amplitude user ID |
| `device_id` | string | no | Filter by device ID |
| `start` | string | no | Start timestamp (ISO 8601 or milliseconds epoch) |
| `end` | string | no | End timestamp (ISO 8601 or milliseconds epoch) |
| `limit` | integer | no | Maximum number of events to return (default: 1000) |

### Examples

```lua
-- Get recent events for a user
local result = app.integrations.amplitude.list_events({
  user_id = "user_123",
  limit = 50
})

for _, event in ipairs(result.events or {}) do
  print(event.event_type .. " at " .. event.server_received_time)
end
```

```lua
-- Get events in a time range
local result = app.integrations.amplitude.list_events({
  start = "2025-01-01T00:00:00Z",
  end = "2025-01-31T23:59:59Z",
  limit = 100
})
```

---

## get_event

Retrieve a single event by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude event ID |

### Example

```lua
local result = app.integrations.amplitude.get_event({
  id = "12345"
})

print("Event: " .. result.event_type)
print("User: " .. result.user_id)
```

---

## list_users

Search for users in Amplitude by query string.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search term — user ID, name, email, or other identifier |
| `limit` | integer | no | Maximum number of users to return (default: 100) |

### Example

```lua
local result = app.integrations.amplitude.list_users({
  query = "john@example.com",
  limit = 10
})

for _, user in ipairs(result.users or result.matches or {}) do
  print("User: " .. (user.user_id or user.name or "unknown"))
end
```

---

## get_user

Retrieve a full user profile by user ID or device ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no* | The Amplitude user ID |
| `device_id` | string | no* | The Amplitude device ID |

*At least one of `user_id` or `device_id` is required.

### Example

```lua
local result = app.integrations.amplitude.get_user({
  user_id = "user_123"
})

print("User: " .. result.user_id)
for key, value in pairs(result.user_properties or {}) do
  print("  " .. key .. ": " .. tostring(value))
end
```

---

## list_properties

List available event or user properties in the Amplitude project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Property type: `"event"` (default) or `"user"` |

### Examples

```lua
-- List event properties
local result = app.integrations.amplitude.list_properties({
  type = "event"
})

for _, prop in ipairs(result.properties or result.data or {}) do
  print("Event property: " .. prop)
end
```

```lua
-- List user properties
local result = app.integrations.amplitude.list_properties({
  type = "user"
})
```

---

## list_groups

Search for groups in Amplitude by query string.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search term — group name or group ID |
| `limit` | integer | no | Maximum number of groups to return (default: 100) |

### Example

```lua
local result = app.integrations.amplitude.list_groups({
  query = "Enterprise",
  limit = 20
})

for _, group in ipairs(result.groups or result.matches or {}) do
  print("Group: " .. (group.group_name or group.name or "unknown"))
end
```

---

## get_current_user

Get the currently authenticated Amplitude user (caller identity).

### Parameters

None.

### Example

```lua
local result = app.integrations.amplitude.get_current_user({})

print("Logged in as: " .. (result.name or result.email or "unknown"))
print("Role: " .. (result.role or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Amplitude accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.amplitude.list_events({user_id = "user_123"})

-- Explicit default (portable across setups)
app.integrations.amplitude.default.list_events({user_id = "user_123"})

-- Named accounts
app.integrations.amplitude.production.list_events({user_id = "user_123"})
app.integrations.amplitude.staging.list_events({user_id = "user_123"})
```

All functions are identical across accounts — only the credentials differ.
