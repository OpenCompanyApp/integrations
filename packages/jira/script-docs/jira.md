# Jira — JavaScript API Reference

## Overview

The Jira integration provides full access to issues, projects, comments, attachments, workflows, agile boards, sprints, and versions on Jira Cloud. All 20 tools are available under the `app.integrations.jira` namespace.

Every tool call accepts a single JavaScript object with named parameters and returns a JavaScript object with the API response data.

## Authentication

The Jira integration authenticates using a **Personal Access Token** (Bearer token) combined with your **Jira Cloud Domain URL**.

To generate a token: **Atlassian Account Security → API tokens** (`https://id.atlassian.com/manage-profile/security/api-tokens`)

Two credentials are required:

| Credential | Description |
|-----------|-------------|
| `api_token` | Personal Access Token from Atlassian |
| `base_url` | Your Jira Cloud domain URL (e.g. `https://mycompany.atlassian.net`) |

```js
// All calls use the same namespace — no per-call auth needed
var projects = app.integrations.jira.list_projects({})
```
## Issues

### `app.integrations.jira.create_issue({ project_key, summary, issue_type, description, priority, assignee, labels })`

Create a new issue in a Jira project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_key` | string | yes | The project key (e.g. `"PROJ"`) |
| `summary` | string | yes | The summary (title) of the issue |
| `issue_type` | string | no | Issue type name: `"Task"`, `"Bug"`, `"Story"`, `"Epic"`, etc. (default: `"Task"`) |
| `description` | string | no | Issue description (plain text) |
| `priority` | string | no | Priority name: `"Highest"`, `"High"`, `"Medium"`, `"Low"`, `"Lowest"` |
| `assignee` | string | no | Atlassian account ID of the user to assign |
| `labels` | array | no | Array of label strings (e.g. `{ "backend", "urgent" }`) |

```js
var issue = app.integrations.jira.create_issue({
  project_key: "PROJ",
  summary: "Fix login page crash on mobile",
  issue_type: "Bug",
  description: "The login page crashes when entering credentials on mobile Safari.",
  priority: "High",
  labels: [ "mobile", "critical" ],
})

console.log("Created: " + issue.key)
console.log("ID: " + issue.id)
console.log("Self: " + issue.self)
```
Create a story with an assignee:

```js
var issue = app.integrations.jira.create_issue({
  project_key: "PROJ",
  summary: "Implement OAuth2 authentication",
  issue_type: "Story",
  description: "Add OAuth2 login support for third-party providers.",
  priority: "Medium",
  assignee: "5f8a7b9c1d2e3f4a5b6c7d8e",
})

console.log("Created: " + issue.key)
```
### `app.integrations.jira.get_issue({ key })`

Get details for a specific Jira issue by its key.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```js
var issue = app.integrations.jira.get_issue({
  key: "PROJ-123",
})

console.log("Summary: " + issue.fields.summary)
console.log("Status: " + issue.fields.status.name)
console.log("Type: " + issue.fields.issuetype.name)
console.log("Priority: " + issue.fields.priority.name)
console.log("Assignee: " + (issue.fields.assignee && issue.fields.assignee.displayName || "Unassigned"))
console.log("Created: " + issue.fields.created)
```
### `app.integrations.jira.update_issue({ key, summary, description, priority, assignee })`

Update an existing Jira issue. Only the fields you provide will be changed.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `summary` | string | no | New summary (title) |
| `description` | string | no | New description (plain text) |
| `priority` | string | no | New priority name (e.g. `"High"`, `"Low"`) |
| `assignee` | string | no | Atlassian account ID of the new assignee |

```js
// Update the summary and priority
var result = app.integrations.jira.update_issue({
  key: "PROJ-123",
  summary: "Fix login page crash on mobile (revised)",
  priority: "Highest",
})

console.log("Updated successfully: " + String(result.success))
```
```js
// Reassign an issue
var result = app.integrations.jira.update_issue({
  key: "PROJ-123",
  assignee: "5f8a7b9c1d2e3f4a5b6c7d8e",
})
```
### `app.integrations.jira.search_issues({ jql, start_at, max_results, fields })`

Search for Jira issues using JQL (Jira Query Language).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `jql` | string | yes | JQL query string |
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |
| `fields` | string | no | Comma-separated field names to return (e.g. `"summary,status,assignee"`) |

```js
// Find all open bugs in a project
var results = app.integrations.jira.search_issues({
  jql: 'project = PROJ AND type = Bug AND status = Open ORDER BY created DESC',
  max_results: 20,
})

