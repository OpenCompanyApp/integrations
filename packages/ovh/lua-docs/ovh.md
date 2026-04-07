# OVHcloud — Lua API Reference

## list_servers

List all dedicated servers in the OVH account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.list_servers({})

for _, server in ipairs(result) do
  print(server)
end
```

---

## get_server

Get details for a specific dedicated server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_name` | string | yes | The dedicated server service name (e.g., `"ns123456.ip-1-2-3.eu"`) |

### Example

```lua
local result = app.integrations.ovh.get_server({ service_name = "ns123456.ip-1-2-3.eu" })
local s = result
print(s.name .. " - " .. s.os .. " - " .. s.datacenter)
```

---

## list_domains

List all domains in the OVH account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.list_domains({})

for _, domain in ipairs(result) do
  print(domain)
end
```

---

## list_vps

List all VPS instances in the OVH account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.list_vps({})

for _, vps in ipairs(result) do
  print(vps)
end
```

---

## list_ip

List all IP addresses in the OVH account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.list_ip({})

for _, ip in ipairs(result) do
  print(ip)
end
```

---

## list_projects

List all public cloud projects in the OVH account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.list_projects({})

for _, project in ipairs(result) do
  print(project)
end
```

---

## get_current_user

Get the current authenticated OVH account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.ovh.get_current_user({})
print("Account: " .. result.nichandle .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple OVH accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ovh.list_servers({})

-- Explicit default (portable across setups)
app.integrations.ovh.default.list_servers({})

-- Named accounts
app.integrations.ovh.production.list_servers({})
app.integrations.ovh.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
