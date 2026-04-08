# Google Calendar — Lua API Reference

## list_events

List events on a Google Calendar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `calendar_id` | string | yes | Calendar identifier (use `"primary"` for the user's main calendar) |
| `timeMin` | string | no | Lower bound for event start time (RFC 3339, e.g., `"2026-04-06T00:00:00Z"`) |
| `timeMax` | string | no | Upper bound for event end time (RFC 3339, e.g., `"2026-04-13T00:00:00Z"`) |
| `maxResults` | integer | no | Maximum number of events to return (default: 250, max: 2500) |
| `q` | string | no | Free text search to find events matching the query |
| `orderBy` | string | no | Sort order: `"startTime"` (requires timeMin/timeMax) or `"updated"` |

### Examples

```lua
-- List events for the coming week
local result = app.integrations["google-calendar"].list_events({
  calendar_id = "primary",
  timeMin = "2026-04-06T00:00:00Z",
  timeMax = "2026-04-13T00:00:00Z",
  orderBy = "startTime"
})

for _, event in ipairs(result.items or {}) do
  print(event.summary .. " at " .. (event.start.dateTime or event.start.date))
end
```

```lua
-- Search for events matching a keyword
local result = app.integrations["google-calendar"].list_events({
  calendar_id = "primary",
  q = "standup"
})
```

---

## get_event

Get details of a specific calendar event.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `calendar_id` | string | yes | Calendar identifier |
| `event_id` | string | yes | The unique event identifier |

### Example

```lua
local event = app.integrations["google-calendar"].get_event({
  calendar_id = "primary",
  event_id = "abc123def456"
})
print(event.summary)
print(event.description or "")
```

---

## create_event

Create a new event on a Google Calendar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `calendar_id` | string | yes | Calendar identifier (use `"primary"` for the user's main calendar) |
| `summary` | string | yes | Title of the event |
| `start` | object | yes | Start time: `{ dateTime = "...", timeZone = "..." }` or `{ date = "2026-04-06" }` |
| `end` | object | yes | End time (same format as start) |
| `description` | string | no | Description or notes (can contain HTML) |
| `attendees` | array | no | List of attendee objects: `{ { email = "user@example.com" } }` |
| `location` | string | no | Location text or video call URL |

### Examples

```lua
-- Create a timed event
local event = app.integrations["google-calendar"].create_event({
  calendar_id = "primary",
  summary = "Team Standup",
  start = {
    dateTime = "2026-04-06T10:00:00+02:00",
    timeZone = "Europe/Amsterdam"
  },
  ["end"] = {
    dateTime = "2026-04-06T10:30:00+02:00",
    timeZone = "Europe/Amsterdam"
  },
  description = "Daily team sync",
  attendees = {
    { email = "alice@example.com" },
    { email = "bob@example.com" }
  },
  location = "https://meet.google.com/abc-defg-hij"
})
print("Created event: " .. event.id)
```

```lua
-- Create an all-day event
local event = app.integrations["google-calendar"].create_event({
  calendar_id = "primary",
  summary = "Company Offsite",
  start = { date = "2026-04-10" },
  ["end"] = { date = "2026-04-12" }
})
```

---

## list_calendars

List all calendars on the user's account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `maxResults` | integer | no | Maximum number of calendars to return (default: 250) |

### Example

```lua
local result = app.integrations["google-calendar"].list_calendars()
for _, cal in ipairs(result.items or {}) do
  print(cal.id .. ": " .. cal.summary)
end
```

---

## get_calendar

Get details of a specific calendar.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `calendar_id` | string | yes | Calendar identifier |

### Example

```lua
local cal = app.integrations["google-calendar"].get_calendar({
  calendar_id = "primary"
})
print(cal.summary .. " (" .. cal.timeZone .. ")")
```

---

## list_colors

Get the available color definitions for events and calendars.

### Parameters

None.

### Example

```lua
local colors = app.integrations["google-calendar"].list_colors()
for id, color in pairs(colors.event or {}) do
  print("Event color " .. id .. ": " .. color.background)
end
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local user = app.integrations["google-calendar"].get_current_user()
print("Connected as: " .. user.name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Google Calendar accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["google-calendar"].list_events({ calendar_id = "primary" })

-- Explicit default (portable across setups)
app.integrations["google-calendar"].default.list_events({ calendar_id = "primary" })

-- Named accounts
app.integrations["google-calendar"].work.list_events({ calendar_id = "primary" })
app.integrations["google-calendar"].personal.list_events({ calendar_id = "primary" })
```

All functions are identical across accounts — only the credentials differ.
