# ClickUp — Ruby API Reference

## Priority Mapping

| Value | Level   |
|-------|---------|
| 1     | Urgent  |
| 2     | High    |
| 3     | Normal  |
| 4     | Low     |

```ruby
# Use numeric values for priority
app.integrations.clickup.create_task(list_id: "901234", name: "Fix bug", priority: 1)
# urgent
app.integrations.clickup.update_task(task_id: "abc123", priority: 3)
```
## Date Handling

All dates use ISO 8601 format. The API converts them to Unix milliseconds internally.

```ruby
# Date only
app.integrations.clickup.create_task(list_id: "901234", name: "Sprint review", due_date: "2026-04-01")
# Date with time
app.integrations.clickup.create_task(list_id: "901234", name: "Standup", start_date: "2026-04-01T09:00:00", due_date: "2026-04-01T09:30:00")
# Clear a date by passing empty string
app.integrations.clickup.update_task(task_id: "abc123", due_date: "")
# Filter tasks by due date range
app.integrations.clickup.get_tasks(list_id: "901234", due_date_gt: "2026-03-01", due_date_lt: "2026-03-31")
```
## Member Resolution

Always resolve names to numeric user IDs before assigning tasks.

```ruby
# Find a single member by name or email
result = app.integrations.clickup.find_member(query: "Sarah")
# Returns: { matches: { { id: "12345", username: "sarah", email: "sarah@co.com" } } }
# Resolve multiple names at once
result = app.integrations.clickup.resolve_members(query: "Sarah, John, alex@co.com")
# Returns: { results: { { query: "Sarah", id: "12345", resolved: true }} }
# Use the IDs for assignment (comma-separated string)
app.integrations.clickup.create_task(list_id: "901234", name: "Review PR", assignees: "12345,67890")
```
## Common Workflows

### Create a task with assignees and tags

```ruby
# Step 1: Find the list ID
hierarchy = app.integrations.clickup.get_hierarchy()
# Traverse: hierarchy.spaces[].folders[].lists[] or hierarchy.spaces[].lists[]
# Step 2: Resolve member IDs
members = app.integrations.clickup.resolve_members(query: "Sarah, John")
ids = []
members.results.each do |m|
  if m.resolved
    ids.push(m.id)
  end
end
# Step 3: Create the task
app.integrations.clickup.create_task(list_id: "901234", name: "Implement auth flow", description: "Add OAuth2 login support", status: "open", priority: 2, assignees: ids.join(","), tags: "backend,auth", due_date: "2026-04-15")
```
### Search for tasks, then update them

```ruby
# Search across workspace
results = app.integrations.clickup.search_tasks(query: "auth", statuses: "open,in progress", include_subtasks: true)
# Update each matching task
results.tasks.each do |task|
  app.integrations.clickup.update_task(task_id: task.id, priority: 1, status: "in progress")
end
# Custom task IDs (e.g., "DEV-42") work too
app.integrations.clickup.update_task(task_id: "DEV-42", status: "closed")
```
### Time tracking (start, stop, log)

```ruby
# Start a timer on a task
app.integrations.clickup.start_timer(task_id: "abc123", description: "Working on auth flow", billable: true)
# Check what's currently running
current = app.integrations.clickup.current_time_entry()
# Returns task name, start time, description
# Stop the running timer
app.integrations.clickup.stop_timer()
# Or log time manually (duration in milliseconds)
app.integrations.clickup.log_time(task_id: "abc123", start: "2026-03-29T09:00:00", duration: "3600000", description: "Code review", billable: true)
# View all time entries for a task
entries = app.integrations.clickup.list_time_entries(task_id: "abc123")
```
### Navigate hierarchy (find list and folder IDs)

```ruby
# Get full workspace tree
tree = app.integrations.clickup.get_hierarchy()
# Filter to specific space(s)
tree = app.integrations.clickup.get_hierarchy(space_ids: "12345,67890")
# Get folder details including its lists
folder = app.integrations.clickup.get_folder(folder_id: "456")
# folder.lists = { { id: "789", name: "Backlog" }}
# Get list details
list = app.integrations.clickup.get_list(list_id: "789")
# list.task_count, list.space, list.folder
# Get all tasks in a specific list
tasks = app.integrations.clickup.get_tasks(list_id: "789", statuses: "open,in progress", include_closed: false)
```
### Create a subtask

```ruby
app.integrations.clickup.create_task(list_id: "901234", name: "Write unit tests", parent_task_id: "abc123", priority: 3)
```
### Tags

```ruby
# Add a tag (must already exist in the space)
app.integrations.clickup.add_tag(task_id: "abc123", tag_name: "urgent")
# Remove a tag
app.integrations.clickup.remove_tag(task_id: "abc123", tag_name: "urgent")
# Set tags during task creation
app.integrations.clickup.create_task(list_id: "901234", name: "Deploy", tags: "devops,release")
```
### Attach a file

ClickUp task attachments require multipart upload. Use a readable local path;
public URL passthrough is not supported by ClickUp's v2 task attachment endpoint.

```ruby
app.integrations.clickup.attach_file(task_id: "abc123", file_path: "/tmp/report.pdf", filename: "Q1-report.pdf")
```
## Tips

- **Time durations are in milliseconds**: 1 min = 60000, 1 hour = 3600000, 1 day = 86400000
- **Tags must pre-exist** in the ClickUp space before you can add them to tasks
- **workspace_id** is pulled from config automatically for search, time tracking, and member operations -- you rarely need to pass it explicitly
- **Custom task IDs** like `"DEV-42"` work anywhere a `task_id` is accepted
- **Pagination**: `search_tasks` and `get_tasks` support a `page` parameter (starts at 0)
- **Assignees** use comma-separated numeric user IDs, not names -- always resolve first
- **Statuses** are list-specific strings (e.g., `"open"`, `"in progress"`, `"closed"`) -- check the list for valid values
- **time_estimate** on `update_task` is in **minutes** (converted to ms internally)
- The service layer tracks additional official ClickUp v2/v3 endpoints such as custom fields, checklists, comments, spaces, webhooks, docs, and chat. Only the tools listed in the generated namespace are first-class Ruby tools.

---

## Multi-Account Usage

If you have multiple clickup accounts configured, use account-specific namespaces:

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
