# Paddle — Ruby API Reference

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

```ruby
result = app.integrations.paddle.list_transactions(limit: 10, status: "completed")
result.data.each do |txn|
  puts((txn.id).to_s + ": " + (txn.status).to_s + " — " + (txn.details.totals.grand_total).to_s)
end
```
---

## get_transaction

Get details of a specific Paddle transaction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Transaction ID (e.g., `"txn_01abc123"`) |

### Examples

```ruby
result = app.integrations.paddle.get_transaction(id: "txn_01abc123")
puts("Status: " + (result.data.status).to_s)
puts("Amount: " + (result.data.details.totals.grand_total).to_s)
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

```ruby
result = app.integrations.paddle.list_customers(email: "john@example.com")
result.data.each do |customer|
  puts((customer.id).to_s + ": " + (customer.name).to_s + " <" + (customer.email).to_s + ">")
end
```
---

## get_customer

Get details of a specific Paddle customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Customer ID (e.g., `"ctm_01abc123"`) |

### Examples

```ruby
result = app.integrations.paddle.get_customer(id: "ctm_01abc123")
puts("Name: " + (result.data.name).to_s)
puts("Email: " + (result.data.email).to_s)
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

```ruby
result = app.integrations.paddle.create_customer(email: "jane@example.com", name: "Jane Doe")
puts("Created customer: " + (result.data.id).to_s)
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

```ruby
result = app.integrations.paddle.list_products(status: "active", limit: 20)
result.data.each do |product|
  puts((product.id).to_s + ": " + (product.name).to_s)
end
```
---

## get_current_user

Verify Paddle API connectivity with a health check.

### Parameters

None.

### Examples

```ruby
result = app.integrations.paddle.health_check()
if result.connected
  puts("Paddle API is reachable!")
else
  puts("Connection failed: " + (result.error).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Paddle accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.paddle.list_transactions()
# Explicit default (portable across setups)
app.integrations.paddle.default.list_transactions()
# Named accounts
app.integrations.paddle.sandbox.list_transactions()
app.integrations.paddle.production.list_transactions()
```
All functions are identical across accounts — only the credentials differ.
