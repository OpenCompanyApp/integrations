# Mixpanel Analytics — Lua API Reference

## list_events

List events from Mixpanel, optionally filtered by type, unit, or date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Event type: `"general"` or `"unique"` (default: `"general"`) |
| `unit` | string | no | Time unit: `"hour"`, `"day"`, `"week"`, `"month"` (default: `"day"`) |
| `from` | string | no | Start date in YYYY-MM-DD format |
| `to` | string | no | End date in YYYY-MM-DD format |
| `limit` | integer | no | Maximum number of events to return (default: 100) |

### Examples

```lua
-- Get recent events
local result = app.integrations.mixpanel.list_events({
  limit = 50
})

for name, data in pairs(result.data or {}) do
  print("Event: " .. name)
end
```

```lua
-- Get events in a date range
local result = app.integrations.mixpanel.list_events({
  from = "2025-01-01",
  to = "2025-01-31",
  unit = "day",
  limit = 100
})
```

---

## get_event

Retrieve analytics data for a specific event by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The event name to retrieve data for |
| `type` | string | no | Event type: `"general"` or `"unique"` (default: `"general"`) |
| `unit` | string | no | Time unit: `"hour"`, `"day"`, `"week"`, `"month"` (default: `"day"`) |
| `from` | string | no | Start date in YYYY-MM-DD format |
| `to` | string | no | End date in YYYY-MM-DD format |

### Example

```lua
local result = app.integrations.mixpanel.get_event({
  name = "Page View",
  from = "2025-01-01",
  to = "2025-01-31"
})

for date, count in pairs(result.data or {}) do
  print("Date: " .. date .. " — Count: " .. tostring(count))
end
```

---

## list_funnels

List all funnels configured in the Mixpanel project.

### Parameters

None.

### Example

```lua
local result = app.integrations.mixpanel.list_funnels({})

for _, funnel in ipairs(result.data or {}) do
  print("Funnel: " .. funnel.name .. " (ID: " .. tostring(funnel.id) .. ")")
end
```

---

## get_funnel

Retrieve detailed conversion data for a Mixpanel funnel by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel funnel ID |

### Example

```lua
local result = app.integrations.mixpanel.get_funnel({
  id = "12345"
})

print("Funnel: " .. (result.data.name or "unknown"))
for _, step in ipairs(result.data.steps or {}) do
  print("  Step: " .. step.event .. " — Conversion: " .. tostring(step.conversion_ratio))
end
```

---

## list_cohorts

List all behavioral cohorts in the Mixpanel project.

### Parameters

None.

### Example

```lua
local result = app.integrations.mixpanel.list_cohorts({})

for _, cohort in ipairs(result.data or {}) do
  print("Cohort: " .. cohort.name .. " (ID: " .. tostring(cohort.id) .. ")")
end
```

---

## get_cohort

Retrieve detailed information for a Mixpanel cohort by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Mixpanel cohort ID |

### Example

```lua
local result = app.integrations.mixpanel.get_cohort({
  id = "67890"
})

print("Cohort: " .. (result.data.name or "unknown"))
print("Count: " .. tostring(result.data.count or 0))
```

---

## get_current_user

Get the currently authenticated Mixpanel user (caller identity).

### Parameters

None.

### Example

```lua
local result = app.integrations.mixpanel.get_current_user({})

print("Logged in as: " .. (result.name or result.email or "unknown"))
print("Role: " .. (result.role or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Mixpanel accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mixpanel.list_events({limit = 50})

-- Explicit default (portable across setups)
app.integrations.mixpanel.default.list_events({limit = 50})

-- Named accounts
app.integrations.mixpanel.production.list_events({limit = 50})
app.integrations.mixpanel.staging.list_events({limit = 50})
```

All functions are identical across accounts — only the credentials differ.
