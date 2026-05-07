# Google Cloud Functions - Lua API Reference

Google Cloud Functions tools are exposed under `app.integrations.google_cloud_functions`. This package is generated from Google's official Cloud Functions v2 Discovery document and exposes 21 REST methods.

Configure `access_token` with a Google OAuth token that has Cloud Functions or cloud-platform scopes. The default base URL is `https://cloudfunctions.googleapis.com`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `projects/example/locations/us-central1/functions/api`.

## Examples

```lua
local functions = app.integrations.google_cloud_functions.google_cloud_functions_projects_locations_functions_list({
  parent = "projects/example-project/locations/us-central1",
  pageSize = 20
})

local upload = app.integrations.google_cloud_functions.google_cloud_functions_projects_locations_functions_generate_upload_url({
  parent = "projects/example-project/locations/us-central1",
  body = {}
})

local fn = app.integrations.google_cloud_functions.google_cloud_functions_projects_locations_functions_get({
  name = "projects/example-project/locations/us-central1/functions/api"
})
```

## Multi-Account Usage

```lua
app.integrations.google_cloud_functions.google_cloud_functions_projects_locations_functions_list({ parent = "projects/example/locations/us-central1" })
app.integrations.google_cloud_functions.default.google_cloud_functions_projects_locations_functions_list({ parent = "projects/example/locations/us-central1" })
app.integrations.google_cloud_functions.production.google_cloud_functions_projects_locations_functions_list({ parent = "projects/example/locations/us-central1" })
```

## Functions

- `google_cloud_functions_projects_locations_functions_set_iam_policy` - POST /v2/{+resource}:setIamPolicy - Projects Locations Functions Set Iam Policy
- `google_cloud_functions_projects_locations_functions_abort_function_upgrade` - POST /v2/{+name}:abortFunctionUpgrade - Projects Locations Functions Abort Function Upgrade
- `google_cloud_functions_projects_locations_functions_commit_function_upgrade_as_gen2` - POST /v2/{+name}:commitFunctionUpgradeAsGen2 - Projects Locations Functions Commit Function Upgrade As Gen2
- `google_cloud_functions_projects_locations_functions_generate_download_url` - POST /v2/{+name}:generateDownloadUrl - Projects Locations Functions Generate Download Url
- `google_cloud_functions_projects_locations_functions_setup_function_upgrade_config` - POST /v2/{+name}:setupFunctionUpgradeConfig - Projects Locations Functions Setup Function Upgrade Config
- `google_cloud_functions_projects_locations_functions_list` - GET /v2/{+parent}/functions - Projects Locations Functions List
- `google_cloud_functions_projects_locations_functions_get` - GET /v2/{+name} - Projects Locations Functions Get
- `google_cloud_functions_projects_locations_functions_create` - POST /v2/{+parent}/functions - Projects Locations Functions Create
- `google_cloud_functions_projects_locations_functions_generate_upload_url` - POST /v2/{+parent}/functions:generateUploadUrl - Projects Locations Functions Generate Upload Url
- `google_cloud_functions_projects_locations_functions_detach_function` - POST /v2/{+name}:detachFunction - Projects Locations Functions Detach Function
- `google_cloud_functions_projects_locations_functions_test_iam_permissions` - POST /v2/{+resource}:testIamPermissions - Projects Locations Functions Test Iam Permissions
- `google_cloud_functions_projects_locations_functions_commit_function_upgrade` - POST /v2/{+name}:commitFunctionUpgrade - Projects Locations Functions Commit Function Upgrade
- `google_cloud_functions_projects_locations_functions_patch` - PATCH /v2/{+name} - Projects Locations Functions Patch
- `google_cloud_functions_projects_locations_functions_rollback_function_upgrade_traffic` - POST /v2/{+name}:rollbackFunctionUpgradeTraffic - Projects Locations Functions Rollback Function Upgrade Traffic
- `google_cloud_functions_projects_locations_functions_get_iam_policy` - GET /v2/{+resource}:getIamPolicy - Projects Locations Functions Get Iam Policy
- `google_cloud_functions_projects_locations_functions_delete` - DELETE /v2/{+name} - Projects Locations Functions Delete
- `google_cloud_functions_projects_locations_functions_redirect_function_upgrade_traffic` - POST /v2/{+name}:redirectFunctionUpgradeTraffic - Projects Locations Functions Redirect Function Upgrade Traffic

## List

- `google_cloud_functions_projects_locations_list` - GET /v2/{+name}/locations - Projects Locations List

## Operations

- `google_cloud_functions_projects_locations_operations_get` - GET /v2/{+name} - Projects Locations Operations Get
- `google_cloud_functions_projects_locations_operations_list` - GET /v2/{+name}/operations - Projects Locations Operations List

## Runtimes

- `google_cloud_functions_projects_locations_runtimes_list` - GET /v2/{+parent}/runtimes - Projects Locations Runtimes List
