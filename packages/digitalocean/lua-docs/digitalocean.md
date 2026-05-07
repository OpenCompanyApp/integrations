# DigitalOcean — Lua API Reference

## list_droplets

List all droplets (virtual machines) in the account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Items per page (default: 20, max: 200) |

### Example

```lua
local result = app.integrations.digitalocean.list_droplets({
  per_page = 50
})

for _, droplet in ipairs(result.droplets) do
  print(droplet.name .. " (" .. droplet.status .. ") - " .. droplet.size_slug)
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

```lua
local result = app.integrations.digitalocean.get_droplet({ id = 12345678 })
local d = result.droplet
print(d.name .. " - " .. d.region.name .. " - " .. d.networks.v4[1].ip_address)
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

```lua
local result = app.integrations.digitalocean.create_droplet({
  name = "web-01",
  region = "ams3",
  size = "s-1vcpu-1gb",
  image = "ubuntu-24-04-x64",
  ssh_keys = { "fingerprint_or_id" },
  tags = { "web", "production" }
})

print("Created droplet: " .. result.droplet.id)
```

---

## delete_droplet

Permanently delete a droplet. **This action is irreversible.**

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The droplet ID to delete |

### Example

```lua
app.integrations.digitalocean.delete_droplet({ id = 12345678 })
print("Droplet deleted")
```

---

## reboot_droplet

Reboot a droplet. The droplet will be temporarily unavailable during the reboot.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The droplet ID to reboot |

### Example

```lua
local result = app.integrations.digitalocean.reboot_droplet({ id = 12345678 })
print("Reboot initiated: " .. result.action.status)
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

```lua
local result = app.integrations.digitalocean.list_domains({})

for _, domain in ipairs(result.domains) do
  print(domain.name .. " (TTL: " .. domain.ttl .. ")")
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

```lua
local result = app.integrations.digitalocean.get_domain({ name = "example.com" })
print(result.domain.name .. " - zone file: " .. result.domain.zone_file)
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

```lua
local result = app.integrations.digitalocean.list_spaces({
  bucket = "assets",
  permission = "read"
})

for _, key in ipairs(result.spaces_keys) do
  print(key.name .. " - " .. key.permission)
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

```lua
local result = app.integrations.digitalocean.list_kubernetes({})

for _, cluster in ipairs(result.kubernetes_clusters) do
  print(cluster.name .. " (" .. cluster.version .. ") - " .. cluster.region)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.digitalocean.get_current_user({})
print("Account: " .. result.account.email .. " (" .. result.account.uuid .. ")")
```

---

## Multi-Account Usage

If you have multiple DigitalOcean accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.digitalocean.list_droplets({})

-- Explicit default (portable across setups)
app.integrations.digitalocean.default.list_droplets({})

-- Named accounts
app.integrations.digitalocean.production.list_droplets({})
app.integrations.digitalocean.staging.list_droplets({})
```

All functions are identical across accounts — only the credentials differ.
