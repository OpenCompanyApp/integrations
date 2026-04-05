# Snowflake — Lua API Reference

## execute_query

Execute a SQL statement on Snowflake. Returns column metadata and result rows.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sql` | string | yes | The SQL statement to execute |
| `warehouse` | string | no | Warehouse to use for the query |
| `database` | string | no | Database context for the query |
| `schema` | string | no | Schema context for the query |

### Examples

### Simple SELECT query

```lua
local result = app.integrations.snowflake.execute_query({
  sql = "SELECT CURRENT_TIMESTAMP(), CURRENT_DATABASE()"
})

for _, row in ipairs(result.rows) do
  print("Timestamp: " .. row[1])
end
```

### Query with context

```lua
local result = app.integrations.snowflake.execute_query({
  sql = "SELECT * FROM orders LIMIT 10",
  warehouse = "COMPUTE_WH",
  database = "SALES_DB",
  schema = "PUBLIC"
})

for _, row in ipairs(result.rows) do
  print(row.id .. ": " .. row.status)
end
```

### Aggregation query

```lua
local result = app.integrations.snowflake.execute_query({
  sql = "SELECT COUNT(*) as total, SUM(amount) as revenue FROM sales WHERE year = 2026",
  warehouse = "ANALYTICS_WH",
  database = "ANALYTICS"
})

for _, row in ipairs(result.rows) do
  print("Total: " .. row.total .. ", Revenue: " .. row.revenue)
end
```

---

## list_databases

List all databases in the Snowflake account.

### Parameters

None.

### Example

```lua
local result = app.integrations.snowflake.list_databases({})

for _, db in ipairs(result.data or {}) do
  print(db.name)
end
```

---

## get_database

Get details for a specific Snowflake database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name or identifier |

### Example

```lua
local result = app.integrations.snowflake.get_database({
  database = "ANALYTICS"
})

print("Database: " .. result.name)
print("Owner: " .. (result.owner or "unknown"))
```

---

## list_schemas

List all schemas within a Snowflake database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```lua
local result = app.integrations.snowflake.list_schemas({
  database = "ANALYTICS"
})

for _, schema in ipairs(result.data or {}) do
  print(schema.name)
end
```

---

## list_tables

List all tables within a Snowflake database schema.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `schema` | string | yes | The schema name |

### Example

```lua
local result = app.integrations.snowflake.list_tables({
  database = "ANALYTICS",
  schema = "PUBLIC"
})

for _, tbl in ipairs(result.data or {}) do
  print(tbl.name .. " (" .. (tbl.kind or "unknown") .. ")")
end
```

---

## describe_table

Get column definitions and metadata for a table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `schema` | string | yes | The schema name |
| `table` | string | yes | The table name |

### Example

```lua
local result = app.integrations.snowflake.describe_table({
  database = "ANALYTICS",
  schema = "PUBLIC",
  table = "orders"
})

for _, col in ipairs(result.columns or {}) do
  print(col.name .. " (" .. col.type .. ")")
end
```

---

## list_warehouses

List all warehouses in the Snowflake account.

### Parameters

None.

### Example

```lua
local result = app.integrations.snowflake.list_warehouses({})

for _, wh in ipairs(result.data or {}) do
  print(wh.name .. " — " .. (wh.size or "unknown") .. " — " .. (wh.state or "unknown"))
end
```

---

## get_warehouse

Get details for a specific Snowflake warehouse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The warehouse name |

### Example

```lua
local result = app.integrations.snowflake.get_warehouse({
  name = "COMPUTE_WH"
})

print("Warehouse: " .. result.name)
print("Size: " .. (result.size or "unknown"))
print("State: " .. (result.state or "unknown"))
print("Auto-suspend: " .. tostring(result.auto_suspend))
```

---

## get_current_user

Get the current authenticated Snowflake user and session information.

### Parameters

None.

### Example

```lua
local result = app.integrations.snowflake.get_current_user({})

print("User: " .. (result.userName or result.user or "unknown"))
print("Account: " .. (result.account or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Snowflake accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.snowflake.function_name({...})

-- Explicit default (portable across setups)
app.integrations.snowflake.default.function_name({...})

-- Named accounts
app.integrations.snowflake.production.function_name({...})
app.integrations.snowflake.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
