# Linear — Ruby API Reference

Linear is a purpose-built project management tool for software teams. This integration lets you create, read, update, and delete issues; manage teams, projects, and initiatives; apply labels; add comments; and run arbitrary GraphQL queries — all from Ruby programs.

## Authentication

Uses a **Personal API Key** (starts with `lin_api_…`). Configure it in your integration settings. The key authenticates via the Linear GraphQL API at `https://api.linear.app/graphql`. API keys are scoped to the user who created them — the integration can only access teams and resources that user has permission for.

---

## Overview

All tools are called via `app.integrations.linear.<tool_name>({ ... })`. Every function takes a single Ruby object of named parameters and returns a result table.

```ruby
result = app.integrations.linear.get_issue(id: "ENG-42")
```
Errors surface as `result.error` (string). Check for it before using the response.

```ruby
if result.error
  puts("Error: " + (result.error).to_s)
  nil
end
```
---

## Issues

### `app.integrations.linear.create_issue(...)`

Create a new issue in Linear. Requires a team ID and title. Optionally set description, priority, assignee, labels, and initial state.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | Team ID to create the issue in. Use `get_teams` to discover team IDs. |
| `title` | string | yes | Issue title. |
| `description` | string | no | Issue description (markdown supported). |
| `priority` | integer | no | Priority: `0` = none, `1` = urgent, `2` = high, `3` = medium, `4` = low. |
| `assignee_id` | string | no | User ID to assign the issue to. |
| `label_ids` | string | no | Comma-separated label IDs to apply. |
| `state_id` | string | no | Workflow state ID for the initial status. |

Returns: `id`, `identifier`, `title`, `url`, `state`, `assignee`, `priority`.

```ruby
# Create a simple issue
result = app.integrations.linear.create_issue(team_id: "team-abc-123", title: "Fix login page crash on mobile", description: "Users on iOS Safari are seeing a blank screen after submitting credentials.", priority: 2)
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts("Created (Unix seconds): " + (result.identifier).to_s + " — " + (result.url).to_s)
end
```
```ruby
# Create a fully-specified issue with assignee, labels, and state
result = app.integrations.linear.create_issue(team_id: "team-abc-123", title: "Implement SSO support", description: "Add SAML-based SSO for enterprise customers.", priority: 2, assignee_id: "user-def-456", label_ids: "label-111,label-222", state_id: "state-todo-789")
puts(result.identifier, result.state, result.assignee)
```
---

### `app.integrations.linear.get_issue(...)`

Get a single Linear issue by ID or identifier (e.g., `"TEAM-123"`). Returns full details including description, state, assignee, labels, team info, and comments.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Issue ID or human-readable identifier (e.g., `"ENG-42"`). |

Returns: `id`, `identifier`, `title`, `description`, `url`, `state`, `state_type`, `assignee` (table with `id`, `name`, `email`), `priority`, `labels` (array of tables with `id`, `name`, `color`), `team` (table with `id`, `name`, `key`), `comments` (array of tables with `id`, `body`, `user`, `created_at`), `created_at`, `updated_at`.

```ruby
# Fetch an issue by its identifier
result = app.integrations.linear.get_issue(id: "ENG-42")
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts(result.title)
  puts("State: " + (result.state).to_s + " (" + (result.state_type).to_s + ")")
  puts("Assignee: " + (((result.assignee && result.assignee.name) || "Unassigned")).to_s)
  puts("Priority: " + ((result.priority).to_s).to_s)
  result.labels.each do |label|
    puts("Label: " + (label.name).to_s + " (" + (label.color).to_s + ")")
  end
  result.comments.each do |comment|
    puts("Comment by " + (comment.user).to_s + ": " + (comment.body).to_s)
  end
end
```
---

### `app.integrations.linear.update_issue(...)`

Update an existing Linear issue. Provide the issue ID or identifier and any fields to change. Only specified fields will be updated.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Issue ID or identifier to update. |
| `title` | string | no | New title. |
| `description` | string | no | New description (markdown). |
| `priority` | integer | no | Priority: `0` = none, `1` = urgent, `2` = high, `3` = medium, `4` = low. |
| `assignee_id` | string | no | User ID to assign. Set to empty string `""` to unassign. |
| `state_id` | string | no | Workflow state ID to set. |
| `label_ids` | string | no | Comma-separated label IDs to set (**replaces** existing labels). |

