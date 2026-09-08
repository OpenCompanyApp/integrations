# Kamatera — Ruby API Reference

## list_servers

List all cloud servers in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.kamatera.list_servers()
result.servers.each do |server|
  puts((server.name).to_s + " (" + (server.status).to_s + ") - " + (server.cpu).to_s + " CPU / " + (server.ram).to_s + " MB RAM")
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

```ruby
result = app.integrations.kamatera.get_server(id: "server-abc123")
s = result.server
puts((s.name).to_s + " - " + (s.datacenter).to_s + " - " + (s.image).to_s + " - " + (s.status).to_s)
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

```ruby
result = app.integrations.kamatera.create_server(name: "web-server-01", datacenter: "IL-JER", image: "ubuntu_22.04", cpu: 2, ram: 4096, disk: 50)
puts("Server created: " + (result.id).to_s)
```
---

## list_networks

List all networks in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.kamatera.list_networks()
result.networks.each do |network|
  puts((network.id).to_s + " - " + (network.name).to_s + " - " + (network.cidr).to_s + " (" + (network.datacenter).to_s + ")")
end
```
---

## list_images

List all available images for server creation.

### Parameters

None.

### Example

```ruby
result = app.integrations.kamatera.list_images()
result.images.each do |image|
  puts((image.id).to_s + " - " + (image.name).to_s + " - " + (image.os).to_s)
end
```
---

## list_datacenters

List all available datacenter locations.

### Parameters

None.

### Example

```ruby
result = app.integrations.kamatera.list_datacenters()
result.datacenters.each do |dc|
  puts((dc.id).to_s + " - " + (dc.name).to_s + ", " + (dc.country).to_s)
end
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.kamatera.get_current_user()
puts("Account: " + ((result.account.email || result.user.email)).to_s)
```
---

## Multi-Account Usage

If you have multiple Kamatera accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.kamatera.list_servers()
# Explicit default (portable across setups)
app.integrations.kamatera.default.list_servers()
# Named accounts
app.integrations.kamatera.production.list_servers()
app.integrations.kamatera.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
