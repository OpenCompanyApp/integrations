# MeisterTask — Ruby API Reference

## list_projects

List all MeisterTask projects the authenticated user has access to.

### Parameters

No parameters required.

### Example

```ruby
result = app.integrations.meistertask.list_projects()
result.each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s)
end
```
---

## get_project

Get detailed information about a specific MeisterTask project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```ruby
result = app.integrations.meistertask.get_project(id: 12345)
puts("Project: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
```
---

## create_task

Create a new task in a MeisterTask project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The project ID to create the task in |
| `name` | string | yes | The task name / title |
| `status` | string | no | Task status (e.g., "open", "completed") |
| `description` | string | no | Task description (supports Markdown) |
| `assignee_id` | integer | no | User ID to assign the task to |
| `due_date` | string | no | Due date in ISO 8601 format (e.g., "2026-04-30") |
| `priority` | integer | no | Priority level |
| `section_id` | integer | no | Section (column) ID within the project |
| `labels` | array | no | Array of label names or IDs |

### Example

```ruby
result = app.integrations.meistertask.create(project_id: 12345, name: "Review quarterly report", description: "Check all numbers && update the summary section.", due_date: "2026-04-30", priority: 3)
puts("Created task #" + (result.id).to_s + ": " + (result.name).to_s)
```
---

## list_tasks

List tasks across projects with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by project ID |
| `status` | string | no | Filter by status (e.g., "open", "completed") |
| `assignee_id` | integer | no | Filter by assignee user ID |
| `limit` | integer | no | Maximum number of tasks to return |
| `page` | integer | no | Page number for pagination |

### Example

```ruby
# List open tasks in a specific project
result = app.integrations.meistertask.list(project_id: 12345, status: "open")
result.each do |task|
  puts((task.id).to_s + ": " + (task.name).to_s + " (due: " + ((task.due_date || "none")).to_s + ")")
end
```
---

## get_task

Get detailed information about a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The task ID |

### Example

```ruby
result = app.integrations.meistertask.get(id: 67890)
puts("Task: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
puts("Description: " + ((result.description || "No description")).to_s)
```
---

## update_task

Update an existing task. Provide only the fields you want to change.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The task ID to update |
| `name` | string | no | New task name |
| `status` | string | no | New status (e.g., "open", "completed") |
| `description` | string | no | Updated description |
| `assignee_id` | integer | no | Reassign to a different user |
| `due_date` | string | no | Updated due date (ISO 8601) |
| `priority` | integer | no | Updated priority |
| `section_id` | integer | no | Move to a different section |
| `labels` | array | no | Updated labels |

### Example

```ruby
# Complete a task
result = app.integrations.meistertask.update(id: 67890, status: "completed")
puts("Task " + (result.id).to_s + " is now " + (result.status).to_s)
# Update due date and assignee
result2 = app.integrations.meistertask.update(id: 67891, due_date: "2026-05-15", assignee_id: 42)
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

No parameters required.

### Example

```ruby
result = app.integrations.meistertask.get_current_user()
puts("Logged in as: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple MeisterTask accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.meistertask.list_projects()
# Explicit default (portable across setups)
app.integrations.meistertask.default.list_projects()
# Named accounts
app.integrations.meistertask.work.list_projects()
app.integrations.meistertask.personal.list_projects()
```
All functions are identical across accounts — only the credentials differ.
