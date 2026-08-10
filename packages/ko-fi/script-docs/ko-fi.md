# Ko-fi — JavaScript API Reference

## list_supporters

List all supporters who have donated or subscribed to your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```js
var result = app.integrations["ko-fi"].list_supporters()

for (const supporter of (result.supporters)) {
  console.log(supporter.name + " — " + supporter.email)
}
```
#### Paginated results

```js
var result = app.integrations["ko-fi"].list_supporters({
  page: 2,
  limit: 10,
})

console.log("Total supporters on page: " + result.totalCount)
```
---

## get_supporter

Get detailed information about a single Ko-fi supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address of the supporter to retrieve |

### Example

```js
var result = app.integrations["ko-fi"].get_supporter({
  email: "fan@example.com",
})

console.log(result.name)
console.log(result.total_donated)
console.log(result.status)
```
---

## list_transactions

List all transactions including donations, subscriptions, and shop orders.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter by type: `donation`, `subscription`, or `shop_order` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All recent transactions

```js
var result = app.integrations["ko-fi"].list_transactions()

for (const tx of (result.transactions)) {
  console.log(tx.type + " — $" + tx.amount + " — " + tx.supporter_name)
}
```
#### Filter by type

```js
var result = app.integrations["ko-fi"].list_transactions({
  type: "donation",
})

console.log("Donation count: " + result.totalCount)
```
---

## list_commissions

List all commission requests on your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `pending`, `accepted`, `completed`, or `declined` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All commissions

```js
var result = app.integrations["ko-fi"].list_commissions()

for (const commission of (result.commissions)) {
  console.log(commission.title + " — " + commission.status + " — $" + commission.price)
}
```
#### Pending commissions only

```js
var result = app.integrations["ko-fi"].list_commissions({
  status: "pending",
})
```
---

## get_commission

Get details for a single commission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `commission_id` | string | yes | The ID of the commission to retrieve |

### Example

```js
var result = app.integrations["ko-fi"].get_commission({
  commission_id: "COM123",
})

console.log(result.title)
console.log(result.description)
console.log(result.status)
console.log(result.requester_name)
```
---

## list_shop_items

List all items in your Ko-fi shop.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```js
var result = app.integrations["ko-fi"].list_shop_items()

for (const item of (result.items)) {
  console.log(item.name + " — $" + item.price)
}
```
---

## get_current_user

Get the profile of the currently authenticated Ko-fi user.

### Parameters

None.

### Example

```js
var result = app.integrations["ko-fi"].get_current_user()

console.log("Connected as: " + result.name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Ko-fi accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["ko-fi"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["ko-fi"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["ko-fi"].main_page.function_name({ /* parameters */ })
app.integrations["ko-fi"].side_project.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
