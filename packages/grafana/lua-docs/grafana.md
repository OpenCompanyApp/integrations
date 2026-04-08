# Grafana — Lua API Reference

## list_dashboards

Search and list Grafana dashboards.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter dashboards by title |
| `type` | string | no | Dashboard type filter (default: `"dash-db"`) |
| `limit` | integer | no | Maximum number of results (default: 100) |

### Examples

```lua
-- List all dashboards
local result = app.integrations.grafana.list_dashboards({})

for _, dash in ipairs(result) do
  print(dash.title .. " (uid: " .. dash.uid .. ")")
end

-- Search for specific dashboards
local result = app.integrations.grafana.list_dashboards({
  query = "infrastructure"
})
```

---

## get_dashboard

Get a Grafana dashboard by its UID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uid` | string | yes | The unique identifier (UID) of the dashboard |

### Example

```lua
local result = app.integrations.grafana.get_dashboard({
  uid = "abc123xyz"
})

print("Dashboard: " .. result.dashboard.title)
print("Panels: " .. #result.dashboard.panels)
```

---

## create_dashboard

Create or update a Grafana dashboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dashboard` | object | yes | Complete dashboard JSON (must include `title`) |
| `folderUid` | string | no | UID of the folder to place the dashboard in |
| `overwrite` | boolean | no | Overwrite existing dashboard with same slug (default: false) |

### Example

```lua
local result = app.integrations.grafana.create_dashboard({
  dashboard = {
    title = "My New Dashboard",
    panels = {}
  },
  overwrite = false
})

print("Created dashboard: " .. result.url)
print("UID: " .. result.uid)
```

---

## list_datasources

List all configured datasources.

### Parameters

None.

### Example

```lua
local result = app.integrations.grafana.list_datasources({})

for _, ds in ipairs(result) do
  print(ds.name .. " (" .. ds.type .. ") — id: " .. ds.id)
end
```

---

## list_alerts

List Grafana alerts with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dashboardId` | integer | no | Filter alerts by dashboard ID |
| `panelId` | integer | no | Filter alerts by panel ID |

### Example

```lua
-- List all alerts
local result = app.integrations.grafana.list_alerts({})

for _, alert in ipairs(result) do
  print(alert.name .. " — state: " .. alert.state)
end

-- Filter by dashboard
local result = app.integrations.grafana.list_alerts({
  dashboardId = 42
})
```

---

## list_teams

List all Grafana teams with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `perPage` | integer | no | Number of teams per page (default: 50) |

### Example

```lua
local result = app.integrations.grafana.list_teams({
  page = 1,
  perPage = 20
})

for _, team in ipairs(result) do
  print(team.name .. " — " .. team.memberCount .. " members")
end
```

---

## get_current_user

Get the currently authenticated Grafana user. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.grafana.get_current_user({})

print("User: " .. result.name)
print("Login: " .. result.login)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Grafana instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.grafana.list_dashboards({})

-- Explicit default (portable across setups)
app.integrations.grafana.default.list_dashboards({})

-- Named accounts
app.integrations.grafana.production.list_dashboards({})
app.integrations.grafana.staging.list_dashboards({})
```

All functions are identical across accounts — only the credentials differ.
