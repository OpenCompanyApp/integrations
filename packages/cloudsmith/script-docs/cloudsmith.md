# Cloudsmith JavaScript API

Generated from Cloudsmith's official OpenAPI 2.0 schema served at `https://api.cloudsmith.io/?format=openapi`. The namespace is `app.integrations.cloudsmith`.

This package exposes 349 endpoint-specific tools: 120 read tools and 229 write tools. Configure `api_token` with a Cloudsmith API token.

## Usage

```js
var me = app.integrations.cloudsmith.user_self({})

var packages = app.integrations.cloudsmith.packages_list({
  owner: 'example',
  repo: 'repo',
  page: 1,
  page_size: 50,
})
```
## Request Bodies

Create, update, upload, and validation endpoints may accept a `body` table matching the Cloudsmith OpenAPI schema. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Example Tools

| `cloudsmith_audit_log_namespace_list` | read | GET `/audit-log/{owner}/` |
| `cloudsmith_audit_log_repo_list` | read | GET `/audit-log/{owner}/{repo}/` |
| `cloudsmith_badges_version_list` | read | GET `/badges/version/{owner}/{repo}/{package_format}/{package_name}/{package_version}/{package_identifiers}/` |
| `cloudsmith_broadcasts_create_broadcast_token` | write | POST `/broadcasts/{org}/broadcast-token/` |
| `cloudsmith_bulk_action` | write | POST `/bulk-action/{owner}/` |
| `cloudsmith_distros_list` | read | GET `/distros/` |
| `cloudsmith_distros_read` | read | GET `/distros/{slug}/` |
| `cloudsmith_entitlements_list` | read | GET `/entitlements/{owner}/{repo}/` |
| `cloudsmith_entitlements_create` | write | POST `/entitlements/{owner}/{repo}/` |
| `cloudsmith_entitlements_sync` | write | POST `/entitlements/{owner}/{repo}/sync/` |
| `cloudsmith_entitlements_read` | read | GET `/entitlements/{owner}/{repo}/{identifier}/` |
| `cloudsmith_entitlements_partial_update` | write | PATCH `/entitlements/{owner}/{repo}/{identifier}/` |
| `cloudsmith_entitlements_delete` | write | DELETE `/entitlements/{owner}/{repo}/{identifier}/` |
| `cloudsmith_entitlements_disable` | write | POST `/entitlements/{owner}/{repo}/{identifier}/disable/` |
| `cloudsmith_entitlements_enable` | write | POST `/entitlements/{owner}/{repo}/{identifier}/enable/` |
| `cloudsmith_entitlements_refresh` | write | POST `/entitlements/{owner}/{repo}/{identifier}/refresh/` |
| `cloudsmith_entitlements_reset` | write | POST `/entitlements/{owner}/{repo}/{identifier}/reset/` |
| `cloudsmith_entitlements_toggle_private_broadcasts` | write | POST `/entitlements/{owner}/{repo}/{identifier}/toggle-private-broadcasts/` |
| `cloudsmith_files_create` | write | POST `/files/{owner}/{repo}/` |
| `cloudsmith_files_validate` | write | POST `/files/{owner}/{repo}/validate/` |
| `cloudsmith_files_abort` | write | POST `/files/{owner}/{repo}/{identifier}/abort/` |
| `cloudsmith_files_complete` | write | POST `/files/{owner}/{repo}/{identifier}/complete/` |
| `cloudsmith_files_info` | read | GET `/files/{owner}/{repo}/{identifier}/info/` |
| `cloudsmith_formats_list` | read | GET `/formats/` |
| `cloudsmith_formats_read` | read | GET `/formats/{slug}/` |
| `cloudsmith_metrics_entitlements_account_list` | read | GET `/metrics/entitlements/{owner}/` |
| `cloudsmith_metrics_entitlements_repo_list` | read | GET `/metrics/entitlements/{owner}/{repo}/` |
| `cloudsmith_metrics_packages_list` | read | GET `/metrics/packages/{owner}/{repo}/` |
| `cloudsmith_namespaces_list` | read | GET `/namespaces/` |
| `cloudsmith_namespaces_read` | read | GET `/namespaces/{slug}/` |
| `cloudsmith_orgs_list` | read | GET `/orgs/` |
| `cloudsmith_orgs_read` | read | GET `/orgs/{org}/` |
| `cloudsmith_orgs_delete` | write | DELETE `/orgs/{org}/` |
| `cloudsmith_orgs_deny_policy_list` | read | GET `/orgs/{org}/deny-policy/` |
| `cloudsmith_orgs_deny_policy_create` | write | POST `/orgs/{org}/deny-policy/` |
| `cloudsmith_orgs_deny_policy_read` | read | GET `/orgs/{org}/deny-policy/{slug_perm}/` |
| `cloudsmith_orgs_deny_policy_update` | write | PUT `/orgs/{org}/deny-policy/{slug_perm}/` |
| `cloudsmith_orgs_deny_policy_partial_update` | write | PATCH `/orgs/{org}/deny-policy/{slug_perm}/` |
| `cloudsmith_orgs_deny_policy_delete` | write | DELETE `/orgs/{org}/deny-policy/{slug_perm}/` |
| `cloudsmith_orgs_invites_list` | read | GET `/orgs/{org}/invites/` |


## Notes

- The base URL defaults to `https://api.cloudsmith.io`.
- Authentication uses `Authorization: token <api_token>`.
- Returned data is the parsed JSON response from Cloudsmith.
