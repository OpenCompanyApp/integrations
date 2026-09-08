# Jira — Ruby API Reference

## Overview

The Jira integration provides full access to issues, projects, comments, attachments, workflows, agile boards, sprints, and versions on Jira Cloud. All 20 tools are available under the `app.integrations.jira` namespace.

Every tool call accepts a single Ruby object with named parameters and returns a Ruby object with the API response data.

## Authentication

The Jira integration authenticates using a **Personal Access Token** (Bearer token) combined with your **Jira Cloud Domain URL**.

To generate a token: **Atlassian Account Security → API tokens** (`https://id.atlassian.com/manage-profile/security/api-tokens`)

Two credentials are required:

| Credential | Description |
|-----------|-------------|
| `api_token` | Personal Access Token from Atlassian |
| `base_url` | Your Jira Cloud domain URL (e.g. `https://mycompany.atlassian.net`) |

```ruby
# All calls use the same namespace — no per-call auth needed
projects = app.integrations.jira.list_projects()
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

```ruby
issue = app.integrations.jira.create_issue(project_key: "PROJ", summary: "Fix login page crash on mobile", issue_type: "Bug", description: "The login page crashes when entering credentials on mobile Safari.", priority: "High", labels: ["mobile", "critical"])
puts("Created (Unix seconds): " + (issue.key).to_s)
puts("ID: " + (issue.id).to_s)
puts("Self: " + (issue.self).to_s)
```
Create a story with an assignee:

```ruby
issue = app.integrations.jira.create_issue(project_key: "PROJ", summary: "Implement OAuth2 authentication", issue_type: "Story", description: "Add OAuth2 login support for third-party providers.", priority: "Medium", assignee: "5f8a7b9c1d2e3f4a5b6c7d8e")
puts("Created (Unix seconds): " + (issue.key).to_s)
```
### `app.integrations.jira.get_issue({ key })`

Get details for a specific Jira issue by its key.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```ruby
issue = app.integrations.jira.get_issue(key: "PROJ-123")
puts("Summary: " + (issue.fields.summary).to_s)
puts("Status: " + (issue.fields.status.name).to_s)
puts("Type: " + (issue.fields.issuetype.name).to_s)
puts("Priority: " + (issue.fields.priority.name).to_s)
puts("Assignee: " + (((issue.fields.assignee && issue.fields.assignee.displayName) || "Unassigned")).to_s)
puts("Created (Unix seconds): " + (issue.fields.created).to_s)
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

```ruby
# Update the summary and priority
result = app.integrations.jira.update_issue(key: "PROJ-123", summary: "Fix login page crash on mobile (revised)", priority: "Highest")
puts("Updated successfully: " + ((result.success).to_s).to_s)
```
```ruby
# Reassign an issue
result = app.integrations.jira.update_issue(key: "PROJ-123", assignee: "5f8a7b9c1d2e3f4a5b6c7d8e")
```
### `app.integrations.jira.search_issues({ jql, start_at, max_results, fields })`

Search for Jira issues using JQL (Jira Query Language).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `jql` | string | yes | JQL query string |
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |
| `fields` | string | no | Comma-separated field names to return (e.g. `"summary,status,assignee"`) |

```ruby
# Find all open bugs in a project
results = app.integrations.jira.search_issues(jql: "project = PROJ AND type = Bug AND status = Open ORDER BY created DESC", max_results: 20)
puts("Total: " + (results.total).to_s)
results.issues.each do |issue|
  puts((issue.key).to_s + ": " + (issue.fields.summary).to_s)
end
```
```ruby
# Find issues assigned to the current user
results = app.integrations.jira.search_issues(jql: "assignee = currentUser() AND status != Done ORDER BY priority DESC", fields: "summary,status,priority")
results.issues.each do |issue|
  puts((issue.key).to_s + " [" + (issue.fields.status.name).to_s + "] " + (issue.fields.summary).to_s)
end
```
### `app.integrations.jira.delete_issue({ key })`

Delete a Jira issue. **This action is irreversible.**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key to delete (e.g. `"PROJ-123"`) |

