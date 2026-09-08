# Matrix — Ruby API Reference

## list_rooms

List rooms the authenticated user has joined on Matrix.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of rooms to return (default: 50) |
| `from` | string | no | Pagination token from a previous response to get the next page |

### Examples

```ruby
result = app.integrations.matrix.list_rooms(limit: 20)
result.rooms.each do |room|
  puts((room.room_id).to_s + ": " + ((room.name || "Unnamed")).to_s)
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

```ruby
result = app.integrations.matrix.get_room(room_id: "!abc123:matrix.org")
puts("Name: " + ((result.name || "Unnamed")).to_s)
puts("Topic: " + ((result.topic || "No topic")).to_s)
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

```ruby
result = app.integrations.matrix.create_room(name: "Project Alpha", topic: "Discussion for Project Alpha", visibility: "private", preset: "private_chat")
puts("Created room: " + (result.room_id).to_s)
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

```ruby
result = app.integrations.matrix.send_message(room_id: "!abc123:matrix.org", body: "Hello from the integration!", msgtype: "m.text")
puts("Event ID: " + (result.event_id).to_s)
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

```ruby
result = app.integrations.matrix.list_members(room_id: "!abc123:matrix.org", limit: 50)
result.members.each do |member|
  puts((member.user_id).to_s + " (" + ((member.display_name || "no name")).to_s + ")")
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

```ruby
result = app.integrations.matrix.get_profile(user_id: "@alice:matrix.org")
puts("Display name: " + ((result.displayname || "Unknown")).to_s)
puts("Avatar: " + ((result.avatar_url || "No avatar")).to_s)
```
---

## get_current_user

Get the currently authenticated Matrix user's information.

### Parameters

None.

### Example

```ruby
result = app.integrations.matrix.get_current_user()
puts("User ID: " + (result.user_id).to_s)
puts("Device ID: " + ((result.device_id || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Matrix accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.matrix.list_rooms()
# Explicit default (portable across setups)
app.integrations.matrix.default.list_rooms()
# Named accounts
app.integrations.matrix.work.list_rooms()
app.integrations.matrix.personal.send_message(room_id: "!room:matrix.org", body: "Hello from personal account!")
```
All functions are identical across accounts — only the credentials differ.
