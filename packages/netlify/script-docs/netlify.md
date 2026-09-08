# Netlify — Ruby API Reference

## create_site

Create a new Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the site |
| `custom_domain` | string | no | Custom domain to assign to the site |
| `repo` | object | no | Repository configuration for continuous deployment |
| `body` | object | no | Additional site configuration fields |

### Example

```ruby
result = app.integrations.netlify.create_site(name: "agent-preview", body: {password: "preview-password"})
puts("Created site: " + (result.id).to_s)
```
---

## list_sites

List all Netlify sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by site name |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 30) |

### Examples

```ruby
# List all sites
result = app.integrations.netlify.list_sites()
result.sites.each do |site|
  puts((site.name).to_s + " (" + (site.state).to_s + ") - " + (site.url).to_s)
end
```
```ruby
# Filter by name
result = app.integrations.netlify.list_sites(name: "my-site")
```
---

## get_site

Get detailed information about a specific Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier or site name (e.g., "abc123" or "mysite.netlify.app") |

### Examples

```ruby
result = app.integrations.netlify.get_site(site_id: "abc123-def456")
puts("Site: " + (result.name).to_s)
puts("URL: " + (result.ssl_url).to_s)
puts("State: " + (result.state).to_s)
puts("Custom domain: " + ((result.custom_domain || "none")).to_s)
```
---

## delete_site

Delete a Netlify site permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID to delete |

### Example

```ruby
app.integrations.netlify.delete_site(site_id: "abc123-def456")
```
---

## create_deploy

Trigger a new deploy for a Netlify site. The deploy body should follow Netlify's deploy API shape, such as file digests for atomic deploys or deploy options supported by the API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |
| `title` | string | no | Deploy title, sent as a Netlify API query parameter |
| `branch` | string | no | Branch to deploy |
| `framework` | string | no | Framework override |
| `body` | object | no | Additional deploy body fields |

### Example

```ruby
result = app.integrations.netlify.create_deploy(site_id: "abc123-def456", title: "Agent deploy", body: {async: true})
puts("Deploy: " + (result.id).to_s + " " + (result.state).to_s)
```
---

## list_deploys

List deploys for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of deploys per page (default: 30) |

### Examples

```ruby
result = app.integrations.netlify.list_deploys(site_id: "abc123-def456")
result.deploys.each do |deploy|
  puts((deploy.state).to_s + " - " + ((deploy.branch || "unknown")).to_s + " @ " + (deploy.created_at).to_s)
end
```
---

## get_deploy

Get detailed information about a specific Netlify deploy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deploy_id` | string | yes | The deploy identifier |

### Examples

```ruby
result = app.integrations.netlify.get_deploy(deploy_id: "789xyz")
puts("State: " + (result.state).to_s)
puts("Branch: " + ((result.branch || "unknown")).to_s)
puts("Deploy time: " + ((result.deploy_time || 0)).to_s + "s")
puts("URL: " + ((result.deploy_url || "N/A")).to_s)
```
---

## list_forms

List all forms for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```ruby
result = app.integrations.netlify.list_forms(site_id: "abc123-def456")
result.forms.each do |form|
  puts((form.name).to_s + " - " + (form.submission_count).to_s + " submissions")
end
```
---

## list_dns_zones

List all DNS zones configured in Netlify.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Number of DNS zones per page |

### Examples

```ruby
result = app.integrations.netlify.list_dns_zones()
result.dns_zones.each do |zone|
  puts((zone.name).to_s + " (" + ((zone.domain || "N/A")).to_s + ")")
  zone.nameservers.each do |ns|
    puts("  NS: " + (ns).to_s)
  end
end
```
---

## get_current_user

Get details of the currently authenticated Netlify user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.netlify.get_current_user()
puts("User: " + ((result.full_name || result.email)).to_s)
puts("Email: " + (result.email).to_s)
puts("Sites: " + ((result.site_count || 0)).to_s)
```
---

## Multi-Account Usage

If you have multiple Netlify accounts configured, use account-specific namespaces:

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
