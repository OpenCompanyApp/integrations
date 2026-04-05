# Zoho Books — Lua API Reference

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

```lua
local result = app.integrations.zoho_books.list_invoices({
  status = "unpaid",
  per_page = 10
})

for _, inv in ipairs(result.invoices) do
  print(inv.invoice_number .. " — " .. inv.total .. " (" .. inv.status .. ")")
end
```

---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | The invoice ID |

### Example

```lua
local result = app.integrations.zoho_books.get_invoice({
  invoice_id = "4815000000046819"
})

print("Invoice: " .. result.invoice_number)
print("Total: " .. result.total)
for _, item in ipairs(result.line_items) do
  print("  - " .. item.name .. ": " .. item.rate .. " x " .. item.quantity)
end
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

```lua
{
  item_id = "4815000000046810",  -- optional: existing item ID
  name = "Consulting",           -- or provide name directly
  rate = 150.00,
  quantity = 10,
  description = "Strategy consulting hours"
}
```

### Example

```lua
local result = app.integrations.zoho_books.create_invoice({
  customer_id = "4815000000044001",
  line_items = {
    {
      name = "Web Design",
      rate = 2500.00,
      quantity = 1,
      description = "Homepage redesign"
    },
    {
      item_id = "4815000000046810",
      quantity = 5
    }
  },
  date = "2025-06-01",
  due_date = "2025-06-30",
  notes = "Thank you for your business!"
})

print("Created invoice: " .. result.invoice.invoice_number)
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

```lua
local result = app.integrations.zoho_books.update_invoice({
  invoice_id = "4815000000046819",
  notes = "Updated: payment via bank transfer",
  status = "sent"
})

print("Updated invoice: " .. result.invoice.invoice_number)
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

```lua
local result = app.integrations.zoho_books.list_contacts({
  contact_type = "customer",
  per_page = 20
})

for _, contact in ipairs(result.contacts) do
  print(contact.contact_name .. " (" .. (contact.email or "no email") .. ")")
end
```

---

## get_contact

Get full details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The contact ID |

### Example

```lua
local result = app.integrations.zoho_books.get_contact({
  contact_id = "4815000000044001"
})

print("Name: " .. result.contact_name)
print("Email: " .. (result.email or "N/A"))
print("Outstanding: " .. (result.outstanding_receivable_amount or "0"))
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

```lua
{
  attention = "John Doe",
  address = "123 Main St",
  city = "Amsterdam",
  state = "North Holland",
  zip = "1012 AB",
  country = "Netherlands",
  phone = "+31 20 123 4567"
}
```

### Example

```lua
local result = app.integrations.zoho_books.create_contact({
  name = "Acme Corp",
  email = "billing@acme.com",
  contact_type = "customer",
  billing_address = {
    address = "123 Business Ave",
    city = "New York",
    state = "NY",
    zip = "10001",
    country = "USA"
  }
})

print("Created contact: " .. result.contact.contact_id)
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

```lua
local result = app.integrations.zoho_books.list_items({
  filter_type = "active"
})

for _, item in ipairs(result.items) do
  print(item.name .. " — " .. item.rate .. " " .. (item.unit or ""))
end
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

```lua
local result = app.integrations.zoho_books.create_item({
  name = "Consulting Hour",
  rate = 175.00,
  description = "Professional consulting per hour",
  unit = "hrs",
  item_type = "sales"
})

print("Created item: " .. result.item.item_id)
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

```lua
local result = app.integrations.zoho_books.list_estimates({
  status = "accepted"
})

for _, est in ipairs(result.estimates) do
  print(est.estimate_number .. " — " .. est.total .. " (" .. est.status .. ")")
end
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

```lua
local result = app.integrations.zoho_books.create_estimate({
  customer_id = "4815000000044001",
  line_items = {
    {
      name = "Website Development",
      rate = 5000.00,
      quantity = 1,
      description = "Complete website build"
    }
  },
  date = "2025-06-01",
  expiry_date = "2025-07-01",
  notes = "Valid for 30 days"
})

print("Created estimate: " .. result.estimate.estimate_number)
```

---

## get_current_user

Get the currently authenticated Zoho Books user.

### Parameters

None.

### Example

```lua
local result = app.integrations.zoho_books.get_current_user({})

print("Logged in as: " .. (result.users and result.users[1] and result.users[1].name or "Unknown"))
```

---

## Multi-Account Usage

If you have multiple Zoho Books accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.zoho_books.function_name({...})

-- Explicit default (portable across setups)
app.integrations.zoho_books.default.function_name({...})

-- Named accounts
app.integrations.zoho_books.production.function_name({...})
app.integrations.zoho_books.sandbox.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
