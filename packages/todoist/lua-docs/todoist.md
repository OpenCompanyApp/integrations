# Todoist — Lua API Reference

Todoist is a task management platform for organizing work and life. This integration lets you create, update, complete, and delete tasks; manage projects and sections; add comments; and query labels — all from Lua scripts.

## Authentication

Uses a **Todoist API Token** (personal access token). Generate one in Todoist at **Settings → Integrations → API Token**. The token is sent as a Bearer header on every request. Configure it in your integration settings.

---

## Overview

All tools are called via `app.integrations.todoist.<tool_name>({ ... })`. Every function takes a single Lua table of named parameters and returns a result table.

```lua
local result = app.integrations.todoist.list_tasks({ project_id = "12345" })
```

Errors surface as `result.error` (string). Check for it before using the response.

---

## Tasks

### `app.integrations.todoist.create_task(...)`

Create a new task in Todoist.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content` | string | yes | Task title |
| `project_id` | string | no | Project to add the task to. Omit for the Inbox |
| `section_id` | string | no | Section within the project |
| `description` | string | no | Task description (supports Markdown) |
| `parent_id` | string | no | Parent task ID to create a sub-task |
| `priority` | integer | no | `1` (normal) to `4` (urgent). Default: `1` |
| `labels` | string | no | Comma-separated label names |
| `due_string` | string | no | Natural-language due date (e.g. `"tomorrow"`, `"every Monday"`, `"2026-04-15"`) |

```lua
-- Create a simple task in the Inbox
local task = app.integrations.todoist.create_task({
  content = "Buy groceries",
  due_string = "tomorrow",
  priority = 2
})
print("Created task: " .. task.id)
```

```lua
-- Create a sub-task in a specific project and section
local subtask = app.integrations.todoist.create_task({
  content = "Review API documentation",
  project_id = "2203306141",
  section_id = "7025",
  parent_id = "2995104339",
  description = "Check for accuracy and completeness",
  priority = 3,
  labels = "work,documentation",
  due_string = "next Monday"
})
```

```lua
-- Create a recurring task
local recurring = app.integrations.todoist.create_task({
  content = "Weekly team standup notes",
  project_id = "2203306141",
  due_string = "every Monday at 9am",
  priority = 2
})
```

### `app.integrations.todoist.get_task(...)`

Retrieve a single task by ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Task ID |

```lua
local task = app.integrations.todoist.get_task({ id = "2995104339" })
print(task.content)
print("Due: " .. (task.due and task.due.string or "no due date"))
print("Priority: " .. task.priority)
print("Project: " .. task.project_id)
```

### `app.integrations.todoist.update_task(...)`

Update an existing task. Only include fields you want to change.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Task ID to update |
| `content` | string | no | New task title |
| `description` | string | no | New description (supports Markdown) |
| `priority` | integer | no | `1` (normal) to `4` (urgent) |
| `labels` | string | no | Comma-separated label names (replaces existing) |
| `due_string` | string | no | New due date in natural language |

```lua
-- Change the title and add a due date
local updated = app.integrations.todoist.update_task({
  id = "2995104339",
  content = "Buy groceries and cook dinner",
  due_string = "Friday evening",
  priority = 3
})
```

```lua
-- Clear the due date by updating without one
app.integrations.todoist.update_task({
  id = "2995104339",
  due_string = ""
})
```

### `app.integrations.todoist.delete_task(...)`

Delete a task permanently.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Task ID to delete |

```lua
app.integrations.todoist.delete_task({ id = "2995104339" })
```

> **Note:** This is permanent and irreversible. If you only want to mark a task done, use `close_task` instead.

### `app.integrations.todoist.close_task(...)`

Mark a task as completed.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Task ID to complete |

```lua
app.integrations.todoist.close_task({ id = "2995104339" })
```

### `app.integrations.todoist.reopen_task(...)`

Reopen a completed task.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Task ID to reopen |

```lua
app.integrations.todoist.reopen_task({ id = "2995104339" })
```

### `app.integrations.todoist.list_tasks(...)`

List tasks with optional filters. Returns an array of task objects.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Limit to a specific project |
| `section_id` | string | no | Limit to a specific section |
| `label` | string | no | Filter by label name |
| `filter` | string | no | Todoist filter expression (e.g. `"today"`, `"p1 & @work"`, `"7 days"`) |
| `ids` | string | no | Comma-separated list of task IDs to retrieve |

```lua
-- List all tasks in a project
local tasks = app.integrations.todoist.list_tasks({ project_id = "2203306141" })
for _, t in ipairs(tasks) do
  print(t.content .. " (priority: " .. t.priority .. ")")
