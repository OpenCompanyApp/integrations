# Client for the Wrike REST API — Lua API Reference

## wrike_add_comment

Add a comment to a Wrike task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | ID of the task to comment on. |
| `text` | string | yes | Comment text (supports Markdown). |

### Example

```lua
local result = app.integrations.wrike.wrike_add_comment({
  task_id = ""
  text = ""
})
```

## wrike_create_folder

Create a new folder in Wrike.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Title of the folder. |
| `parent_id` | string | no | Parent folder or space ID to nest the folder under. |
| `description` | string | no | Description of the folder. |

### Example

```lua
local result = app.integrations.wrike.wrike_create_folder({
  title = ""
  description = ""
})
```

## wrike_create_task

Create a new task in Wrike.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folderId` | string | yes | Folder ID to create the task in. |
| `title` | string | yes | Title of the task. |
| `description` | string | no | Detailed description of the task. |
| `importance` | string | no | Task importance (High, Normal, Low). |
| `status` | string | no | Task status (Active, Completed, Deferred). |
| `dates` | object | no | Date settings object (start, due, type). |
| `assignees` | array | no | Array of user IDs to assign the task to. |

### Example

```lua
local result = app.integrations.wrike.wrike_create_task({
  folderId = ""
  title = ""
  description = ""
})
```

## wrike_get_current_user

Get the currently authenticated Wrike user.

### Example

```lua
local result = app.integrations.wrike.wrike_get_current_user({
})
```

## wrike_get_folder

Get detailed information about a Wrike folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | yes | The folder ID. |

### Example

```lua
local result = app.integrations.wrike.wrike_get_folder({
  folder_id = ""
})
```

## wrike_get_project

Get detailed information about a Wrike project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The project ID. |

### Example

```lua
local result = app.integrations.wrike.wrike_get_project({
  id = ""
})
```

## wrike_get_space

Get detailed information about a Wrike space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | string | yes | The space ID. |

### Example

```lua
local result = app.integrations.wrike.wrike_get_space({
  space_id = ""
})
```

## wrike_get_task

Get detailed information about a Wrike task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task ID. |

### Example

```lua
local result = app.integrations.wrike.wrike_get_task({
  id = ""
})
```

## wrike_list_contacts

List contacts in Wrike.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of contacts to return. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_contacts({
})
```

## wrike_list_folders

List folders in Wrike with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of folders to return. |
| `nextPageToken` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_folders({
})
```

## wrike_list_projects

List projects in Wrike with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by project status (Active, Completed, Deferred). |
| `limit` | integer | no | Max number of projects to return. |
| `nextPageToken` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_projects({
  status = ""
})
```

## wrike_list_spaces

List spaces in Wrike.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of spaces to return. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_spaces({
})
```

## wrike_list_tasks

List tasks in Wrike with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folderId` | string | no | Folder ID to list tasks from. |
| `status` | string | no | Filter by status (e.g. Active, Completed, Deferred). |
| `importance` | string | no | Filter by importance (e.g. High, Normal, Low). |
| `limit` | integer | no | Max number of tasks to return. |
| `nextPageToken` | string | no | Cursor for pagination from a previous response. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_tasks({
  folderId = ""
  status = ""
})
```

## wrike_update_task

Update an existing Wrike task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | The task ID to update. |
| `title` | string | no | New title for the task. |
| `description` | string | no | New description for the task. |
| `status` | string | no | New status (e.g. Active, Completed, Deferred). |
| `importance` | string | no | Task importance: High, Normal, or Low. |
| `dates_due` | string | no | New due date in YYYY-MM-DD format. |

### Example

```lua
local result = app.integrations.wrike.wrike_update_task({
  task_id = ""
  title = ""
  description = ""
})
```

---

## Multi-Account Usage

If you have multiple wrike accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wrike.function_name({...})

-- Explicit default (portable across setups)
app.integrations.wrike.default.function_name({...})

-- Named accounts
app.integrations.wrike.work.function_name({...})
app.integrations.wrike.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
