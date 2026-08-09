# TaxJar — JavaScript API Reference

## list_orders

List order transactions from TaxJar with optional date filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | no | Filter by start date (ISO 8601 format, e.g. 2024-01-01) |
| `to_date` | string | no | Filter by end date (ISO 8601 format, e.g. 2024-12-31) |
| `limit` | integer | no | Number of results per page |
| `offset` | integer | no | Offset for pagination |

### Example

```js
var result = app.integrations.taxjar.list_orders({
  from_date: "2024-01-01",
  to_date: "2024-12-31",
  limit: 50,
})

for (const order of (result.orders)) {
  console.log(order.transaction_id + " — " + order.amount + " — " + order.transaction_date)
}
```
---

## get_order

Retrieve details of a single order transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order transaction ID |

### Example

```js
var result = app.integrations.taxjar.get_order({
  id: "ORDER-123",
})

var order = result.order
console.log("Amount: " + order.amount)
console.log("Tax: " + order.tax)
console.log("Shipping: " + (order.shipping || "N/A"))
```
---

## list_refunds

List refund transactions from TaxJar with optional date filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | no | Filter by start date (ISO 8601 format, e.g. 2024-01-01) |
| `to_date` | string | no | Filter by end date (ISO 8601 format, e.g. 2024-12-31) |
| `limit` | integer | no | Number of results per page |
| `offset` | integer | no | Offset for pagination |

### Example

```js
var result = app.integrations.taxjar.list_refunds({
  from_date: "2024-01-01",
  limit: 25,
})

for (const refund of (result.refunds)) {
  console.log(refund.transaction_id + " — " + refund.amount + " — " + refund.transaction_date)
}
```
---

## list_transactions

List all transactions (orders and refunds) from TaxJar with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | no | Filter by start date (ISO 8601 format, e.g. 2024-01-01) |
| `to_date` | string | no | Filter by end date (ISO 8601 format, e.g. 2024-12-31) |
| `limit` | integer | no | Number of results per page |
| `offset` | integer | no | Offset for pagination |

### Example

```js
var result = app.integrations.taxjar.list_transactions({
  from_date: "2024-06-01",
  to_date: "2024-06-30",
})

for (const txn of (result.transactions)) {
  console.log(txn.transaction_id + " — " + txn.amount + " — " + txn.transaction_date)
}
```
---

## get_transaction

Retrieve details of a single transaction by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The transaction ID |

### Example

```js
var result = app.integrations.taxjar.get_transaction({
  id: "TXN-456",
})

var txn = result.transaction
console.log("Amount: " + txn.amount)
console.log("Tax: " + txn.tax)
console.log("Line items: " + (txn.line_items || {}).length)
```
---

## list_categories

List all tax categories available in TaxJar.

### Parameters

None.

### Example

```js
var result = app.integrations.taxjar.list_categories({})

for (const cat of (result.categories)) {
  console.log(cat.name + " — " + cat.product_tax_code + " — " + (cat.description || ""))
}
```
---

## get_current_user

Retrieve the current authenticated user information.

### Parameters

None.

### Example

```js
var result = app.integrations.taxjar.get_current_user({})

console.log("User: " + (result.user && result.user.email || "N/A"))
```
---

## Multi-Account Usage

If you have multiple TaxJar accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.taxjar.list_orders({from_date: "2024-01-01"})

// Explicit default (portable across setups)
app.integrations.taxjar.default.list_orders({from_date: "2024-01-01"})

// Named accounts
app.integrations.taxjar.production.list_orders({from_date: "2024-01-01"})
app.integrations.taxjar.staging.list_orders({from_date: "2024-01-01"})
```
All functions are identical across accounts — only the credentials differ.
