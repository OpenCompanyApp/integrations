# Taiga — Lua API Reference

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

```lua
local result = app.integrations.taiga.list_projects({})

for _, project in ipairs(result) do
  print(project.name .. " (slug: " .. project.slug .. ")")
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

```lua
local result = app.integrations.taiga.get_project({ id = 1 })
print("Project: " .. result.name)
print("Description: " .. (result.description or "N/A"))
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

```lua
-- List all stories in a project
local result = app.integrations.taiga.list_user_stories({
  project = 1,
  page_size = 20
})

for _, story in ipairs(result) do
  print(story.subject .. " — " .. (story.status_extra_info and story.status_extra_info.name or "unknown status"))
end
```

```lua
-- Filter by status
local result = app.integrations.taiga.list_user_stories({
  project = 1,
  status = "In progress"
})
```

---

## get_user_story

Get detailed information about a specific user story.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Taiga user story ID |

### Example

```lua
local result = app.integrations.taiga.get_user_story({ id = 42 })
print("Subject: " .. result.subject)
print("Description: " .. (result.description or "N/A"))
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

```lua
local result = app.integrations.taiga.create_user_story({
  project = 1,
  subject = "As a user, I want to export reports",
  description = "Users should be able to export reports as PDF.",
  tags = { "feature", "reports" }
})

print("Created story #" .. result.id .. ": " .. result.subject)
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

```lua
-- List open issues for a project
local result = app.integrations.taiga.list_issues({
  project = 1,
  status = "New"
})

for _, issue in ipairs(result) do
  print(issue.subject .. " — Priority: " .. (issue.priority_extra_info and issue.priority_extra_info.name or "N/A"))
end
```

```lua
-- List critical issues
local result = app.integrations.taiga.list_issues({
  project = 1,
  priority = "Critical"
})
```

---

## get_current_user

Get the authenticated Taiga user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.taiga.get_current_user({})
print("Logged in as: " .. result.full_name .. " (" .. result.username .. ")")
```

---

## Multi-Account Usage

If you have multiple Taiga accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.taiga.list_projects({})

-- Explicit default (portable across setups)
app.integrations.taiga.default.list_projects({})

-- Named accounts
app.integrations.taiga.work.list_projects({})
app.integrations.taiga.personal.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
