# LINE Messaging - Lua API Reference

Namespace: `app.integrations.line`

This integration wraps documented LINE Messaging API v2 endpoints for messaging, webhook settings, users, bot info, group chats, rich menus, per-user rich menus, and account linking. The configured API URL should normally be `https://api.line.me`; the integration appends `/v2/...` endpoint paths.

Most write tools return the LINE API response body, or an empty table for `204 No Content` endpoints. Message tools accept raw LINE message objects so agents can use current LINE message types without this package flattening or renaming fields.

## Messaging

`reply_message`, `send_message`, `multicast_message`, `narrowcast_message`, and `broadcast_message` all accept `messages`, an array of LINE message objects:

```lua
{
  { type = "text", text = "Hello from the bot." }
}
```

Common tools:

```lua
app.integrations.line.reply_message({
  reply_token = "reply-token-from-webhook",
  messages = {{ type = "text", text = "Thanks." }}
})

app.integrations.line.send_message({
  to = "U0000000000",
  messages = {{ type = "text", text = "Your order is ready." }},
  notification_disabled = false,
  custom_aggregation_units = "orders"
})

app.integrations.line.multicast_message({
  to = {"U0000000000", "U1111111111"},
  messages = {{ type = "text", text = "A shared update." }}
})

app.integrations.line.narrowcast_message({
  messages = {{ type = "text", text = "Segment update." }},
  recipient = { type = "operator", and = {{ type = "audience", audienceGroupId = 1234567890 }}}
})

app.integrations.line.broadcast_message({
  messages = {{ type = "text", text = "Announcement for all followers." }}
})
```

Operational message tools:

- `get_narrowcast_progress({ request_id = "request-id" })`
- `mark_as_read({ chat_id = "U0000000000" })`
- `start_loading_animation({ chat_id = "U0000000000", loading_seconds = 20 })`
- `get_message_quota({})`
- `get_message_quota_consumption({})`
- `get_delivery_count({ type = "push", date = "20260506" })`
- `validate_messages({ type = "push", messages = {{ type = "text", text = "Preview" }} })`

Allowed delivery count types are `reply`, `push`, `multicast`, and `broadcast`. Allowed validation types are `reply`, `push`, `multicast`, `narrowcast`, and `broadcast`.

## Webhooks

```lua
app.integrations.line.set_webhook_endpoint({
  endpoint = "https://example.test/line/webhook"
})

local webhook = app.integrations.line.get_webhook_endpoint({})

local test = app.integrations.line.test_webhook_endpoint({
  endpoint = "https://example.test/line/webhook"
})
```

Webhook test responses are passed through from LINE and can include endpoint, success, timestamp, and status details depending on the API response.

## Users And Bot

```lua
local profile = app.integrations.line.get_profile({
  user_id = "U0000000000"
})

local followers = app.integrations.line.list_friends({
  limit = 100,
  start = nil
})

local bot = app.integrations.line.get_current_user({})
```

`list_friends` maps to LINE's follower ID endpoint. It returns IDs and pagination fields from LINE, not expanded profile records.

## Group Chats

```lua
local summary = app.integrations.line.get_group_summary({
  group_id = "C0000000000"
})

local count = app.integrations.line.get_group_member_count({
  group_id = "C0000000000"
})

local members = app.integrations.line.list_group_member_ids({
  group_id = "C0000000000",
  start = nil
})

local member = app.integrations.line.get_group_member_profile({
  group_id = "C0000000000",
  user_id = "U0000000000"
})
```

`leave_group({ group_id = "C0000000000" })` removes the bot from the group. Use it only when that is the intended operational effect.

## Rich Menus

Rich menu tools accept LINE rich menu objects directly.

```lua
local rich_menu = {
  size = { width = 2500, height = 843 },
  selected = false,
  name = "main-menu",
  chatBarText = "Menu",
  areas = {}
}

app.integrations.line.validate_rich_menu({ rich_menu = rich_menu })
local created = app.integrations.line.create_rich_menu({ rich_menu = rich_menu })

local list = app.integrations.line.list_rich_menus({})
local one = app.integrations.line.get_rich_menu({ rich_menu_id = "richmenu-123" })
```

Default and per-user rich menu tools:

- `set_default_rich_menu({ rich_menu_id = "richmenu-123" })`
- `get_default_rich_menu({})`
- `clear_default_rich_menu({})`
- `link_rich_menu_to_user({ user_id = "U0000000000", rich_menu_id = "richmenu-123" })`
- `get_user_rich_menu({ user_id = "U0000000000" })`
- `unlink_rich_menu_from_user({ user_id = "U0000000000" })`
- `delete_rich_menu({ rich_menu_id = "richmenu-123" })`

Image upload/download endpoints are binary content endpoints and are not exposed by this JSON-only tool set.

## Account Link

```lua
local token = app.integrations.line.issue_link_token({
  user_id = "U0000000000"
})
```

Use the returned token in LINE's account-linking flow for your service.

## Multi-Account Usage

```lua
app.integrations.line.send_message({...})
app.integrations.line.default.send_message({...})
app.integrations.line.production.send_message({...})
```

Named account namespaces use the same functions with different stored credentials.
