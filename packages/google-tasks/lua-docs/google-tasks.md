# Google Tasks — Lua API Reference

## list_task_lists

List all task lists for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `maxResults` | integer | no | Max task lists per page (default: 20, max: 100) |
| `pageToken` | string | no | Token for the next page of results |
| `showCompleted` | boolean | no | Show completed tasks (default: true) |
| `showHidden` | boolean | no | Show hidden task lists (default: false) |

### Example

```lua
local result = app.integrations["google-tasks"].list_task_lists({
  maxResults = 20
})

for _, list in ipairs(result.items) do
  print(list.id .. ": " .. list.title)
end
```

---

## get_task_list

Get a specific task list by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The task list ID |

### Example

```lua
local result = app.integrations["google-tasks"].get_task_list({
  id = "MDczMjU3MzI5NjU3MzQ1NzI5MjQ6MDow"
})

print(result.title)
```

---

## create_task_list

Create a new task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Title of the new task list |

### Example

```lua
local result = app.integrations["google-tasks"].create_task_list({
  title = "Work Projects"
})

print("Created list: " .. result.id .. " — " .. result.title)
```

---

## list_tasks

List tasks in a specific task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The task list ID (use `"@"` for default list) |
| `maxResults` | integer | no | Max tasks per page (default: 20, max: 100) |
| `pageToken` | string | no | Token for the next page of results |
| `showCompleted` | boolean | no | Include completed tasks (default: true) |
| `dueDate` | string | no | ISO 8601 date to filter tasks due before this date |

### Example

```lua
local result = app.integrations["google-tasks"].list_tasks({
  list_id = "MDczMjU3MzI5NjU3MzQ1NzI5MjQ6MDow",
  maxResults = 10,
  showCompleted = false
})

for _, task in ipairs(result.items) do
  local due = task.due or "no due date"
  print(task.title .. " — due: " .. due)
end
```

---

## get_task

Get a specific task by ID from a task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The task list ID |
| `id` | string | yes | The task ID |

### Example

```lua
local result = app.integrations["google-tasks"].get_task({
  list_id = "MDczMjU3MzI5NjU3MzQ1NzI5MjQ6MDow",
  id = "task_id_here"
})

print(result.title)
print(result.notes or "No notes")
print("Status: " .. result.status)
```

---

## create_task

Create a new task in a task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The task list ID (use `"@"` for default list) |
| `title` | string | yes | Title of the task |
| `notes` | string | no | Notes or description |
| `due` | string | no | Due date in RFC 3339 format (e.g., `"2026-04-30T00:00:00.000Z"`) |

### Example

```lua
local result = app.integrations["google-tasks"].create_task({
  list_id = "@default",
  title = "Review pull request",
  notes = "Check the new API endpoints in the integration package",
  due = "2026-04-07T00:00:00.000Z"
})

print("Created task: " .. result.id .. " — " .. result.title)
```

---

## get_current_user

Get information about the currently authenticated Google user.

### Parameters

None.

### Example

```lua
local result = app.integrations["google-tasks"].get_current_user({})

print("Connected as: " .. (result.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Google accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["google-tasks"].list_task_lists({})

-- Explicit default (portable across setups)
app.integrations["google-tasks"].default.list_task_lists({})

-- Named accounts
app.integrations["google-tasks"].work.list_task_lists({})
app.integrations["google-tasks"].personal.list_task_lists({})
```

All functions are identical across accounts — only the credentials differ.
