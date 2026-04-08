# Toggl Track — Lua API Reference

## list_time_entries

List time entries for the authenticated user. Supports filtering by date range, workspace, and project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | no | Start date (ISO 8601, e.g., `"2025-01-01T00:00:00Z"`) |
| `end_date` | string | no | End date (ISO 8601, e.g., `"2025-01-31T23:59:59Z"`) |
| `workspace_id` | integer | no | Filter by workspace ID |
| `project_id` | integer | no | Filter by project ID |
| `limit` | integer | no | Maximum number of entries to return |

### Examples

```lua
-- List recent time entries
local result = app.integrations["toggl-track"].list_time_entries({})
for _, entry in ipairs(result) do
  print(entry.description .. " (" .. entry.duration .. "s)")
end

-- Filter by date range
local result = app.integrations["toggl-track"].list_time_entries({
  start_date = "2025-01-01T00:00:00Z",
  end_date = "2025-01-31T23:59:59Z"
})

-- Filter by workspace and project
local result = app.integrations["toggl-track"].list_time_entries({
  workspace_id = 12345,
  project_id = 67890
})
```

---

## get_time_entry

Get details of a specific time entry by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID |

### Example

```lua
local entry = app.integrations["toggl-track"].get_time_entry({ id = 123456789 })
print(entry.description)
print("Duration: " .. entry.duration .. " seconds")
print("Project: " .. (entry.project_id or "none"))
```

---

## create_time_entry

Create a new time entry in Toggl Track.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The workspace ID |
| `description` | string | no | Description of the time entry |
| `duration` | integer | no | Duration in seconds. Use `-1` for a running timer. |
| `start` | string | no | Start time (ISO 8601, e.g., `"2025-01-15T09:00:00Z"`) |
| `pid` | integer | no | Project ID to assign |
| `tags` | array | no | List of tag names |
| `billable` | boolean | no | Whether the entry is billable (default: false) |
| `created_with` | string | no | Source application name (default: "OpenCompany") |

### Examples

```lua
-- Create a completed time entry (1 hour)
local entry = app.integrations["toggl-track"].create_time_entry({
  workspace_id = 12345,
  description = "Writing documentation",
  duration = 3600,
  start = "2025-01-15T09:00:00Z",
  pid = 67890,
  tags = { "docs", "client-work" },
  billable = true
})

-- Start a running timer
local entry = app.integrations["toggl-track"].create_time_entry({
  workspace_id = 12345,
  description = "Team meeting",
  duration = -1,
  start = "2025-01-15T14:00:00Z"
})
```

---

## list_projects

List projects accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `active` | boolean | no | Filter by active status |
| `workspace_id` | integer | no | Filter by workspace ID |

### Examples

```lua
-- List all projects
local projects = app.integrations["toggl-track"].list_projects({})

-- List active projects in a specific workspace
local projects = app.integrations["toggl-track"].list_projects({
  active = true,
  workspace_id = 12345
})
for _, project in ipairs(projects) do
  print(project.name .. " (ID: " .. project.id .. ")")
end
```

---

## get_project

Get details of a specific project by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```lua
local project = app.integrations["toggl-track"].get_project({ id = 67890 })
print(project.name)
print("Client: " .. (project.client_id or "none"))
print("Active: " .. tostring(project.active))
```

---

## list_workspaces

List all workspaces accessible to the authenticated user.

### Parameters

This tool takes no parameters.

### Example

```lua
local workspaces = app.integrations["toggl-track"].list_workspaces({})
for _, ws in ipairs(workspaces) do
  print(ws.name .. " (ID: " .. ws.id .. ")")
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

This tool takes no parameters.

### Example

```lua
local user = app.integrations["toggl-track"].get_current_user({})
print("Name: " .. user.fullname)
print("Email: " .. user.email)
print("Default workspace: " .. user.default_workspace_id)
```

---

## Multi-Account Usage

If you have multiple Toggl Track accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["toggl-track"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["toggl-track"].default.function_name({...})

-- Named accounts
app.integrations["toggl-track"].work.function_name({...})
app.integrations["toggl-track"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