Returns: `id`, `identifier`, `title`, `url`, `state`, `assignee`, `priority`, `labels`.

```ruby
# Update an issue's title and priority
result = app.integrations.linear.update_issue(id: "ENG-42", title: "Fix login page crash — updated with repro steps", priority: 1)
puts("Updated: " + (result.identifier).to_s + " — priority " + ((result.priority).to_s).to_s)
```
```ruby
# Move an issue to a new state and assign it
result = app.integrations.linear.update_issue(id: "ENG-42", state_id: "state-in-progress-abc", assignee_id: "user-xyz-789")
puts("State: " + (result.state).to_s + ", Assignee: " + ((result.assignee).to_s).to_s)
```
```ruby
# Replace all labels on an issue
result = app.integrations.linear.update_issue(id: "ENG-42", label_ids: "label-bug,label-critical")
result.labels.each do |label|
  puts("Label: " + (label).to_s)
end
```
---

### `app.integrations.linear.search_issues(...)`

Search Linear issues using flexible filter criteria. Supports filtering by text query, team, state name, assignee, and priority. Returns matching issues with pagination info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Text to search in issue titles and descriptions. |
| `team_id` | string | no | Filter by team ID. |
| `state` | string | no | Filter by state name (e.g., `"In Progress"`, `"Done"`). |
| `assignee_id` | string | no | Filter by assignee user ID. |
| `priority` | integer | no | Filter by priority: `0` = none, `1` = urgent, `2` = high, `3` = medium, `4` = low. |
| `limit` | integer | no | Max results to return. Default: 20. |

Returns: `issues` (array), `total`, `has_next_page`, `end_cursor`. Each issue contains: `id`, `identifier`, `title`, `state`, `assignee`, `priority`, `team`, `labels` (array of strings), `created_at`.

```ruby
# Search for issues containing "crash" across all teams
result = app.integrations.linear.search_issues(query: "crash", limit: 10)
result.issues.each do |issue|
  puts((issue.identifier).to_s + ": " + (issue.title).to_s + " [" + (issue.state).to_s + "]")
end
```
```ruby
# Search for high-priority issues assigned to a specific user
result = app.integrations.linear.search_issues(assignee_id: "user-xyz-789", priority: 2, state: "In Progress")
puts("Found " + (result.total).to_s + " matching issues")
```
---

### `app.integrations.linear.list_issues(...)`

