# Heroku — Ruby API Reference

## list_apps

List all Heroku apps the authenticated user has access to.

### Parameters

None.

### Example

```ruby
result = app.integrations.heroku.list_apps()
result.each do |app|
  puts((app.name).to_s + " (" + (app.region.name).to_s + ") - " + (app.web_url).to_s)
end
```
---

## get_app

Get details for a specific Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name (e.g., `"my-app"` or the UUID) |

### Example

```ruby
result = app.integrations.heroku.get_app(app_id: "my-app")
puts((result.name).to_s + " - " + (result.stack).to_s + " - " + (result.git_url).to_s)
```
---

## list_dynos

List all dynos for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```ruby
result = app.integrations.heroku.list_dynos(app_id: "my-app")
result.each do |dyno|
  puts((dyno.name).to_s + " (" + (dyno.type).to_s + ") - " + (dyno.state).to_s + " - size: " + (dyno.size).to_s)
end
```
---

## list_addons

List all add-ons attached to a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```ruby
result = app.integrations.heroku.list_add_ons(app_id: "my-app")
result.each do |addon|
  puts((addon.name).to_s + " (" + (addon.plan.name).to_s + ") - " + (addon.state).to_s)
end
```
---

## list_domains

List all domains for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```ruby
result = app.integrations.heroku.list_domains(app_id: "my-app")
result.each do |domain|
  puts((domain.hostname).to_s + " (" + (domain.kind).to_s + ") - " + (domain.status).to_s)
end
```
---

## list_collaborators

List all collaborators for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```ruby
result = app.integrations.heroku.list_collaborators(app_id: "my-app")
result.each do |collab|
  puts((collab.user.email).to_s + " - role: " + (collab.role).to_s)
end
```
---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.heroku.get_current_user()
puts("Account: " + (result.email).to_s + " - verified: " + ((result.verified).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple Heroku accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.heroku.list_apps()
# Explicit default (portable across setups)
app.integrations.heroku.default.list_apps()
# Named accounts
app.integrations.heroku.production.list_apps()
app.integrations.heroku.staging.list_apps()
```
All functions are identical across accounts — only the credentials differ.
