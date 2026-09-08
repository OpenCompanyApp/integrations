# Client for the Teamwork REST API — Ruby API Reference

## teamwork_list_projects

List projects in Teamwork with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by project status (e.g. "active", "late", "completed"). |
| `page` | integer | no | Page number for pagination. |
| `pageSize` | integer | no | Number of projects per page (max 500). |

### Example

```ruby
result = app.integrations.teamwork.list_projects(status: "", page: 0, page_size: 0)
```
## teamwork_get_project

Get detailed information about a Teamwork project..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID. |

### Example

```ruby
result = app.integrations.teamwork.get_project(id: 0)
```
## teamwork_list_tasks

List tasks in Teamwork with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `projectId` | integer | no | Project ID to filter tasks by. |
| `page` | integer | no | Page number for pagination. |
| `pageSize` | integer | no | Number of tasks per page (max 500). |
| `filter` | string | no | Filter tasks (e.g. "all", "overdue", "today"). |
| `sort` | string | no | Sort order (e.g. "duedate", "priority"). |

### Example

```ruby
result = app.integrations.teamwork.list_tasks(project_id: 0, page: 0, page_size: 0)
```
## teamwork_get_task

Get detailed information about a Teamwork task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The task ID. |

### Example

```ruby
result = app.integrations.teamwork.get_task(id: 0)
```
## teamwork_create_task

Create a new task in Teamwork..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `projectId` | integer | yes | The project ID to create the task in. |
| `name` | string | yes | Name of the task. |
| `description` | string | no | Detailed description of the task. |
| `assigneeId` | integer | no | User ID to assign the task to. |
| `dueDate` | string | no | Due date in YYYYMMDD format. |
| `priority` | string | no | Task priority (e.g. "low", "medium", "high"). |
| `startDate` | string | no | Start date in YYYYMMDD format. |

### Example

```ruby
result = app.integrations.teamwork.create_task(project_id: 0, name: "", description: "")
```
## teamwork_list_timers

List time timers for the authenticated user in Teamwork..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination. |
| `pageSize` | integer | no | Number of timers per page. |

### Example

```ruby
result = app.integrations.teamwork.list_timers(page: 0, page_size: 0)
```
## teamwork_get_current_user

Get the currently authenticated Teamwork user..

### Example

```ruby
result = app.integrations.teamwork.get_current_user()
```
---

## Multi-Account Usage

If you have multiple teamwork accounts configured, use account-specific namespaces:

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
