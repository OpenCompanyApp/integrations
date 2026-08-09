# Zuora — JavaScript API Reference

## zuora_list_accounts

List Zuora customer accounts with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"name.EQ:Acme"` or `"status.EQ:Active"` |

### Filter Syntax

Zuora v2 filters use the format: `field.OPERATOR:value`

Common operators: `EQ`, `NE`, `GT`, `GTE`, `LT`, `LTE`, `LIKE`, `IN`, `ISNULL`

Multiple filters: `["field1.EQ:value1","field2.EQ:value2"]`

### Example

```js
var result = app.integrations.zuora.zuora_list_accounts({
  page_size: 10,
  filter: "status.EQ:Active",
})

for (const account of (result.data)) {
  console.log(account.name + " (" + account.account_number + ")")
}
```
---

## zuora_get_account

Get details of a specific Zuora account by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | The Zuora account ID |

### Example

```js
var result = app.integrations.zuora.zuora_get_account({
  account_id: "8a90b89a8a...",
})

console.log("Account: " + result.name)
console.log("Balance: " + result.balance)
console.log("Status: " + result.status)
```
---

## zuora_list_subscriptions

List Zuora subscriptions with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Active"` or `"account_id.EQ:8a90b89a..."` |

### Example

```js
var result = app.integrations.zuora.zuora_list_subscriptions({
  page_size: 20,
  filter: "status.EQ:Active",
})

for (const sub of (result.data)) {
  console.log(sub.subscription_number + " - " + sub.status)
}
```
---

## zuora_get_subscription

Get details of a specific Zuora subscription by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | string | yes | The Zuora subscription ID |

### Example

```js
var result = app.integrations.zuora.zuora_get_subscription({
  subscription_id: "8a90b89a8a...",
})

console.log("Subscription: " + result.subscription_number)
console.log("Status: " + result.status)
console.log("Start: " + result.start_date)
console.log("End: " + result.end_date)
```
---

## zuora_list_invoices

List Zuora invoices with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Posted"` or `"account_id.EQ:8a90b89a..."` |

### Example

```js
var result = app.integrations.zuora.zuora_list_invoices({
  page_size: 10,
  filter: "status.EQ:Posted",
})

for (const inv of (result.data)) {
  console.log(inv.invoice_number + ": $" + inv.amount + " (" + inv.status + ")")
}
```
---

## zuora_list_payments

List Zuora payments with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Processed"` or `"account_id.EQ:8a90b89a..."` |

### Example

```js
var result = app.integrations.zuora.zuora_list_payments({
  page_size: 10,
  filter: "status.EQ:Processed",
})

for (const pay of (result.data)) {
  console.log(pay.payment_number + ": $" + pay.amount + " via " + pay.method)
}
```
---

## zuora_get_current_user

Get the profile of the currently authenticated Zuora user.

### Parameters

None.

### Example

```js
var result = app.integrations.zuora.zuora_get_current_user({})

console.log("User: " + result.first_name + " " + result.last_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Zuora tenants configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.zuora.zuora_list_accounts({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.zuora.default.zuora_list_accounts({ /* parameters */ })

// Named accounts (e.g., production vs. sandbox)
app.integrations.zuora.production.zuora_list_accounts({ /* parameters */ })
app.integrations.zuora.sandbox.zuora_list_accounts({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
