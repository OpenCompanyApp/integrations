# Keycloak JavaScript Docs

Namespace: `keycloak`

Keycloak exposes the official Admin REST API for realm administration. Tools are generated one-to-one from the Keycloak OpenAPI document and keep the upstream path, query, header, and body shape explicit.

## Configuration

Provide an admin bearer token in `access_token` and the Keycloak server root in `base_url`, for example `https://keycloak.example.test`. The connection test also asks for a `realm` because the Admin REST API is realm scoped.

## Usage Notes

- Most tools require `realm`; pass `master` or the tenant realm name explicitly.
- Path parameters with hyphens in the upstream API use snake_case arguments, such as `user_id` for `{user-id}`.
- Query parameters preserve Keycloak behavior but are exposed as snake_case arguments, such as `brief_representation` for `briefRepresentation`.
- For create and update endpoints, pass `body` as an object matching the Keycloak representation schema documented for that endpoint.
- Tool responses are parsed JSON when Keycloak returns JSON. Empty `204` responses return `{ success = true, status = 204 }`.

## Examples

```js
var users = keycloak.keycloak_get_admin_realms_realm_users({
  realm: "master",
  username: "alice",
  exact: true,
  brief_representation: true,
})
```
```js
var created = keycloak.keycloak_post_admin_realms_realm_users({
  realm: "master",
  body: {
    username: "agent-test-user",
    enabled: true,
    email: "agent-test@example.test",
  },
})
```
Use fake domains and test users in examples and test fixtures. Do not put production realms, user emails, or tokens into committed docs.