# MySQL — Lua API Reference

## query

Execute a raw SQL query on the MySQL database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sql` | string | yes | The SQL query to execute |

### Examples

#### Simple SELECT query

```lua
local result = app.integrations.mysql.query({
  sql = "SELECT * FROM users WHERE active = 1 LIMIT 10"
})

for _, row in ipairs(result.rows) do
  print(row.name .. " <" .. row.email .. ">")
end
```

#### Aggregation query

```lua
local result = app.integrations.mysql.query({
  sql = "SELECT country, COUNT(*) as total FROM users GROUP BY country ORDER BY total DESC LIMIT 5"
})
```

#### JOIN query

```lua
local result = app.integrations.mysql.query({
  sql = "SELECT o.id, u.name, o.total FROM orders o JOIN users u ON o.user_id = u.id WHERE o.status = 'pending'"
})
```

---

## list_databases

List all databases accessible to the authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.mysql.list_databases({})

for _, db in ipairs(result.databases) do
  print(db)
end
```

---

## list_tables

List all tables in a database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```lua
local result = app.integrations.mysql.list_tables({
  database = "my_app"
})

for _, tbl in ipairs(result.tables) do
  print(tbl.name)
end
```

---

## describe_table

Get the column structure of a table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `table` | string | yes | The table name |

### Example

```lua
local result = app.integrations.mysql.describe_table({
  database = "my_app",
  table = "users"
})

for _, col in ipairs(result.columns) do
  print(col.field .. " (" .. col.type .. ")" .. (col.null == "YES" and " NULL" or " NOT NULL"))
end
```

---

## insert

Insert a row into a table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `table` | string | yes | The table name |
| `data` | object | yes | Column-value pairs to insert |

### Example

```lua
local result = app.integrations.mysql.insert({
  database = "my_app",
  table = "users",
  data = {
    name = "Alice",
    email = "alice@example.com",
    active = true
  }
})

print("Inserted row ID: " .. result.insert_id)
```

---

## update

Update rows matching a filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `table` | string | yes | The table name |
| `filter` | object | yes | Column-value pairs to match rows |
| `data` | object | yes | Column-value pairs to update |

### Example

```lua
local result = app.integrations.mysql.update({
  database = "my_app",
  table = "users",
  filter = { id = 42 },
  data = { name = "Bob", status = "active" }
})

print("Rows affected: " .. result.affected_rows)
```

---

## delete

Delete rows matching a filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `table` | string | yes | The table name |
| `filter` | object | yes | Column-value pairs to match rows |

### Example

```lua
local result = app.integrations.mysql.delete({
  database = "my_app",
  table = "sessions",
  filter = { expired = true }
})

print("Rows deleted: " .. result.affected_rows)
```

---

## get_current_user

Get the currently authenticated database user. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.mysql.get_current_user({})

print("Connected as: " .. result.user)
```

---

## Multi-Account Usage

If you have multiple MySQL connections configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mysql.query({ sql = "SELECT 1" })

-- Explicit default (portable across setups)
app.integrations.mysql.default.query({ sql = "SELECT 1" })

-- Named accounts
app.integrations.mysql.production.query({ sql = "SELECT * FROM users LIMIT 5" })
app.integrations.mysql.staging.query({ sql = "SELECT * FROM users LIMIT 5" })
```

All functions are identical across accounts — only the credentials differ.
