# QuickBooks — Lua API Reference

## list_invoices

List QuickBooks invoices with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of invoices to return (default 10, max 1000) |

### Example

```lua
local result = app.integrations.quickbooks.list_invoices({
  limit = 10
})

for _, invoice in ipairs(result.invoices) do
  print(invoice.doc_number .. " - $" .. invoice.total_amt)
end
```

---

## get_invoice

Retrieve a QuickBooks invoice by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | QuickBooks invoice ID |

### Example

```lua
local invoice = app.integrations.quickbooks.get_invoice({
  invoice_id = "42"
})

print("Invoice #" .. invoice.doc_number)
print("Total: $" .. invoice.total_amt)
print("Balance: $" .. invoice.balance)
```

---

## create_invoice

Create a new QuickBooks invoice for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID to bill |
| `line_items` | array | yes | Array of line items. Each item should include DetailType, Amount, and SalesItemLineDetail with ItemRef |
| `due_date` | string | no | Due date for the invoice in YYYY-MM-DD format |

### Example

```lua
local invoice = app.integrations.quickbooks.create_invoice({
  customer_id = "42",
  line_items = {
    {
      DetailType = "SalesItemLineDetail",
      Amount = 150.00,
      SalesItemLineDetail = { ItemRef = { value = "1" } }
    }
  },
  due_date = "2026-05-01"
})

print("Created invoice ID: " .. invoice.id)
```

---

## list_customers

List QuickBooks customers with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of customers to return (default 10, max 1000) |

### Example

```lua
local result = app.integrations.quickbooks.list_customers({
  limit = 10
})

for _, customer in ipairs(result.customers) do
  print(customer.display_name .. " - " .. (customer.email or "N/A"))
end
```

---

## get_customer

Retrieve a QuickBooks customer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID |

### Example

```lua
local customer = app.integrations.quickbooks.get_customer({
  customer_id = "42"
})

print(customer.display_name)
print("Email: " .. (customer.email or "N/A"))
print("Balance: $" .. customer.balance)
```

---

## list_accounts

List QuickBooks accounts (chart of accounts).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default 10, max 1000) |

### Example

```lua
local result = app.integrations.quickbooks.list_accounts({
  limit = 20
})

for _, account in ipairs(result.accounts) do
  print(account.name .. " (" .. account.classification .. ") - $" .. account.current_balance)
end
```

---

## get_current_user

Get current user / company info and verify API connection.

### Parameters

None.

### Example

```lua
local info = app.integrations.quickbooks.get_current_user({})
print("Connected to QuickBooks")
```

---

## Multi-Account Usage

If you have multiple QuickBooks accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.quickbooks.list_invoices({limit = 10})

-- Explicit default (portable across setups)
app.integrations.quickbooks.default.list_invoices({limit = 10})

-- Named accounts (e.g., different companies)
app.integrations.quickbooks.us_company.list_invoices({limit = 10})
app.integrations.quickbooks.uk_company.list_invoices({limit = 10})
```

All functions are identical across accounts — only the credentials differ.
