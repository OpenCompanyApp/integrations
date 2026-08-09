# GetResponse — JavaScript API Reference

## list_contacts

List contacts in your GetResponse account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Default: 1 |
| `perPage` | integer | no | Results per page (max 1000). Default: 50 |

### Example

```js
var result = app.integrations.getresponse.list_contacts({
  page: 1,
  perPage: 25,
})

for (const contact of (result)) {
  console.log(contact.email + " - " + (contact.name || "N/A"))
}
```
---

## get_contact

Get details of a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |

### Example

```js
var result = app.integrations.getresponse.get_contact({
  id: "abc123",
})

console.log(result.email)
console.log(result.name)
```
---

## create_contact

Create a new contact in GetResponse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Contact email address |
| `name` | string | no | Contact full name |
| `campaign` | string | no | Campaign ID to assign the contact to |

### Example

```js
var result = app.integrations.getresponse.create_contact({
  email: "john@example.com",
  name: "John Doe",
  campaign: "campaignIdHere",
})

console.log("Created contact: " + result.contactId)
```
---

## update_contact

Update an existing contact's details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |
| `name` | string | no | New name for the contact |

### Example

```js
var result = app.integrations.getresponse.update_contact({
  id: "abc123",
  name: "Jane Doe",
})

console.log("Contact updated")
```
---

## delete_contact

Delete a contact from GetResponse permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier to delete |

### Example

```js
var result = app.integrations.getresponse.delete_contact({
  id: "abc123",
})

console.log(result) // "Contact 'abc123' has been deleted."
```
---

## list_campaigns

List all campaigns in your GetResponse account.

### Parameters

None.

### Example

```js
var result = app.integrations.getresponse.list_campaigns({})

for (const campaign of (result)) {
  console.log(campaign.campaignId + " - " + campaign.name)
}
```
---

## get_campaign

Get details of a specific campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique campaign identifier |

### Example

```js
var result = app.integrations.getresponse.get_campaign({
  id: "campaignIdHere",
})

console.log(result.name)
```
---

## create_campaign

Create a new email campaign in GetResponse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new campaign |

### Example

```js
var result = app.integrations.getresponse.create_campaign({
  name: "Q1 Newsletter",
})

console.log("Created campaign: " + result.campaignId)
```
---

## list_newsletters

List newsletters in your GetResponse account.

### Parameters

None.

### Example

```js
var result = app.integrations.getresponse.list_newsletters({})

for (const newsletter of (result)) {
  console.log(newsletter.subject + " (" + newsletter.status + ")")
}
```
---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```js
var result = app.integrations.getresponse.get_current_user({})

console.log("Account: " + result.email)
console.log("Name: " + (result.firstName || "") + " " + (result.lastName || ""))
```
---

## Multi-Account Usage

If you have multiple GetResponse accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.getresponse.list_contacts({})

// Explicit default (portable across setups)
app.integrations.getresponse.default.list_contacts({})

// Named accounts
app.integrations.getresponse.marketing.list_contacts({})
app.integrations.getresponse.sales.list_contacts({})
```
All functions are identical across accounts — only the credentials differ.
