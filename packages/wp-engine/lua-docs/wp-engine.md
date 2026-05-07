# WP Engine — Lua API Reference

## list_sites

List WP Engine sites with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of sites per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
-- List sites
local result = app.integrations["wp-engine"].wp_engine_list_sites({
  limit = 10,
  page = 1
})

for _, site in ipairs(result.sites) do
  print(site.id .. ": " .. site.name .. " (" .. site.status .. ")")
end
```

---

## get_site

Get details for a specific WP Engine site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The site ID |

### Examples

```lua
local result = app.integrations["wp-engine"].wp_engine_get_site({ id = "12345" })
print(result.name)
print(result.status)
print(result.created_at)
```

---

## list_installs

List WP Engine installs with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of installs per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
-- List installs
local result = app.integrations["wp-engine"].wp_engine_list_installs({
  limit = 10,
  page = 1
})

for _, install in ipairs(result.installs) do
  print(install.id .. ": " .. install.name .. " - " .. install.environment)
end
```

---

## get_install

Get details for a specific WP Engine install.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The install ID |

### Examples

```lua
local result = app.integrations["wp-engine"].wp_engine_get_install({ id = "67890" })
print(result.name)
print(result.environment)
print(result.php_version)
print(result.status)
```

---

## list_domains

List domains across WP Engine installs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of domains per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations["wp-engine"].wp_engine_list_domains({
  limit = 50,
  page = 1
})

for _, domain in ipairs(result.domains) do
  print(domain.name .. " -> " .. domain.installs_id)
end
```

---

## list_users

List WP Engine users with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations["wp-engine"].wp_engine_list_users({
  limit = 10,
  page = 1
})

for _, user in ipairs(result.users) do
  print(user.id .. ": " .. user.email .. " (" .. user.role .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations["wp-engine"].wp_engine_get_current_user({})
print("Logged in as: " .. result.email .. " (" .. result.id .. ")")
```

---

## Multi-Account Usage

If you have multiple WP Engine accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["wp-engine"].wp_engine_function_name({...})

-- Explicit default (portable across setups)
app.integrations["wp-engine"].default.wp_engine_function_name({...})

-- Named accounts
app.integrations["wp-engine"].production.wp_engine_function_name({...})
app.integrations["wp-engine"].staging.wp_engine_function_name({...})
```

All functions are identical across accounts — only the credentials differ.
