# OVHcloud — Ruby API Reference

## list_servers

List all dedicated servers in the OVH account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.list_servers()
result.each do |server|
  puts(server)
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

```ruby
result = app.integrations.ovh.get_server(service_name: "ns123456.ip-1-2-3.eu")
s = result
puts((s.name).to_s + " - " + (s.os).to_s + " - " + (s.datacenter).to_s)
```
---

## list_domains

List all domains in the OVH account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.list_domains()
result.each do |domain|
  puts(domain)
end
```
---

## list_vps

List all VPS instances in the OVH account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.list_vps()
result.each do |vps|
  puts(vps)
end
```
---

## list_ip

List all IP addresses in the OVH account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.list_ip_addresses()
result.each do |ip|
  puts(ip)
end
```
---

## list_projects

List all public cloud projects in the OVH account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.list_projects()
result.each do |project|
  puts(project)
end
```
---

## get_current_user

Get the current authenticated OVH account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.ovh.get_current_user()
puts("Account: " + (result.nichandle).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple OVH accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.ovh.list_servers()
# Explicit default (portable across setups)
app.integrations.ovh.default.list_servers()
# Named accounts
app.integrations.ovh.production.list_servers()
app.integrations.ovh.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
