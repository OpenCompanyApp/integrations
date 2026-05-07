# MailerLite Lua API

Namespace: `app.integrations.mailerlite`

Use these tools to manage subscribers, groups, segments, fields, automations, campaigns, forms, webhooks, and batch requests through the current MailerLite API.

## Subscribers

- `mailerlite_list_subscribers({ limit, cursor, status, include })`
- `mailerlite_get_subscriber({ id })`
- `mailerlite_create_subscriber({ email, fields, groups, status })`
- `mailerlite_update_subscriber({ id, fields, groups, status, subscribed_at })`
- `mailerlite_delete_subscriber({ id })`
- `mailerlite_list_subscriber_activity({ id, ["filter[log_name]"], limit, page })`

`id` can be a subscriber ID or email address for subscriber fetch/update/delete calls. `include = "groups"` includes group data in subscriber lists.

## Groups

- `mailerlite_list_groups({ limit, page })`
- `mailerlite_create_group({ name })`
- `mailerlite_update_group({ group_id, name })`
- `mailerlite_delete_group({ group_id })`
- `mailerlite_list_group_subscribers({ group_id, ["filter[status]"], limit, cursor })`
- `mailerlite_add_subscriber_to_group({ group_id, email, name })`
- `mailerlite_assign_subscriber_to_group({ subscriber_id, group_id })`
- `mailerlite_unassign_subscriber_from_group({ subscriber_id, group_id })`
- `mailerlite_import_subscribers_to_group({ group_id, subscribers })`

`mailerlite_add_subscriber_to_group` creates or updates a subscriber and includes the group in the subscriber payload. Use the assign/unassign tools when you already have the MailerLite subscriber ID.

## Segments And Fields

- `mailerlite_list_segments({ limit, page })`
- `mailerlite_list_segment_subscribers({ segment_id, ["filter[status]"], limit, cursor })`
- `mailerlite_update_segment({ segment_id, name })`
- `mailerlite_delete_segment({ segment_id })`
- `mailerlite_list_fields({ limit, page })`
- `mailerlite_create_field({ name, type })`
- `mailerlite_update_field({ field_id, name })`
- `mailerlite_delete_field({ field_id })`

Field `type` must be `text`, `number`, or `date`.

## Automations

- `mailerlite_list_automations({ ["filter[enabled]"], ["filter[name]"], ["filter[group]"], page, limit })`
- `mailerlite_get_automation({ automation_id })`
- `mailerlite_list_automation_activity({ automation_id, page, limit })`
- `mailerlite_create_automation({ name })`
- `mailerlite_create_automation({ payload = {...} })`
- `mailerlite_delete_automation({ automation_id })`

Automation creation creates a draft automation. Use `payload` when MailerLite requires fields beyond `name`.

## Campaigns

- `mailerlite_list_campaigns({ ["filter[status]"], ["filter[type]"], ["filter[name]"], sort, page, limit })`
- `mailerlite_get_campaign({ campaign_id })`
- `mailerlite_create_campaign({ payload = {...} })`
- `mailerlite_update_campaign({ campaign_id, payload = {...} })`
- `mailerlite_schedule_campaign({ campaign_id, payload = {...} })`
- `mailerlite_cancel_campaign({ campaign_id })`
- `mailerlite_delete_campaign({ campaign_id })`
- `mailerlite_list_campaign_subscriber_activity({ campaign_id, page, limit })`

Campaign create/update payloads are passed through to MailerLite so agents can supply the documented `type`, `name`, `emails`, `groups`, `segments`, and scheduling fields without the integration dropping nested data.

## Forms

- `mailerlite_list_forms({ type, ["filter[name]"], sort, page, limit })`
- `mailerlite_get_form({ form_id })`
- `mailerlite_update_form({ form_id, payload = {...} })`
- `mailerlite_delete_form({ form_id })`
- `mailerlite_list_form_subscribers({ form_id, page, limit })`

Form `type` must be `popup`, `embedded`, or `promotion`.

## Webhooks

- `mailerlite_list_webhooks({ page, limit })`
- `mailerlite_get_webhook({ webhook_id })`
- `mailerlite_create_webhook({ name, events, url, enabled, batchable })`
- `mailerlite_update_webhook({ webhook_id, name, events, url, enabled, batchable })`
- `mailerlite_delete_webhook({ webhook_id })`

Supported webhook event names include subscriber events such as `subscriber.created`, `subscriber.updated`, and campaign events such as `campaign.sent`, `campaign.open`, and `campaign.click`. MailerLite requires `batchable = true` for some high-volume events.

## Utilities

- `mailerlite_batch({ requests = {...} })`
- `mailerlite_get_current_user({})`
- `mailerlite_api_get({ path, params })`
- `mailerlite_api_post({ path, payload })`
- `mailerlite_api_put({ path, payload })`
- `mailerlite_api_patch({ path, payload })`
- `mailerlite_api_delete({ path, payload })`

Batch request objects must use MailerLite's documented `method`, `path`, and optional `body` keys. Raw API helper paths must be relative paths like `/subscribers`; absolute URLs are rejected.

## Examples

```lua
local created = app.integrations.mailerlite.mailerlite_create_subscriber({
  email = "reader@example.test",
  fields = {
    name = "Ada Example",
    company = "Example Co"
  },
  groups = {"1234567890"},
  status = "active"
})
```

```lua
local activity = app.integrations.mailerlite.mailerlite_list_campaign_subscriber_activity({
  campaign_id = "66200823885989563",
  limit = 50
})
```

```lua
local webhook = app.integrations.mailerlite.mailerlite_create_webhook({
  name = "Subscriber events",
  url = "https://example.test/mailerlite",
  events = {"subscriber.created", "subscriber.updated"},
  enabled = true
})
```
