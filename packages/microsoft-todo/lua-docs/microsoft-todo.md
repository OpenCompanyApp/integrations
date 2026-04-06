# Microsoft To Do — Lua API Reference

## list_lists

List all Microsoft To Do task lists for the authenticated user.

### Parameters

None.

### Response

Returns an object with `lists` (array) and `count` (number).

Each list contains:
- `id` — unique list identifier
- `displayName` — the list name
- `wellknownListName` — e.g. `"defaultList"`, `"none"`
- `isOwner` — whether the user owns the list
- `isShared` — whether the list is shared

### Example

```lua
local result = app.integrations.microsoft_todo.list_lists()

for _, list in ipairs(result.lists) do
  print(list.displayName .. " (" .. list.id .. ")")
end
```

---

## get_list

Get a specific Microsoft To Do task list by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the task list |

### Example

```lua
local result = app.integrations.microsoft_todo.get_list({
  id = "AQMkAGI1NzQz..."
})

print(result.displayName)
```

---

## create_list

Create a new Microsoft To Do task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `displayName` | string | yes | The name of the new task list |

### Example

```lua
local result = app.integrations.microsoft_todo.create_list({
  displayName = "Work Tasks"
})

print("Created list: " .. result.displayName .. " (ID: " .. result.id .. ")")
```

---

## list_tasks

List all tasks in a Microsoft To Do task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The unique identifier of the task list |

### Response

Returns an object with `tasks` (array) and `count` (number).

Each task contains:
- `id` — unique task identifier
- `title` — task title
- `status` — `"notStarted"`, `"inProgress"`, `"completed"`, `"waitingOnOthers"`, `"deferred"`
- `body` — body content object (may be null)
- `dueDateTime` — due date object (may be null)
- `importance` — `"low"`, `"normal"`, `"high"`
- `createdDateTime` — creation timestamp
- `lastModifiedDateTime` — last modified timestamp

### Example

```lua
local result = app.integrations.microsoft_todo.list_tasks({
  list_id = "AQMkAGI1NzQz..."
})

for _, task in ipairs(result.tasks) do
  local status = task.status or "unknown"
  print(task.title .. " [" .. status .. "]")
end
```

---

## get_task

Get a specific task from a Microsoft To Do task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The unique identifier of the task list |
| `id` | string | yes | The unique identifier of the task |

### Example

```lua
local result = app.integrations.microsoft_todo.get_task({
  list_id = "AQMkAGI1NzQz...",
  id = "AAMkAGI1NzQz..."
})

print(result.title)
print(result.status)
if result.dueDateTime then
  print("Due: " .. result.dueDateTime.dateTime)
end
```

---

## create_task

Create a new task in a Microsoft To Do task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The unique identifier of the task list |
| `title` | string | yes | The title of the task |
| `body` | string | no | Body/content text for the task |
| `due_date` | string | no | Due date in ISO 8601 format (e.g., `"2026-04-30T00:00:00"`) |
| `due_timezone` | string | no | Timezone for the due date (e.g., `"UTC"`, `"Europe/Amsterdam"`). Defaults to `"UTC"` |

### Example

```lua
local result = app.integrations.microsoft_todo.create_task({
  list_id = "AQMkAGI1NzQz...",
  title = "Review pull request",
  body = "Check the new authentication module",
  due_date = "2026-04-30T17:00:00",
  due_timezone = "Europe/Amsterdam"
})

print("Created task: " .. result.title .. " (ID: " .. result.id .. ")")
```

---

## get_current_user

Get the authenticated Microsoft user's profile.

### Parameters

None.

### Response

Returns an object with:
- `id` — user ID
- `displayName` — user's display name
- `mail` — email address
- `userPrincipalName` — UPN
- `jobTitle` — job title
- `officeLocation` — office location

### Example

```lua
local result = app.integrations.microsoft_todo.get_current_user()

print("Connected as: " .. result.displayName)
print("Email: " .. (result.mail or result.userPrincipalName))
```

---

## Multi-Account Usage

If you have multiple Microsoft accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.microsoft_todo.list_lists({})

-- Explicit default (portable across setups)
app.integrations.microsoft_todo.default.list_lists({})

-- Named accounts
app.integrations.microsoft_todo.work.list_lists({})
app.integrations.microsoft_todo.personal.create_task({
  list_id = "...",
  title = "Book vacation"
})
```

All functions are identical across accounts — only the credentials differ.
