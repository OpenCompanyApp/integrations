# Datadog — Lua API Reference

## datadog_create_monitor

Create a new Datadog monitor. Specify the monitor type, query, name, and optional message and thresholds. Common types:.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Monitor type:  |
| `query` | string | yes | The monitor query (e.g.,  |
| `name` | string | no | Display name for the monitor. |
| `message` | string | no | Notification message. Supports @mention syntax (e.g.,  |
| `priority` | integer | no | Monitor priority level (1-5, where 1 is highest). |
| `options` | int | no | JSON-encoded monitor options: thresholds, notify_no_data, no_data_timeframe, renotify_interval, escalation_message, etc. |
| `tags` | array | no | List of tags to assign to the monitor (e.g., [ |

### Example

```lua
local result = app.integrations.datadog.datadog_create_monitor({
  type = ""
  query = ""
  name = ""
})
```

## datadog_delete_monitor

Delete a Datadog monitor by ID. This action is permanent and cannot be undone..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The ID of the monitor to delete. |

### Example

```lua
local result = app.integrations.datadog.datadog_delete_monitor({
  monitor_id = 0
})
```

## datadog_get_dashboard

Get full details of a specific Datadog dashboard by ID. Returns the dashboard layout, widgets, and template variables..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dashboard_id` | string | yes | The ID of the dashboard to retrieve. |

### Example

```lua
local result = app.integrations.datadog.datadog_get_dashboard({
  dashboard_id = ""
})
```

## datadog_get_monitor

Get full details of a specific Datadog monitor by ID. Returns the monitor query, thresholds, message, and current state..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The ID of the monitor to retrieve. |

### Example

```lua
local result = app.integrations.datadog.datadog_get_monitor({
  monitor_id = 0
})
```

## datadog_list_dashboards

List all Datadog dashboards. Returns dashboard IDs, titles, descriptions, and modification dates..

### Example

```lua
local result = app.integrations.datadog.datadog_list_dashboards({
})
```

## datadog_list_monitors

List Datadog monitors. Optionally filter by name or tags. Returns monitor IDs, names, types, states, and query definitions..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter monitors by name (substring match). |
| `tags` | string | no | Comma-separated list of tags to filter by (e.g.,  |
| `page` | integer | no | Page number for pagination (default: 0). |
| `page_size` | integer | no | Number of monitors per page (default: 30). |

### Example

```lua
local result = app.integrations.datadog.datadog_list_monitors({
  name = ""
  tags = ""
  page = 0
})
```

## datadog_query_metrics

Query Datadog metrics between two timestamps. Use Datadog query syntax (e.g.,.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | integer | yes | Start time as Unix timestamp in seconds (e.g., 1710000000). Use current time minus seconds for relative ranges. |
| `to` | integer | yes | End time as Unix timestamp in seconds. Use current time for  |
| `query` | string | yes | Datadog metric query string (e.g.,  |

### Example

```lua
local result = app.integrations.datadog.datadog_query_metrics({
  from = 0
  to = 0
  query = ""
})
```

## datadog_update_monitor

Update an existing Datadog monitor. Provide the monitor ID and the fields to update (name, query, message, options, tags, etc.)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `monitor_id` | integer | yes | The ID of the monitor to update. |
| `type` | string | no | Updated monitor type. |
| `query` | string | no | Updated monitor query. |
| `name` | string | no | Updated display name. |
| `message` | string | no | Updated notification message. |
| `priority` | integer | no | Updated priority level (1-5). |
| `options` | string | no | JSON-encoded monitor options (thresholds, notify_no_data, etc.). |
| `tags` | array | no | Updated list of tags. |

### Example

```lua
local result = app.integrations.datadog.datadog_update_monitor({
  monitor_id = 0
  type = ""
  query = ""
})
```
