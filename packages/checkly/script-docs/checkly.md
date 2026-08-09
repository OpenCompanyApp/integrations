# Checkly JavaScript Tools

Namespace: `checkly`

Generated from Checkly Public API OpenAPI `https://api.checklyhq.com/openapi.json`. Configure `api_key` and `account_id`; runtime requests send both `Authorization: Bearer <api_key>` and `X-Checkly-Account: <account_id>`.

## Coverage

- Paths: 117
- Tools: 164
- Read tools: 84
- Write tools: 80
- Account-header operations: 151

## Usage Notes

- Path and query parameters use snake_case tool keys and are sent with official API names.
- JSON request payloads go in `body`.
- The account header is configured once as `account_id`; agents do not need to repeat it per tool call.

## Example JavaScript

```js
var checks = checkly.checkly_get_v1_checks({})
var account = checkly.checkly_get_v1_accounts_me({})
```