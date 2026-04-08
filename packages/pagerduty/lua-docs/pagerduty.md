# PagerDuty — Lua API Reference

## list_incidents

List PagerDuty incidents with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"triggered"`, `"acknowledged"`, or `"resolved"` |
| `urgency` | string | no | Filter by urgency: `"high"` or `"low"` |
| `service_id` | string | no | Filter by service ID |
| `team_id` | string | no | Filter by team ID |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
-- List all triggered incidents
local result = app.integrations.pagerduty.list_incidents({
  status = "triggered"
})

for _, incident in ipairs(result.incidents) do
  print(incident.incident_number .. ": " .. incident.title .. " (" .. incident.status .. ")")
end

-- List high-urgency incidents for a specific service
local result = app.integrations.pagerduty.list_incidents({
  service_id = "PIJ90N7",
  urgency = "high",
  limit = 10
})
```

---

## get_incident

Get full details for a single PagerDuty incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The incident ID (e.g., `"Q02JTSZO2VGFBH"`) |

### Example

```lua
local result = app.integrations.pagerduty.get_incident({
  id = "Q02JTSZO2VGFBH"
})

print("Incident: " .. result.title)
print("Status: " .. result.status)
print("Urgency: " .. result.urgency)
print("Service: " .. (result.service.summary or "unknown"))

for _, assignment in ipairs(result.assignments or {}) do
  print("Assigned to: " .. assignment.assignee.summary)
end
```

---

## list_services

List PagerDuty services with optional team filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Filter services by team ID |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.pagerduty.list_services({
  limit = 50
})

for _, service in ipairs(result.services) do
  print(service.name .. " — status: " .. service.status)
end
```

---

## get_service

Get full details for a single PagerDuty service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The service ID (e.g., `"PIJ90N7"`) |

### Example

```lua
local result = app.integrations.pagerduty.get_service({
  id = "PIJ90N7"
})

print("Service: " .. result.name)
print("Status: " .. result.status)
print("Escalation Policy: " .. (result.escalation_policy.summary or "none"))
```

---

## list_teams

List PagerDuty teams.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.pagerduty.list_teams({
  limit = 50
})

for _, team in ipairs(result.teams) do
  print(team.name .. " — " .. (team.description or "no description"))
end
```

---

## get_team

Get full details for a single PagerDuty team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The team ID (e.g., `"PIMJOGV"`) |

### Example

```lua
local result = app.integrations.pagerduty.get_team({
  id = "PIMJOGV"
})

print("Team: " .. result.name)
print("Description: " .. (result.description or "none"))
print("Default Role: " .. (result.default_role or "none"))
```

---

## get_current_user

Get the authenticated PagerDuty user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.pagerduty.get_current_user({})

print("Logged in as: " .. result.name)
print("Email: " .. result.email)
print("Role: " .. (result.role or "unknown"))
print("Time Zone: " .. (result.time_zone or "unknown"))
```

---

## Multi-Account Usage

If you have multiple PagerDuty accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pagerduty.list_incidents({})

-- Explicit default (portable across setups)
app.integrations.pagerduty.default.list_incidents({})

-- Named accounts
app.integrations.pagerduty.production.list_incidents({})
app.integrations.pagerduty.staging.list_incidents({})
```

All functions are identical across accounts — only the credentials differ.
