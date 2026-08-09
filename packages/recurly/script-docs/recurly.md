# Recurly — JavaScript API Reference

## recurly_list_accounts

List billing accounts from Recurly. Supports filtering by email and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `email` | string | no | Filter accounts by email address. |
| `state` | string | no | Filter by account state: `"active"`, `"closed"`, or `"inactive"`. |

### Example

```js
var result = app.integrations.recurly.list_accounts({
  limit: 10,
  state: "active",
})

for (const account of (result.data)) {
  console.log(account.code + ": " + (account.email || "no email"))
}
```
---

## recurly_get_account

Get details of a specific Recurly billing account by its ID or account code.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID or account code (e.g., `"code-123"` or a UUID). |

### Example

```js
var result = app.integrations.recurly.get_account({
  id: "code-123",
})

console.log("Account: " + result.code)
console.log("Email: " + (result.email || "N/A"))
console.log("State: " + result.state)
```
---

## recurly_create_account

Create a new billing account in Recurly with a unique account code, email, and name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `code` | string | yes | A unique identifier for the account (e.g., `"cust-001"`). |
| `email` | string | no | The account email address. |
| `first_name` | string | no | The account holder's first name. |
| `last_name` | string | no | The account holder's last name. |

### Example

```js
var result = app.integrations.recurly.create_account({
  code: "cust-001",
  email: "john@example.com",
  first_name: "John",
  last_name: "Doe",
})

console.log("Created account: " + result.code)
```
---

## recurly_list_subscriptions

List subscriptions from Recurly. Supports filtering by account and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of subscriptions to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `account_id` | string | no | Filter subscriptions by account ID or account code. |
| `state` | string | no | Filter by subscription state: `"active"`, `"canceled"`, `"expired"`, `"future"`, `"paused"`, or `"trial"`. |

### Example

```js
var result = app.integrations.recurly.list_subscriptions({
  limit: 10,
  state: "active",
})

for (const sub of (result.data)) {
  console.log(sub.uuid + " — " + sub.state + " — " + (sub.plan && sub.plan.code || "no plan"))
}
```
### Filter by account

```js
var result = app.integrations.recurly.list_subscriptions({
  account_id: "code-123",
  state: "active",
})
```
---

## recurly_get_subscription

Get details of a specific Recurly subscription by its UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription UUID. |

### Example

```js
var result = app.integrations.recurly.get_subscription({
  id: "37c0a116-3b3a-4f57-bf32-45a1c8e0e6d8",
})

console.log("State: " + result.state)
console.log("Plan: " + (result.plan && result.plan.code || "N/A"))
console.log("Amount: " + (result.unit_amount && String(result.unit_amount) || "N/A"))
```
---

## recurly_list_plans

List billing plans from Recurly. Supports cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of plans to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |

### Example

```js
var result = app.integrations.recurly.list_plans({
  limit: 50,
})

for (const plan of (result.data)) {
  console.log(plan.code + ": " + plan.name + " — $" + String(plan.currencies[0].unit_amount / 100))
}
```
---

## recurly_get_current_user

Verify the Recurly API connection by fetching the first account. Useful as a health check.

### Parameters

This tool takes no parameters.

### Example

```js
var result = app.integrations.recurly.get_current_user({})

if (result.data && result.data.length > 0) {
  console.log("Connected! First account: " + result.data[0].code)
} else {
  console.log("Connected, but no accounts found.")
}
```
---

## Multi-Account Usage

If you have multiple Recurly accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.recurly.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.recurly.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.recurly.production.function_name({ /* parameters */ })
app.integrations.recurly.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
