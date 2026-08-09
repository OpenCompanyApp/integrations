# Venmo — JavaScript API Reference

## Availability

This package targets the legacy Venmo Developer API at `https://api.venmo.com/v1`.

Venmo states that its Developer and Payouts APIs have been retired for new businesses. Existing businesses that were granted access in the past, generally before 2016, may retain access. New integrations should usually use PayPal Payouts to Venmo for payouts, or PayPal/Braintree Venmo checkout for purchase flows.

## Authentication

Configure a legacy Venmo `access_token`. The token is sent as `Authorization: Bearer <token>`.

Do not expect this package to provide a new OAuth enrollment flow. Token acquisition is only available to already-approved legacy API users.

## Payments

### `app.integrations.venmo.list_payments(...)`

List payments for the authenticated legacy API account.

```js
var result = app.integrations.venmo.list_payments({
    limit: 20,
    offset: 0,
})
```
Optional filters: `limit`, `offset`, `after`, and `before`.

### `app.integrations.venmo.get_payment(...)`

Retrieve a legacy Venmo payment by ID.

```js
var payment = app.integrations.venmo.get_payment({
    id: "1234567890",
})
```
### `app.integrations.venmo.create_payment(...)`

Create a payment through a grandfathered Venmo Developer API token.

```js
var payment = app.integrations.venmo.create_payment({
    amount: 25.00,
    user_id: "1234567890",
    note: "Dinner",
    audience: "private",
})
```
Audience values: `private`, `friends`, and `public`.

## Users

### `app.integrations.venmo.list_users(...)`

Search users by username, email, or phone number.

```js
var result = app.integrations.venmo.list_users({
    query: "janesmith",
    limit: 10,
})
```
### `app.integrations.venmo.get_user(...)`

Retrieve a user by ID.

```js
var user = app.integrations.venmo.get_user({
    id: "1234567890",
})
```
## Transactions

### `app.integrations.venmo.list_transactions(...)`

List transactions with optional filtering.

```js
var result = app.integrations.venmo.list_transactions({
    action: "pay",
    limit: 20,
})
```
Optional filters: `limit`, `offset`, `after`, `before`, and `action`.

## Current User

### `app.integrations.venmo.get_current_user(...)`

Get the authenticated legacy API user's profile.

```js
var me = app.integrations.venmo.get_current_user({})
```
## Notes

- Amounts are represented as dollar values by the legacy API.
- The legacy API uses offset-based pagination.
- This package intentionally documents the retired-access status. Treat failed setup for new Venmo accounts as expected vendor behavior, not a host bug.
- For new payout use cases, evaluate PayPal Payouts to Venmo instead of this package.

## Multi-Account Usage

```js
app.integrations.venmo.list_payments({})
app.integrations.venmo.default.list_payments({})
app.integrations.venmo.legacy.list_payments({})
```
All functions are identical across accounts; only stored credentials differ.
