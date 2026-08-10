# Constant Contact JavaScript API Reference

Namespace: `app.integrations["constant-contact"]`

The Constant Contact integration targets the V3 API. It uses OAuth Bearer tokens stored by the host.

## Contacts

```js
var contacts = app.integrations["constant-contact"].list_contacts({
  status: "active",
  limit: 100,
})

var contact = app.integrations["constant-contact"].get_contact({
  contact_id: "contact_123",
})

var created = app.integrations["constant-contact"].create_contact({
  email: "person@example.test",
  first_name: "Example",
  list_ids: [ "list_123" ],
})
```
Use `create_or_update_contact` when you want Constant Contact's sign-up form create-or-update behavior and can provide the full V3 payload.

## Lists, Tags, Custom Fields

```js
var lists = app.integrations["constant-contact"].list_lists({})
var list = app.integrations["constant-contact"].get_list({ list_id: "list_123" })
var tags = app.integrations["constant-contact"].list_tags({})
var fields = app.integrations["constant-contact"].list_custom_fields({})
```
List create/update/delete tools are write operations.

## Campaigns And Reports

```js
var campaigns = app.integrations["constant-contact"].list_campaigns({ limit: 20 })
var campaign = app.integrations["constant-contact"].get_campaign({
  campaign_id: "campaign_123",
})

var activity = app.integrations["constant-contact"].get_campaign_activity({
  activity_id: "activity_123",
})

var sends = app.integrations["constant-contact"].get_email_sends_report({
  activity_id: "activity_123",
  params: { limit: 100 },
})
```
First-class report tools cover sends, bounces, and clicks. Use `api_get` for other tracking report endpoints such as opens, forwards, or opt-outs.

## Segments And Activities

```js
var segments = app.integrations["constant-contact"].list_segments({})
var segment = app.integrations["constant-contact"].get_segment({
  segment_id: "segment_123",
})

var activities = app.integrations["constant-contact"].list_activities({})
var activity_status = app.integrations["constant-contact"].get_activity({
  activity_id: "activity_bulk_123",
})
```
## Account

```js
var account = app.integrations["constant-contact"].get_account_summary({
  params: { extra_fields: "physical_address,company_logo" },
})

var privileges = app.integrations["constant-contact"].get_user_privileges({})
```
`get_current_user` is retained as a compatibility alias for account summary.

## Long-Tail Endpoints

```js
var opens = app.integrations["constant-contact"].api_get({
  path: "/reports/email_reports/activity_123/tracking/opens",
})

var exportResult = app.integrations["constant-contact"].api_post({
  path: "/activities/contact_exports",
  payload: { file_type: "CSV" },
})
```
Generic API tools accept relative paths only.

## Multi-Account Usage

```js
app.integrations["constant-contact"].list_contacts({})
app.integrations["constant-contact"].default.list_contacts({})
app.integrations["constant-contact"].marketing.list_campaigns({})
```
All functions are identical across accounts; only credentials differ.
