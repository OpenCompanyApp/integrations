# Linode — Ruby API Reference

## list_instances

List all Linode instances (virtual machines) in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 100, max: 500) |

### Example

```ruby
result = app.integrations.linode.list_instances(per_page: 50)
result.data.each do |instance|
  puts((instance.label).to_s + " (" + (instance.status).to_s + ") - " + (instance.type).to_s)
end
```
---

## get_instance

Get details for a specific Linode instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Linode instance ID |

### Example

```ruby
result = app.integrations.linode.get_instance(id: 12345678)
i = result
puts((i.label).to_s + " - " + (i.region).to_s + " - " + (i.specs.vcpus).to_s + " vCPUs, " + (i.specs.memory).to_s + " MB RAM")
```
---

## list_volumes

List all block storage volumes in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```ruby
result = app.integrations.linode.list_volumes()
result.data.each do |volume|
  puts((volume.label).to_s + " (" + (volume.size).to_s + " GB) - " + (volume.status).to_s)
end
```
---

## list_domains

List all DNS domains in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```ruby
result = app.integrations.linode.list_domains()
result.data.each do |domain|
  puts((domain.domain).to_s + " (status: " + (domain.status).to_s + ")")
end
```
---

## get_domain

Get details for a specific DNS domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The domain ID |

### Example

```ruby
result = app.integrations.linode.get_domain(id: 12345)
puts((result.domain).to_s + " - SOA email: " + (result.soa_email).to_s)
```
---

## list_stackscripts

List all StackScripts (reusable deployment scripts).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```ruby
result = app.integrations.linode.list_stackscripts()
result.data.each do |script|
  puts((script.label).to_s + " (deployments: " + (script.deployments_total).to_s + ")")
end
```
---

## get_current_user

Get the current authenticated user profile information.

### Parameters

None.

### Example

```ruby
result = app.integrations.linode.get_current_user()
puts("User: " + (result.username).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Linode accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.linode.list_instances()
# Explicit default (portable across setups)
app.integrations.linode.default.list_instances()
# Named accounts
app.integrations.linode.production.list_instances()
app.integrations.linode.staging.list_instances()
```
All functions are identical across accounts — only the credentials differ.
