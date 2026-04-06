# Lark Suite — Lua API Reference

## list_chats

List chats the current authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of chats per page (max 50, default 20) |
| `page_token` | string | no | Pagination cursor from a previous response |

### Examples

```lua
-- List first page of chats
local result = app.integrations.lark.list_chats({
  page_size = 20
})

for _, chat in ipairs(result.data.items) do
  print(chat.name .. " (" .. chat.chat_id .. ")")
end

-- Get next page
if result.data.has_more then
  local next = app.integrations.lark.list_chats({
    page_size = 20,
    page_token = result.data.page_token
  })
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

```lua
local result = app.integrations.lark.get_chat({
  chat_id = "oc_a0553eda9014c201e6969b478895c230"
})
print("Chat: " .. result.data.name)
print("Members: " .. result.data.member_count)
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

```lua
local result = app.integrations.lark.create_chat({
  chat_id = "oc_my_project_chat",
  name = "Project Discussion"
})
print("Created chat: " .. result.data.chat_id)
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

```lua
local result = app.integrations.lark.list_messages({
  chat_id = "oc_a0553eda9014c201e6969b478895c230",
  page_size = 10
})

for _, msg in ipairs(result.data.items) do
  print(msg.sender.id .. ": " .. msg.body.content)
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

```lua
-- Send a simple text message
app.integrations.lark.send_message({
  chat_id = "oc_a0553eda9014c201e6969b478895c230",
  content = '{"text":"Hello team!"}',
  msg_type = "text"
})

-- Send plain text (auto-wrapped)
app.integrations.lark.send_message({
  chat_id = "oc_a0553eda9014c201e6969b478895c230",
  content = "Quick update: deployment complete.",
  msg_type = "text"
})
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

```lua
local result = app.integrations.lark.list_members({
  chat_id = "oc_a0553eda9014c201e6969b478895c230"
})

for _, member in ipairs(result.data.items) do
  print(member.name .. " (" .. member.member_id .. ")")
end
```

---

## get_current_user

Get information about the currently authenticated Lark user.

### Parameters

None.

### Example

```lua
local result = app.integrations.lark.get_current_user({})
print("User: " .. result.data.name)
print("ID: " .. result.data.user_id)
```

---

## Multi-Account Usage

If you have multiple Lark accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.lark.list_chats({})

-- Explicit default (portable across setups)
app.integrations.lark.default.list_chats({})

-- Named accounts
app.integrations.lark.work.send_message({
  chat_id = "oc_abc123",
  content = "Hello from work account!",
  msg_type = "text"
})

app.integrations.lark.personal.list_chats({})
```

All functions are identical across accounts — only the credentials differ.
