# Supabase — Lua API Reference

All tools are accessed via `app.integrations.supabase.{tool_key}({params})`.

---

## supabase_list_rows

List rows from a Supabase table. Supports column selection, filtering, ordering, and pagination. Filters use PostgREST syntax (e.g., `"eq.value"`, `"like.*pattern*"`).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `select` | string | no | Comma-separated column names (default `"*"`) |
| `filter` | string | no | JSON object of PostgREST filter params, e.g. `{"status": "eq.active"}` |
| `order` | string | no | Order clause, e.g. `"created_at.desc.nullsfirst"` |
| `limit` | integer | no | Maximum number of rows to return |
| `offset` | integer | no | Number of rows to skip |
| `count` | string | no | Count mode: `"exact"` or `"planned"` |

### Example

```lua
local result = app.integrations.supabase.supabase_list_rows({
  table = "users",
  select = "id, name, email",
  filter = '{"status": "eq.active"}',
  order = "created_at.desc",
  limit = 10
})

for _, row in ipairs(result) do
  print(row.id .. ": " .. row.name .. " <" .. row.email .. ">")
end
```

---

## supabase_get_row

Retrieve a single row from a Supabase table by its primary key id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `id` | string | yes | Primary key value of the row |
| `select` | string | no | Comma-separated column names (default `"*"`) |

### Example

```lua
local row = app.integrations.supabase.supabase_get_row({
  table = "users",
  id = "42",
  select = "id, name, email"
})

print(row.name)
```

---

## supabase_insert_row

Insert a single row into a Supabase table. Provide column values as a JSON object. Optionally enable upsert mode to merge duplicates on conflict.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `data` | string | yes | JSON object of column name → value pairs |
| `returning` | string | no | Return mode: `"representation"` (default) or `"minimal"` |
| `upsert` | boolean | no | Set to `true` to merge duplicates on conflict |

### Example

```lua
local result = app.integrations.supabase.supabase_insert_row({
  table = "users",
  data = '{"name": "Alice", "email": "alice@example.com", "status": "active"}'
})

print(result.id)
```

---

## supabase_update_row

Update an existing row in a Supabase table by its primary key id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `id` | string | yes | Primary key value of the row to update |
| `data` | string | yes | JSON object of column name → value pairs to update |
| `returning` | string | no | Return mode: `"representation"` (default) or `"minimal"` |

### Example

```lua
local result = app.integrations.supabase.supabase_update_row({
  table = "users",
  id = "42",
  data = '{"status": "inactive", "updated_at": "2026-04-05T10:00:00Z"}'
})

print(result.status)
```

---

## supabase_delete_row

Delete a row from a Supabase table by its primary key id.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `id` | string | yes | Primary key value of the row to delete |
| `returning` | string | no | Return mode: `"representation"` (default) or `"minimal"` |

### Example

```lua
local result = app.integrations.supabase.supabase_delete_row({
  table = "users",
  id = "42"
})

print("Row deleted")
```

---

## supabase_insert_batch

Insert multiple rows into a Supabase table in a single batch request. Optionally enable upsert mode to merge duplicates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `records` | string | yes | JSON array of row objects, each containing column name → value pairs |
| `returning` | string | no | Return mode: `"representation"` (default) or `"minimal"` |
| `upsert` | boolean | no | Set to `true` to merge duplicates on conflict |

### Example

```lua
local result = app.integrations.supabase.supabase_insert_batch({
  table = "users",
  records = '[{"name": "Alice", "email": "alice@example.com"}, {"name": "Bob", "email": "bob@example.com"}]'
})

for _, row in ipairs(result) do
  print(row.id .. ": " .. row.name)
end
```

---

## supabase_upsert_row

Upsert a row into a Supabase table. If a row with the same unique key exists, it will be merged (updated); otherwise a new row is inserted.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `data` | string | yes | JSON object of column name → value pairs |
| `on_conflict` | string | no | Comma-separated column names that define the unique constraint (e.g. `"email,id"`) |
| `returning` | string | no | Return mode: `"representation"` (default) or `"minimal"` |

### Example

```lua
local result = app.integrations.supabase.supabase_upsert_row({
  table = "users",
  data = '{"email": "alice@example.com", "name": "Alice Updated", "status": "active"}',
  on_conflict = "email"
})

print(result.name)
```

---

## supabase_rpc

Call a remote procedure (RPC function) defined in the Supabase database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `function_name` | string | yes | Name of the RPC function to call |
| `params` | string | no | JSON object of parameters to pass to the function |

### Example

```lua
local result = app.integrations.supabase.supabase_rpc({
  function_name = "get_user_stats",
  params = '{"user_id": "42"}'
})

print(result.total_orders)
```

---

## supabase_query_sql

Execute a raw SQL query on the Supabase database via the `exec_sql` RPC function. Requires the `exec_sql` function to be defined in the Supabase database. Use for advanced queries that cannot be expressed through standard PostgREST filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | SQL query string to execute |

### Example

```lua
local result = app.integrations.supabase.supabase_query_sql({
  query = "SELECT id, name FROM users WHERE status = 'active' ORDER BY created_at DESC LIMIT 5"
})

for _, row in ipairs(result) do
  print(row.id .. ": " .. row.name)
end
```

---

## supabase_list_tables

List available tables in the Supabase database by querying the PostgREST OpenAPI spec endpoint. Returns table names with their column definitions.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.supabase.supabase_list_tables()

print("Found " .. result.count .. " tables:")
for _, tbl in ipairs(result.tables) do
  print("  " .. tbl.name)
end
```

---

## supabase_count_rows

Count rows in a Supabase table, optionally filtered. Uses PostgREST `count=exact` with a `select=count` query. Filters use PostgREST syntax.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name |
| `filter` | string | no | JSON object of PostgREST filter params, e.g. `{"status": "eq.active"}` |

### Example

```lua
local result = app.integrations.supabase.supabase_count_rows({
  table = "users",
  filter = '{"status": "eq.active"}'
})

print("Active users: " .. result.count)
```

---

## supabase_get_current_user

Get the current authenticated user from the Supabase Auth API. Requires a valid service_role key or a valid user JWT token. Returns user details including id, email, and metadata.

### Parameters

This tool takes no parameters.

### Example

```lua
local user = app.integrations.supabase.supabase_get_current_user()

print("User ID: " .. user.id)
print("Email: " .. user.email)
```