console.log("Total: " + results.total)
for (const issue of (results.issues)) {
  console.log(issue.key + ": " + issue.fields.summary)
}
```
```js
// Find issues assigned to the current user
var results = app.integrations.jira.search_issues({
  jql: "assignee = currentUser() AND status != Done ORDER BY priority DESC",
  fields: "summary,status,priority",
})

for (const issue of (results.issues)) {
  console.log(issue.key + " [" + issue.fields.status.name + "] " + issue.fields.summary)
}
```
### `app.integrations.jira.delete_issue({ key })`

Delete a Jira issue. **This action is irreversible.**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key to delete (e.g. `"PROJ-123"`) |

```js
var result = app.integrations.jira.delete_issue({
  key: "PROJ-123",
})

console.log("Deleted successfully: " + String(result.success))
```
## Comments & Attachments

### `app.integrations.jira.add_comment({ issue_key, body })`

Add a comment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `body` | string | yes | Comment text |

```js
var comment = app.integrations.jira.add_comment({
  issue_key: "PROJ-123",
  body: "Investigating this issue. It appears to be related to the session token handling.",
})

console.log("Comment ID: " + comment.id)
console.log("Created: " + comment.created)
```
### `app.integrations.jira.list_comments({ issue_key })`

List all comments on a Jira issue. Returns comment body, author, and creation date.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```js
var result = app.integrations.jira.list_comments({
  issue_key: "PROJ-123",
})

for (const comment of (result.comments)) {
  console.log(comment.author.displayName + " (" + comment.created + "):")
  console.log("  " + comment.body)
}
```
### `app.integrations.jira.add_attachment({ issue_key, filename, content })`

Add a file attachment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `filename` | string | yes | Name of the file to attach (e.g. `"report.pdf"`) |
| `content` | string | yes | File content (raw string or base64-encoded) |

```js
var result = app.integrations.jira.add_attachment({
  issue_key: "PROJ-123",
  filename: "error-log.txt",
  content: "2024-01-15 10:23: ERROR - Session expired unexpectedly\n2024-01-15 10:24: WARN - Retrying connection...",
})

for (const attachment of (result)) {
  console.log("Attached: " + attachment.filename + " (ID: " + attachment.id + ")")
}
```
```js
// Attach a CSV report
var csv = "name,status,priority\nBug #1,Open,High\nBug #2,Closed,Medium"
var result = app.integrations.jira.add_attachment({
  issue_key: "PROJ-456",
  filename: "bug-report.csv",
  content: csv,
})
```
## Workflow

### `app.integrations.jira.get_transitions({ issue_key })`

Get the available status transitions for a Jira issue. Returns transition IDs and target status names needed to change the issue status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```js
var result = app.integrations.jira.get_transitions({
  issue_key: "PROJ-123",
})

for (const transition of (result.transitions)) {
  console.log(transition.id + ": " + transition.name + " → " + transition.to.name)
}
// Example output:
//   11: Start Progress → In Progress
//   21: Done → Done
//   31: Close Issue → Closed
```
### `app.integrations.jira.transition_issue({ issue_key, transition_id })`

Transition a Jira issue to a new status. Use `get_transitions` first to find valid transition IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `transition_id` | string | yes | The transition ID to execute (from `get_transitions`) |

```js
// Move an issue to In Progress
var result = app.integrations.jira.transition_issue({
  issue_key: "PROJ-123",
  transition_id: "11",
})

console.log("Transitioned successfully: " + String(result.success))
```
```js
// Full workflow: discover transitions, then move to Done
var transitions = app.integrations.jira.get_transitions({
  issue_key: "PROJ-123",
})

for (const t of (transitions.transitions)) {
  if (t.name === "Done") {
    app.integrations.jira.transition_issue({
      issue_key: "PROJ-123",
      transition_id: t.id,
    })
    console.log("Marked as Done!")
    break
  }
}
```
### `app.integrations.jira.assign_issue({ issue_key, account_id })`

Assign a Jira issue to a user by their Atlassian account ID. Use `search_users` to find account IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `account_id` | string | yes | The Atlassian account ID of the user |

```js
var result = app.integrations.jira.assign_issue({
  issue_key: "PROJ-123",
  account_id: "5f8a7b9c1d2e3f4a5b6c7d8e",
})

