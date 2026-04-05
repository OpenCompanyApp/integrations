# LINE Messaging — Lua API Reference

## send_message

Send a push message to a specific LINE user, group, or room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | LINE user ID, group ID, or room ID |
| `messages` | array | yes | Array of message objects (see message types below) |
| `notification_disabled` | boolean | no | Suppress push notification (default: `false`) |

### Message Types

#### Text Message

```lua
{ type = "text", text = "Hello, world!" }
```

#### Image Message

```lua
{ type = "image", originalContentUrl = "https://example.com/image.jpg", previewImageUrl = "https://example.com/preview.jpg" }
```

#### Sticker Message

```lua
{ type = "sticker", packageId = "446", stickerId = "1988" }
```

#### Location Message

```lua
{ type = "location", title = "Tokyo Tower", address = "4-2-8 Shibakoen, Minato, Tokyo", latitude = 35.6598, longitude = 139.7394 }
```

### Examples

#### Send a text message

```lua
local result = app.integrations.line.send_message({
  to = "U4af4980629...",
  messages = {
    { type = "text", text = "Hello! This is a message from the bot." }
  }
})

print("Sent " .. result.message_count .. " message(s)")
```

#### Send multiple messages

```lua
local result = app.integrations.line.send_message({
  to = "U4af4980629...",
  messages = {
    { type = "text", text = "Here is the update:" },
    { type = "sticker", packageId = "446", stickerId = "1988" }
  }
})
```

---

## broadcast_message

Broadcast a message to all friends of the LINE Official Account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | yes | Array of message objects (same types as send_message) |
| `notification_disabled` | boolean | no | Suppress push notification (default: `false`) |

### Example

```lua
local result = app.integrations.line.broadcast_message({
  messages = {
    { type = "text", text = "📢 New announcement for everyone!" }
  }
})

print("Broadcast sent with " .. result.message_count .. " message(s)")
```

---

## get_profile

Get the profile information of a LINE user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The LINE user ID (e.g., `"U4af4980629..."`) |

### Response Fields

| Field | Description |
|-------|-------------|
| `displayName` | User's display name |
| `userId` | LINE user ID |
| `pictureUrl` | Profile image URL |
| `statusMessage` | Status message |
| `language` | User's language |

### Example

```lua
local result = app.integrations.line.get_profile({
  user_id = "U4af4980629..."
})

print("Name: " .. result.displayName)
print("Status: " .. (result.statusMessage or "none"))
```

---

## list_friends

List friends (followers) of the LINE Official Account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 100, max: 1000) |
| `start` | string | no | Continuation token from a previous response |

### Example

```lua
local result = app.integrations.line.list_friends({
  limit = 50
})

for _, user in ipairs(result.friends or {}) do
  print("Friend: " .. (user.displayName or user.userId))
end

-- Paginate
if result.next then
  local next = app.integrations.line.list_friends({
    start = result.next
  })
end
```

---

## get_current_user

Get the profile of the LINE Official Account (bot) itself.

### Parameters

None.

### Example

```lua
local result = app.integrations.line.get_current_user({})

print("Bot name: " .. result.displayName)
print("Bot ID: " .. result.userId)
```

---

## Multi-Account Usage

If you have multiple LINE accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.line.send_message({...})

-- Explicit default (portable across setups)
app.integrations.line.default.send_message({...})

-- Named accounts
app.integrations.line.production.send_message({...})
app.integrations.line.staging.send_message({...})
```

All functions are identical across accounts — only the credentials differ.
