# UpCloud — Lua API Reference

## list_servers

List all cloud servers on the UpCloud account.

### Parameters

None.

### Examples

```lua
-- List all servers
local result = app.integrations.upcloud.list_servers({})

for _, server in ipairs(result.servers) do
  print(server.uuid .. ": " .. server.title .. " (" .. server.state .. ")")
end
```

---

## get_server

Get details for a specific UpCloud server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uuid` | string | yes | The server UUID |

### Examples

```lua
local result = app.integrations.upcloud.get_server({ uuid = "abc123-def456" })
print(result.server.title)
print(result.server.state)
print(result.server.vcpu)
print(result.server.memory_amount)
```

---

## list_storages

List storage devices on the UpCloud account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Storage type filter: "disk", "backup", or "cdrom" |

### Examples

```lua
-- List all storages
local result = app.integrations.upcloud.list_storages({})

-- List only disk storages
local result = app.integrations.upcloud.list_storages({ type = "disk" })

for _, storage in ipairs(result.storages) do
  print(storage.uuid .. ": " .. storage.title .. " (" .. storage.size .. " GB)")
end
```

---

## list_networks

List private networks on the UpCloud account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.upcloud.list_networks({})

for _, network in ipairs(result.networks) do
  print(network.uuid .. ": " .. network.name .. " (" .. network.zone .. ")")
end
```

---

## list_ips

List IP addresses on the UpCloud account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.upcloud.list_ips({})

for _, ip in ipairs(result.ip_addresses) do
  print(ip.address .. " (" .. ip.family .. ") -> " .. (ip.server or "unassigned"))
end
```

---

## list_zones

List available UpCloud zones (data centers).

### Parameters

None.

### Examples

```lua
local result = app.integrations.upcloud.list_zones({})

for _, zone in ipairs(result.zones) do
  print(zone.id .. ": " .. zone.description)
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.upcloud.get_current_user({})
print("Logged in as: " .. result.account.username)
```

---

## Multi-Account Usage

If you have multiple UpCloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.upcloud.function_name({...})

-- Explicit default (portable across setups)
app.integrations.upcloud.default.function_name({...})

-- Named accounts
app.integrations.upcloud.production.function_name({...})
app.integrations.upcloud.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
