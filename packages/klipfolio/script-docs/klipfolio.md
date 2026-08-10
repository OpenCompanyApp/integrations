# Klipfolio — JavaScript API Reference

## list_dashboards

List all dashboards accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of dashboards to return per page (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |

### Example

```js
var result = app.integrations.klipfolio.list_dashboards({
  limit: 10,
  page: 1,
})

for (const dashboard of (result.data.dashboards)) {
  console.log(dashboard.name + " (ID: " + dashboard.id + ")")
}
```
---

## get_dashboard

Get details for a specific Klipfolio dashboard by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique dashboard identifier |

### Example

```js
var result = app.integrations.klipfolio.get_dashboard({
  id: "abc123def456",
})

console.log("Dashboard: " + result.data.name)
console.log("Description: " + (result.data.description || "N/A"))
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

```js
var result = app.integrations.klipfolio.list_metrics({
  limit: 50,
  page: 1,
})

for (const metric of (result.data.metrics)) {
  console.log(metric.name + " (ID: " + metric.id + ")")
}
```
---

## get_metric

Get details for a specific Klipfolio metric by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique metric identifier |

### Example

```js
var result = app.integrations.klipfolio.get_metric({
  id: "metric123",
})

console.log("Metric: " + result.data.name)
console.log("Formula: " + (result.data.formula || "N/A"))
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

```js
var result = app.integrations.klipfolio.list_datasources({
  limit: 25,
  page: 1,
})

for (const ds of (result.data.datasources)) {
  console.log(ds.name + " — " + ds.connector_type + " (ID: " + ds.id + ")")
}
```
---

## get_datasource

Get details for a specific Klipfolio data source by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique data source identifier |

### Example

```js
var result = app.integrations.klipfolio.get_datasource({
  id: "ds789xyz",
})

console.log("Data Source: " + result.data.name)
console.log("Connector: " + result.data.connector_type)
```
---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```js
var result = app.integrations.klipfolio.get_current_user({})

console.log("User: " + result.data.name)
console.log("Email: " + result.data.email)
console.log("Role: " + result.data.role)
```
---

## Multi-Account Usage

If you have multiple Klipfolio accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.klipfolio.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.klipfolio.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.klipfolio.production.function_name({ /* parameters */ })
app.integrations.klipfolio.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
