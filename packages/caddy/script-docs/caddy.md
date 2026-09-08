# Caddy — Ruby API Reference

## list_sites

List all Caddy sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 20) |

### Examples

```ruby
# List all sites
result = app.integrations.caddy.list_sites()
result.sites.each do |site|
  puts((site.name).to_s + " (" + (site.status).to_s + ") - " + (site.id).to_s)
end
```
```ruby
# Paginated listing
result = app.integrations.caddy.list_sites(page: 2, per_page: 10)
```
---

## get_site

Get detailed information about a specific Caddy site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```ruby
result = app.integrations.caddy.get_site(site_id: "abc123")
puts("Site: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
```
---

## create_site

Create a new site in Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The domain name for the site (e.g., "example.com") |
| `config` | object | no | Optional site configuration (Caddy JSON config or key-value pairs) |

### Examples

```ruby
# Create a basic site
result = app.integrations.caddy.create_site(name: "mysite.example.com")
puts(result.message)
puts("Site ID: " + (result.id).to_s)
```
```ruby
# Create a site with custom config
result = app.integrations.caddy.create_site(name: "mysite.example.com", config: {auto_https: "on", log_format: "json"})
```
---

## delete_site

Delete a site from Caddy. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier to delete |

### Examples

```ruby
result = app.integrations.caddy.delete_site(site_id: "abc123")
puts(result.message)
```
---

## list_certificates

List all TLS certificates managed by Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of certificates per page (default: 20) |

### Examples

```ruby
# List all certificates
result = app.integrations.caddy.list_certificates()
result.certificates.each do |cert|
  puts((cert.domain).to_s + " expires: " + ((cert.expires_at || "N/A")).to_s)
end
```
```ruby
# Paginated listing
result = app.integrations.caddy.list_certificates(page: 1, per_page: 50)
```
---

## get_certificate

Get detailed information about a specific TLS certificate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `certificate_id` | string | yes | The certificate identifier |

### Examples

```ruby
result = app.integrations.caddy.get_certificate(certificate_id: "cert-abc123")
puts("Domain: " + (result.domain).to_s)
puts("Issuer: " + ((result.issuer || "N/A")).to_s)
puts("Valid from: " + ((result.not_before || "N/A")).to_s)
puts("Expires: " + ((result.not_after || "N/A")).to_s)
puts(("SANs: " + (result.sans).to_s || [].join(", ")))
```
---

## get_current_user

Get details of the currently authenticated Caddy user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.caddy.get_current_user()
puts("User: " + (result.username).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Caddy accounts configured, use account-specific namespaces:

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
