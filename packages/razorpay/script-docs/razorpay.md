# Razorpay — Ruby API Reference

## list_payments

List payments from Razorpay. Supports pagination and date-range filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of payments to return (default: 10, max: 100) |
| `skip` | integer | no | Number of payments to skip for pagination |
| `from` | integer | no | Unix timestamp for the start of the date range |
| `to` | integer | no | Unix timestamp for the end of the date range |

### Examples

```ruby
# List recent payments
result = app.integrations.razorpay.list_payments(count: 10)
result.items.each do |payment|
  puts((payment.id).to_s + ": " + (payment.amount).to_s + " " + (payment.currency).to_s + " (" + (payment.status).to_s + ")")
end
```
```ruby
# List payments from a specific date range
result = app.integrations.razorpay.list_payments(count: 20, from: 1704067200, to: 1706745600)
```
---

## get_payment

Get details of a specific Razorpay payment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `payment_id` | string | yes | The Razorpay payment ID (e.g., "pay_1234567890") |

### Examples

```ruby
result = app.integrations.razorpay.get_payment(payment_id: "pay_1234567890")
puts("Amount: " + (result.amount).to_s + " " + (result.currency).to_s)
puts("Status: " + (result.status).to_s)
puts("Method: " + (result.method).to_s)
```
---

## list_orders

List orders from Razorpay. Supports pagination and date-range filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of orders to return (default: 10, max: 100) |
| `skip` | integer | no | Number of orders to skip for pagination |
| `from` | integer | no | Unix timestamp for the start of the date range |
| `to` | integer | no | Unix timestamp for the end of the date range |

### Examples

```ruby
result = app.integrations.razorpay.list_orders(count: 20, skip: 0)
result.items.each do |order|
  puts((order.id).to_s + ": " + (order.amount).to_s + " " + (order.currency).to_s + " (" + (order.status).to_s + ")")
end
```
---

## get_order

Get details of a specific Razorpay order by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The Razorpay order ID (e.g., "order_1234567890") |

### Examples

```ruby
result = app.integrations.razorpay.get_order(order_id: "order_1234567890")
puts("Amount: " + (result.amount).to_s + " " + (result.currency).to_s)
puts("Status: " + (result.status).to_s)
puts("Receipt: " + ((result.receipt || "N/A")).to_s)
```
---

## create_order

Create a new payment order in Razorpay.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | integer | yes | Amount in smallest currency unit (e.g., 10000 for ₹100.00 in INR) |
| `currency` | string | no | Three-letter currency code (default: "INR") |
| `receipt` | string | no | Your internal receipt identifier (max 40 characters) |
| `notes` | object | no | Key-value notes to attach to the order |

### Examples

```ruby
# Create an order for ₹500.00
result = app.integrations.razorpay.create_order(amount: 50000, currency: "INR", receipt: "rcpt_001", notes: {customer_name: "John Doe", purpose: "Subscription"})
puts("Order ID: " + (result.id).to_s)
puts("Status: " + (result.status).to_s)
```
```ruby
# Create a simple order
result = app.integrations.razorpay.create_order(amount: 100000)
```
---

## list_refunds

List refunds from Razorpay. Supports pagination and date-range filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of refunds to return (default: 10, max: 100) |
| `skip` | integer | no | Number of refunds to skip for pagination |
| `from` | integer | no | Unix timestamp for the start of the date range |
| `to` | integer | no | Unix timestamp for the end of the date range |

### Examples

```ruby
result = app.integrations.razorpay.list_refunds(count: 20)
result.items.each do |refund|
  puts((refund.id).to_s + ": " + (refund.amount).to_s + " (" + (refund.status).to_s + ")")
end
```
---

## list_customers

List customers from Razorpay. Supports pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of customers to return (default: 10, max: 100) |
| `skip` | integer | no | Number of customers to skip for pagination |

### Examples

```ruby
result = app.integrations.razorpay.list_customers(count: 20)
result.items.each do |customer|
  puts((customer.id).to_s + ": " + ((customer.name || "N/A")).to_s + " <" + ((customer.email || "N/A")).to_s + ">")
end
```
---

## get_current_user

Verify the Razorpay API connection with a lightweight payments request. Razorpay does not expose a general current-user endpoint in the payments API, so this returns the same collection shape as `list_payments` with `count = 1`.

### Parameters

None.

### Examples

```ruby
result = app.integrations.razorpay.connection_check()
puts("Connected; sample count: " + ((result.count).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple Razorpay accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.razorpay.list_payments(count: 10)
# Explicit default (portable across setups)
app.integrations.razorpay.default.list_payments(count: 10)
# Named accounts
app.integrations.razorpay.production.list_payments(count: 10)
app.integrations.razorpay.staging.list_payments(count: 10)
```
All functions are identical across accounts — only the credentials differ.
