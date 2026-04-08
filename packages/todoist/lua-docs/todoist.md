# Client for the Todoist REST API — Lua API Reference

## todoist_list_tasks

List tasks in Todoist with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter tasks by project ID. |
| `section_id` | string | no | Filter tasks by section ID. |
| `label` | string | no | Filter tasks by label name. |
| `filter` | string | no | Todoist filter expression (e.g. "today", "p1 & @email"). |
| `lang` | string | no | Language for filter evaluation (e.g. "en"). |
| `ids` | array | no | Array of task IDs to fetch. |

### Example

```lua
local result = app.integrations.todoist.todoist_list_tasks({
  project_id = ""
  filter = ""
})
```

## todoist_get_task

Get detailed information about a Todoist task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task ID. |

### Example

```lua
local result = app.integrations.todoist.todoist_get_task({
  id = ""
})
```

## todoist_create_task

Create a new task in Todoist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content` | string | yes | Text content of the task. |
| `description` | string | no | Detailed description of the task (supports Markdown). |
| `project_id` | string | no | Project ID to add the task to. |
| `section_id` | string | no | Section ID to add the task to. |
| `parent_id` | string | no | Parent task ID for creating a subtask. |
| `order` | integer | no | Position among siblings or in the project. |
| `priority` | integer | no | Priority level (1=normal, 2=medium, 3=high, 4=urgent). |
| `labels` | array | no | Array of label names to assign. |
| `due_string` | string | no | Human-readable due date (e.g. "every first Monday", "tomorrow"). |
| `due_date` | string | no | Due date in YYYY-MM-DD format. |
| `due_lang` | string | no | Language for due_string parsing (e.g. "en"). |
| `assignee_id` | string | no | User ID to assign the task to. |

### Example

```lua
local result = app.integrations.todoist.todoist_create_task({
  content = ""
  description = ""
  project_id = ""
})
```

## todoist_list_projects

List all projects in Todoist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ids` | array | no | Array of project IDs to fetch. |

### Example

```lua
local result = app.integrations.todoist.todoist_list_projects()
```

## todoist_get_project

Get detailed information about a Todoist project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The project ID. |

### Example

```lua
local result = app.integrations.todoist.todoist_get_project({
  id = ""
})
```

## todoist_list_labels

List all personal labels in Todoist.

### Parameters

This function takes no parameters.

### Example

```lua
local result = app.integrations.todoist.todoist_list_labels()
```

## todoist_get_current_user

Get the currently authenticated Todoist user.

### Parameters

This function takes no parameters.

### Example

```lua
local result = app.integrations.todoist.todoist_get_current_user()
```

---

## Multi-Account Usage

If you have multiple todoist accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.todoist.function_name({...})

-- Explicit default (portable across setups)
app.integrations.todoist.default.function_name({...})

-- Named accounts
app.integrations.todoist.work.function_name({...})
app.integrations.todoist.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
