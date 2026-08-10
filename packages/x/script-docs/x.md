# Twitter / X — JavaScript API Reference

This integration is generated from the official X OpenAPI document version `2.162` and exposes 162 X API operations.

## Authentication

Configure one or more credential modes:

- `bearer_token` for app-only public reads.
- `access_token` for OAuth 2.0 user-context operations.
- `api_key`, `api_secret`, `access_token`, and `access_token_secret` for OAuth 1.0a user-context operations.

Each tool carries `auth_modes`, `required_scopes`, and `runtime_mode` metadata in the generated catalog.

## Runtime Notes

- Tools marked `stream` require a host streaming runner.
- Tools marked `webhook_subscription` require a public callback endpoint.
- Enterprise or approved-access endpoints return clear API errors if the configured X account lacks access.

## Examples

```js
var me = app.integrations.x.x_get_users_me({})
var user = app.integrations.x.x_get_users_by_username({ username: "XDevelopers" })
```
For multi-account hosts:

```js
app.integrations.x.default.x_find_my_user({})
app.integrations.x.work.x_find_my_user({})
```