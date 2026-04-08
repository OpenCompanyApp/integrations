# Zoho Bills — Lua API Reference

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

```lua
local result = app.integrations.zoho_bills.list_invoices({
  status = "overdue",
  per_page = 10
})

for _, invoice in ipairs(result.invoices) do
  print(invoice.invoice_number .. ": " .. invoice.total .. " (" .. invoice.status .. ")")
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

```lua
local result = app.integrations.zoho_bills.get_invoice({
  id = "inv_12345"
})

print("Invoice: " .. result.invoice.invoice_number)
print("Total: " .. result.invoice.total)
print("Status: " .. result.invoice.status)
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

```lua
local result = app.integrations.zoho_bills.create_invoice({
  customer_id = "cnt_12345",
  line_items = {
    { item_id = "itm_001", quantity = 2, rate = 50.00 },
    { name = "Consulting", description = "Strategy session", quantity = 1, rate = 150.00 }
  },
  date = "2026-04-06",
  due_date = "2026-05-06"
})

print("Created invoice: " .. result.invoice.invoice_number)
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

```lua
local result = app.integrations.zoho_bills.list_customers({
  type = "customer",
  per_page = 50
})

for _, contact in ipairs(result.contacts) do
  print(contact.contact_id .. ": " .. contact.contact_name)
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

```lua
local result = app.integrations.zoho_bills.get_customer({
  id = "cnt_12345"
})

print("Customer: " .. result.contact.contact_name)
print("Email: " .. result.contact.email)
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

```lua
local result = app.integrations.zoho_bills.list_items({
  per_page = 100
})

for _, item in ipairs(result.items) do
  print(item.item_id .. ": " .. item.name .. " - " .. item.rate)
end
```

---

## get_current_user

Get the currently authenticated Zoho Bills user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.zoho_bills.get_current_user({})

print("User: " .. result.user.name)
print("Email: " .. result.user.email)
print("Role: " .. result.user.role)
```

---

## Multi-Account Usage

If you have multiple Zoho Bills accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.zoho_bills.function_name({...})

-- Explicit default (portable across setups)
app.integrations.zoho_bills.default.function_name({...})

-- Named accounts
app.integrations.zoho_bills.production.function_name({...})
app.integrations.zoho_bills.sandbox.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
