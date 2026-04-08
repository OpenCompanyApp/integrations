# Klipfolio — Lua API Reference

## list_dashboards

List all dashboards accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of dashboards to return per page (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |

### Example

```lua
local result = app.integrations.klipfolio.list_dashboards({
  limit = 10,
  page = 1
})

for _, dashboard in ipairs(result.data.dashboards) do
  print(dashboard.name .. " (ID: " .. dashboard.id .. ")")
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

```lua
local result = app.integrations.klipfolio.get_dashboard({
  id = "abc123def456"
})

print("Dashboard: " .. result.data.name)
print("Description: " .. (result.data.description or "N/A"))
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

```lua
local result = app.integrations.klipfolio.list_metrics({
  limit = 50,
  page = 1
})

for _, metric in ipairs(result.data.metrics) do
  print(metric.name .. " (ID: " .. metric.id .. ")")
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

```lua
local result = app.integrations.klipfolio.get_metric({
  id = "metric123"
})

print("Metric: " .. result.data.name)
print("Formula: " .. (result.data.formula or "N/A"))
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

```lua
local result = app.integrations.klipfolio.list_datasources({
  limit = 25,
  page = 1
})

for _, ds in ipairs(result.data.datasources) do
  print(ds.name .. " — " .. ds.connector_type .. " (ID: " .. ds.id .. ")")
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

```lua
local result = app.integrations.klipfolio.get_datasource({
  id = "ds789xyz"
})

print("Data Source: " .. result.data.name)
print("Connector: " .. result.data.connector_type)
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.klipfolio.get_current_user({})

print("User: " .. result.data.name)
print("Email: " .. result.data.email)
print("Role: " .. result.data.role)
```

---

## Multi-Account Usage

If you have multiple Klipfolio accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.klipfolio.function_name({...})

-- Explicit default (portable across setups)
app.integrations.klipfolio.default.function_name({...})

-- Named accounts
app.integrations.klipfolio.production.function_name({...})
app.integrations.klipfolio.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
