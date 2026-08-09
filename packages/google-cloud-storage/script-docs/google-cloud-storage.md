# Google Cloud Storage - JavaScript API Reference

Google Cloud Storage tools are exposed under `app.integrations.google_cloud_storage`. This package is generated from Google's official Cloud Storage v1 Discovery document and exposes 82 REST methods.

Configure `access_token` with a Google OAuth token that has Cloud Storage scopes such as `https://www.googleapis.com/auth/devstorage.full_control`. The default base URL is `https://storage.googleapis.com/storage/v1`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Object uploads use the official upload endpoint when `body.file_path` or `body.content` is provided.

## Examples

```js
var buckets = app.integrations.google_cloud_storage.google_cloud_storage_buckets_list({
  project: "example-project",
  maxResults: 50,
})

var objects = app.integrations.google_cloud_storage.google_cloud_storage_objects_list({
  bucket: "example-bucket",
  prefix: "logs/",
})

var uploaded = app.integrations.google_cloud_storage.google_cloud_storage_objects_insert({
  bucket: "example-bucket",
  name: "hello.txt",
  body: { content: "hello", content_type: "text/plain" },
})
```
## Multi-Account Usage

```js
app.integrations.google_cloud_storage.google_cloud_storage_buckets_list({ project: "example-project" })
app.integrations.google_cloud_storage.default.google_cloud_storage_buckets_list({ project: "example-project" })
app.integrations.google_cloud_storage.production.google_cloud_storage_buckets_list({ project: "example-project" })
```
## Anywhere Caches

- `google_cloud_storage_anywhere_caches_insert` - POST /b/{bucket}/anywhereCaches - Anywhere Caches Insert
- `google_cloud_storage_anywhere_caches_update` - PATCH /b/{bucket}/anywhereCaches/{anywhereCacheId} - Anywhere Caches Update
- `google_cloud_storage_anywhere_caches_get` - GET /b/{bucket}/anywhereCaches/{anywhereCacheId} - Anywhere Caches Get
- `google_cloud_storage_anywhere_caches_list` - GET /b/{bucket}/anywhereCaches - Anywhere Caches List
- `google_cloud_storage_anywhere_caches_pause` - POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/pause - Anywhere Caches Pause
- `google_cloud_storage_anywhere_caches_resume` - POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/resume - Anywhere Caches Resume
- `google_cloud_storage_anywhere_caches_disable` - POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/disable - Anywhere Caches Disable

## Bucket Access Controls

- `google_cloud_storage_bucket_access_controls_delete` - DELETE /b/{bucket}/acl/{entity} - Bucket Access Controls Delete
- `google_cloud_storage_bucket_access_controls_get` - GET /b/{bucket}/acl/{entity} - Bucket Access Controls Get
- `google_cloud_storage_bucket_access_controls_insert` - POST /b/{bucket}/acl - Bucket Access Controls Insert
- `google_cloud_storage_bucket_access_controls_list` - GET /b/{bucket}/acl - Bucket Access Controls List
- `google_cloud_storage_bucket_access_controls_patch` - PATCH /b/{bucket}/acl/{entity} - Bucket Access Controls Patch
- `google_cloud_storage_bucket_access_controls_update` - PUT /b/{bucket}/acl/{entity} - Bucket Access Controls Update

## Buckets

- `google_cloud_storage_buckets_delete` - DELETE /b/{bucket} - Buckets Delete
- `google_cloud_storage_buckets_restore` - POST /b/{bucket}/restore - Buckets Restore
- `google_cloud_storage_buckets_relocate` - POST /b/{bucket}/relocate - Buckets Relocate
- `google_cloud_storage_buckets_get` - GET /b/{bucket} - Buckets Get
- `google_cloud_storage_buckets_get_iam_policy` - GET /b/{bucket}/iam - Buckets Get Iam Policy
- `google_cloud_storage_buckets_get_storage_layout` - GET /b/{bucket}/storageLayout - Buckets Get Storage Layout
- `google_cloud_storage_buckets_insert` - POST /b - Buckets Insert
- `google_cloud_storage_buckets_list` - GET /b - Buckets List
- `google_cloud_storage_buckets_lock_retention_policy` - POST /b/{bucket}/lockRetentionPolicy - Buckets Lock Retention Policy
- `google_cloud_storage_buckets_patch` - PATCH /b/{bucket} - Buckets Patch
- `google_cloud_storage_buckets_set_iam_policy` - PUT /b/{bucket}/iam - Buckets Set Iam Policy
- `google_cloud_storage_buckets_test_iam_permissions` - GET /b/{bucket}/iam/testPermissions - Buckets Test Iam Permissions
- `google_cloud_storage_buckets_update` - PUT /b/{bucket} - Buckets Update

