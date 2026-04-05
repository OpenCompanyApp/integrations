# Fathom Analytics — Lua API Reference

## list_sites

List all websites tracked in Fathom Analytics.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sites to return (default: 20) |
| `starting_after` | integer | no | Cursor for pagination — pass the ID of the last site from a previous response |

### Example

```lua
local result = app.integrations.fathom.list_sites({limit = 10})

for _, site in ipairs(result.data) do
  print(site.name .. " (" .. site.domain .. ") — ID: " .. site.id)
end
```

---

## get_site

Get details for a specific Fathom site by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Fathom site ID (e.g., `"CDCLS"`) |

### Example

```lua
local result = app.integrations.fathom.get_site({site_id = "CDCLS"})
print("Site: " .. result.name .. " — " .. result.domain)
```

---

## list_pageviews

List pageviews for a site with date filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Fathom site ID |
| `date_from` | string | no | Start date (ISO 8601, e.g., `"2025-01-01"`) |
| `date_to` | string | no | End date (ISO 8601, e.g., `"2025-01-31"`) |
| `limit` | integer | no | Maximum number of pageviews to return (default: 20) |
| `starting_after` | integer | no | Cursor for pagination — pass the ID of the last pageview |

### Example

```lua
local result = app.integrations.fathom.list_pageviews({
  site_id = "CDCLS",
  date_from = "2025-01-01",
  date_to = "2025-01-31",
  limit = 50
})

for _, pv in ipairs(result.data) do
  print(pv.page_path .. " — " .. pv.created_at)
end
```

---

## get_aggregate

Get aggregated analytics data for a site. Supports grouping by dimensions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Fathom site ID |
| `date_from` | string | yes | Start date (ISO 8601) |
| `date_to` | string | yes | End date (ISO 8601) |
| `metrics` | string | no | Comma-separated metrics: `pageviews`, `visits`, `visitors`, `bounce_rate`, `visit_duration` |
| `group_by` | string | no | Group by dimension: `page_hostname`, `page_path`, `referrer_hostname`, `referrer_path`, `country`, `browser`, `device_type`, `os`, `query_param` |
| `sort_by` | string | no | Sort field and direction, e.g., `"pageviews:desc"`, `"visitors:asc"` |
| `limit` | integer | no | Maximum number of grouped results |

### Available Metrics

| Metric | Description |
|--------|-------------|
| `pageviews` | Total pageviews |
| `visits` | Total visits (sessions) |
| `visitors` | Unique visitors |
| `bounce_rate` | Bounce rate percentage |
| `visit_duration` | Average visit duration in seconds |

### Available Group-By Dimensions

| Dimension | Description |
|-----------|-------------|
| `page_hostname` | Domain name |
| `page_path` | URL path (e.g., `/blog/post-1`) |
| `referrer_hostname` | Referrer domain |
| `referrer_path` | Referrer path |
| `country` | Country code |
| `browser` | Browser name |
| `device_type` | Device type (Desktop, Mobile, Tablet) |
| `os` | Operating system |
| `query_param` | Query parameter values |

### Examples

#### Overall site metrics

```lua
local result = app.integrations.fathom.get_aggregate({
  site_id = "CDCLS",
  date_from = "2025-01-01",
  date_to = "2025-01-31",
  metrics = "pageviews,visits,visitors,bounce_rate"
})

print("Pageviews: " .. result.pageviews)
print("Visitors: " .. result.visitors)
print("Bounce rate: " .. result.bounce_rate .. "%")
```

#### Top pages by pageviews

```lua
local result = app.integrations.fathom.get_aggregate({
  site_id = "CDCLS",
  date_from = "2025-01-01",
  date_to = "2025-01-31",
  metrics = "pageviews,visitors",
  group_by = "page_path",
  sort_by = "pageviews:desc",
  limit = 10
})

for _, row in ipairs(result.data) do
  print(row.page_path .. ": " .. row.pageviews .. " pageviews, " .. row.visitors .. " visitors")
end
```

#### Traffic by country

```lua
local result = app.integrations.fathom.get_aggregate({
  site_id = "CDCLS",
  date_from = "2025-01-01",
  date_to = "2025-01-31",
  metrics = "visitors,pageviews",
  group_by = "country",
  sort_by = "visitors:desc",
  limit = 10
})

for _, row in ipairs(result.data) do
  print(row.country .. ": " .. row.visitors .. " visitors")
end
```

#### Traffic by device type

```lua
local result = app.integrations.fathom.get_aggregate({
  site_id = "CDCLS",
  date_from = "2025-01-01",
  date_to = "2025-01-31",
  metrics = "visits,bounce_rate",
  group_by = "device_type"
})

for _, row in ipairs(result.data) do
  print(row.device_type .. ": " .. row.visits .. " visits, " .. row.bounce_rate .. "% bounce")
end
```

---

## list_events

List custom events tracked for a site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Fathom site ID |
| `limit` | integer | no | Maximum number of events to return (default: 20) |
| `starting_after` | integer | no | Cursor for pagination — pass the ID of the last event |

### Example

```lua
local result = app.integrations.fathom.list_events({
  site_id = "CDCLS",
  limit = 50
})

for _, event in ipairs(result.data) do
  print(event.name .. " — ID: " .. event.id)
end
```

---

## get_current_user

Get the currently authenticated Fathom user profile. Useful for verifying API connectivity.

### Parameters

None.

### Example

```lua
local result = app.integrations.fathom.get_current_user({})
print("Logged in as: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Fathom accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.fathom.function_name({...})

-- Explicit default (portable across setups)
app.integrations.fathom.default.function_name({...})

-- Named accounts
app.integrations.fathom.work.function_name({...})
app.integrations.fathom.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