```ruby
result = app.integrations.jira.delete_issue(key: "PROJ-123")
puts("Deleted successfully: " + ((result.success).to_s).to_s)
```
## Comments & Attachments

### `app.integrations.jira.add_comment({ issue_key, body })`

Add a comment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `body` | string | yes | Comment text |

```ruby
comment = app.integrations.jira.add_comment(issue_key: "PROJ-123", body: "Investigating this issue. It appears to be related to the session token handling.")
puts("Comment ID: " + (comment.id).to_s)
puts("Created (Unix seconds): " + (comment.created).to_s)
```
### `app.integrations.jira.list_comments({ issue_key })`

List all comments on a Jira issue. Returns comment body, author, and creation date.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```ruby
result = app.integrations.jira.list_comments(issue_key: "PROJ-123")
result.comments.each do |comment|
  puts((comment.author.displayName).to_s + " (" + (comment.created).to_s + "):")
  puts("  " + (comment.body).to_s)
end
```
### `app.integrations.jira.add_attachment({ issue_key, filename, content })`

Add a file attachment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `filename` | string | yes | Name of the file to attach (e.g. `"report.pdf"`) |
| `content` | string | yes | File content (raw string or base64-encoded) |

```ruby
result = app.integrations.jira.add_attachment(issue_key: "PROJ-123", filename: "error-log.txt", content: "2024-01-15 10:23: ERROR - Session expired unexpectedly\n2024-01-15 10:24: WARN - Retrying connection...")
result.each do |attachment|
  puts("Attached: " + (attachment.filename).to_s + " (ID: " + (attachment.id).to_s + ")")
end
```
```ruby
# Attach a CSV report
csv = "name,status,priority\nBug #1,Open,High\nBug #2,Closed,Medium"
result = app.integrations.jira.add_attachment(issue_key: "PROJ-456", filename: "bug-report.csv", content: csv)
```
## Workflow

### `app.integrations.jira.get_transitions({ issue_key })`

Get the available status transitions for a Jira issue. Returns transition IDs and target status names needed to change the issue status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```ruby
result = app.integrations.jira.get_transitions(issue_key: "PROJ-123")
result.transitions.each do |transition|
  puts((transition.id).to_s + ": " + (transition.name).to_s + " → " + (transition.to.name).to_s)
end
```
### `app.integrations.jira.transition_issue({ issue_key, transition_id })`

Transition a Jira issue to a new status. Use `get_transitions` first to find valid transition IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `transition_id` | string | yes | The transition ID to execute (from `get_transitions`) |

```ruby
# Move an issue to In Progress
result = app.integrations.jira.transition_issue(issue_key: "PROJ-123", transition_id: "11")
puts("Transitioned successfully: " + ((result.success).to_s).to_s)
```
```ruby
# Full workflow: discover transitions, then move to Done
transitions = app.integrations.jira.get_transitions(issue_key: "PROJ-123")
transitions.transitions.each do |t|
  if (t.name == "Done")
    app.integrations.jira.transition_issue(issue_key: "PROJ-123", transition_id: t.id)
    puts("Marked as Done!")
    break
  end
end
```
### `app.integrations.jira.assign_issue({ issue_key, account_id })`

Assign a Jira issue to a user by their Atlassian account ID. Use `search_users` to find account IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `account_id` | string | yes | The Atlassian account ID of the user |

```ruby
result = app.integrations.jira.assign_issue(issue_key: "PROJ-123", account_id: "5f8a7b9c1d2e3f4a5b6c7d8e")
puts("Assigned successfully: " + ((result.success).to_s).to_s)
```
```ruby
# Search for a user, then assign the issue
users = app.integrations.jira.search_users(query: "john@example.com")
if (users.length > 0)
  app.integrations.jira.assign_issue(issue_key: "PROJ-123", account_id: users[0].accountId)
  puts("Assigned to: " + (users[0].displayName).to_s)
end
```
## Projects & Metadata

### `app.integrations.jira.list_projects({ start_at, max_results })`

List Jira projects accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```ruby
result = app.integrations.jira.list_projects()
result.values.each do |project|
  puts((project.key).to_s + ": " + (project.name).to_s + " (" + (project.projectTypeKey).to_s + ")")
end
```
```ruby
# Paginate through projects
result = app.integrations.jira.list_projects(start_at: 0, max_results: 10)
puts("Showing " + (result.values.length).to_s + " of " + (result.total).to_s + " projects")
```
### `app.integrations.jira.get_issue_types({})`

