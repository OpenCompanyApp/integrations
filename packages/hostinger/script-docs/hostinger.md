# Hostinger — Ruby API Reference

## list_servers

List all VPS servers in the Hostinger account.

### Parameters

None.

### Example

```ruby
result = app.integrations.hostinger.list_servers()
result.servers.each do |server|
  puts((server.name).to_s + " (" + (server.status).to_s + ") - " + (server.plan).to_s)
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

```ruby
result = app.integrations.hostinger.get_server(server_id: 12345678)
s = result.server
puts((s.name).to_s + " - " + (s.ip_address).to_s + " - " + (s.status).to_s)
```
---

## list_domains

List all domains in the Hostinger account.

### Parameters

None.

### Example

```ruby
result = app.integrations.hostinger.list_domains()
result.domains.each do |domain|
  puts((domain.name).to_s + " (" + (domain.status).to_s + ")")
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

```ruby
result = app.integrations.hostinger.get_domain(domain_id: 12345)
puts((result.domain.name).to_s + " - " + (result.domain.status).to_s)
```
---

## list_dns_records

List DNS records for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The domain ID to list DNS records for |

### Example

```ruby
result = app.integrations.hostinger.list_dns_records(domain_id: 12345)
result.records.each do |record|
  puts((record.type).to_s + " " + (record.name).to_s + " -> " + (record.content).to_s + " (TTL: " + (record.ttl).to_s + ")")
end
```
---

## list_ssl

List all SSL certificates in the Hostinger account.

### Parameters

None.

### Example

```ruby
result = app.integrations.hostinger.list_ssl_certificates()
result.ssl.each do |cert|
  puts((cert.domain).to_s + " - " + (cert.status).to_s + " - expires: " + (cert.expires_at).to_s)
end
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.hostinger.get_current_user()
puts("Account: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Hostinger accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.hostinger.list_servers()
# Explicit default (portable across setups)
app.integrations.hostinger.default.list_servers()
# Named accounts
app.integrations.hostinger.production.list_servers()
app.integrations.hostinger.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
