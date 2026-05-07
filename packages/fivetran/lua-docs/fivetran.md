# Fivetran Lua Docs

Fivetran tools are exposed under `app.integrations.fivetran`. This package is generated from Fivetran's official OpenAPI definition and exposes all 161 operations found in that spec.

Configure `api_key`, `api_secret`, and optionally `url`. The default URL is `https://api.fivetran.com`.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`.

```lua
local account = app.integrations.fivetran.fivetran_get_account_info({})
local connections = app.integrations.fivetran.fivetran_list_connections({ limit = 25 })
```

## Coverage Notes

The manifest `fivetran-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes. Basic authentication uses the Fivetran API key as username and API secret as password.

## Representative Tools

- `fivetran_delete_user` - DELETE `/v1/users/{id}`
- `fivetran_get_user_memberships_in_groups` - GET `/v1/users/{userId}/groups`
- `fivetran_add_user_membership_in_group` - POST `/v1/users/{userId}/groups`
- `fivetran_group_details` - GET `/v1/groups/{groupId}`
- `fivetran_delete_group` - DELETE `/v1/groups/{groupId}`
- `fivetran_modify_group` - PATCH `/v1/groups/{groupId}`
- `fivetran_get_account_info` - GET `/v1/account/info`
- `fivetran_get_hybrid_deployment_agent_list` - GET `/v1/hybrid-deployment-agents`
- `fivetran_create_hybrid_deployment_agent` - POST `/v1/hybrid-deployment-agents`
- `fivetran_get_team_memberships_in_groups` - GET `/v1/teams/{teamId}/groups`
- `fivetran_add_team_membership_in_group` - POST `/v1/teams/{teamId}/groups`
- `fivetran_metadata_connectors` - GET `/v1/metadata/connector-types`
- `fivetran_re_auth_hybrid_deployment_agent` - PATCH `/v1/hybrid-deployment-agents/{agentId}/re-auth`
- `fivetran_get_team_membership_in_group` - GET `/v1/teams/{teamId}/groups/{groupId}`
- `fivetran_delete_team_membership_in_group` - DELETE `/v1/teams/{teamId}/groups/{groupId}`
- `fivetran_update_team_membership_in_group` - PATCH `/v1/teams/{teamId}/groups/{groupId}`
- `fivetran_rotate_system_key` - POST `/v1/system-keys/{keyId}/rotate`
- `fivetran_get_connection_fingerprints_list` - GET `/v1/connections/{connectionId}/fingerprints`
- `fivetran_approve_connection_fingerprint` - POST `/v1/connections/{connectionId}/fingerprints`
- `fivetran_transformation_package_metadata_list` - GET `/v1/transformations/package-metadata`
