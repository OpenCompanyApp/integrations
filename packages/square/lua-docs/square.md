# Square Integration

## Overview

The Square integration provides 7 tools for managing payments, customers, orders, and merchant information via the Square API v2.

### Tools

| Tool | Type | Description |
|------|------|-------------|
| `square_list_payments` | read | List payments with optional filtering |
| `square_get_payment` | read | Retrieve a payment by ID |
| `square_list_customers` | read | List customers with optional sorting |
| `square_get_customer` | read | Retrieve a customer by ID |
| `square_list_orders` | read | List orders for a location |
| `square_get_order` | read | Retrieve an order by ID |
| `square_get_current_user` | read | Get the authenticated merchant |

### Money amounts

Square returns money amounts as integers in the smallest currency unit (e.g., cents for USD). Each money object contains `amount` (integer) and `currency` (ISO 4217 code).

```lua
-- Example money object
{ amount = 1500, currency = "USD" }  -- $15.00
```

## Authentication

Square uses a Bearer access token. Obtain one from the **Square Developer Dashboard → Credentials**.

Sandbox tokens start with `EAAAEO...` (sandbox mode). Production tokens are used for live data.

## Payments

### List Payments

```lua
app.integrations.square_list_payments({
  location_id = "LOCATION_ID",        -- optional: filter by location
  begin_time = "2024-01-01T00:00:00Z", -- optional: start of time range
  end_time = "2024-12-31T23:59:59Z",   -- optional: end of time range
  limit = 20,                          -- optional: 1–100, default 20
  cursor = nil,                        -- optional: pagination cursor
})
-- Returns:
-- {
--   payments = {
--     {
--       id = "...",
--       amount_money = { amount = 1500, currency = "USD" },
--       status = "COMPLETED",
--       source_type = "CARD",
--       created_at = "2024-01-15T10:30:00Z",
--       order_id = "...",
--       customer_id = "...",
--     },
--     ...
--   },
--   cursor = "next_page_cursor_or_nil",
-- }
```

### Get Payment

```lua
app.integrations.square_get_payment({
  id = "PAYMENT_ID",
})
-- Returns:
-- {
--   id = "...",
--   amount_money = { amount = 1500, currency = "USD" },
--   tip_money = { amount = 200, currency = "USD" },
--   total_money = { amount = 1700, currency = "USD" },
--   status = "COMPLETED",
--   source_type = "CARD",
--   card_details = { ... },
--   processing_fee = { { amount = 54, currency = "USD" } },
--   order_id = "...",
--   customer_id = "...",
--   created_at = "...",
--   updated_at = "...",
-- }
```

## Customers

### List Customers

```lua
app.integrations.square_list_customers({
  limit = 20,                 -- optional: 1–100, default 20
  cursor = nil,               -- optional: pagination cursor
  sort_field = "CREATED_AT",  -- optional: DEFAULT, CREATED_AT, FAMILY_NAME, GIVEN_NAME
  sort_order = "DESC",        -- optional: ASC, DESC
})
-- Returns:
-- {
--   customers = {
--     {
--       id = "...",
--       given_name = "Jane",
--       family_name = "Doe",
--       email_address = "jane@example.com",
--       phone_number = "+1234567890",
--       created_at = "...",
--     },
--     ...
--   },
--   cursor = "next_page_cursor_or_nil",
-- }
```

### Get Customer

```lua
app.integrations.square_get_customer({
  id = "CUSTOMER_ID",
})
-- Returns:
-- {
--   id = "...",
--   given_name = "Jane",
--   family_name = "Doe",
--   email_address = "jane@example.com",
--   phone_number = "+1234567890",
--   address = { ... },
--   company_name = "Acme Inc.",
--   note = "VIP customer",
--   cards = { ... },
--   created_at = "...",
--   updated_at = "...",
-- }
```

## Orders

### List Orders

