# NetSuite ERP — JavaScript API Reference

## list_customers

List customers from NetSuite ERP.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of customers to return (default: 50, max: 1000) |
| `offset` | integer | no | Zero-based offset for pagination |

### Example

```js
var result = app.integrations.netsuite.list_customers({
  limit: 10,
  offset: 0,
})

for (const customer of (result.items)) {
  console.log(customer.id + ": " + (customer.companyname || customer.entityid))
}
```
---

## get_customer

Get detailed information for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The internal ID of the customer in NetSuite |

### Example

```js
var result = app.integrations.netsuite.get_customer({
  id: "12345",
})

console.log("Company: " + result.companyname)
console.log("Email: " + (result.email || "N/A"))
console.log("Phone: " + (result.phone || "N/A"))
```
---

## create_customer

Create a new customer in NetSuite.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `companyname` | string | no* | Company name (required for company customers) |
| `firstname` | string | no* | First name (required for individual customers) |
| `lastname` | string | no* | Last name (required for individual customers) |
| `email` | string | no | Primary email address |
| `phone` | string | no | Primary phone number |
| `subsidiary` | string | no | Subsidiary internal ID (required for OneWorld accounts) |
| `entitystatus` | string | no | Customer status reference |
| `currency` | string | no | Currency internal ID |
| `terms` | string | no | Payment terms reference |
| `addressbook` | array | no | Array of address objects |

*Either `companyname` or `lastname` is required.

### Example

```js
var result = app.integrations.netsuite.create_customer({
  companyname: "Acme Corp",
  email: "billing@acme.com",
  phone: "+1-555-0123",
  currency: "1",
  terms: "2",
})

console.log("Created customer: " + result.id)
```
---

## list_invoices

List invoices from NetSuite ERP.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of invoices to return (default: 50, max: 1000) |
| `offset` | integer | no | Zero-based offset for pagination |

### Example

```js
var result = app.integrations.netsuite.list_invoices({
  limit: 20,
  offset: 0,
})

for (const invoice of (result.items)) {
  console.log(invoice.tranid + ": $" + (invoice.amountremaining || invoice.total))
}
```
---

## list_sales_orders

List sales orders from NetSuite ERP.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sales orders to return (default: 50, max: 1000) |
| `offset` | integer | no | Zero-based offset for pagination |

### Example

```js
var result = app.integrations.netsuite.list_sales_orders({
  limit: 20,
  offset: 0,
})

for (const order of (result.items)) {
  console.log(order.tranid + ": " + (order.status || "Unknown"))
}
```
---

## list_items

List items (products and services) from NetSuite ERP.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of items to return (default: 50, max: 1000) |
| `offset` | integer | no | Zero-based offset for pagination |

### Example

```js
var result = app.integrations.netsuite.list_items({
  limit: 50,
  offset: 0,
})

for (const item of (result.items)) {
  console.log(item.itemid + ": " + (item.displayname || item.description || ""))
}
```
---

## get_current_user

Get the authenticated NetSuite user's profile.

### Parameters

None.

### Example

```js
var result = app.integrations.netsuite.get_current_user({})

console.log("User: " + (result.name || result.email))
console.log("Role: " + (result.role || "N/A"))
```
---

## Multi-Account Usage

If you have multiple NetSuite accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.netsuite.list_customers({limit: 10})

// Explicit default (portable across setups)
app.integrations.netsuite.default.list_customers({limit: 10})

// Named accounts
app.integrations.netsuite.production.list_customers({limit: 10})
app.integrations.netsuite.sandbox.list_customers({limit: 10})
```
All functions are identical across accounts — only the credentials differ.
