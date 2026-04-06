# Google Chat — Lua API Reference

## list_spaces

List Google Chat spaces the authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Maximum number of spaces to return (1–1000, default 100) |
| `pageToken` | string | no | Page token from a previous response for pagination |

### Example

```lua
local result = app.integrations.google_chat.list_spaces({
  pageSize = 50
})

for _, space in ipairs(result.spaces) do
  print(space.displayName .. " (" .. space.name .. ")")
end

-- Fetch next page if available
if result.nextPageToken then
  local next = app.integrations.google_chat.list_spaces({
    pageSize = 50,
    pageToken = result.nextPageToken
  })
end
```

---

## get_space

Get details about a specific Google Chat space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |

### Example

```lua
local space = app.integrations.google_chat.get_space({
  name = "spaces/AAAAAAAAAAA"
})

print("Space: " .. space.displayName)
print("Type: " .. space.spaceType)
```

---

## list_messages

List messages in a Google Chat space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |
| `pageSize` | integer | no | Maximum number of messages (1–1000, default 1000) |
| `pageToken` | string | no | Page token from a previous response for pagination |

### Example

```lua
local result = app.integrations.google_chat.list_messages({
  parent = "spaces/AAAAAAAAAAA",
  pageSize = 50
})

for _, msg in ipairs(result.messages) do
  print(msg.sender.displayName .. ": " .. (msg.text or "[card message]"))
end
```

---

## get_message

Get a specific message from a Google Chat space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |
| `name` | string | yes | Resource name of the message, relative to the space (e.g., `"messages/BBBBBBBBBBB"`) |

### Example

```lua
local msg = app.integrations.google_chat.get_message({
  parent = "spaces/AAAAAAAAAAA",
  name = "messages/BBBBBBBBBBB"
})

print(msg.text)
```

---

## create_message

Send a message to a Google Chat space. Either `text` or `cardsV2` must be provided.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |
| `text` | string | no | Plain-text body of the message |
| `cardsV2` | array | no | Array of card v2 widgets for rich messages |

### Example — Plain text

```lua
local msg = app.integrations.google_chat.create_message({
  parent = "spaces/AAAAAAAAAAA",
  text = "Hello from the AI agent!"
})

print("Sent message: " .. msg.name)
```

### Example — Card message

```lua
local msg = app.integrations.google_chat.create_message({
  parent = "spaces/AAAAAAAAAAA",
  cardsV2 = {
    {
      cardId = "status-card",
      card = {
        sections = {
          {
            widgets = {
              {
                textParagraph = {
                  text = "<b>Build Status</b>: Passed ✅"
                }
              }
            }
          }
        }
      }
    }
  }
})
```

---

## list_memberships

List members (human users and bots) in a Google Chat space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |
| `pageSize` | integer | no | Maximum number of memberships (1–1000, default 1000) |
| `pageToken` | string | no | Page token from a previous response for pagination |

### Example

```lua
local result = app.integrations.google_chat.list_memberships({
  parent = "spaces/AAAAAAAAAAA"
})

for _, member in ipairs(result.memberships) do
  print(member.member.displayName .. " — " .. member.role)
end
```

---

## get_current_user

Get the authenticated user's membership details in a Google Chat space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Resource name of the space (e.g., `"spaces/AAAAAAAAAAA"`) |

### Example

```lua
local me = app.integrations.google_chat.get_current_user({
  parent = "spaces/AAAAAAAAAAA"
})

print("Display name: " .. me.member.displayName)
print("Role: " .. me.role)
```

---

## Multi-Account Usage

If you have multiple Google Chat accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google_chat.list_spaces({...})

-- Explicit default (portable across setups)
app.integrations.google_chat.default.list_spaces({...})

-- Named accounts
app.integrations.google_chat.work.list_spaces({...})
app.integrations.google_chat.personal.list_spaces({...})
```

All functions are identical across accounts — only the credentials differ.
