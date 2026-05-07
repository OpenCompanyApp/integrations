# Fellow Lua API Reference

Namespace: `app.integrations.fellow`

Fellow tools use the official Developer API at `https://{subdomain}.fellow.app/api/v1`. The integration sends credentials in the `X-API-KEY` header automatically.

## User

```lua
local me = app.integrations.fellow.get_current_user({})
```

Returns the authenticated user and workspace context.

## Notes

```lua
local notes = app.integrations.fellow.list_notes({
  pagination = { page_size = 25 },
  include = { transcript = true },
  filters = { updated_at_start = "2026-05-01" }
})

local note = app.integrations.fellow.get_note({
  note_id = "note_123"
})
```

`delete_note` exists for privileged API keys only:

```lua
app.integrations.fellow.delete_note({ note_id = "note_123" })
```

## Action Items

```lua
local items = app.integrations.fellow.list_action_items({
  order_by = "due_date",
  filters = { scope = "assigned_to_me" }
})

local item = app.integrations.fellow.get_action_item({
  action_item_id = "action_123"
})

app.integrations.fellow.mark_action_item_complete({
  action_item_id = "action_123",
  completed = true
})

app.integrations.fellow.archive_action_item({
  action_item_id = "action_123"
})
```

Supported `scope` filter values in Fellow docs include `assigned_to_me` and `assigned_to_others`.

## Recordings

```lua
local recordings = app.integrations.fellow.list_recordings({
  pagination = { page_size = 10 },
  media_url = { expires_in = 3600 }
})

local recording = app.integrations.fellow.get_recording({
  recording_id = "rec_123"
})
```

`delete_recording` requires privileged API access.

## Webhooks

```lua
local hooks = app.integrations.fellow.list_webhooks({
  page_size = 20
})

local hook = app.integrations.fellow.create_webhook({
  url = "https://example.test/webhooks/fellow",
  enabled_events = {
    "ai_note.shared_to_channel",
    "ai_note.generated",
    "action_item.assigned",
    "action_item.completed"
  },
  description = "Agent workflow webhook",
  status = "active"
})

app.integrations.fellow.update_webhook({
  webhook_id = "webhook_123",
  status = "inactive"
})

app.integrations.fellow.delete_webhook({
  webhook_id = "webhook_123"
})
```

## Generic API

Use generic tools only for documented endpoints that do not yet have a first-class tool. Paths must be relative.

```lua
local data = app.integrations.fellow.api_get({
  path = "/me"
})

app.integrations.fellow.api_post({
  path = "/action_items",
  payload = {
    filters = { scope = "assigned_to_me" }
  }
})
```

Absolute URLs are rejected.

## Multi-Account Usage

```lua
app.integrations.fellow.get_current_user({})
app.integrations.fellow.default.get_current_user({})
app.integrations.fellow.leadership.list_notes({
  pagination = { page_size = 10 }
})
```
