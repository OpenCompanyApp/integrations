# Square Integration

## Overview

The Square integration provides 10 tools for managing payments, customers, orders, locations, and merchant information via the Square API v2.

### Tools

| Tool | Type | Description |
|------|------|-------------|
| `square_list_payments` | read | List payments with optional filtering |
| `square_get_payment` | read | Retrieve a payment by ID |
| `square_create_payment` | write | Create a payment |
| `square_list_customers` | read | List customers with optional sorting |
| `square_get_customer` | read | Retrieve a customer by ID |
| `square_create_customer` | write | Create a customer |
| `square_list_orders` | read | List orders for a location |
| `square_get_order` | read | Retrieve an order by ID |
| `square_list_locations` | read | List business locations |
| `square_get_current_user` | read | Get the authenticated merchant |

### Money amounts

Square returns money amounts as integers in the smallest currency unit (e.g., cents for USD). Each money object contains `amount` (integer) and `currency` (ISO 4217 code).

```js
// Example money object
const example = { amount: 1500, currency: "USD" } // $15.00
```
## Authentication

Square uses a Bearer access token. Obtain one from the **Square Developer Dashboard → Credentials**.

Sandbox tokens start with `EAAAEO...` (sandbox mode). Production tokens are used for live data.

## Payments

### List Payments

```js
app.integrations.square_list_payments({
  location_id: "LOCATION_ID", // optional: filter by location,
  begin_time: "2024-01-01T00:00:00Z", // optional: start of time range,
  end_time: "2024-12-31T23:59:59Z", // optional: end of time range,
  limit: 20, // optional: 1–100, default 20,
  cursor: null, // optional: pagination cursor,
})
// Returns:
// {
//   payments = {
//     {
//       id = "...",
//       amount_money = { amount: 1500, currency: "USD" },
//       status = "COMPLETED",
//       source_type = "CARD",
//       created_at = "2024-01-15T10:30:00Z",
//       order_id = "...",
//       customer_id = "...",
//     },
//     ...
//   },
//   cursor = "next_page_cursor_or_nil",
// }
```
### Get Payment

```js
app.integrations.square_get_payment({
  id: "PAYMENT_ID",
})
// Returns:
// {
//   id = "...",
//   amount_money = { amount: 1500, currency: "USD" },
//   tip_money = { amount: 200, currency: "USD" },
//   total_money = { amount: 1700, currency: "USD" },
//   status = "COMPLETED",
//   source_type = "CARD",
//   card_details = { /* parameters */ },
//   processing_fee = { { amount: 54, currency: "USD" } },
//   order_id = "...",
//   customer_id = "...",
//   created_at = "...",
//   updated_at = "...",
// }
```
## Customers

### List Customers

```js
app.integrations.square_list_customers({
  limit: 20, // optional: 1–100, default 20,
  cursor: null, // optional: pagination cursor,
  sort_field: "CREATED_AT", // optional: DEFAULT, CREATED_AT, FAMILY_NAME, GIVEN_NAME,
  sort_order: "DESC", // optional: ASC, DESC,
})
// Returns:
// {
//   customers = {
//     {
//       id = "...",
//       given_name = "Jane",
//       family_name = "Doe",
//       email_address = "jane@example.com",
//       phone_number = "+1234567890",
//       created_at = "...",
//     },
//     ...
//   },
//   cursor = "next_page_cursor_or_nil",
// }
```
### Get Customer

```js
app.integrations.square_get_customer({
  id: "CUSTOMER_ID",
})
// Returns:
// {
//   id = "...",
//   given_name = "Jane",
//   family_name = "Doe",
//   email_address = "jane@example.com",
//   phone_number = "+1234567890",
//   address = { /* parameters */ },
//   company_name = "Acme Inc.",
//   note = "VIP customer",
//   cards = { /* parameters */ },
//   created_at = "...",
//   updated_at = "...",
// }
```
## Orders

### List Orders

