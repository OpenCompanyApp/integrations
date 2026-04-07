# PlanetScale — Lua API Reference

## list_databases

List databases in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.planetscale.list_databases({
  organization = "my-org",
  page = 1,
  limit = 10
})

for _, db in ipairs(result.data) do
  print(db.name .. ": " .. db.state)
end
```

---

## get_database

Get details of a specific PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |

### Example

```lua
local result = app.integrations.planetscale.get_database({
  organization = "my-org",
  database = "my-database"
})

print("State: " .. result.state)
print("Region: " .. result.region.slug)
print("Branches: " .. result.branches)
```

---

## create_database

Create a new database in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `name` | string | yes | The database name (lowercase, hyphens allowed) |
| `region` | string | no | The region slug (e.g., "us-east-1") |
| `notes` | string | no | Optional notes about the database |

### Example

```lua
local result = app.integrations.planetscale.create_database({
  organization = "my-org",
  name = "my-new-database",
  region = "us-east-1",
  notes = "Production database for project X"
})

print("Created: " .. result.name)
print("State: " .. result.state)
```

---

## list_branches

List branches of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.planetscale.list_branches({
  organization = "my-org",
  database = "my-database"
})

for _, branch in ipairs(result.data) do
  print(branch.name .. " (" .. branch.role .. ")")
end
```

---

## get_branch

Get details of a specific branch of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `branch` | string | yes | The branch name |

### Example

```lua
local result = app.integrations.planetscale.get_branch({
  organization = "my-org",
  database = "my-database",
  branch = "main"
})

print("Role: " .. result.role)
print("Ready: " .. tostring(result.ready))
print("Region: " .. result.region.slug)
```

---

## list_organizations

List organizations the authenticated user belongs to.

### Parameters

None.

### Example

```lua
local result = app.integrations.planetscale.list_organizations({})

for _, org in ipairs(result.data) do
  print(org.name .. " (" .. org.slug .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.planetscale.get_current_user({})
print("User: " .. (result.first_name or "") .. " " .. (result.last_name or ""))
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple PlanetScale accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.planetscale.function_name({...})

-- Explicit default (portable across setups)
app.integrations.planetscale.default.function_name({...})

-- Named accounts
app.integrations.planetscale.production.function_name({...})
app.integrations.planetscale.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
