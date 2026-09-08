# Rollbar — Ruby API Reference

## list_projects

List all projects in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of projects to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```ruby
result = app.integrations.rollbar.list_projects(limit: 50, offset: 0)
result.result.projects.each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s + " (status: " + (project.status).to_s + ")")
end
```
---

## get_project

Get details for a specific Rollbar project by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```ruby
result = app.integrations.rollbar.get_project(id: 12345)
project = result.result
puts("Project: " + (project.name).to_s)
puts("Status: " + (project.status).to_s)
```
---

## list_items

List error items (occurrences) in Rollbar with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by project ID |
| `limit` | integer | no | Maximum number of items to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `level` | string | no | Filter by level: `debug`, `info`, `warning`, `error`, `critical` |
| `status` | string | no | Filter by status: `active`, `resolved`, `muted` |
| `environment` | string | no | Filter by environment name (e.g., `production`, `staging`) |

### Example

```ruby
# List active errors in production
result = app.integrations.rollbar.list_items(status: "active", environment: "production", level: "error", limit: 10)
result.result.items.each do |item|
  puts((item.counter).to_s + ": " + (item.title).to_s + " (level: " + (item.level).to_s + ")")
end
```
---

## get_item

Get details for a specific Rollbar error item by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The item (counter) ID |

### Example

```ruby
result = app.integrations.rollbar.get_item(id: 47)
item = result.result
puts("Title: " + (item.title).to_s)
puts("Level: " + (item.level).to_s)
puts("Status: " + (item.status).to_s)
puts("Occurrences: " + (item.total_occurrences).to_s)
```
---

## list_deploys

List recent deploys across your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `environment` | string | no | Filter by environment name (e.g., `production`) |
| `limit` | integer | no | Maximum number of deploys to return (default: 20) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.rollbar.list_deploys(environment: "production", limit: 10, page: 1)
result.result.deploys.each do |deploy|
  puts((deploy.project_id).to_s + ": " + (deploy.revision).to_s + " by " + (deploy.username).to_s)
end
```
---

## list_teams

List all teams in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of teams to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```ruby
result = app.integrations.rollbar.list_teams(limit: 50)
result.result.teams.each do |team|
  puts((team.id).to_s + ": " + (team.name).to_s + " (access: " + (team.access_level).to_s + ")")
end
```
---

## get_current_user

Get details about the currently authenticated Rollbar user. No parameters required.

### Example

```ruby
result = app.integrations.rollbar.get_current_user()
user = result.result
puts("User: " + (user.username).to_s + " (" + (user.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Rollbar accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.rollbar.list_projects()
# Explicit default (portable across setups)
app.integrations.rollbar.default.list_projects()
# Named accounts
app.integrations.rollbar.work.list_projects()
app.integrations.rollbar.personal.list_projects()
```
All functions are identical across accounts — only the credentials differ.
