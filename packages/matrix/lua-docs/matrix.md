# Matrix — Lua API Reference

## list_rooms

List rooms the authenticated user has joined on Matrix.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of rooms to return (default: 50) |
| `from` | string | no | Pagination token from a previous response to get the next page |

### Examples

```lua
local result = app.integrations.matrix.list_rooms({
  limit = 20
})

for _, room in ipairs(result.rooms) do
  print(room.room_id .. ": " .. (room.name or "Unnamed"))
end
```

---

## get_room

Get details of a specific Matrix room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The room ID (e.g., `"!abc123:matrix.org"`) |

### Example

```lua
local result = app.integrations.matrix.get_room({
  room_id = "!abc123:matrix.org"
})

print("Name: " .. (result.name or "Unnamed"))
print("Topic: " .. (result.topic or "No topic"))
```

---

## create_room

Create a new room on the Matrix homeserver.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The room name |
| `topic` | string | no | The room topic / description |
| `visibility` | string | no | `"public"` or `"private"` (default: `"private"`) |
| `preset` | string | no | `"private_chat"`, `"public_chat"`, or `"trusted_private_chat"` (default: `"private_chat"`) |

### Example

```lua
local result = app.integrations.matrix.create_room({
  name = "Project Alpha",
  topic = "Discussion for Project Alpha",
  visibility = "private",
  preset = "private_chat"
})

print("Created room: " .. result.room_id)
```

---

## send_message

Send a text message to a Matrix room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The room ID to send the message to |
| `body` | string | yes | The message body text |
| `msgtype` | string | no | Message type: `"m.text"` (default), `"m.notice"`, `"m.emote"`, or `"m.html"` |
| `txn_id` | string | no | Unique transaction ID. If omitted, a random ID is generated |

### Example

```lua
local result = app.integrations.matrix.send_message({
  room_id = "!abc123:matrix.org",
  body = "Hello from the integration!",
  msgtype = "m.text"
})

print("Event ID: " .. result.event_id)
```

---

## list_members

List members of a Matrix room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_id` | string | yes | The room ID |
| `limit` | integer | no | Maximum number of members to return (default: 100) |

### Example

```lua
local result = app.integrations.matrix.list_members({
  room_id = "!abc123:matrix.org",
  limit = 50
})

for _, member in ipairs(result.members) do
  print(member.user_id .. " (" .. (member.display_name or "no name") .. ")")
end
```

---

## get_profile

Get a Matrix user's profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The Matrix user ID (e.g., `"@alice:matrix.org"`) |

### Example

```lua
local result = app.integrations.matrix.get_profile({
  user_id = "@alice:matrix.org"
})

print("Display name: " .. (result.displayname or "Unknown"))
print("Avatar: " .. (result.avatar_url or "No avatar"))
```

---

## get_current_user

Get the currently authenticated Matrix user's information.

### Parameters

None.

### Example

```lua
local result = app.integrations.matrix.get_current_user()

print("User ID: " .. result.user_id)
print("Device ID: " .. (result.device_id or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Matrix accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.matrix.list_rooms({})

-- Explicit default (portable across setups)
app.integrations.matrix.default.list_rooms({})

-- Named accounts
app.integrations.matrix.work.list_rooms({})
app.integrations.matrix.personal.send_message({
  room_id = "!room:matrix.org",
  body = "Hello from personal account!"
})
```

All functions are identical across accounts — only the credentials differ.
