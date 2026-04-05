# Toggl Track — Lua API Reference

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Response Fields

| Name | Type | Description |
|------|------|-------------|
| `id` | integer | User ID |
| `email` | string | Email address |
| `fullname` | string | Full name |
| `default_workspace_id` | integer | Default workspace ID |
| `timezone` | string | User timezone |
| `image_url` | string | Profile image URL |

---

## list_workspaces

List all workspaces the authenticated user has access to.

### Parameters

None.

### Response Fields

Each workspace object contains:

| Name | Type | Description |
|------|------|-------------|
| `id` | integer | Workspace ID |
| `name` | string | Workspace name |
| `organization_id` | integer | Organization ID |
| `premium` | boolean | Whether the workspace has premium features |
| `admin` | boolean | Whether the user is an admin |

---

## list_projects

List all projects in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID (find it using `list_workspaces`) |

### Response Fields

Each project object contains:

| Name | Type | Description |
|------|------|-------------|
| `id` | integer | Project ID |
| `name` | string | Project name |
| `workspace_id` | integer | Workspace ID |
| `color` | string | Project color (hex) |
| `active` | boolean | Whether the project is active |
| `billable` | boolean | Whether the project is billable |
| `is_private` | boolean | Whether the project is private |
| `estimated_hours` | number | Estimated hours |

---

## create_project

Create a new project in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID |
| `name` | string | yes | Project name (e.g., "Website Redesign") |
| `color` | string | no | Hex color code (e.g., "#0b83d9") |
| `billable` | boolean | no | Whether the project is billable (default: false) |
| `is_private` | boolean | no | Whether the project is private (default: false) |
| `active` | boolean | no | Whether the project is active (default: true) |
| `estimated_hours` | number | no | Estimated hours for the project |
| `client_id` | integer | no | Client ID to associate |

---

## list_time_entries

List time entries for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | no | Start date in ISO 8601 (e.g., "2026-01-01"). Defaults to 9 days ago. |
| `end_date` | string | no | End date in ISO 8601 (e.g., "2026-01-31"). Defaults to now. |

### Response Fields

Each time entry object contains:

| Name | Type | Description |
|------|------|-------------|
| `id` | integer | Time entry ID |
| `description` | string | Description |
| `start` | string | Start time (ISO 8601) |
| `stop` | string | Stop time (ISO 8601), null if running |
| `duration` | integer | Duration in seconds (-1 if currently running) |
| `workspace_id` | integer | Workspace ID |
| `project_id` | integer | Project ID (null if unassigned) |
| `task_id` | integer | Task ID (null if unassigned) |
| `billable` | boolean | Whether the entry is billable |
| `tags` | array | Array of tag names |
| `user_id` | integer | User ID |

---

## create_time_entry

Create a new time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID |
| `start` | string | yes | Start time in ISO 8601 (e.g., "2026-04-05T09:00:00Z") |
| `description` | string | no | Description of the time entry |
| `stop` | string | no | Stop time in ISO 8601. Omit for a running timer (set duration to -1). |
| `duration` | integer | no | Duration in seconds. Use -1 for a running timer. |
| `project_id` | integer | no | Project ID to associate |
| `task_id` | integer | no | Task ID to associate |
| `tags` | array | no | Array of tag names |
| `tag_ids` | array | no | Array of tag IDs |
| `billable` | boolean | no | Whether the entry is billable |

---

## update_time_entry

Update an existing time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID |
| `time_entry_id` | integer | yes | The time entry ID to update |
| `description` | string | no | Updated description |
| `start` | string | no | Updated start time (ISO 8601) |
| `stop` | string | no | Updated stop time (ISO 8601) |
| `duration` | integer | no | Updated duration in seconds |
| `project_id` | integer | no | Updated project ID |
| `task_id` | integer | no | Updated task ID |
| `tags` | array | no | Updated array of tag names |
| `tag_ids` | array | no | Updated array of tag IDs |
| `billable` | boolean | no | Updated billable status |

---

## delete_time_entry

Delete a time entry permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID |
| `time_entry_id` | integer | yes | The time entry ID to delete |

> **Warning:** This action is permanent and cannot be undone.

---

## Examples

### List recent time entries

```lua
local entries = app.integrations.toggl.list_time_entries({
  start_date = "2026-04-01",
  end_date = "2026-04-05"
})

for _, entry in ipairs(entries) do
  local duration_min = math.floor(entry.duration / 60)
  print(entry.description .. ": " .. duration_min .. " minutes")
end
```

### Create a time entry

```lua
local entry = app.integrations.toggl.create_time_entry({
  workspace_id = 12345,
  description = "Working on API integration",
  start = "2026-04-05T09:00:00Z",
  duration = 3600,
  project_id = 67890,
  billable = true
})

print("Created time entry: " .. entry.id)
```

### Start a running timer

```lua
local entry = app.integrations.toggl.create_time_entry({
  workspace_id = 12345,
  description = "Meeting with client",
  start = "2026-04-05T14:00:00Z",
  duration = -1
})

print("Timer started with entry ID: " .. entry.id)
```

### Stop a running timer (update with stop time)

```lua
local updated = app.integrations.toggl.update_time_entry({
  workspace_id = 12345,
  time_entry_id = 99999,
  stop = "2026-04-05T15:00:00Z"
})

print("Timer stopped")
```

### Create a project and log time to it

```lua
-- First, create the project
local project = app.integrations.toggl.create_project({
  workspace_id = 12345,
  name = "Website Redesign",
  color = "#0b83d9",
  billable = true
})

-- Then log time to it
local entry = app.integrations.toggl.create_time_entry({
  workspace_id = 12345,
  description = "Design homepage mockup",
  start = "2026-04-05T09:00:00Z",
  duration = 7200,
  project_id = project.id,
  billable = true
})
```

---

## Multi-Account Usage

If you have multiple Toggl accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.toggl.function_name({...})

-- Explicit default (portable across setups)
app.integrations.toggl.default.function_name({...})

-- Named accounts
app.integrations.toggl.work.function_name({...})
app.integrations.toggl.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