console.log("Assigned successfully: " + String(result.success))
```
```js
// Search for a user, then assign the issue
var users = app.integrations.jira.search_users({
  query: "john@example.com",
})

if (users.length > 0) {
  app.integrations.jira.assign_issue({
    issue_key: "PROJ-123",
    account_id: users[0].accountId,
  })
  console.log("Assigned to: " + users[0].displayName)
}
```
## Projects & Metadata

### `app.integrations.jira.list_projects({ start_at, max_results })`

List Jira projects accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```js
var result = app.integrations.jira.list_projects({})

for (const project of (result.values)) {
  console.log(project.key + ": " + project.name + " (" + project.projectTypeKey + ")")
}
```
```js
// Paginate through projects
var result = app.integrations.jira.list_projects({
  start_at: 0,
  max_results: 10,
})

console.log("Showing " + result.values.length + " of " + result.total + " projects")
```
### `app.integrations.jira.get_issue_types({})`

Get all available issue types in Jira. Returns issue type names and IDs needed when creating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var types = app.integrations.jira.get_issue_types({})

for (const t of (types)) {
  console.log(t.id + ": " + t.name + " — " + (t.description || ""))
}
// Example output:
//   10001: Story — A user story.
//   10002: Task — A task that needs to be done.
//   10003: Bug — A bug in the product.
//   10004: Epic — A large body of work.
//   10005: Sub-task — A sub-task.
```
### `app.integrations.jira.get_user({ account_id })`

Get details for a specific Jira user by their Atlassian account ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | The Atlassian account ID of the user |

```js
var user = app.integrations.jira.get_user({
  account_id: "5f8a7b9c1d2e3f4a5b6c7d8e",
})

console.log("Name: " + user.displayName)
console.log("Email: " + (user.emailAddress || "hidden"))
console.log("Active: " + String(user.active))
console.log("Account type: " + (user.accountType || "unknown"))
```
### `app.integrations.jira.search_users({ query, max_results })`

Search for Jira users by name or email. Returns account IDs needed for assigning issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (name or email substring) |
| `max_results` | integer | no | Max results to return (default: `10`) |

```js
var users = app.integrations.jira.search_users({
  query: "john",
  max_results: 5,
})

for (const user of (users)) {
  console.log(user.accountId + ": " + user.displayName + " (" + (user.emailAddress || "no email") + ")")
}
```
### `app.integrations.jira.list_priorities({})`

List all available issue priorities in Jira. Returns priority names and IDs needed when creating or updating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var priorities = app.integrations.jira.list_priorities({})

for (const p of (priorities)) {
  console.log(p.id + ": " + p.name)
}
// Example output:
//   1: Highest
//   2: High
//   3: Medium
//   4: Low
//   5: Lowest
```
## Agile Boards & Sprints

### `app.integrations.jira.list_boards({ start_at, max_results })`

List agile boards accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```js
var result = app.integrations.jira.list_boards({})

for (const board of (result.values)) {
  console.log(board.id + ": " + board.name + " (" + board.type + ")")
}
// Example output:
//   1: PROJ Board (scrum)
//   2: PROJ Kanban (kanban)
```
```js
// Paginate through boards
var result = app.integrations.jira.list_boards({
  start_at: 0,
  max_results: 10,
})

console.log("Showing " + result.values.length + " of " + result.total + " boards")
```
### `app.integrations.jira.list_sprints({ board_id, state })`

List sprints for a specific Jira board. Optionally filter by sprint state.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The board ID (from `list_boards`) |
| `state` | string | no | Filter by sprint state: `"active"`, `"closed"`, or `"future"` |

```js
// List all sprints for a board
var result = app.integrations.jira.list_sprints({
  board_id: 1,
})

