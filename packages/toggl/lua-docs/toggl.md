# Toggl — Lua API Reference

## toggl_list_workspaces

List all Toggl workspaces the authenticated user belongs to.

### Parameters

_None_

### Example

```lua
local workspaces = app.integrations.toggl.list_workspaces()

for _, ws in ipairs(workspaces) do
  print(ws.id .. ": " .. ws.name)
end
```

---

## toggl_list_projects

List projects in a Toggl workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `active` | boolean | no | Filter for active projects only (default: `true`) |

### Example

```lua
local projects = app.integrations.toggl.list_projects({
  workspace_id = "123456"
})

for _, p in ipairs(projects) do
  print(p.id .. ": " .. p.name)
end
```

---

## toggl_get_project

Get details for a single Toggl project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |

### Example

```lua
local project = app.integrations.toggl.get_project({
  workspace_id = "123456",
  project_id = "789012"
})
print(project.name .. " — " .. (project.active and "active" or "inactive"))
```

---

## toggl_list_time_entries

List recent Toggl time entries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | no | Start date filter (ISO 8601 date, e.g. `"2026-01-01"`) |
| `end_date` | string | no | End date filter (ISO 8601 date) |

### Example

```lua
local entries = app.integrations.toggl.list_time_entries({
  start_date = "2026-04-01",
  end_date = "2026-04-05"
})

for _, e in ipairs(entries) do
  print(e.description .. ": " .. e.start .. " → " .. (e.stop or "running"))
end
```

---

## toggl_get_time_entry

Get details for a single Toggl time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `time_entry_id` | string | yes | The time entry ID |

### Example

```lua
local entry = app.integrations.toggl.get_time_entry({
  time_entry_id = "1234567890"
})
print(entry.description)
```

---

## toggl_create_time_entry

Create a new time entry in a Toggl workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `description` | string | no | Description of the time entry |
| `start` | string | no | Start time (ISO 8601, e.g. `"2026-04-05T09:00:00Z"`). Defaults to now. |
| `stop` | string | no | Stop time (ISO 8601). Omit for a running timer. |
| `duration` | integer | no | Duration in seconds. Use -1 for a running timer (default: -1) |
| `project_id` | string | no | Project ID to assign the time entry to |
| `tags` | array | no | Tags for the time entry |

### Example

```lua
local entry = app.integrations.toggl.create_time_entry({
  workspace_id = "123456",
  description = "Worked on API integration",
  start = "2026-04-05T09:00:00Z",
  stop = "2026-04-05T12:30:00Z",
  project_id = "789012",
  tags = { "development", "backend" }
})
print("Created entry: " .. entry.id)
```

### Start a running timer

```lua
local entry = app.integrations.toggl.create_time_entry({
  workspace_id = "123456",
  description = "Meeting with team"
})
print("Timer started: " .. entry.id)
```

---

## toggl_get_current_user

Get the authenticated Toggl user profile. Useful for verifying API token validity.

### Parameters

_None_

### Example

```lua
local user = app.integrations.toggl.get_current_user()
print(user.fullname .. " <" .. user.email .. ">")
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
