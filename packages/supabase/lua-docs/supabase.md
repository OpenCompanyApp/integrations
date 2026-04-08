# Supabase — Lua API Reference

## list_projects

List all Supabase projects in the organization.

### Parameters

None.

### Example

```lua
local result = app.integrations.supabase.list_projects({})

for _, project in ipairs(result) do
  print(project.id .. ": " .. project.name .. " (" .. project.region .. ")")
end
```

---

## get_project

Get details of a specific Supabase project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_ref` | string | yes | The project reference ID |

### Example

```lua
local result = app.integrations.supabase.get_project({
  project_ref = "my_project_ref"
})

print("Project: " .. result.name)
print("Region: " .. result.region)
print("Status: " .. result.status)
```

---

## list_tables

List all tables in a Supabase project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_ref` | string | yes | The project reference ID |

### Example

```lua
local result = app.integrations.supabase.list_tables({
  project_ref = "my_project_ref"
})

for _, table in ipairs(result) do
  print(table.id .. ": " .. table.name)
end
```

---

## get_table

Get details of a specific table in a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_ref` | string | yes | The project reference ID |
| `table_id` | string | yes | The table ID |

### Example

```lua
local result = app.integrations.supabase.get_table({
  project_ref = "my_project_ref",
  table_id = "my_table_id"
})

print("Table: " .. result.name)
```

---

## list_rows

List rows in a Supabase table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_ref` | string | yes | The project reference ID |
| `table_name` | string | yes | The table name or ID |
| `limit` | integer | no | Maximum number of rows to return (default: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `select` | string | no | Comma-separated list of columns to select |
| `order` | string | no | Column to order by, with optional direction (e.g. `"id.desc"`) |

### Example

```lua
local result = app.integrations.supabase.list_rows({
  project_ref = "my_project_ref",
  table_name = "users",
  limit = 10,
  order = "created_at.desc"
})

for _, row in ipairs(result) do
  print(row.id .. ": " .. (row.name or "unnamed"))
end
```

---

## get_row

Get a single row by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_ref` | string | yes | The project reference ID |
| `table_name` | string | yes | The table name or ID |
| `row_id` | string | yes | The row ID |

### Example

```lua
local result = app.integrations.supabase.get_row({
  project_ref = "my_project_ref",
  table_name = "users",
  row_id = "my_row_id"
})

for key, value in pairs(result) do
  print("  " .. key .. " = " .. tostring(value))
end
```

---

## get_current_user

Get the currently authenticated Supabase user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.supabase.get_current_user({})

print("User: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Supabase accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.supabase.list_projects({})

-- Explicit default (portable across setups)
app.integrations.supabase.default.list_projects({})

-- Named accounts
app.integrations.supabase.production.list_projects({})
app.integrations.supabase.staging.list_projects({})
```

All functions are identical across accounts — only the credentials differ.
