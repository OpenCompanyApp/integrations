# Avalara — Lua API Reference

## list_transactions

List transactions from Avalara with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Number of transactions per page (default 20) |
| `skip` | integer | no | Number of records to skip for pagination |
| `filter` | string | no | OData filter expression, e.g. `"status eq 'Committed'"` or `"date ge 2024-01-01"` |
| `orderBy` | string | no | OData order-by expression, e.g. `"date desc"` |

### Example

```lua
local result = app.integrations.avalara.list_transactions({
  filter = "status eq 'Committed'",
  top = 25
})

for _, txn in ipairs(result.transactions) do
  print(txn.id .. " — " .. txn.type .. " — " .. txn.totalAmount)
end

-- Paginate with skip
if result.count >= 25 then
  local page2 = app.integrations.avalara.list_transactions({
    filter = "status eq 'Committed'",
    top = 25,
    skip = 25
  })
end
```

---

## get_transaction

Retrieve details of a single transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The transaction ID or code |

### Example

```lua
local result = app.integrations.avalara.get_transaction({
  id = "123456"
})

local txn = result
print("Type: " .. txn.type)
print("Total: " .. txn.totalAmount)
print("Tax: " .. txn.totalTax)
```

---

## create_transaction

Create a new transaction (sales order or invoice) for tax calculation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `companyCode` | string | yes | The company code |
| `type` | string | no | Transaction type: `"SalesOrder"` or `"SalesInvoice"` (default `"SalesOrder"`) |
| `date` | string | no | Transaction date in YYYY-MM-DD format |
| `code` | string | no | Unique reference code for the transaction |
| `customerCode` | string | no | Customer code |
| `lines` | array | yes | Line items, each with `amount`, `quantity`, and optionally `taxCode`, `description` |
| `addresses` | object | no | Address info with `shipFrom` and `shipTo` containing `city`, `region`, `country`, `postalCode` |
| `commit` | boolean | no | Whether to commit immediately (default false) |
| `description` | string | no | Transaction description |

### Example

```lua
local result = app.integrations.avalara.create_transaction({
  companyCode = "DEFAULT",
  type = "SalesInvoice",
  code = "INV-001",
  customerCode = "CUST-100",
  date = "2024-06-15",
  lines = {
    { amount = 100.00, quantity = 1, taxCode = "P0000000", description = "Tangible personal property" },
    { amount = 50.00, quantity = 2, description = "Consulting service" }
  },
  addresses = {
    shipFrom = { city = "Seattle", region = "WA", country = "US", postalCode = "98101" },
    shipTo = { city = "Portland", region = "OR", country = "US", postalCode = "97201" }
  },
  commit = true,
  description = "June invoice"
})

print("Total tax: " .. result.totalTax)
print("Total amount: " .. result.totalAmount)
```

---

## list_companies

List companies configured in your Avalara account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Number of companies per page (default 20) |
| `skip` | integer | no | Number of records to skip for pagination |
| `filter` | string | no | OData filter expression, e.g. `"isDefault eq true"` |

### Example

```lua
local result = app.integrations.avalara.list_companies({
  top = 50
})

for _, company in ipairs(result.companies) do
  print(company.id .. " — " .. company.name .. " — " .. company.companyCode)
end
```

---

## get_company

Retrieve details of a single company.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The company ID |

### Example

```lua
local result = app.integrations.avalara.get_company({
  id = "12345"
})

print("Name: " .. result.name)
print("Code: " .. result.companyCode)
print("Default: " .. tostring(result.isDefault))
```

---

## list_tax_codes

List tax codes available in Avalara.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Number of tax codes per page (default 20) |
| `skip` | integer | no | Number of records to skip for pagination |
| `filter` | string | no | OData filter expression, e.g. `"isActive eq true"` |

### Example

```lua
local result = app.integrations.avalara.list_tax_codes({
  filter = "isActive eq true",
  top = 50
})

for _, tc in ipairs(result.tax_codes) do
  print(tc.taxCode .. " — " .. tc.description)
end
```

---

## get_current_user

Retrieve the current authenticated Avalara user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.avalara.get_current_user({})

print("User: " .. (result.userName or "N/A"))
print("Email: " .. (result.email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Avalara accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.avalara.list_transactions({top = 10})

-- Explicit default (portable across setups)
app.integrations.avalara.default.list_transactions({top = 10})

-- Named accounts
app.integrations.avalara.production.list_transactions({top = 10})
app.integrations.avalara.sandbox.list_transactions({top = 10})
```

All functions are identical across accounts — only the credentials differ.
