# Telegram — Lua API Reference

## send_message

Send a text message to a Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Unique identifier for the target chat or @username of the target channel. |
| `text` | string | yes | Text of the message to send. |
| `parse_mode` | string | no | Parse mode: Markdown, MarkdownV2, or HTML. |
| `reply_to_message_id` | integer | no | ID of the original message if this is a reply. |
| `disable_notification` | boolean | no | Send the message silently. Default: false. |

### Response

Returns the sent message object:

| Field | Type | Description |
|-------|------|-------------|
| `message_id` | integer | Unique message identifier. |
| `date` | integer | Send date as Unix timestamp. |
| `chat` | object | Chat the message was sent to. |
| `from` | object | Bot info that sent the message. |
| `text` | string | The message text. |

### Example

```lua
local msg = app.integrations.telegram.send_message({
  chat_id = "123456789",
  text = "Hello from the AI agent! 🤖",
  parse_mode = "Markdown"
})

print("Sent message ID: " .. msg.message_id)
```

---

## list_updates

Get incoming updates (messages, callbacks, etc.) for the bot.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offset` | integer | no | Identifier of the first update to return. Must be one greater than the highest previously received update_id. |
| `limit` | integer | no | Number of updates to fetch (1–100). Default: 100. |
| `timeout` | integer | no | Long polling timeout in seconds. Default: 0. |

### Response

Returns an array of update objects:

| Field | Type | Description |
|-------|------|-------------|
| `update_id` | integer | Unique update identifier. |
| `message` | object | New incoming message (if present). |
| `edited_message` | object | Edited message (if present). |
| `channel_post` | object | New channel post (if present). |
| `callback_query` | object | Callback query (if present). |

### Example

```lua
local updates = app.integrations.telegram.list_updates({
  limit = 10
})

for _, update in ipairs(updates) do
  if update.message then
    print("From: " .. update.message.from.first_name .. " — " .. update.message.text)
  end
end
```

---

## get_me

Get information about the authenticated Telegram bot.

### Parameters

None.

### Response

Returns a bot user object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Bot user ID. |
| `is_bot` | boolean | Always true for bots. |
| `first_name` | string | Bot display name. |
| `username` | string | Bot @username. |
| `can_join_groups` | boolean | Whether the bot can join groups. |
| `can_read_all_group_messages` | boolean | Whether the bot receives all group messages. |

### Example

```lua
local bot = app.integrations.telegram.get_me({})

print("Bot: @" .. bot.username .. " (" .. bot.first_name .. ")")
```

---

## list_chats

List recent chats the bot has interacted with.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of updates to scan for chats (1–100). Default: 100. |

### Response

Returns an array of chat summary objects:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Chat ID. |
| `type` | string | Chat type: private, group, supergroup, or channel. |
| `title` | string | Chat title (for groups/channels). |
| `username` | string | Chat @username (if available). |
| `first_name` | string | First name (for private chats). |
| `last_name` | string | Last name (for private chats). |

### Example

```lua
local chats = app.integrations.telegram.list_chats({
  limit = 50
})

for _, chat in ipairs(chats) do
  local name = chat.title or (chat.first_name or "Unknown")
  print(name .. " (" .. chat.type .. ") — " .. chat.id)
end
```

---

## get_chat

Get information about a specific Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Unique identifier for the target chat or @username of the target channel. |

### Response

Returns a chat object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Chat ID. |
| `type` | string | Chat type: private, group, supergroup, or channel. |
| `title` | string | Chat title (for groups/channels). |
| `username` | string | Chat @username (if available). |
| `first_name` | string | First name (for private chats). |
| `last_name` | string | Last name (for private chats). |
| `description` | string | Chat description (for groups/channels). |
| `member_count` | integer | Number of members (for groups/channels). |

### Example

```lua
local chat = app.integrations.telegram.get_chat({
  chat_id = "-1001234567890"
})

print("Chat: " .. (chat.title or "DM") .. " (" .. chat.type .. ")")
if chat.member_count then
  print("Members: " .. chat.member_count)
end
```

---

## send_photo

Send a photo to a Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Unique identifier for the target chat or @username of the target channel. |
| `photo` | string | yes | URL of the photo or file_id of a photo already on Telegram servers. |
| `caption` | string | no | Photo caption (0–1024 characters). |
| `parse_mode` | string | no | Parse mode for the caption: Markdown, MarkdownV2, or HTML. |
| `reply_to_message_id` | integer | no | ID of the original message if this is a reply. |
| `disable_notification` | boolean | no | Send silently. Default: false. |

### Response

Returns the sent message object with photo array.

### Example

```lua
local msg = app.integrations.telegram.send_photo({
  chat_id = "123456789",
  photo = "https://example.com/photo.jpg",
  caption = "Check this out! 📸",
  parse_mode = "Markdown"
})

print("Sent photo, message ID: " .. msg.message_id)
```

---

## get_current_user

Get the authenticated bot user profile.

### Parameters

None.

### Response

Returns a bot user object (same as get_me):

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Bot user ID. |
| `is_bot` | boolean | Always true. |
| `first_name` | string | Bot display name. |
| `username` | string | Bot @username. |

### Example

```lua
local bot = app.integrations.telegram.get_current_user({})

print("Bot: @" .. bot.username .. " (" .. bot.first_name .. ")")
```

---

## Multi-Account Usage

If you have multiple Telegram bots configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.telegram.send_message({chat_id = "123", text = "Hello"})

-- Explicit default (portable across setups)
app.integrations.telegram.default.send_message({chat_id = "123", text = "Hello"})

-- Named accounts
app.integrations.telegram.sales_bot.send_message({chat_id = "123", text = "Hello"})
app.integrations.telegram.support_bot.send_message({chat_id = "123", text = "Hello"})
```

All functions are identical across accounts — only the bot token differs.
