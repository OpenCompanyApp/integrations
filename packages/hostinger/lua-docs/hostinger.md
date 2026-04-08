# Hostinger — Lua API Reference

## list_servers

List all VPS servers in the Hostinger account.

### Parameters

None.

### Example

```lua
local result = app.integrations.hostinger.list_servers({})

for _, server in ipairs(result.servers) do
  print(server.name .. " (" .. server.status .. ") - " .. server.plan)
end
```

---

## get_server

Get details for a specific VPS server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The VPS server ID |

### Example

```lua
local result = app.integrations.hostinger.get_server({ server_id = 12345678 })
local s = result.server
print(s.name .. " - " .. s.ip_address .. " - " .. s.status)
```

---

## list_domains

List all domains in the Hostinger account.

### Parameters

None.

### Example

```lua
local result = app.integrations.hostinger.list_domains({})

for _, domain in ipairs(result.domains) do
  print(domain.name .. " (" .. domain.status .. ")")
end
```

---

## get_domain

Get details for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The domain ID |

### Example

```lua
local result = app.integrations.hostinger.get_domain({ domain_id = 12345 })
print(result.domain.name .. " - " .. result.domain.status)
```

---

## list_dns_records

List DNS records for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The domain ID to list DNS records for |

### Example

```lua
local result = app.integrations.hostinger.list_dns_records({ domain_id = 12345 })

for _, record in ipairs(result.records) do
  print(record.type .. " " .. record.name .. " -> " .. record.content .. " (TTL: " .. record.ttl .. ")")
end
```

---

## list_ssl

List all SSL certificates in the Hostinger account.

### Parameters

None.

### Example

```lua
local result = app.integrations.hostinger.list_ssl({})

for _, cert in ipairs(result.ssl) do
  print(cert.domain .. " - " .. cert.status .. " - expires: " .. cert.expires_at)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.hostinger.get_current_user({})
print("Account: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Hostinger accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hostinger.list_servers({})

-- Explicit default (portable across setups)
app.integrations.hostinger.default.list_servers({})

-- Named accounts
app.integrations.hostinger.production.list_servers({})
app.integrations.hostinger.staging.list_servers({})
```

All functions are identical across accounts — only the credentials differ.
