# Telegram Bot — Lua API Reference

## send_message

Send a text message to a Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Chat ID or username (e.g., `"@channelname"`) |
| `text` | string | yes | Message text (max 4096 characters) |
| `parse_mode` | string | no | Formatting: `"MarkdownV2"`, `"HTML"`, or `"Markdown"` |
| `disable_notification` | boolean | no | Send silently (default: false) |
| `reply_to_message_id` | integer | no | Message ID to reply to |
| `reply_markup` | string | no | JSON-encoded inline keyboard or reply markup |

### Examples

```lua
-- Simple message
local result = app.integrations.telegram.send_message({
  chat_id = "123456789",
  text = "Hello from the bot!"
})

-- Formatted message (Markdown)
local result = app.integrations.telegram.send_message({
  chat_id = "123456789",
  text = "*Bold* and _italic_ text",
  parse_mode = "MarkdownV2"
})

-- Send to a channel
local result = app.integrations.telegram.send_message({
  chat_id = "@mychannel",
  text = "Breaking news update!"
})
```

---

## send_photo

Send a photo to a Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Chat ID or username |
| `photo` | string | yes | URL or file_id of the photo |
| `caption` | string | no | Photo caption (max 1024 characters) |
| `parse_mode` | string | no | Caption formatting mode |
| `disable_notification` | boolean | no | Send silently (default: false) |
| `reply_to_message_id` | integer | no | Message ID to reply to |
| `reply_markup` | string | no | JSON-encoded inline keyboard |

### Examples

```lua
-- Send a photo from URL
local result = app.integrations.telegram.send_photo({
  chat_id = "123456789",
  photo = "https://example.com/image.jpg",
  caption = "Check this out!"
})

-- Send with formatted caption
local result = app.integrations.telegram.send_photo({
  chat_id = "123456789",
  photo = "https://example.com/chart.png",
  caption = "*Monthly Report* - Revenue chart",
  parse_mode = "MarkdownV2"
})
```

---

## get_updates

Get incoming updates for the bot — messages, callback queries, and other events.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offset` | integer | no | First update ID to return (use last_id + 1 to acknowledge) |
| `limit` | integer | no | Max updates to return (1-100, default: 100) |
| `timeout` | integer | no | Long polling timeout in seconds (0-300, default: 0) |
| `allowed_updates` | array | no | Update types to receive, e.g. `{"message", "callback_query"}` |

### Examples

```lua
-- Get recent updates
local result = app.integrations.telegram.get_updates({
  limit = 10
})

for _, update in ipairs(result.updates) do
  if update.message then
    print(update.message.from.first_name .. ": " .. update.message.text)
  end
end

-- Acknowledge and get new updates
local result = app.integrations.telegram.get_updates({
  offset = last_update_id + 1,
  limit = 10
})
```

---

## list_chats

List chats the bot has interacted with. Since Telegram has no direct "list chats" API, this derives chats from recent updates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max chats to return (default: 50) |

### Examples

```lua
local result = app.integrations.telegram.list_chats({
  limit = 20
})

for _, chat in ipairs(result.chats) do
  print(chat.type .. ": " .. (chat.title or chat.first_name or chat.id))
end
```

---

## get_chat

Get information about a specific Telegram chat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `chat_id` | string | yes | Chat ID or username |

### Examples

```lua
local chat = app.integrations.telegram.get_chat({
  chat_id = "123456789"
})

print("Type: " .. chat.type)
print("Title: " .. (chat.title or "N/A"))
print("Members: " .. (chat.member_count or "unknown"))

-- Get channel info by username
local channel = app.integrations.telegram.get_chat({
  chat_id = "@mychannel"
})
```

---

## get_me

Get information about the authenticated bot.

### Parameters

None.

### Examples

```lua
local bot = app.integrations.telegram.get_me({})

print("Bot: @" .. bot.username)
print("Name: " .. bot.first_name)
print("Can join groups: " .. tostring(bot.can_join_groups))
print("Can read messages: " .. tostring(bot.can_read_all_group_messages))
```

---

## Multi-Account Usage

If you have multiple Telegram bots configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.telegram.send_message({...})

-- Explicit default (portable across setups)
app.integrations.telegram.default.send_message({...})

-- Named accounts
app.integrations.telegram.support_bot.send_message({...})
app.integrations.telegram.notifications.send_message({...})
```

All functions are identical across accounts — only the credentials differ.
