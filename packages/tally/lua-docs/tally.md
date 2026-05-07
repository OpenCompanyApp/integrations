# Tally Lua API Reference

Namespace: `app.integrations.tally`

Use Tally for form discovery, submission review, workspace administration, organization invites, and webhook delivery management. Results are Tally JSON responses with minimal reshaping; tool parameters are `snake_case` even when Tally's API uses camelCase fields.

## Common Reads

```lua
local user = app.integrations.tally.get_current_user({})

local forms = app.integrations.tally.list_forms({
  limit = 50,
  workspace_ids = { "ws_example" }
})

local form = app.integrations.tally.get_form({ form_id = "form_example" })
local questions = app.integrations.tally.list_questions({ form_id = "form_example" })
local blocks = app.integrations.tally.list_blocks({ form_id = "form_example" })
```

`list_forms` accepts `page`, `limit`, and `workspace_ids`. Tally returns paginated objects with fields such as `items`, `page`, `limit`, `total`, and `hasMore`.

## Forms And Structure

```lua
local created = app.integrations.tally.create_form({
  workspace_id = "ws_example",
  status = "draft",
  blocks = {
    { type = "TITLE", payload = { text = "Contact us" } }
  }
})

app.integrations.tally.update_form({
  form_id = created.id,
  name = "Contact form",
  status = "published"
})

app.integrations.tally.update_question({
  form_id = created.id,
  question_id = "question_example",
  title = "What should we know?"
})

app.integrations.tally.update_blocks({
  form_id = created.id,
  blocks = {
    { id = "block_example", type = "TITLE", payload = { text = "Updated" } }
  }
})
```

Creating and updating forms accepts Tally block and settings payloads. Fetch an existing form or blocks first when making structural edits so the agent preserves fields that should remain unchanged.

## Submissions

```lua
local submissions = app.integrations.tally.list_submissions({
  form_id = "form_example",
  filter = "completed",
  start_date = "2026-01-01T00:00:00Z",
  limit = 100
})

local submission = app.integrations.tally.get_submission({
  form_id = "form_example",
  submission_id = "submission_example"
})
```

Submission access is form-scoped in the current Tally API. Always pass both `form_id` and `submission_id` for single-submission reads or deletes. `list_submissions` accepts `page`, `limit`, `filter` (`all`, `completed`, `partial`), `start_date`, `end_date`, and `after_id`.

## Workspaces And Organizations

```lua
local workspaces = app.integrations.tally.list_workspaces({ page = 1 })
local workspace = app.integrations.tally.get_workspace({ workspace_id = "ws_example" })

app.integrations.tally.create_organization_invite({
  organization_id = "org_example",
  workspace_ids = { "ws_example" },
  emails = "person@example.test"
})

local invites = app.integrations.tally.list_organization_invites({
  organization_id = "org_example"
})
```

Workspace tools can create, get, update, and delete workspaces. Organization tools can list users, remove users, list invites, create invites, and cancel pending invites.

## Webhooks

```lua
local hook = app.integrations.tally.create_webhook({
  form_id = "form_example",
  url = "https://example.test/tally/webhook",
  event_types = { "FORM_RESPONSE" },
  signing_secret = "dummy-secret"
})

local events = app.integrations.tally.list_webhook_events({
  webhook_id = hook.id,
  page = 1
})

app.integrations.tally.retry_webhook_event({
  webhook_id = hook.id,
  event_id = "event_example"
})
```

Webhook tools manage subscriptions and delivery events. `http_headers` should be an array of objects with `name` and `value` keys when custom delivery headers are needed.

## Generic API Tools

```lua
local raw = app.integrations.tally.api_get({
  path = "/forms",
  params = { limit = 10 }
})
```

Use `api_get`, `api_post`, `api_patch`, and `api_delete` only for documented Tally endpoints that are not yet wrapped by a named helper. Prefer named tools because they validate required IDs and map snake_case parameters for you.

## Multi-Account Usage

```lua
app.integrations.tally.list_forms({})
app.integrations.tally.default.list_forms({})
app.integrations.tally.work.list_forms({})
```

All account namespaces expose the same tools; only stored credentials differ.
