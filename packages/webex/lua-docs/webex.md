# Cisco Webex — Lua API Reference

## list_rooms

List Webex spaces (rooms) the authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max` | integer | no | Maximum number of rooms to return (1–1000, default: 100) |
| `before` | string | no | List rooms before this ISO 8601 timestamp (pagination cursor) |
| `after` | string | no | List rooms after this ISO 8601 timestamp (pagination cursor) |

### Example

```lua
local result = app.integrations.webex.list_rooms({ max = 20 })

for _, room in ipairs(result.items) do
  print(room.title .. " (type: " .. room.type .. ")")
end
```

---

## get_room

Get details for a specific Webex room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The unique identifier of the room |

### Example

```lua
local room = app.integrations.webex.get_room({ room_id = "Y2lzY29zcGFyazovL3VzL1JPT00v..." })
print("Room: " .. room.title)
print("Type: " .. room.type)
print("Created: " .. room.created)
```

---

## list_messages

List messages in a Webex room with optional date filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The room to list messages from |
| `max` | integer | no | Maximum number of messages (1–1000, default: 50) |
| `before` | string | no | List messages posted before this ISO 8601 timestamp |
| `after` | string | no | List messages posted after this ISO 8601 timestamp |

### Example

```lua
local result = app.integrations.webex.list_messages({
  room_id = "Y2lzY29zcGFyazovL3VzL1JPT00v...",
  max = 25,
  after = "2025-04-01T00:00:00Z"
})

for _, msg in ipairs(result.items) do
  print(msg.personEmail .. ": " .. (msg.text or "(no text)"))
end
```

---

## create_message

Post a new message to a Webex room. Supports plain text and Markdown.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The room to post the message in |
| `text` | string | no* | Plain-text message content |
| `markdown` | string | no* | Markdown-formatted message content |

\* At least one of `text` or `markdown` is required. If both are provided, Webex displays Markdown to capable clients and falls back to plain text.

### Example

```lua
-- Plain text message
app.integrations.webex.create_message({
  room_id = "Y2lzY29zcGFyazovL3VzL1JPT00v...",
  text = "Hello from the AI agent!"
})

-- Markdown message
app.integrations.webex.create_message({
  room_id = "Y2lzY29zcGFyazovL3VzL1JPT00v...",
  text = "Summary report attached.",
  markdown = "**Summary Report**\n\n* Item 1\n* Item 2\n* Item 3"
})
```

---

## list_meetings

List scheduled Webex meetings for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | no | Start of date range (ISO 8601, e.g., `"2025-04-01T00:00:00Z"`) |
| `to` | string | no | End of date range (ISO 8601, e.g., `"2025-04-30T23:59:59Z"`) |
| `max` | integer | no | Maximum number of meetings (1–100, default: 100) |

### Example

```lua
local result = app.integrations.webex.list_meetings({
  from = "2025-04-01T00:00:00Z",
  to = "2025-04-30T23:59:59Z"
})

for _, meeting in ipairs(result.items) do
  print(meeting.title .. " — " .. meeting.start .. " to " .. meeting.end)
end
```

---

## get_current_user

Get the profile of the currently authenticated Webex user. Takes no parameters.

### Example

```lua
local user = app.integrations.webex.get_current_user({})
print("Name: " .. user.displayName)
print("Email: " .. user.emails[1])
```

---

## Multi-Account Usage

If you have multiple Webex accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.webex.list_rooms({ max = 20 })

-- Explicit default (portable across setups)
app.integrations.webex.default.list_rooms({ max = 20 })

-- Named accounts
app.integrations.webex.work.list_rooms({ max = 20 })
app.integrations.webex.personal.list_rooms({ max = 20 })
```

All functions are identical across accounts — only the credentials differ.
