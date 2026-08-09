# Linear — JavaScript API Reference

Linear is a purpose-built project management tool for software teams. This integration lets you create, read, update, and delete issues; manage teams, projects, and initiatives; apply labels; add comments; and run arbitrary GraphQL queries — all from JavaScript programs.

## Authentication

Uses a **Personal API Key** (starts with `lin_api_…`). Configure it in your integration settings. The key authenticates via the Linear GraphQL API at `https://api.linear.app/graphql`. API keys are scoped to the user who created them — the integration can only access teams and resources that user has permission for.

---

## Overview

All tools are called via `app.integrations.linear.<tool_name>({ ... })`. Every function takes a single JavaScript object of named parameters and returns a result table.

```js
var result = app.integrations.linear.get_issue({ id: "ENG-42" })
```
Errors surface as `result.error` (string). Check for it before using the response.

```js
if (result.error) {
  console.log("Error: " + result.error)
  return
}
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

```js
// Create a simple issue
var result = app.integrations.linear.create_issue({
  team_id: "team-abc-123",
  title: "Fix login page crash on mobile",
  description: "Users on iOS Safari are seeing a blank screen after submitting credentials.",
  priority: 2,
})

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log("Created: " + result.identifier + " — " + result.url)
}
```
```js
// Create a fully-specified issue with assignee, labels, and state
var result = app.integrations.linear.create_issue({
  team_id: "team-abc-123",
  title: "Implement SSO support",
  description: "Add SAML-based SSO for enterprise customers.",
  priority: 2,
  assignee_id: "user-def-456",
  label_ids: "label-111,label-222",
  state_id: "state-todo-789",
})

console.log(result.identifier, result.state, result.assignee)
```
---

### `app.integrations.linear.get_issue(...)`

Get a single Linear issue by ID or identifier (e.g., `"TEAM-123"`). Returns full details including description, state, assignee, labels, team info, and comments.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Issue ID or human-readable identifier (e.g., `"ENG-42"`). |

Returns: `id`, `identifier`, `title`, `description`, `url`, `state`, `state_type`, `assignee` (table with `id`, `name`, `email`), `priority`, `labels` (array of tables with `id`, `name`, `color`), `team` (table with `id`, `name`, `key`), `comments` (array of tables with `id`, `body`, `user`, `created_at`), `created_at`, `updated_at`.

```js
// Fetch an issue by its identifier
var result = app.integrations.linear.get_issue({ id: "ENG-42" })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log(result.title)
  console.log("State: " + result.state + " (" + result.state_type + ")")
  console.log("Assignee: " + (result.assignee && result.assignee.name || "Unassigned"))
  console.log("Priority: " + String(result.priority))

  for (const label of (result.labels)) {
    console.log("Label: " + label.name + " (" + label.color + ")")
  }

  for (const comment of (result.comments)) {
    console.log("Comment by " + comment.user + ": " + comment.body)
  }
}
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

```js
// Update an issue's title and priority
var result = app.integrations.linear.update_issue({
  id: "ENG-42",
  title: "Fix login page crash — updated with repro steps",
  priority: 1,
})

console.log("Updated: " + result.identifier + " — priority " + String(result.priority))
```
```js
// Move an issue to a new state and assign it
var result = app.integrations.linear.update_issue({
  id: "ENG-42",
  state_id: "state-in-progress-abc",
  assignee_id: "user-xyz-789",
})

console.log("State: " + result.state + ", Assignee: " + String(result.assignee))
```
```js
// Replace all labels on an issue
var result = app.integrations.linear.update_issue({
  id: "ENG-42",
  label_ids: "label-bug,label-critical",
})

for (const label of (result.labels)) {
  console.log("Label: " + label)
}
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

```js
// Search for issues containing "crash" across all teams
var result = app.integrations.linear.search_issues({
  query: "crash",
  limit: 10,
})

for (const issue of (result.issues)) {
  console.log(issue.identifier + ": " + issue.title + " [" + issue.state + "]")
}
```
```js
// Search for high-priority issues assigned to a specific user
var result = app.integrations.linear.search_issues({
  assignee_id: "user-xyz-789",
  priority: 2,
  state: "In Progress",
})