Get all available issue types in Jira. Returns issue type names and IDs needed when creating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
types = app.integrations.jira.get_issue_types()
types.each do |t|
  puts((t.id).to_s + ": " + (t.name).to_s + " — " + ((t.description || "")).to_s)
end
```
### `app.integrations.jira.get_user({ account_id })`

Get details for a specific Jira user by their Atlassian account ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | The Atlassian account ID of the user |

```ruby
user = app.integrations.jira.get_user(account_id: "5f8a7b9c1d2e3f4a5b6c7d8e")
puts("Name: " + (user.displayName).to_s)
puts("Email: " + ((user.emailAddress || "hidden")).to_s)
puts("Active: " + ((user.active).to_s).to_s)
puts("Account type: " + ((user.accountType || "unknown")).to_s)
```
### `app.integrations.jira.search_users({ query, max_results })`

Search for Jira users by name or email. Returns account IDs needed for assigning issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (name or email substring) |
| `max_results` | integer | no | Max results to return (default: `10`) |

```ruby
users = app.integrations.jira.search_users(query: "john", max_results: 5)
users.each do |user|
  puts((user.accountId).to_s + ": " + (user.displayName).to_s + " (" + ((user.emailAddress || "no email")).to_s + ")")
end
```
### `app.integrations.jira.list_priorities({})`

List all available issue priorities in Jira. Returns priority names and IDs needed when creating or updating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```ruby
priorities = app.integrations.jira.list_priorities()
priorities.each do |p|
  puts((p.id).to_s + ": " + (p.name).to_s)
end
```
## Agile Boards & Sprints

### `app.integrations.jira.list_boards({ start_at, max_results })`

List agile boards accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```ruby
result = app.integrations.jira.list_boards()
result.values.each do |board|
  puts((board.id).to_s + ": " + (board.name).to_s + " (" + (board.type).to_s + ")")
end
```
```ruby
# Paginate through boards
result = app.integrations.jira.list_boards(start_at: 0, max_results: 10)
puts("Showing " + (result.values.length).to_s + " of " + (result.total).to_s + " boards")
```
### `app.integrations.jira.list_sprints({ board_id, state })`

List sprints for a specific Jira board. Optionally filter by sprint state.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The board ID (from `list_boards`) |
| `state` | string | no | Filter by sprint state: `"active"`, `"closed"`, or `"future"` |

```ruby
# List all sprints for a board
result = app.integrations.jira.list_sprints(board_id: 1)
result.values.each do |sprint|
  puts((sprint.id).to_s + ": " + (sprint.name).to_s + " [" + (sprint.state).to_s + "]")
end
```
```ruby
# Get only the active sprint
result = app.integrations.jira.list_sprints(board_id: 1, state: "active")
result.values.each do |sprint|
  puts("Active sprint: " + (sprint.name).to_s)
