# Zoho Bills — JavaScript API Reference

## list_invoices

List invoices from Zoho Bills with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `status` | string | no | Filter by status: `draft`, `sent`, `overdue`, `paid`, `voided`, `partially_paid` |
| `customer_id` | string | no | Filter by customer ID |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_list_invoices({
  status: "overdue",
  per_page: 10,
})

for (const invoice of (result.invoices)) {
  console.log(invoice.invoice_number + ": " + invoice.total + " (" + invoice.status + ")")
}
```
---

## get_invoice

Retrieve a single invoice by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The invoice ID |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_get_invoice({
  id: "inv_12345",
})

console.log("Invoice: " + result.invoice.invoice_number)
console.log("Total: " + result.invoice.total)
console.log("Status: " + result.invoice.status)
```
---

## create_invoice

Create a new invoice in Zoho Bills.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID to bill |
| `line_items` | array | yes | Array of line items (see below) |
| `date` | string | no | Invoice date (YYYY-MM-DD), defaults to today |
| `due_date` | string | no | Due date (YYYY-MM-DD) |

### Line Item Fields

| Field | Type | Description |
|-------|------|-------------|
| `item_id` | string | Existing item ID (preferred) |
| `name` | string | Item name (if no item_id) |
| `description` | string | Line item description |
| `quantity` | number | Quantity (default: 1) still |
| `rate` | number | Unit price |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_create_invoice({
  customer_id: "cnt_12345",
  line_items: [
    { item_id: "itm_001", quantity: 2, rate: 50.00 },
    { name: "Consulting", description: "Strategy session", quantity: 1, rate: 150.00 }
  ],
  date: "2026-04-06",
  due_date: "2026-05-06",
})

console.log("Created invoice: " + result.invoice.invoice_number)
```
---

## list_customers

List customers (contacts) from Zoho Bills.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `type` | string | no | Filter by type: `customer`, `vendor` |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_list_customers({
  type: "customer",
  per_page: 50,
})

for (const contact of (result.contacts)) {
  console.log(contact.contact_id + ": " + contact.contact_name)
}
```
---

## get_customer

Retrieve a single customer (contact) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_get_customer({
  id: "cnt_12345",
})

console.log("Customer: " + result.contact.contact_name)
console.log("Email: " + result.contact.email)
```
---

## list_items

List items (products and services) from Zoho Bills.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_list_items({
  per_page: 100,
})

for (const item of (result.items)) {
  console.log(item.item_id + ": " + item.name + " - " + item.rate)
}
```
---

## get_current_user

Get the currently authenticated Zoho Bills user profile.

### Parameters

None.

### Example

```js
var result = app.integrations["zoho-bills"].zoho_bills_get_current_user({})

console.log("User: " + result.user.name)
console.log("Email: " + result.user.email)
console.log("Role: " + result.user.role)
```
---

## Multi-Account Usage

If you have multiple Zoho Bills accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-bills"].zoho_bills_function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-bills"].default.zoho_bills_function_name({ /* parameters */ })

// Named accounts
app.integrations["zoho-bills"].production.zoho_bills_function_name({ /* parameters */ })
app.integrations["zoho-bills"].sandbox.zoho_bills_function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
