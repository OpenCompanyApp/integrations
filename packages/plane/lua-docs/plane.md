# Plane.so — Lua API Reference

If you configure a default `workspace_slug`, most tools can omit `workspace_slug` and will use that default automatically.
On some self-hosted Plane deployments, user and workspace-list endpoints are limited; this integration falls back to workspace-scoped project access where needed.

## list_workspaces

List all Plane.so workspaces the authenticated user belongs to.
On self-hosted deployments that do not expose the workspace-list endpoint, this returns the configured default workspace after verifying access.

### Parameters

None.

### Example

```lua
local result = app.integrations.plane.list_workspaces()

for _, ws in ipairs(result.workspaces) do
  print(ws.slug .. " — " .. ws.name)
end
```

---

## list_projects

List all projects in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug (e.g., `"my-team"`) |

### Example

```lua
local result = app.integrations.plane.list_projects({
  workspace_slug = "my-team"
})

for _, proj in ipairs(result.projects) do
  print(proj.identifier .. " — " .. proj.name)
end
```

---

## list_issues

List issues in a project with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `state` | string | no | Filter by state UUID |
| `priority` | string | no | Filter by priority: `urgent`, `high`, `medium`, `low`, `none` |
| `assignee` | string | no | Filter by assignee UUID |
| `labels` | string | no | Comma-separated label UUIDs |
| `search` | string | no | Search query for issue name |
| `parent` | string | no | Filter by parent issue UUID |
| `cycle` | string | no | Filter by cycle UUID |
| `module` | string | no | Filter by module UUID |

### Example

```lua
local result = app.integrations.plane.list_issues({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  priority = "high"
})

for _, issue in ipairs(result.issues) do
  print("#" .. issue.sequence_id .. " " .. issue.name .. " [" .. (issue.priority or "none") .. "]")
end
```

---

## get_issue

Get detailed information about a single issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local issue = app.integrations.plane.get_issue({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi"
})

print(issue.name)
print(issue.description_html)
print("Priority: " .. (issue.priority or "none"))
```

---

## create_issue

Create a new issue in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | yes | Issue title |
| `description_html` | string | no | Description in HTML |
| `state` | string | no | State UUID |
| `priority` | string | no | `urgent`, `high`, `medium`, `low`, `none` |
| `assignees` | array | no | Array of user UUIDs |
| `labels` | array | no | Array of label UUIDs |
| `start_date` | string | no | Start date (YYYY-MM-DD) |
| `target_date` | string | no | Due date (YYYY-MM-DD) |
| `parent` | string | no | Parent issue UUID for sub-issues |

### Example

```lua
local issue = app.integrations.plane.create_issue({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "Fix login redirect bug",
  description_html = "<p>Users are redirected to 404 after login.</p>",
  priority = "high",
  target_date = "2026-04-15"
})

print("Created issue #" .. issue.sequence_id .. ": " .. issue.name)
```

---

## update_issue

Update an existing issue. Only provide fields you want to change.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |
| `name` | string | no | New title |
| `description_html` | string | no | New description (HTML) |
| `state` | string | no | New state UUID |
| `priority` | string | no | New priority |
| `assignees` | array | no | New assignee UUIDs (replaces existing) |
| `labels` | array | no | New label UUIDs (replaces existing) |
| `start_date` | string | no | New start date |
| `target_date` | string | no | New due date |
| `parent` | string | no | New parent issue UUID |

### Example

```lua
local issue = app.integrations.plane.update_issue({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi",
  state = "done-state-uuid",
  priority = "low"
})

print("Updated issue #" .. issue.sequence_id)
```

---

## delete_issue

Delete an issue permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local result = app.integrations.plane.delete_issue({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi"
})

print("Deleted: " .. tostring(result.deleted))
```

---

## list_cycles

