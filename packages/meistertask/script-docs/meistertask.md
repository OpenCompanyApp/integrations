# MeisterTask — JavaScript API Reference

## list_projects

List all MeisterTask projects the authenticated user has access to.

### Parameters

No parameters required.

### Example

```js
var result = app.integrations.meistertask.list_projects({})

for (const project of (result)) {
  console.log(project.id + ": " + project.name)
}
```
---

## get_project

Get detailed information about a specific MeisterTask project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```js
var result = app.integrations.meistertask.get_project({
  id: 12345,
})

console.log("Project: " + result.name)
console.log("Status: " + result.status)
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

```js
var result = app.integrations.meistertask.create_task({
  project_id: 12345,
  name: "Review quarterly report",
  description: "Check all numbers && update the summary section.",
  due_date: "2026-04-30",
  priority: 3,
})

console.log("Created task #" + result.id + ": " + result.name)
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

```js
// List open tasks in a specific project
var result = app.integrations.meistertask.list_tasks({
  project_id: 12345,
  status: "open",
})

for (const task of (result)) {
  console.log(task.id + ": " + task.name + " (due: " + (task.due_date || "none") + ")")
}
```
---

## get_task

Get detailed information about a specific task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The task ID |

### Example

```js
var result = app.integrations.meistertask.get_task({
  id: 67890,
})

console.log("Task: " + result.name)
console.log("Status: " + result.status)
console.log("Description: " + (result.description || "No description"))
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

```js
// Complete a task
var result = app.integrations.meistertask.update_task({
  id: 67890,
  status: "completed",
})

console.log("Task " + result.id + " is now " + result.status)

// Update due date and assignee
var result2 = app.integrations.meistertask.update_task({
  id: 67891,
  due_date: "2026-05-15",
  assignee_id: 42,
})
```
---

## get_current_user

Get the authenticated user's profile.

### Parameters

No parameters required.

### Example

```js
var result = app.integrations.meistertask.get_current_user({})

console.log("Logged in as: " + result.first_name + " " + result.last_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple MeisterTask accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.meistertask.list_projects({})

// Explicit default (portable across setups)
app.integrations.meistertask.default.list_projects({})

// Named accounts
app.integrations.meistertask.work.list_projects({})
app.integrations.meistertask.personal.list_projects({})
```
All functions are identical across accounts — only the credentials differ.
