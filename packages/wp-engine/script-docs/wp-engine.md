# WP Engine — Ruby API Reference

## list_sites

List WP Engine sites with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of sites per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```ruby
# List sites
result = app.call("integrations.wp-engine.list_sites", limit: 10, page: 1)
result.sites.each do |site|
  puts((site.id).to_s + ": " + (site.name).to_s + " (" + (site.status).to_s + ")")
end
```
---

## get_site

Get details for a specific WP Engine site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The site ID |

### Examples

```ruby
result = app.call("integrations.wp-engine.get_site", id: "12345")
puts(result.name)
puts(result.status)
puts(result.created_at)
```
---

## list_installs

List WP Engine installs with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of installs per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```ruby
# List installs
result = app.call("integrations.wp-engine.list_installs", limit: 10, page: 1)
result.installs.each do |install|
  puts((install.id).to_s + ": " + (install.name).to_s + " - " + (install.environment).to_s)
end
```
---

## get_install

Get details for a specific WP Engine install.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The install ID |

### Examples

```ruby
result = app.call("integrations.wp-engine.get_install", id: "67890")
puts(result.name)
puts(result.environment)
puts(result.php_version)
puts(result.status)
```
---

## list_domains

List domains across WP Engine installs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of domains per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```ruby
result = app.call("integrations.wp-engine.list_domains", limit: 50, page: 1)
result.domains.each do |domain|
  puts((domain.name).to_s + " -> " + (domain.installs_id).to_s)
end
```
---

## list_users

List WP Engine users with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```ruby
result = app.call("integrations.wp-engine.list_users", limit: 10, page: 1)
result.users.each do |user|
  puts((user.id).to_s + ": " + (user.email).to_s + " (" + (user.role).to_s + ")")
end
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```ruby
result = app.call("integrations.wp-engine.get_current_user")
puts("Logged in as: " + (result.email).to_s + " (" + (result.id).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple WP Engine accounts configured, use account-specific namespaces:

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