## Channels

- `google_cloud_storage_channels_stop` - POST /channels/stop - Channels Stop

## Default Object Access Controls

- `google_cloud_storage_default_object_access_controls_delete` - DELETE /b/{bucket}/defaultObjectAcl/{entity} - Default Object Access Controls Delete
- `google_cloud_storage_default_object_access_controls_get` - GET /b/{bucket}/defaultObjectAcl/{entity} - Default Object Access Controls Get
- `google_cloud_storage_default_object_access_controls_insert` - POST /b/{bucket}/defaultObjectAcl - Default Object Access Controls Insert
- `google_cloud_storage_default_object_access_controls_list` - GET /b/{bucket}/defaultObjectAcl - Default Object Access Controls List
- `google_cloud_storage_default_object_access_controls_patch` - PATCH /b/{bucket}/defaultObjectAcl/{entity} - Default Object Access Controls Patch
- `google_cloud_storage_default_object_access_controls_update` - PUT /b/{bucket}/defaultObjectAcl/{entity} - Default Object Access Controls Update

## Folders

- `google_cloud_storage_folders_delete` - DELETE /b/{bucket}/folders/{folder} - Folders Delete
- `google_cloud_storage_folders_delete_recursive` - POST /b/{bucket}/folders/{folder}/deleteRecursive - Folders Delete Recursive
- `google_cloud_storage_folders_get` - GET /b/{bucket}/folders/{folder} - Folders Get
- `google_cloud_storage_folders_insert` - POST /b/{bucket}/folders - Folders Insert
- `google_cloud_storage_folders_list` - GET /b/{bucket}/folders - Folders List
- `google_cloud_storage_folders_rename` - POST /b/{bucket}/folders/{sourceFolder}/renameTo/folders/{destinationFolder} - Folders Rename

## Managed Folders

- `google_cloud_storage_managed_folders_delete` - DELETE /b/{bucket}/managedFolders/{managedFolder} - Managed Folders Delete
- `google_cloud_storage_managed_folders_get` - GET /b/{bucket}/managedFolders/{managedFolder} - Managed Folders Get
- `google_cloud_storage_managed_folders_get_iam_policy` - GET /b/{bucket}/managedFolders/{managedFolder}/iam - Managed Folders Get Iam Policy
- `google_cloud_storage_managed_folders_insert` - POST /b/{bucket}/managedFolders - Managed Folders Insert
- `google_cloud_storage_managed_folders_list` - GET /b/{bucket}/managedFolders - Managed Folders List
- `google_cloud_storage_managed_folders_set_iam_policy` - PUT /b/{bucket}/managedFolders/{managedFolder}/iam - Managed Folders Set Iam Policy
- `google_cloud_storage_managed_folders_test_iam_permissions` - GET /b/{bucket}/managedFolders/{managedFolder}/iam/testPermissions - Managed Folders Test Iam Permissions

## Notifications

- `google_cloud_storage_notifications_delete` - DELETE /b/{bucket}/notificationConfigs/{notification} - Notifications Delete
- `google_cloud_storage_notifications_get` - GET /b/{bucket}/notificationConfigs/{notification} - Notifications Get
- `google_cloud_storage_notifications_insert` - POST /b/{bucket}/notificationConfigs - Notifications Insert
- `google_cloud_storage_notifications_list` - GET /b/{bucket}/notificationConfigs - Notifications List

## Object Access Controls

