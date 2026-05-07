# Missive Lua Reference

Namespace: `missive`

Missive tools target the public REST API at `https://public.missiveapp.com/v1`.
Configure a personal access token; the integration sends it as
`Authorization: Bearer <access_token>`.

## Conversations

```lua
local conversations = app.integrations.missive.list_conversations({
  state = "open",
  limit = 25
})

local conversation = app.integrations.missive.get_conversation({
  id = "conv_123"
})

local messages = app.integrations.missive.list_conversation_messages({
  conversation_id = "conv_123",
  params = { limit = 20 }
})

local comments = app.integrations.missive.list_conversation_comments({
  conversation_id = "conv_123"
})
```

Additional conversation helpers:

- `list_conversation_drafts({ conversation_id, params? })`
- `list_conversation_posts({ conversation_id, params? })`
- `merge_conversation({ conversation_id, body })`
- `create_comment({ conversation_id, body, assignees? })`

## Drafts, Messages, And Posts

```lua
local draft = app.integrations.missive.create_draft({
  body = {
    subject = "Follow up",
    body = "Thanks for the details.",
    to_fields = { { address = "person@example.test" } }
  }
})

local found = app.integrations.missive.list_messages({
  params = { email_message_id = "<message-id@example.test>" }
})
```

Tools: `create_draft`, `delete_draft`, `list_messages`, `create_post`,
and `delete_post`. Draft, post, and send payloads are passed as `body` objects
matching Missive's documented request schema.

## Tasks

```lua
local tasks = app.integrations.missive.list_tasks({
  state = "open",
  limit = 20
})

local task = app.integrations.missive.get_task({ task_id = "task_123" })

local updated = app.integrations.missive.update_task({
  task_id = "task_123",
  body = { state = "completed" }
})
```

## Contacts

```lua
local contacts = app.integrations.missive.list_contacts({
  params = {
    search = "Example",
    limit = 50
  }
})

local created = app.integrations.missive.create_contacts({
  body = {
    contacts = {
      { email = "person@example.test", first_name = "Example" }
    }
  }
})
```

Contact tools include `get_contact`, `update_contacts`, `list_contact_books`,
and `list_contact_groups`. Bulk update IDs are comma-separated strings.

## Organization Metadata

```lua
local organizations = app.integrations.missive.list_organizations({})
local users = app.integrations.missive.list_users({
  params = { organization = "org_123" }
})
local teams = app.integrations.missive.list_teams({})
local labels = app.integrations.missive.list_shared_labels({})
```

`create_teams({ body })` creates one or more teams using Missive's documented
team payload shape.

## Responses, Analytics, And Hooks

```lua
local responses = app.integrations.missive.list_responses({})

local report = app.integrations.missive.create_analytics_report({
  body = {
    organization = "org_123",
    start = "2026-05-01",
    ["end"] = "2026-05-06",
    time_zone = "UTC"
  }
})

local hooks = app.integrations.missive.list_hooks({})
```

Response tools support list, get, create, update, and delete. Analytics reports
are asynchronous: create a report first, then call `get_analytics_report` with
the returned report ID. Hook tools support list, create, and delete.

## Generic API

Use generic helpers for documented Missive endpoints without dedicated wrappers:

```lua
local raw = app.integrations.missive.api_get({
  path = "/contacts",
  params = { limit = 10 }
})
```

Available generic tools: `api_get`, `api_post`, `api_patch`, and `api_delete`.
