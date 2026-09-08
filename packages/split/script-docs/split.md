# Split — Ruby API Reference

## list_splits

List feature splits in a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |
| `limit` | integer | no | Max splits to return (default: 20, max: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```ruby
# List splits in default workspace
result = app.integrations.split.list()
result.splits.each do |split|
  puts((split.name).to_s + " (" + (split.trafficTypeName).to_s + ")")
end
# Paginated listing
result = app.integrations.split.list(limit: 50, offset: 0)
# Specific workspace
result = app.integrations.split.list(workspace_id: "abc123")
```
---

## get_split

Get detailed information about a specific feature split.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `split_name` | string | yes | The split name, e.g. `"new-checkout-flow"` |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```ruby
result = app.integrations.split.get(split_name: "new-checkout-flow")
puts("Split: " + (result.name).to_s)
puts("Traffic Type: " + (result.trafficTypeName).to_s)
puts("Killed: " + ((result.killed).to_s).to_s)
puts("Treatments: " + (result.treatments.length).to_s)
```
---

## create_split

Create a new feature split in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The split name |
| `traffic_type_name` | string | yes | Traffic type name, e.g. `"user"` |
| `description` | string | no | Optional description |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```ruby
# Create a basic split
result = app.integrations.split.create(name: "new-checkout-flow", traffic_type_name: "user")
puts(result.message)
# Create with description
result = app.integrations.split.create(name: "new-pricing-page", traffic_type_name: "user", description: "Controls the new pricing page rollout")
puts(result.message)
```
---

## list_environments

List all environments for a Split workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```ruby
result = app.integrations.split.list_environments()
result.environments.each do |env|
  puts((env.id).to_s + ": " + (env.name).to_s + " (" + (env.type).to_s + ")")
end
```
---

## get_environment

Get detailed information about a specific Split environment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `environment_id` | string | yes | The environment ID |
| `workspace_id` | string | no | Workspace ID (defaults to configured workspace) |

### Examples

```ruby
result = app.integrations.split.get_environment(environment_id: "env-123")
puts("Environment: " + (result.name).to_s)
puts("Type: " + (result.type).to_s)
puts("Status: " + (result.status).to_s)
```
---

## list_workspaces

List all Split workspaces.

### Parameters

This tool takes no parameters.

### Examples

```ruby
result = app.integrations.split.list_workspaces()
result.workspaces.each do |ws|
  puts((ws.id).to_s + ": " + (ws.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated Split user.

### Parameters

This tool takes no parameters.

### Examples

```ruby
result = app.integrations.split.get_current_user()
puts("User: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Type: " + (result.type).to_s)
```
---

## Multi-Account Usage

If you have multiple Split accounts configured, use account-specific namespaces:

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
