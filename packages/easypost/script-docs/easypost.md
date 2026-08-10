# EasyPost

Namespace: `easypost`

Use EasyPost tools for shipping labels, address verification, parcels, customs,
trackers, orders, batches, pickups, scan forms, refunds, insurance, carrier
accounts, webhooks, events, reports, and API-key inspection.

EasyPost authenticates with HTTP Basic auth using the API key as the username
and a blank password. Test and production keys both work against the same v2
API base URL.

## Request Shape

Create/update tools wrap top-level fields in the documented EasyPost resource
key when needed. For example:

```js
easypost.addresses_create({
  street1: "417 Montgomery St",
  city: "San Francisco",
  state: "CA",
  zip: "94104",
  country: "US",
})
```
is sent as `{ address = { ... } }`.

If you need exact control, pass the wrapped key yourself in `payload`, for
example `{ shipment = { ... } }`.

## Common Workflows

- `easypost_addresses_create` and `easypost_addresses_verify` validate sender
  and recipient addresses.
- `easypost_shipments_create` rates a shipment from `to_address`,
  `from_address`, and `parcel`.
- `easypost_shipments_buy` buys a label with a selected rate.
- `easypost_trackers_create` registers tracking for labels not purchased
  through EasyPost.
- `easypost_batches_create`, `easypost_batches_buy`, and
  `easypost_batches_scan_form` handle bulk label workflows.
- `easypost_pickups_create` and `easypost_pickups_buy` schedule pickups.
- `easypost_refunds_create` bulk-requests carrier refunds by tracking code.
- `easypost_reports_create` accepts `report_type`, such as `shipment`.

## Response Shape

JSON responses are returned as `{ status = 200, data = { ... } }`. Empty
successful responses return `{ status = 204, success = true }`.

## Raw API Tools

Use `easypost_api_get`, `easypost_api_post`, `easypost_api_put`,
`easypost_api_patch`, and `easypost_api_delete` only for supported EasyPost
paths not yet represented by a named tool. Raw paths must be relative, for
example `/shipments`; absolute URLs are rejected.
