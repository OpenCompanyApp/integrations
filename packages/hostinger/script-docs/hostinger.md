# Hostinger — JavaScript API Reference

## list_servers

List all VPS servers in the Hostinger account.

### Parameters

None.

### Example

```js
var result = app.integrations.hostinger.list_servers({})

for (const server of (result.servers)) {
  console.log(server.name + " (" + server.status + ") - " + server.plan)
}
```
---

## get_server

Get details for a specific VPS server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The VPS server ID |

### Example

```js
var result = app.integrations.hostinger.get_server({ server_id: 12345678 })
var s = result.server
console.log(s.name + " - " + s.ip_address + " - " + s.status)
```
---

## list_domains

List all domains in the Hostinger account.

### Parameters

None.

### Example

```js
var result = app.integrations.hostinger.list_domains({})

for (const domain of (result.domains)) {
  console.log(domain.name + " (" + domain.status + ")")
}
```
---

## get_domain

Get details for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The domain ID |

### Example

```js
var result = app.integrations.hostinger.get_domain({ domain_id: 12345 })
console.log(result.domain.name + " - " + result.domain.status)
```
---

## list_dns_records

List DNS records for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The domain ID to list DNS records for |

### Example

```js
var result = app.integrations.hostinger.list_dns_records({ domain_id: 12345 })

for (const record of (result.records)) {
  console.log(record.type + " " + record.name + " -> " + record.content + " (TTL: " + record.ttl + ")")
}
```
---

## list_ssl

List all SSL certificates in the Hostinger account.

### Parameters

None.

### Example

```js
var result = app.integrations.hostinger.list_ssl({})

for (const cert of (result.ssl)) {
  console.log(cert.domain + " - " + cert.status + " - expires: " + cert.expires_at)
}
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```js
var result = app.integrations.hostinger.get_current_user({})
console.log("Account: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Hostinger accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.hostinger.list_servers({})

// Explicit default (portable across setups)
app.integrations.hostinger.default.list_servers({})

// Named accounts
app.integrations.hostinger.production.list_servers({})
app.integrations.hostinger.staging.list_servers({})
```
All functions are identical across accounts — only the credentials differ.
