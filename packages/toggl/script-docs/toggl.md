# Toggl — JavaScript API Reference

## toggl_list_workspaces

List all Toggl workspaces the authenticated user belongs to.

### Parameters

_None_

### Example

```js
var workspaces = app.integrations.toggl.list_workspaces()

for (const ws of (workspaces)) {
  console.log(ws.id + ": " + ws.name)
}
```
---

## toggl_list_projects

List projects in a Toggl workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `active` | boolean | no | Filter for active projects only (default: `true`) |

### Example

```js
var projects = app.integrations.toggl.list_projects({
  workspace_id: "123456",
})

for (const p of (projects)) {
  console.log(p.id + ": " + p.name)
}
```
---

## toggl_get_project

Get details for a single Toggl project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `project_id` | string | yes | The project ID |

### Example

```js
var project = app.integrations.toggl.get_project({
  workspace_id: "123456",
  project_id: "789012",
})
console.log(project.name + " — " + (project.active && "active" || "inactive"))
```
---

## toggl_list_time_entries

List recent Toggl time entries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | no | Start date filter (ISO 8601 date, e.g. `"2026-01-01"`) |
| `end_date` | string | no | End date filter (ISO 8601 date) |

### Example

```js
var entries = app.integrations.toggl.list_time_entries({
  start_date: "2026-04-01",
  end_date: "2026-04-05",
})

for (const e of (entries)) {
  console.log(e.description + ": " + e.start + " → " + (e.stop || "running"))
}
```
---

## toggl_get_time_entry

Get details for a single Toggl time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `time_entry_id` | string | yes | The time entry ID |

### Example

```js
var entry = app.integrations.toggl.get_time_entry({
  time_entry_id: "1234567890",
})
console.log(entry.description)
```
---

## toggl_create_time_entry

Create a new time entry in a Toggl workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | string | yes | The workspace ID |
| `description` | string | no | Description of the time entry |
| `start` | string | no | Start time (ISO 8601, e.g. `"2026-04-05T09:00:00Z"`). Defaults to now. |
| `stop` | string | no | Stop time (ISO 8601). Omit for a running timer. |
| `duration` | integer | no | Duration in seconds. Use -1 for a running timer (default: -1) |
| `project_id` | string | no | Project ID to assign the time entry to |
| `tags` | array | no | Tags for the time entry |

### Example

```js
var entry = app.integrations.toggl.create_time_entry({
  workspace_id: "123456",
  description: "Worked on API integration",
  start: "2026-04-05T09:00:00Z",
  stop: "2026-04-05T12:30:00Z",
  project_id: "789012",
  tags: [ "development", "backend" ],
})
console.log("Created entry: " + entry.id)
```
### Start a running timer

```js
var entry = app.integrations.toggl.create_time_entry({
  workspace_id: "123456",
  description: "Meeting with team",
})
console.log("Timer started: " + entry.id)
```
---

## toggl_get_current_user

Get the authenticated Toggl user profile. Useful for verifying API token validity.

### Parameters

_None_

### Example

```js
var user = app.integrations.toggl.get_current_user()
console.log(user.fullname + " <" + user.email + ">")
```
---

## Multi-Account Usage

If you have multiple Toggl accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.toggl.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.toggl.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.toggl.work.function_name({ /* parameters */ })
app.integrations.toggl.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
