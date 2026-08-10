# Mautic — JavaScript API Reference

## list_contacts

List contacts in Mautic with optional search, filtering, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query (e.g. `"email:john@example.com"` or a name) |
| `limit` | integer | no | Maximum contacts to return (default: 30, max: 100) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"email"`, `"firstName"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```js
var result = app.integrations.mautic.list_contacts({
  search: "example.com",
  limit: 10,
})

for (const contact of (result.contacts)) {
  console.log(contact.email + " - " + (contact.firstname || "") + " " + (contact.lastname || ""))
}
```
---

## get_contact

Get a single contact by ID, including all fields and tags.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Mautic contact ID |

### Example

```js
var result = app.integrations.mautic.get_contact({ id: 42 })
console.log("Email: " + result.email)
console.log("Name: " + (result.firstname || "") + " " + (result.lastname || ""))
```
---

## create_contact

Create a new contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `firstname` | string | no | First name |
| `lastname` | string | no | Last name |
| `phone` | string | no | Phone number |
| `company` | string | no | Company name |
| `position` | string | no | Job title |
| `tags` | array | no | Tags to assign (e.g. `{"lead", "newsletter"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```js
var result = app.integrations.mautic.create_contact({
  email: "john@example.com",
  firstname: "John",
  lastname: "Doe",
  company: "Acme Corp",
  tags: [ "lead", "website-signup" ],
})

console.log("Created contact ID: " + result.contact.id)
```
---

## update_contact

Update an existing contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to update |
| `email` | string | no | Updated email address |
| `firstname` | string | no | Updated first name |
| `lastname` | string | no | Updated last name |
| `phone` | string | no | Updated phone number |
| `company` | string | no | Updated company name |
| `position` | string | no | Updated job title |
| `tags` | array | no | Tags to set (e.g. `{"customer"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```js
var result = app.integrations.mautic.update_contact({
  id: 42,
  firstname: "Jane",
  company: "New Corp",
  tags: [ "customer", "vip" ],
})

console.log("Updated contact: " + result.contact.email)
```
---

## delete_contact

Delete a contact from Mautic by ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to delete |

### Example

```js
var result = app.integrations.mautic.delete_contact({ id: 42 })
console.log(result) // "Contact 42 has been deleted from Mautic."
```
---

## list_emails

List marketing emails from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter emails |
| `limit` | integer | no | Maximum emails to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"subject"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```js
var result = app.integrations.mautic.list_emails({ limit: 10 })

for (const email of (result.emails)) {
  console.log(email.name + " - " + (email.subject || "no subject"))
}
```
---

## list_segments

List contact segments (lists) from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter segments |
| `limit` | integer | no | Maximum segments to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```js
var result = app.integrations.mautic.list_segments({})

for (const segment of (result.segments)) {
  console.log(segment.name + " (" + (segment.alias || "") + ") - " + (segment.contactCount || 0) + " contacts")
}
```
---

## list_forms

List forms from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter forms |
| `limit` | integer | no | Maximum forms to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```js
var result = app.integrations.mautic.list_forms({})

for (const form of (result.forms)) {
  console.log(form.name + " - " + (form.submissionCount || 0) + " submissions")
}
```
---

## get_current_user

Get the currently authenticated Mautic user. Useful to verify credentials.

### Parameters

None.

### Example

```js
var result = app.integrations.mautic.get_current_user({})
console.log("Authenticated as: " + result.username + " (" + (result.email || "") + ")")
```
---

## Multi-Account Usage

If you have multiple Mautic instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mautic.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mautic.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.mautic.production.function_name({ /* parameters */ })
app.integrations.mautic.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
