# Databricks JavaScript API

Generated from the official `databricks-sdk-go` REST surface, which Databricks marks as generated from OpenAPI specs. The namespace is `app.integrations.databricks`.

This package exposes 1098 endpoint-specific tools: 443 read tools and 655 write tools. Configure `url` with the workspace or account host and `api_token` with a Databricks token. Optional `account_id` and `workspace_id` values are used for account-level paths and the `X-Databricks-Org-Id` header.

## Usage

```js
var me = app.integrations.databricks.databricks_iam_me({})

var jobs = app.integrations.databricks.databricks_jobs_list({
  query: { limit: 25 },
})
```
## Request Shape

Path parameters are top-level snake_case fields, for example `job_id` or `app_name`. Query string values go under `query`; JSON request payloads go under `body`; uncommon additional headers go under `headers`.

## Example Tools

| `databricks_agentbricks_create_custom_llm` | write | POST `/api/2.0/custom-llms` |
| `databricks_agentbricks_delete_custom_llm` | write | DELETE `/api/2.0/custom-llms/{id}` |
| `databricks_agentbricks_get_custom_llm` | read | GET `/api/2.0/custom-llms/{id}` |
| `databricks_agentbricks_update_custom_llm` | write | PATCH `/api/2.0/custom-llms/{id}` |
| `databricks_agentbricks_start_optimize` | write | POST `/api/2.0/custom-llms/{id}/optimize` |
| `databricks_agentbricks_cancel_optimize` | write | POST `/api/2.0/custom-llms/{id}/optimize/cancel` |
| `databricks_apps_create_space` | write | POST `/api/2.0/app-spaces` |
| `databricks_apps_list_spaces` | read | GET `/api/2.0/app-spaces` |
| `databricks_apps_delete_space` | write | DELETE `/api/2.0/app-spaces/{name}` |
| `databricks_apps_get_space` | read | GET `/api/2.0/app-spaces/{name}` |
| `databricks_apps_update_space` | write | PATCH `/api/2.0/app-spaces/{name}` |
| `databricks_apps_get_space_operation` | read | GET `/api/2.0/app-spaces/{name}/operation` |
| `databricks_apps_create` | write | POST `/api/2.0/apps` |
| `databricks_apps_list` | read | GET `/api/2.0/apps` |
| `databricks_apps_create_custom_template` | write | POST `/api/2.0/apps-settings/templates` |
| `databricks_apps_list_custom_templates` | read | GET `/api/2.0/apps-settings/templates` |
| `databricks_apps_delete_custom_template` | write | DELETE `/api/2.0/apps-settings/templates/{name}` |
| `databricks_apps_get_custom_template` | read | GET `/api/2.0/apps-settings/templates/{name}` |
| `databricks_apps_update_custom_template` | write | PUT `/api/2.0/apps-settings/templates/{name}` |
| `databricks_apps_deploy` | write | POST `/api/2.0/apps/{app_name}/deployments` |
| `databricks_apps_list_deployments` | read | GET `/api/2.0/apps/{app_name}/deployments` |
| `databricks_apps_get_deployment` | read | GET `/api/2.0/apps/{app_name}/deployments/{deployment_id}` |
| `databricks_apps_create_update` | write | POST `/api/2.0/apps/{app_name}/update` |
| `databricks_apps_get_update` | read | GET `/api/2.0/apps/{app_name}/update` |
| `databricks_apps_delete` | write | DELETE `/api/2.0/apps/{name}` |
| `databricks_apps_get` | read | GET `/api/2.0/apps/{name}` |
| `databricks_apps_update` | write | PATCH `/api/2.0/apps/{name}` |
| `databricks_apps_start` | write | POST `/api/2.0/apps/{name}/start` |
| `databricks_apps_stop` | write | POST `/api/2.0/apps/{name}/stop` |
| `databricks_apps_delete_app_thumbnail` | write | DELETE `/api/2.0/apps/{name}/thumbnail` |
| `databricks_apps_update_app_thumbnail` | write | PATCH `/api/2.0/apps/{name}/thumbnail` |
| `databricks_apps_get_permissions` | read | GET `/api/2.0/permissions/apps/{app_name}` |
| `databricks_apps_set_permissions` | write | PUT `/api/2.0/permissions/apps/{app_name}` |
| `databricks_apps_update_permissions` | write | PATCH `/api/2.0/permissions/apps/{app_name}` |
| `databricks_apps_get_permission_levels` | read | GET `/api/2.0/permissions/apps/{app_name}/permissionLevels` |
| `databricks_billing_create_4` | write | POST `/api/2.0/accounts/{account_id}/dashboard` |
| `databricks_billing_get_4` | read | GET `/api/2.0/accounts/{account_id}/dashboard` |
| `databricks_billing_create_3` | write | POST `/api/2.0/accounts/{account_id}/log-delivery` |
| `databricks_billing_list_3` | read | GET `/api/2.0/accounts/{account_id}/log-delivery` |
| `databricks_billing_get_3` | read | GET `/api/2.0/accounts/{account_id}/log-delivery/{log_delivery_configuration_id}` |


## Notes

- Databricks APIs are host-specific; set `url` to your workspace or account host.
- Authentication uses `Authorization: Bearer <api_token>`.
- Account paths can use configured `account_id`; callers can also pass `account_id` explicitly where a path requires it.
- Returned data is the parsed JSON response from Databricks.
