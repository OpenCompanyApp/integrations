# Paystack — Lua API Reference

## list_transactions

List transactions on your Paystack integration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of transactions per page (default: 50, max: 100) |
| `page` | integer | no | Page number to retrieve |
| `status` | string | no | Filter by status: `"success"`, `"failed"`, `"abandoned"`, `"reversed"` |
| `customer` | string | no | Filter by customer ID or email |
| `from` | string | no | Start date (ISO 8601, e.g., `"2025-01-01T00:00:00"`) |
| `to` | string | no | End date (ISO 8601, e.g., `"2025-01-31T23:59:59"`) |

### Example

```lua
local result = app.integrations.paystack.list_transactions({
  per_page = 10,
  status = "success"
})

for _, tx in ipairs(result.data) do
  print(tx.id .. ": " .. tx.amount .. " (" .. tx.status .. ")")
end
```

---

## get_transaction

Get details of a specific transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Transaction ID or reference |

### Example

```lua
local result = app.integrations.paystack.get_transaction({
  id = "123456789"
})

print("Status: " .. result.data.status)
print("Amount: " .. result.data.amount)
```

---

## initialize_transaction

Initialize a new payment transaction. Returns an authorization URL for the customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | integer | yes | Amount in kobo (e.g., `50000` for ₦500.00) |
| `email` | string | yes | Customer email address |
| `reference` | string | no | Unique transaction reference |
| `callback_url` | string | no | URL to redirect after payment |

### Example

```lua
local result = app.integrations.paystack.initialize_transaction({
  amount = 50000,
  email = "customer@example.com",
  callback_url = "https://example.com/callback"
})

print("Authorization URL: " .. result.data.authorization_url)
print("Reference: " .. result.data.reference)
```

---

## list_customers

List customers on your integration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of customers per page (default: 50) |
| `page` | integer | no | Page number to retrieve |

### Example

```lua
local result = app.integrations.paystack.list_customers({
  per_page = 20
})

for _, cust in ipairs(result.data) do
  print(cust.email .. " - " .. (cust.first_name or "") .. " " .. (cust.last_name or ""))
end
```

---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `first_name` | string | no | Customer first name |
| `last_name` | string | no | Customer last name |
| `phone` | string | no | Customer phone number |

### Example

```lua
local result = app.integrations.paystack.create_customer({
  email = "jane@example.com",
  first_name = "Jane",
  last_name = "Doe",
  phone = "+2348012345678"
})

print("Created customer: " .. result.data.email)
```

---

## list_plans

List subscription plans.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of plans per page (default: 50) |
| `page` | integer | no | Page number to retrieve |
| `status` | string | no | Filter by status: `"active"` or `"inactive"` |

### Example

```lua
local result = app.integrations.paystack.list_plans({
  status = "active"
})

for _, plan in ipairs(result.data) do
  print(plan.name .. " - " .. plan.amount .. " kobo / " .. plan.interval)
end
```

---

## get_current_user

Verify the Paystack API connection and retrieve payment session timeout settings.

### Parameters

None.

### Example

```lua
local result = app.integrations.paystack.get_current_user({})

print("Payment session timeout: " .. result.data.payment_session_timeout)
```

---

## Multi-Account Usage

If you have multiple Paystack accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.paystack.list_transactions({})

-- Explicit default (portable across setups)
app.integrations.paystack.default.list_transactions({})

-- Named accounts
app.integrations.paystack.production.list_transactions({})
app.integrations.paystack.test.list_transactions({})
```

All functions are identical across accounts — only the credentials differ.
