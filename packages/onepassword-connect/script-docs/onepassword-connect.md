# 1Password Connect JavaScript Tools

Namespace: `onepassword-connect`

Generated from the official 1Password Connect API specification file version 1.8.1. Configure `url` with the Connect Server API base URL, usually `http://localhost:8080/v1`, and `api_token` with a Connect access token.

## Coverage

- Paths: 11
- Tools: 15
- Read tools: 11
- Write tools: 4

## Usage Notes

- Path and query parameters use snake_case tool keys and are sent with official API names.
- JSON request payloads for create, update, and patch operations go in `body`.
- File content endpoints may return non-JSON data; non-JSON responses are returned as `{ body = ..., status = ... }`.

## Example JavaScript

```js
var vaults = onepassword_connect.onepassword_connect_get_vaults({})
var items = onepassword_connect.onepassword_connect_get_vault_items({ vault_uuid: "vault-id" })
```