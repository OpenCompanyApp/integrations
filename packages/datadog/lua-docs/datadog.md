# Datadog — Lua API Reference

## list_monitors

List Datadog monitors with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter monitors by name (substring match) |
| `tags` | string | no | Comma-separated tags (e.g., `"env:production,service:api"`) |
| `page` | integer | no | Page number for pagination (default: 0) |
| `page_size` | integer | no | Results per page (default: 30) |

### Example

```lua
local result = app.integrations.datadog.list_monitors({
  tags = "env:production"
})

for _, monitor in ipairs(result) do
  print(monitor.id .. ": " .. monitor.name .. " [" .. monitor.overall_state .. "]")
end
```

---

## get_monitor

Get full details of a specific monitor.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The monitor ID |

### Example

```lua
local result = app.integrations.datadog.get_monitor({
  monitor_id = 12345
})

print("Name: " .. result.name)
print("Query: " .. result.query)
print("State: " .. result.overall_state)
```

---

## create_monitor

Create a new Datadog monitor.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Monitor type: `"metric alert"`, `"service check"`, `"event alert"`, `"query alert"`, `"composite"`, `"log alert"`, `"rum alert"` |
| `query` | string | yes | Monitor query (e.g., `"avg(last_5m):avg:system.cpu.user{host:my-host} > 90"`) |
| `name` | string | no | Display name |
| `message` | string | no | Notification message (supports `@mention` syntax) |
| `priority` | integer | no | Priority level (1-5, where 1 is highest) |
| `options` | object | no | JSON-encoded options: thresholds, notify_no_data, no_data_timeframe, etc. |
| `tags` | array | no | Tags (e.g., `{"env:production", "service:api"}`) |

### Monitor Options (JSON)

Common options for metric alert thresholds:

```json
{
  "thresholds": {
    "critical": 90,
    "warning": 80,
    "critical_recovery": 85,
    "warning_recovery": 75
  },
  "notify_no_data": true,
  "no_data_timeframe": 10,
  "renotify_interval": 60
}
```

### Example

```lua
local result = app.integrations.datadog.create_monitor({
  type = "metric alert",
  query = "avg(last_5m):avg:system.cpu.user{env:production} > 90",
  name = "High CPU on Production",
  message = "CPU is above 90% on {{host.name}} @slack-alerts",
  priority = 2,
  options = '{"thresholds":{"critical":90,"warning":80},"notify_no_data":true}',
  tags = {"env:production", "team:infra"}
})

print("Created monitor ID: " .. result.id)
```

---

## update_monitor

Update an existing monitor.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The monitor ID |
| `type` | string | no | Updated monitor type |
| `query` | string | no | Updated query |
| `name` | string | no | Updated name |
| `message` | string | no | Updated message |
| `priority` | integer | no | Updated priority |
| `options` | object | no | Updated options (JSON) |
| `tags` | array | no | Updated tags |

### Example

```lua
local result = app.integrations.datadog.update_monitor({
  monitor_id = 12345,
  query = "avg(last_5m):avg:system.cpu.user{env:production} > 95",
  message = "CPU critical! @pagerduty-production"
})

print("Updated monitor: " .. result.name)
```

---

## delete_monitor

Delete a monitor permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The monitor ID to delete |

### Example

```lua
local result = app.integrations.datadog.delete_monitor({
  monitor_id = 12345
})

print(result)  -- "Monitor 12345 has been deleted."
```

---

## query_metrics

Query Datadog metrics for a given time range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | integer | yes | Start time as Unix timestamp (seconds) |
| `to` | integer | yes | End time as Unix timestamp (seconds) |
| `query` | string | yes | Datadog metric query string |

### Query Syntax

```
aggregation:metric.name{filter} by {grouping}
```

- **Aggregation**: `avg`, `max`, `min`, `sum`, `count`
- **Filter**: tag-based (e.g., `{env:production,service:api}`)
- **Grouping**: `by {host}`, `by {region}`, etc.

### Example

```lua
local result = app.integrations.datadog.query_metrics({
  from = os.time() - 3600,  -- 1 hour ago
  to = os.time(),            -- now
  query = "avg:system.cpu.user{env:production} by {host}"
})

if result.series then
  for _, series in ipairs(result.series) do
    print("Host: " .. (series.scope or "unknown"))
    print("  Points: " .. #series.pointlist)
  end
end
```

---

## list_dashboards

List all Datadog dashboards.

### Parameters

None.

### Example

```lua
local result = app.integrations.datadog.list_dashboards({})

for _, dashboard in ipairs(result.dashboards or {}) do
  print(dashboard.id .. ": " .. dashboard.title)
end
```

---

## get_dashboard

Get full details of a specific dashboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dashboard_id` | string | yes | The dashboard ID |

### Example

```lua
local result = app.integrations.datadog.get_dashboard({
  dashboard_id = "abc-123-def"
})

print("Title: " .. result.title)
print("Widgets: " .. #(result.widgets or {}))

for _, widget in ipairs(result.widgets or {}) do
  print("  - " .. (widget.definition.title or "Untitled"))
end
```

---

## post_event

Post an event to the Datadog event stream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Event title |
| `text` | string | yes | Event body (supports Markdown) |
| `priority` | string | no | `"normal"` or `"low"` (default: `"normal"`) |
| `tags` | array | no | Tags (e.g., `{"env:production"}`) |
| `alert_type` | string | no | `"info"`, `"warning"`, `"error"`, or `"success"` (default: `"info"`) |
| `date_happened` | integer | no | Unix timestamp (default: now) |
| `source_type_name` | string | no | Source type (e.g., `"my_app"`) |
| `host` | string | no | Associated host name |
| `aggregation_key` | string | no | Key to group related events |

### Example

```lua
local result = app.integrations.datadog.post_event({
  title = "Deployment completed",
  text = "Version 2.1.0 deployed to production successfully.",
  priority = "normal",
  tags = {"env:production", "source:deploy"},
  alert_type = "success"
})

print("Event URL: " .. (result.url or "created"))
```

---

## get_current_user

Get the currently authenticated Datadog user.

### Parameters

None.

### Example

```lua
local result = app.integrations.datadog.get_current_user({})

print("User: " .. (result.handle or "unknown"))
print("Name: " .. (result.name or "unknown"))
print("Email: " .. (result.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Datadog accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.datadog.list_monitors({})

-- Explicit default (portable across setups)
app.integrations.datadog.default.list_monitors({})

-- Named accounts
app.integrations.datadog.production.list_monitors({})
app.integrations.datadog.staging.list_monitors({})
```

All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Check for alerting monitors

```lua
local monitors = app.integrations.datadog.list_monitors({
  tags = "env:production"
})

local alerting = {}
for _, m in ipairs(monitors) do
  if m.overall_state == "Alert" then
    table.insert(alerting, m)
  end
end

if #alerting > 0 then
  print(#alerting .. " monitors are alerting!")
  for _, m in ipairs(alerting) do
    print("  - " .. m.name)
  end
else
  print("All monitors OK")
end
```

### Query CPU and post event if high

```lua
local result = app.integrations.datadog.query_metrics({
  from = os.time() - 300,
  to = os.time(),
  query = "avg:system.cpu.user{env:production}"
})

if result.series and #result.series > 0 then
  local last_point = result.series[1].pointlist[#result.series[1].pointlist]
  if last_point and last_point[2] > 80 then
    app.integrations.datadog.post_event({
      title = "High CPU Alert",
      text = "CPU is at " .. last_point[2] .. "%",
      alert_type = "warning",
      tags = {"env:production", "severity:high"}
    })
  end
end
```
