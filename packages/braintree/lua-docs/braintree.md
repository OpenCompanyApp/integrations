# Braintree — Lua API Reference

## list_transactions

List payment transactions for the merchant.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `status` | string | no | Filter by status: `authorized`, `submitted_for_settlement`, `settled`, `settling`, `failed`, `voided`, `declined`, `gateway_rejected` |

### Example

```lua
local result = app.integrations.braintree.list_transactions({
  limit = 20,
  page = 1,
  status = "settled"
})

for _, tx in ipairs(result.transactions) do
  print(tx.id .. ": " .. tx.amount .. " " .. tx.currency_iso_code .. " (" .. tx.status .. ")")
end
```

---

## get_transaction

Retrieve a single transaction by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The transaction ID |

### Example

```lua
local result = app.integrations.braintree.get_transaction({ id = "abc123xyz" })
print("Amount: " .. result.transaction.amount)
print("Status: " .. result.transaction.status)
print("Customer: " .. result.transaction.customer.email)
```

---

## list_customers

List customers stored in Braintree.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations.braintree.list_customers({ limit = 25, page = 1 })

for _, c in ipairs(result.customers) do
  print(c.id .. ": " .. (c.first_name or "") .. " " .. (c.last_name or "") .. " <" .. (c.email or "") .. ">")
end
```

---

## get_customer

Retrieve a single customer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The customer ID |

### Example

```lua
local result = app.integrations.braintree.get_customer({ id = "cust_123" })
print("Name: " .. result.customer.first_name .. " " .. result.customer.last_name)
print("Email: " .. result.customer.email)
```

---

## list_plans

List recurring billing plans.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations.braintree.list_plans({})

for _, plan in ipairs(result.plans) do
  print(plan.id .. ": " .. plan.name .. " - $" .. plan.price .. "/" .. plan.billing_frequency .. " cycles")
end
```

---

## get_plan

Retrieve a single recurring billing plan by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The plan ID |

### Example

```lua
local result = app.integrations.braintree.get_plan({ id = "plan_abc123" })
print("Plan: " .. result.plan.name)
print("Price: $" .. result.plan.price .. "/" .. result.plan.billing_frequency .. " cycles")
```

---

## get_current_user

Get the current merchant account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.braintree.get_current_user({})
print("Merchant: " .. result.merchant.business_name)
print("ID: " .. result.merchant.id)
print("Currency: " .. result.merchant.currency_iso_code)
```

---

## Multi-Account Usage

If you have multiple Braintree accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.braintree.list_transactions({})

-- Explicit default (portable across setups)
app.integrations.braintree.default.list_transactions({})

-- Named accounts
app.integrations.braintree.production.list_transactions({})
app.integrations.braintree.sandbox.list_transactions({})
```

All functions are identical across accounts — only the credentials differ.
