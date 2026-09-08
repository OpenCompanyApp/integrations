# Motion — Ruby API Reference

## list_tasks

List tasks from Motion with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by task status (e.g., "Todo", "In Progress", "Done") |
| `projectId` | string | no | Filter tasks by project ID |
| `assigneeId` | string | no | Filter tasks by assignee user ID |
| `limit` | integer | no | Max tasks per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```ruby
# List all tasks
result = app.integrations.motion.list_tasks()
# List todo tasks
result = app.integrations.motion.list_tasks(status: "Todo")
# List tasks in a project
result = app.integrations.motion.list_tasks(project_id: "proj_abc123")
# Paginate
result = app.integrations.motion.list_tasks(limit: 10, cursor: "next_page_cursor")
```
---

## get_task

Get details of a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `taskId` | string | yes | The unique task identifier |

### Example

```ruby
task = app.integrations.motion.get_task(task_id: "task_abc123")
puts((task.name).to_s + " — " + (task.status).to_s)
```
---

## create_task

Create a new task in Motion. Motion auto-schedules based on priority and due date.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Task title |
| `projectId` | string | no | Project to add the task to |
| `assigneeId` | string | no | User ID to assign the task to |
| `dueDate` | string | no | Due date in ISO 8601 (e.g., "2025-12-31") |
| `priority` | string | no | Priority: "ASAP", "HIGH", "MEDIUM", "LOW" (default: "MEDIUM") |
| `description` | string | no | Task description (supports Markdown) |

### Examples

```ruby
# Simple task
task = app.integrations.motion.create_task(name: "Review Q1 report")
# Full task with all options
task = app.integrations.motion.create_task(name: "Review Q1 report", project_id: "proj_abc123", assignee_id: "user_xyz789", due_date: "2025-03-28", priority: "HIGH", description: "Review the Q1 financial report && provide feedback.")
```
---

## list_projects

List all projects in Motion.

### Parameters

None.

### Example

```ruby
result = app.integrations.motion.list_projects()
(result.projects || []).each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s)
end
```
---

## get_project

Get details of a specific project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `projectId` | string | yes | The unique project identifier |

### Example

```ruby
project = app.integrations.motion.get_project(project_id: "proj_abc123")
puts((project.name).to_s + " — " + ((project.description || "No description")).to_s)
```
---

## list_schedules

List schedules within a date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startDate` | string | yes | Start date in ISO 8601 (e.g., "2025-01-01") |
| `endDate` | string | yes | End date in ISO 8601 (e.g., "2025-01-31") |

### Example

```ruby
result = app.integrations.motion.list_schedules(start_date: "2025-01-01", end_date: "2025-01-31")
(result.schedules || []).each do |entry|
  puts((entry.date).to_s + ": " + (entry.type).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```ruby
user = app.integrations.motion.get_current_user()
puts("Logged in as: " + (user.name).to_s + " (" + (user.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Motion accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.motion.list_tasks()
# Explicit default (portable across setups)
app.integrations.motion.default.list_tasks()
# Named accounts
app.integrations.motion.work.list_tasks()
app.integrations.motion.personal.list_tasks()
```
All functions are identical across accounts — only the credentials differ.
