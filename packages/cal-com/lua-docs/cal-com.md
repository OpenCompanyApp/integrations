# Cal.com — Lua API Reference

## list_event_types

List available event types (booking link templates) from Cal.com.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of event types per page |
| `page` | integer | no | Page number for pagination (starts at 1) |
| `teamId` | integer | no | Filter event types belonging to a specific team |

### Examples

```lua
-- List all event types
local result = app.integrations["cal-com"].list_event_types({})

for _, et in ipairs(result.event_types or {}) do
  print(et.id .. ": " .. et.title .. " (" .. et.length .. " min)")
end

-- Filter by team
local result = app.integrations["cal-com"].list_event_types({
  teamId = 5,
  limit = 10
})
```

---

## get_event_type

Get detailed information about a specific event type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The event type ID |

### Examples

```lua
local result = app.integrations["cal-com"].get_event_type({ id = 42 })

local et = result.event_type
print(et.title)
print("Duration: " .. et.length .. " minutes")
print("Description: " .. (et.description or "N/A"))
```

---

## create_booking

Create a new booking for a specific event type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `eventTypeId` | integer | yes | The event type ID to book |
| `start` | string | yes | Start time in ISO 8601 format (e.g., `"2026-04-10T09:00:00Z"`) |
| `end` | string | yes | End time in ISO 8601 format (e.g., `"2026-04-10T09:30:00Z"`) |
| `responses` | object | yes | Attendee info. Must include `"name"` and `"email"` |

### Examples

```lua
-- Create a simple booking
local result = app.integrations["cal-com"].create_booking({
  eventTypeId = 42,
  start = "2026-04-10T09:00:00Z",
  end = "2026-04-10T09:30:00Z",
  responses = {
    name = "John Doe",
    email = "john@example.com",
    notes = "Looking forward to the call!"
  }
})

print("Booking created: " .. result.booking.id)

-- Create a booking with custom fields
local result = app.integrations["cal-com"].create_booking({
  eventTypeId = 7,
  start = "2026-05-01T14:00:00Z",
  end = "2026-05-01T14:45:00Z",
  responses = {
    name = "Jane Smith",
    email = "jane@company.com",
    phone = "+1-555-0123",
    company = "Acme Corp"
  }
})
```

---

## list_bookings

List bookings with optional filtering by status, event type, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of bookings per page |
| `page` | integer | no | Page number for pagination (starts at 1) |
| `status` | string | no | Filter by status: `"confirmed"`, `"pending"`, `"cancelled"`, `"rejected"` |
| `eventTypeId` | integer | no | Filter bookings for a specific event type |

### Examples

```lua
-- List confirmed bookings
local result = app.integrations["cal-com"].list_bookings({
  status = "confirmed",
  limit = 10
})

for _, booking in ipairs(result.bookings or {}) do
  print(booking.id .. ": " .. booking.title .. " at " .. booking.startTime)
end

-- List bookings for a specific event type
local result = app.integrations["cal-com"].list_bookings({
  eventTypeId = 42,
  page = 1
})
```

---

## get_booking

Get detailed information about a specific booking.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The booking ID |

### Examples

```lua
local result = app.integrations["cal-com"].get_booking({ id = 123 })

local b = result.booking
print("Title: " .. b.title)
print("Start: " .. b.startTime)
print("End: " .. b.endTime)
print("Status: " .. b.status)

for _, attendee in ipairs(b.attendees or {}) do
  print("Attendee: " .. attendee.name .. " <" .. attendee.email .. ">")
end
```

---

## list_teams

List teams in your Cal.com organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of teams per page |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Examples

```lua
-- List all teams
local result = app.integrations["cal-com"].list_teams({})

for _, team in ipairs(result.teams or {}) do
  print(team.id .. ": " .. team.name .. " (" .. #(team.members or {}) .. " members)")
end

-- Paginate through teams
local result = app.integrations["cal-com"].list_teams({
  limit = 5,
  page = 2
})
```

---

## get_current_user

Get the authenticated Cal.com user's profile information.

### Parameters

None.

### Examples

```lua
local result = app.integrations["cal-com"].get_current_user({})

local user = result.user
print("Name: " .. user.name)
print("Email: " .. user.email)
print("Timezone: " .. (user.timeZone or "N/A"))
print("Username: " .. (user.username or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Cal.com accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["cal-com"].list_bookings({})

-- Explicit default (portable across setups)
app.integrations["cal-com"].default.list_bookings({})

-- Named accounts
app.integrations["cal-com"].work.list_bookings({})
app.integrations["cal-com"].personal.list_bookings({})
```

All functions are identical across accounts — only the credentials differ.
