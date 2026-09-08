# Knock — Ruby API Reference

## list_workflows

List notification workflows from Knock.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of workflows to return (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.knock.list_workflows(limit: 10, page: 1)
result.data.each do |workflow|
  puts((workflow.id).to_s + ": " + (workflow.name).to_s)
end
```
---

## get_workflow

Get details of a specific notification workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID |

### Example

```ruby
result = app.integrations.knock.get_workflow(id: "welcome-flow")
puts("Workflow: " + (result.name).to_s)
puts("Steps: " + (result.steps.length).to_s)
```
---

## trigger_workflow

Trigger a notification workflow for one or more recipients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID to trigger |
| `recipients` | array | yes | Array of recipient identifiers (user IDs or emails) |
| `data` | object | no | Payload data for template merge variables |
| `cancellation_criteria` | object | no | Cancellation criteria for the workflow run |

### Example

```ruby
result = app.integrations.knock.trigger_workflow(id: "welcome", recipients: ["user-123", "user-456"], data: {name: "John", company: "Acme"})
puts("Workflow run ID: " + (result.id).to_s)
```
### With cancellation criteria

```ruby
result = app.integrations.knock.trigger_workflow(id: "order-confirmation", recipients: ["user-123"], data: {order_id: "ORD-001"}, cancellation_criteria: {key: "order_id", criteria: "ORD-001"})
```
---

## list_messages

List notification messages, optionally filtered by status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of messages to return (default: 25) |
| `page` | integer | no | Page number for pagination |
| `status` | string | no | Filter by status: sent, delivered, undelivered, opened |

### Example

```ruby
result = app.integrations.knock.list_messages(limit: 10, status: "delivered")
result.data.each do |msg|
  puts((msg.id).to_s + " -> " + (msg.status).to_s)
end
```
---

## get_message

Get details of a specific notification message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The message ID |

### Example

```ruby
result = app.integrations.knock.get_message(id: "msg-abc123")
puts("Status: " + (result.status).to_s)
puts("Channel: " + (result.channel_id).to_s)
```
---

## list_recipients

List notification recipients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of recipients to return (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
result = app.integrations.knock.list_recipients(limit: 50)
result.data.each do |recipient|
  puts((recipient.id).to_s + ": " + ((recipient.email || "no email")).to_s)
end
```
---

## get_current_user

Get the currently authenticated Knock user. Useful for verifying credentials.

### Parameters

None.

### Example

```ruby
result = app.integrations.knock.get_current_user()
puts("User: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Knock accounts configured, use account-specific namespaces:

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
