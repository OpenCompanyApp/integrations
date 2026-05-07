# Google BigQuery - Lua API Reference

Google BigQuery tools are exposed under `app.integrations.google_bigquery`. This package is generated from Google's official BigQuery v2 Discovery document and exposes 47 REST methods.

Configure `access_token` with a Google OAuth token that has BigQuery scopes such as `https://www.googleapis.com/auth/bigquery`. The default base URL is `https://bigquery.googleapis.com/bigquery/v2`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. `{+resource}` IAM paths preserve `/`, so pass values like `projects/example/datasets/analytics/tables/events`.

## Examples

```lua
local datasets = app.integrations.google_bigquery.google_bigquery_datasets_list({
  projectId = "example-project",
  maxResults = 50
})

local query = app.integrations.google_bigquery.google_bigquery_jobs_query({
  projectId = "example-project",
  body = {
    query = "select 1 as ok",
    useLegacySql = false
  }
})

local rows = app.integrations.google_bigquery.google_bigquery_tabledata_list({
  projectId = "example-project",
  datasetId = "analytics",
  tableId = "events",
  maxResults = 100
})
```

## Multi-Account Usage

```lua
app.integrations.google_bigquery.google_bigquery_projects_list({})
app.integrations.google_bigquery.default.google_bigquery_projects_list({})
app.integrations.google_bigquery.production.google_bigquery_projects_list({})
```

## Datasets

- `google_bigquery_datasets_delete` - DELETE /projects/{+projectId}/datasets/{+datasetId} - Datasets Delete
- `google_bigquery_datasets_get` - GET /projects/{+projectId}/datasets/{+datasetId} - Datasets Get
- `google_bigquery_datasets_insert` - POST /projects/{+projectId}/datasets - Datasets Insert
- `google_bigquery_datasets_list` - GET /projects/{+projectId}/datasets - Datasets List
- `google_bigquery_datasets_patch` - PATCH /projects/{+projectId}/datasets/{+datasetId} - Datasets Patch
- `google_bigquery_datasets_undelete` - POST /projects/{+projectId}/datasets/{+datasetId}:undelete - Datasets Undelete
- `google_bigquery_datasets_update` - PUT /projects/{+projectId}/datasets/{+datasetId} - Datasets Update

## Jobs

- `google_bigquery_jobs_cancel` - POST /projects/{+projectId}/jobs/{+jobId}/cancel - Jobs Cancel
- `google_bigquery_jobs_delete` - DELETE /projects/{+projectId}/jobs/{+jobId}/delete - Jobs Delete
- `google_bigquery_jobs_get` - GET /projects/{+projectId}/jobs/{+jobId} - Jobs Get
- `google_bigquery_jobs_get_query_results` - GET /projects/{+projectId}/queries/{+jobId} - Jobs Get Query Results
- `google_bigquery_jobs_insert` - POST /projects/{+projectId}/jobs - Jobs Insert
- `google_bigquery_jobs_list` - GET /projects/{+projectId}/jobs - Jobs List
- `google_bigquery_jobs_query` - POST /projects/{+projectId}/queries - Jobs Query

## Models

- `google_bigquery_models_delete` - DELETE /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId} - Models Delete
- `google_bigquery_models_get` - GET /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId} - Models Get
- `google_bigquery_models_list` - GET /projects/{+projectId}/datasets/{+datasetId}/models - Models List
- `google_bigquery_models_patch` - PATCH /projects/{+projectId}/datasets/{+datasetId}/models/{+modelId} - Models Patch

## Projects

- `google_bigquery_projects_get_service_account` - GET /projects/{+projectId}/serviceAccount - Projects Get Service Account
- `google_bigquery_projects_list` - GET /projects - Projects List

## Routines

- `google_bigquery_routines_delete` - DELETE /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId} - Routines Delete
- `google_bigquery_routines_get` - GET /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId} - Routines Get
- `google_bigquery_routines_get_iam_policy` - POST /{+resource}:getIamPolicy - Routines Get Iam Policy
- `google_bigquery_routines_insert` - POST /projects/{+projectId}/datasets/{+datasetId}/routines - Routines Insert
- `google_bigquery_routines_list` - GET /projects/{+projectId}/datasets/{+datasetId}/routines - Routines List
- `google_bigquery_routines_set_iam_policy` - POST /{+resource}:setIamPolicy - Routines Set Iam Policy
- `google_bigquery_routines_test_iam_permissions` - POST /{+resource}:testIamPermissions - Routines Test Iam Permissions
- `google_bigquery_routines_update` - PUT /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId} - Routines Update

## RowAccessPolicies

- `google_bigquery_row_access_policies_batch_delete` - POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies:batchDelete - Row Access Policies Batch Delete
- `google_bigquery_row_access_policies_delete` - DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId} - Row Access Policies Delete
- `google_bigquery_row_access_policies_get` - GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId} - Row Access Policies Get
- `google_bigquery_row_access_policies_get_iam_policy` - POST /{+resource}:getIamPolicy - Row Access Policies Get Iam Policy
- `google_bigquery_row_access_policies_insert` - POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies - Row Access Policies Insert
- `google_bigquery_row_access_policies_list` - GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies - Row Access Policies List
- `google_bigquery_row_access_policies_test_iam_permissions` - POST /{+resource}:testIamPermissions - Row Access Policies Test Iam Permissions
- `google_bigquery_row_access_policies_update` - PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId} - Row Access Policies Update

## Tabledata

- `google_bigquery_tabledata_insert_all` - POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/insertAll - Tabledata Insert All
- `google_bigquery_tabledata_list` - GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/data - Tabledata List

## Tables

- `google_bigquery_tables_delete` - DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId} - Tables Delete
- `google_bigquery_tables_get` - GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId} - Tables Get
- `google_bigquery_tables_get_iam_policy` - POST /{+resource}:getIamPolicy - Tables Get Iam Policy
- `google_bigquery_tables_insert` - POST /projects/{+projectId}/datasets/{+datasetId}/tables - Tables Insert
- `google_bigquery_tables_list` - GET /projects/{+projectId}/datasets/{+datasetId}/tables - Tables List
- `google_bigquery_tables_patch` - PATCH /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId} - Tables Patch
- `google_bigquery_tables_set_iam_policy` - POST /{+resource}:setIamPolicy - Tables Set Iam Policy
- `google_bigquery_tables_test_iam_permissions` - POST /{+resource}:testIamPermissions - Tables Test Iam Permissions
- `google_bigquery_tables_update` - PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId} - Tables Update
