# Clockify — JavaScript API Reference

## clockify_list_workspaces

List all Clockify workspaces the authenticated user belongs to.

### Parameters

_None_

### Example

```js
var workspaces = app.integrations.clockify.list_workspaces()

for (const ws of (workspaces)) {
  console.log(ws.id + ": " + ws.name)
}
```
---

## clockify_get_workspace

Get details for a single Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |

### Example

```js
var ws = app.integrations.clockify.get_workspace({
  workspace_id: "abc123",
})
console.log(ws.name)
```
---

## clockify_list_projects

List projects in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `name` | string | no | Filter by project name (partial match) |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```js
var projects = app.integrations.clockify.list_projects({
  workspace_id: "abc123",
  name: "Marketing",
})

for (const p of (projects)) {
  console.log(p.id + ": " + p.name)
}
```
---

## clockify_get_project

Get details for a single Clockify project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |

### Example

```js
var project = app.integrations.clockify.get_project({
  workspace_id: "abc123",
  project_id: "proj456",
})
console.log(project.name + " — " + project.color)
```
---

## clockify_create_project

Create a new project in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `name` | string | yes | Project name |
| `color` | string | no | Hex color code (e.g. `"#ff0000"`, default: `"#03a9f4"`) |
| `is_public` | boolean | no | Whether the project is publicly visible (default: `false`) |

### Example

```js
var project = app.integrations.clockify.create_project({
  workspace_id: "abc123",
  name: "Website Redesign",
  color: "#e91e63",
  is_public: true,
})
console.log("Created project: " + project.id)
```
---

## clockify_list_time_entries

List time entries in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `start` | string | no | Start date filter (ISO 8601, e.g. `"2026-01-01T00:00:00Z"`) |
| `end` | string | no | End date filter (ISO 8601) |
| `project` | string | no | Filter by project ID |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```js
var entries = app.integrations.clockify.list_time_entries({
  workspace_id: "abc123",
  start: "2026-04-01T00:00:00Z",
  end: "2026-04-05T23:59:59Z",
})

for (const e of (entries)) {
  console.log(e.description + ": " + e.timeInterval.start + " → " + e.timeInterval.end)
}
```
### Filter by project

```js
var entries = app.integrations.clockify.list_time_entries({
  workspace_id: "abc123",
  project: "proj456",
})
```
---

## clockify_get_time_entry

Get details for a single Clockify time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID |

### Example

```js
var entry = app.integrations.clockify.get_time_entry({
  workspace_id: "abc123",
  time_entry_id: "entry789",
})
console.log(entry.description)
```
---

## clockify_create_time_entry

Create a new time entry in a Clockify workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `start` | string | yes | Start time (ISO 8601, e.g. `"2026-04-05T09:00:00Z"`) |
| `end` | string | yes | End time (ISO 8601, e.g. `"2026-04-05T17:00:00Z"`) |
| `description` | string | no | Description of the time entry |
| `project_id` | string | no | Project ID to assign the time entry to |

### Example

```js
var entry = app.integrations.clockify.create_time_entry({
  workspace_id: "abc123",
  start: "2026-04-05T09:00:00Z",
  end: "2026-04-05T12:30:00Z",
  description: "Worked on API integration",
  project_id: "proj456",
})
console.log("Created entry: " + entry.id)
```
---

## clockify_update_time_entry

Update an existing Clockify time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID |
| `start` | string | no | New start time (ISO 8601) |
| `end` | string | no | New end time (ISO 8601) |
| `description` | string | no | New description |
| `project_id` | string | no | New project ID to assign |

### Example

```js
var entry = app.integrations.clockify.update_time_entry({
  workspace_id: "abc123",
  time_entry_id: "entry789",
  description: "Updated description",
  end: "2026-04-05T14:00:00Z",
})
console.log("Updated entry: " + entry.id)
```
---

## clockify_delete_time_entry

Delete a Clockify time entry. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `time_entry_id` | string | yes | The time entry ID to delete |

### Example

```js
app.integrations.clockify.delete_time_entry({
  workspace_id: "abc123",
  time_entry_id: "entry789",
})
console.log("Time entry deleted.")
```
---

## clockify_list_tasks

List tasks for a Clockify project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |
| `page` | integer | no | Page number, 1-based (default: 1) |
| `page_size` | integer | no | Items per page (default: 50) |

### Example

```js
var tasks = app.integrations.clockify.list_tasks({
  workspace_id: "abc123",
  project_id: "proj456",
})

for (const t of (tasks)) {
  console.log(t.id + ": " + t.name + " (" + t.status + ")")
}
```
---

## clockify_get_current_user

Get the authenticated Clockify user profile. Useful for verifying API key validity.

### Parameters

_None_

### Example

```js
var user = app.integrations.clockify.get_current_user()
console.log(user.name + " <" + user.email + ">")
```
---

## Multi-Account Usage

If you have multiple Clockify accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.clockify.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.clockify.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.clockify.work.function_name({ /* parameters */ })
app.integrations.clockify.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
