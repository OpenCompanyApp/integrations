# Airbyte JavaScript Docs

Airbyte tools are exposed under `app.integrations.airbyte`. This package is generated from Airbyte's official OpenAPI specification and exposes all 37 operations found in that spec.

Configure `access_token` and optionally `url`. The default URL is `https://api.airbyte.com/v1`; self-managed hosts can use their public API base URL.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`.

```js
var health = app.integrations.airbyte.airbyte_get_health_check({})
var connections = app.integrations.airbyte.airbyte_list_connections({ workspace_ids: [ 'workspace-id' ] })
```
## Coverage Notes

The manifest `airbyte-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes.

## Representative Tools

- `airbyte_get_health_check` - GET `/health`
- `airbyte_list_jobs` - GET `/jobs`
- `airbyte_create_job` - POST `/jobs`
- `airbyte_get_job` - GET `/jobs/{jobId}`
- `airbyte_cancel_job` - DELETE `/jobs/{jobId}`
- `airbyte_list_sources` - GET `/sources`
- `airbyte_create_source` - POST `/sources`
- `airbyte_get_source` - GET `/sources/{sourceId}`
- `airbyte_patch_source` - PATCH `/sources/{sourceId}`
- `airbyte_put_source` - PUT `/sources/{sourceId}`
- `airbyte_delete_source` - DELETE `/sources/{sourceId}`
- `airbyte_list_destinations` - GET `/destinations`
- `airbyte_create_destination` - POST `/destinations`
- `airbyte_get_destination` - GET `/destinations/{destinationId}`
- `airbyte_delete_destination` - DELETE `/destinations/{destinationId}`
- `airbyte_patch_destination` - PATCH `/destinations/{destinationId}`
- `airbyte_put_destination` - PUT `/destinations/{destinationId}`
- `airbyte_initiate_oauth` - POST `/sources/initiateOAuth`
- `airbyte_create_connection` - POST `/connections`
- `airbyte_list_connections` - GET `/connections`
