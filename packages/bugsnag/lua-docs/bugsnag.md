# Bugsnag — Lua API Reference

## bugsnag_list_projects

List Bugsnag projects visible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of projects to return (default: 30) |
| `offset` | integer | no | Number of projects to skip for pagination (default: 0) |
| `q` | string | no | Search query to filter projects by name |

### Example

```lua
local result = app.integrations.bugsnag.list_projects({
  limit = 10
})

for _, project in ipairs(result) do
  print(project.name .. " (ID: " .. project.id .. ")")
end
```

---

## bugsnag_get_project

Get details for a single Bugsnag project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The project ID |

### Example

```lua
local result = app.integrations.bugsnag.get_project({
  id = "abc123"
})

print("Project: " .. result.name)
print("Type: " .. result.type)
```

---

## bugsnag_list_errors

List errors for a Bugsnag project. Supports filtering by severity and status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID to list errors for |
| `limit` | integer | no | Maximum number of errors to return (default: 30) |
| `offset` | integer | no | Number of errors to skip for pagination (default: 0) |
| `severity` | string | no | Filter by severity: `"error"`, `"warning"`, or `"info"` |
| `status` | string | no | Filter by status: `"open"`, `"fixed"`, or `"snoozed"` |
| `sort` | string | no | Sort order: `"created_at"`, `"updated_at"`, or `"unhandled_occurrence_count"` |

### Example

```lua
local result = app.integrations.bugsnag.list_errors({
  project_id = "abc123",
  severity = "error",
  status = "open",
  sort = "unhandled_occurrence_count",
  limit = 10
})

for _, err in ipairs(result) do
  print(err.message .. " — " .. err.severity .. " (" .. err.unhandled_occurrence_count .. " unhandled)")
end
```

---

## bugsnag_get_error

Get details for a specific Bugsnag error.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The error ID |

### Example

```lua
local result = app.integrations.bugsnag.get_error({
  id = "err456"
})

print("Error: " .. result.message)
print("Severity: " .. result.severity)
print("Status: " .. result.status)
print("First seen: " .. result.first_seen)
print("Last seen: " .. result.last_seen)
```

---

## bugsnag_list_events

List events (individual error occurrences) for a Bugsnag project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID to list events for |
| `limit` | integer | no | Maximum number of events to return (default: 30) |
| `offset` | integer | no | Number of events to skip for pagination (default: 0) |
| `error_id` | string | no | Filter events to a specific error by its ID |

### Example

```lua
local result = app.integrations.bugsnag.list_events({
  project_id = "abc123",
  error_id = "err456",
  limit = 5
})

for _, event in ipairs(result) do
  print(event.received_at .. " — " .. event.exceptions[1].error_class)
end
```

---

## bugsnag_list_collaborators

List collaborators (team members) for a Bugsnag organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization ID |
| `limit` | integer | no | Maximum number of collaborators to return (default: 30) |
| `offset` | integer | no | Number of collaborators to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.bugsnag.list_collaborators({
  org_id = "org789"
})

for _, collab in ipairs(result) do
  print(collab.name .. " <" .. collab.email .. "> — " .. collab.role)
end
```

---

## bugsnag_get_current_user

Get the currently authenticated Bugsnag user.

### Parameters

None.

### Example

```lua
local result = app.integrations.bugsnag.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Bugsnag accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bugsnag.list_projects({})

-- Explicit default (portable across setups)
app.integrations.bugsnag.default.list_projects({})

-- Named accounts
app.integrations.bugsnag.work.list_projects({})
app.integrations.bugsnag.personal.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
