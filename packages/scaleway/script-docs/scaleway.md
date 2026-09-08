# Scaleway — Ruby API Reference

## list_servers

List all servers in the Scaleway zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```ruby
result = app.integrations.scaleway.list_servers(per_page: 50)
result.servers.each do |server|
  puts((server.name).to_s + " (" + (server.state).to_s + ") - " + (server.commercial_type).to_s)
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

```ruby
result = app.integrations.scaleway.get_server(server_id: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx")
s = result.server
puts((s.name).to_s + " - " + (s.state).to_s + " - " + (((s.public_ip && s.public_ip.address) || "no public IP")).to_s)
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

```ruby
result = app.integrations.scaleway.list_volumes()
result.volumes.each do |volume|
  puts((volume.name).to_s + " - " + (volume.size).to_s + " bytes - " + (volume.volume_type).to_s)
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

```ruby
result = app.integrations.scaleway.list_snapshots()
result.snapshots.each do |snapshot|
  puts((snapshot.name).to_s + " - " + (snapshot.size).to_s + " bytes - " + (snapshot.state).to_s)
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

```ruby
result = app.integrations.scaleway.list_security_groups()
result.security_groups.each do |sg|
  puts((sg.name).to_s + " - " + ((sg.description || "no description")).to_s)
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

```ruby
result = app.integrations.scaleway.list_ips()
result.ips.each do |ip|
  puts((ip.address).to_s + " - " + (((ip.server && ip.server.name) || "unassigned")).to_s)
end
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.scaleway.get_current_user()
puts("Account: " + (result.email).to_s + " (" + (result.id).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Scaleway accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.scaleway.list_servers()
# Explicit default (portable across setups)
app.integrations.scaleway.default.list_servers()
# Named accounts
app.integrations.scaleway.production.list_servers()
app.integrations.scaleway.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
