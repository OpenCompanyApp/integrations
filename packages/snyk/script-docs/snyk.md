# Snyk JavaScript Docs

Snyk tools are exposed under `app.integrations.snyk`. This package is generated from Snyk's official REST OpenAPI specification and exposes all 277 operations found in that spec.

Configure `api_token`, optionally `url` for the Snyk region, and optionally `version`. The default URL is `https://api.snyk.io/rest`; the default version is `2024-10-15`.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`. The service injects the configured `version` query parameter when a tool call does not provide one.

```js
var groups = app.integrations.snyk.snyk_list_groups({ limit: 25 })
var group = app.integrations.snyk.snyk_get_group({ group_id: 'group-id' })
```
## Coverage Notes

The manifest `snyk-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes. The Snyk REST API uses JSON:API content negotiation and token authentication.

## Representative Tools

- `snyk_get_custom_base_images` - GET `/custom_base_images`
- `snyk_create_custom_base_image` - POST `/custom_base_images`
- `snyk_delete_custom_base_image` - DELETE `/custom_base_images/{custombaseimage_id}`
- `snyk_get_custom_base_image` - GET `/custom_base_images/{custombaseimage_id}`
- `snyk_update_custom_base_image` - PATCH `/custom_base_images/{custombaseimage_id}`
- `snyk_list_groups` - GET `/groups`
- `snyk_get_group` - GET `/groups/{group_id}`
- `snyk_get_app_installs_for_group` - GET `/groups/{group_id}/apps/installs`
- `snyk_create_group_app_install` - POST `/groups/{group_id}/apps/installs`
- `snyk_delete_group_app_install_by_id` - DELETE `/groups/{group_id}/apps/installs/{install_id}`
- `snyk_update_group_app_install_secret` - POST `/groups/{group_id}/apps/installs/{install_id}/secrets`
- `snyk_delete_aliases_in_group` - DELETE `/groups/{group_id}/assets/repository/aliases`
- `snyk_list_repository_aliases_in_group` - GET `/groups/{group_id}/assets/repository/aliases`
- `snyk_create_alias_in_group` - POST `/groups/{group_id}/assets/repository/aliases`
- `snyk_list_assets` - POST `/groups/{group_id}/assets/search`
- `snyk_get_asset` - GET `/groups/{group_id}/assets/{asset_id}`
- `snyk_update_asset` - PATCH `/groups/{group_id}/assets/{asset_id}`
- `snyk_list_related_assets` - GET `/groups/{group_id}/assets/{asset_id}/relationships/assets`
- `snyk_list_asset_projects` - GET `/groups/{group_id}/assets/{asset_id}/relationships/projects`
- `snyk_list_group_audit_logs` - GET `/groups/{group_id}/audit_logs/search`