- `google_cloud_storage_object_access_controls_delete` - DELETE /b/{bucket}/o/{object}/acl/{entity} - Object Access Controls Delete
- `google_cloud_storage_object_access_controls_get` - GET /b/{bucket}/o/{object}/acl/{entity} - Object Access Controls Get
- `google_cloud_storage_object_access_controls_insert` - POST /b/{bucket}/o/{object}/acl - Object Access Controls Insert
- `google_cloud_storage_object_access_controls_list` - GET /b/{bucket}/o/{object}/acl - Object Access Controls List
- `google_cloud_storage_object_access_controls_patch` - PATCH /b/{bucket}/o/{object}/acl/{entity} - Object Access Controls Patch
- `google_cloud_storage_object_access_controls_update` - PUT /b/{bucket}/o/{object}/acl/{entity} - Object Access Controls Update

## Objects

- `google_cloud_storage_objects_compose` - POST /b/{destinationBucket}/o/{destinationObject}/compose - Objects Compose
- `google_cloud_storage_objects_copy` - POST /b/{sourceBucket}/o/{sourceObject}/copyTo/b/{destinationBucket}/o/{destinationObject} - Objects Copy
- `google_cloud_storage_objects_delete` - DELETE /b/{bucket}/o/{object} - Objects Delete
- `google_cloud_storage_objects_get` - GET /b/{bucket}/o/{object} - Objects Get (media download)
- `google_cloud_storage_objects_get_iam_policy` - GET /b/{bucket}/o/{object}/iam - Objects Get Iam Policy
- `google_cloud_storage_objects_insert` - POST /b/{bucket}/o - Objects Insert (media upload)
- `google_cloud_storage_objects_list` - GET /b/{bucket}/o - Objects List
- `google_cloud_storage_objects_patch` - PATCH /b/{bucket}/o/{object} - Objects Patch
- `google_cloud_storage_objects_rewrite` - POST /b/{sourceBucket}/o/{sourceObject}/rewriteTo/b/{destinationBucket}/o/{destinationObject} - Objects Rewrite
- `google_cloud_storage_objects_move` - POST /b/{bucket}/o/{sourceObject}/moveTo/o/{destinationObject} - Objects Move
- `google_cloud_storage_objects_set_iam_policy` - PUT /b/{bucket}/o/{object}/iam - Objects Set Iam Policy
- `google_cloud_storage_objects_test_iam_permissions` - GET /b/{bucket}/o/{object}/iam/testPermissions - Objects Test Iam Permissions
- `google_cloud_storage_objects_update` - PUT /b/{bucket}/o/{object} - Objects Update
- `google_cloud_storage_objects_watch_all` - POST /b/{bucket}/o/watch - Objects Watch All
- `google_cloud_storage_objects_restore` - POST /b/{bucket}/o/{object}/restore - Objects Restore
- `google_cloud_storage_objects_bulk_restore` - POST /b/{bucket}/o/bulkRestore - Objects Bulk Restore

## Operations

- `google_cloud_storage_operations_cancel` - POST /b/{bucket}/operations/{operationId}/cancel - Operations Cancel
- `google_cloud_storage_operations_get` - GET /b/{bucket}/operations/{operationId} - Operations Get
- `google_cloud_storage_operations_advance_relocate_bucket` - POST /b/{bucket}/operations/{operationId}/advanceRelocateBucket - Operations Advance Relocate Bucket
- `google_cloud_storage_operations_list` - GET /b/{bucket}/operations - Operations List

## Projects

- `google_cloud_storage_projects_hmac_keys_create` - POST /projects/{projectId}/hmacKeys - Projects Hmac Keys Create
- `google_cloud_storage_projects_hmac_keys_delete` - DELETE /projects/{projectId}/hmacKeys/{accessId} - Projects Hmac Keys Delete
- `google_cloud_storage_projects_hmac_keys_get` - GET /projects/{projectId}/hmacKeys/{accessId} - Projects Hmac Keys Get
- `google_cloud_storage_projects_hmac_keys_list` - GET /projects/{projectId}/hmacKeys - Projects Hmac Keys List
- `google_cloud_storage_projects_hmac_keys_update` - PUT /projects/{projectId}/hmacKeys/{accessId} - Projects Hmac Keys Update
- `google_cloud_storage_projects_service_account_get` - GET /projects/{projectId}/serviceAccount - Projects Service Account Get
