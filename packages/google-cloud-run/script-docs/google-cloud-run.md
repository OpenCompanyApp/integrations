# Google Cloud Run - JavaScript API Reference

Google Cloud Run tools are exposed under `app.integrations.google_cloud_run`. This package is generated from Google's official Cloud Run v2 Discovery document and exposes 58 REST methods.

Configure `access_token` with a Google OAuth token that has Cloud Run scopes such as `https://www.googleapis.com/auth/cloud-platform`. The default base URL is `https://run.googleapis.com`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `projects/example/locations/us-central1/services/api`.

## Examples

```js
var services = app.integrations.google_cloud_run.google_cloud_run_projects_locations_services_list({
  parent: "projects/example-project/locations/us-central1",
  pageSize: 20,
})

var service = app.integrations.google_cloud_run.google_cloud_run_projects_locations_services_get({
  name: "projects/example-project/locations/us-central1/services/api",
})

var run = app.integrations.google_cloud_run.google_cloud_run_projects_locations_jobs_run({
  name: "projects/example-project/locations/us-central1/jobs/importer",
  body: {},
})
```
## Multi-Account Usage

```js
app.integrations.google_cloud_run.google_cloud_run_projects_locations_services_list({ parent: "projects/example/locations/us-central1" })
app.integrations.google_cloud_run.default.google_cloud_run_projects_locations_services_list({ parent: "projects/example/locations/us-central1" })
app.integrations.google_cloud_run.production.google_cloud_run_projects_locations_services_list({ parent: "projects/example/locations/us-central1" })
```
## Builds

- `google_cloud_run_projects_locations_builds_submit` - POST /v2/{+parent}/builds:submit - Projects Locations Builds Submit

## Export Image

- `google_cloud_run_projects_locations_export_image` - POST /v2/{+name}:exportImage - Projects Locations Export Image

## Export Image Metadata

- `google_cloud_run_projects_locations_export_image_metadata` - GET /v2/{+name}:exportImageMetadata - Projects Locations Export Image Metadata

## Export Metadata

- `google_cloud_run_projects_locations_export_metadata` - GET /v2/{+name}:exportMetadata - Projects Locations Export Metadata

## Export Project Metadata

- `google_cloud_run_projects_locations_export_project_metadata` - GET /v2/{+name}:exportProjectMetadata - Projects Locations Export Project Metadata

## Instances

- `google_cloud_run_projects_locations_instances_get_iam_policy` - GET /v2/{+resource}:getIamPolicy - Projects Locations Instances Get Iam Policy
- `google_cloud_run_projects_locations_instances_stop` - POST /v2/{+name}:stop - Projects Locations Instances Stop
- `google_cloud_run_projects_locations_instances_set_iam_policy` - POST /v2/{+resource}:setIamPolicy - Projects Locations Instances Set Iam Policy
- `google_cloud_run_projects_locations_instances_start` - POST /v2/{+name}:start - Projects Locations Instances Start
- `google_cloud_run_projects_locations_instances_patch` - PATCH /v2/{+name} - Projects Locations Instances Patch
- `google_cloud_run_projects_locations_instances_create` - POST /v2/{+parent}/instances - Projects Locations Instances Create
- `google_cloud_run_projects_locations_instances_test_iam_permissions` - POST /v2/{+resource}:testIamPermissions - Projects Locations Instances Test Iam Permissions
- `google_cloud_run_projects_locations_instances_delete` - DELETE /v2/{+name} - Projects Locations Instances Delete
- `google_cloud_run_projects_locations_instances_list` - GET /v2/{+parent}/instances - Projects Locations Instances List
- `google_cloud_run_projects_locations_instances_get` - GET /v2/{+name} - Projects Locations Instances Get

## Jobs

- `google_cloud_run_projects_locations_jobs_create` - POST /v2/{+parent}/jobs - Projects Locations Jobs Create
- `google_cloud_run_projects_locations_jobs_test_iam_permissions` - POST /v2/{+resource}:testIamPermissions - Projects Locations Jobs Test Iam Permissions
- `google_cloud_run_projects_locations_jobs_patch` - PATCH /v2/{+name} - Projects Locations Jobs Patch
- `google_cloud_run_projects_locations_jobs_get` - GET /v2/{+name} - Projects Locations Jobs Get
- `google_cloud_run_projects_locations_jobs_list` - GET /v2/{+parent}/jobs - Projects Locations Jobs List
- `google_cloud_run_projects_locations_jobs_delete` - DELETE /v2/{+name} - Projects Locations Jobs Delete
- `google_cloud_run_projects_locations_jobs_get_iam_policy` - GET /v2/{+resource}:getIamPolicy - Projects Locations Jobs Get Iam Policy
- `google_cloud_run_projects_locations_jobs_run` - POST /v2/{+name}:run - Projects Locations Jobs Run
- `google_cloud_run_projects_locations_jobs_set_iam_policy` - POST /v2/{+resource}:setIamPolicy - Projects Locations Jobs Set Iam Policy
- `google_cloud_run_projects_locations_jobs_executions_export_status` - GET /v2/{+name}/{+operationId}:exportStatus - Projects Locations Jobs Executions Export Status
- `google_cloud_run_projects_locations_jobs_executions_cancel` - POST /v2/{+name}:cancel - Projects Locations Jobs Executions Cancel
- `google_cloud_run_projects_locations_jobs_executions_list` - GET /v2/{+parent}/executions - Projects Locations Jobs Executions List
- `google_cloud_run_projects_locations_jobs_executions_delete` - DELETE /v2/{+name} - Projects Locations Jobs Executions Delete
- `google_cloud_run_projects_locations_jobs_executions_get` - GET /v2/{+name} - Projects Locations Jobs Executions Get
- `google_cloud_run_projects_locations_jobs_executions_tasks_get` - GET /v2/{+name} - Projects Locations Jobs Executions Tasks Get
- `google_cloud_run_projects_locations_jobs_executions_tasks_list` - GET /v2/{+parent}/tasks - Projects Locations Jobs Executions Tasks List

