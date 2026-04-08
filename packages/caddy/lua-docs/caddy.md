# Caddy — Lua API Reference

## list_sites

List all Caddy sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 20) |

### Examples

```lua
-- List all sites
local result = app.integrations.caddy.list_sites({})

for _, site in ipairs(result.sites) do
  print(site.name .. " (" .. site.status .. ") - " .. site.id)
end
```

```lua
-- Paginated listing
local result = app.integrations.caddy.list_sites({
  page = 2,
  per_page = 10
})
```

---

## get_site

Get detailed information about a specific Caddy site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```lua
local result = app.integrations.caddy.get_site({
  site_id = "abc123"
})

print("Site: " .. result.name)
print("Status: " .. result.status)
```

---

## create_site

Create a new site in Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The domain name for the site (e.g., "example.com") |
| `config` | object | no | Optional site configuration (Caddy JSON config or key-value pairs) |

### Examples

```lua
-- Create a basic site
local result = app.integrations.caddy.create_site({
  name = "mysite.example.com"
})

print(result.message)
print("Site ID: " .. result.id)
```

```lua
-- Create a site with custom config
local result = app.integrations.caddy.create_site({
  name = "mysite.example.com",
  config = {
    auto_https = "on",
    log_format = "json"
  }
})
```

---

## delete_site

Delete a site from Caddy. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier to delete |

### Examples

```lua
local result = app.integrations.caddy.delete_site({
  site_id = "abc123"
})

print(result.message)
```

---

## list_certificates

List all TLS certificates managed by Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of certificates per page (default: 20) |

### Examples

```lua
-- List all certificates
local result = app.integrations.caddy.list_certificates({})

for _, cert in ipairs(result.certificates) do
  print(cert.domain .. " expires: " .. (cert.expires_at or "N/A"))
end
```

```lua
-- Paginated listing
local result = app.integrations.caddy.list_certificates({
  page = 1,
  per_page = 50
})
```

---

## get_certificate

Get detailed information about a specific TLS certificate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `certificate_id` | string | yes | The certificate identifier |

### Examples

```lua
local result = app.integrations.caddy.get_certificate({
  certificate_id = "cert-abc123"
})

print("Domain: " .. result.domain)
print("Issuer: " .. (result.issuer or "N/A"))
print("Valid from: " .. (result.not_before or "N/A"))
print("Expires: " .. (result.not_after or "N/A"))
print("SANs: " .. table.concat(result.sans or {}, ", "))
```

---

## get_current_user

Get details of the currently authenticated Caddy user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.caddy.get_current_user({})

print("User: " .. result.username .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Caddy accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.caddy.function_name({...})

-- Explicit default (portable across setups)
app.integrations.caddy.default.function_name({...})

-- Named accounts
app.integrations.caddy.production.function_name({...})
app.integrations.caddy.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
