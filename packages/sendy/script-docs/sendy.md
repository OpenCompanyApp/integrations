# Sendy JavaScript Reference

Sendy is self-hosted, so every account needs both an API key and the installation hostname. The integration uses Sendy's official form-post API and normalizes plain-text responses into small agent-friendly objects.

## subscribe

Subscribe or update an email address on a list.

```js
var result = app.integrations.sendy.subscribe({
  list: "list_abc",
  email: "reader@example.test",
  name: "Example Reader",
  country: "US",
  gdpr: "true",
  custom_fields: {
    Plan: "Pro",
  }
})
```
Optional fields include `country`, `ipaddress`, `referrer`, `gdpr`, `silent`, and `custom_fields`.

## unsubscribe

Unsubscribe an email address from a list.

```js
var result = app.integrations.sendy.unsubscribe({
  list: "list_abc",
  email: "reader@example.test",
})
```
## delete_subscriber

Delete a subscriber from a list.

```js
var result = app.integrations.sendy.delete_subscriber({
  list_id: "list_abc",
  email: "reader@example.test",
})
```
## subscription_status

Get a subscriber's status in a list. Sendy can return values such as `Subscribed`, `Unsubscribed`, `Unconfirmed`, `Bounced`, `Soft bounced`, or `Complained`.

```js
var result = app.integrations.sendy.subscription_status({
  list_id: "list_abc",
  email: "reader@example.test",
})

console.log(result.status)
```
## list_subscribers

Get the active subscriber count for a list. The tool name is historical; it maps to Sendy's `active-subscriber-count.php` endpoint.

```js
var result = app.integrations.sendy.list_subscribers({
  list_id: "list_abc",
})

console.log(result.subscribers)
```
## get_lists

Get lists for a brand.

```js
var lists = app.integrations.sendy.get_lists({
  brand_id: "1",
  include_hidden: true,
})
```
## get_brands

Get all brands visible to the API key.

```js
var brands = app.integrations.sendy.get_brands({})
```
## create_campaign

Create a draft, send immediately, or schedule a campaign. Sendy requires `brand_id` for drafts, and requires `list_ids` or `segment_ids` when `send_campaign = 1`.

```js
var result = app.integrations.sendy.create_campaign({
  from_name: "Example Corp",
  from_email: "newsletter@example.test",
  reply_to: "support@example.test",
  title: "May Newsletter",
  subject: "What changed this month",
  html_text: "<h1>Hello</h1><p>Monthly update.</p>",
  plain_text: "Hello\n\nMonthly update.",
  list_ids: "list_abc",
  send_campaign: 1,
  track_opens: 1,
  track_clicks: 1,
})
```
Scheduling options:

```js
var result = app.integrations.sendy.create_campaign({
  from_name: "Example Corp",
  from_email: "newsletter@example.test",
  reply_to: "support@example.test",
  title: "Scheduled Newsletter",
  subject: "Scheduled update",
  html_text: "<h1>Scheduled</h1>",
  list_ids: "list_abc",
  send_campaign: 1,
  schedule_date_time: "June 15, 2026 6:05pm",
  schedule_timezone: "America/New_York",
})
```
## get_current_user

Compatibility alias for `get_brands`.

```js
var brands = app.integrations.sendy.get_current_user({})
```
## Multi-Account Usage

```js
app.integrations.sendy.subscribe({ /* parameters */ })
app.integrations.sendy.default.subscribe({ /* parameters */ })
app.integrations.sendy.marketing.subscribe({ /* parameters */ })
```