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

## list_funnels

List funnels configured in the Amplitude project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by Amplitude project ID |
| `limit` | integer | no | Maximum number of funnels to return (default: 100) |

### Example

```lua
local result = app.integrations.amplitude.list_funnels({
  limit = 20
})

for _, funnel in ipairs(result.funnels or result.data or {}) do
  print("Funnel: " .. (funnel.name or funnel.id) .. " — conversion: " .. tostring(funnel.conversion_rate or "N/A"))
end
```

---

## get_funnel

Retrieve a single funnel by its ID with conversion metrics and step details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude funnel ID |

### Example

```lua
local result = app.integrations.amplitude.get_funnel({
  id = "42"
})

print("Funnel: " .. result.name)
for _, step in ipairs(result.steps or {}) do
  print("  Step: " .. step.event_type .. " — " .. tostring(step.count) .. " users")
end
```

---

## list_cohorts

List behavioral cohorts in the Amplitude project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by Amplitude project ID |
| `limit` | integer | no | Maximum number of cohorts to return (default: 100) |

### Example

```lua
local result = app.integrations.amplitude.list_cohorts({
  limit = 20
})

for _, cohort in ipairs(result.cohorts or result.data or {}) do
  print("Cohort: " .. (cohort.name or cohort.id) .. " — size: " .. tostring(cohort.size or "N/A"))
end
```

---

## get_cohort

Retrieve a single cohort by its ID with membership and behavioral criteria.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Amplitude cohort ID |

### Example

```lua
local result = app.integrations.amplitude.get_cohort({
  id = "7"
})

print("Cohort: " .. result.name)
print("Members: " .. tostring(result.size or result.count or "N/A"))
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
