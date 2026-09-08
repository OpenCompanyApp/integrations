# ShipBob — Ruby API Reference

## list_orders

List fulfillment orders with pagination and optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |
| `status` | string | no | Filter by status: `pending`, `processing`, `fulfilled`, `cancelled` |

### Examples

```ruby
# List pending orders
result = app.integrations.shipbob.list_orders(status: "pending", limit: 10)
result.each do |order|
  puts("Order #" + (order.id).to_s + " - " + (order.status).to_s)
end
# Paginate through all orders
page2 = app.integrations.shipbob.list_orders(page: 2, limit: 50)
```
---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob order ID |

### Example

```ruby
order = app.integrations.shipbob.get_order(id: 12345)
puts("Order #" + (order.id).to_s)
puts("Status: " + (order.status).to_s)
puts("Tracking: " + ((order.tracking_number || "N/A")).to_s)
```
---

## create_order

Create a new fulfillment order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `receiving_note` | string | yes | Note for the fulfillment center |
| `products` | array | yes | List of product line items (each with `id` and `quantity`) |
| `shipping_method` | string | no | Shipping method: `ground`, `expedited`, `overnight`, etc. |

### Example

```ruby
order = app.integrations.shipbob.create_order(receiving_note: "Priority shipment — handle with care", products: [{id: 101, quantity: 2}, {id: 205, quantity: 1}], shipping_method: "expedited")
puts("Created order #" + (order.id).to_s)
```
---

## list_products

List products in your ShipBob inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |

### Example

```ruby
result = app.integrations.shipbob.list_products(page: 1, limit: 50)
result.each do |product|
  puts((product.name).to_s + " (SKU: " + (product.sku).to_s + ") — " + (product.quantity).to_s + " in stock")
end
```
---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob product ID |

### Example

```ruby
product = app.integrations.shipbob.get_product(id: 678)
puts((product.name).to_s + " — " + (product.quantity).to_s + " units available")
```
---

## list_shipments

List shipments with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |

### Example

```ruby
result = app.integrations.shipbob.list_shipments(page: 1, limit: 25)
result.each do |shipment|
  puts("Shipment #" + (shipment.id).to_s + " — " + (shipment.status).to_s + " (" + (shipment.carrier).to_s + ")")
end
```
---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```ruby
user = app.integrations.shipbob.get_current_user()
puts("Logged in as: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple ShipBob accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.shipbob.list_orders()
# Explicit default (portable across setups)
app.integrations.shipbob.default.list_orders()
# Named accounts
app.integrations.shipbob.production.list_orders()
app.integrations.shipbob.staging.list_orders()
```
All functions are identical across accounts — only the credentials differ.
