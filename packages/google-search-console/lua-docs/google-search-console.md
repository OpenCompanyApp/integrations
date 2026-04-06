# Google Search Console — Lua API Reference

## list_sites

List sites the authenticated user has access to in Google Search Console.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Maximum number of results per page |
| `pageToken` | string | no | Token for the next page of results |

### Examples

```lua
local result = app.integrations["google-search-console"].list_sites({})

for _, site in ipairs(result.sites) do
  print(site.siteUrl .. " — " .. site.permissionLevel)
end
```

---

## get_site

Get details for a specific site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The site URL (e.g., `"https://example.com/"`) |

### Examples

```lua
local result = app.integrations["google-search-console"].get_site({
  id = "https://example.com/"
})

print(result.siteUrl .. " — " .. result.permissionLevel)
```

---

## list_sitemaps

List sitemaps submitted for a site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_url` | string | yes | The site URL |
| `pageSize` | integer | no | Maximum number of results per page |
| `pageToken` | string | no | Token for the next page of results |
| `shortUrls` | boolean | no | Whether to return short URLs |

### Examples

```lua
local result = app.integrations["google-search-console"].list_sitemaps({
  site_url = "https://example.com/"
})

for _, sitemap in ipairs(result.sitemaps) do
  print(sitemap.path .. " — " .. (sitemap.lastSubmitted or "N/A"))
end
```

---

## get_sitemap

Get details for a specific sitemap.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_url` | string | yes | The site URL |
| `id` | string | yes | The sitemap URL or ID |

### Examples

```lua
local result = app.integrations["google-search-console"].get_sitemap({
  site_url = "https://example.com/",
  id = "https://example.com/sitemap.xml"
})

print(result.path .. " — Errors: " .. (result.errors or 0))
```

---

## list_search_analytics

Query search performance data — clicks, impressions, CTR, and average position.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_url` | string | yes | The site URL |
| `startDate` | string | yes | Start date (YYYY-MM-DD) |
| `endDate` | string | yes | End date (YYYY-MM-DD) |
| `dimensions` | array | no | Dimensions to group by: `"query"`, `"page"`, `"country"`, `"device"`, `"searchAppearance"` |
| `type` | string | no | Search type: `"web"`, `"image"`, `"video"`, `"news"` |

### Examples

#### Top queries by clicks

```lua
local result = app.integrations["google-search-console"].list_search_analytics({
  site_url = "https://example.com/",
  startDate = "2025-01-01",
  endDate = "2025-01-31",
  dimensions = {"query"}
})

for _, row in ipairs(result.rows) do
  print(row.keys[1] .. ": " .. row.clicks .. " clicks, position " .. row.position)
end
```

#### Top pages with device breakdown

```lua
local result = app.integrations["google-search-console"].list_search_analytics({
  site_url = "https://example.com/",
  startDate = "2025-01-01",
  endDate = "2025-01-31",
  dimensions = {"page", "device"}
})
```

#### Image search performance

```lua
local result = app.integrations["google-search-console"].list_search_analytics({
  site_url = "https://example.com/",
  startDate = "2025-01-01",
  endDate = "2025-01-31",
  dimensions = {"query"},
  type = "image"
})
```

---

## list_url_inspection

Inspect URLs for indexing status and issues.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_url` | string | yes | The site URL |
| `pageToken` | string | no | Token for the next page of results |
| `limit` | integer | no | Maximum number of results |
| `inspectionResult` | string | no | Filter by status: `"PASS"`, `"FAIL"`, `"WARNING"` |

### Examples

```lua
local result = app.integrations["google-search-console"].list_url_inspection({
  site_url = "https://example.com/"
})

for _, item in ipairs(result.results or {}) do
  print(item.url .. " — " .. item.inspectionResult)
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations["google-search-console"].get_current_user({})
print("Authenticated as: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Google Search Console accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["google-search-console"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["google-search-console"].default.function_name({...})

-- Named accounts
app.integrations["google-search-console"].work.function_name({...})
app.integrations["google-search-console"].client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
