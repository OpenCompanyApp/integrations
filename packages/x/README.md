# Twitter / X Integration

Generated integration for the official X API. It covers 162 operations from X OpenAPI version `2.162`.

Use this package for organic X surfaces: posts, users, DMs, chat, lists, media, streams, webhooks, compliance, spaces, trends, communities, and usage. Advertising workflows belong in `opencompanyapp/integration-x-ads`.

## Authentication

- Bearer token for app-only public read endpoints.
- OAuth 2.0 user access token for user-context reads and writes.
- OAuth 1.0a API key/secret plus access token/secret for `UserToken` endpoints.

Streaming tools are exposed with `runtime_mode=stream` and require host streaming support.
Webhook/account-activity tools require a public callback endpoint.