# Plane.so — JavaScript API Reference

If you configure a default `workspace_slug`, most tools can omit `workspace_slug` and will use that default automatically.
On some self-hosted Plane deployments, user and workspace-list endpoints are limited; this integration falls back to workspace-scoped project access where needed.

## list_workspaces

List all Plane.so workspaces the authenticated user belongs to.
On self-hosted deployments that do not expose the workspace-list endpoint, this returns the configured default workspace after verifying access.

### Parameters

None.

### Example

```js
var result = app.integrations.plane.list_workspaces()

for (const ws of (result.workspaces)) {
  console.log(ws.slug + " — " + ws.name)
}
```
---

## list_projects

List all projects in a workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_slug` | string | yes | Workspace slug (e.g., `"my-team"`) |

### Example

```js
var result = app.integrations.plane.list_projects({
  workspace_slug: "my-team",
})

for (const proj of (result.projects)) {
  console.log(proj.identifier + " — " + proj.name)
}
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

```js
var result = app.integrations.plane.list_issues({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  priority: "high",
})

for (const issue of (result.issues)) {
  console.log("#" + issue.sequence_id + " " + issue.name + " [" + (issue.priority || "none") + "]")
}
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

```js
var issue = app.integrations.plane.get_issue({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
})

console.log(issue.name)
console.log(issue.description_html)
console.log("Priority: " + (issue.priority || "none"))
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

```js
var issue = app.integrations.plane.create_issue({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "Fix login redirect bug",
  description_html: "<p>Users are redirected to 404 after login.</p>",
  priority: "high",
  target_date: "2026-04-15",
})

console.log("Created issue #" + issue.sequence_id + ": " + issue.name)
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

```js
var issue = app.integrations.plane.update_issue({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
  state: "done-state-uuid",
  priority: "low",
})

console.log("Updated issue #" + issue.sequence_id)
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

