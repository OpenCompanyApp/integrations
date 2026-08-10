# Keap CRM — JavaScript API Reference

## list_contacts

List contacts from Keap CRM with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |

### Example

```js
var result = app.integrations.keap.list_contacts({
  page: 1,
  limit: 20,
})

for (const contact of (result.contacts)) {
  console.log(contact.given_name + " " + contact.family_name)
}
```
---

## get_contact

Retrieve a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap contact ID |

### Example

```js
var result = app.integrations.keap.get_contact({ id: 12345 })
console.log(result.given_name + " " + result.family_name)
```
---

## create_contact

Create a new contact in Keap CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Primary email address |
| `company_name` | string | no | Company name |

At least one field is required.

### Example

```js
var result = app.integrations.keap.create_contact({
  first_name: "Jane",
  last_name: "Doe",
  email: "jane@example.com",
  company_name: "Acme Corp",
})
console.log("Created contact ID: " + result.id)
```
---

## list_opportunities

List sales opportunities with optional stage filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |
| `stage` | string | no | Filter by stage (e.g., "New", "Appointment Scheduled", "Closed Won", "Closed Lost") |

### Example

```js
var result = app.integrations.keap.list_opportunities({
  page: 1,
  limit: 20,
  stage: "New",
})

for (const opp of (result.opportunities)) {
  console.log(opp.title + " — $" + opp.value)
}
```
---

## get_opportunity

Retrieve a single opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap opportunity ID |

### Example

```js
var result = app.integrations.keap.get_opportunity({ id: 67890 })
console.log(result.title + " — Stage: " + result.stage)
```
---

## list_tags

List all tags in Keap.

### Parameters

None.

### Example

```js
var result = app.integrations.keap.list_tags()

for (const tag of (result.tags)) {
  console.log(tag.id + ": " + tag.name)
}
```
---

## get_current_user

Get the currently authenticated Keap user.

### Parameters

None.

### Example

```js
var result = app.integrations.keap.get_current_user()
console.log("Connected as: " + result.first_name + " " + result.last_name)
```
---

## Multi-Account Usage

If you have multiple Keap accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.keap.list_contacts({ page: 1 })

// Explicit default (portable across setups)
app.integrations.keap.default.list_contacts({ page: 1 })

// Named accounts
app.integrations.keap.production.list_contacts({ page: 1 })
app.integrations.keap.staging.list_contacts({ page: 1 })
```
All functions are identical across accounts — only the credentials differ.
