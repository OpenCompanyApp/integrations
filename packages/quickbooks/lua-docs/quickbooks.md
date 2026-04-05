# QuickBooks — Lua API Reference

## quickbooks_create_invoice

Create a QuickBooks invoice for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID to bill. |
| `line_items` | object | yes | Array of line items. Each item should include `DetailType`, `Amount`, and `SalesItemLineDetail` with `ItemRef`. |
| `due_date` | string | no | Due date for the invoice in YYYY-MM-DD format. |

## quickbooks_get_invoice

Retrieve a QuickBooks invoice by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | QuickBooks invoice ID. |

## quickbooks_list_invoices

List QuickBooks invoices.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of invoices to return (default 10, max 1000). |

## quickbooks_update_invoice

Update an existing QuickBooks invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | QuickBooks invoice ID to update. |
| `sync_token` | string | yes | Current sync token of the invoice (incremented on each update). |
| `line_items` | object | yes | Updated array of line items. Each item should include `DetailType`, `Amount`, and `SalesItemLineDetail` with `ItemRef`. |

## quickbooks_create_customer

Create a new QuickBooks customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `display_name` | string | yes | Display name for the customer (must be unique). |
| `first_name` | string | no | Customer first name. |
| `last_name` | string | no | Customer last name. |
| `email` | string | no | Primary email address for the customer. |
| `phone` | string | no | Primary phone number for the customer. |

## quickbooks_get_customer

Retrieve a QuickBooks customer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID. |

## quickbooks_list_customers

List QuickBooks customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of customers to return (default 10, max 1000). |

## quickbooks_update_customer

Update an existing QuickBooks customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID to update. |
| `sync_token` | string | yes | Current sync token of the customer (incremented on each update). |
| `display_name` | string | no | Updated display name for the customer. |
| `email` | string | no | Updated primary email address for the customer. |

## quickbooks_create_payment

Create a QuickBooks payment and link it to invoices.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID receiving the payment. |
| `total_amount` | string | yes | Total payment amount as a decimal string (e.g., `"150.00"`). |

## quickbooks_list_payments

List QuickBooks payments.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of payments to return (default 10, max 1000). |

## quickbooks_create_estimate

Create a QuickBooks estimate for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID for the estimate. |
| `line_items` | object | yes | Array of line items. Each item should include `DetailType`, `Amount`, and `SalesItemLineDetail` with `ItemRef`. |

## quickbooks_list_accounts

List QuickBooks accounts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default 10, max 1000). |

## quickbooks_create_bill

Create a QuickBooks bill from a vendor.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `vendor_id` | string | yes | QuickBooks vendor ID to bill. |
| `line_items` | object | yes | Array of line items. Each item should include `DetailType`, `Amount`, and `AccountBasedExpenseLineDetail`. |
| `due_date` | string | no | Due date for the bill in YYYY-MM-DD format. |

## quickbooks_list_vendors

List QuickBooks vendors.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of vendors to return (default 10, max 1000). |

## quickbooks_get_company_info

Get QuickBooks company information.

### Parameters

*No parameters required.*

## Examples

### Create an invoice

```lua
local result = app.integrations.quickbooks.quickbooks_create_invoice({
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
print("Invoice ID: " .. result.Invoice.Id)
```

### List invoices

```lua
local result = app.integrations.quickbooks.quickbooks_list_invoices({
  limit = 10
})
for _, invoice in ipairs(result.QueryResponse.Invoice) do
  print(invoice.Id .. ": $" .. invoice.TotalAmt)
end
```

### Create a customer

```lua
local result = app.integrations.quickbooks.quickbooks_create_customer({
  display_name = "Acme Corp",
  email = "billing@acme.com",
  phone = "555-0123"
})
```

### Create a payment

```lua
local result = app.integrations.quickbooks.quickbooks_create_payment({
  customer_id = "42",
  total_amount = "150.00"
})
```

---

## Multi-Account Usage

If you have multiple quickbooks accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.quickbooks.function_name({...})

-- Explicit default (portable across setups)
app.integrations.quickbooks.default.function_name({...})

-- Named accounts
app.integrations.quickbooks.work.function_name({...})
app.integrations.quickbooks.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
