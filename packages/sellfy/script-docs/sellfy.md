# Sellfy — JavaScript API Reference

## list_products

List all products in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of products per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```js
var result = app.integrations["sellfy"].list_products({
  page_size: 20,
  page: 1,
})

for (const product of (result.products)) {
  console.log(product.name + " - " + product.price)
}
```
---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The product ID |

### Example

```js
var result = app.integrations["sellfy"].get_product({
  id: "12345",
})

console.log(result.name)
console.log(result.status)
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

```js
var result = app.integrations["sellfy"].create_product({
  name: "My eBook",
  price: 9.99,
  type: "digital",
  description: "A comprehensive guide to selling digital products",
  currency: "USD",
})

console.log("Created product: " + result.id)
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

```js
var result = app.integrations["sellfy"].list_orders({
  page_size: 25,
  page: 1,
})

for (const order of (result.orders)) {
  console.log(order.id + ": " + order.total + " " + order.currency)
}
```
---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order ID |

### Example

```js
var result = app.integrations["sellfy"].get_order({
  id: "67890",
})

console.log(result.id)
console.log(result.status)
console.log("Total: " + result.total)
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

```js
var result = app.integrations["sellfy"].list_customers({
  page_size: 50,
})

for (const customer of (result.customers)) {
  console.log(customer.name + " (" + customer.email + ")")
}
```
---

## get_current_user

Get the currently authenticated Sellfy user profile.

### Parameters

None.

### Example

```js
var result = app.integrations["sellfy"].get_current_user({})

console.log(result.name)
console.log(result.email)
```
---

## Multi-Account Usage

If you have multiple Sellfy accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["sellfy"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["sellfy"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["sellfy"].work.function_name({ /* parameters */ })
app.integrations["sellfy"].personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
