# Basecamp 3 — Ruby API Reference

## list_projects

List all Basecamp projects visible to the authenticated user.

### Parameters

*None required.*

### Example

```ruby
result = app.integrations.basecamp.list_projects()
result.each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s)
end
```
---

## get_project

Get details for a single Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```ruby
result = app.integrations.basecamp.get_project(project_id: 12345)
puts("Project: " + (result.name).to_s)
puts("Description: " + ((result.description || "none")).to_s)
```
---

## list_todos

List to-dos in a specific Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |

### Example

```ruby
result = app.integrations.basecamp.list_dos(project_id: 12345, todoset_id: 67890, todolist_id: 11111)
result.each do |todo|
  puts((todo.content + ((todo.completed && " ✓") || " ○")))
end
```
---

## create_todo

Create a new to-do in a Basecamp to-do list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `todoset_id` | integer | yes | The to-do set (bucket) ID within the project |
| `todolist_id` | integer | yes | The specific to-do list ID |
| `content` | string | yes | The to-do text |
| `description` | string | no | Extended description (HTML supported) |
| `due_on` | string | no | Due date in ISO 8601 format (e.g., "2026-04-30") |
| `assignee_ids` | array | no | List of person IDs to assign (e.g., {1234, 5678}) |

### Example

```ruby
result = app.integrations.basecamp.create_do(project_id: 12345, todoset_id: 67890, todolist_id: 11111, content: "Review the latest pull request", description: "Check PR #42 for the auth module changes", due_on: "2026-04-30")
puts("Created to-do: " + (result.content).to_s)
```
---

## list_messages

List messages (message board posts) for a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |

### Example

```ruby
result = app.integrations.basecamp.list_messages(project_id: 12345)
result.each do |msg|
  puts((msg.subject).to_s + " by " + ((msg.creator.name || "unknown")).to_s)
end
```
---

## get_message

Get a single message from a Basecamp project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | yes | The Basecamp project ID |
| `message_id` | integer | yes | The message (board post) ID |

### Example

```ruby
result = app.integrations.basecamp.get_message(project_id: 12345, message_id: 99999)
puts("Subject: " + (result.subject).to_s)
puts("By: " + (result.creator.name).to_s)
```
---

## get_current_user

Get the profile of the currently authenticated Basecamp user.

### Parameters

*None required.*

### Example

```ruby
result = app.integrations.basecamp.get_current_user()
puts("Logged in as: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email_address).to_s)
```
---

## Multi-Account Usage

If you have multiple Basecamp accounts configured, use account-specific namespaces:

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
