# Kimai — Ruby API Reference

## list_timesheets

List time-tracking entries with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `size` | integer | no | Number of results per page (default: 50) |
| `user` | string | no | Filter by user ID or username |
| `project` | integer | no | Filter by project ID |
| `begin` | string | no | Filter start date (ISO 8601, e.g., `"2025-01-01T00:00:00"`) |
| `end` | string | no | Filter end date (ISO 8601, e.g., `"2025-01-31T23:59:59"`) |
| `state` | string | no | Filter by state: `"running"` or `"stopped"` |

### Examples

```ruby
# List recent timesheets
result = app.integrations.kimai.list_timesheets(size: 10)
result.each do |entry|
  puts((entry.id).to_s + ": " + (entry.description).to_s)
end
# Filter by project and date range
result = app.integrations.kimai.list_timesheets(project: 5, begin: "2025-01-01T00:00:00", end: "2025-01-31T23:59:59")
```
---

## get_timesheet

Get details of a specific timesheet entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The timesheet entry ID |

### Example

```ruby
result = app.integrations.kimai.get_timesheet(id: 42)
puts("Duration: " + (result.duration).to_s + " seconds")
```
---

## create_timesheet

Create a new time-tracking entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `begin` | string | yes | Start time (ISO 8601, e.g., `"2025-01-15T09:00:00"`) |
| `end` | string | no | End time (ISO 8601). Omit to start a running timer. |
| `project` | integer | yes | Project ID to associate |
| `activity` | integer | no | Activity ID to categorize the entry |
| `description` | string | no | Description of the work performed |

### Examples

```ruby
# Create a completed time entry
result = app.integrations.kimai.create_timesheet(begin: "2025-01-15T09:00:00", end: "2025-01-15T17:00:00", project: 3, activity: 7, description: "Implementing login feature")
# Start a running timer
result = app.integrations.kimai.create_timesheet(begin: "2025-01-15T09:00:00", project: 3)
```
---

## list_projects

List projects with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `size` | integer | no | Results per page (default: 50) |
| `customer` | integer | no | Filter by customer ID |
| `visible` | integer | no | Visibility: 1 = visible, 2 = hidden, 3 = all |

### Example

```ruby
result = app.integrations.kimai.list_projects(customer: 2, visible: 1)
```
---

## get_project

Get details of a specific project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```ruby
result = app.integrations.kimai.get_project(id: 5)
puts("Project: " + (result.name).to_s + " (Customer: " + (result.customer.name).to_s + ")")
```
---

## list_customers

List customers with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `size` | integer | no | Results per page (default: 50) |
| `visible` | integer | no | Visibility: 1 = visible, 2 = hidden, 3 = all |

### Example

```ruby
result = app.integrations.kimai.list_customers(visible: 1)
result.each do |customer|
  puts((customer.id).to_s + ": " + (customer.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated user profile. Takes no parameters.

### Example

```ruby
result = app.integrations.kimai.get_current_user()
puts("Logged in as: " + (result.displayName).to_s)
```
---

## Multi-Account Usage

If you have multiple Kimai accounts configured, use account-specific namespaces:

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
