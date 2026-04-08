# Daily.co — Lua API Reference

## list_rooms

List video rooms with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of rooms to return (default: 20, max: 100) |
| `ending_before` | string | no | Room ID for cursor-based pagination (returns rooms before this ID) |
| `starting_after` | string | no | Room ID for cursor-based pagination (returns rooms after this ID) |

### Example

```lua
local result = app.integrations["daily-co"].list_rooms({
  limit = 10
})

for _, room in ipairs(result.data) do
  print(room.id .. ": " .. room.name .. " (" .. room.url .. ")")
end
```

---

## get_room

Get details of a specific room by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The room name |

### Example

```lua
local result = app.integrations["daily-co"].get_room({
  name = "standup"
})

print("Room: " .. result.name)
print("URL: " .. result.url)
print("Privacy: " .. result.privacy)
```

---

## create_room

Create a new video room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | A unique name for the room (auto-generated if omitted) |
| `privacy` | string | no | Room privacy: `"private"` (default) or `"public"` |
| `properties` | object | no | Room configuration (e.g., max_participants, enable_recording, exp) |

### Properties Syntax

```lua
properties = {
  max_participants = 10,
  enable_recording = "cloud",
  exp = 1700000000
}
```

### Example

```lua
local result = app.integrations["daily-co"].create_room({
  name = "team-sync",
  privacy = "public",
  properties = {
    max_participants = 25,
    enable_recording = "cloud"
  }
})

print("Created room: " .. result.name)
print("URL: " .. result.url)
```

---

## delete_room

Delete a video room by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The room name to delete |

### Example

```lua
local result = app.integrations["daily-co"].delete_room({
  name = "old-room"
})

print("Room deleted successfully")
```

---

## list_meetings

List meetings with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room` | string | no | Filter by room name |
| `limit` | integer | no | Maximum results (default: 20, max: 100) |
| `starting_after` | string | no | Meeting ID for cursor-based pagination |
| `ending_before` | string | no | Meeting ID for cursor-based pagination |

### Example

```lua
local result = app.integrations["daily-co"].list_meetings({
  room = "standup",
  limit = 10
})

for _, meeting in ipairs(result.data) do
  print(meeting.id .. ": " .. meeting.room .. " at " .. meeting.start_time)
end
```

---

## get_meeting

Get details of a specific meeting by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting UUID |

### Example

```lua
local result = app.integrations["daily-co"].get_meeting({
  meeting_id = "abc123-def456"
})

print("Meeting ID: " .. result.id)
print("Room: " .. result.room)
print("Start: " .. result.start_time)
print("Duration: " .. (result.duration or "ongoing"))
```

---

## list_recordings

List recordings with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room` | string | no | Filter by room name |
| `limit` | integer | no | Maximum results (default: 20, max: 100) |
| `starting_after` | string | no | Recording ID for cursor-based pagination |
| `ending_before` | string | no | Recording ID for cursor-based pagination |

### Example

```lua
local result = app.integrations["daily-co"].list_recordings({
  room = "standup",
  limit = 10
})

for _, rec in ipairs(result.data) do
  print(rec.id .. ": " .. rec.room .. " (" .. rec.status .. ")")
  if rec.download_link then
    print("  Download: " .. rec.download_link)
  end
end
```

---

## Multi-Account Usage

If you have multiple Daily.co accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["daily-co"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["daily-co"].default.function_name({...})

-- Named accounts
app.integrations["daily-co"].production.function_name({...})
app.integrations["daily-co"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
