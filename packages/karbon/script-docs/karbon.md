# Karbon — JavaScript API Reference

## list_contacts

List contacts in Karbon with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```js
var result = app.integrations.karbon.list_contacts({
  page: 1,
  limit: 20,
})

for (const contact of (result)) {
  console.log(contact.firstName + " " + contact.lastName)
}
```
---

## get_contact

Get a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |

### Example

```js
var contact = app.integrations.karbon.get_contact({
  id: "contact-123",
})

console.log(contact.firstName + " " + contact.lastName)
console.log(contact.email)
console.log(contact.company)
```
---

## create_contact

Create a new contact in Karbon.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `firstName` | string | yes | First name |
| `lastName` | string | yes | Last name |
| `email` | string | no | Email address |
| `company` | string | no | Company or organization name |
| `phone` | string | no | Phone number |

### Example

```js
var contact = app.integrations.karbon.create_contact({
  firstName: "Jane",
  lastName: "Doe",
  email: "jane@example.com",
  company: "Acme Corp",
  phone: "+1234567890",
})

console.log("Created contact: " + contact.id)
```
---

## list_work_items

List work items with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status (e.g., "Open", "InProgress", "Completed") |
| `assignee` | string | no | Filter by assignee email or ID |

### Example

```js
// List open work items
var result = app.integrations.karbon.list_work_items({
  status: "Open",
  limit: 50,
})

for (const item of (result)) {
  console.log(item.title + " - " + item.status)
}

// List work items assigned to a specific user
var assigned = app.integrations.karbon.list_work_items({
  assignee: "user@example.com",
  page: 1,
})
```
---

## get_work_item

Get a single work item by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique work item identifier |

### Example

```js
var item = app.integrations.karbon.get_work_item({
  id: "work-item-456",
})

console.log(item.title)
console.log(item.status)
console.log(item.dueDate)
```
---

## list_users

List users in the Karbon account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users to return (default: 20) |

### Example

```js
var users = app.integrations.karbon.list_users({
  limit: 50,
})

for (const user of (users)) {
  console.log(user.firstName + " " + user.lastName + " - " + user.email)
}
```
---

## get_current_user

Get the currently authenticated user.

### Parameters

None.

### Example

```js
var me = app.integrations.karbon.get_current_user({})

console.log("Logged in as: " + me.firstName + " " + me.lastName)
console.log("Email: " + me.email)
```
---

## Multi-Account Usage

If you have multiple Karbon accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.karbon.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.karbon.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.karbon.firm_a.function_name({ /* parameters */ })
app.integrations.karbon.firm_b.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
