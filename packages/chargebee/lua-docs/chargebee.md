# Chargebee — Lua API Reference

## list_subscriptions

List subscriptions from Chargebee with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of subscriptions per page (max 100, default 10) |
| `offset` | string | no | Pagination offset from a previous response |
| `status` | string | no | Filter by status: `active`, `cancelled`, `non_renewing`, `paused`, `in_trial`, `future` |
| `plan_id` | string | no | Filter by plan ID |

### Example

```lua
local result = app.integrations.chargebee.list_subscriptions({
  status = "active",
  limit = 25
})

for _, sub in ipairs(result.subscriptions) do
  print(sub.id .. " — " .. sub.plan_id .. " — " .. sub.status)
end

-- Paginate with next_offset
if result.next_offset then
  local page2 = app.integrations.chargebee.list_subscriptions({
    status = "active",
    limit = 25,
    offset = result.next_offset
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

## create_subscription

Create a new subscription for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `plan_id` | string | yes | The plan ID to subscribe to |
| `customer_id` | string | no | Existing customer ID |
| `customer_email` | string | no | Email for a new customer (if no customer_id) |
| `customer_first_name` | string | no | First name for new customer |
| `customer_last_name` | string | no | Last name for new customer |
| `plan_quantity` | integer | no | Quantity (default: 1) |
| `trial_end` | string | no | Trial end (Unix timestamp or "now") |
| `coupon` | string | no | Coupon ID to apply |
| `addons` | array | no | Array of `{id, quantity}` addon objects |

### Example

```lua
-- Subscribe an existing customer
local result = app.integrations.chargebee.create_subscription({
  customer_id = "customer_xyz",
  plan_id = "pro-monthly"
})

-- Subscribe with a new customer and an addon
local result = app.integrations.chargebee.create_subscription({
  customer_email = "alice@example.com",
  customer_first_name = "Alice",
  customer_last_name = "Smith",
  plan_id = "business-annual",
  plan_quantity = 5,
  addons = {
    { id = "support-addon", quantity = 5 }
  }
})
```

---

## update_subscription

Update an existing subscription (change plan, addons, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription ID |
| `plan_id` | string | no | New plan ID |
| `plan_quantity` | integer | no | New plan quantity |
| `addons` | array | no | Array of `{id, quantity}` addon objects (replaces existing) |
| `prorate` | boolean | no | Prorate charges (default: true) |
| `end_of_term` | boolean | no | Apply change at end of billing term |
| `coupon` | string | no | Coupon ID to apply |

### Example

```lua
local result = app.integrations.chargebee.update_subscription({
  id = "sub_abc123",
  plan_id = "enterprise-monthly",
  prorate = true
})
```

---

## cancel_subscription

Cancel an active subscription.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription ID |
| `end_of_term` | boolean | no | Cancel at end of billing term (default: false) |
| `cancellation_reason` | string | no | Reason for cancellation |

### Example

```lua
local result = app.integrations.chargebee.cancel_subscription({
  id = "sub_abc123",
  end_of_term = true,
  cancellation_reason = "customer_request"
})
```

---

## list_customers

List customers with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of customers per page (max 100, default 10) |
| `offset` | string | no | Pagination offset from a previous response |

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

## create_customer

Create a new customer record.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `company` | string | no | Company name |
| `phone` | string | no | Phone number |
| `locale` | string | no | Locale (e.g., "en-US") |
| `billing_address_line1` | string | no | Address line 1 |
| `billing_address_line2` | string | no | Address line 2 |
| `billing_address_city` | string | no | City |
| `billing_address_state` | string | no | State/province |
| `billing_address_zip` | string | no | Zip/postal code |
| `billing_address_country` | string | no | Country code (ISO 3166-1 alpha-2) |

### Example

```lua
local result = app.integrations.chargebee.create_customer({
  email = "bob@acme.com",
  first_name = "Bob",
  last_name = "Johnson",
  company = "Acme Corp",
  billing_address_country = "US",
  billing_address_city = "San Francisco"
})

print("Created customer: " .. result.customer.id)
```

---

## list_invoices

List invoices with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of invoices per page (max 100, default 10) |
| `offset` | string | no | Pagination offset from a previous response |
| `status` | string | no | Filter by status: `paid`, `posted`, `payment_due`, `not_paid`, `voided`, `pending` |
| `date_after` | string | no | Invoices on or after this date (YYYY-MM-DD) |
| `date_before` | string | no | Invoices on or before this date (YYYY-MM-DD) |

### Example

```lua
local result = app.integrations.chargebee.list_invoices({
  status = "paid",
  date_after = "2026-01-01",
  date_before = "2026-03-31",
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

## list_plans

List available billing plans.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of plans per page (max 100, default 10) |

### Example

```lua
local result = app.integrations.chargebee.list_plans({
  limit = 50
})

for _, plan in ipairs(result.plans) do
  print(plan.id .. " — " .. plan.name .. " — " .. (plan.price / 100) .. " " .. plan.currency_code)
end
```

---

## get_current_user

Verify site access and retrieve site configuration details.

### Parameters

None.

### Example

```lua
local result = app.integrations.chargebee.get_current_user({})

local site = result.site
print("Site: " .. site.name)
print("Domain: " .. (site.domain or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Chargebee sites configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.chargebee.list_subscriptions({status = "active"})

-- Explicit default (portable across setups)
app.integrations.chargebee.default.list_subscriptions({status = "active"})

-- Named accounts
app.integrations.chargebee.production.list_subscriptions({status = "active"})
app.integrations.chargebee.staging.list_subscriptions({status = "active"})
```

All functions are identical across accounts — only the credentials differ.
