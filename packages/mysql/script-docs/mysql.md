# MySQL — JavaScript API Reference

## query

Execute a raw SQL query on the MySQL database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sql` | string | yes | The SQL query to execute |

### Examples

#### Simple SELECT query

```js
var result = app.integrations.mysql.query({
  sql: "SELECT * FROM users WHERE active = 1 LIMIT 10",
})

for (const row of (result.rows)) {
  console.log(row.name + " <" + row.email + ">")
}
```
#### Aggregation query

```js
var result = app.integrations.mysql.query({
  sql: "SELECT country, COUNT(*) as total FROM users GROUP BY country ORDER BY total DESC LIMIT 5",
})
```
#### JOIN query

```js
var result = app.integrations.mysql.query({
  sql: "SELECT o.id, u.name, o.total FROM orders o JOIN users u ON o.user_id = u.id WHERE o.status = 'pending'",
})
```
---

## list_databases

List all databases accessible to the authenticated user.

### Parameters

None.

### Example

```js
var result = app.integrations.mysql.list_databases({})

for (const db of (result.databases)) {
  console.log(db)
}
```
---

## list_tables

List all tables in a database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```js
var result = app.integrations.mysql.list_tables({
  database: "my_app",
})

for (const tbl of (result.tables)) {
  console.log(tbl.name)
}
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

```js
var result = app.integrations.mysql.describe_table({
  database: "my_app",
  table: "users",
})

for (const col of (result.columns)) {
  console.log(col.field + " (" + col.type + ")" + (col.null === "YES" && " NULL" || " NOT NULL"))
}
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

```js
var result = app.integrations.mysql.insert({
  database: "my_app",
  table: "users",
  data: {
    name: "Alice",
    email: "alice@example.com",
    active: true,
  }
})

console.log("Inserted row ID: " + result.insert_id)
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

```js
var result = app.integrations.mysql.update({
  database: "my_app",
  table: "users",
  filter: { id: 42 },
  data: { name: "Bob", status: "active" },
})

console.log("Rows affected: " + result.affected_rows)
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

```js
var result = app.integrations.mysql.delete({
  database: "my_app",
  table: "sessions",
  filter: { expired: true },
})

console.log("Rows deleted: " + result.affected_rows)
```
---

## get_current_user

Get the currently authenticated database user. Useful for verifying credentials.

### Parameters

None.

### Example

```js
var result = app.integrations.mysql.get_current_user({})

console.log("Connected as: " + result.user)
```
---

## Multi-Account Usage

If you have multiple MySQL connections configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mysql.query({ sql: "SELECT 1" })

// Explicit default (portable across setups)
app.integrations.mysql.default.query({ sql: "SELECT 1" })

// Named accounts
app.integrations.mysql.production.query({ sql: "SELECT * FROM users LIMIT 5" })
app.integrations.mysql.staging.query({ sql: "SELECT * FROM users LIMIT 5" })
```
All functions are identical across accounts — only the credentials differ.
