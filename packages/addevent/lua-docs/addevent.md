# AddEvent — Lua API Reference

## list_events

List calendar events with optional pagination and category filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of events per page (default: 50, max: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |
| `category` | integer | no | Filter events by category ID |

### Examples

```lua
-- List recent events
local result = app.integrations.addevent.list_events({
  limit = 10,
  page = 1
})

for _, event in ipairs(result.events) do
  print(event.title .. " (" .. event.start_date .. " - " .. event.end_date .. ")")
end
```

```lua
-- Filter by category
local result = app.integrations.addevent.list_events({
  category = 5,
  limit = 20
})
```

---

## get_event

Get details for a specific calendar event.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The event ID |

### Examples

```lua
local result = app.integrations.addevent.get_event({ id = 12345 })
print(result.title)
print(result.description)
print(result.location)
print(result.start_date .. " to " .. result.end_date)
```

---

## create_event

Create a new calendar event.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Event title |
| `start_date` | string | yes | Start date/time (e.g., "2026-04-10T09:00:00") |
| `end_date` | string | yes | End date/time (e.g., "2026-04-10T10:00:00") |
| `location` | string | no | Event location |
| `description` | string | no | Event description |
| `category_id` | integer | no | Category ID to assign the event to |

### Examples

```lua
-- Create a simple event
local result = app.integrations.addevent.create_event({
  title = "Team Standup",
  start_date = "2026-04-10T09:00:00",
  end_date = "2026-04-10T09:30:00"
})
print("Created event with ID: " .. result.id)
```

```lua
-- Create a full event with all options
local result = app.integrations.addevent.create_event({
  title = "Quarterly Planning",
  start_date = "2026-04-15T10:00:00",
  end_date = "2026-04-15T12:00:00",
  location = "Conference Room A, 123 Main St",
  description = "Q2 planning session to review goals and priorities",
  category_id = 3
})
```

---

## list_categories

List all event categories.

### Parameters

None.

### Examples

```lua
local result = app.integrations.addevent.list_categories({})

for _, cat in ipairs(result.categories) do
  print(cat.id .. ": " .. cat.name)
end
```

---

## list_groups

List event groups with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of groups per page (default: 50, max: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.addevent.list_groups({
  limit = 10,
  page = 1
})

for _, group in ipairs(result.groups) do
  print(group.id .. ": " .. group.name)
end
```

---

## get_group

Get details for a specific event group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The group ID |

### Examples

```lua
local result = app.integrations.addevent.get_group({ id = 42 })
print(result.name)
print(result.description)
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.addevent.get_current_user({})
print("Logged in as: " .. result.name .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple AddEvent accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.addevent.function_name({...})

-- Explicit default (portable across setups)
app.integrations.addevent.default.function_name({...})

-- Named accounts
app.integrations.addevent.work.function_name({...})
app.integrations.addevent.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
