# MySQL — Ruby API Reference

## query

Execute a raw SQL query on the MySQL database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sql` | string | yes | The SQL query to execute |

### Examples

#### Simple SELECT query

```ruby
result = app.integrations.mysql.query(sql: "SELECT * FROM users WHERE active = 1 LIMIT 10")
result.rows.each do |row|
  puts((row.name).to_s + " <" + (row.email).to_s + ">")
end
```
#### Aggregation query

```ruby
result = app.integrations.mysql.query(sql: "SELECT country, COUNT(*) as total FROM users GROUP BY country ORDER BY total DESC LIMIT 5")
```
#### JOIN query

```ruby
result = app.integrations.mysql.query(sql: "SELECT o.id, u.name, o.total FROM orders o JOIN users u ON o.user_id = u.id WHERE o.status = 'pending'")
```
---

## list_databases

List all databases accessible to the authenticated user.

### Parameters

None.

### Example

```ruby
result = app.integrations.mysql.list_databases()
result.databases.each do |db|
  puts(db)
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

```ruby
result = app.integrations.mysql.list_tables(database: "my_app")
result.tables.each do |tbl|
  puts(tbl.name)
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

```ruby
result = app.integrations.mysql.describe_table(database: "my_app", table: "users")
result.columns.each do |col|
  puts((col.field).to_s + " (" + (col.type).to_s + ")" + ((((col.null == "YES") && " NULL") || " NOT NULL")).to_s)
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

```ruby
result = app.integrations.mysql.insert_row(database: "my_app", table: "users", data: {name: "Alice", email: "alice@example.com", active: true})
puts("Inserted row ID: " + (result.insert_id).to_s)
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

```ruby
result = app.integrations.mysql.update_rows(database: "my_app", table: "users", filter: {id: 42}, data: {name: "Bob", status: "active"})
puts("Rows affected: " + (result.affected_rows).to_s)
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

```ruby
result = app.integrations.mysql.delete_rows(database: "my_app", table: "sessions", filter: {expired: true})
puts("Rows deleted: " + (result.affected_rows).to_s)
```
---

## get_current_user

Get the currently authenticated database user. Useful for verifying credentials.

### Parameters

None.

### Example

```ruby
result = app.integrations.mysql.current_user()
puts("Connected as: " + (result.user).to_s)
```
---

## Multi-Account Usage

If you have multiple MySQL connections configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.mysql.query(sql: "SELECT 1")
# Explicit default (portable across setups)
app.integrations.mysql.default.query(sql: "SELECT 1")
# Named accounts
app.integrations.mysql.production.query(sql: "SELECT * FROM users LIMIT 5")
app.integrations.mysql.staging.query(sql: "SELECT * FROM users LIMIT 5")
```
All functions are identical across accounts — only the credentials differ.
