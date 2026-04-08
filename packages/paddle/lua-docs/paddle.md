# Paddle — Lua API Reference

## list_transactions

List Paddle transactions with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `"completed"`, `"pending"`, `"billed"`, `"paid"`, `"canceled"`, `"past_due"` |
| `customer_id` | string | no | Filter by customer ID |

### Examples

```lua
local result = app.integrations.paddle.list_transactions({
  limit = 10,
  status = "completed"
})

for _, txn in ipairs(result.data) do
  print(txn.id .. ": " .. txn.status .. " — " .. txn.details.totals.grand_total)
end
```

---

## get_transaction

Get details of a specific Paddle transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Transaction ID (e.g., `"txn_01abc123"`) |

### Examples

```lua
local result = app.integrations.paddle.get_transaction({
  id = "txn_01abc123"
})

print("Status: " .. result.data.status)
print("Amount: " .. result.data.details.totals.grand_total)
```

---

## list_customers

List Paddle customers with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `email` | string | no | Filter by email address |
| `name` | string | no | Filter by customer name |

### Examples

```lua
local result = app.integrations.paddle.list_customers({
  email = "john@example.com"
})

for _, customer in ipairs(result.data) do
  print(customer.id .. ": " .. customer.name .. " <" .. customer.email .. ">")
end
```

---

## get_customer

Get details of a specific Paddle customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Customer ID (e.g., `"ctm_01abc123"`) |

### Examples

```lua
local result = app.integrations.paddle.get_customer({
  id = "ctm_01abc123"
})

print("Name: " .. result.data.name)
print("Email: " .. result.data.email)
```

---

## create_customer

Create a new customer in Paddle.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `name` | string | no | Customer display name |

### Examples

```lua
local result = app.integrations.paddle.create_customer({
  email = "jane@example.com",
  name = "Jane Doe"
})

print("Created customer: " .. result.data.id)
```

---

## list_products

List Paddle products with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `"active"`, `"archived"` |

### Examples

```lua
local result = app.integrations.paddle.list_products({
  status = "active",
  limit = 20
})

for _, product in ipairs(result.data) do
  print(product.id .. ": " .. product.name)
end
```

---

## get_current_user

Verify Paddle API connectivity with a health check.

### Parameters

None.

### Examples

```lua
local result = app.integrations.paddle.get_current_user({})

if result.connected then
  print("Paddle API is reachable!")
else
  print("Connection failed: " .. result.error)
end
```

---

## Multi-Account Usage

If you have multiple Paddle accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.paddle.list_transactions({...})

-- Explicit default (portable across setups)
app.integrations.paddle.default.list_transactions({...})

-- Named accounts
app.integrations.paddle.sandbox.list_transactions({...})
app.integrations.paddle.production.list_transactions({...})
```

All functions are identical across accounts — only the credentials differ.
