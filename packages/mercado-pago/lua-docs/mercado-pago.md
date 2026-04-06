# Mercado Pago — Lua API Reference

## list_payments

Search and list payments from Mercado Pago with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 30, max: 1000) |
| `offset` | integer | no | Number of results to skip (default: 0) |
| `external_reference` | string | no | Filter by your custom external reference |
| `status` | string | no | Payment status filter (see values below) |
| `date_created_from` | string | no | Created after (ISO 8601, e.g., `"2025-01-01T00:00:00.000-00:00"`) |
| `date_created_to` | string | no | Created before (ISO 8601, e.g., `"2025-12-31T23:59:59.999-00:00"`) |

### Payment Status Values

`pending`, `approved`, `authorized`, `in_process`, `in_mediation`, `rejected`, `cancelled`, `refunded`, `charged_back`

### Example

```lua
local result = app.integrations["mercado-pago"].list_payments({
  status = "approved",
  limit = 10
})

for _, payment in ipairs(result.results) do
  print(payment.id .. ": " .. payment.transaction_amount .. " " .. payment.currency_id)
end
```

---

## get_payment

Retrieve full details of a specific payment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Mercado Pago payment ID |

### Example

```lua
local result = app.integrations["mercado-pago"].get_payment({
  id = "1234567890"
})

print("Status: " .. result.status)
print("Amount: " .. result.transaction_amount)
print("Payer: " .. result.payer.email)
```

---

## create_payment

Create a new payment in Mercado Pago.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `transaction_amount` | number | yes | Amount to charge (e.g., `100.50`) |
| `payment_method_id` | string | yes | Payment method (e.g., `"visa"`, `"master"`, `"pix"`, `"boleto"`) |
| `payer_email` | string | yes | Payer's email address |
| `installments` | integer | no | Number of installments (default: 1) |

### Common Payment Method IDs

| ID | Description |
|----|-------------|
| `visa` | Visa credit/debit |
| `master` | Mastercard |
| `amex` | American Express |
| `pix` | Pix (Brazil instant payment) |
| `boleto` | Boleto (Brazilian payment slip) |

### Example

```lua
local result = app.integrations["mercado-pago"].create_payment({
  transaction_amount = 150.00,
  payment_method_id = "visa",
  payer_email = "customer@example.com",
  installments = 3
})

print("Payment ID: " .. result.id)
print("Status: " .. result.status)
```

---

## list_customers

Search and list customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | no | Filter by customer email |
| `limit` | integer | no | Max results (default: 30) |
| `offset` | integer | no | Number of results to skip (default: 0) |

### Example

```lua
local result = app.integrations["mercado-pago"].list_customers({
  email = "customer@example.com"
})

for _, customer in ipairs(result.results) do
  print(customer.id .. ": " .. customer.email)
end
```

---

## get_customer

Retrieve details of a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Mercado Pago customer ID |

### Example

```lua
local result = app.integrations["mercado-pago"].get_customer({
  id = "123456789-abcdefghijkl"
})

print("Name: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## list_preferences

List checkout preferences.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 30) |
| `offset` | integer | no | Number of results to skip (default: 0) |
| `sponsor_id` | string | no | Filter by sponsor user ID |

### Example

```lua
local result = app.integrations["mercado-pago"].list_preferences({
  limit = 10
})

for _, pref in ipairs(result.elements) do
  print(pref.id .. ": " .. pref.items[1].title)
end
```

---

## get_current_user

Get the authenticated user's account information. No parameters required.

### Example

```lua
local result = app.integrations["mercado-pago"].get_current_user({})

print("User: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
print("ID: " .. result.id)
```

---

## Multi-Account Usage

If you have multiple Mercado Pago accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["mercado-pago"].list_payments({...})

-- Explicit default (portable across setups)
app.integrations["mercado-pago"].default.list_payments({...})

-- Named accounts
app.integrations["mercado-pago"].brazil.list_payments({...})
app.integrations["mercado-pago"].argentina.list_payments({...})
```

All functions are identical across accounts — only the credentials differ.
