# UpCloud — Ruby API Reference

## list_servers

List all cloud servers on the UpCloud account.

### Parameters

None.

### Examples

```ruby
# List all servers
result = app.integrations.upcloud.list_servers()
result.servers.each do |server|
  puts((server.uuid).to_s + ": " + (server.title).to_s + " (" + (server.state).to_s + ")")
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

```ruby
result = app.integrations.upcloud.get_server(uuid: "abc123-def456")
puts(result.server.title)
puts(result.server.state)
puts(result.server.vcpu)
puts(result.server.memory_amount)
```
---

## list_storages

List storage devices on the UpCloud account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Storage type filter: "disk", "backup", or "cdrom" |

### Examples

```ruby
# List all storages
result = app.integrations.upcloud.list_storages()
# List only disk storages
result = app.integrations.upcloud.list_storages(type: "disk")
result.storages.each do |storage|
  puts((storage.uuid).to_s + ": " + (storage.title).to_s + " (" + (storage.size).to_s + " GB)")
end
```
---

## list_networks

List private networks on the UpCloud account.

### Parameters

None.

### Examples

```ruby
result = app.integrations.upcloud.list_networks()
result.networks.each do |network|
  puts((network.uuid).to_s + ": " + (network.name).to_s + " (" + (network.zone).to_s + ")")
end
```
---

## list_ips

List IP addresses on the UpCloud account.

### Parameters

None.

### Examples

```ruby
result = app.integrations.upcloud.list_ips()
result.ip_addresses.each do |ip|
  puts((ip.address).to_s + " (" + (ip.family).to_s + ") -> " + ((ip.server || "unassigned")).to_s)
end
```
---

## list_zones

List available UpCloud zones (data centers).

### Parameters

None.

### Examples

```ruby
result = app.integrations.upcloud.list_zones()
result.zones.each do |zone|
  puts((zone.id).to_s + ": " + (zone.description).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.upcloud.get_current_user()
puts("Logged in as: " + (result.account.username).to_s)
```
---

## Multi-Account Usage

If you have multiple UpCloud accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
