# FreshBooks — Lua API Reference

## list_invoices

List invoices from FreshBooks with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `status` | Invoice status: `draft`, `sent`, `viewed`, `paid`, `disputed`, `overdue` |
| `clientid` | Filter by client ID |
| `date_from` | Start date (YYYY-MM-DD) |
| `date_to` | End date (YYYY-MM-DD) |
| `invoice_number` | Filter by invoice number |

### Example

```lua
local result = app.integrations.freshbooks.list_invoices({
  search = { status = "sent" },
  per_page = 25
})

for _, invoice in ipairs(result.invoices) do
  print(invoice.invoice_number .. ": " .. invoice.amount.amount .. " " .. invoice.status)
end
```

---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | integer | yes | The FreshBooks invoice ID |

### Example

```lua
local result = app.integrations.freshbooks.get_invoice({ invoice_id = 12345 })
local inv = result.invoice
print(inv.invoice_number .. " - " .. inv.status)
for _, line in ipairs(inv.lines) do
  print("  " .. line.name .. ": " .. line.unit_cost.amount)
end
```

---

## create_invoice

Create a new invoice in FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | integer | yes | The client ID to bill |
| `lines` | array | yes | Array of line items (see below) |
| `date` | string | no | Invoice date (YYYY-MM-DD), defaults to today |
| `due_date` | string | no | Due date (YYYY-MM-DD) |
| `invoice_number` | string | no | Custom invoice number |
| `notes` | string | no | Notes displayed on the invoice |
| `terms` | string | no | Payment terms (e.g., "Net 30") |
| `discount_value` | number | no | Discount amount or percentage |
| `discount_type` | string | no | `percentage` or `amount` |

### Line Item Format

Each line item is an object with:

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `name` | string | yes | Line item name |
| `description` | string | no | Line item description |
| `qty` | number | yes | Quantity |
| `unit_cost` | object | yes | Object with `amount` (string) and `code` (currency code) |

### Example

```lua
local result = app.integrations.freshbooks.create_invoice({
  client_id = 100,
  lines = {
    {
      name = "Web Development",
      description = "Frontend development work",
      qty = 40,
      unit_cost = { amount = "150.00", code = "USD" }
    }
  },
  notes = "Thank you for your business!",
  terms = "Net 30"
})
print("Created invoice: " .. result.invoice.invoice_number)
```

---

## list_clients

List clients from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `email` | Filter by email address |
| `fname` | Filter by first name |
| `lname` | Filter by last name |
| `organization` | Filter by organization name |
| `state` | `active` or `archived` |

### Example

```lua
local result = app.integrations.freshbooks.list_clients({
  search = { organization = "Acme" },
  per_page = 50
})

for _, client in ipairs(result.clients) do
  print(client.organization .. " - " .. client.email)
end
```

---

## get_client

Get details of a specific client.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | integer | yes | The FreshBooks client ID |

### Example

```lua
local result = app.integrations.freshbooks.get_client({ client_id = 100 })
local client = result.client
print(client.organization .. " - Balance: " .. client.outstanding_balance.amount)
```

---

## list_projects

List projects from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `title` | Filter by project title |
| `active` | `true` or `false` |
| `clientid` | Filter by client ID |

### Example

```lua
local result = app.integrations.freshbooks.list_projects({
  search = { active = true }
})

for _, project in ipairs(result.projects) do
  print(project.title .. " - " .. project.billing_method)
end
```

---

## list_payments

List payments from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `clientid` | Filter by client ID |
| `invoiceid` | Filter by invoice ID |
| `date_from` | Start date (YYYY-MM-DD) |
| `date_to` | End date (YYYY-MM-DD) |
| `type` | Payment type: `check`, `credit`, `card`, `bank` |

### Example

```lua
local result = app.integrations.freshbooks.list_payments({
  search = { date_from = "2025-01-01", date_to = "2025-01-31" },
  per_page = 50
})

for _, payment in ipairs(result.payments) do
  print(payment.date .. ": " .. payment.amount.amount .. " via " .. payment.type)
end
```

---

## get_current_user

Get the profile of the currently authenticated FreshBooks user.

### Parameters

None.

### Example

```lua
local result = app.integrations.freshbooks.get_current_user({})

for _, user in ipairs(result.users) do
  print(user.first_name .. " " .. user.last_name .. " - " .. user.email)
end
```

---

## Multi-Account Usage

If you have multiple FreshBooks accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshbooks.function_name({...})

-- Explicit default (portable across setups)
app.integrations.freshbooks.default.function_name({...})

-- Named accounts
app.integrations.freshbooks.us_business.function_name({...})
app.integrations.freshbooks.eu_business.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
