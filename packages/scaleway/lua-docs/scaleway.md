# Scaleway — Lua API Reference

## list_servers

List all servers in the Scaleway zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```lua
local result = app.integrations.scaleway.list_servers({
  per_page = 50
})

for _, server in ipairs(result.servers) do
  print(server.name .. " (" .. server.state .. ") - " .. server.commercial_type)
end
```

---

## get_server

Get details for a specific server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | string | yes | The server ID (UUID) |

### Example

```lua
local result = app.integrations.scaleway.get_server({ server_id = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" })
local s = result.server
print(s.name .. " - " .. s.state .. " - " .. (s.public_ip and s.public_ip.address or "no public IP"))
```

---

## list_volumes

List all block storage volumes in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```lua
local result = app.integrations.scaleway.list_volumes({})

for _, volume in ipairs(result.volumes) do
  print(volume.name .. " - " .. volume.size .. " bytes - " .. volume.volume_type)
end
```

---

## list_snapshots

List all volume snapshots in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```lua
local result = app.integrations.scaleway.list_snapshots({})

for _, snapshot in ipairs(result.snapshots) do
  print(snapshot.name .. " - " .. snapshot.size .. " bytes - " .. snapshot.state)
end
```

---

## list_security_groups

List all security groups (firewall rule sets) in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```lua
local result = app.integrations.scaleway.list_security_groups({})

for _, sg in ipairs(result.security_groups) do
  print(sg.name .. " - " .. (sg.description or "no description"))
end
```

---

## list_ips

List all flexible IPs in the zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```lua
local result = app.integrations.scaleway.list_ips({})

for _, ip in ipairs(result.ips) do
  print(ip.address .. " - " .. (ip.server and ip.server.name or "unassigned"))
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.scaleway.get_current_user({})
print("Account: " .. result.email .. " (" .. result.id .. ")")
```

---

## Multi-Account Usage

If you have multiple Scaleway accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.scaleway.list_servers({})

-- Explicit default (portable across setups)
app.integrations.scaleway.default.list_servers({})

-- Named accounts
app.integrations.scaleway.production.list_servers({})
app.integrations.scaleway.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
