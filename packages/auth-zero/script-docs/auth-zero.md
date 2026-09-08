# Auth0 — Ruby API Supplement

Namespace: `app.integrations["auth-zero"]`

This integration targets the Auth0 Management API v2. Configure a tenant domain such as `tenant.us.auth0.com` and a Management API access token whose audience is `https://tenant.us.auth0.com/api/v2/`.

## Users

```ruby
users = app.call("integrations.auth-zero.list_users", per_page: 25, q: "email:*@example.test", sort: "created_at:-1")
user = app.call("integrations.auth-zero.get_user", id: "auth0|507f1f77bcf86cd799439010")
created = app.call("integrations.auth-zero.create_user", email: "jane@example.test", password: "fake-password-123", connection: "Username-Password-Authentication", name: "Jane Example")
```
`create_user` requires Auth0 scopes such as `create:users` and only works for connections where the token is allowed to create users.

## Tenant Metadata

```ruby
connections = app.call("integrations.auth-zero.list_connections", strategy: "auth0")
roles = app.call("integrations.auth-zero.list_roles", page: 0, per_page: 50)
settings = app.call("integrations.auth-zero.get_tenant_settings")
```
## Health Check

The historical `get_current_user` tool now performs a Management API health check by retrieving tenant settings. Management API tokens are commonly machine-to-machine tokens and do not reliably map to a `/users/me` profile.

```ruby
health = app.call("integrations.auth-zero.health_check")
puts(health._health_check)
```
## Multi-Account Usage

```ruby
app.call("integrations.auth-zero.list_users")
app.call("integrations.auth-zero.default.list_users")
app.call("integrations.auth-zero.production.list_users")
```