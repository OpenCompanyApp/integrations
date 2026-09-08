# Datadog — Ruby API Reference

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

```ruby
result = app.integrations.datadog.list_monitors(tags: "env:production")
result.each do |monitor|
  puts((monitor.id).to_s + ": " + (monitor.name).to_s + " [" + (monitor.overall_state).to_s + "]")
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

```ruby
result = app.integrations.datadog.get_monitor(monitor_id: 12345)
puts("Name: " + (result.name).to_s)
puts("Query: " + (result.query).to_s)
puts("State: " + (result.overall_state).to_s)
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

```ruby
result = app.integrations.datadog.create_monitor(type: "metric alert", query: "avg(last_5m):avg:system.cpu.user{env:production} > 90", name: "High CPU on Production", message: "CPU is above 90% on {{host.name}} @slack-alerts", priority: 2, options: "{\"thresholds\":{\"critical\":90,\"warning\":80},\"notify_no_data\":true}", tags: ["env:production", "team:infra"])
puts("Created monitor ID: " + (result.id).to_s)
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

```ruby
result = app.integrations.datadog.update_monitor(monitor_id: 12345, query: "avg(last_5m):avg:system.cpu.user{env:production} > 95", message: "CPU critical! @pagerduty-production")
puts("Updated monitor: " + (result.name).to_s)
```
---

## delete_monitor

Delete a monitor permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The monitor ID to delete |

### Example

```ruby
result = app.integrations.datadog.delete_monitor(monitor_id: 12345)
puts(result)
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

```ruby
# Explicit example timestamp. Supply an appropriate timestamp as data; there is no ambient clock.
example_unix_seconds = 1767225600
result = app.integrations.datadog.query_metrics(from: ((((example_unix_seconds * 1000) / 1000)).floor - 3600), to: (((example_unix_seconds * 1000) / 1000)).floor, query: "avg:system.cpu.user{env:production} by {host}")
if result.series
  result.series.each do |series|
    puts("Host: " + ((series.scope || "unknown")).to_s)
    puts("  Points: " + (series.pointlist.length).to_s)
  end
end
```
---

## list_dashboards

List all Datadog dashboards.

### Parameters

None.

### Example

```ruby
result = app.integrations.datadog.list_dashboards()
(result.dashboards || []).each do |dashboard|
  puts((dashboard.id).to_s + ": " + (dashboard.title).to_s)
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

```ruby
result = app.integrations.datadog.get_dashboard(dashboard_id: "abc-123-def")
puts("Title: " + (result.title).to_s)
puts("Widgets: " + ((result.widgets || {}).length).to_s)
(result.widgets || []).each do |widget|
  puts("  - " + ((widget.definition.title || "Untitled")).to_s)
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

```ruby
result = app.integrations.datadog.post_event(title: "Deployment completed", text: "Version 2.1.0 deployed to production successfully.", priority: "normal", tags: ["env:production", "source:deploy"], alert_type: "success")
puts("Event URL: " + ((result.url || "created")).to_s)
```
---

## get_current_user

Get the currently authenticated Datadog user.

### Parameters

None.

### Example

```ruby
result = app.integrations.datadog.get_current_user()
puts("User: " + ((result.handle || "unknown")).to_s)
puts("Name: " + ((result.name || "unknown")).to_s)
puts("Email: " + ((result.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Datadog accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.datadog.list_monitors()
# Explicit default (portable across setups)
app.integrations.datadog.default.list_monitors()
# Named accounts
app.integrations.datadog.production.list_monitors()
app.integrations.datadog.staging.list_monitors()
```
All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Check for alerting monitors

```ruby
monitors = app.integrations.datadog.list_monitors(tags: "env:production")
alerting = []
monitors.each do |m|
  if (m.overall_state == "Alert")
    alerting.push(m)
  end
end
if (alerting.length > 0)
  puts((alerting.length).to_s + " monitors are alerting!")
  alerting.each do |m|
    puts("  - " + (m.name).to_s)
  end
else
  puts("All monitors OK")
end
```
### Query CPU and post event if high

```ruby
# Explicit example timestamp. Supply an appropriate timestamp as data; there is no ambient clock.
example_unix_seconds = 1767225600
result = app.integrations.datadog.query_metrics(from: ((((example_unix_seconds * 1000) / 1000)).floor - 300), to: (((example_unix_seconds * 1000) / 1000)).floor, query: "avg:system.cpu.user{env:production}")
if (result.series && (result.series.length > 0))
  last_point = result.series[0].pointlist[result.series.length[0].pointlist]
  if (last_point && (last_point[1] > 80))
    app.integrations.datadog.post_event(title: "High CPU Alert", text: "CPU is at " + (last_point[1]).to_s + "%", alert_type: "warning", tags: ["env:production", "severity:high"])
  end
end
```