# TaxJar — Ruby API Reference

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

```ruby
result = app.integrations.taxjar.list_orders(from_date: "2024-01-01", to_date: "2024-12-31", limit: 50)
result.orders.each do |order|
  puts((order.transaction_id).to_s + " — " + (order.amount).to_s + " — " + (order.transaction_date).to_s)
end
```
---

## get_order

Retrieve details of a single order transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order transaction ID |

### Example

```ruby
result = app.integrations.taxjar.get_order(id: "ORDER-123")
order = result.order
puts("Amount: " + (order.amount).to_s)
puts("Tax: " + (order.tax).to_s)
puts("Shipping: " + ((order.shipping || "N/A")).to_s)
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

```ruby
result = app.integrations.taxjar.list_refunds(from_date: "2024-01-01", limit: 25)
result.refunds.each do |refund|
  puts((refund.transaction_id).to_s + " — " + (refund.amount).to_s + " — " + (refund.transaction_date).to_s)
end
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

```ruby
result = app.integrations.taxjar.list_transactions(from_date: "2024-06-01", to_date: "2024-06-30")
result.transactions.each do |txn|
  puts((txn.transaction_id).to_s + " — " + (txn.amount).to_s + " — " + (txn.transaction_date).to_s)
end
```
---

## get_transaction

Retrieve details of a single transaction by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The transaction ID |

### Example

```ruby
result = app.integrations.taxjar.get_transaction(id: "TXN-456")
txn = result.transaction
puts("Amount: " + (txn.amount).to_s)
puts("Tax: " + (txn.tax).to_s)
puts("Line items: " + ((txn.line_items || {}).length).to_s)
```
---

## list_categories

List all tax categories available in TaxJar.

### Parameters

None.

### Example

```ruby
result = app.integrations.taxjar.list_categories()
result.categories.each do |cat|
  puts((cat.name).to_s + " — " + (cat.product_tax_code).to_s + " — " + ((cat.description || "")).to_s)
end
```
---

## get_current_user

Retrieve the current authenticated user information.

### Parameters

None.

### Example

```ruby
result = app.integrations.taxjar.get_current_user()
puts("User: " + (((result.user && result.user.email) || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple TaxJar accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.taxjar.list_orders(from_date: "2024-01-01")
# Explicit default (portable across setups)
app.integrations.taxjar.default.list_orders(from_date: "2024-01-01")
# Named accounts
app.integrations.taxjar.production.list_orders(from_date: "2024-01-01")
app.integrations.taxjar.staging.list_orders(from_date: "2024-01-01")
```
All functions are identical across accounts — only the credentials differ.
