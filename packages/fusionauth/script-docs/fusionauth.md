# FusionAuth JavaScript Docs

Namespace: `fusionauth`

FusionAuth exposes the official FusionAuth OpenAPI operation set. Tools are generated one-to-one from the OpenAPI document and preserve the upstream path, query, header, and request-body shape.

## Configuration

Set `api_key` to a FusionAuth API key and `base_url` to the FusionAuth server root, for example `https://fusionauth.example.test`. FusionAuth sends API keys in the `Authorization` header. When an endpoint needs `X-FusionAuth-TenantId`, pass the tool argument `tenant_id`.

## Usage Notes

- Path parameters use snake_case arguments, such as `user_id` for `{userId}` and `application_id` for `{applicationId}`.
- Query parameters preserve FusionAuth names on the wire but use snake_case tool arguments where needed.
- For create, update, patch, search, and action endpoints, pass `body` as an object matching the FusionAuth API request schema.
- Empty FusionAuth responses return `{ success = true, status = <code> }`.
- Use fake tenants, users, and domains in examples and tests. Do not commit production API keys, tenant IDs, or real user emails.

## Examples

```js
var users = fusionauth.fusionauth_retrieve_user({
  email: "agent-test@example.test",
  tenant_id: "tenant-example",
})
```
```js
var created = fusionauth.fusionauth_create_user({
  tenant_id: "tenant-example",
  body: {
    user: {
      email: "agent-test@example.test",
      username: "agent-test",
      password: "example-password",
    },
  },
})
```