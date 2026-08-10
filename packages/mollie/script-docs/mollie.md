# Mollie — JavaScript API Reference

## list_payments

List payments with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of payments to return (default: 50, max: 250) |
| `from` | string | no | Payment ID to start from (for pagination) |
| `profileId` | string | no | Filter by profile ID |

### Example

```js
var result = app.integrations.mollie.list_payments({
  limit: 10,
})

for (const payment of (result.payments)) {
  console.log(payment.id + ": " + payment.description + " - " + payment.amount.value + " " + payment.amount.currency)
}
```
---

## get_payment

Retrieve a single payment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The payment ID (e.g., `"tr_abc123"`) |

### Example

```js
var result = app.integrations.mollie.get_payment({
  id: "tr_abc123",
})

console.log("Status: " + result.status)
console.log("Amount: " + result.amount.value + " " + result.amount.currency)
```
---

## create_payment

Create a new payment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | object | yes | Amount object with `currency` (e.g., `"EUR"`) and `value` (e.g., `"10.00"`) |
| `description` | string | yes | Payment description shown to the customer |
| `redirectUrl` | string | yes | URL to redirect the customer to after payment |
| `metadata` | object | no | Custom metadata to store with the payment |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `locale` | string | no | Locale for the payment screen (e.g., `"nl_NL"`) |

### Example

```js
var result = app.integrations.mollie.create_payment({
  amount: { currency: "EUR", value: "29.99" },
  description: "Order #12345",
  redirectUrl: "https://example.com/return",
})

console.log("Payment ID: " + result.id)
console.log("Checkout URL: " + result._links.checkout.href)
```
---

## list_customers

List all customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of customers to return (default: 50, max: 250) |
| `from` | string | no | Customer ID to start from (for pagination) |

### Example

```js
var result = app.integrations.mollie.list_customers({
  limit: 10,
})

for (const customer of (result.customers)) {
  console.log(customer.id + ": " + customer.name + " (" + customer.email + ")")
}
```
---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the customer |
| `email` | string | yes | Email address of the customer |
| `locale` | string | no | Preferred locale (e.g., `"nl_NL"`) |
| `metadata` | object | no | Custom metadata to store with the customer |

### Example

```js
var result = app.integrations.mollie.create_customer({
  name: "Jane Smith",
  email: "jane@example.com",
})

console.log("Customer ID: " + result.id)
```
---

## list_subscriptions

List all subscriptions for a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `limit` | integer | no | Number of subscriptions to return (default: 50, max: 250) |
| `from` | string | no | Subscription ID to start from (for pagination) |

### Example

```js
var result = app.integrations.mollie.list_subscriptions({
  customer_id: "cst_abc123",
})

for (const sub of (result.subscriptions)) {
  console.log(sub.id + ": " + sub.description + " - " + sub.amount.value + " " + sub.amount.currency + " / " + sub.interval)
}
```
---

## create_subscription

Create a subscription for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `amount` | object | yes | Amount object with `currency` and `value` |
| `interval` | string | yes | Interval (e.g., `"1 month"`, `"1 year"`) |
| `description` | string | yes | Description of the subscription |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `webhookUrl` | string | no | URL to receive webhook notifications |
| `metadata` | object | no | Custom metadata |
| `startDate` | string | no | Start date (ISO 8601, e.g., `"2026-05-01"`) |
| `times` | integer | no | Number of billing cycles (null = indefinite) |

### Example

```js
var result = app.integrations.mollie.create_subscription({
  customer_id: "cst_abc123",
  amount: { currency: "EUR", value: "9.99" },
  interval: "1 month",
  description: "Pro plan monthly",
})

console.log("Subscription ID: " + result.id)
console.log("Status: " + result.status)
```
---

## list_invoices

List invoices for the authenticated account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of invoices to return (default: 50, max: 250) |
| `from` | string | no | Invoice ID to start from (for pagination) |
| `reference` | string | no | Filter by invoice reference |
| `year` | integer | no | Filter by year |
| `month` | integer | no | Filter by month |

### Example

```js
var result = app.integrations.mollie.list_invoices({
  year: 2026,
})

for (const invoice of (result.invoices)) {
  console.log(invoice.id + ": " + invoice.reference + " - " + invoice.grossAmount.value + " " + invoice.grossAmount.currency)
}
```
---

## get_current_user

Retrieve the enabled payment methods for the authenticated account.

### Parameters

None.

### Example

```js
var result = app.integrations.mollie.get_current_user({})

for (const method of (result.methods)) {
  console.log(method.id + ": " + method.description)
}
```
---

## Multi-Account Usage

If you have multiple Mollie accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mollie.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mollie.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.mollie.production.function_name({ /* parameters */ })
app.integrations.mollie.test.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
