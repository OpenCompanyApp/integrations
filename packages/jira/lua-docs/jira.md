# Jira — Lua API Reference

## Overview

The Jira integration provides full access to issues, projects, comments, attachments, workflows, agile boards, sprints, and versions on Jira Cloud. All 20 tools are available under the `app.integrations.jira` namespace.

Every tool call accepts a single Lua table with named parameters and returns a Lua table with the API response data.

## Authentication

The Jira integration authenticates using a **Personal Access Token** (Bearer token) combined with your **Jira Cloud Domain URL**.

To generate a token: **Atlassian Account Security → API tokens** (`https://id.atlassian.com/manage-profile/security/api-tokens`)

Two credentials are required:

| Credential | Description |
|-----------|-------------|
| `api_token` | Personal Access Token from Atlassian |
| `base_url` | Your Jira Cloud domain URL (e.g. `https://mycompany.atlassian.net`) |

```lua
-- All calls use the same namespace — no per-call auth needed
local projects = app.integrations.jira.list_projects({})
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

```lua
local issue = app.integrations.jira.create_issue({
  project_key = "PROJ",
  summary = "Fix login page crash on mobile",
  issue_type = "Bug",
  description = "The login page crashes when entering credentials on mobile Safari.",
  priority = "High",
  labels = { "mobile", "critical" },
})

print("Created: " .. issue.key)
print("ID: " .. issue.id)
print("Self: " .. issue.self)
```

Create a story with an assignee:

```lua
local issue = app.integrations.jira.create_issue({
  project_key = "PROJ",
  summary = "Implement OAuth2 authentication",
  issue_type = "Story",
  description = "Add OAuth2 login support for third-party providers.",
  priority = "Medium",
  assignee = "5f8a7b9c1d2e3f4a5b6c7d8e",
})

print("Created: " .. issue.key)
```

### `app.integrations.jira.get_issue({ key })`

Get details for a specific Jira issue by its key.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```lua
local issue = app.integrations.jira.get_issue({
  key = "PROJ-123",
})

print("Summary: " .. issue.fields.summary)
print("Status: " .. issue.fields.status.name)
print("Type: " .. issue.fields.issuetype.name)
print("Priority: " .. issue.fields.priority.name)
print("Assignee: " .. (issue.fields.assignee and issue.fields.assignee.displayName or "Unassigned"))
print("Created: " .. issue.fields.created)
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

```lua
-- Update the summary and priority
local result = app.integrations.jira.update_issue({
  key = "PROJ-123",
  summary = "Fix login page crash on mobile (revised)",
  priority = "Highest",
})

print("Updated successfully: " .. tostring(result.success))
```

```lua
-- Reassign an issue
local result = app.integrations.jira.update_issue({
  key = "PROJ-123",
  assignee = "5f8a7b9c1d2e3f4a5b6c7d8e",
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

```lua
-- Find all open bugs in a project
local results = app.integrations.jira.search_issues({
  jql = 'project = PROJ AND type = Bug AND status = Open ORDER BY created DESC',
  max_results = 20,
})

print("Total: " .. results.total)
for _, issue in ipairs(results.issues) do
  print(issue.key .. ": " .. issue.fields.summary)
end
```

```lua
-- Find issues assigned to the current user
local results = app.integrations.jira.search_issues({
  jql = "assignee = currentUser() AND status != Done ORDER BY priority DESC",
  fields = "summary,status,priority",
})

for _, issue in ipairs(results.issues) do
  print(issue.key .. " [" .. issue.fields.status.name .. "] " .. issue.fields.summary)
end
```

### `app.integrations.jira.delete_issue({ key })`

Delete a Jira issue. **This action is irreversible.**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The issue key to delete (e.g. `"PROJ-123"`) |

```lua
local result = app.integrations.jira.delete_issue({
  key = "PROJ-123",
})

print("Deleted successfully: " .. tostring(result.success))
```

## Comments & Attachments

### `app.integrations.jira.add_comment({ issue_key, body })`

Add a comment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `body` | string | yes | Comment text |

```lua
local comment = app.integrations.jira.add_comment({
  issue_key = "PROJ-123",
  body = "Investigating this issue. It appears to be related to the session token handling.",
})

