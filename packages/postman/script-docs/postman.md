# Postman

Namespace: `postman`

Use Postman tools to manage workspaces, collections, environments, global variables, APIs/specifications, API versions and schemas, mock servers, monitors, collection webhooks, users, groups, workspace roles, and billing metadata.

Postman authenticates with an API key in the `X-Api-Key` header.

Some Enterprise and Professional endpoints are plan-gated by Postman. If a tool receives a 403 or 404, treat it as an availability signal rather than assuming the resource does not exist.

JSON responses are returned as `{ status = 200, data = { ... } }`. Empty successful responses return `{ status = 204, success = true }`.

Use `postman_api_get`, `postman_api_post`, `postman_api_put`, `postman_api_patch`, and `postman_api_delete` for plan-specific Postman API paths not represented by a named tool, such as governance, audit logs, tags, SCIM, or secret-scanner endpoints. Raw paths must be relative, for example `/collections`; absolute URLs are rejected.
