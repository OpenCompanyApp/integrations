# Constant Contact Lua API Reference

Namespace: `app.integrations["constant-contact"]`

The Constant Contact integration targets the V3 API. It uses OAuth Bearer tokens stored by the host.

## Contacts

```lua
local contacts = app.integrations["constant-contact"].list_contacts({
  status = "active",
  limit = 100
})

local contact = app.integrations["constant-contact"].get_contact({
  contact_id = "contact_123"
})

local created = app.integrations["constant-contact"].create_contact({
  email = "person@example.test",
  first_name = "Example",
  list_ids = { "list_123" }
})
```

Use `create_or_update_contact` when you want Constant Contact's sign-up form create-or-update behavior and can provide the full V3 payload.

## Lists, Tags, Custom Fields

```lua
local lists = app.integrations["constant-contact"].list_lists({})
local list = app.integrations["constant-contact"].get_list({ list_id = "list_123" })
local tags = app.integrations["constant-contact"].list_tags({})
local fields = app.integrations["constant-contact"].list_custom_fields({})
```

List create/update/delete tools are write operations.

## Campaigns And Reports

```lua
local campaigns = app.integrations["constant-contact"].list_campaigns({ limit = 20 })
local campaign = app.integrations["constant-contact"].get_campaign({
  campaign_id = "campaign_123"
})

local activity = app.integrations["constant-contact"].get_campaign_activity({
  activity_id = "activity_123"
})

local sends = app.integrations["constant-contact"].get_email_sends_report({
  activity_id = "activity_123",
  params = { limit = 100 }
})
```

First-class report tools cover sends, bounces, and clicks. Use `api_get` for other tracking report endpoints such as opens, forwards, or opt-outs.

## Segments And Activities

```lua
local segments = app.integrations["constant-contact"].list_segments({})
local segment = app.integrations["constant-contact"].get_segment({
  segment_id = "segment_123"
})

local activities = app.integrations["constant-contact"].list_activities({})
local activity_status = app.integrations["constant-contact"].get_activity({
  activity_id = "activity_bulk_123"
})
```

## Account

```lua
local account = app.integrations["constant-contact"].get_account_summary({
  params = { extra_fields = "physical_address,company_logo" }
})

local privileges = app.integrations["constant-contact"].get_user_privileges({})
```

`get_current_user` is retained as a compatibility alias for account summary.

## Long-Tail Endpoints

```lua
local opens = app.integrations["constant-contact"].api_get({
  path = "/reports/email_reports/activity_123/tracking/opens"
})

local export = app.integrations["constant-contact"].api_post({
  path = "/activities/contact_exports",
  payload = { file_type = "CSV" }
})
```

Generic API tools accept relative paths only.

## Multi-Account Usage

```lua
app.integrations["constant-contact"].list_contacts({})
app.integrations["constant-contact"].default.list_contacts({})
app.integrations["constant-contact"].marketing.list_campaigns({})
```

All functions are identical across accounts; only credentials differ.
