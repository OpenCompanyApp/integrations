# Plane.so — Ruby API Reference

If you configure a default `workspace_slug`, most tools can omit `workspace_slug` and will use that default automatically.
On some self-hosted Plane deployments, user and workspace-list endpoints are limited; this integration falls back to workspace-scoped project access where needed.

## list_workspaces

List all Plane.so workspaces the authenticated user belongs to.
On self-hosted deployments that do not expose the workspace-list endpoint, this returns the configured default workspace after verifying access.

### Parameters

None.

### Example

```ruby
result = app.integrations.plane.list_workspaces()
result.workspaces.each do |ws|
  puts((ws.slug).to_s + " — " + (ws.name).to_s)
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

```ruby
result = app.integrations.plane.list_projects(workspace_slug: "my-team")
result.projects.each do |proj|
  puts((proj.identifier).to_s + " — " + (proj.name).to_s)
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

```ruby
result = app.integrations.plane.list_issues(workspace_slug: "my-team", project_id: "abc-123-def", priority: "high")
result.issues.each do |issue|
  puts("#" + (issue.sequence_id).to_s + " " + (issue.name).to_s + " [" + ((issue.priority || "none")).to_s + "]")
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

```ruby
issue = app.integrations.plane.get_issue(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi")
puts(issue.name)
puts(issue.description_html)
puts("Priority: " + ((issue.priority || "none")).to_s)
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

```ruby
issue = app.integrations.plane.create_issue(workspace_slug: "my-team", project_id: "abc-123-def", name: "Fix login redirect bug", description_html: "<p>Users are redirected to 404 after login.</p>", priority: "high", target_date: "2026-04-15")
puts("Created issue #" + (issue.sequence_id).to_s + ": " + (issue.name).to_s)
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

```ruby
issue = app.integrations.plane.update_issue(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi", state: "done-state-uuid", priority: "low")
puts("Updated issue #" + (issue.sequence_id).to_s)
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

```ruby
result = app.integrations.plane.delete_issue(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi")
puts("Deleted: " + ((result.deleted).to_s).to_s)
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

```ruby
result = app.integrations.plane.list_cycles(workspace_slug: "my-team", project_id: "abc-123-def")
result.cycles.each do |cycle|
  puts((cycle.name).to_s + " (" + ((cycle.start_date || "?")).to_s + " → " + ((cycle.end_date || "?")).to_s + ")")
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

```ruby
result = app.integrations.plane.add_issue_cycle(workspace_slug: "my-team", project_id: "abc-123-def", cycle_id: "cycle-uuid-here", issue_id: "issue-uuid-here")
puts("Added to cycle: " + ((result.added).to_s).to_s)
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

```ruby
result = app.integrations.plane.list_modules(workspace_slug: "my-team", project_id: "abc-123-def")
result.modules.each do |mod|
  puts((mod.name).to_s + " — status: " + ((mod.status || "none")).to_s)
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

```ruby
result = app.integrations.plane.add_issue_module(workspace_slug: "my-team", project_id: "abc-123-def", module_id: "module-uuid-here", issue_id: "issue-uuid-here")
puts("Added to module: " + ((result.added).to_s).to_s)
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

```ruby
# List workspace members
result = app.integrations.plane.list_members(workspace_slug: "my-team")
# List project members only
result = app.integrations.plane.list_members(workspace_slug: "my-team", project_id: "abc-123-def")
result.members.each do |member|
  puts((member.display_name).to_s + " <" + ((member.email || "")).to_s + "> — " + ((member.role || "")).to_s)
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

```ruby
result = app.integrations.plane.list_states(workspace_slug: "my-team", project_id: "abc-123-def")
result.states.each do |state|
  puts((state.name).to_s + " [" + ((state.group || "")).to_s + "] = " + (state.id).to_s)
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

```ruby
result = app.integrations.plane.list_labels(workspace_slug: "my-team", project_id: "abc-123-def")
result.labels.each do |label|
  puts((label.name).to_s + " (color: " + ((label.color || "?")).to_s + ") = " + (label.id).to_s)
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

```ruby
result = app.integrations.plane.create_comment(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi", comment_html: "<p>Investigating — looks like a redirect config issue.</p>")
puts("Comment created: " + (result.id).to_s)
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

```ruby
result = app.integrations.plane.list_comments(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi")
result.comments.each do |comment|
  puts("[" + ((comment.created_at || "")).to_s + "] " + ((comment.comment_html || "")).to_s)
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

```ruby
result = app.integrations.plane.search_issues(workspace_slug: "my-team", search: "login bug")
result.issues.each do |issue|
  puts("#" + ((issue.sequence_id || "?")).to_s + " " + (issue.name).to_s)
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

```ruby
project = app.integrations.plane.get_project(workspace_slug: "my-team", project_id: "abc-123-def")
puts((project.name).to_s + " (" + (project.identifier).to_s + ")")
puts("Active: " + ((project.is_active).to_s).to_s)
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

```ruby
project = app.integrations.plane.create_project(workspace_slug: "my-team", name: "Website Redesign", identifier: "REDESIGN", description: "Full redesign of the marketing website")
puts("Created project: " + (project.name).to_s + " (" + (project.identifier).to_s + ")")
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

```ruby
result = app.integrations.plane.list_issue_activities(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi")
result.activities.each do |act|
  puts(((act.created_at || "")).to_s + " — " + ((act.action || "")).to_s + " " + ((act.field || "")).to_s)
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

```ruby
result = app.integrations.plane.create_issue_link(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi", title: "Design mockup", url: "https://figma.com/file/abc123")
puts("Link added: " + (result.title).to_s)
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

```ruby
result = app.integrations.plane.list_issue_relations(workspace_slug: "my-team", project_id: "abc-123-def", issue_id: "xyz-456-ghi")
result.relations.each do |rel|
  puts((rel.relation_type).to_s + " → " + ((rel.related_issue || "?")).to_s)
end
```
---

## get_current_user

Get the currently authenticated Plane.so user. Useful for verifying credentials.
On self-hosted deployments where the user endpoint is unavailable, this falls back to a workspace access probe and returns `workspace_slug` with a synthetic display name.

### Parameters

None.

### Example

```ruby
user = app.integrations.plane.get_current_user()
puts((user.display_name).to_s + " <" + ((user.email || "")).to_s + ">")
puts("User ID: " + (user.id).to_s)
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

```ruby
cycle = app.integrations.plane.get_cycle(workspace_slug: "my-team", project_id: "abc-123-def", cycle_id: "cycle-uuid")
puts((cycle.name).to_s + ": " + ((cycle.start_date || "?")).to_s + " → " + ((cycle.end_date || "?")).to_s)
puts("Active: " + ((cycle.is_active).to_s).to_s)
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

```ruby
cycle = app.integrations.plane.create_cycle(workspace_slug: "my-team", project_id: "abc-123-def", name: "Sprint 15", start_date: "2026-04-14", end_date: "2026-04-28")
puts("Created cycle: " + ((cycle.name || "unnamed")).to_s)
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

```ruby
mod = app.integrations.plane.get_module(workspace_slug: "my-team", project_id: "abc-123-def", module_id: "module-uuid")
puts((mod.name).to_s + " — status: " + ((mod.status || "none")).to_s)
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

```ruby
mod = app.integrations.plane.create_module(workspace_slug: "my-team", project_id: "abc-123-def", name: "Authentication System", description: "OAuth2 + SSO integration", target_date: "2026-05-01")
puts("Created module: " + (mod.name).to_s)
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

```ruby
state = app.integrations.plane.create_state(workspace_slug: "my-team", project_id: "abc-123-def", name: "Ready for QA", group: "started", color: "#FFA500")
puts("Created state: " + (state.name).to_s + " [" + (state.group).to_s + "]: " + (state.id).to_s)
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

```ruby
label = app.integrations.plane.create_label(workspace_slug: "my-team", project_id: "abc-123-def", name: "bug", color: "#FF0000")
puts("Created label: " + (label.name).to_s + " = " + (label.id).to_s)
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

```ruby
result = app.integrations.plane.archive_project(workspace_slug: "my-team", project_id: "abc-123-def")
puts("Archived: " + ((result.archived).to_s).to_s)
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

```ruby
result = app.integrations.plane.list_pages(workspace_slug: "my-team", project_id: "abc-123-def")
result.pages.each do |page|
  puts((page.name).to_s + " (updated: " + ((page.updated_at || "?")).to_s + ")")
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

```ruby
page = app.integrations.plane.get_page(workspace_slug: "my-team", project_id: "abc-123-def", page_id: "page-uuid")
puts(page.name)
puts(page.description_html)
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

```ruby
page = app.integrations.plane.create_page(workspace_slug: "my-team", project_id: "abc-123-def", name: "API Design Notes", description_html: "<h2>Endpoints</h2><p>POST /api/v1/users</p>")
puts("Created page: " + (page.name).to_s + " = " + (page.id).to_s)
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

```ruby
# Default account (always works)
app.integrations.plane.list_workspaces()
# Explicit default (portable across setups)
app.integrations.plane.default.list_workspaces()
# Named accounts
app.integrations.plane.self_hosted.list_workspaces()
app.integrations.plane.cloud.list_workspaces()
```
All functions are identical across accounts — only the credentials differ.
