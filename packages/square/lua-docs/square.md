# Square — Lua API Reference

## list_payments

List payments from Square. Supports filtering by date range, location, and status with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of payments to return per page (default: 100, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response to fetch the next page |
| `begin_time` | string | no | Start of the date range filter (RFC 3339 timestamp, e.g. `"2024-01-01T00:00:00Z"`) |
| `end_time` | string | no | End of the date range filter (RFC 3339 timestamp, e.g. `"2024-12-31T23:59:59Z"`) |
| `location_id` | string | no | Filter results to payments at a specific Square location |
| `status` | string | no | Filter by payment status: `COMPLETED`, `FAILED`, `PENDING`, or `CANCELED` |

### Examples

#### List recent payments

```lua
local result = app.integrations.square.list_payments({
  limit = 25
})

for _, payment in ipairs(result.payments) do
  print(payment.id .. ": " .. payment.amount_money.amount .. " " .. payment.amount_money.currency)
end
```

#### Filter by date range and status

```lua
local result = app.integrations.square.list_payments({
  begin_time = "2024-01-01T00:00:00Z",
  end_time = "2024-06-30T23:59:59Z",
  status = "COMPLETED"
})
```

#### Paginate through results

```lua
local result = app.integrations.square.list_payments({
  limit = 100
})

if result.cursor then
  local next = app.integrations.square.list_payments({
    cursor = result.cursor
  })
end
```

---

## get_payment

Get details of a specific Square payment by its ID, including amount, status, and card info.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Square payment ID to retrieve |

### Examples

#### Retrieve a payment

```lua
local result = app.integrations.square.get_payment({
  id = "abc123-def456"
})

print("Amount: " .. result.payment.amount_money.amount)
print("Status: " .. result.payment.status)
```

---

## create_payment

Create a new payment in Square. Requires a payment source ID (e.g., a card nonce or card-on-file ID), an idempotency key, and the amount with currency.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `source_id` | string | yes | The ID of the payment source (card nonce, card-on-file ID, or payment token) |
| `idempotency_key` | string | yes | A unique string to ensure idempotent processing (e.g., a UUID) |
| `amount` | integer | yes | The payment amount in the smallest currency unit (e.g., cents). For $10.00, use `1000` |
| `currency` | string | yes | The currency code (e.g., `"USD"`, `"EUR"`, `"GBP"`) |
| `reference_id` | string | no | An optional reference ID for the payment (e.g., an order or invoice number) |
| `note` | string | no | An optional note attached to the payment |
| `customer_id` | string | no | The Square customer ID to associate with this payment |
| `location_id` | string | no | The Square location ID where the payment is processed |

### Examples

#### Create a payment

```lua
local result = app.integrations.square.create_payment({
  source_id = "cnon:card-nonce-ok",
  idempotency_key = "unique-key-12345",
  amount = 1000,
  currency = "USD",
  note = "Order #1234"
})

print("Payment ID: " .. result.payment.id)
print("Status: " .. result.payment.status)
```

#### Payment with customer and location

```lua
local result = app.integrations.square.create_payment({
  source_id = "cnon:card-nonce-ok",
  idempotency_key = "unique-key-67890",
  amount = 5000,
  currency = "USD",
  customer_id = "W92WH6P11H4Z77CTET2R",
  location_id = "LN1050ENJKD0P",
  reference_id = "INV-001"
})
```

---

## list_customers

List customer profiles from Square. Supports cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of customers to return per page (default: 100, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response to fetch the next page |

### Examples

#### List customers

```lua
local result = app.integrations.square.list_customers({
  limit = 50
})

for _, customer in ipairs(result.customers) do
  print(customer.given_name .. " " .. customer.family_name .. " <" .. (customer.email_address or "N/A") .. ">")
end
```

---

## create_customer

Create a new customer profile in Square with name, email, and phone details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `given_name` | string | no | The customer's first name |
| `family_name` | string | no | The customer's last name |
| `email_address` | string | no | The customer's email address |
| `phone_number` | string | no | The customer's phone number (E.164 format, e.g., `"+15551234567"`) |

At least one field is required.

### Examples

#### Create a customer

```lua
local result = app.integrations.square.create_customer({
  given_name = "Jane",
  family_name = "Doe",
  email_address = "jane@example.com",
  phone_number = "+15551234567"
})

print("Customer ID: " .. result.customer.id)
```

---

## list_locations

List all business locations configured in Square, including name, address, and status.

### Parameters

This tool takes no parameters.

### Examples

#### List all locations

```lua
local result = app.integrations.square.list_locations({})

for _, location in ipairs(result.locations) do
  print(location.name .. " (" .. location.id .. ") - " .. location.status)
end
```

---

## get_current_user

Health check for the Square integration. Returns the first location name and count to verify connectivity.

### Parameters

This tool takes no parameters.

### Examples

#### Verify connectivity

```lua
local result = app.integrations.square.get_current_user({})

print("Connected: " .. result.location_name)
print("Total locations: " .. result.location_count)
```

---

## Multi-Account Usage

If you have multiple square accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.square.list_payments({...})

-- Explicit default (portable across setups)
app.integrations.square.default.list_payments({...})

-- Named accounts
app.integrations.square.production.list_payments({...})
app.integrations.square.sandbox.list_payments({...})
```

All functions are identical across accounts — only the credentials differ.
