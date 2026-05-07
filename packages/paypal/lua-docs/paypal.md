# PayPal — Lua API Reference

## get_order

Get details of a specific PayPal checkout order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The PayPal order ID |

### Example

```lua
local result = app.integrations.paypal.get_order({
  order_id = "5O190127TN364715T"
})

print("Status: " .. result.status)
print("Intent: " .. result.intent)

for _, unit in ipairs(result.purchase_units or {}) do
  print("Amount: " .. unit.amount.value .. " " .. unit.amount.currency_code)
end
```

---

## create_order

Create a new PayPal checkout order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `intent` | string | yes | `CAPTURE` or `AUTHORIZE` |
| `purchase_units` | array | yes | Array of purchase units with amount objects |
| `payer` | array | no | Payer information (name, email, address) |
| `payment_source` | array | no | Payment source configuration (paypal, card) |

### Purchase Unit Structure

Each purchase unit must include an `amount` object:

```lua
{
  amount = {
    currency_code = "USD",
    value = "10.00"
  },
  description = "Order description"
}
```

### Examples

```lua
-- Create a simple capture order
local result = app.integrations.paypal.create_order({
  intent = "CAPTURE",
  purchase_units = {
    {
      amount = {
        currency_code = "USD",
        value = "29.99"
      },
      description = "Premium subscription"
    }
  }
})

print("Order ID: " .. result.id)
print("Status: " .. result.status)

-- Get the approval URL
for _, link in ipairs(result.links or {}) do
  if link.rel == "approve" then
    print("Approval URL: " .. link.href)
  end
end
```

```lua
-- Create an order with payer details
local result = app.integrations.paypal.create_order({
  intent = "CAPTURE",
  purchase_units = {
    {
      amount = {
        currency_code = "EUR",
        value = "49.99",
        breakdown = {
          item_total = { currency_code = "EUR", value = "49.99" }
        }
      },
      items = {
        {
          name = "Service Plan",
          unit_amount = { currency_code = "EUR", value = "49.99" },
          quantity = "1"
        }
      }
    }
  },
  payer = {
    name = { given_name = "John", surname = "Doe" },
    email_address = "john@example.com"
  }
})
```

---

## capture_order

Capture a previously approved PayPal checkout order.

PayPal Orders v2 supports creating, retrieving, and capturing orders by ID. It does not provide a general list-orders endpoint, so agents should store the order ID returned by `create_order` or retrieve it from the host application's own payment records.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The approved PayPal order ID |
| `payment_source` | array | no | Optional payment source data for the capture request |

### Example

```lua
local result = app.integrations.paypal.capture_order({
  order_id = "5O190127TN364715T"
})

print("Capture status: " .. result.status)
```

---

## list_payments

List PayPal payments with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of payments to return (default: 10, max: 20) |
| `start_id` | string | no | Payment ID to start from (for pagination) |
| `start_time` | string | no | Start time filter (ISO 8601) |
| `end_time` | string | no | End time filter (ISO 8601) |
| `sort_by` | string | no | Sort field: `create_time` or `update_time` |
| `sort_order` | string | no | Sort direction: `asc` or `desc` |

### Example

```lua
local result = app.integrations.paypal.list_payments({
  count = 10,
  sort_by = "create_time",
  sort_order = "desc"
})

for _, payment in ipairs(result.payments or {}) do
  print(payment.id .. " — " .. payment.state .. " — " .. payment.transactions[1].amount.total)
end
```

---

## get_payment

Get details of a specific PayPal payment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `payment_id` | string | yes | The PayPal payment ID |

### Example

```lua
local result = app.integrations.paypal.get_payment({
  payment_id = "PAY-1AB23456CD789012EFGHIJKL"
})

print("State: " .. result.state)
print("Intent: " .. result.intent)

for _, tx in ipairs(result.transactions or {}) do
  print("Amount: " .. tx.amount.total .. " " .. tx.amount.currency)
  print("Description: " .. (tx.description or "N/A"))
end
```

---

## list_invoices

List PayPal invoices.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `page_size` | integer | no | Invoices per page (default: 20, max: 100) |
| `total_required` | boolean | no | Include total count in response (default: false) |
| `fields` | string | no | Comma-separated fields to return |

### Example

```lua
local result = app.integrations.paypal.list_invoices({
  page = 1,
  page_size = 20,
  total_required = true
})

if result.total_items then
  print("Total invoices: " .. result.total_items)
end

for _, inv in ipairs(result.items or {}) do
  print(inv.id .. " — " .. (inv.status or "UNKNOWN") .. " — " .. (inv.invoice_number or ""))
end
```

---

## get_current_user

Get the authenticated PayPal user's profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `schema` | string | no | Schema to return: `paypalv1.1` or `openid` |

### Example

```lua
local result = app.integrations.paypal.get_current_user({})

print("Name: " .. (result.name or "N/A"))
print("Email: " .. (result.email or "N/A"))
print("User ID: " .. (result.user_id or "N/A"))
```

---

## Multi-Account Usage

If you have multiple PayPal accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.paypal.get_current_user({})

-- Explicit default (portable across setups)
app.integrations.paypal.default.get_current_user({})

-- Named accounts
app.integrations.paypal.business.get_current_user({})
app.integrations.paypal.personal.get_current_user({})
```

All functions are identical across accounts — only the credentials differ.
