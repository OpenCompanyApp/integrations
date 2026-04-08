# Hubstaff — Lua API Reference

## list_time_entries

List time entries with optional filters for date range, user, and project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | string | no | Start of the date range (ISO 8601, e.g., `"2026-04-01T00:00:00Z"`) |
| `endTime` | string | no | End of the date range (ISO 8601, e.g., `"2026-04-06T23:59:59Z"`) |
| `userIds` | string | no | Comma-separated user IDs to filter by (e.g., `"123,456"`) |
| `projectId` | integer | no | Project ID to filter time entries by |
| `limit` | integer | no | Max results per page (default: 50, max: 500) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```lua
local result = app.integrations.hubstaff.list_time_entries({
  startTime = "2026-04-01T00:00:00Z",
  endTime = "2026-04-06T23:59:59Z",
  limit = 50
})

for _, entry in ipairs(result.time_entries or {}) do
  print(entry.id .. ": " .. entry.duration .. " seconds")
end
```

---

## get_time_entry

Get details for a specific time entry by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID |

### Example

```lua
local result = app.integrations.hubstaff.get_time_entry({ id = 12345 })
local entry = result.time_entry
print(entry.notes or "No notes")
```

---

## create_time_entry

Create a new manual time entry for a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The ID of the project to log time against |
| `date` | string | yes | The date for the time entry (ISO 8601, e.g., `"2026-04-06"`) |
| `duration` | integer | yes | Duration in seconds (e.g., 3600 for 1 hour) |
| `notes` | string | no | Notes describing the work performed |

### Example

```lua
local result = app.integrations.hubstaff.create_time_entry({
  project_id = 100,
  date = "2026-04-06",
  duration = 3600,
  notes = "Code review and bug fixes"
})
print("Created time entry: " .. result.time_entry.id)
```

---

## list_projects

List projects with optional status filter and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"` or `"archived"` |
| `limit` | integer | no | Max results per page (default: 50) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```lua
local result = app.integrations.hubstaff.list_projects({
  status = "active",
  limit = 50
})

for _, project in ipairs(result.projects or {}) do
  print(project.id .. ": " .. project.name .. " (" .. project.status .. ")")
end
```

---

## get_project

Get details for a specific project by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```lua
local result = app.integrations.hubstaff.get_project({ id = 100 })
local project = result.project
print(project.name .. " — " .. project.status)
```

---

## list_organizations

List organizations the authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```lua
local result = app.integrations.hubstaff.list_organizations({ limit = 50 })

for _, org in ipairs(result.organizations or {}) do
  print(org.id .. ": " .. org.name)
end
```

---

## get_current_user

Get the profile of the currently authenticated user. Takes no parameters.

### Example

```lua
local result = app.integrations.hubstaff.get_current_user({})
local user = result.user
print("Logged in as: " .. user.name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Hubstaff accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hubstaff.function_name({...})

-- Explicit default (portable across setups)
app.integrations.hubstaff.default.function_name({...})

-- Named accounts
app.integrations.hubstaff.work.function_name({...})
app.integrations.hubstaff.freelance.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
