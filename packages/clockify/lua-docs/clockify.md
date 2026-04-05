# Clockify — Lua API Reference

## clockify_list_workspaces

List all Clockify workspaces the authenticated user belongs to.

### Parameters

_None_

### Example

```lua
local workspaces = app.integrations.clockify.list_workspaces()

for _, ws in ipairs(workspaces) do
  print(ws.id .. ": " .. ws.name)
end
```

---

## clockify_get_workspace

Get details for a single Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |

### Example

```lua
local ws = app.integrations.clockify.get_workspace({
  workspace_id = "abc123"
})
print(ws.name)
```

---

## clockify_list_projects

List projects in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `name` | string | no | Filter by project name (partial match) |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```lua
local projects = app.integrations.clockify.list_projects({
  workspace_id = "abc123",
  name = "Marketing"
})

for _, p in ipairs(projects) do
  print(p.id .. ": " .. p.name)
end
```

---

## clockify_get_project

Get details for a single Clockify project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |

### Example

```lua
local project = app.integrations.clockify.get_project({
  workspace_id = "abc123",
  project_id = "proj456"
})
print(project.name .. " — " .. project.color)
```

---

## clockify_create_project

Create a new project in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `name` | string | yes | Project name |
| `color` | string | no | Hex color code (e.g. `"#ff0000"`, default: `"#03a9f4"`) |
| `is_public` | boolean | no | Whether the project is publicly visible (default: `false`) |

### Example

```lua
local project = app.integrations.clockify.create_project({
  workspace_id = "abc123",
  name = "Website Redesign",
  color = "#e91e63",
  is_public = true
})
print("Created project: " .. project.id)
```

---

## clockify_list_time_entries

List time entries in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `start` | string | no | Start date filter (ISO 8601, e.g. `"2026-01-01T00:00:00Z"`) |
| `end` | string | no | End date filter (ISO 8601) |
| `project` | string | no | Filter by project ID |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```lua
local entries = app.integrations.clockify.list_time_entries({
  workspace_id = "abc123",
  start = "2026-04-01T00:00:00Z",
  end = "2026-04-05T23:59:59Z"
})

for _, e in ipairs(entries) do
  print(e.description .. ": " .. e.timeInterval.start .. " → " .. e.timeInterval.end)
end
```

### Filter by project

```lua
local entries = app.integrations.clockify.list_time_entries({
  workspace_id = "abc123",
  project = "proj456"
})
```

---

## clockify_get_time_entry

Get details for a single Clockify time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID |

### Example

```lua
local entry = app.integrations.clockify.get_time_entry({
  workspace_id = "abc123",
  time_entry_id = "entry789"
})
print(entry.description)
```

---

## clockify_create_time_entry

Create a new time entry in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `start` | string | yes | Start time (ISO 8601, e.g. `"2026-04-05T09:00:00Z"`) |
| `end` | string | yes | End time (ISO 8601, e.g. `"2026-04-05T17:00:00Z"`) |
| `description` | string | no | Description of the time entry |
| `project_id` | string | no | Project ID to assign the time entry to |

### Example

```lua
local entry = app.integrations.clockify.create_time_entry({
  workspace_id = "abc123",
  start = "2026-04-05T09:00:00Z",
  end = "2026-04-05T12:30:00Z",
  description = "Worked on API integration",
  project_id = "proj456"
})
print("Created entry: " .. entry.id)
```

---

## clockify_update_time_entry

Update an existing Clockify time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID |
| `start` | string | no | New start time (ISO 8601) |
| `end` | string | no | New end time (ISO 8601) |
| `description` | string | no | New description |
| `project_id` | string | no | New project ID to assign |

### Example

```lua
local entry = app.integrations.clockify.update_time_entry({
  workspace_id = "abc123",
  time_entry_id = "entry789",
  description = "Updated description",
  end = "2026-04-05T14:00:00Z"
})
print("Updated entry: " .. entry.id)
```

---

## clockify_delete_time_entry

Delete a Clockify time entry. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID to delete |

### Example

```lua
app.integrations.clockify.delete_time_entry({
  workspace_id = "abc123",
  time_entry_id = "entry789"
})
print("Time entry deleted.")
```

---

## clockify_list_tasks

List tasks for a Clockify project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```lua
local tasks = app.integrations.clockify.list_tasks({
  workspace_id = "abc123",
  project_id = "proj456"
})

for _, t in ipairs(tasks) do
  print(t.id .. ": " .. t.name .. " (" .. t.status .. ")")
end
```

---

## clockify_get_current_user

Get the authenticated Clockify user profile. Useful for verifying API key validity.

### Parameters

_None_

### Example

```lua
local user = app.integrations.clockify.get_current_user()
print(user.name .. " <" .. user.email .. ">")
```

---

## Multi-Account Usage

If you have multiple Clockify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.clockify.function_name({...})

-- Explicit default (portable across setups)
app.integrations.clockify.default.function_name({...})

-- Named accounts
app.integrations.clockify.work.function_name({...})
app.integrations.clockify.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
