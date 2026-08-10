# WorkOS JavaScript Docs

WorkOS tools are exposed under `app.integrations.workos`. This package is generated from WorkOS's official open-source OpenAPI specification and exposes all 172 operations found in that spec.

Configure `api_key` and optionally `url`. The default URL is `https://api.workos.com`.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`.

```js
var orgs = app.integrations.workos.workos_organizations_list({ limit: 25 })
var user = app.integrations.workos.workos_user_management_users_get({ user_id: "user_123" })
```
## Coverage Notes

The manifest `workos-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes. Some endpoints can use user/session access tokens instead of an API key; configure the appropriate bearer token for those calls.

## Representative Tools

- `workos_api_keys_validate_api_key` - POST `/api_keys/validations`
- `workos_api_keys_delete` - DELETE `/api_keys/{id}`
- `workos_audit_log_validators_list` - GET `/audit_logs/actions`
- `workos_audit_log_validator_versions_create` - POST `/audit_logs/actions/{actionName}/schemas`
- `workos_audit_log_validator_versions_schemas` - GET `/audit_logs/actions/{actionName}/schemas`
- `workos_audit_log_events_create` - POST `/audit_logs/events`
- `workos_audit_log_exports_exports` - POST `/audit_logs/exports`
- `workos_audit_log_exports_export` - GET `/audit_logs/exports/{auditLogExportId}`
- `workos_authentication_challenges_verify` - POST `/auth/challenges/{id}/verify`
- `workos_authentication_factors_create` - POST `/auth/factors/enroll`
- `workos_authentication_factors_get` - GET `/auth/factors/{id}`
- `workos_authentication_factors_delete` - DELETE `/auth/factors/{id}`
- `workos_authentication_factors_challenge` - POST `/auth/factors/{id}/challenge`
- `workos_external_auth_complete_login` - POST `/authkit/oauth2/complete`
- `workos_authorization_check` - POST `/authorization/organization_memberships/{organization_membership_id}/check`
- `workos_authorization_list_resources_for_membership` - GET `/authorization/organization_memberships/{organization_membership_id}/resources`
- `workos_authorization_list_effective_permissions` - GET `/authorization/organization_memberships/{organization_membership_id}/resources/{resource_id}/permissions`
- `workos_authorization_list_effective_permissions_by_external_id` - GET `/authorization/organization_memberships/{organization_membership_id}/resources/{resource_type_slug}/{external_id}/permissions`
