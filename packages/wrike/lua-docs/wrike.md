# Client for the Wrike REST API v4 — Lua API Reference

## wrike_add_comment

Add a comment to a Wrike task..

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

Create a new folder in Wrike..

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
  parent_id = ""
  description = ""
})
```

## wrike_create_task

Create a new task in a Wrike folder..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | yes | The folder ID to create the task in. |
| `title` | string | yes | Title of the task. |
| `description` | string | no | Detailed description of the task. |
| `importance` | string | no | Task importance: High, Normal, or Low. |
| `dates_start` | string | no | Start date in YYYY-MM-DD format. |
| `dates_due` | string | no | Due date in YYYY-MM-DD format. |
| `assignees` | array | no | Array of contact IDs to assign the task to. |

### Example

```lua
local result = app.integrations.wrike.wrike_create_task({
  folder_id = ""
  title = ""
  description = ""
})
```

## wrike_get_current_user

Get the currently authenticated Wrike user..

### Example

```lua
local result = app.integrations.wrike.wrike_get_current_user({
})
```

## wrike_get_folder

Get detailed information about a Wrike folder..

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

## wrike_get_space

Get detailed information about a Wrike space..

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

Get detailed information about a Wrike task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | The task ID. |

### Example

```lua
local result = app.integrations.wrike.wrike_get_task({
  task_id = ""
})
```

## wrike_list_contacts

List contacts in Wrike..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of contacts to return. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_contacts({
  limit = 0
})
```

## wrike_list_folders

List folders in Wrike with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | string | no | Space ID to filter folders by. |
| `limit` | integer | no | Max number of folders to return. |
| `page_token` | string | no | Token for pagination from a previous response. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_folders({
  space_id = ""
  limit = 0
  page_token = ""
})
```

## wrike_list_spaces

List spaces in Wrike..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of spaces to return. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_spaces({
  limit = 0
})
```

## wrike_list_tasks

List tasks in Wrike with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | no | Folder ID to filter tasks by. |
| `space_id` | string | no | Space ID to filter tasks by. |
| `status` | string | no | Task status to filter by (e.g. Active, Completed, Deferred). |
| `limit` | integer | no | Max number of tasks to return. |
| `page_token` | string | no | Token for pagination from a previous response. |

### Example

```lua
local result = app.integrations.wrike.wrike_list_tasks({
  folder_id = ""
  space_id = ""
  status = ""
})
```

## wrike_update_task

Update an existing Wrike task..

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
