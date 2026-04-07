# IONOS Cloud — Lua API Reference

## list_servers

List all servers in the IONOS Cloud account.

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.list_servers({})

for _, server in ipairs(result.servers) do
  print(server.properties.name .. " (" .. server.properties.vmState .. ") - " .. server.properties.cores .. " cores")
end
```

---

## get_server

Get details for a specific server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | string | yes | The server ID |

### Example

```lua
local result = app.integrations.ionos.get_server({ server_id = "abc123-def456" })
local s = result.properties
print(s.name .. " - " .. s.cores .. " cores, " .. s.ram .. " MB RAM, state: " .. s.vmState)
```

---

## list_volumes

List all block storage volumes.

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.list_volumes({})

for _, vol in ipairs(result.volumes) do
  print(vol.properties.name .. " - " .. vol.properties.size .. " GB (" .. vol.properties.type .. ")")
end
```

---

## list_lans

List all local area networks (LANs).

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.list_lans({})

for _, lan in ipairs(result.lans) do
  print(lan.properties.name .. " - public: " .. tostring(lan.properties.public))
end
```

---

## list_nics

List all network interface cards (NICs).

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.list_nics({})

for _, nic in ipairs(result.nics) do
  print(nic.properties.name .. " - MAC: " .. nic.properties.mac .. ", IPs: " .. table.concat(nic.properties.ips, ", "))
end
```

---

## list_images

List all available images.

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.list_images({})

for _, img in ipairs(result.images) do
  print(img.properties.name .. " - " .. (img.properties.osType or "unknown") .. " (" .. img.properties.location .. ")")
end
```

---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.ionos.get_current_user({})
local user = result.properties
print("User: " .. (user.firstname or "") .. " " .. (user.lastname or "") .. " <" .. (user.email or "") .. ">")
```

---

## Multi-Account Usage

If you have multiple IONOS Cloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ionos.list_servers({})

-- Explicit default (portable across setups)
app.integrations.ionos.default.list_servers({})

-- Named accounts
app.integrations.ionos.production.list_servers({})
app.integrations.ionos.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
