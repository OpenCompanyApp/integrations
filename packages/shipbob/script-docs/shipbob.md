# ShipBob — JavaScript API Reference

## list_orders

List fulfillment orders with pagination and optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |
| `status` | string | no | Filter by status: `pending`, `processing`, `fulfilled`, `cancelled` |

### Examples

```js
// List pending orders
var result = app.integrations.shipbob.list_orders({
  status: "pending",
  limit: 10,
})

for (const order of (result)) {
  console.log("Order #" + order.id + " - " + order.status)
}

// Paginate through all orders
var page2 = app.integrations.shipbob.list_orders({
  page: 2,
  limit: 50,
})
```
---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob order ID |

### Example

```js
var order = app.integrations.shipbob.get_order({ id: 12345 })
console.log("Order #" + order.id)
console.log("Status: " + order.status)
console.log("Tracking: " + (order.tracking_number || "N/A"))
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

```js
var order = app.integrations.shipbob.create_order({
  receiving_note: "Priority shipment — handle with care",
  products: [
    { id: 101, quantity: 2 },
    { id: 205, quantity: 1 }
  ],
  shipping_method: "expedited",
})

console.log("Created order #" + order.id)
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

```js
var result = app.integrations.shipbob.list_products({
  page: 1,
  limit: 50,
})

for (const product of (result)) {
  console.log(product.name + " (SKU: " + product.sku + ") — " + product.quantity + " in stock")
}
```
---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob product ID |

### Example

```js
var product = app.integrations.shipbob.get_product({ id: 678 })
console.log(product.name + " — " + product.quantity + " units available")
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

```js
var result = app.integrations.shipbob.list_shipments({
  page: 1,
  limit: 25,
})

for (const shipment of (result)) {
  console.log("Shipment #" + shipment.id + " — " + shipment.status + " (" + shipment.carrier + ")")
}
```
---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```js
var user = app.integrations.shipbob.get_current_user({})
console.log("Logged in as: " + user.email)
```
---

## Multi-Account Usage

If you have multiple ShipBob accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.shipbob.list_orders({})

// Explicit default (portable across setups)
app.integrations.shipbob.default.list_orders({})

// Named accounts
app.integrations.shipbob.production.list_orders({})
app.integrations.shipbob.staging.list_orders({})
```
All functions are identical across accounts — only the credentials differ.
