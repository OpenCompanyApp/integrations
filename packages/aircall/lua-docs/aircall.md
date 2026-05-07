# Aircall Lua API Reference

Namespace: `app.integrations.aircall`

This integration targets Aircall Public API v1 and v2. Most list tools accept
`page`, `per_page`, `order`, or a `params` object. Write tools accept a
`payload` object or common top-level fields.

Aircall customers normally configure `api_id` and `api_token` for Basic Auth.
Marketplace apps can instead provide an OAuth `access_token`; the same tools
work with either credential mode.

## Common Patterns

List calls:

```lua
local result = app.integrations.aircall.list_calls({
  from = 1704067200,
  to = 1706745600,
  per_page = 50,
  fetch_contact = true
})
```

Tag a call:

```lua
local result = app.integrations.aircall.tag_call({
  call_id = "123",
  tags = { 456, 789 }
})
```

Transfer a call:

```lua
local result = app.integrations.aircall.transfer_call({
  call_id = "123",
  user_id = "456"
})
```

Create a webhook:

```lua
local result = app.integrations.aircall.create_webhook({
  url = "https://example.test/aircall/webhook",
  events = { "call.created", "call.ended" }
})
```

## Coverage

Tools cover users, teams, calls, conversation intelligence, dialer campaigns,
numbers, contacts, tags, webhooks, company/integration metadata, and raw API
helpers.

## Raw API Helpers

```lua
local result = app.integrations.aircall.api_get({
  path = "/calls/search",
  params = {
    phone_number = "+15551234567"
  }
})
```

The `path` must be relative. `/calls` is normalized to `/v1/calls`; pass
`/v2/users` explicitly for v2 user endpoints.
