# dbt Cloud JavaScript API

Generated from the official dbt Labs OpenAPI repository (`dbt-labs/dbt-cloud-openapi-spec`) using both `openapi-v2.yaml` and `openapi-v3.yaml`. The namespace is `app.integrations["dbt-cloud"]`.

This package exposes 202 endpoint-specific tools: 97 read tools and 105 write tools. Tool names are version-prefixed (`v2` or `v3`) to keep dbt Cloud API generations explicit.

## Usage

```js
var accounts = app.integrations["dbt-cloud"].v3_list_accounts({})

var job = app.integrations["dbt-cloud"].v3_retrieve_job({
  account_id: 12345,
  id: 67890,
})
```
## Request Bodies

Tools that create, update, patch, or delete resources may accept a `body` table. The table is passed as the JSON body expected by the dbt Cloud OpenAPI schema. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Example Tools

| `dbt_cloud_v2_list_accounts` | read | GET `/api/v2/accounts/` |
| `dbt_cloud_v2_retrieve_account` | read | GET `/api/v2/accounts/{account_id}/` |
| `dbt_cloud_v2_update_account` | write | POST `/api/v2/accounts/{account_id}/` |
| `dbt_cloud_v2_partial_update_account` | write | PATCH `/api/v2/accounts/{account_id}/` |
| `dbt_cloud_v2_list_ssh_tunnels` | read | GET `/api/v2/accounts/{account_id}/encryptions/` |
| `dbt_cloud_v2_create_ssh_tunnel` | write | POST `/api/v2/accounts/{account_id}/encryptions/` |
| `dbt_cloud_v2_retrieve_ssh_tunnel` | read | GET `/api/v2/accounts/{account_id}/encryptions/{id}/` |
| `dbt_cloud_v2_update_ssh_tunnel` | write | POST `/api/v2/accounts/{account_id}/encryptions/{id}/` |
| `dbt_cloud_v2_destroy_ssh_tunnel` | write | DELETE `/api/v2/accounts/{account_id}/encryptions/{id}/` |
| `dbt_cloud_v2_list_environments` | read | GET `/api/v2/accounts/{account_id}/environments/` |
| `dbt_cloud_v2_create_environment` | write | POST `/api/v2/accounts/{account_id}/environments/` |
| `dbt_cloud_v2_retrieve_environment` | read | GET `/api/v2/accounts/{account_id}/environments/{id}/` |
| `dbt_cloud_v2_update_environment` | write | POST `/api/v2/accounts/{account_id}/environments/{id}/` |
| `dbt_cloud_v2_destroy_environment` | write | DELETE `/api/v2/accounts/{account_id}/environments/{id}/` |
| `dbt_cloud_v2_list_invites` | read | GET `/api/v2/accounts/{account_id}/invites/` |
| `dbt_cloud_v2_retrieve_invite` | read | GET `/api/v2/accounts/{account_id}/invites/{id}/` |
| `dbt_cloud_v2_list_jobs` | read | GET `/api/v2/accounts/{account_id}/jobs/` |
| `dbt_cloud_v2_create_job` | write | POST `/api/v2/accounts/{account_id}/jobs/` |


## Notes

- The base URL defaults to `https://cloud.getdbt.com`; set `url` for EMEA, AU, or account-prefix hosts.
- Authentication uses the OpenAPI bearer token scheme.
- Returned data is the parsed JSON response from dbt Cloud, preserving upstream response fields.
