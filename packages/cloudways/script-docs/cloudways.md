# Cloudways — Ruby API Reference

## list_servers

List all servers in the Cloudways account.

### Parameters

None.

### Example

```ruby
result = app.integrations.cloudways.list_servers()
result.servers.each do |server|
  puts((server.label).to_s + " (" + (server.status).to_s + ") - " + (server.server_ips[0]).to_s)
end
```
---

## get_server

Get details for a specific Cloudways server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID to look up |

### Example

```ruby
result = app.integrations.cloudways.get_server(server_id: 12345)
s = result.server
puts((s.label).to_s + " - " + (s.server_ips[0]).to_s + " - " + (s.os).to_s)
```
---

## list_apps

List all applications across all servers in the Cloudways account.

### Parameters

None.

### Example

```ruby
result = app.integrations.cloudways.list_apps()
result.apps.each do |app|
  puts((app.label).to_s + " (" + (app.application).to_s + ") on server " + (app.server_id).to_s)
end
```
---

## get_app

Get details for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to look up |

### Example

```ruby
result = app.integrations.cloudways.get_app(server_id: 12345, app_id: 67890)
a = result.app
puts((a.label).to_s + " - " + (a.application).to_s + " - " + (a.app_fqdn).to_s)
```
---

## list_domains

List domains for a specific Cloudways application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `server_id` | integer | yes | The server ID the application belongs to |
| `app_id` | integer | yes | The application ID to list domains for |

### Example

```ruby
result = app.integrations.cloudways.list_domains(server_id: 12345, app_id: 67890)
result.domains.each do |domain|
  puts((domain.fqdn).to_s + " - primary: " + ((domain.is_primary).to_s).to_s)
end
```
---

## list_projects

List all projects in the Cloudways account.

### Parameters

None.

### Example

```ruby
result = app.integrations.cloudways.list_projects()
result.projects.each do |project|
  puts((project.name).to_s + " (ID: " + (project.id).to_s + ")")
end
```
---

## get_current_user

Get the current authenticated Cloudways account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.cloudways.get_current_user()
puts("Account: " + (result.me.email).to_s + " (" + (result.me.name).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Cloudways accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.cloudways.list_servers()
# Explicit default (portable across setups)
app.integrations.cloudways.default.list_servers()
# Named accounts
app.integrations.cloudways.production.list_servers()
app.integrations.cloudways.staging.list_servers()
```
All functions are identical across accounts — only the credentials differ.
