# DigitalOcean — Ruby API Reference

## list_droplets

List all droplets (virtual machines) in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20, max: 200) |

### Example

```ruby
result = app.integrations.digitalocean.list_droplets(per_page: 50)
result.droplets.each do |droplet|
  puts((droplet.name).to_s + " (" + (droplet.status).to_s + ") - " + (droplet.size_slug).to_s)
end
```
---

## get_droplet

Get details for a specific droplet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The droplet ID |

### Example

```ruby
result = app.integrations.digitalocean.get_droplet(id: 12345678)
d = result.droplet
puts((d.name).to_s + " - " + (d.region.name).to_s + " - " + (d.networks.v4[0].ip_address).to_s)
```
---

## create_droplet

Create a new droplet (virtual machine).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Hostname for the droplet |
| `region` | string | yes | Region slug (e.g., `"nyc3"`, `"ams3"`, `"sgp1"`) |
| `size` | string | yes | Size slug (e.g., `"s-1vcpu-1gb"`, `"s-2vcpu-4gb"`) |
| `image` | string | yes | Image slug or ID (e.g., `"ubuntu-24-04-x64"`) |
| `ssh_keys` | array | no | SSH key IDs or fingerprints |
| `backups` | boolean | no | Enable automated backups (default: false) |
| `ipv6` | boolean | no | Enable IPv6 (default: false) |
| `user_data` | string | no | Cloud-init user data script |
| `tags` | array | no | Tag names to apply |

### Common Region Slugs

`nyc1`, `nyc3`, `ams3`, `sgp1`, `lon1`, `fra1`, `tor1`, `sfo3`, `blr1`, `syd1`

### Common Size Slugs

` s-1vcpu-1gb`, `s-1vcpu-2gb`, `s-2vcpu-2gb`, `s-2vcpu-4gb`, `s-4vcpu-8gb`

### Common Image Slugs

`ubuntu-24-04-x64`, `ubuntu-22-04-x64`, `debian-12-x64`, `debian-11-x64`, `centos-stream-9-x64`, `rockylinux-9-x64`, `fedora-39-x64`

### Example

```ruby
result = app.integrations.digitalocean.create_droplet(name: "web-01", region: "ams3", size: "s-1vcpu-1gb", image: "ubuntu-24-04-x64", ssh_keys: ["fingerprint_or_id"], tags: ["web", "production"])
puts("Created droplet: " + (result.droplet.id).to_s)
```
---

## delete_droplet

Permanently delete a droplet. **This action is irreversible.**

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The droplet ID to delete |

### Example

```ruby
app.integrations.digitalocean.delete_droplet(id: 12345678)
puts("Droplet deleted")
```
---

## reboot_droplet

Reboot a droplet. The droplet will be temporarily unavailable during the reboot.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The droplet ID to reboot |

### Example

```ruby
result = app.integrations.digitalocean.reboot_droplet(id: 12345678)
puts("Reboot initiated: " + (result.action.status).to_s)
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
result = app.integrations.digitalocean.list_domains()
result.domains.each do |domain|
  puts((domain.name).to_s + " (TTL: " + (domain.ttl).to_s + ")")
end
```
---

## get_domain

Get details for a specific DNS domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The domain name (e.g., `"example.com"`) |

### Example

```ruby
result = app.integrations.digitalocean.get_domain(name: "example.com")
puts((result.domain.name).to_s + " - zone file: " + (result.domain.zone_file).to_s)
```
---

## list_spaces

List DigitalOcean Spaces access keys through the bearer-token DigitalOcean API.

This does **not** list S3 buckets or objects. Bucket and object operations use the separate S3-compatible Spaces API with Spaces access keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |
| `sort` | string | no | Sort field supported by the Spaces Keys API |
| `sort_direction` | string | no | Sort direction (`asc` or `desc`) |
| `name` | string | no | Filter keys by name |
| `bucket` | string | no | Filter keys by bucket name |
| `permission` | string | no | Filter keys by permission |

### Example

```ruby
result = app.integrations.digitalocean.list_spaces(bucket: "assets", permission: "read")
result.spaces_keys.each do |key|
  puts((key.name).to_s + " - " + (key.permission).to_s)
end
```
---

## list_kubernetes

List Kubernetes (DOKS) clusters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Items per page |

### Example

```ruby
result = app.integrations.digitalocean.list_kubernetes_clusters()
result.kubernetes_clusters.each do |cluster|
  puts((cluster.name).to_s + " (" + (cluster.version).to_s + ") - " + (cluster.region).to_s)
end
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.digitalocean.get_current_user()
puts("Account: " + (result.account.email).to_s + " (" + (result.account.uuid).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple DigitalOcean accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.digitalocean.list_droplets()
# Explicit default (portable across setups)
app.integrations.digitalocean.default.list_droplets()
# Named accounts
app.integrations.digitalocean.production.list_droplets()
app.integrations.digitalocean.staging.list_droplets()
```
All functions are identical across accounts — only the credentials differ.