print("Comment ID: " .. comment.id)
print("Created: " .. comment.created)
```

### `app.integrations.jira.list_comments({ issue_key })`

List all comments on a Jira issue. Returns comment body, author, and creation date.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```lua
local result = app.integrations.jira.list_comments({
  issue_key = "PROJ-123",
})

for _, comment in ipairs(result.comments) do
  print(comment.author.displayName .. " (" .. comment.created .. "):")
  print("  " .. comment.body)
end
```

### `app.integrations.jira.add_attachment({ issue_key, filename, content })`

Add a file attachment to a Jira issue.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `filename` | string | yes | Name of the file to attach (e.g. `"report.pdf"`) |
| `content` | string | yes | File content (raw string or base64-encoded) |

```lua
local result = app.integrations.jira.add_attachment({
  issue_key = "PROJ-123",
  filename = "error-log.txt",
  content = "2024-01-15 10:23: ERROR - Session expired unexpectedly\n2024-01-15 10:24: WARN - Retrying connection...",
})

for _, attachment in ipairs(result) do
  print("Attached: " .. attachment.filename .. " (ID: " .. attachment.id .. ")")
end
```

```lua
-- Attach a CSV report
local csv = "name,status,priority\nBug #1,Open,High\nBug #2,Closed,Medium"
local result = app.integrations.jira.add_attachment({
  issue_key = "PROJ-456",
  filename = "bug-report.csv",
  content = csv,
})
```

## Workflow

### `app.integrations.jira.get_transitions({ issue_key })`

Get the available status transitions for a Jira issue. Returns transition IDs and target status names needed to change the issue status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |

```lua
local result = app.integrations.jira.get_transitions({
  issue_key = "PROJ-123",
})

for _, transition in ipairs(result.transitions) do
  print(transition.id .. ": " .. transition.name .. " → " .. transition.to.name)
end
-- Example output:
--   11: Start Progress → In Progress
--   21: Done → Done
--   31: Close Issue → Closed
```

### `app.integrations.jira.transition_issue({ issue_key, transition_id })`

Transition a Jira issue to a new status. Use `get_transitions` first to find valid transition IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_key` | string | yes | The issue key (e.g. `"PROJ-123"`) |
| `transition_id` | string | yes | The transition ID to execute (from `get_transitions`) |

```lua
-- Move an issue to In Progress
local result = app.integrations.jira.transition_issue({
  issue_key = "PROJ-123",
  transition_id = "11",
})

print("Transitioned successfully: " .. tostring(result.success))
```

```lua
-- Full workflow: discover transitions, then move to Done
local transitions = app.integrations.jira.get_transitions({
  issue_key = "PROJ-123",
})

for _, t in ipairs(transitions.transitions) do
  if t.name == "Done" then
    app.integrations.jira.transition_issue({
      issue_key = "PROJ-123",
      transition_id = t.id,
    })
    print("Marked as Done!")
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

```lua
local result = app.integrations.jira.assign_issue({
  issue_key = "PROJ-123",
  account_id = "5f8a7b9c1d2e3f4a5b6c7d8e",
})

print("Assigned successfully: " .. tostring(result.success))
```

```lua
-- Search for a user, then assign the issue
local users = app.integrations.jira.search_users({
  query = "john@example.com",
})

if #users > 0 then
  app.integrations.jira.assign_issue({
    issue_key = "PROJ-123",
    account_id = users[1].accountId,
  })
  print("Assigned to: " .. users[1].displayName)
end
```

## Projects & Metadata

### `app.integrations.jira.list_projects({ start_at, max_results })`

List Jira projects accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```lua
local result = app.integrations.jira.list_projects({})

for _, project in ipairs(result.values) do
  print(project.key .. ": " .. project.name .. " (" .. project.projectTypeKey .. ")")
end
```

```lua
-- Paginate through projects
local result = app.integrations.jira.list_projects({
  start_at = 0,
  max_results = 10,
})

