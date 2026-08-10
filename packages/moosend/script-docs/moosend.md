# Moosend — JavaScript API Reference

## list_mailing_lists

List all mailing lists in your Moosend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of mailing lists to return (default: 10). |
| `offset` | integer | no | Offset for pagination (default: 0). |

### Example

```js
var result = app.integrations.moosend.list_mailing_lists({
  limit: 20,
  offset: 0,
})

for (const list of (result.MailingLists)) {
  console.log(list.Name + " (ID: " + list.ID + ") — " + list.ActiveMemberCount + " active subscribers")
}
```
---

## get_mailing_list

Get detailed information about a specific mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The mailing list ID. |

### Example

```js
var result = app.integrations.moosend.get_mailing_list({
  id: "abc123-def456",
})

var list = result.MailingList
console.log("List: " + list.Name)
console.log("Active subscribers: " + list.ActiveMemberCount)
console.log("Unsubscribed: " + list.UnsubscribedMemberCount)
```
---

## create_mailing_list

Create a new mailing list in Moosend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new mailing list. |

### Example

```js
var result = app.integrations.moosend.create_mailing_list({
  name: "Newsletter Subscribers",
})

console.log("Created list with ID: " + result.MailingList.ID)
```
---

## list_subscribers

List subscribers for a specific mailing list. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to retrieve subscribers for. |
| `limit` | integer | no | Maximum number of subscribers to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Subscribed"`, `"Unsubscribed"`, `"Bounced"`, `"Removed"`. |

### Example

```js
var result = app.integrations.moosend.list_subscribers({
  list_id: "abc123-def456",
  limit: 50,
  page: 1,
  status: "Subscribed",
})

for (const sub of (result.Subscribers)) {
  console.log(sub.Email + " — " + (sub.Name || "N/A"))
}
```
---

## add_subscriber

Add a new subscriber to a Moosend mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to add the subscriber to. |
| `email` | string | yes | The subscriber's email address. |
| `name` | string | no | The subscriber's name. |

### Example

```js
var result = app.integrations.moosend.add_subscriber({
  list_id: "abc123-def456",
  email: "user@example.com",
  name: "Jane Doe",
})

console.log("Added subscriber ID: " + result.Subscriber.ID)
```
---

## list_campaigns

List all email campaigns in your Moosend account. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of campaigns to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Sent"`, `"Draft"`, `"Scheduled"`, `"Sending"`. |

### Example

```js
var result = app.integrations.moosend.list_campaigns({
  limit: 20,
  page: 1,
  status: "Sent",
})

for (const campaign of (result.Campaigns)) {
  console.log(campaign.Name + " — Subject: " + campaign.Subject + " — Status: " + campaign.Status)
}
```
---

## get_current_user

Get the current authenticated Moosend user. Useful as a health check to verify API connectivity.

### Parameters

None.

### Example

```js
var result = app.integrations.moosend.get_current_user({})

console.log("User: " + result.User.Email)
console.log("Account: " + result.User.Company)
```
---

## Multi-Account Usage

If you have multiple Moosend accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.moosend.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.moosend.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.moosend.work.function_name({ /* parameters */ })
app.integrations.moosend.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
