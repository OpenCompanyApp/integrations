# Invoice Ninja — Lua API Reference

## list_invoices

List invoices from Invoice Ninja with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of invoices per page (default: 20) |
| `page` | integer | no | Page number for pagination |
| `client_id` | string | no | Filter invoices by client ID |
| `status` | string | no | Filter by status: `draft`, `sent`, `partial`, `paid`, `cancelled`, `overdue`, `reversed` |
| `number` | string | no | Filter by invoice number (partial match) |
| `sort` | string | no | Sort field (e.g. `"number"`, `"date"`, `"due_date"`, `"amount"`) |

### Example

```lua
local result = app.integrations.invoiceninja.list_invoices({
  status = "overdue",
  per_page = 50
})

for _, inv in ipairs(result.data) do
  print(inv.number .. ": " .. inv.amount .. " (due " .. inv.due_date .. ")")
end
```

---

## get_invoice

Get a single invoice by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The invoice ID |

### Example

```lua
local result = app.integrations.invoiceninja.get_invoice({ id = "inv_123" })
local inv = result.data
print("Invoice " .. inv.number .. ": " .. inv.amount)
print("Client: " .. inv.client.name)
print("Status: " .. inv.status)
```

---

## create_invoice

Create a new invoice in Invoice Ninja.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | string | yes | The client ID to assign the invoice to |
| `line_items` | array | yes | Array of line items (see below) |
| `due_date` | string | no | Due date in YYYY-MM-DD format |
| `date` | string | no | Invoice date in YYYY-MM-DD format (defaults to today) |
| `public_notes` | string | no | Public notes visible to the client |
| `private_notes` | string | no | Private notes (internal only) |
| `discount` | number | no | Discount amount or percentage |
| `is_amount_discount` | boolean | no | Whether discount is a fixed amount (true) or percentage (false) |
| `tax_name1` | string | no | First tax name |
| `tax_rate1` | number | no | First tax rate percentage |
| `partial` | number | no | Partial/deposit amount |
| `partial_due_date` | string | no | Due date for the partial deposit (YYYY-MM-DD) |

### Line Item Fields

| Name | Type | Description |
|------|------|-------------|
| `product_key` | string | Product key or SKU |
| `notes` | string | Line item description |
| `quantity` | number | Quantity |
| `cost` | number | Unit price |

### Example

```lua
local result = app.integrations.invoiceninja.create_invoice({
  client_id = "client_123",
  line_items = {
    { product_key = "consulting", notes = "Strategy session", quantity = 2, cost = 150.00 },
    { product_key = "hosting", notes = "Monthly hosting", quantity = 1, cost = 49.99 }
  },
  due_date = "2026-05-05",
  public_notes = "Thank you for your business!"
})

print("Created invoice: " .. result.data.number)
```

---

## list_clients

List clients from Invoice Ninja.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of clients per page (default: 20) |
| `page` | integer | no | Page number for pagination |
| `search` | string | no | Search by name or email (partial match) |
| `id_number` | string | no | Filter by client ID number |
| `sort` | string | no | Sort field (e.g. `"name"`, `"balance"`, `"created_at"`) |

### Example

```lua
local result = app.integrations.invoiceninja.list_clients({
  search = "Acme",
  per_page = 10
})

for _, client in ipairs(result.data) do
  print(client.name .. " (balance: " .. client.balance .. ")")
end
```

---

## create_client

Create a new client in Invoice Ninja.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Client or company name |
| `contacts` | array | yes | Array of contacts (see below) |
| `id_number` | string | no | Custom ID number |
| `vat_number` | string | no | VAT/tax identification number |
| `website` | string | no | Client website URL |
| `phone` | string | no | Primary phone number |
| `address1` | string | no | Street address line 1 |
| `address2` | string | no | Street address line 2 |
| `city` | string | no | City |
| `state` | string | no | State or province |
| `postal_code` | string | no | Postal / ZIP code |
| `country_id` | string | no | Country ID (ISO 3166-1 numeric) |
| `private_notes` | string | no | Internal notes |
| `public_notes` | string | no | Notes visible to the client |

### Contact Fields

| Name | Type | Description |
|------|------|-------------|
| `first_name` | string | First name |
| `last_name` | string | Last name |
| `email` | string | Email address |
| `phone` | string | Phone number (optional) |

### Example

```lua
local result = app.integrations.invoiceninja.create_client({
  name = "Acme Corp",
  contacts = {
    { first_name = "John", last_name = "Doe", email = "john@acme.com" }
  },
  vat_number = "NL123456789",
  website = "https://acme.com"
})

print("Created client: " .. result.data.id)
```

---

## list_products

List products from Invoice Ninja.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of products per page (default: 20) |
| `page` | integer | no | Page number for pagination |
| `product_key` | string | no | Filter by product key (exact match) |
| `sort` | string | no | Sort field (e.g. `"product_key"`, `"cost"`, `"created_at"`) |
| `is_deleted` | boolean | no | Include soft-deleted products |

### Example

```lua
local result = app.integrations.invoiceninja.list_products({ per_page = 50 })

for _, product in ipairs(result.data) do
  print(product.product_key .. ": " .. product.cost)
end
```

---

## list_payments

List payments from Invoice Ninja.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of payments per page (default: 20) |
| `page` | integer | no | Page number for pagination |
| `client_id` | string | no | Filter payments by client ID |
| `invoice_id` | string | no | Filter payments by invoice ID |
| `status` | string | no | Filter by status (e.g. `"completed"`, `"pending"`, `"failed"`, `"refunded"`) |
| `sort` | string | no | Sort field (e.g. `"amount"`, `"date"`, `"created_at"`) |

### Example

```lua
local result = app.integrations.invoiceninja.list_payments({
  client_id = "client_123",
  status = "completed"
})

for _, payment in ipairs(result.data) do
  print(payment.amount .. " on " .. payment.date)
end
```

---

## get_current_user

Get the profile of the currently authenticated Invoice Ninja user.

### Parameters

None.

### Example

```lua
local result = app.integrations.invoiceninja.get_current_user({})
local user = result.data
print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Invoice Ninja instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.invoiceninja.function_name({...})

-- Explicit default (portable across setups)
app.integrations.invoiceninja.default.function_name({...})

-- Named accounts
app.integrations.invoiceninja.production.function_name({...})
app.integrations.invoiceninja.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
