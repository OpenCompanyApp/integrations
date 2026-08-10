# Podia — JavaScript API Reference

## list_products

List all online courses and digital downloads in your Podia account.

### Parameters

None.

### Examples

```js
var result = app.integrations.podia.list_products()

for (const product of (result.products)) {
  console.log(product.name + " — " + product.type + " (" + product.id + ")")
}
```
---

## get_product

Get detailed information about a single Podia product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```js
var result = app.integrations.podia.get_product({
  product_id: "12345",
})

console.log(result.product.name)
console.log(result.product.description)
console.log(result.product.price)
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

```js
var result = app.integrations.podia.list_customers()

for (const customer of (result.customers)) {
  console.log(customer.email + " — " + customer.name)
}
```
#### Paginated

```js
var result = app.integrations.podia.list_customers({
  page: 2,
})
```
---

## get_customer

Get details for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The ID of the customer |

### Example

```js
var result = app.integrations.podia.get_customer({
  customer_id: "67890",
})

console.log(result.customer.email)
console.log(result.customer.name)
console.log(result.customer.total_spent)
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

```js
var result = app.integrations.podia.list_sales()

for (const sale of (result.sales)) {
  console.log(sale.email + " — $" + sale.amount + " — " + sale.product_name)
}
```
#### Sales for a specific product

```js
var result = app.integrations.podia.list_sales({
  product_id: "12345",
})

console.log("Total sales: " + result.totalCount)
```
#### Sales in a date range

```js
var result = app.integrations.podia.list_sales({
  after: "2026-01-01T00:00:00Z",
  before: "2026-01-31T23:59:59Z",
})
```
---

## get_sale

Get details for a single sale.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sale_id` | string | yes | The ID of the sale |

### Example

```js
var result = app.integrations.podia.get_sale({
  sale_id: "SALE123",
})

console.log(result.sale.email)
console.log(result.sale.amount)
console.log(result.sale.status)
console.log(result.sale.product_name)
```
---

## get_current_user

Get the profile of the currently authenticated Podia user.

### Parameters

None.

### Example

```js
var result = app.integrations.podia.get_current_user()

console.log("Connected as: " + result.user.name)
console.log("Email: " + result.user.email)
```
---

## Multi-Account Usage

If you have multiple Podia accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.podia.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.podia.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.podia.main_site.function_name({ /* parameters */ })
app.integrations.podia.course_platform.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
