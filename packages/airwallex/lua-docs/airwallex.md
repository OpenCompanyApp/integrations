# Airwallex Integration

Use the `airwallex` integration to work with Airwallex authentication, billing, issuing, payment acceptance, payouts, reporting, Scale connected accounts, sandbox simulations, file upload, transactional FX, and treasury APIs.

This package is generated from Airwallex's official public Postman collection linked from the Airwallex API quickstart docs. It exposes 201 unique Airwallex endpoints from the `Airwallex Public API v2025-11-11` collection. Duplicate examples that map to the same HTTP method and path are intentionally de-duplicated into one endpoint tool.

## Authentication

- `airwallex_authentication_obtain_access_token` calls `/api/v1/authentication/login` with `x-client-id` and `x-api-key` headers.
- Runtime tools use `Authorization: Bearer <access_token>`.
- Airwallex access tokens expire quickly. Reuse the token until its `expires_at` value, then call the login tool again.
- `url` defaults to `https://api-demo.airwallex.com`; `file_url` defaults to `https://files-demo.airwallex.com`.

## Request Shape

Path, query, and optional Airwallex headers are exposed as snake_case tool parameters. JSON and multipart request bodies are passed through the `body` object and should match the Airwallex API request shape for that endpoint. Multipart file fields may be local file paths.

## Return Shape

JSON responses are returned as decoded arrays/objects from Airwallex. Empty successful responses return `{ success = true, status = <http_status>, location = <location_header> }` when a Location header is present.

## Examples

```lua
local token = app.integrations.airwallex.authentication_obtain_access_token({})

local account = app.integrations.airwallex.scale_retrieve_account_details({})

local customers = app.integrations.airwallex.billing_get_list_of_blling_customers({
  page_num = "0",
  page_size = "20"
})
```

Use fake account IDs, customer IDs, card IDs, payment IDs, transfer IDs, API keys, client IDs, and access tokens in tests and examples. Never store real Airwallex credentials, customer details, payment details, card data, bank account details, or production account IDs in fixtures or Lua examples.