```lua
app.integrations.square_list_orders({
  location_id = "LOCATION_ID",         -- required
  limit = 20,                          -- optional: 1–100, default 20
  cursor = nil,                        -- optional: pagination cursor
  states = "OPEN,COMPLETED",           -- optional: comma-separated states (OPEN, COMPLETED, CANCELED)
})
-- Returns:
-- {
--   orders = {
--     {
--       id = "...",
--       location_id = "...",
--       state = "COMPLETED",
--       total_money = { amount = 2500, currency = "USD" },
--       total_tax_money = { amount = 200, currency = "USD" },
--       total_discount_money = { amount = 0, currency = "USD" },
--       created_at = "...",
--       updated_at = "...",
--     },
--     ...
--   },
--   cursor = "next_page_cursor_or_nil",
-- }
```

### Get Order

```lua
app.integrations.square_get_order({
  id = "ORDER_ID",
})
-- Returns:
-- {
--   id = "...",
--   location_id = "...",
--   state = "COMPLETED",
--   line_items = { ... },
--   total_money = { amount = 2500, currency = "USD" },
--   total_tax_money = { amount = 200, currency = "USD" },
--   total_discount_money = { amount = 0, currency = "USD" },
--   total_service_charge_money = { ... },
--   tenders = { ... },
--   returns = { ... },
--   customer_id = "...",
--   created_at = "...",
--   updated_at = "...",
--   closed_at = "...",
-- }
```

## Current User

### Get Current User

```lua
app.integrations.square_get_current_user({})
-- Returns:
-- {
--   id = "...",
--   business_name = "My Store",
--   country = "US",
--   currency = "USD",
--   status = "ACTIVE",
--   main_location_id = "...",
--   created_at = "...",
-- }
```

## Pagination

Square uses cursor-based pagination. When a response includes a `cursor` field with a non-null value, pass it to the next request to retrieve the next page.

```lua
-- Paginate through all payments
local all_payments = {}
local cursor = nil

repeat
  local result = app.integrations.square_list_payments({
    limit = 100,
    cursor = cursor,
  })

  for _, payment in ipairs(result.payments or {}) do
    table.insert(all_payments, payment)
  end

  cursor = result.cursor
until cursor == nil or cursor == ""

-- all_payments now contains all pages
```

## Common Workflows

### Find a customer by email, then list their payments

```lua
-- List customers and find by email
local customers = app.integrations.square_list_customers({ limit = 100 })
local target = nil
for _, c in ipairs(customers.customers or {}) do
  if c.email_address == "jane@example.com" then
    target = c
    break
  end
end

if target then
  -- List payments (filter client-side by customer_id)
  local payments = app.integrations.square_list_payments({ limit = 100 })
  local customer_payments = {}
  for _, p in ipairs(payments.payments or {}) do
    if p.customer_id == target.id then
      table.insert(customer_payments, p)
    end
  end
end
```

### Verify connection and get merchant info

```lua
local merchant = app.integrations.square_get_current_user({})
print("Connected as: " .. merchant.business_name)
print("Country: " .. merchant.country)
print("Currency: " .. merchant.currency)
```

## Notes

- **Money amounts** are in the smallest currency unit (cents for USD). Divide by 100 to get the dollar amount.
- **Order IDs** use the format `ORDER_ID` at a specific location. Use `list_orders` with a `location_id` to find orders.
- **Location ID** is required for listing orders. You can find locations via the Square Dashboard or by using `get_current_user` to find the `main_location_id`.
- **Rate limits** — Square enforces rate limits per access token. If you hit limits, implement backoff.
- **Sandbox vs Production** — Use sandbox tokens for testing. All API calls behave identically but operate on test data.

## Multi-Account Usage

If multiple Square accounts are configured:

```lua
-- Use the default account
app.integrations.square_list_payments({ limit = 10 })

-- Use a named account
app.integrations.square_list_payments({ limit = 10, account = "store-2" })
```
