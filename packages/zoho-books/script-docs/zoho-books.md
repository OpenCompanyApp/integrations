# Zoho Books — JavaScript API Reference

## list_invoices

List invoices from Zoho Books.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `draft`, `sent`, `overdue`, `paid`, `voided`, `unpaid` |
| `customer_id` | string | no | Filter by customer ID |
| `date_start` | string | no | Start date (ISO 8601, e.g., `"2025-01-01"`) |
| `date_end` | string | no | End date (ISO 8601, e.g., `"2025-12-31"`) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `search_text` | string | no | Search by invoice number or customer name |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_list_invoices({
  status: "unpaid",
  per_page: 10,
})

for (const inv of (result.invoices)) {
  console.log(inv.invoice_number + " — " + inv.total + " (" + inv.status + ")")
}
```
---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | The invoice ID |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_get_invoice({
  invoice_id: "4815000000046819",
})

console.log("Invoice: " + result.invoice_number)
console.log("Total: " + result.total)
for (const item of (result.line_items)) {
  console.log("  - " + item.name + ": " + item.rate + " x " + item.quantity)
}
```
---

## create_invoice

Create a new invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | Customer (contact) ID |
| `line_items` | array | yes | Array of line items (see below) |
| `date` | string | no | Invoice date (ISO 8601) |
| `due_date` | string | no | Payment due date (ISO 8601) |
| `invoice_number` | string | no | Custom invoice number |
| `reference_number` | string | no | Reference / PO number |
| `notes` | string | no | Notes on the invoice |
| `terms` | string | no | Terms and conditions |

### Line Item Format

Each line item object:

```js
const example = {
  item_id: "4815000000046810", // optional: existing item ID,
  name: "Consulting", // || provide name directly,
  rate: 150.00,
  quantity: 10,
  description: "Strategy consulting hours",
}
```
### Example

```js
var result = app.integrations["zoho-books"].zohobooks_create_invoice({
  customer_id: "4815000000044001",
  line_items: [
    {
      name: "Web Design",
      rate: 2500.00,
      quantity: 1,
      description: "Homepage redesign",
    },
    {
      item_id: "4815000000046810",
      quantity: 5,
    }
  ],
  date: "2025-06-01",
  due_date: "2025-06-30",
  notes: "Thank you for your business!",
})

console.log("Created invoice: " + result.invoice.invoice_number)
```
---

## update_invoice

Update an existing invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | The invoice ID to update |
| `customer_id` | string | no | Change customer |
| `line_items` | array | no | Replace all line items |
| `date` | string | no | Invoice date |
| `due_date` | string | no | Due date |
| `status` | string | no | Status: `draft`, `sent`, `voided` |
| `notes` | string | no | Invoice notes |
| `terms` | string | no | Terms |
| `reference_number` | string | no | Reference number |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_update_invoice({
  invoice_id: "4815000000046819",
  notes: "Updated: payment via bank transfer",
  status: "sent",
})

console.log("Updated invoice: " + result.invoice.invoice_number)
```
---

## list_contacts

List contacts (customers and vendors).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_type` | string | no | `customer`, `vendor`, or `all` (default: `all`) |
| `status` | string | no | `active`, `inactive`, or `all` |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `search_text` | string | no | Search by name or email |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_list_contacts({
  contact_type: "customer",
  per_page: 20,
})

for (const contact of (result.contacts)) {
  console.log(contact.contact_name + " (" + (contact.email || "no email") + ")")
}
```
---

## get_contact

Get full details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The contact ID |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_get_contact({
  contact_id: "4815000000044001",
})

console.log("Name: " + result.contact_name)
console.log("Email: " + (result.email || "N/A"))
console.log("Outstanding: " + (result.outstanding_receivable_amount || "0"))
```
---

## create_contact

