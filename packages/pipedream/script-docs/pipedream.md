# Pipedream — Ruby API Reference

## list_workflows

List automation workflows in Pipedream.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of workflows per page (default: 25, max: 100) |

### Examples

```ruby
result = app.integrations.pipedream.list_workflows(page: 1, limit: 10)
result.data.each do |wf|
  puts((wf.id).to_s + ": " + (wf.name).to_s)
end
```
---

## get_workflow

Get details of a specific workflow by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID |

### Examples

```ruby
result = app.integrations.pipedream.get_workflow(id: "abc_123")
puts(result.data.name)
puts("Status: " + (result.data.status).to_s)
```
---

## list_components

List available Pipedream components (actions, triggers, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Component type filter: "action", "trigger" |
| `limit` | integer | no | Number of components per page (default: 25, max: 100) |

### Examples

```ruby
# List action components
result = app.integrations.pipedream.list_components(type: "action", limit: 20)
result.data.each do |comp|
  puts((comp.key).to_s + " (" + (comp.app).to_s + ")")
end
```
---

## get_component

Get details of a specific component by app and key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | string | yes | App slug (e.g., "slack", "github") |
| `id` | string | yes | Component key or ID (e.g., "send-message") |

### Examples

```ruby
result = app.integrations.pipedream.get_component(app: "slack", id: "send-message")
puts(result.data.name)
puts("Version: " + (result.data.version).to_s)
```
---

## list_connected_accounts

List connected third-party accounts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of accounts per page (default: 25, max: 100) |

### Examples

```ruby
result = app.integrations.pipedream.list_connected_accounts(page: 1, limit: 10)
result.data.each do |acct|
  puts((acct.id).to_s + ": " + (acct.name).to_s + " (" + (acct.app).to_s + ")")
end
```
---

## list_triggers

List event triggers for a specific workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workflow_id` | string | yes | The workflow ID to list triggers for |

### Examples

```ruby
result = app.integrations.pipedream.list_triggers(workflow_id: "abc_123")
result.data.each do |trigger|
  puts((trigger.type).to_s + ": " + ((trigger.name || "unnamed")).to_s)
end
```
---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Examples

```ruby
result = app.integrations.pipedream.get_current_user()
puts("User: " + (result.data.name).to_s)
puts("Email: " + (result.data.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Pipedream accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.pipedream.list_workflows()
# Explicit default (portable across setups)
app.integrations.pipedream.default.list_workflows()
# Named accounts
app.integrations.pipedream.production.list_workflows()
app.integrations.pipedream.staging.list_workflows()
```
All functions are identical across accounts — only the credentials differ.
