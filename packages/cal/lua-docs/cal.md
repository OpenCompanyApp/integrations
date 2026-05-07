# Cal.com Lua Reference

Namespace: `cal`

Cal.com tools target API v2. Tokens can be Cal.com API keys prefixed with
`cal_`, managed-user access tokens, or OAuth access tokens.

## Core Tools

```lua
local event_types = app.integrations.cal.list_event_types({ limit = 20 })
local event_type = app.integrations.cal.get_event_type({ id = 123 })
local bookings = app.integrations.cal.list_bookings({ status = "upcoming" })
local booking = app.integrations.cal.get_booking({ id = "booking_uid_or_id" })
local me = app.integrations.cal.get_current_user({})
```

Booking writes:

```lua
local created = app.integrations.cal.create_booking({
  event_type_id = 123,
  start = "2026-05-07T10:00:00Z",
  end = "2026-05-07T10:30:00Z",
  responses = {
    name = "Jane Example",
    email = "jane@example.test",
  },
})

local cancelled = app.integrations.cal.cancel_booking({
  booking_uid = "booking_uid",
  body = { cancellationReason = "No longer needed" },
})

local rescheduled = app.integrations.cal.reschedule_booking({
  booking_uid = "booking_uid",
  body = { start = "2026-05-08T10:00:00Z" },
})
```

Dedicated tools use snake_case parameters. Generic API tools pass bodies and
query parameters through to Cal.com, so use Cal.com's field names there.

## Generic API

Use generic tools for Cal.com v2 endpoints without dedicated wrappers:

```lua
local slots = app.integrations.cal.api_get({
  path = "/slots",
  params = {
    eventTypeId = 123,
    start = "2026-05-07T00:00:00Z",
    end = "2026-05-08T00:00:00Z",
  },
})

local result = app.integrations.cal.api_post({
  path = "/bookings",
  body = {
    eventTypeId = 123,
    start = "2026-05-07T10:00:00Z",
    responses = { name = "Jane Example", email = "jane@example.test" },
  },
})
```

Generic write tools:

- `api_post({ path, body })`
- `api_patch({ path, body })`
- `api_delete({ path, body })`

## Multi-Account Usage

```lua
app.integrations.cal.default.list_bookings({})
app.integrations.cal.work.api_get({ path = "/me" })
```
