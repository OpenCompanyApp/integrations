# Klipfolio — Ruby API Reference

## list_dashboards

List all dashboards accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of dashboards to return per page (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |

### Example

```ruby
result = app.integrations.klipfolio.list_dashboards(limit: 10, page: 1)
result.data.dashboards.each do |dashboard|
  puts((dashboard.name).to_s + " (ID: " + (dashboard.id).to_s + ")")
end
```
---

## get_dashboard

Get details for a specific Klipfolio dashboard by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique dashboard identifier |

### Example

```ruby
result = app.integrations.klipfolio.get_dashboard(id: "abc123def456")
puts("Dashboard: " + (result.data.name).to_s)
puts("Description: " + ((result.data.description || "N/A")).to_s)
```
---

## list_metrics

List all metrics accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of metrics to return per page (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |

### Example

```ruby
result = app.integrations.klipfolio.list_metrics(limit: 50, page: 1)
result.data.metrics.each do |metric|
  puts((metric.name).to_s + " (ID: " + (metric.id).to_s + ")")
end
```
---

## get_metric

Get details for a specific Klipfolio metric by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique metric identifier |

### Example

```ruby
result = app.integrations.klipfolio.get_metric(id: "metric123")
puts("Metric: " + (result.data.name).to_s)
puts("Formula: " + ((result.data.formula || "N/A")).to_s)
```
---

## list_datasources

List all data sources accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of data sources to return per page (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |

### Example

```ruby
result = app.integrations.klipfolio.list_data_sources(limit: 25, page: 1)
result.data.datasources.each do |ds|
  puts((ds.name).to_s + " — " + (ds.connector_type).to_s + " (ID: " + (ds.id).to_s + ")")
end
```
---

## get_datasource

Get details for a specific Klipfolio data source by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique data source identifier |

### Example

```ruby
result = app.integrations.klipfolio.get_data_source(id: "ds789xyz")
puts("Data Source: " + (result.data.name).to_s)
puts("Connector: " + (result.data.connector_type).to_s)
```
---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```ruby
result = app.integrations.klipfolio.get_current_user()
puts("User: " + (result.data.name).to_s)
puts("Email: " + (result.data.email).to_s)
puts("Role: " + (result.data.role).to_s)
```
---

## Multi-Account Usage

If you have multiple Klipfolio accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