List all cycles in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.list_cycles({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, cycle in ipairs(result.cycles) do
  print(cycle.name .. " (" .. (cycle.start_date or "?") .. " → " .. (cycle.end_date or "?") .. ")")
end
```

---

## add_issue_to_cycle

Add an issue to a cycle.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `cycle_id` | string | yes | Cycle UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local result = app.integrations.plane.add_issue_to_cycle({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  cycle_id = "cycle-uuid-here",
  issue_id = "issue-uuid-here"
})

print("Added to cycle: " .. tostring(result.added))
```

---

## list_modules

List all modules in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.list_modules({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, mod in ipairs(result.modules) do
  print(mod.name .. " — status: " .. (mod.status or "none"))
end
```

---

## add_issue_to_module

Add an issue to a module.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `module_id` | string | yes | Module UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local result = app.integrations.plane.add_issue_to_module({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  module_id = "module-uuid-here",
  issue_id = "issue-uuid-here"
})

print("Added to module: " .. tostring(result.added))
```

---

## list_members

List members of a workspace or project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | no | Project UUID (if omitted, lists workspace members) |

### Example

```lua
-- List workspace members
local result = app.integrations.plane.list_members({
  workspace_slug = "my-team"
})

-- List project members only
local result = app.integrations.plane.list_members({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, member in ipairs(result.members) do
  print(member.display_name .. " <" .. (member.email or "") .. "> — " .. (member.role or ""))
end
```

---

---

## list_states

List workflow states in a project. Use state UUIDs when creating or updating issues.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.list_states({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, state in ipairs(result.states) do
  print(state.name .. " [" .. (state.group or "") .. "] = " .. state.id)
end
```

---

## list_labels

List labels in a project. Use label UUIDs when creating or updating issues.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.list_labels({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, label in ipairs(result.labels) do
  print(label.name .. " (color: " .. (label.color or "?") .. ") = " .. label.id)
end
```

---

## create_comment

Add a comment to an issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |
| `comment_html` | string | yes | Comment content in HTML format |

### Example

```lua
local result = app.integrations.plane.create_comment({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi",
  comment_html = "<p>Investigating — looks like a redirect config issue.</p>"
})

print("Comment created: " .. result.id)
```

---

## list_comments

List all comments on an issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local result = app.integrations.plane.list_comments({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi"
})

for _, comment in ipairs(result.comments) do
  print("[" .. (comment.created_at or "") .. "] " .. (comment.comment_html or ""))
end
```

---

## search_issues

Search issues across all projects in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `search` | string | yes | Search query |
| `project` | string | no | Filter by project UUID |
| `state` | string | no | Filter by state UUID |
| `priority` | string | no | Filter by priority |
| `assignee` | string | no | Filter by assignee UUID |

### Example

```lua
local result = app.integrations.plane.search_issues({
  workspace_slug = "my-team",
  search = "login bug"
})

for _, issue in ipairs(result.issues) do
  print("#" .. (issue.sequence_id or "?") .. " " .. issue.name)
end
```

---

## get_project

Get detailed information about a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local project = app.integrations.plane.get_project({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

print(project.name .. " (" .. project.identifier .. ")")
print("Active: " .. tostring(project.is_active))
```

---

## create_project

Create a new project in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `name` | string | yes | Project name |
| `identifier` | string | yes | Short code (max 12 chars, e.g., `"PROJ"`) |
| `description` | string | no | Project description |
| `cover_image` | string | no | Cover image URL |
| `project_lead` | string | no | UUID of project lead |
| `default_assignee` | string | no | UUID of default assignee |

### Example

```lua
local project = app.integrations.plane.create_project({
  workspace_slug = "my-team",
  name = "Website Redesign",
  identifier = "REDESIGN",
  description = "Full redesign of the marketing website"
})

print("Created project: " .. project.name .. " (" .. project.identifier .. ")")
```

---

## list_issue_activities

List activity/audit events on an issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |

### Example

```lua
local result = app.integrations.plane.list_issue_activities({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi"
})

for _, act in ipairs(result.activities) do
  print((act.created_at or "") .. " — " .. (act.action or "") .. " " .. (act.field or ""))
end
```

---

## create_issue_link

Attach an external link to an issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |
| `title` | string | yes | Display title for the link |
| `url` | string | yes | The URL to link to |

### Example

```lua
local result = app.integrations.plane.create_issue_link({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi",
  title = "Design mockup",
  url = "https://figma.com/file/abc123"
})

print("Link added: " .. result.title)
```

---

## list_issue_relations

List relations on an issue (blocking, duplicate, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `issue_id` | string | yes | Issue UUID |

### Relation Types

`blocking`, `blocked_by`, `duplicate`, `relates_to`, `start_before`, `start_after`, `finish_before`, `finish_after`

### Example

```lua
local result = app.integrations.plane.list_issue_relations({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  issue_id = "xyz-456-ghi"
})

for _, rel in ipairs(result.relations) do
  print(rel.relation_type .. " → " .. (rel.related_issue or "?"))
end
```

---

## get_current_user

Get the currently authenticated Plane.so user. Useful for verifying credentials.
On self-hosted deployments where the user endpoint is unavailable, this falls back to a workspace access probe and returns `workspace_slug` with a synthetic display name.

### Parameters

None.

### Example

```lua
local user = app.integrations.plane.get_current_user()

print(user.display_name .. " <" .. (user.email or "") .. ">")
print("User ID: " .. user.id)
```

---

## get_cycle

Get details of a specific cycle.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `cycle_id` | string | yes | Cycle UUID |

### Example

```lua
local cycle = app.integrations.plane.get_cycle({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  cycle_id = "cycle-uuid"
})

print(cycle.name .. ": " .. (cycle.start_date or "?") .. " → " .. (cycle.end_date or "?"))
print("Active: " .. tostring(cycle.is_active))
```

---

## create_cycle

Create a new cycle (sprint) in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | no | Cycle name (e.g., `"Sprint 14"`) |
| `description` | string | no | Cycle description |
| `start_date` | string | no | Start date (YYYY-MM-DD) |
| `end_date` | string | no | End date (YYYY-MM-DD) |

### Example

```lua
local cycle = app.integrations.plane.create_cycle({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "Sprint 15",
  start_date = "2026-04-14",
  end_date = "2026-04-28"
})

print("Created cycle: " .. (cycle.name or "unnamed"))
```

---

## get_module

Get details of a specific module.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `module_id` | string | yes | Module UUID |

### Example

```lua
local mod = app.integrations.plane.get_module({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  module_id = "module-uuid"
})

print(mod.name .. " — status: " .. (mod.status or "none"))
```

---

## create_module

Create a new module in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | yes | Module name |
| `description` | string | no | Module description |
| `status` | string | no | Module status |
| `start_date` | string | no | Start date (YYYY-MM-DD) |
| `target_date` | string | no | Target date (YYYY-MM-DD) |

### Example

```lua
local mod = app.integrations.plane.create_module({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "Authentication System",
  description = "OAuth2 + SSO integration",
  target_date = "2026-05-01"
})

print("Created module: " .. mod.name)
```

---

## create_state

Create a workflow state in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | yes | State name (e.g., `"In Review"`) |
| `group` | string | yes | One of: `backlog`, `unstarted`, `started`, `completed`, `cancelled` |
| `color` | string | no | Hex color code (e.g., `"#FF5733"`) |
| `description` | string | no | State description |
| `slug` | string | no | URL-friendly slug |

### Example

```lua
local state = app.integrations.plane.create_state({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "Ready for QA",
  group = "started",
  color = "#FFA500"
})

print("Created state: " .. state.name .. " [" .. state.group .. "] = " .. state.id)
```

---

## create_label

Create a label in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | yes | Label name |
| `color` | string | no | Hex color code |
| `description` | string | no | Label description |
| `parent` | string | no | Parent label UUID for hierarchy |

### Example

```lua
local label = app.integrations.plane.create_label({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "bug",
  color = "#FF0000"
})

print("Created label: " .. label.name .. " = " .. label.id)
```

---

## archive_project

Archive a project. Hidden from active views but data is retained.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.archive_project({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

print("Archived: " .. tostring(result.archived))
```

---

## list_pages

List pages in a project. Pages are Notion-like documents.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |

### Example

```lua
local result = app.integrations.plane.list_pages({
  workspace_slug = "my-team",
  project_id = "abc-123-def"
})

for _, page in ipairs(result.pages) do
  print(page.name .. " (updated: " .. (page.updated_at or "?") .. ")")
end
```

---

## get_page

Get full content of a page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `page_id` | string | yes | Page UUID |

### Example

```lua
local page = app.integrations.plane.get_page({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  page_id = "page-uuid"
})

print(page.name)
print(page.description_html)
```

---

## create_page

Create a new page in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug |
| `project_id` | string | yes | Project UUID |
| `name` | string | yes | Page title |
| `description_html` | string | no | Page content in HTML |

### Example

```lua
local page = app.integrations.plane.create_page({
  workspace_slug = "my-team",
  project_id = "abc-123-def",
  name = "API Design Notes",
  description_html = "<h2>Endpoints</h2><p>POST /api/v1/users</p>"
})

print("Created page: " .. page.name .. " = " .. page.id)
```

---

## Webhooks

The `plane_webhook` trigger receives Plane.so workspace events. Configure it with a workspace slug and optional project scope.

### Trigger Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug to listen on |
| `project_id` | string | no | Scope to a specific project |

---

## Multi-Account Usage

If you have multiple Plane.so accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.plane.list_workspaces()

-- Explicit default (portable across setups)
app.integrations.plane.default.list_workspaces()

-- Named accounts
app.integrations.plane.self_hosted.list_workspaces()
app.integrations.plane.cloud.list_workspaces()
```

All functions are identical across accounts — only the credentials differ.
