# Freshchat — Ruby API Reference

## list_conversations

List support conversations with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50, max: 100) |
| `status` | string | no | Filter by status: `"new"`, `"open"`, `"pending"`, `"resolved"`, `"closed"` |
| `inbox_id` | string | no | Filter by inbox ID |

### Examples

```ruby
# List open conversations
result = app.integrations.freshchat.list_conversations(status: "open", per_page: 20)
(result.conversations || []).each do |conv|
  puts((conv.id).to_s + ": " + ((conv.status || "unknown")).to_s)
end
```
```ruby
# Paginate through resolved conversations
result = app.integrations.freshchat.list_conversations(status: "resolved", page: 1, per_page: 50)
```
---

## get_conversation

Get full details of a specific conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The conversation ID |

### Example

```ruby
result = app.integrations.freshchat.get_conversation(id: "abc-123-def")
puts("Status: " + (result.status).to_s)
puts("Created (Unix seconds): " + (result.created_time).to_s)
```
---

## create_conversation

Start a new support conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | ID of the user to associate with the conversation |
| `initial_message` | string | yes | First message in the conversation |
| `channel_id` | string | no | Optional channel ID for routing |

### Example

```ruby
result = app.integrations.freshchat.create_conversation(user_id: "user-456", initial_message: "I need help with my subscription", channel_id: "channel-789")
puts("Created conversation: " + (result.conversation_id).to_s)
```
---

## list_agents

List support agents with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50) |

### Example

```ruby
result = app.integrations.freshchat.list_agents(page: 1, per_page: 25)
(result.agents || []).each do |agent|
  puts((agent.first_name).to_s + " (" + (agent.email).to_s + ") - " + ((agent.status || "offline")).to_s)
end
```
---

## get_agent

Get details of a specific agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The agent ID |

### Example

```ruby
result = app.integrations.freshchat.get_agent(id: "agent-123")
puts("Agent: " + (result.first_name).to_s + " " + ((result.last_name || "")).to_s)
puts("Email: " + (result.email).to_s)
```
---

## list_groups

List support groups (teams).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50) |

### Example

```ruby
result = app.integrations.freshchat.list_groups(page: 1, per_page: 50)
(result.groups || []).each do |group|
  puts((group.id).to_s + ": " + (group.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.freshchat.get_current_user()
puts("Logged in as: " + ((result.first_name || "")).to_s + " " + ((result.last_name || "")).to_s)
puts("Email: " + ((result.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Freshchat accounts configured, use account-specific namespaces:

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