This tool maps to Square's `POST /v2/orders/search` endpoint.

```js
app.integrations.square_list_orders({
  location_id: "LOCATION_ID", // required,
  limit: 20, // optional: 1–100, default 20,
  cursor: null, // optional: pagination cursor,
  states: "OPEN,COMPLETED", // optional: comma-separated states (OPEN, COMPLETED, CANCELED),
})
// Returns:
// {
//   orders = {
//     {
//       id = "...",
//       location_id = "...",
//       state = "COMPLETED",
//       total_money = { amount: 2500, currency: "USD" },
//       total_tax_money = { amount: 200, currency: "USD" },
//       total_discount_money = { amount: 0, currency: "USD" },
//       created_at = "...",
//       updated_at = "...",
//     },
//     ...
//   },
//   cursor = "next_page_cursor_or_nil",
// }
```
### Get Order

```js
app.integrations.square_get_order({
  id: "ORDER_ID",
})
// Returns:
// {
//   id = "...",
//   location_id = "...",
//   state = "COMPLETED",
//   line_items = { /* parameters */ },
//   total_money = { amount: 2500, currency: "USD" },
//   total_tax_money = { amount: 200, currency: "USD" },
//   total_discount_money = { amount: 0, currency: "USD" },
//   total_service_charge_money = { /* parameters */ },
//   tenders = { /* parameters */ },
//   returns = { /* parameters */ },
//   customer_id = "...",
//   created_at = "...",
//   updated_at = "...",
//   closed_at = "...",
// }
```
## Current User

### Get Current User

```js
app.integrations.square_get_current_user({})
// Returns:
// {
//   id = "...",
//   business_name = "My Store",
//   country = "US",
//   currency = "USD",
//   status = "ACTIVE",
//   main_location_id = "...",
//   created_at = "...",
// }
```
## Pagination

Square uses cursor-based pagination. When a response includes a `cursor` field with a non-null value, pass it to the next request to retrieve the next page.

```js
// Paginate through all payments
var all_payments = []
var cursor = null

do {
  var result = app.integrations.square_list_payments({
    limit: 100,
    cursor: cursor,
  })

  for (const payment of (result.payments || [])) {
    all_payments.push(payment)
  }

  cursor = result.cursor
} while (!(cursor === null || cursor === ""));

// all_payments now contains all pages
```
## Common Workflows

### Find a customer by email, then list their payments

```js
// List customers and find by email
var customers = app.integrations.square_list_customers({ limit: 100 })
var target = null
for (const c of (customers.customers || [])) {
  if (c.email_address === "jane@example.com") {
    target = c
    break
  }
}

if (target) {
  // List payments (filter client-side by customer_id)
  var payments = app.integrations.square_list_payments({ limit: 100 })
  var customer_payments = []
  for (const p of (payments.payments || [])) {
    if (p.customer_id === target.id) {
      customer_payments.push(p)
    }
  }
}
```
### Verify connection and get merchant info

```js
var merchant = app.integrations.square_get_current_user({})
console.log("Connected as: " + merchant.business_name)
console.log("Country: " + merchant.country)
console.log("Currency: " + merchant.currency)
```
## Notes

- **Money amounts** are in the smallest currency unit (cents for USD). Divide by 100 to get the dollar amount.
- **Order IDs** use the format `ORDER_ID` at a specific location. Use `list_orders` with a `location_id` to find orders.
- **Location ID** is required for listing orders. You can find locations via the Square Dashboard or by using `get_current_user` to find the `main_location_id`.
- **Rate limits** — Square enforces rate limits per access token. If you hit limits, implement backoff.
- **Sandbox vs Production** — Use sandbox tokens for testing. All API calls behave identically but operate on test data.

## Multi-Account Usage

If multiple Square accounts are configured:

```js
// Use the default account
app.integrations.square_list_payments({ limit: 10 })

// Use a named account
app.integrations.square_list_payments({ limit: 10, account: "store-2" })
```