# Brandfetch — Lua API Reference

## get_brand

Look up a brand by its domain to retrieve logos, colors, fonts, and other brand assets.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The brand domain (e.g., `"spotify.com"`, `"nike.com"`) |

### Example

```lua
local result = app.integrations.brandfetch.get_brand({
  domain = "spotify.com"
})

-- Access brand data
print(result.name)        -- "Spotify"
print(result.domain)      -- "spotify.com"

-- Logos
for _, logo in ipairs(result.logos or {}) do
  print(logo.url, logo.format, logo.theme)
end

-- Colors
for _, color in ipairs(result.colors or {}) do
  print(color.hex, color.type)
end

-- Fonts
for _, font in ipairs(result.fonts or {}) do
  print(font.name, font.weight)
end
```

---

## search_brands

Search for brands by name or domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search term — brand name or domain |
| `limit` | integer | no | Maximum number of results |

### Example

```lua
local result = app.integrations.brandfetch.search_brands({
  query = "Nike",
  limit = 5
})

for _, brand in ipairs(result.brands or result or {}) do
  print(brand.name, brand.domain, brand.brand_id)
end
```

---

## list_logos

List all logo variants available for a brand.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `brand_id` | string | yes | The brand identifier from a search or lookup |
| `limit` | integer | no | Maximum number of logos to return |

### Example

```lua
local result = app.integrations.brandfetch.list_logos({
  brand_id = "brand_abc123",
  limit = 10
})

for _, logo in ipairs(result.logos or result or {}) do
  print(logo.id, logo.url, logo.format, logo.theme)
end
```

---

## get_logo

Get a single logo by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique logo identifier |

### Example

```lua
local result = app.integrations.brandfetch.get_logo({
  id = "logo_xyz789"
})

print(result.url, result.format, result.width, result.height)
```

---

## list_colors

List the official brand colors for a brand.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `brand_id` | string | yes | The brand identifier from a search or lookup |
| `limit` | integer | no | Maximum number of colors to return |

### Example

```lua
local result = app.integrations.brandfetch.list_colors({
  brand_id = "brand_abc123"
})

for _, color in ipairs(result.colors or result or {}) do
  print(color.hex, color.type)  -- e.g., "#1DB954", "primary"
end
```

---

## list_fonts

List fonts used by a brand.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `brand_id` | string | yes | The brand identifier from a search or lookup |
| `limit` | integer | no | Maximum number of fonts to return |

### Example

```lua
local result = app.integrations.brandfetch.list_fonts({
  brand_id = "brand_abc123"
})

for _, font in ipairs(result.fonts or result or {}) do
  print(font.name, font.weight, font.type)  -- e.g., "Circular", "700", "heading"
end
```

---

## get_current_user

Get the authenticated user's Brandfetch account details.

### Parameters

None.

### Example

```lua
local result = app.integrations.brandfetch.get_current_user({})

print(result.name, result.email)
print(result.plan)
```

---

## Multi-Account Usage

If you have multiple Brandfetch accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.brandfetch.function_name({...})

-- Explicit default (portable across setups)
app.integrations.brandfetch.default.function_name({...})

-- Named accounts
app.integrations.brandfetch.work.function_name({...})
app.integrations.brandfetch.client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
