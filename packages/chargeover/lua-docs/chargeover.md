# Integration: ChargeOver

ChargeOver tools access the REST API v3 for recurring billing records. The
integration uses HTTP Basic Auth with an API username/key and API
password/secret.

## Namespace

`chargeover`

## Available Tools

- `chargeover_list_customers` - Query customers from `/api/v3/customer`.
- `chargeover_get_customer` - Fetch one customer by `customer_id`.
- `chargeover_list_subscriptions` - Query subscription package records from `/api/v3/package`.
- `chargeover_list_invoices` - Query invoices from `/api/v3/invoice`.
- `chargeover_get_invoice` - Fetch one invoice by `invoice_id`.
- `chargeover_list_transactions` - Query transactions from `/api/v3/transaction`.
- `chargeover_get_transaction` - Fetch one transaction by `transaction_id`.
- `chargeover_get_current_user` - Verify credentials with a lightweight customer query. ChargeOver REST API v3 does not expose a dedicated `/me` endpoint.

## Configuration

Required credentials:

- `api_username` - ChargeOver API username/key.
- `api_password` - ChargeOver API password/secret.
- `subdomain` or `url` - either the ChargeOver subdomain such as `example`
  for `https://example.chargeover.com`, or a full instance URL.

For backward compatibility, hosts may still have an `access_token` value. The
integration treats that value as the API username only when `api_username` is
missing, but a matching `api_password` is still required.

## Querying

List tools use ChargeOver's documented query parameters:

- `limit` - number of records to return, maximum 500.
- `offset` - zero-based record offset.
- `where` - filter expression, for example `company:CONTAINS:acme`.
- `order` - sort expression, for example `customer_id:DESC`.
- `expand` - endpoint-specific expansion, such as `line_items` for packages or
  `applied_to` for transactions.

ChargeOver responses are returned in the upstream shape, typically with
`code`, `status`, `message`, `details`, and `response`.

## Examples

```lua
local customers = chargeover.chargeover_list_customers({
  limit = 25,
  offset = 0,
  where = "superuser_email:EQUALS:person@example.test",
  order = "customer_id:DESC"
})
```

```lua
local packages = chargeover.chargeover_list_subscriptions({
  customer_id = 123,
  expand = "line_items"
})
```

```lua
local transactions = chargeover.chargeover_list_transactions({
  where = "applied_to.invoice_id:EQUALS:456",
  expand = "applied_to"
})
```
