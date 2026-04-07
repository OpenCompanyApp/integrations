# Whereby — Lua API Reference

## list_rooms

List Whereby rooms with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of rooms to return. |
| `cursor` | string | no | Pagination cursor for fetching the next page of results. |

### Examples

#### List all rooms

```lua
local result = app.integrations.whereby.list_rooms({})
for _, room in ipairs(result.data) do
    print(room.roomName, room.meetingUrl)
end
```

#### Paginated listing

```lua
local result = app.integrations.whereby.list_rooms({ limit = 10, cursor = "next_page_cursor" })
print(result.meta.nextCursor)
```

---

## get_room

Get detailed information about a specific Whereby room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_name` | string | yes | The unique name or identifier of the Whereby room. |

### Examples

```lua
local result = app.integrations.whereby.get_room({ room_name = "my-meeting-room" })
print(result.roomName, result.meetingUrl)
```

---

## create_room

Create a new Whereby video meeting room.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_mode` | string | no | Room mode, e.g. "normal" or "group". |
| `room_name_prefix` | string | no | Optional prefix for the generated room name. |
| `start_date` | string | no | ISO 8601 start date/time for the room. |
| `end_date` | string | no | ISO 8601 end date/time for the room. |
| `fields` | array | no | Additional room configuration fields. |

### Examples

#### Create a simple room

```lua
local result = app.integrations.whereby.create_room({})
print(result.roomName, result.meetingUrl)
```

#### Create a scheduled room

```lua
local result = app.integrations.whereby.create_room({
    room_mode = "group",
    start_date = "2025-01-15T10:00:00Z",
    end_date = "2025-01-15T11:00:00Z",
})
print(result.roomName, result.meetingUrl)
```

---

## delete_room

Delete a Whereby room by its name. This action is permanent and cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `room_name` | string | yes | The unique name or identifier of the Whereby room to delete. |

### Examples

```lua
local result = app.integrations.whereby.delete_room({ room_name = "my-meeting-room" })
print("Room deleted")
```

---

## list_meetings

List past Whereby meetings with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of meetings to return. |
| `cursor` | string | no | Pagination cursor for fetching the next page. |
| `from_date` | string | no | ISO 8601 start date to filter meetings from. |
| `to_date` | string | no | ISO 8601 end date to filter meetings to. |
| `room_name` | string | no | Filter meetings by room name. |

### Examples

#### List recent meetings

```lua
local result = app.integrations.whereby.list_meetings({ limit = 20 })
for _, meeting in ipairs(result.data) do
    print(meeting.id, meeting.roomName, meeting.startDate)
end
```

#### Filter by date range

```lua
local result = app.integrations.whereby.list_meetings({
    from_date = "2025-01-01T00:00:00Z",
    to_date = "2025-01-31T23:59:59Z",
})
print(#result.data .. " meetings found")
```

---

## get_meeting

Get detailed information about a specific past meeting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The unique identifier of the meeting. |

### Examples

```lua
local result = app.integrations.whereby.get_meeting({ meeting_id = "abc123" })
print(result.roomName, result.duration)
for _, participant in ipairs(result.participants or {}) do
    print(participant.name, participant.joinedAt)
end
```

---

## get_current_user

Get the profile of the currently authenticated Whereby user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.whereby.get_current_user({})
print(result.name, result.email)
```

---

## Multi-Account Usage

If you have multiple Whereby accounts configured, use account-specific namespaces:

```lua
-- Default account
app.integrations.whereby.list_rooms({})

-- Explicit default
app.integrations.whereby.default.list_rooms({})

-- Named accounts
app.integrations.whereby.work.list_rooms({})
```

All functions are identical across accounts — only the credentials differ.
