# Lark Suite — Ruby API Reference

## list_chats

List chats the current authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of chats per page (max 50, default 20) |
| `page_token` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
# List first page of chats
result = app.integrations.lark.list_chats(page_size: 20)
result.data.items.each do |chat|
  puts((chat.name).to_s + " (" + (chat.chat_id).to_s + ")")
end
# Get next page
if result.data.has_more
  next_value = app.integrations.lark.list_chats(page_size: 20, page_token: result.data.page_token)
end
```
---

## get_chat

Get detailed information about a specific chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | The chat ID (e.g., `"oc_a0553eda9014c201e6969b478895c230"`) |

### Example

```ruby
result = app.integrations.lark.get_chat(chat_id: "oc_a0553eda9014c201e6969b478895c230")
puts("Chat: " + (result.data.name).to_s)
puts("Members: " + (result.data.member_count).to_s)
```
---

## create_chat

Create a new group chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Unique identifier for the new chat |
| `name` | string | yes | Display name for the group chat |

### Example

```ruby
result = app.integrations.lark.create_chat(chat_id: "oc_my_project_chat", name: "Project Discussion")
puts("Created chat: " + (result.data.chat_id).to_s)
```
---

## list_messages

List messages in a specific chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | The chat ID to list messages from |
| `page_size` | integer | no | Number of messages per page (max 50, default 20) |
| `page_token` | string | no | Pagination cursor from a previous response |

### Example

```ruby
result = app.integrations.lark.list_messages(chat_id: "oc_a0553eda9014c201e6969b478895c230", page_size: 10)
result.data.items.each do |msg|
  puts((msg.sender.id).to_s + ": " + (msg.body.content).to_s)
end
```
---

## send_message

Send a message to a specific chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | The chat ID to send the message to |
| `content` | string | yes | Message content (JSON-encoded for rich types) |
| `msg_type` | string | no | Message type: `"text"`, `"post"`, `"image"`, `"file"`, etc. (default: `"text"`) |

### Message Types

| Type | Content Format | Example |
|------|---------------|---------|
| `text` | `{"text":"Hello"}` | Plain text message |
| `post` | Rich text JSON | Formatted post with sections |
| `image` | `{"image_key":"..."}` | Image message |
| `file` | `{"file_key":"..."}` | File attachment |

### Examples

```ruby
# Send a simple text message
app.integrations.lark.send_message(chat_id: "oc_a0553eda9014c201e6969b478895c230", content: "{\"text\":\"Hello team!\"}", msg_type: "text")
# Send plain text (auto-wrapped)
app.integrations.lark.send_message(chat_id: "oc_a0553eda9014c201e6969b478895c230", content: "Quick update: deployment complete.", msg_type: "text")
```
---

## list_members

List members of a specific chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | The chat ID to list members from |
| `page_size` | integer | no | Number of members per page (max 50, default 20) |
| `page_token` | string | no | Pagination cursor from a previous response |

### Example

```ruby
result = app.integrations.lark.list_members(chat_id: "oc_a0553eda9014c201e6969b478895c230")
result.data.items.each do |member|
  puts((member.name).to_s + " (" + (member.member_id).to_s + ")")
end
```
---

## get_current_user

Get information about the currently authenticated Lark user.

### Parameters

None.

### Example

```ruby
result = app.integrations.lark.get_current_user()
puts("User: " + (result.data.name).to_s)
puts("ID: " + (result.data.user_id).to_s)
```
---

## Multi-Account Usage

If you have multiple Lark accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.lark.list_chats()
# Explicit default (portable across setups)
app.integrations.lark.default.list_chats()
# Named accounts
app.integrations.lark.work.send_message(chat_id: "oc_abc123", content: "Hello from work account!", msg_type: "text")
app.integrations.lark.personal.list_chats()
```
All functions are identical across accounts — only the credentials differ.
