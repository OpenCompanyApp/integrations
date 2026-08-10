# Razorpay — JavaScript API Reference

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

```js
// List recent payments
var result = app.integrations.razorpay.list_payments({
  count: 10,
})

for (const payment of (result.items)) {
  console.log(payment.id + ": " + payment.amount + " " + payment.currency + " (" + payment.status + ")")
}
```
```js
// List payments from a specific date range
var result = app.integrations.razorpay.list_payments({
  count: 20,
  from: 1704067200, // 2024-01-01,
  to: 1706745600 // 2024-02-01,
})
```
---

## get_payment

Get details of a specific Razorpay payment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `payment_id` | string | yes | The Razorpay payment ID (e.g., "pay_1234567890") |

### Examples

```js
var result = app.integrations.razorpay.get_payment({
  payment_id: "pay_1234567890",
})

console.log("Amount: " + result.amount + " " + result.currency)
console.log("Status: " + result.status)
console.log("Method: " + result.method)
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

```js
var result = app.integrations.razorpay.list_orders({
  count: 20,
  skip: 0,
})

for (const order of (result.items)) {
  console.log(order.id + ": " + order.amount + " " + order.currency + " (" + order.status + ")")
}
```
---

## get_order

Get details of a specific Razorpay order by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The Razorpay order ID (e.g., "order_1234567890") |

### Examples

```js
var result = app.integrations.razorpay.get_order({
  order_id: "order_1234567890",
})

console.log("Amount: " + result.amount + " " + result.currency)
console.log("Status: " + result.status)
console.log("Receipt: " + (result.receipt || "N/A"))
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

```js
// Create an order for ₹500.00
var result = app.integrations.razorpay.create_order({
  amount: 50000,
  currency: "INR",
  receipt: "rcpt_001",
  notes: {
    customer_name: "John Doe",
    purpose: "Subscription",
  }
})

console.log("Order ID: " + result.id)
console.log("Status: " + result.status)
```
```js
// Create a simple order
var result = app.integrations.razorpay.create_order({
  amount: 100000 // ₹1000.00,
})
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

```js
var result = app.integrations.razorpay.list_refunds({
  count: 20,
})

for (const refund of (result.items)) {
  console.log(refund.id + ": " + refund.amount + " (" + refund.status + ")")
}
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

```js
var result = app.integrations.razorpay.list_customers({
  count: 20,
})

for (const customer of (result.items)) {
  console.log(customer.id + ": " + (customer.name || "N/A") + " <" + (customer.email || "N/A") + ">")
}
```
---

## get_current_user

Verify the Razorpay API connection with a lightweight payments request. Razorpay does not expose a general current-user endpoint in the payments API, so this returns the same collection shape as `list_payments` with `count = 1`.

### Parameters

None.

### Examples

```js
var result = app.integrations.razorpay.get_current_user({})

console.log("Connected; sample count: " + String(result.count))
```
---

## Multi-Account Usage

If you have multiple Razorpay accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.razorpay.list_payments({count: 10})

// Explicit default (portable across setups)
app.integrations.razorpay.default.list_payments({count: 10})

// Named accounts
app.integrations.razorpay.production.list_payments({count: 10})
app.integrations.razorpay.staging.list_payments({count: 10})
```
All functions are identical across accounts — only the credentials differ.
