# OpenFGA Ruby Tools

Namespace: `openfga`

Generated from the official OpenFGA Swagger document in `openfga/api`. Configure `url` with the OpenFGA server base URL and optionally `api_token` for bearer-token protected deployments.

## Coverage

- Paths: 20
- Tools: 24
- Read tools: 7
- Write tools: 17

## Usage Notes

- Path and query parameters use snake_case tool keys and are sent with official API names.
- JSON request payloads go in `body`.
- Empty optional query parameters are omitted.

## Example Ruby

```ruby
stores = app.integrations.openfga.list_stores(page_size: 25)
allowed = app.integrations.openfga.check(store_id: "01HV...", body: {tuple_key: {user: "user:anne", relation: "viewer", object: "document:roadmap"}})
```