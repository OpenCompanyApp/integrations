# Contabo — Ruby API Reference

## list_instances

List all compute instances (VPS) in the Contabo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20) |

### Example

```ruby
result = app.integrations.contabo.list_instances(per_page: 50)
result.data.each do |instance|
  puts((instance.name).to_s + " (" + (instance.status).to_s + ") - " + (instance.ipConfig.v4.ip).to_s)
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

```ruby
result = app.integrations.contabo.get_instance(id: 12345)
inst = result.data
puts((inst.name).to_s + " - " + (inst.region).to_s + " - " + (inst.ipConfig.v4.ip).to_s)
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

```ruby
result = app.integrations.contabo.list_snapshots()
result.data.each do |snap|
  puts((snap.name).to_s + " - instance: " + (snap.instanceId).to_s + " - " + (snap.createdDate).to_s)
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

```ruby
result = app.integrations.contabo.list_images()
result.data.each do |image|
  puts((image.name).to_s + " - " + (image.osType).to_s + " (" + (image.sizeMb).to_s + " MB)")
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

```ruby
result = app.integrations.contabo.list_networks()
result.data.each do |network|
  puts((network.name).to_s + " - " + (network.region).to_s + " - " + (network.cidr).to_s)
end
```
---

## list_ssh_keys

List all registered SSH keys in the Contabo account.

### Parameters

None.

### Example

```ruby
result = app.integrations.contabo.list_ssh_keys()
result.data.each do |key|
  puts((key.name).to_s + " - " + (key.fingerPrint).to_s)
end
```
---

## get_current_user

Get the current authenticated Contabo account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.contabo.get_current_user()
user = result.data
puts("Account: " + (user.email).to_s + " (tenant: " + (user.tenantId).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Contabo accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.contabo.list_instances()
# Explicit default (portable across setups)
app.integrations.contabo.default.list_instances()
# Named accounts
app.integrations.contabo.production.list_instances()
app.integrations.contabo.staging.list_instances()
```
All functions are identical across accounts — only the credentials differ.
