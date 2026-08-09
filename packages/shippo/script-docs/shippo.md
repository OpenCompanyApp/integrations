# Shippo

Namespace: `shippo`

Shippo tools map one-to-one to the official Shippo OpenAPI 3.1 operation set for API version `2018-02-08`. Use these tools to manage addresses, parcels, shipments, rates, labels, tracking, customs data, refunds, carrier accounts, manifests, pickups, service groups, Shippo accounts, and webhooks.

Authentication uses a Shippo live or test API token. The integration sends `Authorization: ShippoToken {token}` and defaults `SHIPPO-API-VERSION` to `2018-02-08` unless a different configured version or per-tool `shippo_api_version` argument is supplied.

## Request Shape

- Path and query parameters use snake_case tool keys even when Shippo's HTTP parameter is camel/Pascal case, bracketed, or hyphenated.
- JSON payload endpoints accept a `body` object matching Shippo's documented request schema for that operation.
- Array query parameters are serialized as repeated query keys, including Shippo's documented bracketed names such as `order_status[]`.
- Returned data is the decoded Shippo JSON response. Empty successful responses return `{ success, status }`.

## Common Tools

- `shippo_list_addresses`: List all addresses (`GET /addresses`)
- `shippo_create_address`: Create a new address (`POST /addresses`)
- `shippo_get_address`: Retrieve an address (`GET /addresses/{AddressId}`)
- `shippo_validate_address`: Validate an address (`GET /addresses/{AddressId}/validate`)
- `shippo_create_batch`: Create a batch (`POST /batches`)
- `shippo_get_batch`: Retrieve a batch (`GET /batches/{BatchId}`)
- `shippo_add_shipments_to_batch`: Add shipments to a batch (`POST /batches/{BatchId}/add_shipments`)
- `shippo_purchase_batch`: Purchase a batch (`POST /batches/{BatchId}/purchase`)
- `shippo_remove_shipments_from_batch`: Remove shipments from a batch (`POST /batches/{BatchId}/remove_shipments`)
- `shippo_list_carrier_accounts`: List all carrier accounts (`GET /carrier_accounts`)
- `shippo_create_carrier_account`: Create a new carrier account (`POST /carrier_accounts`)
- `shippo_get_carrier_account`: Retrieve a carrier account (`GET /carrier_accounts/{CarrierAccountId}`)

## Examples

```js
var addresses = shippo.shippo_list_addresses({ results: 5 })

var address = shippo.shippo_create_address({
  body: {
    name: "Test Sender",
    street1: "123 Example St",
    city: "San Francisco",
    state: "CA",
    zip: "94103",
    country: "US",
    email: "sender@example.test",
  }
})

var shipment = shippo.shippo_create_shipment({
  body: {
    address_from: { object_id: "adr_from_example" },
    address_to: { object_id: "adr_to_example" },
    parcels: [ { object_id: "prcl_example" } ],
    async: false,
  }
})
```
Keep test-mode and production-mode tokens separate. Shippo test tokens can create test labels and tracking scenarios without purchasing live postage.
