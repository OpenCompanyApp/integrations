# Hubstaff — Ruby API Reference

## list_time_entries

List time entries with optional filters for date range, user, and project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | string | no | Start of the date range (ISO 8601, e.g., `"2026-04-01T00:00:00Z"`) |
| `endTime` | string | no | End of the date range (ISO 8601, e.g., `"2026-04-06T23:59:59Z"`) |
| `userIds` | string | no | Comma-separated user IDs to filter by (e.g., `"123,456"`) |
| `projectId` | integer | no | Project ID to filter time entries by |
| `limit` | integer | no | Max results per page (default: 50, max: 500) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```ruby
result = app.integrations.hubstaff.list_time_entries(start_time: "2026-04-01T00:00:00Z", end_time: "2026-04-06T23:59:59Z", limit: 50)
(result.time_entries || []).each do |entry|
  puts((entry.id).to_s + ": " + (entry.duration).to_s + " seconds")
end
```
---

## get_time_entry

Get details for a specific time entry by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The time entry ID |

### Example

```ruby
result = app.integrations.hubstaff.get_time_entry(id: 12345)
entry = result.time_entry
puts((entry.notes || "No notes"))
```
---

## create_time_entry

Create a new manual time entry for a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The ID of the project to log time against |
| `date` | string | yes | The date for the time entry (ISO 8601, e.g., `"2026-04-06"`) |
| `duration` | integer | yes | Duration in seconds (e.g., 3600 for 1 hour) |
| `notes` | string | no | Notes describing the work performed |

### Example

```ruby
result = app.integrations.hubstaff.create_time_entry(project_id: 100, date: "2026-04-06", duration: 3600, notes: "Code review && bug fixes")
puts("Created time entry: " + (result.time_entry.id).to_s)
```
---

## list_projects

List projects with optional status filter and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"` or `"archived"` |
| `limit` | integer | no | Max results per page (default: 50) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```ruby
result = app.integrations.hubstaff.list_projects(status: "active", limit: 50)
(result.projects || []).each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s + " (" + (project.status).to_s + ")")
end
```
---

## get_project

Get details for a specific project by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```ruby
result = app.integrations.hubstaff.get_project(id: 100)
project = result.project
puts((project.name).to_s + " — " + (project.status).to_s)
```
---

## list_organizations

List organizations the authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 50) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```ruby
result = app.integrations.hubstaff.list_organizations(limit: 50)
(result.organizations || []).each do |org|
  puts((org.id).to_s + ": " + (org.name).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated user. Takes no parameters.

### Example

```ruby
result = app.integrations.hubstaff.get_current_user()
user = result.user
puts("Logged in as: " + (user.name).to_s + " (" + (user.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Hubstaff accounts configured, use account-specific namespaces:

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
