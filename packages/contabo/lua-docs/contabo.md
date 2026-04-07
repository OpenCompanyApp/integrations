# Contabo — Lua API Reference

## list_instances

List all compute instances (VPS) in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```lua
local result = app.integrations.contabo.list_instances({
  per_page = 50
})

for _, instance in ipairs(result.data) do
  print(instance.name .. " (" .. instance.status .. ") - " .. instance.ipConfig.v4.ip)
end
```

---

## get_instance

Get details for a specific compute instance (VPS).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The instance ID |

### Example

```lua
local result = app.integrations.contabo.get_instance({ id = 12345 })
local inst = result.data
print(inst.name .. " - " .. inst.region .. " - " .. inst.ipConfig.v4.ip)
```

---

## list_snapshots

List all snapshots in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```lua
local result = app.integrations.contabo.list_snapshots({})

for _, snap in ipairs(result.data) do
  print(snap.name .. " - instance: " .. snap.instanceId .. " - " .. snap.createdDate)
end
```

---

## list_images

List all custom images in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```lua
local result = app.integrations.contabo.list_images({})

for _, image in ipairs(result.data) do
  print(image.name .. " - " .. image.osType .. " (" .. image.sizeMb .. " MB)")
end
```

---

## list_networks

List all private networks in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```lua
local result = app.integrations.contabo.list_networks({})

for _, network in ipairs(result.data) do
  print(network.name .. " - " .. network.region .. " - " .. network.cidr)
end
```

---

## list_ssh_keys

List all registered SSH keys in the Contabo account.

### Parameters

None.

### Example

```lua
local result = app.integrations.contabo.list_ssh_keys({})

for _, key in ipairs(result.data) do
  print(key.name .. " - " .. key.fingerPrint)
end
```

---

## get_current_user

Get the current authenticated Contabo account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.contabo.get_current_user({})
local user = result.data
print("Account: " .. user.email .. " (tenant: " .. user.tenantId .. ")")
```

---

## Multi-Account Usage

If you have multiple Contabo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.contabo.list_instances({})

-- Explicit default (portable across setups)
app.integrations.contabo.default.list_instances({})

-- Named accounts
app.integrations.contabo.production.list_instances({})
app.integrations.contabo.staging.list_instances({})
```

All functions are identical across accounts — only the credentials differ.