end
```
### `app.integrations.jira.list_sprint_issues({ sprint_id, start_at, max_results })`

List issues in a specific Jira sprint.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sprint_id` | integer | yes | The sprint ID (from `list_sprints`) |
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```ruby
result = app.integrations.jira.list_sprint_issues(sprint_id: 12)
puts("Total issues: " + (result.total).to_s)
result.issues.each do |issue|
  puts((issue.key).to_s + ": " + (issue.fields.summary).to_s + " [" + (issue.fields.status.name).to_s + "]")
end
```
```ruby
# Paginate through sprint issues
result = app.integrations.jira.list_sprint_issues(sprint_id: 12, start_at: 0, max_results: 50)
puts("Showing " + (result.issues.length).to_s + " of " + (result.total).to_s + " issues")
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

```ruby
version = app.integrations.jira.create_version(project_key: "PROJ", name: "v2.0.0", description: "Major release with new authentication module", start_date: "2024-01-15", release_date: "2024-03-01")
puts("Version ID: " + (version.id).to_s)
puts("Name: " + (version.name).to_s)
puts("Released: " + ((version.released).to_s).to_s)
```
```ruby
# Create a simple version with just a name
version = app.integrations.jira.create_version(project_key: "PROJ", name: "Backlog")
puts("Created version: " + (version.name).to_s)
```
## Common Workflows

### Create, assign, and transition an issue

```ruby
# 1. Find the user to assign
users = app.integrations.jira.search_users(query: "john@example.com")
assignee_id = users[0].accountId
# 2. Create the issue
issue = app.integrations.jira.create_issue(project_key: "PROJ", summary: "Fix session timeout handling", issue_type: "Bug", description: "Users are being logged out unexpectedly after 5 minutes of inactivity.", priority: "High", assignee: assignee_id)
puts("Created (Unix seconds): " + (issue.key).to_s)
# 3. Add a comment
app.integrations.jira.add_comment(issue_key: issue.key, body: "Investigating — looks related to the JWT refresh token logic.")
# 4. Move to In Progress
transitions = app.integrations.jira.get_transitions(issue_key: issue.key)
transitions.transitions.each do |t|
  if (t.name == "In Progress")
    app.integrations.jira.transition_issue(issue_key: issue.key, transition_id: t.id)
    puts("Moved to In Progress")
    break
  end
end
```
### Sprint report: list active sprint issues by status

```ruby
# 1. Find the board
boards = app.integrations.jira.list_boards()
# 2. Find the active sprint on the first board
sprints = app.integrations.jira.list_sprints(board_id: boards.values[0].id, state: "active")
active_sprint = sprints.values[0]
puts("Active sprint: " + (active_sprint.name).to_s)
# 3. Get all issues in the sprint
result = app.integrations.jira.list_sprint_issues(sprint_id: active_sprint.id)
# 4. Group by status
by_status = {}
result.issues.each do |issue|
  status = issue.fields.status.name
  by_status[status] = ((by_status[status] || 0) + 1)
end
by_status.to_a.each do |status, count|
  puts("  " + (status).to_s + ": " + (count).to_s)
end
```
### Search and triage bugs

```ruby
# Find all unassigned high-priority bugs
results = app.integrations.jira.search_issues(jql: "project = PROJ AND type = Bug AND priority = High AND assignee is EMPTY AND status = Open", max_results: 20)
puts("Found " + (results.total).to_s + " unassigned high-priority bugs")
results.issues.each do |issue|
  # Find a developer to assign
  users = app.integrations.jira.search_users(query: "developer", max_results: 1)
  if (users.length > 0)
    app.integrations.jira.assign_issue(issue_key: issue.key, account_id: users[0].accountId)
    app.integrations.jira.add_comment(issue_key: issue.key, body: "Triaged && assigned to " + (users[0].displayName).to_s + ".")
    puts((issue.key).to_s + " → assigned to " + (users[0].displayName).to_s)
  end
end
```
### Create a version and search for fix issues

```ruby
# 1. Create a new release version
version = app.integrations.jira.create_version(project_key: "PROJ", name: "v1.5.0", description: "Performance && stability release", release_date: "2024-06-30")
puts("Created version: " + (version.name).to_s)
# 2. Find all issues resolved recently
results = app.integrations.jira.search_issues(jql: "project = PROJ AND status = Done AND resolved >= -7d ORDER BY resolved DESC", fields: "summary,status,priority")
puts("Issues resolved in the last 7 days:")
results.issues.each do |issue|
  puts("  " + (issue.key).to_s + ": " + (issue.fields.summary).to_s)
end
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

```ruby
result = app.integrations.jira.search_issues(jql: "project = PROJ", start_at: 0, max_results: 50)
result.total
# total number of matching issues
result.start_at
# current offset
result.max_results
# page size used
result.issues
```
To iterate through all pages:

```ruby
all_issues = []
start_at = 0
max_results = 50
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.jira.search_issues(jql: "project = PROJ AND status = Open", start_at: start_at, max_results: max_results)
  result.issues.each do |issue|
    all_issues.push(issue)
  end
  start_at = (start_at + max_results)
  break unless (!(start_at >= result.total))
end
puts("Fetched " + (all_issues.length).to_s + " open issues")
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