print("Showing " .. #result.values .. " of " .. result.total .. " projects")
```

### `app.integrations.jira.get_issue_types({})`

Get all available issue types in Jira. Returns issue type names and IDs needed when creating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local types = app.integrations.jira.get_issue_types({})

for _, t in ipairs(types) do
  print(t.id .. ": " .. t.name .. " — " .. (t.description or ""))
end
-- Example output:
--   10001: Story — A user story.
--   10002: Task — A task that needs to be done.
--   10003: Bug — A bug in the product.
--   10004: Epic — A large body of work.
--   10005: Sub-task — A sub-task.
```

### `app.integrations.jira.get_user({ account_id })`

Get details for a specific Jira user by their Atlassian account ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | The Atlassian account ID of the user |

```lua
local user = app.integrations.jira.get_user({
  account_id = "5f8a7b9c1d2e3f4a5b6c7d8e",
})

print("Name: " .. user.displayName)
print("Email: " .. (user.emailAddress or "hidden"))
print("Active: " .. tostring(user.active))
print("Account type: " .. (user.accountType or "unknown"))
```

### `app.integrations.jira.search_users({ query, max_results })`

Search for Jira users by name or email. Returns account IDs needed for assigning issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (name or email substring) |
| `max_results` | integer | no | Max results to return (default: `10`) |

```lua
local users = app.integrations.jira.search_users({
  query = "john",
  max_results = 5,
})

for _, user in ipairs(users) do
  print(user.accountId .. ": " .. user.displayName .. " (" .. (user.emailAddress or "no email") .. ")")
end
```

### `app.integrations.jira.list_priorities({})`

List all available issue priorities in Jira. Returns priority names and IDs needed when creating or updating issues.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local priorities = app.integrations.jira.list_priorities({})

for _, p in ipairs(priorities) do
  print(p.id .. ": " .. p.name)
end
-- Example output:
--   1: Highest
--   2: High
--   3: Medium
--   4: Low
--   5: Lowest
```

## Agile Boards & Sprints

### `app.integrations.jira.list_boards({ start_at, max_results })`

List agile boards accessible to the authenticated user.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```lua
local result = app.integrations.jira.list_boards({})

for _, board in ipairs(result.values) do
  print(board.id .. ": " .. board.name .. " (" .. board.type .. ")")
end
-- Example output:
--   1: PROJ Board (scrum)
--   2: PROJ Kanban (kanban)
```

```lua
-- Paginate through boards
local result = app.integrations.jira.list_boards({
  start_at = 0,
  max_results = 10,
})

print("Showing " .. #result.values .. " of " .. result.total .. " boards")
```

### `app.integrations.jira.list_sprints({ board_id, state })`

List sprints for a specific Jira board. Optionally filter by sprint state.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The board ID (from `list_boards`) |
| `state` | string | no | Filter by sprint state: `"active"`, `"closed"`, or `"future"` |

```lua
-- List all sprints for a board
local result = app.integrations.jira.list_sprints({
  board_id = 1,
})

for _, sprint in ipairs(result.values) do
  print(sprint.id .. ": " .. sprint.name .. " [" .. sprint.state .. "]")
end
-- Example output:
--   10: Sprint 1 [closed]
--   11: Sprint 2 [closed]
--   12: Sprint 3 [active]
--   13: Sprint 4 [future]
```

```lua
-- Get only the active sprint
local result = app.integrations.jira.list_sprints({
  board_id = 1,
  state = "active",
})

for _, sprint in ipairs(result.values) do
  print("Active sprint: " .. sprint.name)
end
```

### `app.integrations.jira.list_sprint_issues({ sprint_id, start_at, max_results })`

List issues in a specific Jira sprint.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sprint_id` | integer | yes | The sprint ID (from `list_sprints`) |
| `start_at` | integer | no | Pagination offset (0-based, default: `0`) |
| `max_results` | integer | no | Max results per page (1–100, default: `50`) |

```lua
local result = app.integrations.jira.list_sprint_issues({
  sprint_id = 12,
})

print("Total issues: " .. result.total)
for _, issue in ipairs(result.issues) do
  print(issue.key .. ": " .. issue.fields.summary .. " [" .. issue.fields.status.name .. "]")
end
```

```lua
-- Paginate through sprint issues
local result = app.integrations.jira.list_sprint_issues({
  sprint_id = 12,
  start_at = 0,
  max_results = 50,
})

print("Showing " .. #result.issues .. " of " .. result.total .. " issues")
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

```lua
local version = app.integrations.jira.create_version({
  project_key = "PROJ",
  name = "v2.0.0",
  description = "Major release with new authentication module",
  start_date = "2024-01-15",
  release_date = "2024-03-01",
})

print("Version ID: " .. version.id)
print("Name: " .. version.name)
print("Released: " .. tostring(version.released))
```

```lua
-- Create a simple version with just a name
local version = app.integrations.jira.create_version({
  project_key = "PROJ",
  name = "Backlog",
})

print("Created version: " .. version.name)
```

## Common Workflows

### Create, assign, and transition an issue

```lua
-- 1. Find the user to assign
local users = app.integrations.jira.search_users({
  query = "john@example.com",
})
local assignee_id = users[1].accountId

-- 2. Create the issue
local issue = app.integrations.jira.create_issue({
  project_key = "PROJ",
  summary = "Fix session timeout handling",
  issue_type = "Bug",
  description = "Users are being logged out unexpectedly after 5 minutes of inactivity.",
  priority = "High",
  assignee = assignee_id,
})

print("Created: " .. issue.key)

-- 3. Add a comment
app.integrations.jira.add_comment({
  issue_key = issue.key,
  body = "Investigating — looks related to the JWT refresh token logic.",
})

-- 4. Move to In Progress
local transitions = app.integrations.jira.get_transitions({
  issue_key = issue.key,
})

for _, t in ipairs(transitions.transitions) do
  if t.name == "In Progress" then
    app.integrations.jira.transition_issue({
      issue_key = issue.key,
      transition_id = t.id,
    })
    print("Moved to In Progress")
    break
  end
end
```

### Sprint report: list active sprint issues by status

```lua
-- 1. Find the board
local boards = app.integrations.jira.list_boards({})

-- 2. Find the active sprint on the first board
local sprints = app.integrations.jira.list_sprints({
  board_id = boards.values[1].id,
  state = "active",
})

local active_sprint = sprints.values[1]
print("Active sprint: " .. active_sprint.name)

-- 3. Get all issues in the sprint
local result = app.integrations.jira.list_sprint_issues({
  sprint_id = active_sprint.id,
})

-- 4. Group by status
local by_status = {}
for _, issue in ipairs(result.issues) do
  local status = issue.fields.status.name
  by_status[status] = (by_status[status] or 0) + 1
end

for status, count in pairs(by_status) do
  print("  " .. status .. ": " .. count)
end
```

### Search and triage bugs

```lua
-- Find all unassigned high-priority bugs
local results = app.integrations.jira.search_issues({
  jql = 'project = PROJ AND type = Bug AND priority = High AND assignee is EMPTY AND status = Open',
  max_results = 20,
})

print("Found " .. results.total .. " unassigned high-priority bugs")

for _, issue in ipairs(results.issues) do
  -- Find a developer to assign
  local users = app.integrations.jira.search_users({
    query = "developer",
    max_results = 1,
  })

  if #users > 0 then
    app.integrations.jira.assign_issue({
      issue_key = issue.key,
      account_id = users[1].accountId,
    })

    app.integrations.jira.add_comment({
      issue_key = issue.key,
      body = "Triaged and assigned to " .. users[1].displayName .. ".",
    })

    print(issue.key .. " → assigned to " .. users[1].displayName)
  end
end
```

### Create a version and search for fix issues

```lua
-- 1. Create a new release version
local version = app.integrations.jira.create_version({
  project_key = "PROJ",
  name = "v1.5.0",
  description = "Performance and stability release",
  release_date = "2024-06-30",
})

print("Created version: " .. version.name)

-- 2. Find all issues resolved recently
local results = app.integrations.jira.search_issues({
  jql = 'project = PROJ AND status = Done AND resolved >= -7d ORDER BY resolved DESC',
  fields = "summary,status,priority",
})

print("Issues resolved in the last 7 days:")
for _, issue in ipairs(results.issues) do
  print("  " .. issue.key .. ": " .. issue.fields.summary)
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

```lua
local result = app.integrations.jira.search_issues({
  jql = "project = PROJ",
  start_at = 0,
  max_results = 50,
})

result.total       -- total number of matching issues
result.start_at    -- current offset
result.max_results -- page size used
result.issues      -- array of issue objects on this page
```

To iterate through all pages:

```lua
local all_issues = {}
local start_at = 0
local max_results = 50

repeat
  local result = app.integrations.jira.search_issues({
    jql = "project = PROJ AND status = Open",
    start_at = start_at,
    max_results = max_results,
  })

  for _, issue in ipairs(result.issues) do
    table.insert(all_issues, issue)
  end

  start_at = start_at + max_results
until start_at >= result.total

print("Fetched " .. #all_issues .. " open issues")
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