Create a new contact (customer or vendor).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Contact name |
| `email` | string | no | Primary email |
| `phone` | string | no | Phone number |
| `company_name` | string | no | Company name |
| `contact_type` | string | no | `customer` or `vendor` (default: `customer`) |
| `billing_address` | object | no | Billing address |
| `shipping_address` | object | no | Shipping address |
| `notes` | string | no | Internal notes |

### Address Object

```js
const example = {
  attention: "John Doe",
  address: "123 Main St",
  city: "Amsterdam",
  state: "North Holland",
  zip: "1012 AB",
  country: "Netherlands",
  phone: "+31 20 123 4567",
}
```
### Example

```js
var result = app.integrations["zoho-books"].zohobooks_create_contact({
  name: "Acme Corp",
  email: "billing@acme.com",
  contact_type: "customer",
  billing_address: {
    address: "123 Business Ave",
    city: "New York",
    state: "NY",
    zip: "10001",
    country: "USA",
  }
})

console.log("Created contact: " + result.contact.contact_id)
```
---

## list_items

List items (products and services).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter_type` | string | no | `active`, `inactive`, `sales`, `purchases`, `all` |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `search_text` | string | no | Search by name or description |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_list_items({
  filter_type: "active",
})

for (const item of (result.items)) {
  console.log(item.name + " — " + item.rate + " " + (item.unit || ""))
}
```
---

## create_item

Create a new item (product or service).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Item name |
| `rate` | number | yes | Unit price |
| `description` | string | no | Description shown on invoices |
| `unit` | string | no | Unit of measurement (e.g., `"hrs"`, `"pcs"`) |
| `item_type` | string | no | `sales`, `purchases`, or `both` (default: `both`) |
| `tax_id` | string | no | Tax ID to apply |
| `sku` | string | no | SKU identifier |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_create_item({
  name: "Consulting Hour",
  rate: 175.00,
  description: "Professional consulting per hour",
  unit: "hrs",
  item_type: "sales",
})

console.log("Created item: " + result.item.item_id)
```
---

## list_estimates

List estimates (quotes).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | `draft`, `sent`, `accepted`, `declined`, `expired`, `invoiced`, `all` |
| `customer_id` | string | no | Filter by customer ID |
| `date_start` | string | no | Start date (ISO 8601) |
| `date_end` | string | no | End date (ISO 8601) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 200) |
| `search_text` | string | no | Search by estimate number or customer name |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_list_estimates({
  status: "accepted",
})

for (const est of (result.estimates)) {
  console.log(est.estimate_number + " — " + est.total + " (" + est.status + ")")
}
```
---

## create_estimate

Create a new estimate (quote).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | Customer (contact) ID |
| `line_items` | array | yes | Array of line items (same format as create_invoice) |
| `date` | string | no | Estimate date (ISO 8601) |
| `expiry_date` | string | no | Expiry date (ISO 8601) |
| `estimate_number` | string | no | Custom estimate number |
| `reference_number` | string | no | Reference number |
| `notes` | string | no | Notes on the estimate |
| `terms` | string | no | Terms and conditions |

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_create_estimate({
  customer_id: "4815000000044001",
  line_items: [
    {
      name: "Website Development",
      rate: 5000.00,
      quantity: 1,
      description: "Complete website build",
    }
  ],
  date: "2025-06-01",
  expiry_date: "2025-07-01",
  notes: "Valid for 30 days",
})

console.log("Created estimate: " + result.estimate.estimate_number)
```
---

## get_current_user

Get the currently authenticated Zoho Books user.

### Parameters

None.

### Example

```js
var result = app.integrations["zoho-books"].zohobooks_get_current_user({})

console.log("Logged in as: " + (result.users && result.users[0] && result.users[0].name || "Unknown"))
```
---

## Multi-Account Usage

If you have multiple Zoho Books accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-books"].zohobooks_function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-books"].default.zohobooks_function_name({ /* parameters */ })

// Named accounts
app.integrations["zoho-books"].production.zohobooks_function_name({ /* parameters */ })
app.integrations["zoho-books"].sandbox.zohobooks_function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
