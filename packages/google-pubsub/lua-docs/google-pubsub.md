# Google Pub/Sub - Lua API Reference

Google Pub/Sub tools are exposed under `app.integrations.google_pubsub`. This package is generated from Google's official Pub/Sub v1 Discovery document and exposes 46 REST methods.

Configure `access_token` with a Google OAuth token that has Pub/Sub scopes such as `https://www.googleapis.com/auth/pubsub`. The default base URL is `https://pubsub.googleapis.com`.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `projects/example/topics/events` or `projects/example/subscriptions/worker`.

## Examples

```lua
local topics = app.integrations.google_pubsub.google_pubsub_projects_topics_list({
  project = "projects/example-project",
  pageSize = 50
})

local published = app.integrations.google_pubsub.google_pubsub_projects_topics_publish({
  topic = "projects/example-project/topics/events",
  body = { messages = { { data = "aGVsbG8=" } } }
})

local pulled = app.integrations.google_pubsub.google_pubsub_projects_subscriptions_pull({
  subscription = "projects/example-project/subscriptions/worker",
  body = { maxMessages = 10 }
})
```

## Multi-Account Usage

```lua
app.integrations.google_pubsub.google_pubsub_projects_topics_list({ project = "projects/example-project" })
app.integrations.google_pubsub.default.google_pubsub_projects_topics_list({ project = "projects/example-project" })
app.integrations.google_pubsub.production.google_pubsub_projects_topics_list({ project = "projects/example-project" })
```

## Schemas

- `google_pubsub_projects_schemas_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Schemas Test Iam Permissions
- `google_pubsub_projects_schemas_validate` - POST /v1/{+parent}/schemas:validate - Projects Schemas Validate
- `google_pubsub_projects_schemas_rollback` - POST /v1/{+name}:rollback - Projects Schemas Rollback
- `google_pubsub_projects_schemas_get` - GET /v1/{+name} - Projects Schemas Get
- `google_pubsub_projects_schemas_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Schemas Set Iam Policy
- `google_pubsub_projects_schemas_create` - POST /v1/{+parent}/schemas - Projects Schemas Create
- `google_pubsub_projects_schemas_list` - GET /v1/{+parent}/schemas - Projects Schemas List
- `google_pubsub_projects_schemas_validate_message` - POST /v1/{+parent}/schemas:validateMessage - Projects Schemas Validate Message
- `google_pubsub_projects_schemas_commit` - POST /v1/{+name}:commit - Projects Schemas Commit
- `google_pubsub_projects_schemas_delete` - DELETE /v1/{+name} - Projects Schemas Delete
- `google_pubsub_projects_schemas_get_iam_policy` - GET /v1/{+resource}:getIamPolicy - Projects Schemas Get Iam Policy
- `google_pubsub_projects_schemas_list_revisions` - GET /v1/{+name}:listRevisions - Projects Schemas List Revisions
- `google_pubsub_projects_schemas_delete_revision` - DELETE /v1/{+name}:deleteRevision - Projects Schemas Delete Revision

## Snapshots

- `google_pubsub_projects_snapshots_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Snapshots Set Iam Policy
- `google_pubsub_projects_snapshots_get_iam_policy` - GET /v1/{+resource}:getIamPolicy - Projects Snapshots Get Iam Policy
- `google_pubsub_projects_snapshots_get` - GET /v1/{+snapshot} - Projects Snapshots Get
- `google_pubsub_projects_snapshots_patch` - PATCH /v1/{+name} - Projects Snapshots Patch
- `google_pubsub_projects_snapshots_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Snapshots Test Iam Permissions
- `google_pubsub_projects_snapshots_create` - PUT /v1/{+name} - Projects Snapshots Create
- `google_pubsub_projects_snapshots_list` - GET /v1/{+project}/snapshots - Projects Snapshots List
- `google_pubsub_projects_snapshots_delete` - DELETE /v1/{+snapshot} - Projects Snapshots Delete

## Subscriptions

- `google_pubsub_projects_subscriptions_acknowledge` - POST /v1/{+subscription}:acknowledge - Projects Subscriptions Acknowledge
- `google_pubsub_projects_subscriptions_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Subscriptions Test Iam Permissions
- `google_pubsub_projects_subscriptions_get` - GET /v1/{+subscription} - Projects Subscriptions Get
- `google_pubsub_projects_subscriptions_patch` - PATCH /v1/{+name} - Projects Subscriptions Patch
- `google_pubsub_projects_subscriptions_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Subscriptions Set Iam Policy
- `google_pubsub_projects_subscriptions_detach` - POST /v1/{+subscription}:detach - Projects Subscriptions Detach
- `google_pubsub_projects_subscriptions_pull` - POST /v1/{+subscription}:pull - Projects Subscriptions Pull
- `google_pubsub_projects_subscriptions_list` - GET /v1/{+project}/subscriptions - Projects Subscriptions List
- `google_pubsub_projects_subscriptions_create` - PUT /v1/{+name} - Projects Subscriptions Create
- `google_pubsub_projects_subscriptions_modify_push_config` - POST /v1/{+subscription}:modifyPushConfig - Projects Subscriptions Modify Push Config
- `google_pubsub_projects_subscriptions_modify_ack_deadline` - POST /v1/{+subscription}:modifyAckDeadline - Projects Subscriptions Modify Ack Deadline
- `google_pubsub_projects_subscriptions_delete` - DELETE /v1/{+subscription} - Projects Subscriptions Delete
- `google_pubsub_projects_subscriptions_get_iam_policy` - GET /v1/{+resource}:getIamPolicy - Projects Subscriptions Get Iam Policy
- `google_pubsub_projects_subscriptions_seek` - POST /v1/{+subscription}:seek - Projects Subscriptions Seek

## Topics

- `google_pubsub_projects_topics_publish` - POST /v1/{+topic}:publish - Projects Topics Publish
- `google_pubsub_projects_topics_delete` - DELETE /v1/{+topic} - Projects Topics Delete
- `google_pubsub_projects_topics_set_iam_policy` - POST /v1/{+resource}:setIamPolicy - Projects Topics Set Iam Policy
- `google_pubsub_projects_topics_get_iam_policy` - GET /v1/{+resource}:getIamPolicy - Projects Topics Get Iam Policy
- `google_pubsub_projects_topics_test_iam_permissions` - POST /v1/{+resource}:testIamPermissions - Projects Topics Test Iam Permissions
- `google_pubsub_projects_topics_create` - PUT /v1/{+name} - Projects Topics Create
- `google_pubsub_projects_topics_list` - GET /v1/{+project}/topics - Projects Topics List
- `google_pubsub_projects_topics_patch` - PATCH /v1/{+name} - Projects Topics Patch
- `google_pubsub_projects_topics_get` - GET /v1/{+topic} - Projects Topics Get
- `google_pubsub_projects_topics_subscriptions_list` - GET /v1/{+topic}/subscriptions - Projects Topics Subscriptions List
- `google_pubsub_projects_topics_snapshots_list` - GET /v1/{+topic}/snapshots - Projects Topics Snapshots List
