# PagerDuty — Lua API Reference

## pagerduty_list_incidents

List PagerDuty incidents with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of incidents to return (1–100, default 25). |
| `offset` | integer | no | Offset for pagination (default 0). |
| `status` | array | no | Filter by incident status. Values: `"triggered"`, `"acknowledged"`, `"resolved"`. |
| `service_ids` | array | no | Filter by service IDs (array of service ID strings). |
| `urgency` | string | no | Filter by urgency. Values: `"high"`, `"low"`. |

## pagerduty_get_incident

Get detailed information about a PagerDuty incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | PagerDuty incident ID (e.g., `"Q02JFSRXI65D55"`). |

## pagerduty_update_incident

Update a PagerDuty incident (status, priority, resolution).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `incident_id` | string | yes | The PagerDuty incident ID. |
| `status` | string | no | New status: `"triggered"`, `"acknowledged"`, or `"resolved"`. |
| `priority` | string | no | Priority ID to assign to the incident. |
| `resolution` | string | no | Resolution note to add when resolving the incident. |

## pagerduty_create_incident_note

Add a note to a PagerDuty incident.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `incident_id` | string | yes | The PagerDuty incident ID. |
| `content` | string | yes | The note content. |

## pagerduty_list_services

List PagerDuty services.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of services to return (1–100, default 25). |
| `offset` | integer | no | Offset for pagination (default 0). |
| `team_ids` | array | no | Filter by team IDs (array of team ID strings). |

## pagerduty_get_service

Get detailed information about a PagerDuty service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | PagerDuty service ID (e.g., `"PIJ90N7"`). |

## pagerduty_list_teams

List PagerDuty teams.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of teams to return (1–100, default 25). |
| `offset` | integer | no | Offset for pagination (default 0). |

## pagerduty_list_users

List PagerDuty users.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users to return (1–100, default 25). |
| `offset` | integer | no | Offset for pagination (default 0). |
| `team_ids` | array | no | Filter by team IDs (array of team ID strings). |

## pagerduty_get_user

Get detailed information about a PagerDuty user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | PagerDuty user ID (e.g., `"PXPGF42"`). |

## pagerduty_list_on_calls

List current PagerDuty on-call entries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of on-call entries to return (1–100, default 25). |
| `escalation_policy_ids` | array | no | Filter by escalation policy IDs (array of escalation policy ID strings). |

## Examples

### List triggered incidents

```lua
local result = app.integrations.pagerduty.pagerduty_list_incidents({
  status = {"triggered"},
  limit = 10
})
for _, incident in ipairs(result.incidents) do
  print(incident.id .. ": " .. incident.title)
end
```

### Resolve an incident

```lua
local result = app.integrations.pagerduty.pagerduty_update_incident({
  incident_id = "Q02JFSRXI65D55",
  status = "resolved",
  resolution = "Issue resolved by restarting the service."
})
```

### Add a note to an incident

```lua
local result = app.integrations.pagerduty.pagerduty_create_incident_note({
  incident_id = "Q02JFSRXI65D55",
  content = "Investigating the root cause of the memory spike."
})
```

### List on-call entries

```lua
local result = app.integrations.pagerduty.pagerduty_list_on_calls({
  limit = 25
})
for _, entry in ipairs(result.oncalls) do
  print(entry.user.name .. " - " .. entry.escalation_policy.name)
end
```
