# Fellow — Lua API Reference

## list_meetings

List meetings from Fellow with optional date filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date_from` | string | no | Start date for filtering (ISO 8601, e.g., `"2026-01-01"`) |
| `date_to` | string | no | End date for filtering (ISO 8601, e.g., `"2026-01-31"`) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Max meetings per page (default: 25) |

### Examples

```lua
-- List all upcoming meetings
local result = app.integrations.fellow.list_meetings({})

-- List meetings in a date range
local result = app.integrations.fellow.list_meetings({
  date_from = "2026-04-01",
  date_to = "2026-04-30"
})

-- Paginate through results
local page1 = app.integrations.fellow.list_meetings({ limit = 10 })
local page2 = app.integrations.fellow.list_meetings({
  cursor = page1.next_cursor,
  limit = 10
})
```

---

## get_meeting

Get full details of a specific Fellow meeting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The Fellow meeting UUID |

### Example

```lua
local result = app.integrations.fellow.get_meeting({
  meeting_id = "abc123-def456-..."
})

print(result.title)
print(result.date)
for _, attendee in ipairs(result.attendees) do
  print(attendee.name)
end
```

---

## create_note

Create a note for a specific Fellow meeting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The Fellow meeting UUID |
| `content` | string | yes | Note content (plain text or markdown) |
| `title` | string | no | Optional title for the note |

### Example

```lua
local result = app.integrations.fellow.create_note({
  meeting_id = "abc123-def456-...",
  content = "## Key Decisions\n- Approved Q2 budget\n- Hired new engineer",
  title = "Meeting Summary"
})
```

---

## list_action_items

List action items from Fellow with pagination and optional status filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Max action items per page (default: 25) |
| `status` | string | no | Filter by status: `"open"`, `"completed"` |

### Examples

```lua
-- List all open action items
local result = app.integrations.fellow.list_action_items({
  status = "open"
})

-- List all action items
local result = app.integrations.fellow.list_action_items({})
```

---

## list_goals

List goals from Fellow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Max goals per page (default: 25) |

### Example

```lua
local result = app.integrations.fellow.list_goals({})

for _, goal in ipairs(result.goals) do
  print(goal.title .. " - " .. (goal.progress or "0") .. "% complete")
end
```

---

## get_current_user

Get the profile of the currently authenticated Fellow user. Takes no parameters.

### Example

```lua
local result = app.integrations.fellow.get_current_user({})

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Fellow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.fellow.list_meetings({})

-- Explicit default (portable across setups)
app.integrations.fellow.default.list_meetings({})

-- Named accounts
app.integrations.fellow.work.list_meetings({})
app.integrations.fellow.personal.list_meetings({})
```

All functions are identical across accounts — only the credentials differ.