```js
var result = app.integrations.plane.delete_issue({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
})

console.log("Deleted: " + String(result.deleted))
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

```js
var result = app.integrations.plane.list_cycles({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const cycle of (result.cycles)) {
  console.log(cycle.name + " (" + (cycle.start_date || "?") + " → " + (cycle.end_date || "?") + ")")
}
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

```js
var result = app.integrations.plane.add_issue_to_cycle({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  cycle_id: "cycle-uuid-here",
  issue_id: "issue-uuid-here",
})

console.log("Added to cycle: " + String(result.added))
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

```js
var result = app.integrations.plane.list_modules({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const mod of (result.modules)) {
  console.log(mod.name + " — status: " + (mod.status || "none"))
}
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

```js
var result = app.integrations.plane.add_issue_to_module({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  module_id: "module-uuid-here",
  issue_id: "issue-uuid-here",
})

console.log("Added to module: " + String(result.added))
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

```js
// List workspace members
var result = app.integrations.plane.list_members({
  workspace_slug: "my-team",
})

// List project members only
var result = app.integrations.plane.list_members({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const member of (result.members)) {
  console.log(member.display_name + " <" + (member.email || "") + "> — " + (member.role || ""))
}
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

```js
var result = app.integrations.plane.list_states({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const state of (result.states)) {
  console.log(state.name + " [" + (state.group || "") + "] = " + state.id)
}
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

```js
var result = app.integrations.plane.list_labels({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const label of (result.labels)) {
  console.log(label.name + " (color: " + (label.color || "?") + ") = " + label.id)
}
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

```js
var result = app.integrations.plane.create_comment({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
  comment_html: "<p>Investigating — looks like a redirect config issue.</p>",
})

console.log("Comment created: " + result.id)
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

```js
var result = app.integrations.plane.list_comments({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
})

for (const comment of (result.comments)) {
  console.log("[" + (comment.created_at || "") + "] " + (comment.comment_html || ""))
}
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

```js
var result = app.integrations.plane.search_issues({
  workspace_slug: "my-team",
  search: "login bug",
})

for (const issue of (result.issues)) {
  console.log("#" + (issue.sequence_id || "?") + " " + issue.name)
}
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

```js
var project = app.integrations.plane.get_project({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

console.log(project.name + " (" + project.identifier + ")")
console.log("Active: " + String(project.is_active))
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

```js
var project = app.integrations.plane.create_project({
  workspace_slug: "my-team",
  name: "Website Redesign",
  identifier: "REDESIGN",
  description: "Full redesign of the marketing website",
})

console.log("Created project: " + project.name + " (" + project.identifier + ")")
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

```js
var result = app.integrations.plane.list_issue_activities({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
})

for (const act of (result.activities)) {
  console.log((act.created_at || "") + " — " + (act.action || "") + " " + (act.field || ""))
}
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

```js
var result = app.integrations.plane.create_issue_link({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
  title: "Design mockup",
  url: "https://figma.com/file/abc123",
})

console.log("Link added: " + result.title)
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

```js
var result = app.integrations.plane.list_issue_relations({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  issue_id: "xyz-456-ghi",
})

for (const rel of (result.relations)) {
  console.log(rel.relation_type + " → " + (rel.related_issue || "?"))
}
```
---

## get_current_user

Get the currently authenticated Plane.so user. Useful for verifying credentials.
On self-hosted deployments where the user endpoint is unavailable, this falls back to a workspace access probe and returns `workspace_slug` with a synthetic display name.

### Parameters

None.

### Example

```js
var user = app.integrations.plane.get_current_user()

console.log(user.display_name + " <" + (user.email || "") + ">")
console.log("User ID: " + user.id)
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

```js
var cycle = app.integrations.plane.get_cycle({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  cycle_id: "cycle-uuid",
})

console.log(cycle.name + ": " + (cycle.start_date || "?") + " → " + (cycle.end_date || "?"))
console.log("Active: " + String(cycle.is_active))
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

```js
var cycle = app.integrations.plane.create_cycle({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "Sprint 15",
  start_date: "2026-04-14",
  end_date: "2026-04-28",
})

console.log("Created cycle: " + (cycle.name || "unnamed"))
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

```js
var mod = app.integrations.plane.get_module({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  module_id: "module-uuid",
})

console.log(mod.name + " — status: " + (mod.status || "none"))
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

```js
var mod = app.integrations.plane.create_module({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "Authentication System",
  description: "OAuth2 + SSO integration",
  target_date: "2026-05-01",
})

console.log("Created module: " + mod.name)
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

```js
var state = app.integrations.plane.create_state({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "Ready for QA",
  group: "started",
  color: "#FFA500",
})

console.log("Created state: " + state.name + " [" + state.group + "]: " + state.id)
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

```js
var label = app.integrations.plane.create_label({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "bug",
  color: "#FF0000",
})

console.log("Created label: " + label.name + " = " + label.id)
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

```js
var result = app.integrations.plane.archive_project({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

console.log("Archived: " + String(result.archived))
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

```js
var result = app.integrations.plane.list_pages({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
})

for (const page of (result.pages)) {
  console.log(page.name + " (updated: " + (page.updated_at || "?") + ")")
}
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

```js
var page = app.integrations.plane.get_page({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  page_id: "page-uuid",
})

console.log(page.name)
console.log(page.description_html)
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

```js
var page = app.integrations.plane.create_page({
  workspace_slug: "my-team",
  project_id: "abc-123-def",
  name: "API Design Notes",
  description_html: "<h2>Endpoints</h2><p>POST /api/v1/users</p>",
})

console.log("Created page: " + page.name + " = " + page.id)
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

```js
// Default account (always works)
app.integrations.plane.list_workspaces()

// Explicit default (portable across setups)
app.integrations.plane.default.list_workspaces()

// Named accounts
app.integrations.plane.self_hosted.list_workspaces()
app.integrations.plane.cloud.list_workspaces()
```
All functions are identical across accounts — only the credentials differ.
