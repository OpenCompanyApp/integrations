# Netlify — Lua API Reference

## list_sites

List all Netlify sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by site name |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 30) |

### Examples

```lua
-- List all sites
local result = app.integrations.netlify.list_sites({})

for _, site in ipairs(result.sites) do
  print(site.name .. " (" .. site.state .. ") - " .. site.url)
end
```

```lua
-- Filter by name
local result = app.integrations.netlify.list_sites({
  name = "my-site"
})
```

---

## get_site

Get detailed information about a specific Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier or site name (e.g., "abc123" or "mysite.netlify.app") |

### Examples

```lua
local result = app.integrations.netlify.get_site({
  site_id = "abc123-def456"
})

print("Site: " .. result.name)
print("URL: " .. result.ssl_url)
print("State: " .. result.state)
print("Custom domain: " .. (result.custom_domain or "none"))
```

---

## list_deploys

List deploys for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of deploys per page (default: 30) |

### Examples

```lua
local result = app.integrations.netlify.list_deploys({
  site_id = "abc123-def456"
})

for _, deploy in ipairs(result.deploys) do
  print(deploy.state .. " - " .. (deploy.branch or "unknown") .. " @ " .. deploy.created_at)
end
```

---

## get_deploy

Get detailed information about a specific Netlify deploy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deploy_id` | string | yes | The deploy identifier |

### Examples

```lua
local result = app.integrations.netlify.get_deploy({
  deploy_id = "789xyz"
})

print("State: " .. result.state)
print("Branch: " .. (result.branch or "unknown"))
print("Deploy time: " .. (result.deploy_time or 0) .. "s")
print("URL: " .. (result.deploy_url or "N/A"))
```

---

## list_forms

List all forms for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```lua
local result = app.integrations.netlify.list_forms({
  site_id = "abc123-def456"
})

for _, form in ipairs(result.forms) do
  print(form.name .. " - " .. form.submission_count .. " submissions")
end
```

---

## list_dns_zones

List all DNS zones configured in Netlify.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Number of DNS zones per page |

### Examples

```lua
local result = app.integrations.netlify.list_dns_zones({})

for _, zone in ipairs(result.dns_zones) do
  print(zone.name .. " (" .. (zone.domain or "N/A") .. ")")
  for _, ns in ipairs(zone.nameservers) do
    print("  NS: " .. ns)
  end
end
```

---

## get_current_user

Get details of the currently authenticated Netlify user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.netlify.get_current_user({})

print("User: " .. (result.full_name or result.email))
print("Email: " .. result.email)
print("Sites: " .. (result.site_count or 0))
```

---

## Multi-Account Usage

If you have multiple Netlify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.netlify.function_name({...})

-- Explicit default (portable across setups)
app.integrations.netlify.default.function_name({...})

-- Named accounts
app.integrations.netlify.production.function_name({...})
app.integrations.netlify.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
