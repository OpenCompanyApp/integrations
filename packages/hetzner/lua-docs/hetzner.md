# Hetzner Cloud — Lua API Reference

## list_servers

List Hetzner Cloud servers with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of servers per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
-- List servers
local result = app.integrations.hetzner.list_servers({
  per_page = 10,
  page = 1
})

for _, server in ipairs(result.servers) do
  print(server.id .. ": " .. server.name .. " (" .. server.status .. ")")
end
```

---

## get_server

Get details for a specific Hetzner Cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The server ID |

### Examples

```lua
local result = app.integrations.hetzner.get_server({ id = "12345" })
print(result.server.name)
print(result.server.status)
print(result.server.public_net.ipv4.ip)
print(result.server.server_type.name)
```

---

## create_server

Create a new Hetzner Cloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Server name (must be unique per project) |
| `server_type` | string | yes | Server type (e.g., "cx22", "cx32", "cx42") |
| `image` | string | yes | Image name or ID (e.g., "ubuntu-24.04", "debian-12") |
| `location` | string | no | Location name (e.g., "fsn1", "nbg1", "hel1") |
| `ssh_keys` | array | no | Array of SSH key names or IDs to inject |
| `networks` | array | no | Array of network IDs to attach |
| `labels` | object | no | Key-value labels to apply to the server |
| `user_data` | string | no | Cloud-init user data (YAML) for initialization |

### Examples

```lua
-- Create a basic server
local result = app.integrations.hetzner.create_server({
  name = "my-web-server",
  server_type = "cx22",
  image = "ubuntu-24.04",
  location = "fsn1"
})

print("Created server: " .. result.server.name)
print("Root password: " .. (result.root_password or "check email"))
print("IP: " .. result.server.public_net.ipv4.ip)

-- Create a server with SSH keys and labels
local result = app.integrations.hetzner.create_server({
  name = "production-app",
  server_type = "cx32",
  image = "debian-12",
  location = "hel1",
  ssh_keys = { "my-ssh-key" },
  labels = { env = "production", team = "backend" }
})
```

---

## list_volumes

List Hetzner Cloud volumes with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of volumes per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.hetzner.list_volumes({
  per_page = 50,
  page = 1
})

for _, volume in ipairs(result.volumes) do
  print(volume.id .. ": " .. volume.name .. " (" .. volume.size .. "GB)")
end
```

---

## list_networks

List Hetzner Cloud networks with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of networks per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.hetzner.list_networks({
  per_page = 50,
  page = 1
})

for _, network in ipairs(result.networks) do
  print(network.id .. ": " .. network.name .. " (" .. network.ip_range .. ")")
end
```

---

## list_ssh_keys

List Hetzner Cloud SSH keys with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of SSH keys per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.hetzner.list_ssh_keys({
  per_page = 50,
  page = 1
})

for _, key in ipairs(result.ssh_keys) do
  print(key.id .. ": " .. key.name .. " (" .. key.fingerprint .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.hetzner.get_current_user({})
print("Logged in as: " .. result.user.email .. " (" .. result.user.id .. ")")
```

---

## Multi-Account Usage

If you have multiple Hetzner Cloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hetzner.function_name({...})

-- Explicit default (portable across setups)
app.integrations.hetzner.default.function_name({...})

-- Named accounts
app.integrations.hetzner.production.function_name({...})
app.integrations.hetzner.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
