# Ahrefs — Lua API Reference

## list_backlinks

List backlinks pointing to a target website or URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain (e.g., `"example.com"`) |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip for pagination (default: 0) |
| `mode` | string | no | Target mode: `"domain"`, `"subdomain"`, `"exact"`, `"prefix"` (default: `"domain"`) |

### Target Modes

| Mode | Description |
|------|-------------|
| `domain` | Match all subdomains of the domain (e.g., `example.com` matches `www.example.com`, `blog.example.com`) |
| `subdomain` | Match a specific subdomain (e.g., `blog.example.com`) |
| `exact` | Match the exact URL |
| `prefix` | Match all URLs starting with the given prefix |

### Example

```lua
local result = app.integrations.ahrefs.list_backlinks({
  target = "example.com",
  limit = 50,
  mode = "domain"
})

for _, link in ipairs(result.backlinks or {}) do
  print(link.url_from .. " -> " .. link.url_to)
end
```

---

## list_referring_domains

List domains that link to a target.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip (default: 0) |
| `mode` | string | no | Target mode (default: `"domain"`) |

### Example

```lua
local result = app.integrations.ahrefs.list_referring_domains({
  target = "example.com",
  limit = 20
})

for _, domain in ipairs(result.referring_domains or {}) do
  print(domain.domain .. " (DR: " .. (domain.domain_rating or "N/A") .. ")")
end
```

---

## list_organic_keywords

List organic keywords a target ranks for in search results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip (default: 0) |
| `mode` | string | no | Target mode (default: `"domain"`) |

### Example

```lua
local result = app.integrations.ahrefs.list_organic_keywords({
  target = "example.com",
  limit = 30,
  mode = "domain"
})

for _, kw in ipairs(result.keywords or {}) do
  print(kw.keyword .. " — pos: " .. kw.position .. ", vol: " .. kw.volume)
end
```

---

## list_pages

List top pages for a target website.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip (default: 0) |
| `mode` | string | no | Target mode (default: `"domain"`) |

### Example

```lua
local result = app.integrations.ahrefs.list_pages({
  target = "example.com",
  limit = 20
})

for _, page in ipairs(result.pages or {}) do
  print(page.url .. " — traffic: " .. page.traffic)
end
```

---

## list_paid_keywords

List paid (PPC) keywords a target bids on.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip (default: 0) |

### Example

```lua
local result = app.integrations.ahrefs.list_paid_keywords({
  target = "example.com",
  limit = 20
})

for _, kw in ipairs(result.keywords or {}) do
  print(kw.keyword .. " — CPC: $" .. kw.cpc)
end
```

---

## list_anchors

List anchor texts used in backlinks to a target.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target` | string | yes | Target URL or domain |
| `limit` | integer | no | Max results (default: 100) |
| `offset` | integer | no | Results to skip (default: 0) |

### Example

```lua
local result = app.integrations.ahrefs.list_anchors({
  target = "example.com",
  limit = 30
})

for _, anchor in ipairs(result.anchors or {}) do
  print(anchor.anchor .. " — refpages: " .. anchor.refpages)
end
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.ahrefs.get_current_user({})
print("Logged in as: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Ahrefs accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ahrefs.function_name({...})

-- Explicit default (portable across setups)
app.integrations.ahrefs.default.function_name({...})

-- Named accounts
app.integrations.ahrefs.work.function_name({...})
app.integrations.ahrefs.client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