end
```

```lua
-- List today's tasks using a filter expression
local today = app.integrations.todoist.list_tasks({ filter = "today" })
for _, t in ipairs(today) do
  print(t.content)
end
```

```lua
-- List tasks with a specific label
local work_tasks = app.integrations.todoist.list_tasks({ label = "work" })
```

```lua
-- Retrieve specific tasks by ID
local specific = app.integrations.todoist.list_tasks({ ids = "2995104339,2995104340" })
```

### `app.integrations.todoist.quick_add(...)`

Add a task using Todoist's natural-language quick-add parser. This supports the same syntax as the Todoist quick-add bar, including inline project (`#Project`), label (`@label`), priority (`p1`–`p4`), and date expressions.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Natural-language task input |

```lua
-- Quick-add with inline metadata
local task = app.integrations.todoist.quick_add({
  text = "Review PR #Work @coding p3 tomorrow"
})
print("Created: " .. task.id)
```

```lua
-- Simple quick-add
local task = app.integrations.todoist.quick_add({
  text = "Call the dentist on Friday"
})
```

```lua
-- Quick-add a recurring task with priority
local task = app.integrations.todoist.quick_add({
  text = "Water plants every 3 days p2"
})
```

---

## Projects

### `app.integrations.todoist.create_project(...)`

Create a new project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Project name |
| `parent_id` | string | no | Parent project ID to create a sub-project |
| `color` | string | no | Color ID (e.g. `"red"`, `"blue"`, `"green"`) |

```lua
-- Create a top-level project
local project = app.integrations.todoist.create_project({
  name = "Q2 Planning",
  color = "blue"
})
print("Project ID: " .. project.id)
```

```lua
-- Create a sub-project
local sub = app.integrations.todoist.create_project({
  name = "Sprint 1",
  parent_id = "2203306141"
})
```

### `app.integrations.todoist.get_project(...)`

Retrieve a single project by ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Project ID |

```lua
local project = app.integrations.todoist.get_project({ id = "2203306141" })
print(project.name)
print("Task count: " .. (project.comment_count or "n/a"))
```

### `app.integrations.todoist.update_project(...)`

Update an existing project. Only include fields you want to change.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Project ID to update |
| `name` | string | no | New project name |
| `color` | string | no | New color ID |

```lua
app.integrations.todoist.update_project({
  id = "2203306141",
  name = "Q2 Planning (Revised)",
  color = "red"
})
```

### `app.integrations.todoist.delete_project(...)`

Delete a project permanently.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Project ID to delete |

```lua
app.integrations.todoist.delete_project({ id = "2203306141" })
```

> **Note:** Deleting a project removes all tasks, sections, and comments inside it. This is irreversible.

### `app.integrations.todoist.list_projects(...)`

List all projects. No parameters required.

```lua
local projects = app.integrations.todoist.list_projects({})
for _, p in ipairs(projects) do
  print(p.name .. " (id: " .. p.id .. ")")
end
```

```lua
-- Find a project by name
local function find_project(name)
  local projects = app.integrations.todoist.list_projects({})
  for _, p in ipairs(projects) do
    if p.name == name then
      return p
    end
  end
  return nil
end

local work = find_project("Work")
if work then
  print("Found Work project: " .. work.id)
end
```

---

## Sections

### `app.integrations.todoist.create_section(...)`

