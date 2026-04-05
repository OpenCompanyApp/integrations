# Teamwork — Lua API Reference

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | yes | Teamwork API key (Settings → API Keys) |
| `hostname` | url | yes | Your Teamwork hostname (e.g., `myteam.teamwork.com`) |

Authentication uses HTTP Basic Auth with the API key as the username and `X` as the password.

---

## list_projects

List projects in Teamwork.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `pageSize` | integer | no | Results per page (default: 50) |
| `search` | string | no | Filter projects by name |

### Example

```lua
local result = app.integrations.teamwork.list_projects({
  pageSize = 10
})

for _, project in ipairs(result.projects) do
  print(project.name .. " (ID: " .. project.id .. ")")
end
```

---

## get_project

Get details for a single project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID |

### Example

```lua
local result = app.integrations.teamwork.get_project({
  project_id = 123
})

print(result.project.name)
print(result.project.description)
print(result.project.status)
```

---

## create_project

Create a new project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Project name |
| `description` | string | no | Project description |

### Example

```lua
local result = app.integrations.teamwork.create_project({
  name = "Website Redesign",
  description = "Q3 initiative to redesign the company website"
})

print("Created project ID: " .. result.id)
```

---

## list_tasks

List tasks in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID |
| `page` | integer | no | Page number (default: 1) |
| `pageSize` | integer | no | Results per page (default: 50) |

### Example

```lua
local result = app.integrations.teamwork.list_tasks({
  project_id = 123
})

for _, task in ipairs(result.tasks) do
  print(task.name .. " — " .. task.status)
end
```

---

## get_task

Get details for a single task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | integer | yes | The task ID |

### Example

```lua
local result = app.integrations.teamwork.get_task({
  task_id = 456
})

print(result.task.name)
print(result.task.description)
print(result.task.dueDate)
```

---

## create_task

Create a task in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID |
| `name` | string | yes | Task name |
| `description` | string | no | Task description |
| `assigneeIds` | array | no | Array of user IDs to assign |
| `dueDate` | string | no | Due date (ISO 8601, e.g., `"2026-04-30"`) |
| `priority` | string | no | `"low"`, `"medium"`, or `"high"` |
| `estimatedTime` | integer | no | Estimated time in minutes |

### Example

```lua
local result = app.integrations.teamwork.create_task({
  project_id = 123,
  name = "Design homepage mockup",
  description = "Create wireframes for the new homepage",
  dueDate = "2026-04-30",
  priority = "high"
})

print("Created task ID: " .. result.id)
```

---

## update_task

Update an existing task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | integer | yes | The task ID to update |
| `name` | string | no | New task name |
| `description` | string | no | Updated description |
| `assigneeIds` | array | no | Array of user IDs to assign |
| `dueDate` | string | no | Due date (ISO 8601) |
| `priority` | string | no | `"low"`, `"medium"`, or `"high"` |
| `estimatedTime` | integer | no | Estimated time in minutes |
| `progress` | integer | no | Progress percentage (0–100) |

### Example

```lua
local result = app.integrations.teamwork.update_task({
  task_id = 456,
  name = "Design homepage mockup — revised",
  progress = 75
})
```

---

## complete_task

Mark a task as complete.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | integer | yes | The task ID to complete |

### Example

```lua
local result = app.integrations.teamwork.complete_task({
  task_id = 456
})

print("Task completed")
```

---

## list_teams

List teams.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `pageSize` | integer | no | Results per page (default: 50) |

### Example

```lua
local result = app.integrations.teamwork.list_teams()

for _, team in ipairs(result.teams) do
  print(team.name .. " (" .. team.memberCount .. " members)")
end
```

---

## get_team

Get details for a single team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | integer | yes | The team ID |

### Example

```lua
local result = app.integrations.teamwork.get_team({
  team_id = 10
})

print(result.team.name)
```

---

## list_time_entries

List time entries for a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID |
| `page` | integer | no | Page number (default: 1) |
| `pageSize` | integer | no | Results per page (default: 50) |
| `fromDate` | string | no | Filter from date (ISO 8601) |
| `toDate` | string | no | Filter to date (ISO 8601) |

### Example

```lua
local result = app.integrations.teamwork.list_time_entries({
  project_id = 123,
  fromDate = "2026-01-01",
  toDate = "2026-03-31"
})

for _, entry in ipairs(result.timeEntries) do
  print(entry.description .. ": " .. entry.hours .. "h")
end
```

---

## create_time_entry

Log time against a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID |
| `hours` | integer | yes | Number of hours |
| `date` | string | yes | Date (ISO 8601, e.g., `"2026-04-05"`) |
| `minutes` | integer | no | Additional minutes |
| `description` | string | no | Description of the work |
| `task_id` | integer | no | Associate with a specific task |
| `userId` | integer | no | User ID (defaults to authenticated user) |

### Example

```lua
local result = app.integrations.teamwork.create_time_entry({
  project_id = 123,
  hours = 2,
  minutes = 30,
  date = "2026-04-05",
  description = "Implemented login page",
  task_id = 456
})

print("Time entry logged: " .. result.id)
```

---

## get_current_user

Get the currently authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.teamwork.get_current_user()

print("Logged in as: " .. result.person.firstName .. " " .. result.person.lastName)
print("Email: " .. result.person.emailAddress)
```

---

## Multi-Account Usage

If you have multiple Teamwork accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.teamwork.list_projects({})

-- Explicit default (portable across setups)
app.integrations.teamwork.default.list_projects({})

-- Named accounts
app.integrations.teamwork.work.list_projects({})
app.integrations.teamwork.client_a.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
