# Zoho Inventory — Ruby API Reference

## list_items

List inventory items (products) from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |
| `status` | string | no | Filter by status: `active`, `inactive`, `all` |

### Examples

```ruby
# List first page of active items
result = app.call("integrations.zoho-inventory.list_items", page: 1, per_page: 25, status: "active")
(result.items || []).each do |item|
  puts((item.name).to_s + " — " + (item.sku).to_s + " — stock: " + ((item.actual_available_stock || "0")).to_s)
end
```
```ruby
# Paginate through all items
page = 1
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.call("integrations.zoho-inventory.list_items", page: page, per_page: 200)
  (result.items || []).each do |item|
    puts((item.item_id).to_s + ": " + (item.name).to_s)
  end
  page = ((result.page_context || {}).page + 1)
  break unless (!((!result.items) || (result.items.length == 0)))
end
```
---

## get_item

Get details of a specific inventory item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | string | yes | The Zoho Inventory item ID |

### Example

```ruby
result = app.call("integrations.zoho-inventory.get_item", item_id: "4815162342")
item = result.item
puts((item.name).to_s + " — " + (item.unit).to_s + " — $" + (item.rate).to_s)
```
---

## list_orders

List sales orders from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |
| `status` | string | no | Filter by status: `draft`, `confirmed`, `void`, `open`, `invoiced`, `partially_invoiced`, `all` |

### Example

```ruby
# List open sales orders
result = app.call("integrations.zoho-inventory.list_sales_orders", page: 1, per_page: 25, status: "open")
(result.salesorders || []).each do |order|
  puts((order.salesorder_number).to_s + " — " + (order.customer_name).to_s + " — $" + (order.total).to_s)
end
```
---

## get_order

Get details of a specific sales order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The Zoho Inventory sales order ID |

### Example

```ruby
result = app.call("integrations.zoho-inventory.get_sales_order", order_id: "4815162342")
order = result.salesorder
puts("Order: " + (order.salesorder_number).to_s)
puts("Customer: " + (order.customer_name).to_s)
puts("Total: $" + (order.total).to_s)
(order.line_items || []).each do |line|
  puts("  " + (line.name).to_s + " x" + (line.quantity).to_s + " = $" + (line.item_total).to_s)
end
```
---

## list_shipments

List shipments from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |

### Example

```ruby
result = app.call("integrations.zoho-inventory.list_shipments", page: 1, per_page: 25)
(result.shipments || []).each do |shipment|
  puts((shipment.shipment_id).to_s + " — " + ((shipment.status || "unknown")).to_s)
end
```
---

## list_packages

List packages from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |

### Example

```ruby
result = app.call("integrations.zoho-inventory.list_packages", page: 1, per_page: 25)
(result.packages || []).each do |pkg|
  puts((pkg.package_id).to_s + " — " + ((pkg.status || "unknown")).to_s)
end
```
---

## get_current_user

Get the currently authenticated Zoho Inventory user.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.zoho-inventory.get_current_user")
user = result.user
puts("Logged in as: " + (user.name).to_s + " (" + (user.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Zoho Inventory accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.zoho-inventory.list_items")
# Explicit default (portable across setups)
app.call("integrations.zoho-inventory.default.list_items")
# Named accounts
app.call("integrations.zoho-inventory.warehouse_us.list_items")
app.call("integrations.zoho-inventory.warehouse_eu.list_sales_orders")
```
All functions are identical across accounts — only the credentials differ.
