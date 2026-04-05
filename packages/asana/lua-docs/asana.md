# Client for the Asana REST API — Lua API Reference

## asana_add_comment

Add a comment to an Asana task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | GID of the task to comment on. |
| `text` | string | yes | Comment text (supports Markdown). |

### Example

```lua
local result = app.integrations.asana.asana_add_comment({
  task_id = ""
  text = ""
})
```

## asana_create_project

Create a new project in Asana..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the project. |
| `notes` | string | no | Free-form description of the project. |
| `workspace` | string | yes | Workspace GID where the project will be created. |
| `team` | string | no | Team GID to add the project to. |
| `color` | string | no | Color for the project (e.g.  |

### Example

```lua
local result = app.integrations.asana.asana_create_project({
  name = ""
  notes = ""
  workspace = ""
})
```

## asana_create_subtask

Create a subtask under an existing Asana task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent_id` | string | yes | GID of the parent task. |
| `name` | string | yes | Name of the subtask. |
| `notes` | string | no | Description for the subtask. |
| `assignee` | string | no | User GID to assign the subtask to, or  |

### Example

```lua
local result = app.integrations.asana.asana_create_subtask({
  parent_id = ""
  name = ""
  notes = ""
})
```

## asana_create_tag

Create a new tag in Asana..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the tag. |
| `workspace` | string | yes | Workspace GID where the tag will be created. |
| `color` | string | no | Color for the tag (e.g.  |

### Example

```lua
local result = app.integrations.asana.asana_create_tag({
  name = ""
  workspace = ""
  color = ""
})
```

## asana_create_task

Create a new task in Asana..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the task. |
| `notes` | string | no | Free-form textual description (supports HTML). |
| `projects` | array | no | Array of project GIDs to add the task to. |
| `assignee` | string | no | User GID to assign the task to, or  |
| `due_on` | string | no | Due date in YYYY-MM-DD format. |
| `tags` | array | no | Array of tag GIDs to add to the task. |
| `workspace` | string | no | Workspace GID (required if not adding to a project). |

### Example

```lua
local result = app.integrations.asana.asana_create_task({
  name = ""
  notes = ""
  projects = {}
})
```

## asana_delete_task

Delete an Asana task permanently..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task GID to delete. |

### Example

```lua
local result = app.integrations.asana.asana_delete_task({
  id = ""
})
```

## asana_get_current_user

Get the currently authenticated Asana user..

### Example

```lua
local result = app.integrations.asana.asana_get_current_user({
})
```

## asana_get_project

Get detailed information about an Asana project..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The project GID. |

### Example

```lua
local result = app.integrations.asana.asana_get_project({
  id = ""
})
```

## asana_get_task

Get detailed information about an Asana task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task GID. |

### Example

```lua
local result = app.integrations.asana.asana_get_task({
  id = ""
})
```

## asana_get_user

Get detailed information about an Asana user..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The user GID. |

### Example

```lua
local result = app.integrations.asana.asana_get_user({
  id = ""
})
```

## asana_get_user_task_list

Get the user task list for a given user and workspace..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | GID of the user. |
| `workspace_id` | string | yes | GID of the workspace. |

### Example

```lua
local result = app.integrations.asana.asana_get_user_task_list({
  user_id = ""
  workspace_id = ""
})
```

## asana_list_comments

List comments (stories) on an Asana task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | GID of the task to list comments for. |
| `limit` | integer | no | Max number of comments to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_comments({
  task_id = ""
  limit = 0
  offset = ""
})
```

## asana_list_projects

List projects in Asana with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | no | Workspace GID to filter projects by. |
| `team` | string | no | Team GID to filter projects by. |
| `archived` | boolean | no | Filter by archived status. |
| `limit` | integer | no | Max number of projects to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_projects({
  workspace = ""
  team = ""
  archived = true
})
```

## asana_list_sections

List sections in an Asana project..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | GID of the project to list sections for. |
| `limit` | integer | no | Max number of sections to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_sections({
  project_id = ""
  limit = 0
  offset = ""
})
```

## asana_list_tags

List tags in an Asana workspace..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | Workspace GID to filter tags by. |
| `limit` | integer | no | Max number of tags to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_tags({
  workspace = ""
  limit = 0
  offset = ""
})
```

## asana_list_tasks

List tasks in Asana with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project` | string | no | Project GID to filter tasks by. |
| `assignee` | string | no | User GID to filter by assignee, or  |
| `workspace` | string | no | Workspace GID to filter tasks by. |
| `completed_since` | string | no | Only return tasks completed after this ISO 8601 date. |
| `limit` | integer | no | Max number of tasks to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_tasks({
  project = ""
  assignee = ""
  workspace = ""
})
```

## asana_list_teams

List teams in an Asana workspace..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | GID of the workspace to list teams for. |

### Example

```lua
local result = app.integrations.asana.asana_list_teams({
  workspace_id = ""
})
```

## asana_list_users

List users in an Asana workspace..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace` | string | yes | Workspace GID to filter users by. |
| `limit` | integer | no | Max number of users to return (1–100). |
| `offset` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.asana.asana_list_users({
  workspace = ""
  limit = 0
  offset = ""
})
```

## asana_list_workspaces

List all workspaces the authenticated user has access to..

### Example

```lua
local result = app.integrations.asana.asana_list_workspaces({
})
```

## asana_update_task

Update an existing Asana task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task GID to update. |
| `name` | string | no | New name for the task. |
| `notes` | string | no | New description. |
| `assignee` | string | no | User GID to assign the task to, or  |
| `due_on` | string | no | Due date in YYYY-MM-DD format. |
| `completed` | boolean | no | Set to true to mark the task complete. |
| `tags` | array | no | Array of tag GIDs to set on the task. |

### Example

```lua
local result = app.integrations.asana.asana_update_task({
  id = ""
  name = ""
  notes = ""
})
```

---

## Multi-Account Usage

If you have multiple asana accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.asana.function_name({...})

-- Explicit default (portable across setups)
app.integrations.asana.default.function_name({...})

-- Named accounts
app.integrations.asana.work.function_name({...})
app.integrations.asana.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