for (const sprint of (result.values)) {
  console.log(sprint.id + ": " + sprint.name + " [" + sprint.state + "]")
}
// Example output:
//   10: Sprint 1 [closed]
//   11: Sprint 2 [closed]
//   12: Sprint 3 [active]
//   13: Sprint 4 [future]
```
```js
// Get only the active sprint
var result = app.integrations.jira.list_sprints({
  board_id: 1,
  state: "active",
})

for (const sprint of (result.values)) {
  console.log("Active sprint: " + sprint.name)
}
```
### `app.integrations.jira.list_sprint_issues({ sprint_id, start_at, max_results })`

List issues in a specific Jira sprint.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sprint_id` | integer | yes | The sprint ID (from `list_sprints`) |
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```js
var result = app.integrations.jira.list_sprint_issues({
  sprint_id: 12,
})

console.log("Total issues: " + result.total)
for (const issue of (result.issues)) {
  console.log(issue.key + ": " + issue.fields.summary + " [" + issue.fields.status.name + "]")
}
```
```js
// Paginate through sprint issues
var result = app.integrations.jira.list_sprint_issues({
  sprint_id: 12,
  start_at: 0,
  max_results: 50,
})

console.log("Showing " + result.issues.length + " of " + result.total + " issues")
```
### `app.integrations.jira.create_version({ project_key, name, description, start_date, release_date })`

Create a new version (release) in a Jira project.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_key` | string | yes | The project key (e.g. `"PROJ"`) |
| `name` | string | yes | Version name (e.g. `"v1.0.0"`) |
| `description` | string | no | Description of the version |
| `start_date` | string | no | Start date in ISO 8601 format (e.g. `"2024-01-15"`) |
| `release_date` | string | no | Release date in ISO 8601 format (e.g. `"2024-03-01"`) |

```js
var version = app.integrations.jira.create_version({
  project_key: "PROJ",
  name: "v2.0.0",
  description: "Major release with new authentication module",
  start_date: "2024-01-15",
  release_date: "2024-03-01",
})

console.log("Version ID: " + version.id)
console.log("Name: " + version.name)
console.log("Released: " + String(version.released))
```
```js
// Create a simple version with just a name
var version = app.integrations.jira.create_version({
  project_key: "PROJ",
  name: "Backlog",
})

console.log("Created version: " + version.name)
```
## Common Workflows

### Create, assign, and transition an issue

```js
// 1. Find the user to assign
var users = app.integrations.jira.search_users({
  query: "john@example.com",
})
var assignee_id = users[0].accountId

// 2. Create the issue
var issue = app.integrations.jira.create_issue({
  project_key: "PROJ",
  summary: "Fix session timeout handling",
  issue_type: "Bug",
  description: "Users are being logged out unexpectedly after 5 minutes of inactivity.",
  priority: "High",
  assignee: assignee_id,
})

console.log("Created: " + issue.key)

// 3. Add a comment
app.integrations.jira.add_comment({
  issue_key: issue.key,
  body: "Investigating — looks related to the JWT refresh token logic.",
})

// 4. Move to In Progress
var transitions = app.integrations.jira.get_transitions({
  issue_key: issue.key,
})

for (const t of (transitions.transitions)) {
  if (t.name === "In Progress") {
    app.integrations.jira.transition_issue({
      issue_key: issue.key,
      transition_id: t.id,
    })
    console.log("Moved to In Progress")
    break
  }
}
```
### Sprint report: list active sprint issues by status

```js
// 1. Find the board
var boards = app.integrations.jira.list_boards({})

// 2. Find the active sprint on the first board
var sprints = app.integrations.jira.list_sprints({
  board_id: boards.values[0].id,
  state: "active",
})

var active_sprint = sprints.values[0]
console.log("Active sprint: " + active_sprint.name)

// 3. Get all issues in the sprint
var result = app.integrations.jira.list_sprint_issues({
  sprint_id: active_sprint.id,
})

// 4. Group by status
var by_status = {}
for (const issue of (result.issues)) {
  var status = issue.fields.status.name
  by_status[status] = (by_status[status] || 0) + 1
}

for (const [status, count] of Object.entries(by_status)) {
  console.log("  " + status + ": " + count)
}
```
### Search and triage bugs

```js
// Find all unassigned high-priority bugs
var results = app.integrations.jira.search_issues({
  jql: 'project = PROJ AND type = Bug AND priority = High AND assignee is EMPTY AND status = Open',
  max_results: 20,
})

