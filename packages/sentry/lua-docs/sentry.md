# Sentry — Lua API Reference

## list_projects

List all Sentry projects accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Filter projects by name or slug |

### Example

```lua
local result = app.integrations.sentry.list_projects({})

for _, project in ipairs(result) do
  print(project.slug .. " (" .. project.organization.slug .. ") - " .. (project.platform or "unknown"))
end
```

---

## get_project

Get detailed information about a specific Sentry project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_slug` | string | yes | The organization slug (e.g., `"my-org"`) |
| `project_slug` | string | yes | The project slug (e.g., `"my-project"`) |

### Example

```lua
local result = app.integrations.sentry.get_project({
  org_slug = "my-org",
  project_slug = "my-project"
})

print("Project: " .. result.name)
print("Platform: " .. (result.platform or "unknown"))
```

---

## list_issues

List issues (errors) for a specific Sentry project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_slug` | string | yes | The organization slug |
| `project_slug` | string | yes | The project slug |
| `query` | string | no | Search query (e.g., `"is:unresolved level:error"`) |
| `sort` | string | no | Sort order: `"date"`, `"freq"`, `"new"`, `"priority"` |
| `limit` | integer | no | Max results (default: 25, max: 100) |

### Query Syntax

Common query filters:

- `is:unresolved` — only unresolved issues
- `is:resolved` — only resolved issues
- `level:error` — error-level issues
- `level:fatal` — fatal-level issues
- `assigned:me` — issues assigned to current user
- `first_seen:-24h` — issues first seen in last 24 hours

Multiple filters can be combined: `is:unresolved level:error`

### Example

```lua
local result = app.integrations.sentry.list_issues({
  org_slug = "my-org",
  project_slug = "my-project",
  query = "is:unresolved level:error",
  sort = "freq",
  limit = 10
})

for _, issue in ipairs(result) do
  print(issue.shortId .. ": " .. issue.title .. " (" .. issue.count .. " events)")
end
```

---

## get_issue

Get detailed information about a specific Sentry issue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `issue_id` | string | yes | The Sentry issue ID |

### Example

```lua
local result = app.integrations.sentry.get_issue({
  issue_id = "1234567890"
})

print("Title: " .. result.title)
print("Culprit: " .. result.culprit)
print("Level: " .. result.level)
print("Status: " .. result.status)
print("Events: " .. result.count)
print("Users affected: " .. result.userCount)
```

---

## list_releases

List releases for a specific Sentry project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_slug` | string | yes | The organization slug |
| `project_slug` | string | yes | The project slug |
| `limit` | integer | no | Max results (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.sentry.list_releases({
  org_slug = "my-org",
  project_slug = "my-project",
  limit = 5
})

for _, release in ipairs(result) do
  print(release.version .. " — " .. (release.dateReleased or "not released"))
end
```

---

## create_issue

Create a new issue (user report or crash report) in a Sentry project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_slug` | string | yes | The organization slug |
| `project_slug` | string | yes | The project slug |
| `title` | string | yes | Short description of the issue |
| `message` | string | no | Full error message or stacktrace |
| `level` | string | no | Severity: `"fatal"`, `"error"`, `"warning"`, `"info"`, `"debug"` |
| `tags` | object | no | Key-value tags (e.g., `{environment = "production"}`) |
| `extra` | object | no | Additional context data as key-value pairs |

### Example

```lua
local result = app.integrations.sentry.create_issue({
  org_slug = "my-org",
  project_slug = "my-project",
  title = "NullPointerException in UserController",
  message = "java.lang.NullPointerException\n  at UserController.java:42\n  at Router.dispatch(Router.java:15)",
  level = "error",
  tags = {
    environment = "production",
    version = "2.1.0"
  }
})

print("Created issue: " .. result.id)
```

---

## get_current_user

Get the currently authenticated Sentry user.

### Parameters

None.

### Example

```lua
local result = app.integrations.sentry.get_current_user({})

print("Name: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Sentry accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.sentry.list_projects({})

-- Explicit default (portable across setups)
app.integrations.sentry.default.list_projects({})

-- Named accounts
app.integrations.sentry.work.list_issues({org_slug = "work-org", project_slug = "api"})
app.integrations.sentry.personal.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
