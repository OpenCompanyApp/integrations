# Mollie — Lua API Reference

## list_payments

List payments with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of payments to return (default: 50, max: 250) |
| `from` | string | no | Payment ID to start from (for pagination) |
| `profileId` | string | no | Filter by profile ID |

### Example

```lua
local result = app.integrations.mollie.list_payments({
  limit = 10
})

for _, payment in ipairs(result.payments) do
  print(payment.id .. ": " .. payment.description .. " - " .. payment.amount.value .. " " .. payment.amount.currency)
end
```

---

## get_payment

Retrieve a single payment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The payment ID (e.g., `"tr_abc123"`) |

### Example

```lua
local result = app.integrations.mollie.get_payment({
  id = "tr_abc123"
})

print("Status: " .. result.status)
print("Amount: " .. result.amount.value .. " " .. result.amount.currency)
```

---

## create_payment

Create a new payment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | object | yes | Amount object with `currency` (e.g., `"EUR"`) and `value` (e.g., `"10.00"`) |
| `description` | string | yes | Payment description shown to the customer |
| `redirectUrl` | string | yes | URL to redirect the customer to after payment |
| `metadata` | object | no | Custom metadata to store with the payment |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `locale` | string | no | Locale for the payment screen (e.g., `"nl_NL"`) |

### Example

```lua
local result = app.integrations.mollie.create_payment({
  amount = { currency = "EUR", value = "29.99" },
  description = "Order #12345",
  redirectUrl = "https://example.com/return"
})

print("Payment ID: " .. result.id)
print("Checkout URL: " .. result._links.checkout.href)
```

---

## list_customers

List all customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of customers to return (default: 50, max: 250) |
| `from` | string | no | Customer ID to start from (for pagination) |

### Example

```lua
local result = app.integrations.mollie.list_customers({
  limit = 10
})

for _, customer in ipairs(result.customers) do
  print(customer.id .. ": " .. customer.name .. " (" .. customer.email .. ")")
end
```

---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the customer |
| `email` | string | yes | Email address of the customer |
| `locale` | string | no | Preferred locale (e.g., `"nl_NL"`) |
| `metadata` | object | no | Custom metadata to store with the customer |

### Example

```lua
local result = app.integrations.mollie.create_customer({
  name = "Jane Smith",
  email = "jane@example.com"
})

print("Customer ID: " .. result.id)
```

---

## list_subscriptions

List all subscriptions for a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `limit` | integer | no | Number of subscriptions to return (default: 50, max: 250) |
| `from` | string | no | Subscription ID to start from (for pagination) |

### Example

```lua
local result = app.integrations.mollie.list_subscriptions({
  customer_id = "cst_abc123"
})

for _, sub in ipairs(result.subscriptions) do
  print(sub.id .. ": " .. sub.description .. " - " .. sub.amount.value .. " " .. sub.amount.currency .. " / " .. sub.interval)
end
```

---

## create_subscription

Create a subscription for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `amount` | object | yes | Amount object with `currency` and `value` |
| `interval` | string | yes | Interval (e.g., `"1 month"`, `"1 year"`) |
| `description` | string | yes | Description of the subscription |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `webhookUrl` | string | no | URL to receive webhook notifications |
| `metadata` | object | no | Custom metadata |
| `startDate` | string | no | Start date (ISO 8601, e.g., `"2026-05-01"`) |
| `times` | integer | no | Number of billing cycles (null = indefinite) |

### Example

```lua
local result = app.integrations.mollie.create_subscription({
  customer_id = "cst_abc123",
  amount = { currency = "EUR", value = "9.99" },
  interval = "1 month",
  description = "Pro plan monthly"
})

print("Subscription ID: " .. result.id)
print("Status: " .. result.status)
```

---

## list_invoices

List invoices for the authenticated account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of invoices to return (default: 50, max: 250) |
| `from` | string | no | Invoice ID to start from (for pagination) |
| `reference` | string | no | Filter by invoice reference |
| `year` | integer | no | Filter by year |
| `month` | integer | no | Filter by month |

### Example

```lua
local result = app.integrations.mollie.list_invoices({
  year = 2026
})

for _, invoice in ipairs(result.invoices) do
  print(invoice.id .. ": " .. invoice.reference .. " - " .. invoice.grossAmount.value .. " " .. invoice.grossAmount.currency)
end
```

---

## get_current_user

Retrieve the enabled payment methods for the authenticated account.

### Parameters

None.

### Example

```lua
local result = app.integrations.mollie.get_current_user({})

for _, method in ipairs(result.methods) do
  print(method.id .. ": " .. method.description)
end
```

---

## Multi-Account Usage

If you have multiple Mollie accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mollie.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mollie.default.function_name({...})

-- Named accounts
app.integrations.mollie.production.function_name({...})
app.integrations.mollie.test.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
