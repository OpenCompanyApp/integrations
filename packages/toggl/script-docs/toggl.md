# Toggl — Ruby API Reference

## toggl_list_workspaces

List all Toggl workspaces the authenticated user belongs to.

### Parameters

_None_

### Example

```ruby
workspaces = app.integrations.toggl.list_workspaces()
workspaces.each do |ws|
  puts((ws.id).to_s + ": " + (ws.name).to_s)
end
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

```ruby
projects = app.integrations.toggl.list_projects(workspace_id: "123456")
projects.each do |p|
  puts((p.id).to_s + ": " + (p.name).to_s)
end
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

```ruby
project = app.integrations.toggl.get_project(workspace_id: "123456", project_id: "789012")
puts((project.name).to_s + " — " + (((project.active && "active") || "inactive")).to_s)
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

```ruby
entries = app.integrations.toggl.list_time_entries(start_date: "2026-04-01", end_date: "2026-04-05")
entries.each do |e|
  puts((e.description).to_s + ": " + (e.start).to_s + " → " + ((e.stop || "running")).to_s)
end
```
---

## toggl_get_time_entry

Get details for a single Toggl time entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `time_entry_id` | string | yes | The time entry ID |

### Example

```ruby
entry = app.integrations.toggl.get_time_entry(time_entry_id: "1234567890")
puts(entry.description)
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

```ruby
entry = app.integrations.toggl.create_time_entry(workspace_id: "123456", description: "Worked on API integration", start: "2026-04-05T09:00:00Z", stop: "2026-04-05T12:30:00Z", project_id: "789012", tags: ["development", "backend"])
puts("Created entry: " + (entry.id).to_s)
```
### Start a running timer

```ruby
entry = app.integrations.toggl.create_time_entry(workspace_id: "123456", description: "Meeting with team")
puts("Timer started: " + (entry.id).to_s)
```
---

## toggl_get_current_user

Get the authenticated Toggl user profile. Useful for verifying API token validity.

### Parameters

_None_

### Example

```ruby
user = app.integrations.toggl.get_current_user()
puts((user.fullname).to_s + " <" + (user.email).to_s + ">")
```
---

## Multi-Account Usage

If you have multiple Toggl accounts configured, use account-specific namespaces:

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
