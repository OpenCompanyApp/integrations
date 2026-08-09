# Dwolla Integration

Use the `dwolla` integration to manage Dwolla customers, beneficial owners, documents, funding sources, transfers, mass payments, labels, events, webhook subscriptions, exchanges, KBA sessions, and sandbox simulations.

All endpoint tools are generated from Dwolla's official OpenAPI repository at `https://github.com/Dwolla/dwolla-openapi`. Runtime API calls use `Authorization: Bearer <access_token>`. `dwolla_create_application_access_token` uses OAuth client credentials with Basic authentication and a form-encoded body.

## Common Tools

- `dwolla_create_application_access_token` exchanges `client_id` and `client_secret` for an OAuth access token.
- `dwolla_list_and_search_customers`, `dwolla_create_customer`, `dwolla_get_customer`, and `dwolla_update` cover customer lifecycle operations.
- Beneficial owner, document, funding source, transfer, mass payment, webhook subscription, event, exchange, label, KBA, and sandbox simulation tools map directly to the official Dwolla API paths.
- Multipart document upload tools accept local file paths in the `body` object for file fields.

## Request Shape

Path, query, and header parameters are exposed as snake_case tool parameters. JSON, Dwolla HAL JSON, form-encoded, and multipart request bodies are passed through the `body` object and should match the official Dwolla schema for the endpoint.

## Return Shape

JSON responses are returned as decoded arrays/objects from Dwolla. Empty successful responses return `{ success = true, status = <http_status>, location = <location_header> }` when a Location header is present.

## Examples

```js
var root = app.integrations.dwolla.get_root({})

var customers = app.integrations.dwolla.list_and_search_customers({
  limit: 25,
  search: "example",
})

var token = app.integrations.dwolla.create_application_access_token({
  body: { grant_type: "client_credentials" },
})
```
Use fake customer IDs, funding source IDs, transfer IDs, document paths, webhook URLs, client IDs, and access tokens in tests and examples. Never store real bank, customer, routing, account, SSN, OAuth, or webhook-secret data in fixtures or JavaScript examples.
