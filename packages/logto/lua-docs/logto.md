# Logto Lua Docs

Namespace: `logto`

Logto exposes the official Management API operation set. Tools are generated one-to-one from the public Logto OpenAPI source and preserve upstream path, query, header, and request-body shapes.

## Configuration

Provide either a pre-issued `access_token` or a machine-to-machine `client_id` and `client_secret`. Set `base_url` to the tenant root, for example `https://tenant.logto.app`. When using client credentials, the service exchanges a token at `/oidc/token` with `resource = <base_url>/api` and `scope = all` unless overridden.

## Usage Notes

- Path parameters use snake_case tool arguments, such as `user_id`, `application_id`, or `organization_id`.
- Query parameters preserve Logto names on the wire but use snake_case arguments where needed.
- For create, patch, replace, and action endpoints, pass `body` as an object matching the Logto API request schema.
- Empty responses return `{ success = true, status = <code> }`.
- Use fake tenants, users, apps, and domains in tests and examples.

## Examples

```lua
local users = logto.logto_list_users({
  page = 1,
  page_size = 20,
})
```

```lua
local created = logto.logto_create_user({
  body = {
    primaryEmail = "agent-test@example.test",
    name = "Agent Test",
  },
})
```