console.log("Found " + result.total + " matching issues")
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

```js
// List the first 10 issues in a team
var result = app.integrations.linear.list_issues({
  team_id: "team-abc-123",
  limit: 10,
})

for (const issue of (result.issues)) {
  console.log(issue.identifier + ": " + issue.title + " [" + issue.state + "]")
}

if (result.has_next_page) {
  console.log("More results available. Cursor: " + String(result.end_cursor))
}
```
```js
// List "In Progress" issues for a specific assignee (paginated)
var cursor = null

do {
  var result = app.integrations.linear.list_issues({
    team_id: "team-abc-123",
    status: "In Progress",
    assignee_id: "user-xyz-789",
    limit: 25,
    after: cursor,
  })

  for (const issue of (result.issues)) {
    console.log(issue.identifier + ": " + issue.title)
  }

  cursor = result.has_next_page && result.end_cursor || null
} while (!(!cursor));
```
---

### `app.integrations.linear.delete_issue(...)`

Delete a Linear issue by ID or identifier. This action is irreversible.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Issue ID or identifier to delete (e.g., `"ENG-42"`). |

Returns: `deleted` (boolean), `id`.

```js
// Delete an issue
var result = app.integrations.linear.delete_issue({ id: "ENG-42" })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log("Deleted issue: " + result.id)
}
```
---

### `app.integrations.linear.create_comment(...)`

Add a comment to a Linear issue. Supports markdown formatting.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier to comment on. |
| `body` | string | yes | Comment body text (markdown supported). |

Returns: `id`, `body`, `user`, `created_at`.

```js
// Add a comment to an issue
var result = app.integrations.linear.create_comment({
  issue_id: "ENG-42",
  body: "I've reproduced this on iOS 17.4. Attaching screenshot below.",
})

if (!result.error) {
  console.log("Comment added by " + result.user + " at " + result.created_at)
}
```
```js
// Add a rich markdown comment
var result = app.integrations.linear.create_comment({
  issue_id: "ENG-42",
  body: "## Root Cause\n\nThe issue was caused by a **race condition** in the auth module.\n\n### Fix\n- Added mutex lock around token refresh\n- Added regression test",
})
```
---

### `app.integrations.linear.list_comments(...)`

List all comments on a Linear issue, ordered chronologically.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier to list comments for. |

Returns: `comments` (array), `total`. Each comment contains: `id`, `body`, `user`, `created_at`, `updated_at`.

```js
// List all comments on an issue
var result = app.integrations.linear.list_comments({ issue_id: "ENG-42" })

for (const comment of (result.comments)) {
  console.log(comment.user + " (" + comment.created_at + "):")
  console.log("  " + comment.body)
}

console.log("Total comments: " + result.total)
```
---

## Teams & Projects

### `app.integrations.linear.get_teams(...)`

Get all Linear teams the authenticated user has access to, including team name, key, description, and member list. Use this to discover team IDs needed for other tools.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `teams` (array), `total`. Each team contains: `id`, `name`, `key`, `description`, `icon`, `members` (array of tables with `id`, `name`, `email`).

```js
// List all teams and their members
var result = app.integrations.linear.get_teams({})

for (const team of (result.teams)) {
  console.log("Team: " + team.name + " (" + team.key + ")")
  console.log("  Description: " + (team.description || "—"))

  for (const member of (team.members)) {
    console.log("  Member: " + member.name + " <" + member.email + ">")
  }
}
```
---

### `app.integrations.linear.list_projects(...)`

