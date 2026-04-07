# Cloudways — Lua API Reference

## list_servers

List all servers in the Cloudways account.

### Parameters

None.

### Example

```lua
local result = app.integrations.cloudways.list_servers({})

for _, server in ipairs(result.servers) do
  print(server.label .. " (" .. server.status .. ") - " .. server.server_ips[1])
end
```

---

## get_server

Get details for a specific Cloudways server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID to look up |

### Example

```lua
local result = app.integrations.cloudways.get_server({ server_id = 12345 })
local s = result.server
print(s.label .. " - " .. s.server_ips[1] .. " - " .. s.os)
```

---

## list_apps

List all applications across all servers in the Cloudways account.

### Parameters

None.

### Example

```lua
local result = app.integrations.cloudways.list_apps({})

for _, app in ipairs(result.apps) do
  print(app.label .. " (" .. app.application .. ") on server " .. app.server_id)
end
```

---

## get_app

Get details for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to look up |

### Example

```lua
local result = app.integrations.cloudways.get_app({ server_id = 12345, app_id = 67890 })
local a = result.app
print(a.label .. " - " .. a.application .. " - " .. a.app_fqdn)
```

---

## list_domains

List domains for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to list domains for |

### Example

```lua
local result = app.integrations.cloudways.list_domains({ server_id = 12345, app_id = 67890 })

for _, domain in ipairs(result.domains) do
  print(domain.fqdn .. " - primary: " .. tostring(domain.is_primary))
end
```

---

## list_projects

List all projects in the Cloudways account.

### Parameters

None.

### Example

```lua
local result = app.integrations.cloudways.list_projects({})

for _, project in ipairs(result.projects) do
  print(project.name .. " (ID: " .. project.id .. ")")
end
```

---

## get_current_user

Get the current authenticated Cloudways account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.cloudways.get_current_user({})
print("Account: " .. result.me.email .. " (" .. result.me.name .. ")")
```

---

## Multi-Account Usage

If you have multiple Cloudways accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cloudways.list_servers({})

-- Explicit default (portable across setups)
app.integrations.cloudways.default.list_servers({})

-- Named accounts
app.integrations.cloudways.production.list_servers({})
app.integrations.cloudways.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