Create a section within a project. Sections help organize tasks into groups (like columns on a Kanban board).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Section name |
| `project_id` | string | yes | Project to create the section in |

```lua
local section = app.integrations.todoist.create_section({
  name = "In Progress",
  project_id = "2203306141"
})
print("Section ID: " .. section.id)
```

```lua
-- Create multiple sections for a Kanban workflow
local project_id = "2203306141"
local sections = { "Backlog", "To Do", "In Progress", "Done" }
for _, name in ipairs(sections) do
  app.integrations.todoist.create_section({
    name = name,
    project_id = project_id
  })
end
```

### `app.integrations.todoist.get_section(...)`

Retrieve a single section by ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Section ID |

```lua
local section = app.integrations.todoist.get_section({ id = "7025" })
print(section.name)
print("Project: " .. section.project_id)
```

### `app.integrations.todoist.delete_section(...)`

Delete a section permanently.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Section ID to delete |

```lua
app.integrations.todoist.delete_section({ id = "7025" })
```

> **Note:** Deleting a section does not delete the tasks inside it — tasks are moved to the project root.

### `app.integrations.todoist.list_sections(...)`

List all sections for a given project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | Project ID to list sections for |

```lua
local sections = app.integrations.todoist.list_sections({ project_id = "2203306141" })
for _, s in ipairs(sections) do
  print(s.name .. " (id: " .. s.id .. ")")
end
```

---

## Comments

### `app.integrations.todoist.create_comment(...)`

Add a comment to a task or a project. Pass either `task_id` or `project_id` (not both).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | conditional | Task ID to comment on (use this or `project_id`) |
| `project_id` | string | conditional | Project ID to comment on (use this or `task_id`) |
| `content` | string | yes | Comment text (supports Markdown) |

```lua
-- Comment on a task
local comment = app.integrations.todoist.create_comment({
  task_id = "2995104339",
  content = "Started working on this — ETA end of week."
})
```

```lua
-- Comment on a project
local comment = app.integrations.todoist.create_comment({
  project_id = "2203306141",
  content = "## Sprint Goals\n- Ship feature A\n- Fix bug #1234"
})
```

### `app.integrations.todoist.list_comments(...)`

List comments for a task or a project. Pass either `task_id` or `project_id` (not both).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | conditional | Task ID to list comments for (use this or `project_id`) |
| `project_id` | string | conditional | Project ID to list comments for (use this or `task_id`) |

```lua
-- List comments on a task
local comments = app.integrations.todoist.list_comments({ task_id = "2995104339" })
for _, c in ipairs(comments) do
  print(c.content)
end
```

```lua
-- List comments on a project
local comments = app.integrations.todoist.list_comments({ project_id = "2203306141" })
for _, c in ipairs(comments) do
  print(c.content)
end
```

---

## Labels

### `app.integrations.todoist.list_labels(...)`

List all personal labels in your Todoist account. No parameters required.

```lua
local labels = app.integrations.todoist.list_labels({})
for _, label in ipairs(labels) do
  print(label.name .. " (id: " .. label.id .. ")")
end
```

```lua
-- Find and use a label ID
local function find_label(name)
  local labels = app.integrations.todoist.list_labels({})
  for _, l in ipairs(labels) do
    if l.name == name then
      return l
    end
  end
  return nil
end

local urgent = find_label("urgent")
if urgent then
  print("Urgent label ID: " .. urgent.id)
end
```

---

## Pagination

List endpoints (`list_tasks`, `list_projects`, `list_sections`, `list_comments`, `list_labels`) return arrays. For Todoist's REST API v2, most list endpoints return up to 200 results by default. When available, use filter parameters to narrow results rather than relying on client-side pagination.

```lua
-- Use filters to limit results
local tasks = app.integrations.todoist.list_tasks({
  project_id = "2203306141",
  filter = "today"
})
```

---

## Complete Examples

### Daily planning workflow

