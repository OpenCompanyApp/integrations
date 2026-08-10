# Zoho Inventory — JavaScript API Reference

## list_items

List inventory items (products) from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |
| `status` | string | no | Filter by status: `active`, `inactive`, `all` |

### Examples

```js
// List first page of active items
var result = app.integrations["zoho-inventory"].zoho_inventory_list_items({
  page: 1,
  per_page: 25,
  status: "active",
})

for (const item of (result.items || [])) {
  console.log(item.name + " — " + item.sku + " — stock: " + (item.actual_available_stock || "0"))
}
```
```js
// Paginate through all items
var page = 1
do {
  var result = app.integrations["zoho-inventory"].zoho_inventory_list_items({ page: page, per_page: 200 })
  for (const item of (result.items || [])) {
    console.log(item.item_id + ": " + item.name)
  }
  page = (result.page_context || {}).page + 1
} while (!(!result.items || result.items.length === 0));
```
---

## get_item

Get details of a specific inventory item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | string | yes | The Zoho Inventory item ID |

### Example

```js
var result = app.integrations["zoho-inventory"].zoho_inventory_get_item({ item_id: "4815162342" })
var item = result.item
console.log(item.name + " — " + item.unit + " — $" + item.rate)
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

```js
// List open sales orders
var result = app.integrations["zoho-inventory"].zoho_inventory_list_orders({
  page: 1,
  per_page: 25,
  status: "open",
})

for (const order of (result.salesorders || [])) {
  console.log(order.salesorder_number + " — " + order.customer_name + " — $" + order.total)
}
```
---

## get_order

Get details of a specific sales order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The Zoho Inventory sales order ID |

### Example

```js
var result = app.integrations["zoho-inventory"].zoho_inventory_get_order({ order_id: "4815162342" })
var order = result.salesorder
console.log("Order: " + order.salesorder_number)
console.log("Customer: " + order.customer_name)
console.log("Total: $" + order.total)
for (const line of (order.line_items || [])) {
  console.log("  " + line.name + " x" + line.quantity + " = $" + line.item_total)
}
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

```js
var result = app.integrations["zoho-inventory"].zoho_inventory_list_shipments({ page: 1, per_page: 25 })

for (const shipment of (result.shipments || [])) {
  console.log(shipment.shipment_id + " — " + (shipment.status || "unknown"))
}
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

```js
var result = app.integrations["zoho-inventory"].zoho_inventory_list_packages({ page: 1, per_page: 25 })

for (const pkg of (result.packages || [])) {
  console.log(pkg.package_id + " — " + (pkg.status || "unknown"))
}
```
---

## get_current_user

Get the currently authenticated Zoho Inventory user.

### Parameters

None.

### Example

```js
var result = app.integrations["zoho-inventory"].zoho_inventory_get_current_user({})
var user = result.user
console.log("Logged in as: " + user.name + " (" + user.email + ")")
```
---

## Multi-Account Usage

If you have multiple Zoho Inventory accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-inventory"].zoho_inventory_list_items({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-inventory"].default.zoho_inventory_list_items({ /* parameters */ })

// Named accounts
app.integrations["zoho-inventory"].warehouse_us.zoho_inventory_list_items({ /* parameters */ })
app.integrations["zoho-inventory"].warehouse_eu.zoho_inventory_list_orders({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
