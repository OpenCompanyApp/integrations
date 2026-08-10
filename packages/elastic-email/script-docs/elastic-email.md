# Elastic Email JavaScript API Reference

Namespace: `app.integrations["elastic-email"]`

Elastic Email tools use REST API v4. API keys are sent with `X-ElasticEmail-ApiKey`.

## Email

```js
var sent = app.integrations["elastic-email"].send_email({
  to: "person@example.test",
  subject: "Welcome",
  body: "<p>Hello</p>",
  from: "sender@example.test",
})

var status = app.integrations["elastic-email"].get_email_status({
  transaction_id: "tx_123",
})
```
`send_bulk_email` accepts a full Elastic Email v4 email payload under `payload`.

## Contacts And Lists

```js
var contacts = app.integrations["elastic-email"].list_contacts({
  limit: 50,
})

var contact = app.integrations["elastic-email"].get_contact({
  email: "person@example.test",
})

var created = app.integrations["elastic-email"].create_contact({
  email: "person@example.test",
  list_name: "Newsletter",
  first_name: "Example",
})

var lists = app.integrations["elastic-email"].list_lists({})
var members = app.integrations["elastic-email"].list_list_contacts({
  name: "Newsletter",
})
```
Use `add_contacts_to_list` and `remove_contacts_from_list` with comma- or semicolon-separated email addresses.

## Campaigns, Events, Suppressions

```js
var campaigns = app.integrations["elastic-email"].list_campaigns({})
var campaign = app.integrations["elastic-email"].get_campaign({ name: "Launch" })
var events = app.integrations["elastic-email"].list_events({
  params: { limit: 100 },
})
var suppressions = app.integrations["elastic-email"].list_suppressions({
  type: "bounces",
})
```
Suppression `type` must be `unsubscribes`, `bounces`, or `complaints`.

## Templates, Statistics, Files

```js
var templates = app.integrations["elastic-email"].list_templates({
  limit: 20,
})

var template = app.integrations["elastic-email"].get_template({
  id: "welcome",
})

var stats = app.integrations["elastic-email"].get_statistics({})
var campaign_stats = app.integrations["elastic-email"].get_campaign_statistics({
  name: "Launch",
})
var files = app.integrations["elastic-email"].list_files({})
```
The `id` field for `get_template` is the template name in the v4 path.

## Long-Tail Endpoints

```js
var domains = app.integrations["elastic-email"].api_get({
  path: "/domains",
})

var exportResult = app.integrations["elastic-email"].api_post({
  path: "/contacts/export",
  payload: { FileFormat: "Csv" },
})
```
Generic API tools accept relative paths only.

## Multi-Account Usage

```js
app.integrations["elastic-email"].send_email({ /* parameters */ })
app.integrations["elastic-email"].default.send_email({ /* parameters */ })
app.integrations["elastic-email"].marketing.list_campaigns({})
```
All functions are identical across accounts; only credentials differ.
