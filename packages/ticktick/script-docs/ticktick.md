# TickTick — Ruby API Reference

## list_projects

List all projects (task lists). No parameters. Call this first to discover project IDs.

```ruby
projects = app.integrations.ticktick.list_projects()
projects.each do |p|
  puts((p.name).to_s + " (id: " + (p.id).to_s + ")")
end
```
## get_tasks

Get all tasks in a project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | Project ID (from `list_projects`) |

```ruby
tasks = app.integrations.ticktick.get_tasks(project_id: "abc123")
```
## create_task

Create a new task.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Task title |
| `project_id` | string | no | Project ID. Omit to add to Inbox |
| `content` | string | no | Description/notes |
| `start_date` | string | no | ISO 8601 (e.g. `"2026-03-30T09:00:00+0000"`) |
| `due_date` | string | no | ISO 8601 (e.g. `"2026-03-30T17:00:00+0000"`) |
| `priority` | integer | no | `0` = none, `1` = low, `3` = medium, `5` = high |
| `is_all_day` | boolean | no | `true` for all-day, `false` for specific times |
| `items` | string | no | JSON array of subtasks (see below) |

### Subtask format

```
[{"title": "Subtask 1", "status": 0}, {"title": "Subtask 2", "status": 0}]
```

Status: `0` = unchecked, `2` = checked.

## complete_task

Mark a task as complete.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | Project ID the task belongs to |
| `task_id` | string | yes | Task ID to complete |

## update_task

Update an existing task (same fields as create, plus `task_id` and `project_id`).

## delete_task

Delete a task (requires `project_id` and `task_id`).

## Examples

### List projects, then create a task

```ruby
# Step 1: find the project
projects = app.integrations.ticktick.list_projects()
project_id = nil
projects.each do |p|
  if (p.name == "Work")
    project_id = p.id
    break
  end
end
# Step 2: create a high-priority task with a due date
app.integrations.ticktick.create_task(title: "Finish quarterly report", project_id: project_id, content: "Include revenue && churn metrics", due_date: "2026-04-01T17:00:00+0000", priority: 5, is_all_day: false)
```
### Create a task with subtasks

```ruby
app.integrations.ticktick.create_task(title: "Launch checklist", project_id: project_id, priority: 3, items: "[{\"title\": \"Update changelog\", \"status\": 0}, {\"title\": \"Tag release\", \"status\": 0}, {\"title\": \"Notify team\", \"status\": 0}]")
```
### Complete a task

```ruby
# Step 1: get tasks in the project
tasks = app.integrations.ticktick.get_tasks(project_id: "abc123")
# Step 2: complete the first one
app.integrations.ticktick.complete_task(project_id: "abc123", task_id: tasks[0].id)
```
### Create a quick Inbox task

```ruby
app.integrations.ticktick.create_task(title: "Buy groceries", priority: 1)
```
---

## Multi-Account Usage

If you have multiple ticktick accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
