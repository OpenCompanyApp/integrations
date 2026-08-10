# Zendesk Marketing — JavaScript API Reference

## list_campaigns

List all email marketing campaigns in your Zendesk account.

### Parameters

None.

### Example

```js
var result = app.integrations["zend"].list_campaigns()

for (const campaign of (result)) {
  console.log(campaign.subject + " (" + campaign.status + ")")
}
```
---

## get_campaign

Get detailed information about a specific email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The campaign ID |

### Example

```js
var result = app.integrations["zend"].get_campaign({
  campaign_id: "abc123",
})

console.log("Subject: " + result.subject)
console.log("Status: " + result.status)
```
---

## create_campaign

Create a new email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | The campaign email subject line |
| `content` | string | no | The HTML content of the campaign email |
| `list_ids` | array | no | Array of subscriber list IDs to target |
| `from_name` | string | no | The sender name for the campaign |
| `from_email` | string | no | The sender email address for the campaign |

### Example

```js
var result = app.integrations["zend"].create_campaign({
  subject: "Monthly Newsletter",
  content: "<h1>Hello!</h1>",
  list_ids: [ "list_abc", "list_def" ],
  from_name: "Marketing Team",
  from_email: "marketing@example.com",
})

console.log("Created campaign: " + result.id)
```
---

## list_lists

List all subscriber lists in your Zendesk account.

### Parameters

None.

### Example

```js
var result = app.integrations["zend"].list_lists()

for (const list of (result)) {
  console.log(list.name + " (" + list.id + ")")
}
```
---

## get_list

Get detailed information about a specific subscriber list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The subscriber list ID |

### Example

```js
var result = app.integrations["zend"].get_list({
  list_id: "abc123",
})

console.log("List: " + result.name)
console.log("Subscribers: " + result.subscriber_count)
```
---

## list_subscribers

List subscribers on a Zendesk list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | no | The subscriber list ID to filter by |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of subscribers per page (default: 100) |

### Example

```js
var result = app.integrations["zend"].list_subscribers({
  list_id: "abc123",
  page: 1,
  page_size: 50,
})

for (const sub of (result.data)) {
  console.log(sub.email + " - " + sub.name)
}
```
---

## get_subscribers

Get detailed information about a specific subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | string | yes | The subscriber ID |

### Example

```js
var result = app.integrations["zend"].get_subscribers({
  subscriber_id: "sub_abc123",
})

console.log("Email: " + result.email)
console.log("Name: " + result.name)
console.log("Status: " + result.status)
```
---

## get_current_user

Get the authenticated user's Zendesk account details.

### Parameters

None.

### Example

```js
var result = app.integrations["zend"].get_current_user()

console.log("Account: " + result.email)
console.log("Name: " + result.name)
```
---

## Multi-Account Usage

If you have multiple Zendesk accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zend"].list_lists({})

// Explicit default (portable across setups)
app.integrations["zend"].default.list_lists({})

// Named accounts
app.integrations["zend"].marketing.list_lists({})
app.integrations["zend"].transactional.list_lists({})
```
All functions are identical across accounts — only the credentials differ.
