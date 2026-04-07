# Neon — Lua API Reference

## list_projects

List all Neon projects in the organization.

### Parameters

None.

### Example

```lua
local result = app.integrations.neon.list_projects({})

for _, project in ipairs(result.projects) do
  print(project.name .. " (" .. project.region_id .. ")")
end
```

---

## get_project

Get details for a specific Neon project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID |

### Example

```lua
local result = app.integrations.neon.get_project({ project_id = "proj-abc123" })
local p = result.project
print(p.name .. " - " .. p.region_id .. " - " .. p.pg_version)
```

---

## create_project

Create a new Neon project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Project name (e.g., `"my-app-prod"`) |
| `region_id` | string | no | Region (e.g., `"aws-us-east-2"`, `"aws-eu-west-1"`) |
| `pg_version` | integer | no | Postgres version (e.g., `16`) |
| `branch_name` | string | no | Name for the initial branch (default: `"main"`) |
| `database_name` | string | no | Name for the initial database (default: `"neondb"`) |

### Common Regions

- **AWS US East**: `aws-us-east-2`
- **AWS US West**: `aws-us-west-2`
- **AWS EU West**: `aws-eu-west-1`
- **AWS EU Central**: `aws-eu-central-1`
- **AWS AP Southeast**: `aws-ap-southeast-1`

### Example

```lua
local result = app.integrations.neon.create_project({
  name = "my-app-prod",
  region_id = "aws-us-east-2",
  pg_version = 16
})

print("Created project: " .. result.project.id)
```

---

## list_branches

List all branches in a Neon project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID |

### Example

```lua
local result = app.integrations.neon.list_branches({ project_id = "proj-abc123" })

for _, branch in ipairs(result.branches) do
  print(branch.name .. " - " .. branch.status)
end
```

---

## get_branch

Get details for a specific branch in a Neon project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID |
| `branch_id` | string | yes | The branch ID |

### Example

```lua
local result = app.integrations.neon.get_branch({
  project_id = "proj-abc123",
  branch_id = "br-xyz789"
})

print(result.branch.name .. " - primary: " .. tostring(result.branch.primary))
```

---

## list_databases

List all databases in a Neon project branch.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID |
| `branch_id` | string | yes | The branch ID |

### Example

```lua
local result = app.integrations.neon.list_databases({
  project_id = "proj-abc123",
  branch_id = "br-xyz789"
})

for _, db in ipairs(result.databases) do
  print(db.name .. " - owner: " .. db.owner_name)
end
```

---

## get_current_user

Get the current authenticated Neon user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.neon.get_current_user({})
print("User: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple Neon accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.neon.list_projects({})

-- Explicit default (portable across setups)
app.integrations.neon.default.list_projects({})

-- Named accounts
app.integrations.neon.production.list_projects({})
app.integrations.neon.staging.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
