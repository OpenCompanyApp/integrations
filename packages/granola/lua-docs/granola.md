# Granola — Lua API Reference

## list_meetings

List recent meetings from Granola with optional search and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of meetings to return (default: 20) |
| `offset` | integer | no | Number of meetings to skip for pagination |
| `query` | string | no | Search query to filter meetings by title or content |
| `start_date` | string | no | Start date for filtering (ISO 8601, e.g. `"2025-01-01"`) |
| `end_date` | string | no | End date for filtering (ISO 8601, e.g. `"2025-01-31"`) |

### Examples

#### List recent meetings

```lua
local result = app.integrations.granola.list_meetings({
  limit = 10
})

for _, meeting in ipairs(result.meetings) do
  print(meeting.title .. " — " .. meeting.date)
end
```

#### Search meetings by keyword

```lua
local result = app.integrations.granola.list_meetings({
  query = "Q1 review",
  limit = 5
})
```

#### Filter by date range

```lua
local result = app.integrations.granola.list_meetings({
  start_date = "2025-01-01",
  end_date = "2025-01-31",
  limit = 20
})
```

---

## get_meeting

Get a single meeting with full transcript, summary, notes, and participants.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The meeting ID |

### Example

```lua
local result = app.integrations.granola.get_meeting({
  id = "meeting-id-123"
})

print("Title: " .. result.title)
print("Date: " .. result.date)
print("Participants: " .. table.concat(result.participants, ", "))
print("Summary: " .. result.summary)
print("Transcript: " .. result.transcript)
```

---

## create_note

Create a note on a meeting. Use for follow-up notes, action items, or comments.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID to add the note to |
| `content` | string | yes | The note content text |

### Example

```lua
local result = app.integrations.granola.create_note({
  meeting_id = "meeting-id-123",
  content = "Follow up with engineering on the API redesign by Friday."
})

print("Note created with ID: " .. result.id)
```

---

## share_meeting

Share a meeting with other people by email.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID to share |
| `emails` | array | yes | Email addresses of the recipients |
| `message` | string | no | Optional message to include |

### Example

```lua
local result = app.integrations.granola.share_meeting({
  meeting_id = "meeting-id-123",
  emails = { "alice@example.com", "bob@example.com" },
  message = "Here are the notes from today's standup."
})
```

---

## get_current_user

Get the profile of the currently authenticated Granola user.

### Parameters

None.

### Example

```lua
local result = app.integrations.granola.get_current_user({})

print("Name: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Granola accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.granola.function_name({...})

-- Explicit default (portable across setups)
app.integrations.granola.default.function_name({...})

-- Named accounts
app.integrations.granola.work.function_name({...})
app.integrations.granola.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
