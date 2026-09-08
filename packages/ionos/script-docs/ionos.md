# IONOS Cloud — Ruby API Reference

## list_servers

List all servers in the IONOS Cloud account.

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.list_servers()
result.servers.each do |server|
  puts((server.properties.name).to_s + " (" + (server.properties.vmState).to_s + ") - " + (server.properties.cores).to_s + " cores")
end
```
---

## get_server

Get details for a specific server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | string | yes | The server ID |

### Example

```ruby
result = app.integrations.ionos.get_server(server_id: "abc123-def456")
s = result.properties
puts((s.name).to_s + " - " + (s.cores).to_s + " cores, " + (s.ram).to_s + " MB RAM, state: " + (s.vmState).to_s)
```
---

## list_volumes

List all block storage volumes.

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.list_volumes()
result.volumes.each do |vol|
  puts((vol.properties.name).to_s + " - " + (vol.properties.size).to_s + " GB (" + (vol.properties.type).to_s + ")")
end
```
---

## list_lans

List all local area networks (LANs).

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.list_lans()
result.lans.each do |lan|
  puts((lan.properties.name).to_s + " - public: " + ((lan.properties.public).to_s).to_s)
end
```
---

## list_nics

List all network interface cards (NICs).

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.list_nics()
result.nics.each do |nic|
  puts((nic.properties.name).to_s + " - MAC: " + (nic.properties.mac).to_s + ", IPs: " + (nic.properties.ips.join(", ")).to_s)
end
```
---

## list_images

List all available images.

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.list_images()
result.images.each do |img|
  puts((img.properties.name).to_s + " - " + ((img.properties.osType || "unknown")).to_s + " (" + (img.properties.location).to_s + ")")
end
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```ruby
result = app.integrations.ionos.get_current_user()
user = result.properties
puts("User: " + ((user.firstname || "")).to_s + " " + ((user.lastname || "")).to_s + " <" + ((user.email || "")).to_s + ">")
```
---

## Multi-Account Usage

If you have multiple IONOS Cloud accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.ionos.list_servers()
# Explicit default (portable across setups)
app.integrations.ionos.default.list_servers()
# Named accounts
app.integrations.ionos.production.list_servers()
app.integrations.ionos.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
