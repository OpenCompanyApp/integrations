# AddEvent Lua API Reference

This package uses AddEvent Calendar and Events API v2 at `https://api.addevent.com/calevent/v2`. AddEvent authenticates with an API key sent as `Authorization: Bearer <apiKey>`.

## list_events

Search events you have created.

```lua
local result = app.integrations.addevent.list_events({
  page = 1,
  page_size = 10,
  calendar_id = "cal_123",
  sort_order = "desc"
})
```

## get_event

Retrieve one event by ID.

```lua
local event = app.integrations.addevent.get_event({
  id = "evt_123"
})
```

## create_event

Create an event. `title` and `datetime_start` are required. `datetime_end` defaults to one hour after the start when omitted by AddEvent.

```lua
local event = app.integrations.addevent.create_event({
  calendar_id = "cal_123",
  title = "Demo event",
  datetime_start = "2026-04-10 09:00:00",
  datetime_end = "2026-04-10 10:00:00",
  timezone = "America/New_York",
  location = "Conference Room A",
  description = "Planning session"
})
```

## update_event

Patch an event. Only fields in `attributes` are changed.

```lua
app.integrations.addevent.update_event({
  id = "evt_123",
  attributes = {
    title = "Updated title",
    location = "Zoom"
  }
})
```

## delete_event

Delete an event permanently.

```lua
app.integrations.addevent.delete_event({
  id = "evt_123"
})
```

## list_calendars

Search calendars.

```lua
local result = app.integrations.addevent.list_calendars({
  page = 1,
  page_size = 10,
  sort_by = "created",
  sort_order = "desc"
})
```

## get_calendar

Retrieve a calendar by ID.

```lua
local calendar = app.integrations.addevent.get_calendar({
  id = "cal_123"
})
```

## create_calendar

Create a calendar.

```lua
local calendar = app.integrations.addevent.create_calendar({
  title = "Product webinars",
  timezone = "America/Los_Angeles",
  weekday_begin = "monday",
  description = "Public webinar calendar"
})
```

## list_timezones

List supported timezone values for event and calendar creation.

```lua
local timezones = app.integrations.addevent.list_timezones({})
```

## Notes

Use AddEvent field names from the v2 API, such as `datetime_start`, `datetime_end`, `calendar_id`, and `custom_data`. Page size is capped at 20 by AddEvent for search endpoints.

## Multi-Account Usage

```lua
app.integrations.addevent.list_events({...})
app.integrations.addevent.default.list_events({...})
app.integrations.addevent.work.create_event({...})
```
