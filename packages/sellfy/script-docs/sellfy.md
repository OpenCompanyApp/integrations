# Sellfy — Ruby API Reference

## list_products

List all products in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of products per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.sellfy.list_products(page_size: 20, page: 1)
result.products.each do |product|
  puts((product.name).to_s + " - " + (product.price).to_s)
end
```
---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The product ID |

### Example

```ruby
result = app.integrations.sellfy.get_product(id: "12345")
puts(result.name)
puts(result.status)
```
---

## create_product

Create a new product in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The product name |
| `price` | number | yes | The product price |
| `type` | string | no | Product type: "digital", "subscription", or "physical". Default: "digital" |
| `description` | string | no | Product description |
| `currency` | string | no | Currency code (e.g., "USD", "EUR") |

### Example

```ruby
result = app.integrations.sellfy.create_product(name: "My eBook", price: 9.99, type: "digital", description: "A comprehensive guide to selling digital products", currency: "USD")
puts("Created product: " + (result.id).to_s)
```
---

## list_orders

List all orders in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of orders per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.sellfy.list_orders(page_size: 25, page: 1)
result.orders.each do |order|
  puts((order.id).to_s + ": " + (order.total).to_s + " " + (order.currency).to_s)
end
```
---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order ID |

### Example

```ruby
result = app.integrations.sellfy.get_order(id: "67890")
puts(result.id)
puts(result.status)
puts("Total: " + (result.total).to_s)
```
---

## list_customers

List all customers in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of customers per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```ruby
result = app.integrations.sellfy.list_customers(page_size: 50)
result.customers.each do |customer|
  puts((customer.name).to_s + " (" + (customer.email).to_s + ")")
end
```
---

## get_current_user

Get the currently authenticated Sellfy user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.sellfy.get_current_user()
puts(result.name)
puts(result.email)
```
---

## Multi-Account Usage

If you have multiple Sellfy accounts configured, use account-specific namespaces:

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
