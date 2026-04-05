# Mixpanel — Lua API Reference

## mixpanel_track_event

Track an event in Mixpanel with optional properties and user identity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event` | string | yes | Name of the event to track (e.g. `"Page View"`, `"Purchase"`) |
| `properties` | string | no | JSON object of event properties (e.g. `'{"page":"/home","source":"ad"}'`) |
| `distinct_id` | string | no | Distinct user ID to associate the event with |
| `time` | integer | no | Unix timestamp for the event. Defaults to the current time |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_track_event({
  event = "Purchase",
  properties = '{"item":"widget","amount":49.99,"currency":"USD"}',
  distinct_id = "user-12345"
})
```

---

## mixpanel_query

Query Mixpanel event data with date range, type, and time unit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | yes | Start date in `YYYY-MM-DD` format |
| `to_date` | string | yes | End date in `YYYY-MM-DD` format |
| `event` | string | no | Event name or JSON array of event names (e.g. `'["Page View","Signup"]'`) |
| `type` | string | no | Query type: `"general"` (total events), `"unique"` (unique users), or `"average"`. Defaults to `"general"` |
| `unit` | string | no | Time unit for grouping: `"minute"`, `"hour"`, `"day"`, `"week"`, `"month"`. Defaults to `"day"` |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_query({
  from_date = "2026-01-01",
  to_date = "2026-01-31",
  event = "Signup",
  type = "unique",
  unit = "day"
})

for _, row in ipairs(result.data or {}) do
  print(row.date .. ": " .. (row.count or 0) .. " signups")
end
```

---

## mixpanel_funnel

Get conversion funnel results for a specific funnel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `funnel_id` | integer | yes | ID of the funnel to query |
| `from_date` | string | yes | Start date in `YYYY-MM-DD` format |
| `to_date` | string | yes | End date in `YYYY-MM-DD` format |
| `unit` | string | no | Time unit: `"day"`, `"week"`, or `"month"`. Defaults to `"day"` |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_funnel({
  funnel_id = 12345,
  from_date = "2026-01-01",
  to_date = "2026-01-31",
  unit = "week"
})
```

---

## mixpanel_retention

Get retention data for a cohort of users over time.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | yes | Start date in `YYYY-MM-DD` format |
| `to_date` | string | yes | End date in `YYYY-MM-DD` format |
| `retention_type` | string | no | `"birth"` or `"compounded"`. Defaults to `"birth"` |
| `born_event` | string | no | Event that defines cohort entry (e.g. `"Signup"`) |
| `born_where` | string | no | Filter expression for the born event (e.g. `'properties["Source"] == "organic"'`) |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_retention({
  from_date = "2026-01-01",
  to_date = "2026-02-01",
  retention_type = "birth",
  born_event = "Signup"
})
```

---

## mixpanel_profile

Set or update a Mixpanel user profile with properties.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `distinct_id` | string | yes | The user's distinct ID in Mixpanel |
| `properties` | string | yes | JSON object of profile properties (e.g. `'{"$name":"John","$email":"john@example.com"}'`) |
| `operation` | string | no | Profile operation: `"set"`, `"set_once"`, `"add"`, `"append"`, `"union"`, `"unset"`, or `"delete"`. Defaults to `"set"` |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_profile({
  distinct_id = "user-12345",
  properties = '{"$name":"Jane Doe","$email":"jane@example.com","Plan":"Pro"}',
  operation = "set"
})
```

---

## mixpanel_list_funnels

List all funnels in the Mixpanel project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Mixpanel project ID. Defaults to the configured project |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_list_funnels({})

for _, funnel in ipairs(result.data or {}) do
  print(funnel.id .. ": " .. funnel.name)
end
```

---

## mixpanel_get_export

Export raw event data from Mixpanel for a date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | yes | Start date in `YYYY-MM-DD` format |
| `to_date` | string | yes | End date in `YYYY-MM-DD` format |
| `event` | string | no | Event name or JSON array of event names to export. Leave empty for all events |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_get_export({
  from_date = "2026-01-01",
  to_date = "2026-01-07",
  event = '["Page View","Signup"]'
})

for _, event in ipairs(result.data or {}) do
  print(event.event .. " by " .. (event.distinct_id or "anonymous"))
end
```

---

## mixpanel_list_cohorts

List all behavioural cohorts in the Mixpanel project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Mixpanel project ID. Defaults to the configured project |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_list_cohorts({})

for _, cohort in ipairs(result.data or {}) do
  print(cohort.id .. ": " .. cohort.name .. " (" .. (cohort.count or 0) .. " users)")
end
```

---

## mixpanel_query_jql

Execute a JQL (JavaScript Query Language) script against Mixpanel data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `script` | string | yes | JQL script to execute |
| `params` | string | no | JSON object of parameters to pass into the JQL script (accessible via `params` object) |

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_query_jql({
  script = "Events({from_date: params.from, to_date: params.to}).filter(e => e.name === 'Signup')",
  params = '{"from":"2026-01-01","to":"2026-01-31"}'
})

for _, row in ipairs(result.data or {}) do
  print(row.name .. " at " .. row.time)
end
```

---

## mixpanel_get_current_user

Verify the authenticated user and retrieve basic project info. No parameters required.

### Example

```lua
local result = app.integrations.mixpanel.mixpanel_get_current_user({})

if result.authenticated then
  print("Successfully authenticated with Mixpanel")
end
```

---

## Multi-Account Usage

If you have multiple mixpanel accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mixpanel.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mixpanel.default.function_name({...})

-- Named accounts
app.integrations.mixpanel.work.function_name({...})
app.integrations.mixpanel.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