console.log("Found " + results.total + " unassigned high-priority bugs")

for (const issue of (results.issues)) {
  // Find a developer to assign
  var users = app.integrations.jira.search_users({
    query: "developer",
    max_results: 1,
  })

  if (users.length > 0) {
    app.integrations.jira.assign_issue({
      issue_key: issue.key,
      account_id: users[0].accountId,
    })

    app.integrations.jira.add_comment({
      issue_key: issue.key,
      body: "Triaged && assigned to " + users[0].displayName + ".",
    })

    console.log(issue.key + " → assigned to " + users[0].displayName)
  }
}
```
### Create a version and search for fix issues

```js
// 1. Create a new release version
var version = app.integrations.jira.create_version({
  project_key: "PROJ",
  name: "v1.5.0",
  description: "Performance && stability release",
  release_date: "2024-06-30",
})

console.log("Created version: " + version.name)

// 2. Find all issues resolved recently
var results = app.integrations.jira.search_issues({
  jql: 'project = PROJ AND status = Done AND resolved >= -7d ORDER BY resolved DESC',
  fields: "summary,status,priority",
})

console.log("Issues resolved in the last 7 days:")
for (const issue of (results.issues)) {
  console.log("  " + issue.key + ": " + issue.fields.summary)
}
```
## Pagination

Several tools support pagination via `start_at` (0-based offset) and `max_results` (page size) parameters:

| Tool | Default page size | Max page size |
|------|------------------|---------------|
| `search_issues` | 50 | 100 |
| `list_projects` | 50 | 100 |
| `list_boards` | 50 | 100 |
| `list_sprint_issues` | 50 | 100 |
| `search_users` | 10 | — |

Paginated responses typically include:

```js
var result = app.integrations.jira.search_issues({
  jql: "project = PROJ",
  start_at: 0,
  max_results: 50,
})

result.total // total number of matching issues
result.start_at // current offset
result.max_results // page size used
result.issues // array of issue objects on this page
```
To iterate through all pages:

```js
var all_issues = []
var start_at = 0
var max_results = 50

do {
  var result = app.integrations.jira.search_issues({
    jql: "project = PROJ AND status = Open",
    start_at: start_at,
    max_results: max_results,
  })

  for (const issue of (result.issues)) {
    all_issues.push(issue)
  }

  start_at = start_at + max_results
} while (!(start_at >= result.total));

console.log("Fetched " + all_issues.length + " open issues")
```
## Notes

- **JQL syntax**: The `search_issues` tool uses Jira Query Language (JQL). Common operators: `=`, `!=`, `IN`, `NOT IN`, `>`, `<`, `>=`, `<=`, `IS`, `IS NOT`, `~` (contains), `!~` (does not contain). See the [Jira JQL documentation](https://support.atlassian.com/jira-software-cloud/docs/use-advanced-search-with-jira-query-language-jql/) for full syntax.
- **Issue keys**: Most tools use the issue key format `PROJECT-NUMBER` (e.g. `"PROJ-123"`). Some tools use the parameter name `key`, others use `issue_key` — check the parameter tables above.
- **Account IDs**: Jira Cloud uses Atlassian account IDs (long alphanumeric strings) for user operations. Use `search_users` to find account IDs by name or email.
- **Transition IDs**: Transition IDs are numeric and specific to each issue's workflow state. Always call `get_transitions` before `transition_issue` to discover valid IDs.
- **Description format**: Descriptions are sent as Atlassian Document Format (ADF). The integration handles plain-text-to-ADF conversion automatically.
- **Attachments**: The `add_attachment` tool uses multipart form data. Content can be a raw string for text files or base64-encoded for binary files.
- **Agile API**: Board and sprint tools use the Jira Agile REST API (`/rest/agile/1.0`), which requires Jira Software access.
- **Rate limits**: Jira Cloud enforces rate limits. If you encounter errors, reduce `max_results` or add delays between calls.
- **Delete is irreversible**: The `delete_issue` tool permanently removes an issue. Consider transitioning to a "Done" or "Closed" status instead when possible.

---

## Multi-Account Usage

If you have multiple jira accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.jira.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.jira.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.jira.work.function_name({ /* parameters */ })
app.integrations.jira.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
