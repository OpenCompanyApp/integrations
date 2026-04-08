# Rollbar — Lua API Reference

## list_projects

List all projects in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of projects to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.rollbar.list_projects({
  limit = 50,
  offset = 0
})

for _, project in ipairs(result.result.projects) do
  print(project.id .. ": " .. project.name .. " (status: " .. project.status .. ")")
end
```

---

## get_project

Get details for a specific Rollbar project by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The project ID |

### Example

```lua
local result = app.integrations.rollbar.get_project({
  id = 12345
})

local project = result.result
print("Project: " .. project.name)
print("Status: " .. project.status)
```

---

## list_items

List error items (occurrences) in Rollbar with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | integer | no | Filter by project ID |
| `limit` | integer | no | Maximum number of items to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `level` | string | no | Filter by level: `debug`, `info`, `warning`, `error`, `critical` |
| `status` | string | no | Filter by status: `active`, `resolved`, `muted` |
| `environment` | string | no | Filter by environment name (e.g., `production`, `staging`) |

### Example

```lua
-- List active errors in production
local result = app.integrations.rollbar.list_items({
  status = "active",
  environment = "production",
  level = "error",
  limit = 10
})

for _, item in ipairs(result.result.items) do
  print(item.counter .. ": " .. item.title .. " (level: " .. item.level .. ")")
end
```

---

## get_item

Get details for a specific Rollbar error item by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The item (counter) ID |

### Example

```lua
local result = app.integrations.rollbar.get_item({
  id = 47
})

local item = result.result
print("Title: " .. item.title)
print("Level: " .. item.level)
print("Status: " .. item.status)
print("Occurrences: " .. item.total_occurrences)
```

---

## list_deploys

List recent deploys across your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `environment` | string | no | Filter by environment name (e.g., `production`) |
| `limit` | integer | no | Maximum number of deploys to return (default: 20) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.rollbar.list_deploys({
  environment = "production",
  limit = 10,
  page = 1
})

for _, deploy in ipairs(result.result.deploys) do
  print(deploy.project_id .. ": " .. deploy.revision .. " by " .. deploy.username)
end
```

---

## list_teams

List all teams in your Rollbar account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of teams to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.rollbar.list_teams({
  limit = 50
})

for _, team in ipairs(result.result.teams) do
  print(team.id .. ": " .. team.name .. " (access: " .. team.access_level .. ")")
end
```

---

## get_current_user

Get details about the currently authenticated Rollbar user. No parameters required.

### Example

```lua
local result = app.integrations.rollbar.get_current_user({})

local user = result.result
print("User: " .. user.username .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Rollbar accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.rollbar.list_projects({})

-- Explicit default (portable across setups)
app.integrations.rollbar.default.list_projects({})

-- Named accounts
app.integrations.rollbar.work.list_projects({})
app.integrations.rollbar.personal.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
