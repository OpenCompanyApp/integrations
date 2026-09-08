# Taiga — Ruby API Reference

## list_projects

List all Taiga projects you have access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `membership` | string | no | Filter by membership: `"admin"`, `"project_owner"`, `"member"` |
| `slug` | string | no | Filter by project slug |
| `order_by` | string | no | Order results (e.g., `"name"`, `"-created_date"`) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Results per page (default: 40) |

### Example

```ruby
result = app.integrations.taiga.list_projects()
result.each do |project|
  puts((project.name).to_s + " (slug: " + (project.slug).to_s + ")")
end
```
---

## get_project

Get detailed information about a specific Taiga project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Taiga project ID |

### Example

```ruby
result = app.integrations.taiga.get_project(id: 1)
puts("Project: " + (result.name).to_s)
puts("Description: " + ((result.description || "N/A")).to_s)
```
---

## list_user_stories

List user stories, optionally filtered by project, status, milestone, or assignee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project` | integer | no | Filter by project ID |
| `project__slug` | string | no | Filter by project slug |
| `status` | string | no | Filter by status name (e.g., `"New"`, `"In progress"`, `"Done"`) |
| `milestone` | integer | no | Filter by milestone (sprint) ID |
| `assigned_to` | integer | no | Filter by assigned user ID |
| `tags` | string | no | Filter by tags (comma-separated) |
| `order_by` | string | no | Order results (e.g., `"subject"`, `"-created_date"`) |
| `page` | integer | no | Page number for pagination |
| `page_size` | integer | no | Results per page |

### Example

```ruby
# List all stories in a project
result = app.integrations.taiga.list_user_stories(project: 1, page_size: 20)
result.each do |story|
  puts((story.subject).to_s + " — " + (((story.status_extra_info && story.status_extra_info.name) || "unknown status")).to_s)
end
```
```ruby
# Filter by status
result = app.integrations.taiga.list_user_stories(project: 1, status: "In progress")
```
---

## get_user_story

Get detailed information about a specific user story.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Taiga user story ID |

### Example

```ruby
result = app.integrations.taiga.get_user_story(id: 42)
puts("Subject: " + (result.subject).to_s)
puts("Description: " + ((result.description || "N/A")).to_s)
```
---

## create_user_story

Create a new user story in a Taiga project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project` | integer | yes | Project ID |
| `subject` | string | yes | User story title |
| `description` | string | no | Description (supports Markdown) |
| `status` | integer | no | Status ID |
| `assigned_to` | integer | no | User ID to assign |
| `milestone` | integer | no | Milestone (sprint) ID |
| `tags` | array | no | Array of tag strings |
| `points` | object | no | Story points (role ID → point value) |

### Example

```ruby
result = app.integrations.taiga.create_user_story(project: 1, subject: "As a user, I want to export reports", description: "Users should be able to export reports as PDF.", tags: ["feature", "reports"])
puts("Created story #" + (result.id).to_s + ": " + (result.subject).to_s)
```
---

## list_issues

List issues, optionally filtered by project, status, priority, or severity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project` | integer | no | Filter by project ID |
| `project__slug` | string | no | Filter by project slug |
| `status` | string | no | Filter by status name |
| `priority` | string | no | Filter by priority (`"Low"`, `"Normal"`, `"High"`, `"Critical"`) |
| `severity` | string | no | Filter by severity (`"Wishlist"`, `"Minor"`, `"Normal"`, `"Important"`, `"Critical"`) |
| `assigned_to` | integer | no | Filter by assigned user ID |
| `tags` | string | no | Filter by tags (comma-separated) |
| `order_by` | string | no | Order results |
| `page` | integer | no | Page number for pagination |
| `page_size` | integer | no | Results per page |

### Example

```ruby
# List open issues for a project
result = app.integrations.taiga.list_issues(project: 1, status: "New")
result.each do |issue|
  puts((issue.subject).to_s + " — Priority: " + (((issue.priority_extra_info && issue.priority_extra_info.name) || "N/A")).to_s)
end
```
```ruby
# List critical issues
result = app.integrations.taiga.list_issues(project: 1, priority: "Critical")
```
---

## get_current_user

Get the authenticated Taiga user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.taiga.get_current_user()
puts("Logged in as: " + (result.full_name).to_s + " (" + (result.username).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Taiga accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.taiga.list_projects()
# Explicit default (portable across setups)
app.integrations.taiga.default.list_projects()
# Named accounts
app.integrations.taiga.work.list_projects()
app.integrations.taiga.personal.list_projects()
```
All functions are identical across accounts — only the credentials differ.