## Operations

- `google_cloud_run_projects_locations_operations_get` - GET /v2/{+name} - Projects Locations Operations Get
- `google_cloud_run_projects_locations_operations_wait` - POST /v2/{+name}:wait - Projects Locations Operations Wait
- `google_cloud_run_projects_locations_operations_list` - GET /v2/{+name}/operations - Projects Locations Operations List
- `google_cloud_run_projects_locations_operations_delete` - DELETE /v2/{+name} - Projects Locations Operations Delete

## Services

- `google_cloud_run_projects_locations_services_list` - GET /v2/{+parent}/services - Projects Locations Services List
- `google_cloud_run_projects_locations_services_delete` - DELETE /v2/{+name} - Projects Locations Services Delete
- `google_cloud_run_projects_locations_services_set_iam_policy` - POST /v2/{+resource}:setIamPolicy - Projects Locations Services Set Iam Policy
- `google_cloud_run_projects_locations_services_get` - GET /v2/{+name} - Projects Locations Services Get
- `google_cloud_run_projects_locations_services_get_iam_policy` - GET /v2/{+resource}:getIamPolicy - Projects Locations Services Get Iam Policy
- `google_cloud_run_projects_locations_services_patch` - PATCH /v2/{+name} - Projects Locations Services Patch
- `google_cloud_run_projects_locations_services_create` - POST /v2/{+parent}/services - Projects Locations Services Create
- `google_cloud_run_projects_locations_services_test_iam_permissions` - POST /v2/{+resource}:testIamPermissions - Projects Locations Services Test Iam Permissions
- `google_cloud_run_projects_locations_services_revisions_get` - GET /v2/{+name} - Projects Locations Services Revisions Get
- `google_cloud_run_projects_locations_services_revisions_export_status` - GET /v2/{+name}/{+operationId}:exportStatus - Projects Locations Services Revisions Export Status
- `google_cloud_run_projects_locations_services_revisions_list` - GET /v2/{+parent}/revisions - Projects Locations Services Revisions List
- `google_cloud_run_projects_locations_services_revisions_delete` - DELETE /v2/{+name} - Projects Locations Services Revisions Delete

## Worker Pools

- `google_cloud_run_projects_locations_worker_pools_patch` - PATCH /v2/{+name} - Projects Locations Worker Pools Patch
- `google_cloud_run_projects_locations_worker_pools_get_iam_policy` - GET /v2/{+resource}:getIamPolicy - Projects Locations Worker Pools Get Iam Policy
- `google_cloud_run_projects_locations_worker_pools_create` - POST /v2/{+parent}/workerPools - Projects Locations Worker Pools Create
- `google_cloud_run_projects_locations_worker_pools_test_iam_permissions` - POST /v2/{+resource}:testIamPermissions - Projects Locations Worker Pools Test Iam Permissions
- `google_cloud_run_projects_locations_worker_pools_set_iam_policy` - POST /v2/{+resource}:setIamPolicy - Projects Locations Worker Pools Set Iam Policy
- `google_cloud_run_projects_locations_worker_pools_list` - GET /v2/{+parent}/workerPools - Projects Locations Worker Pools List
- `google_cloud_run_projects_locations_worker_pools_delete` - DELETE /v2/{+name} - Projects Locations Worker Pools Delete
- `google_cloud_run_projects_locations_worker_pools_get` - GET /v2/{+name} - Projects Locations Worker Pools Get
- `google_cloud_run_projects_locations_worker_pools_revisions_get` - GET /v2/{+name} - Projects Locations Worker Pools Revisions Get
- `google_cloud_run_projects_locations_worker_pools_revisions_list` - GET /v2/{+parent}/revisions - Projects Locations Worker Pools Revisions List
- `google_cloud_run_projects_locations_worker_pools_revisions_delete` - DELETE /v2/{+name} - Projects Locations Worker Pools Revisions Delete
