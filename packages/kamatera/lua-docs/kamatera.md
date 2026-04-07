# Kamatera — Lua API Reference

## list_servers

List all cloud servers in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.kamatera.list_servers({})

for _, server in ipairs(result.servers) do
  print(server.name .. " (" .. server.status .. ") - " .. server.cpu .. " CPU / " .. server.ram .. " MB RAM")
end
```

---

## get_server

Get details for a specific cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The server ID |

### Example

```lua
local result = app.integrations.kamatera.get_server({ id = "server-abc123" })
local s = result.server
print(s.name .. " - " .. s.datacenter .. " - " .. s.image .. " - " .. s.status)
```

---

## create_server

Create a new cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The server name |
| `datacenter` | string | yes | The datacenter ID (e.g. "IL-JER") |
| `image` | string | yes | The image ID or OS name |
| `cpu` | integer | yes | Number of vCPUs |
| `ram` | integer | yes | RAM in MB |
| `disk` | integer | yes | Disk size in GB |
| `password` | string | no | Root password (auto-generated if omitted) |
| `network` | string | no | Network ID to attach the server to |
| `quantity` | integer | no | Number of servers to create |

### Example

```lua
local result = app.integrations.kamatera.create_server({
  name = "web-server-01",
  datacenter = "IL-JER",
  image = "ubuntu_22.04",
  cpu = 2,
  ram = 4096,
  disk = 50,
})

print("Server created: " .. result.id)
```

---

## list_networks

List all networks in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.kamatera.list_networks({})

for _, network in ipairs(result.networks) do
  print(network.id .. " - " .. network.name .. " - " .. network.cidr .. " (" .. network.datacenter .. ")")
end
```

---

## list_images

List all available images for server creation.

### Parameters

None.

### Example

```lua
local result = app.integrations.kamatera.list_images({})

for _, image in ipairs(result.images) do
  print(image.id .. " - " .. image.name .. " - " .. image.os)
end
```

---

## list_datacenters

List all available datacenter locations.

### Parameters

None.

### Example

```lua
local result = app.integrations.kamatera.list_datacenters({})

for _, dc in ipairs(result.datacenters) do
  print(dc.id .. " - " .. dc.name .. ", " .. dc.country)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.kamatera.get_current_user({})
print("Account: " .. (result.account.email or result.user.email))
```

---

## Multi-Account Usage

If you have multiple Kamatera accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.kamatera.list_servers({})

-- Explicit default (portable across setups)
app.integrations.kamatera.default.list_servers({})

-- Named accounts
app.integrations.kamatera.production.list_servers({})
app.integrations.kamatera.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
