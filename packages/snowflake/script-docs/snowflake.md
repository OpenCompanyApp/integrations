# Snowflake — Ruby API Reference

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

```ruby
result = app.integrations.snowflake.execute_query(sql: "SELECT CURRENT_TIMESTAMP(), CURRENT_DATABASE()")
result.rows.each do |row|
  puts("Timestamp: " + (row[0]).to_s)
end
```
### Query with context

```ruby
result = app.integrations.snowflake.execute_query(sql: "SELECT * FROM orders LIMIT 10", warehouse: "COMPUTE_WH", database: "SALES_DB", schema: "PUBLIC")
result.rows.each do |row|
  puts((row.id).to_s + ": " + (row.status).to_s)
end
```
### Aggregation query

```ruby
result = app.integrations.snowflake.execute_query(sql: "SELECT COUNT(*) as total, SUM(amount) as revenue FROM sales WHERE year = 2026", warehouse: "ANALYTICS_WH", database: "ANALYTICS")
result.rows.each do |row|
  puts("Total: " + (row.total).to_s + ", Revenue: " + (row.revenue).to_s)
end
```
---

## list_databases

List all databases in the Snowflake account.

### Parameters

None.

### Example

```ruby
result = app.integrations.snowflake.list_databases()
(result.data || []).each do |db|
  puts(db.name)
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

```ruby
result = app.integrations.snowflake.get_database(database: "ANALYTICS")
puts("Database: " + (result.name).to_s)
puts("Owner: " + ((result.owner || "unknown")).to_s)
```
---

## list_schemas

List all schemas within a Snowflake database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```ruby
result = app.integrations.snowflake.list_schemas(database: "ANALYTICS")
(result.data || []).each do |schema|
  puts(schema.name)
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

```ruby
result = app.integrations.snowflake.list_tables(database: "ANALYTICS", schema: "PUBLIC")
(result.data || []).each do |tbl|
  puts((tbl.name).to_s + " (" + ((tbl.kind || "unknown")).to_s + ")")
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

```ruby
result = app.integrations.snowflake.describe_table(database: "ANALYTICS", schema: "PUBLIC", table: "orders")
(result.columns || []).each do |col|
  puts((col.name).to_s + " (" + (col.type).to_s + ")")
end
```
---

## list_warehouses

List all warehouses in the Snowflake account.

### Parameters

None.

### Example

```ruby
result = app.integrations.snowflake.list_warehouses()
(result.data || []).each do |wh|
  puts((wh.name).to_s + " — " + ((wh.size || "unknown")).to_s + " — " + ((wh.state || "unknown")).to_s)
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

```ruby
result = app.integrations.snowflake.get_warehouse(name: "COMPUTE_WH")
puts("Warehouse: " + (result.name).to_s)
puts("Size: " + ((result.size || "unknown")).to_s)
puts("State: " + ((result.state || "unknown")).to_s)
puts("Auto-suspend: " + ((result.auto_suspend).to_s).to_s)
```
---

## get_current_user

Get the current authenticated Snowflake user and session information.

### Parameters

None.

### Example

```ruby
result = app.integrations.snowflake.get_current_user()
puts("User: " + (((result.userName || result.user) || "unknown")).to_s)
puts("Account: " + ((result.account || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Snowflake accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