```lua
-- 1. Get today's tasks
local tasks = app.integrations.todoist.list_tasks({ filter = "today" })

print("Today's tasks (" .. #tasks .. "):")
for _, t in ipairs(tasks) do
  local due = t.due and t.due.string or "no date"
  print("  [" .. t.priority .. "] " .. t.content .. " — " .. due)
end

-- 2. Add a new task for today
local new = app.integrations.todoist.create_task({
  content = "Review pull requests",
  project_id = "2203306141",
  priority = 3,
  due_string = "today"
})

-- 3. Add a comment with context
app.integrations.todoist.create_comment({
  task_id = new.id,
  content = "Focus on the auth module PRs"
})
```

### Project setup automation

```lua
-- 1. Create a new project
local project = app.integrations.todoist.create_project({
  name = "Website Redesign",
  color = "green"
})

-- 2. Add sections
local backlog = app.integrations.todoist.create_section({
  name = "Backlog",
  project_id = project.id
})
local in_progress = app.integrations.todoist.create_section({
  name = "In Progress",
  project_id = project.id
})
local review = app.integrations.todoist.create_section({
  name = "Review",
  project_id = project.id
})

-- 3. Populate with tasks
app.integrations.todoist.create_task({
  content = "Design homepage mockup",
  project_id = project.id,
  section_id = backlog.id,
  priority = 4,
  labels = "design",
  due_string = "next week"
})

app.integrations.todoist.create_task({
  content = "Set up CI/CD pipeline",
  project_id = project.id,
  section_id = backlog.id,
  priority = 3,
  labels = "devops",
  due_string = "in 2 weeks"
})

app.integrations.todoist.create_comment({
  project_id = project.id,
  content = "Project kickoff: 2026-04-10"
})
```

### Task completion and reporting

```lua
-- Get all high-priority tasks in a project
local tasks = app.integrations.todoist.list_tasks({
  project_id = "2203306141",
  filter = "p3 | p4"
})

print("High-priority tasks: " .. #tasks)
for _, t in ipairs(tasks) do
  print("  " .. t.content .. " (priority " .. t.priority .. ")")
end

-- Complete finished items
app.integrations.todoist.close_task({ id = "2995104339" })
app.integrations.todoist.close_task({ id = "2995104340" })

-- Verify completion
local remaining = app.integrations.todoist.list_tasks({
  project_id = "2203306141"
})
print("Remaining tasks: " .. #remaining)
```

---

## User

### `app.integrations.todoist.get_current_user(...)`

Get the current authenticated user's profile information. No parameters required.

Returns user details including full name, email, avatar, and plan type.

```lua
local user = app.integrations.todoist.get_current_user({})
print("Connected as: " .. user.full_name .. " (" .. user.email .. ")")
```

---

## Notes

- **Priority values** are inverted compared to display: `1` is normal (no highlight), `4` is urgent (red). Todoist shows them as P4→P1 in the UI.
- **Natural language dates** (`due_string`) support expressions like `"today"`, `"tomorrow"`, `"every Monday"`, `"next Friday"`, `"2026-12-31"`, and `"ev 3 days starting Jan 1"`.
- **Quick-add syntax** in `quick_add` recognizes `#ProjectName`, `@LabelName`, `p1`–`p4`, and date expressions inline in the `text` field.
- **Labels** are referenced by name (string) in `create_task` and `update_task`, not by ID.
- **Comment on task vs. project**: `create_comment` and `list_comments` accept either `task_id` or `project_id` — never both in the same call.
- **Deleting projects** is permanent and removes all contained tasks and sections. Use with caution.
- **Deleting sections** does not delete the tasks within — they move to the project root.
- **Filter expressions** use Todoist's filter syntax, e.g. `"today"`, `"overdue"`, `"p1 & @work"`, `"7 days"`, `"assigned to: me"`. See [Todoist Filters](https://todoist.com/help/articles/introduction-to-filters) for full reference.

---

## Multi-Account Usage

If you have multiple todoist accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.todoist.function_name({...})

-- Explicit default (portable across setups)
app.integrations.todoist.default.function_name({...})

-- Named accounts
app.integrations.todoist.work.function_name({...})
app.integrations.todoist.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
