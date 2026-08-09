# FreeAgent — JavaScript API Reference

## list_invoices

List invoices from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `Draft`, `Sent`, `Cancelled`, `Late`, `Paid` |
| `from_date` | string | no | Start date (ISO 8601, e.g., `"2025-01-01"`) |
| `to_date` | string | no | End date (ISO 8601, e.g., `"2025-12-31"`) |
| `contact` | string | no | Filter by contact URL or ID |
| `project` | string | no | Filter by project URL or ID |
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```js
var result = app.integrations.freeagent.list_invoices({
  status: "Sent",
  from_date: "2025-01-01",
  per_page: 50,
})

for (const invoice of (result.invoices)) {
  console.log(invoice.reference + ": " + invoice.total + " " + invoice.currency)
}
```
---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | integer | yes | The ID of the invoice |

### Example

```js
var result = app.integrations.freeagent.get_invoice({
  invoice_id: 12345,
})

console.log("Invoice: " + result.invoice.reference)
console.log("Total: " + result.invoice.total + " " + result.invoice.currency)
console.log("Status: " + result.invoice.status)

for (const item of (result.invoice.invoice_items)) {
  console.log("  - " + item.description + ": " + item.price)
}
```
---

## create_invoice

Create a new invoice in FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact` | string | yes | Contact URL or ID (e.g., `"https://api.freeagent.com/v2/contacts/123"`) |
| `dated_on` | string | yes | Invoice date (ISO 8601) |
| `invoice_items` | array | yes | Line items, each with `description`, `quantity`, `price` |
| `due_on` | string | no | Due date (ISO 8601) |
| `reference` | string | no | Reference number |
| `currency` | string | no | Currency code (`GBP`, `USD`, `EUR`) |
| `comments` | string | no | Invoice comments |
| `project` | string | no | Project URL to associate |

### Example

```js
var result = app.integrations.freeagent.create_invoice({
  contact: "https://api.freeagent.com/v2/contacts/123",
  dated_on: "2025-04-01",
  due_on: "2025-04-30",
  reference: "INV-001",
  currency: "GBP",
  invoice_items: [
    { description: "Web development", quantity: 10, price: 75.00 },
    { description: "Hosting setup", quantity: 1, price: 150.00 }
  ]
})

console.log("Created invoice: " + result.invoice.reference)
```
---

## list_contacts

List contacts from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view` | string | no | Filter: `all`, `customers`, `suppliers`, `active`, `inactive` |
| `order` | string | no | Sort: `name`, `created_at`, `updated_at`. Prefix `-` for descending |
| `created_since` | string | no | Only contacts created after this date |
| `updated_since` | string | no | Only contacts updated after this date |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```js
var result = app.integrations.freeagent.list_contacts({
  view: "customers",
  order: "name",
  per_page: 50,
})

for (const contact of (result.contacts)) {
  console.log(contact.organisation_name || (contact.first_name + " " + contact.last_name))
}
```
---

## get_contact

Get full details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | integer | yes | The ID of the contact |

### Example

```js
var result = app.integrations.freeagent.get_contact({
  contact_id: 456,
})

var c = result.contact
console.log(c.organisation_name || (c.first_name + " " + c.last_name))
console.log("Email: " + (c.email || "N/A"))
console.log("Type: " + c.contact_type)
```
---

## create_contact

Create a new contact in FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name (for individuals) |
| `last_name` | string | no | Last name (for individuals) |
| `organisation_name` | string | no | Company name (for companies) |
| `email` | string | no | Primary email |
| `phone_number` | string | no | Phone number |
| `contact_type` | string | no | `Customer` (default) or `Supplier` |
| `billing_email` | string | no | Billing email |
| `address1` | string | no | Address line 1 |
| `address2` | string | no | Address line 2 |
| `town` | string | no | Town or city |
| `region` | string | no | State or province |
| `postcode` | string | no | Postal code |
| `country` | string | no | Country code (e.g., `GB`, `US`, `NL`) |

> At least one of `first_name`, `last_name`, or `organisation_name` is required.

### Example

```js
var result = app.integrations.freeagent.create_contact({
  organisation_name: "Acme Corp",
  email: "billing@acme.com",
  contact_type: "Customer",
  country: "GB",
})

console.log("Created contact: " + result.contact.organisation_name)
```
---

## list_projects

List projects from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view` | string | no | Filter: `all`, `active`, `completed`, `cancelled`, `unquoted` |
| `contact` | string | no | Filter by contact URL or ID |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```js
var result = app.integrations.freeagent.list_projects({
  view: "active",
})

for (const project of (result.projects)) {
  console.log(project.name + " (" + project.status + ")")
  console.log("  Budget: " + project.budget + " " + project.currency)
}
```
---

## list_expenses

List expenses from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | no | Start date (ISO 8601) |
| `to_date` | string | no | End date (ISO 8601) |
| `contact` | string | no | Filter by contact URL or ID |
| `project` | string | no | Filter by project URL or ID |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```js
var result = app.integrations.freeagent.list_expenses({
  from_date: "2025-01-01",
  to_date: "2025-03-31",
  per_page: 100,
})

for (const expense of (result.expenses)) {
  console.log(expense.description + ": " + expense.total + " " + expense.currency)
}
```
---

## get_current_user

Get the currently authenticated FreeAgent user.

### Parameters

None.

### Example

```js
var result = app.integrations.freeagent.get_current_user({})

var user = result.user
console.log("Name: " + user.first_name + " " + user.last_name)
console.log("Email: " + user.email)
console.log("Role: " + user.role)
```
---

## Multi-Account Usage

If you have multiple FreeAgent accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.freeagent.list_invoices({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.freeagent.default.list_invoices({ /* parameters */ })

// Named accounts
app.integrations.freeagent.uk.list_invoices({ /* parameters */ })
app.integrations.freeagent.us.list_invoices({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
