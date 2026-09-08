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

```ruby
# Example money object
example = {amount: 1500, currency: "USD"}
```
## Authentication

Square uses a Bearer access token. Obtain one from the **Square Developer Dashboard → Credentials**.

Sandbox tokens start with `EAAAEO...` (sandbox mode). Production tokens are used for live data.

## Payments

### List Payments

```ruby
app.integrations.square.list_payments(location_id: "LOCATION_ID", begin_time: "2024-01-01T00:00:00Z", end_time: "2024-12-31T23:59:59Z", limit: 20, cursor: nil)
```
### Get Payment

```ruby
app.integrations.square.get_payment(id: "PAYMENT_ID")
```
## Customers

### List Customers

```ruby
app.integrations.square.list_customers(limit: 20, cursor: nil, sort_field: "CREATED_AT", sort_order: "DESC")
```
### Get Customer

```ruby
app.integrations.square.get_customer(id: "CUSTOMER_ID")
```
## Orders

### List Orders

This tool maps to Square's `POST /v2/orders/search` endpoint.

```ruby
app.integrations.square.list_orders(location_id: "LOCATION_ID", limit: 20, cursor: nil, states: "OPEN,COMPLETED")
```
### Get Order

```ruby
app.integrations.square.get_order(id: "ORDER_ID")
```
## Current User

### Get Current User

```ruby
app.integrations.square.get_current_user()
```
## Pagination

Square uses cursor-based pagination. When a response includes a `cursor` field with a non-null value, pass it to the next request to retrieve the next page.

```ruby
# Paginate through all payments
all_payments = []
cursor = nil
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.square.list_payments(limit: 100, cursor: cursor)
  (result.payments || []).each do |payment|
    all_payments.push(payment)
  end
  cursor = result.cursor
  break unless (!((cursor == nil) || (cursor == "")))
end
```
## Common Workflows

### Find a customer by email, then list their payments

```ruby
# List customers and find by email
customers = app.integrations.square.list_customers(limit: 100)
target = nil
(customers.customers || []).each do |c|
  if (c.email_address == "jane@example.com")
    target = c
    break
  end
end
if target
  # List payments (filter client-side by customer_id)
  payments = app.integrations.square.list_payments(limit: 100)
  customer_payments = []
  (payments.payments || []).each do |p|
    if (p.customer_id == target.id)
      customer_payments.push(p)
    end
  end
end
```
### Verify connection and get merchant info

```ruby
merchant = app.integrations.square.get_current_user()
puts("Connected as: " + (merchant.business_name).to_s)
puts("Country: " + (merchant.country).to_s)
puts("Currency: " + (merchant.currency).to_s)
```
## Notes

- **Money amounts** are in the smallest currency unit (cents for USD). Divide by 100 to get the dollar amount.
- **Order IDs** use the format `ORDER_ID` at a specific location. Use `list_orders` with a `location_id` to find orders.
- **Location ID** is required for listing orders. You can find locations via the Square Dashboard or by using `get_current_user` to find the `main_location_id`.
- **Rate limits** — Square enforces rate limits per access token. If you hit limits, implement backoff.
- **Sandbox vs Production** — Use sandbox tokens for testing. All API calls behave identically but operate on test data.

## Multi-Account Usage

If multiple Square accounts are configured:

```ruby
# Use the default account
app.integrations.square.list_payments(limit: 10)
# Use a named account
app.integrations.square.list_payments(limit: 10, account: "store-2")
```