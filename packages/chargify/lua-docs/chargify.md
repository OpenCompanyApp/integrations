# Chargify — Lua API Reference

## list_subscriptions

List subscriptions from Chargify with optional state filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 20) |
| `state` | string | no | Filter by state: active, past_due, canceled, expired, trial, on_hold, pending, deferred |

### Example

```lua
local result = app.integrations.chargify.list_subscriptions({
  page = 1,
  per_page = 20,
  state = "active"
})

for _, sub in ipairs(result) do
  print(sub.subscription.id .. ": " .. sub.subscription.state)
end
```

---

## get_subscription

Get details for a single subscription.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Chargify subscription ID |

### Example

```lua
local result = app.integrations.chargify.get_subscription({
  subscription_id = 12345
})

local sub = result.subscription
print("State: " .. sub.state)
print("Customer: " .. sub.customer.first_name .. " " .. sub.customer.last_name)
```

---

## list_customers

List customers with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 20) |

### Example

```lua
local result = app.integrations.chargify.list_customers({
  page = 1,
  per_page = 50
})

for _, c in ipairs(result) do
  print(c.customer.id .. ": " .. c.customer.first_name .. " " .. c.customer.last_name .. " (" .. c.customer.email .. ")")
end
```

---

## get_customer

Get details for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | integer | yes | The Chargify customer ID |

### Example

```lua
local result = app.integrations.chargify.get_customer({
  customer_id = 67890
})

local c = result.customer
print("Name: " .. c.first_name .. " " .. c.last_name)
print("Email: " .. c.email)
print("Reference: " .. (c.reference or "none"))
```

---

## list_products

List available products.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 20) |

### Example

```lua
local result = app.integrations.chargify.list_products({
  page = 1,
  per_page = 50
})

for _, p in ipairs(result) do
  print(p.product.name .. " — $" .. p.product.price_in_cents / 100 .. "/" .. p.product.interval_unit)
end
```

---

## list_invoices

List invoices with optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 20) |
| `status` | string | no | Filter by status: open, paid, pending, voided |

### Example

```lua
local result = app.integrations.chargify.list_invoices({
  page = 1,
  per_page = 20,
  status = "open"
})

for _, inv in ipairs(result) do
  print(inv.invoice.uid .. ": $" .. inv.invoice.total_amount .. " — " .. inv.invoice.status)
end
```

---

## get_current_user

Get the currently authenticated Chargify user.

### Parameters

None.

### Example

```lua
local result = app.integrations.chargify.get_current_user({})
print("Logged in as: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple Chargify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.chargify.function_name({...})

-- Explicit default (portable across setups)
app.integrations.chargify.default.function_name({...})

-- Named accounts
app.integrations.chargify.production.function_name({...})
app.integrations.chargify.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
