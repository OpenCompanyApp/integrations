# Chargebee — Lua API Reference

## list_subscriptions

List subscriptions from Chargebee with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of subscriptions per page (max 100, default 10) |
| `page` | string | no | Pagination cursor from a previous response |
| `state` | string | no | Filter by state: `active`, `cancelled`, `non_renewing`, `paused`, `in_trial`, `future` |

### Example

```lua
local result = app.integrations.chargebee.list_subscriptions({
  state = "active",
  limit = 25
})

for _, sub in ipairs(result.subscriptions) do
  print(sub.id .. " — " .. sub.plan_id .. " — " .. sub.status)
end

-- Paginate with next_page
if result.next_page then
  local page2 = app.integrations.chargebee.list_subscriptions({
    state = "active",
    limit = 25,
    page = result.next_page
  })
end
```

---

## get_subscription

Retrieve details of a single subscription.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription ID |

### Example

```lua
local result = app.integrations.chargebee.get_subscription({
  id = "AzI6dGl0bGU9IkpvaG4gRG9lIgtleSI6IkRvZS"
})

local sub = result.subscription
print("Plan: " .. sub.plan_id)
print("Status: " .. sub.status)
print("Customer: " .. (result.customer and result.customer.email or "N/A"))
```

---

## list_customers

List customers with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of customers per page (max 100, default 10) |
| `page` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.chargebee.list_customers({
  limit = 50
})

for _, cust in ipairs(result.customers) do
  print(cust.id .. " — " .. (cust.email or "no email") .. " — " .. (cust.first_name or ""))
end
```

---

## get_customer

Retrieve details of a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The customer ID |

### Example

```lua
local result = app.integrations.chargebee.get_customer({
  id = "customer_xyz"
})

local cust = result.customer
print(cust.email .. " — " .. (cust.company or "no company"))
```

---

## list_invoices

List invoices with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of invoices per page (max 100, default 10) |
| `page` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `paid`, `posted`, `payment_due`, `not_paid`, `voided`, `pending` |

### Example

```lua
local result = app.integrations.chargebee.list_invoices({
  status = "paid",
  limit = 50
})

for _, inv in ipairs(result.invoices) do
  print(inv.id .. " — " .. inv.total .. " " .. inv.currency_code .. " — " .. inv.status)
end
```

---

## get_invoice

Retrieve details of a single invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The invoice ID |

### Example

```lua
local result = app.integrations.chargebee.get_invoice({
  id = "INV-123"
})

local inv = result.invoice
print("Total: " .. inv.total .. " " .. inv.currency_code)
print("Line items: " .. #inv.line_items)
```

---

## get_current_user

Retrieve the current authenticated user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.chargebee.get_current_user({})

print("User: " .. (result.user and result.user.email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Chargebee sites configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.chargebee.list_subscriptions({state = "active"})

-- Explicit default (portable across setups)
app.integrations.chargebee.default.list_subscriptions({state = "active"})

-- Named accounts
app.integrations.chargebee.production.list_subscriptions({state = "active"})
app.integrations.chargebee.staging.list_subscriptions({state = "active"})
```

All functions are identical across accounts — only the credentials differ.
