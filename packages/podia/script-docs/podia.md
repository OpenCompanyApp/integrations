# Podia — Ruby API Reference

## list_products

List all online courses and digital downloads in your Podia account.

### Parameters

None.

### Examples

```ruby
result = app.integrations.podia.list_products()
result.products.each do |product|
  puts((product.name).to_s + " — " + (product.type).to_s + " (" + (product.id).to_s + ")")
end
```
---

## get_product

Get detailed information about a single Podia product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```ruby
result = app.integrations.podia.get_product(product_id: "12345")
puts(result.product.name)
puts(result.product.description)
puts(result.product.price)
```
---

## list_customers

List all customers in your Podia account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### All customers

```ruby
result = app.integrations.podia.list_customers()
result.customers.each do |customer|
  puts((customer.email).to_s + " — " + (customer.name).to_s)
end
```
#### Paginated

```ruby
result = app.integrations.podia.list_customers(page: 2)
```
---

## get_customer

Get details for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The ID of the customer |

### Example

```ruby
result = app.integrations.podia.get_customer(customer_id: "67890")
puts(result.customer.email)
puts(result.customer.name)
puts(result.customer.total_spent)
```
---

## list_sales

List sales from your Podia account with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | no | Filter by product ID |
| `before` | string | no | Only sales before this ISO 8601 timestamp |
| `after` | string | no | Only sales after this ISO 8601 timestamp |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### All recent sales

```ruby
result = app.integrations.podia.list_sales()
result.sales.each do |sale|
  puts((sale.email).to_s + " — $" + (sale.amount).to_s + " — " + (sale.product_name).to_s)
end
```
#### Sales for a specific product

```ruby
result = app.integrations.podia.list_sales(product_id: "12345")
puts("Total sales: " + (result.totalCount).to_s)
```
#### Sales in a date range

```ruby
result = app.integrations.podia.list_sales(after: "2026-01-01T00:00:00Z", before: "2026-01-31T23:59:59Z")
```
---

## get_sale

Get details for a single sale.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sale_id` | string | yes | The ID of the sale |

### Example

```ruby
result = app.integrations.podia.get_sale(sale_id: "SALE123")
puts(result.sale.email)
puts(result.sale.amount)
puts(result.sale.status)
puts(result.sale.product_name)
```
---

## get_current_user

Get the profile of the currently authenticated Podia user.

### Parameters

None.

### Example

```ruby
result = app.integrations.podia.get_current_user()
puts("Connected as: " + (result.user.name).to_s)
puts("Email: " + (result.user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Podia accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
