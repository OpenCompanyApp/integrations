# Microsoft To Do — Ruby API Reference

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

```ruby
result = app.call("integrations.microsoft-todo.list_lists")
result.lists.each do |list|
  puts((list.displayName).to_s + " (" + (list.id).to_s + ")")
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

```ruby
result = app.call("integrations.microsoft-todo.get_list", id: "AQMkAGI1NzQz...")
puts(result.displayName)
```
---

## create_list

Create a new Microsoft To Do task list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `display_name` | string | yes | The name of the new task list |

### Example

```ruby
result = app.call("integrations.microsoft-todo.create_list", display_name: "Work Tasks")
puts("Created list: " + (result.displayName).to_s + " (ID: " + (result.id).to_s + ")")
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

```ruby
result = app.call("integrations.microsoft-todo.list_tasks", list_id: "AQMkAGI1NzQz...")
result.tasks.each do |task|
  status = (task.status || "unknown")
  puts((task.title).to_s + " [" + (status).to_s + "]")
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

```ruby
result = app.call("integrations.microsoft-todo.get_task", list_id: "AQMkAGI1NzQz...", id: "AAMkAGI1NzQz...")
puts(result.title)
puts(result.status)
if result.dueDateTime
  puts("Due: " + (result.dueDateTime.dateTime).to_s)
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

```ruby
result = app.call("integrations.microsoft-todo.create_task", list_id: "AQMkAGI1NzQz...", title: "Review pull request", body: "Check the new authentication module", due_date: "2026-04-30T17:00:00", due_timezone: "Europe/Amsterdam")
puts("Created task: " + (result.title).to_s + " (ID: " + (result.id).to_s + ")")
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

```ruby
result = app.call("integrations.microsoft-todo.get_current_user")
puts("Connected as: " + (result.displayName).to_s)
puts("Email: " + ((result.mail || result.userPrincipalName)).to_s)
```
---

## Multi-Account Usage

If you have multiple Microsoft accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.microsoft-todo.list_lists")
# Explicit default (portable across setups)
app.call("integrations.microsoft-todo.default.list_lists")
# Named accounts
app.call("integrations.microsoft-todo.work.list_lists")
app.call("integrations.microsoft-todo.personal.create_task", list_id: "...", title: "Book vacation")
```
All functions are identical across accounts — only the credentials differ.