List issues for a specific Linear team with optional filters and cursor-based pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | Team ID to list issues for. |
| `status` | string | no | Filter by state name (e.g., `"In Progress"`, `"Backlog"`). |
| `assignee_id` | string | no | Filter by assignee user ID. |
| `limit` | integer | no | Results per page. Default: 25. |
| `after` | string | no | Cursor for next page (from a previous response's `end_cursor`). |

Returns: `issues` (array), `total`, `has_next_page`, `end_cursor`. Each issue contains: `id`, `identifier`, `title`, `state`, `assignee`, `priority`, `labels` (array of strings), `created_at`, `updated_at`.

```ruby
# List the first 10 issues in a team
result = app.integrations.linear.list_issues(team_id: "team-abc-123", limit: 10)
result.issues.each do |issue|
  puts((issue.identifier).to_s + ": " + (issue.title).to_s + " [" + (issue.state).to_s + "]")
end
if result.has_next_page
  puts("More results available. Cursor: " + ((result.end_cursor).to_s).to_s)
end
```
```ruby
# List "In Progress" issues for a specific assignee (paginated)
cursor = nil
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.linear.list_issues(team_id: "team-abc-123", status: "In Progress", assignee_id: "user-xyz-789", limit: 25, after: cursor)
  result.issues.each do |issue|
    puts((issue.identifier).to_s + ": " + (issue.title).to_s)
  end
  cursor = ((result.has_next_page && result.end_cursor) || nil)
  break unless (!(!cursor))
end
```
---

### `app.integrations.linear.delete_issue(...)`

Delete a Linear issue by ID or identifier. This action is irreversible.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Issue ID or identifier to delete (e.g., `"ENG-42"`). |

Returns: `deleted` (boolean), `id`.

```ruby
# Delete an issue
result = app.integrations.linear.delete_issue(id: "ENG-42")
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts("Deleted issue: " + (result.id).to_s)
end
```
---

### `app.integrations.linear.create_comment(...)`

Add a comment to a Linear issue. Supports markdown formatting.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier to comment on. |
| `body` | string | yes | Comment body text (markdown supported). |

Returns: `id`, `body`, `user`, `created_at`.

```ruby
# Add a comment to an issue
result = app.integrations.linear.create_comment(issue_id: "ENG-42", body: "I've reproduced this on iOS 17.4. Attaching screenshot below.")
if (!result.error)
  puts("Comment added by " + (result.user).to_s + " at " + (result.created_at).to_s)
end
```
```ruby
# Add a rich markdown comment
result = app.integrations.linear.create_comment(issue_id: "ENG-42", body: "## Root Cause\n\nThe issue was caused by a **race condition** in the auth module.\n\n### Fix\n- Added mutex lock around token refresh\n- Added regression test")
```
---

### `app.integrations.linear.list_comments(...)`

List all comments on a Linear issue, ordered chronologically.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier to list comments for. |

Returns: `comments` (array), `total`. Each comment contains: `id`, `body`, `user`, `created_at`, `updated_at`.

```ruby
# List all comments on an issue
result = app.integrations.linear.list_comments(issue_id: "ENG-42")
result.comments.each do |comment|
  puts((comment.user).to_s + " (" + (comment.created_at).to_s + "):")
  puts("  " + (comment.body).to_s)
end
puts("Total comments: " + (result.total).to_s)
```
---

## Teams & Projects

### `app.integrations.linear.get_teams(...)`

Get all Linear teams the authenticated user has access to, including team name, key, description, and member list. Use this to discover team IDs needed for other tools.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `teams` (array), `total`. Each team contains: `id`, `name`, `key`, `description`, `icon`, `members` (array of tables with `id`, `name`, `email`).

```ruby
# List all teams and their members
result = app.integrations.linear.get_teams()
result.teams.each do |team|
  puts("Team: " + (team.name).to_s + " (" + (team.key).to_s + ")")
  puts("  Description: " + ((team.description || "—")).to_s)
  team.members.each do |member|
    puts("  Member: " + (member.name).to_s + " <" + (member.email).to_s + ">")
  end
end
```
---

### `app.integrations.linear.list_projects(...)`

List Linear projects with optional cursor-based pagination. Returns project details including state, dates, lead, and associated teams.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page. Default: 25. |
| `after` | string | no | Cursor for next page (from a previous response's `end_cursor`). |

Returns: `projects` (array), `total`, `has_next_page`, `end_cursor`. Each project contains: `id`, `name`, `description`, `state`, `start_date`, `target_date`, `lead`, `teams` (array of tables with `id`, `name`, `key`), `created_at`, `updated_at`.

```ruby
# List the first 10 projects
result = app.integrations.linear.list_projects(limit: 10)
result.projects.each do |project|
  puts((project.name).to_s + " [" + ((project.state || "—")).to_s + "]")
  puts("  Lead: " + ((project.lead || "Unassigned")).to_s)
  puts("  Target: " + ((project.target_date || "No date")).to_s)
  project.teams.each do |team|
    puts("  Team: " + (team.name).to_s + " (" + (team.key).to_s + ")")
  end
end
```
---

### `app.integrations.linear.create_project(...)`

Create a new Linear project. Requires a name and at least one team ID. Optionally set description and lead.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Project name. |
| `team_ids` | string | yes | Comma-separated team IDs to associate with the project. |
| `description` | string | no | Project description. |
| `lead_id` | string | no | User ID of the project lead. |

Returns: `id`, `name`, `description`, `state`, `url`, `teams` (array of team names).

```ruby
# Create a new project
result = app.integrations.linear.create_project(name: "Q3 Platform Overhaul", team_ids: "team-abc-123,team-def-456", description: "Major refactoring of the platform architecture for improved performance.", lead_id: "user-xyz-789")
if (!result.error)
  puts("Project created: " + (result.name).to_s)
  puts("URL: " + (result.url).to_s)
end
```
---

### `app.integrations.linear.update_project(...)`

Update a Linear project. Provide the project ID and any fields to change. Only specified fields will be updated.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Project ID to update. |
| `name` | string | no | New project name. |
| `description` | string | no | New description. |
| `state` | string | no | New project state: `"planned"`, `"active"`, `"paused"`, `"completed"`, or `"canceled"`. |

Returns: `id`, `name`, `description`, `state`, `url`.

```ruby
# Mark a project as active
result = app.integrations.linear.update_project(id: "project-abc-123", state: "active")
puts("Project state updated to: " + (result.state).to_s)
```
```ruby
# Update project name and description
result = app.integrations.linear.update_project(id: "project-abc-123", name: "Q3 Platform Overhaul (Revised)", description: "Updated scope: focus on API layer && database optimization.")
puts((result.name).to_s + " — " + (result.url).to_s)
```
---

### `app.integrations.linear.list_initiatives(...)`

List Linear initiatives. Returns initiative details including state, dates, and associated projects.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results to return. Default: 25. |

Returns: `initiatives` (array), `total`, `has_next_page`, `end_cursor`. Each initiative contains: `id`, `name`, `description`, `state`, `start_date`, `target_date`, `projects` (array of tables with `id`, `name`), `created_at`, `updated_at`.

```ruby
# List all initiatives
result = app.integrations.linear.list_initiatives(limit: 50)
result.initiatives.each do |initiative|
  puts((initiative.name).to_s + " [" + ((initiative.state || "—")).to_s + "]")
  puts("  " + ((initiative.description || "No description")).to_s)
  initiative.projects.each do |project|
    puts("  Project: " + (project.name).to_s)
  end
end
```
---

### `app.integrations.linear.create_initiative(...)`

Create a new Linear initiative. Initiatives group related projects together. Requires a name.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Initiative name. |
| `description` | string | no | Initiative description. |

Returns: `id`, `name`, `description`, `state`.

```ruby
# Create a new initiative
result = app.integrations.linear.create_initiative(name: "2026 Technical Excellence", description: "Umbrella initiative for all infrastructure && developer experience improvements in 2026.")
if (!result.error)
  puts("Initiative created: " + (result.name).to_s + " (state: " + ((result.state).to_s).to_s + ")")
end
```
---

## Labels & Metadata

### `app.integrations.linear.list_labels(...)`

List issue labels in Linear. Optionally filter by team. Returns label ID, name, color, and description.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Team ID to filter labels by. |

Returns: `labels` (array), `total`. Each label contains: `id`, `name`, `color`, `description`, `team`.

```ruby
# List all labels
result = app.integrations.linear.list_labels()
result.labels.each do |label|
  puts((label.name).to_s + " (" + (label.color).to_s + ") — " + ((label.description || "")).to_s)
  puts("  ID: " + (label.id).to_s)
end
```
```ruby
# List labels for a specific team
result = app.integrations.linear.list_labels(team_id: "team-abc-123")
result.labels.each do |label|
  puts(label.name)
end
```
---

### `app.integrations.linear.add_label(...)`

Add a label to a Linear issue. The label will be appended to existing labels without removing any.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier. |
| `label_id` | string | yes | Label ID to add. Use `list_labels` to find label IDs. |

Returns: `id`, `identifier`, `labels` (array of label names).

```ruby
# Add the "bug" label to an issue
result = app.integrations.linear.add_label(issue_id: "ENG-42", label_id: "label-bug-123")
if (!result.error)
  puts("Labels on " + (result.identifier).to_s + ":")
  result.labels.each do |name|
    puts("  - " + (name).to_s)
  end
end
```
---

### `app.integrations.linear.remove_label(...)`

Remove a label from a Linear issue. Other labels on the issue are preserved.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier. |
| `label_id` | string | yes | Label ID to remove. |

Returns: `id`, `identifier`, `labels` (array of label names).

```ruby
# Remove the "bug" label from an issue
result = app.integrations.linear.remove_label(issue_id: "ENG-42", label_id: "label-bug-123")
if (!result.error)
  puts("Remaining labels:")
  result.labels.each do |name|
    puts("  - " + (name).to_s)
  end
end
```
---

### `app.integrations.linear.get_current_user(...)`

Get the currently authenticated Linear user's profile, including ID, name, email, and avatar URL.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `id`, `name`, `email`, `avatar_url`.

```ruby
# Get the authenticated user's profile
result = app.integrations.linear.get_current_user()
puts("Logged in as: " + (result.name).to_s + " <" + (result.email).to_s + ">")
puts("User ID: " + (result.id).to_s)
```
---

### `app.integrations.linear.list_workflows(...)`

List workflow states for a Linear team, showing all available issue statuses with their IDs, types, and colors. Use this to discover `state_id` values for creating and updating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Team ID to filter workflow states by. |

Returns: `workflow_states` (array), `total`. Each state contains: `id`, `name`, `type`, `color`, `team`.

```ruby
# List all workflow states for a team
result = app.integrations.linear.list_workflows(team_id: "team-abc-123")
result.workflow_states.each do |state|
  puts((state.name).to_s + " (type: " + (state.type).to_s + ", id: " + (state.id).to_s + ")")
end
```
```ruby
# List all workflow states across all teams
result = app.integrations.linear.list_workflows()
result.workflow_states.each do |state|
  team = (state.team || "Global")
  puts("[" + (team).to_s + "] " + (state.name).to_s + " — " + (state.type).to_s + " — " + (state.id).to_s)
end
```
---

### `app.integrations.linear.raw_query(...)`

Execute an arbitrary GraphQL query or mutation against the Linear API. Use this for advanced operations not covered by the other tools.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GraphQL query or mutation document. |
| `variables` | string | no | Variables as a JSON object string. |

Returns: The raw API response as a table (structure depends on your query).

```ruby
# Fetch a specific issue's comment count using a custom query
result = app.integrations.linear.raw_query(query: "\n    query($id: String!) {\n      issue(id: $id) {\n        id\n        identifier\n        title\n        commentCount\n      }\n    }\n  ", variables: "{\"id\": \"ENG-42\"}")
if (!result.error)
  issue = result.data.issue
  puts((issue.identifier).to_s + ": " + (issue.title).to_s + " (" + (issue.commentCount).to_s + " comments)")
end
```
```ruby
# List all organization members
result = app.integrations.linear.raw_query(query: "\n    query {\n      organization {\n        name\n        users(first: 50) {\n          nodes {\n            id\n            name\n            email\n          }\n        }\n      }\n    }\n  ")
result.data.organization.users.nodes.each do |user|
  puts((user.name).to_s + " <" + (user.email).to_s + ">")
end
```
---

## Pagination

Several list endpoints (`list_issues`, `search_issues`, `list_projects`, `list_initiatives`) support cursor-based pagination. The response includes:

| Field | Type | Description |
|-------|------|-------------|
| `has_next_page` | boolean | Whether more results exist. |
| `end_cursor` | string or nil | Cursor to pass as `after` for the next page. |

### Paginating through all results

```ruby
issues = []
cursor = nil
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.linear.list_issues(team_id: "team-abc-123", limit: 50, after: cursor)
  if result.error
    puts("Error: " + (result.error).to_s)
    break
  end
  result.issues.each do |issue|
    issues.push(issue)
  end
  cursor = ((result.has_next_page && result.end_cursor) || nil)
  break unless (!(!cursor))
end
puts("Fetched " + (issues.length).to_s + " issues total")
```
---

## Notes

- **Priority values**: Linear uses numeric priorities — `0` (none), `1` (urgent), `2` (high), `3` (medium), `4` (low).
- **IDs vs identifiers**: Most tools accept either a UUID-style ID or a human-readable identifier like `"ENG-42"`. The `get_issue`, `update_issue`, `delete_issue`, `create_comment`, and `list_comments` tools support both forms.
- **label_ids format**: When multiple label IDs are needed (e.g., `create_issue`, `update_issue`), pass them as a single comma-separated string: `"label-111,label-222"`.
- **update_issue replaces labels**: The `label_ids` parameter on `update_issue` **replaces** the entire label set. To add or remove individual labels without affecting others, use `add_label` or `remove_label` instead.
- **Markdown support**: Issue descriptions and comment bodies support full markdown.
- **GraphQL backend**: All operations use the Linear GraphQL API at `https://api.linear.app/graphql`. For operations not covered by the built-in tools, use `raw_query` to run custom GraphQL queries or mutations.
- **Rate limits**: Linear enforces API rate limits. If you encounter errors during bulk operations, add delays between calls.
- **Team discovery**: Call `get_teams({})` first to discover team IDs, then `list_workflows({ team_id = "..." })` for available states, and `list_labels({ team_id = "..." })` for available labels.

---

## Multi-Account Usage

If you have multiple linear accounts configured, use account-specific namespaces:

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