List Linear projects with optional cursor-based pagination. Returns project details including state, dates, lead, and associated teams.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page. Default: 25. |
| `after` | string | no | Cursor for next page (from a previous response's `end_cursor`). |

Returns: `projects` (array), `total`, `has_next_page`, `end_cursor`. Each project contains: `id`, `name`, `description`, `state`, `start_date`, `target_date`, `lead`, `teams` (array of tables with `id`, `name`, `key`), `created_at`, `updated_at`.

```js
// List the first 10 projects
var result = app.integrations.linear.list_projects({ limit: 10 })

for (const project of (result.projects)) {
  console.log(project.name + " [" + (project.state || "—") + "]")
  console.log("  Lead: " + (project.lead || "Unassigned"))
  console.log("  Target: " + (project.target_date || "No date"))

  for (const team of (project.teams)) {
    console.log("  Team: " + team.name + " (" + team.key + ")")
  }
}
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

```js
// Create a new project
var result = app.integrations.linear.create_project({
  name: "Q3 Platform Overhaul",
  team_ids: "team-abc-123,team-def-456",
  description: "Major refactoring of the platform architecture for improved performance.",
  lead_id: "user-xyz-789",
})

if (!result.error) {
  console.log("Project created: " + result.name)
  console.log("URL: " + result.url)
}
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

```js
// Mark a project as active
var result = app.integrations.linear.update_project({
  id: "project-abc-123",
  state: "active",
})

console.log("Project state updated to: " + result.state)
```
```js
// Update project name and description
var result = app.integrations.linear.update_project({
  id: "project-abc-123",
  name: "Q3 Platform Overhaul (Revised)",
  description: "Updated scope: focus on API layer && database optimization.",
})

console.log(result.name + " — " + result.url)
```
---

### `app.integrations.linear.list_initiatives(...)`

List Linear initiatives. Returns initiative details including state, dates, and associated projects.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results to return. Default: 25. |

Returns: `initiatives` (array), `total`, `has_next_page`, `end_cursor`. Each initiative contains: `id`, `name`, `description`, `state`, `start_date`, `target_date`, `projects` (array of tables with `id`, `name`), `created_at`, `updated_at`.

```js
// List all initiatives
var result = app.integrations.linear.list_initiatives({ limit: 50 })

for (const initiative of (result.initiatives)) {
  console.log(initiative.name + " [" + (initiative.state || "—") + "]")
  console.log("  " + (initiative.description || "No description"))

  for (const project of (initiative.projects)) {
    console.log("  Project: " + project.name)
  }
}
```
---

### `app.integrations.linear.create_initiative(...)`

Create a new Linear initiative. Initiatives group related projects together. Requires a name.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Initiative name. |
| `description` | string | no | Initiative description. |

Returns: `id`, `name`, `description`, `state`.

```js
// Create a new initiative
var result = app.integrations.linear.create_initiative({
  name: "2026 Technical Excellence",
  description: "Umbrella initiative for all infrastructure && developer experience improvements in 2026.",
})

if (!result.error) {
  console.log("Initiative created: " + result.name + " (state: " + String(result.state) + ")")
}
```
---

## Labels & Metadata

### `app.integrations.linear.list_labels(...)`

List issue labels in Linear. Optionally filter by team. Returns label ID, name, color, and description.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Team ID to filter labels by. |

Returns: `labels` (array), `total`. Each label contains: `id`, `name`, `color`, `description`, `team`.

```js
// List all labels
var result = app.integrations.linear.list_labels({})

for (const label of (result.labels)) {
  console.log(label.name + " (" + label.color + ") — " + (label.description || ""))
  console.log("  ID: " + label.id)
}
```
```js
// List labels for a specific team
var result = app.integrations.linear.list_labels({ team_id: "team-abc-123" })

for (const label of (result.labels)) {
  console.log(label.name)
}
```
---

### `app.integrations.linear.add_label(...)`

Add a label to a Linear issue. The label will be appended to existing labels without removing any.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier. |
| `label_id` | string | yes | Label ID to add. Use `list_labels` to find label IDs. |

Returns: `id`, `identifier`, `labels` (array of label names).

```js
// Add the "bug" label to an issue
var result = app.integrations.linear.add_label({
  issue_id: "ENG-42",
  label_id: "label-bug-123",
})

if (!result.error) {
  console.log("Labels on " + result.identifier + ":")
  for (const name of (result.labels)) {
    console.log("  - " + name)
  }
}
```
---

### `app.integrations.linear.remove_label(...)`

Remove a label from a Linear issue. Other labels on the issue are preserved.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | Issue ID or identifier. |
| `label_id` | string | yes | Label ID to remove. |

Returns: `id`, `identifier`, `labels` (array of label names).

```js
// Remove the "bug" label from an issue
var result = app.integrations.linear.remove_label({
  issue_id: "ENG-42",
  label_id: "label-bug-123",
})

if (!result.error) {
  console.log("Remaining labels:")
  for (const name of (result.labels)) {
    console.log("  - " + name)
  }
}
```
---

### `app.integrations.linear.get_current_user(...)`

Get the currently authenticated Linear user's profile, including ID, name, email, and avatar URL.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `id`, `name`, `email`, `avatar_url`.

```js
// Get the authenticated user's profile
var result = app.integrations.linear.get_current_user({})

console.log("Logged in as: " + result.name + " <" + result.email + ">")
console.log("User ID: " + result.id)
```
---

### `app.integrations.linear.list_workflows(...)`

List workflow states for a Linear team, showing all available issue statuses with their IDs, types, and colors. Use this to discover `state_id` values for creating and updating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Team ID to filter workflow states by. |

Returns: `workflow_states` (array), `total`. Each state contains: `id`, `name`, `type`, `color`, `team`.

```js
// List all workflow states for a team
var result = app.integrations.linear.list_workflows({ team_id: "team-abc-123" })

for (const state of (result.workflow_states)) {
  console.log(state.name + " (type: " + state.type + ", id: " + state.id + ")")
}
```
```js
// List all workflow states across all teams
var result = app.integrations.linear.list_workflows({})

for (const state of (result.workflow_states)) {
  var team = state.team || "Global"
  console.log("[" + team + "] " + state.name + " — " + state.type + " — " + state.id)
}
```
---

### `app.integrations.linear.raw_query(...)`

Execute an arbitrary GraphQL query or mutation against the Linear API. Use this for advanced operations not covered by the other tools.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GraphQL query or mutation document. |
| `variables` | string | no | Variables as a JSON object string. |

Returns: The raw API response as a table (structure depends on your query).

```js
// Fetch a specific issue's comment count using a custom query
var result = app.integrations.linear.raw_query({
  query: String.raw`,
    query($id: String!) {
      issue(id: $id) {
        id
        identifier
        title
        commentCount
      }
    }
  `,
  variables: '{"id": "ENG-42"}',
})

if (!result.error) {
  var issue = result.data.issue
  console.log(issue.identifier + ": " + issue.title + " (" + issue.commentCount + " comments)")
}
```
```js
// List all organization members
var result = app.integrations.linear.raw_query({
  query: String.raw`,
    query {
      organization {
        name
        users(first: 50) {
          nodes {
            id
            name
            email
          }
        }
      }
    }
  `
})

for (const user of (result.data.organization.users.nodes)) {
  console.log(user.name + " <" + user.email + ">")
}
```
---

## Pagination

Several list endpoints (`list_issues`, `search_issues`, `list_projects`, `list_initiatives`) support cursor-based pagination. The response includes:

| Field | Type | Description |
|-------|------|-------------|
| `has_next_page` | boolean | Whether more results exist. |
| `end_cursor` | string or nil | Cursor to pass as `after` for the next page. |

### Paginating through all results

```js
var issues = []
var cursor = null

do {
  var result = app.integrations.linear.list_issues({
    team_id: "team-abc-123",
    limit: 50,
    after: cursor,
  })

  if (result.error) {
    console.log("Error: " + result.error)
    break
  }

  for (const issue of (result.issues)) {
    issues.push(issue)
  }

  cursor = result.has_next_page && result.end_cursor || null
} while (!(!cursor));

console.log("Fetched " + issues.length + " issues total")
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

```js
// Default account (always works)
app.integrations.linear.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.linear.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.linear.work.function_name({ /* parameters */ })
app.integrations.linear.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
