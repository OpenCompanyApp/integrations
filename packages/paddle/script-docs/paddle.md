# Paddle — JavaScript API Reference

## list_transactions

List Paddle transactions with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `"completed"`, `"pending"`, `"billed"`, `"paid"`, `"canceled"`, `"past_due"` |
| `customer_id` | string | no | Filter by customer ID |

### Examples

```js
var result = app.integrations.paddle.list_transactions({
  limit: 10,
  status: "completed",
})

for (const txn of (result.data)) {
  console.log(txn.id + ": " + txn.status + " — " + txn.details.totals.grand_total)
}
```
---

## get_transaction

Get details of a specific Paddle transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Transaction ID (e.g., `"txn_01abc123"`) |

### Examples

```js
var result = app.integrations.paddle.get_transaction({
  id: "txn_01abc123",
})

console.log("Status: " + result.data.status)
console.log("Amount: " + result.data.details.totals.grand_total)
```
---

## list_customers

List Paddle customers with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `email` | string | no | Filter by email address |
| `name` | string | no | Filter by customer name |

### Examples

```js
var result = app.integrations.paddle.list_customers({
  email: "john@example.com",
})

for (const customer of (result.data)) {
  console.log(customer.id + ": " + customer.name + " <" + customer.email + ">")
}
```
---

## get_customer

Get details of a specific Paddle customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Customer ID (e.g., `"ctm_01abc123"`) |

### Examples

```js
var result = app.integrations.paddle.get_customer({
  id: "ctm_01abc123",
})

console.log("Name: " + result.data.name)
console.log("Email: " + result.data.email)
```
---

## create_customer

Create a new customer in Paddle.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `name` | string | no | Customer display name |

### Examples

```js
var result = app.integrations.paddle.create_customer({
  email: "jane@example.com",
  name: "Jane Doe",
})

console.log("Created customer: " + result.data.id)
```
---

## list_products

List Paddle products with optional filters and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `after` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `"active"`, `"archived"` |

### Examples

```js
var result = app.integrations.paddle.list_products({
  status: "active",
  limit: 20,
})

for (const product of (result.data)) {
  console.log(product.id + ": " + product.name)
}
```
---

## get_current_user

Verify Paddle API connectivity with a health check.

### Parameters

None.

### Examples

```js
var result = app.integrations.paddle.get_current_user({})

if (result.connected) {
  console.log("Paddle API is reachable!")
} else {
  console.log("Connection failed: " + result.error)
}
```
---

## Multi-Account Usage

If you have multiple Paddle accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.paddle.list_transactions({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.paddle.default.list_transactions({ /* parameters */ })

// Named accounts
app.integrations.paddle.sandbox.list_transactions({ /* parameters */ })
app.integrations.paddle.production.list_transactions({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
