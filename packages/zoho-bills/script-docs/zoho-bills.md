# Zoho Bills — Ruby API Reference

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

```ruby
result = app.call("integrations.zoho-bills.list_invoices", status: "overdue", per_page: 10)
result.invoices.each do |invoice|
  puts((invoice.invoice_number).to_s + ": " + (invoice.total).to_s + " (" + (invoice.status).to_s + ")")
end
```
---

## get_invoice

Retrieve a single invoice by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The invoice ID |

### Example

```ruby
result = app.call("integrations.zoho-bills.get_invoice", id: "inv_12345")
puts("Invoice: " + (result.invoice.invoice_number).to_s)
puts("Total: " + (result.invoice.total).to_s)
puts("Status: " + (result.invoice.status).to_s)
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

```ruby
result = app.call("integrations.zoho-bills.create_invoice", customer_id: "cnt_12345", line_items: [{item_id: "itm_001", quantity: 2, rate: 50}, {name: "Consulting", description: "Strategy session", quantity: 1, rate: 150}], date: "2026-04-06", due_date: "2026-05-06")
puts("Created invoice: " + (result.invoice.invoice_number).to_s)
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

```ruby
result = app.call("integrations.zoho-bills.list_customers", type: "customer", per_page: 50)
result.contacts.each do |contact|
  puts((contact.contact_id).to_s + ": " + (contact.contact_name).to_s)
end
```
---

## get_customer

Retrieve a single customer (contact) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID |

### Example

```ruby
result = app.call("integrations.zoho-bills.get_customer", id: "cnt_12345")
puts("Customer: " + (result.contact.contact_name).to_s)
puts("Email: " + (result.contact.email).to_s)
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

```ruby
result = app.call("integrations.zoho-bills.list_items", per_page: 100)
result.items.each do |item|
  puts((item.item_id).to_s + ": " + (item.name).to_s + " - " + (item.rate).to_s)
end
```
---

## get_current_user

Get the currently authenticated Zoho Bills user profile.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.zoho-bills.get_current_user")
puts("User: " + (result.user.name).to_s)
puts("Email: " + (result.user.email).to_s)
puts("Role: " + (result.user.role).to_s)
```
---

## Multi-Account Usage

If you have multiple Zoho Bills accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
