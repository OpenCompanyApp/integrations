# Client for the Teamwork REST API — JavaScript API Reference

## teamwork_list_projects

List projects in Teamwork with optional filters..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by project status (e.g. "active", "late", "completed"). |
| `page` | integer | no | Page number for pagination. |
| `pageSize` | integer | no | Number of projects per page (max 500). |

### Example

```js
var result = app.integrations.teamwork.teamwork_list_projects({
  status: "",
  page: 0,
  pageSize: 0,
})
```
## teamwork_get_project

Get detailed information about a Teamwork project..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID. |

### Example

```js
var result = app.integrations.teamwork.teamwork_get_project({
  id: 0,
})
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

```js
var result = app.integrations.teamwork.teamwork_list_tasks({
  projectId: 0,
  page: 0,
  pageSize: 0,
})
```
## teamwork_get_task

Get detailed information about a Teamwork task..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The task ID. |

### Example

```js
var result = app.integrations.teamwork.teamwork_get_task({
  id: 0,
})
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

```js
var result = app.integrations.teamwork.teamwork_create_task({
  projectId: 0,
  name: "",
  description: "",
})
```
## teamwork_list_timers

List time timers for the authenticated user in Teamwork..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination. |
| `pageSize` | integer | no | Number of timers per page. |

### Example

```js
var result = app.integrations.teamwork.teamwork_list_timers({
  page: 0,
  pageSize: 0,
})
```
## teamwork_get_current_user

Get the currently authenticated Teamwork user..

### Example

```js
var result = app.integrations.teamwork.teamwork_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple teamwork accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.teamwork.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.teamwork.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.teamwork.work.function_name({ /* parameters */ })
app.integrations.teamwork.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
