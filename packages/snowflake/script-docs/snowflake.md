# Snowflake — JavaScript API Reference

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

```js
var result = app.integrations.snowflake.execute_query({
  sql: "SELECT CURRENT_TIMESTAMP(), CURRENT_DATABASE()",
})

for (const row of (result.rows)) {
  console.log("Timestamp: " + row[0])
}
```
### Query with context

```js
var result = app.integrations.snowflake.execute_query({
  sql: "SELECT * FROM orders LIMIT 10",
  warehouse: "COMPUTE_WH",
  database: "SALES_DB",
  schema: "PUBLIC",
})

for (const row of (result.rows)) {
  console.log(row.id + ": " + row.status)
}
```
### Aggregation query

```js
var result = app.integrations.snowflake.execute_query({
  sql: "SELECT COUNT(*) as total, SUM(amount) as revenue FROM sales WHERE year = 2026",
  warehouse: "ANALYTICS_WH",
  database: "ANALYTICS",
})

for (const row of (result.rows)) {
  console.log("Total: " + row.total + ", Revenue: " + row.revenue)
}
```
---

## list_databases

List all databases in the Snowflake account.

### Parameters

None.

### Example

```js
var result = app.integrations.snowflake.list_databases({})

for (const db of (result.data || [])) {
  console.log(db.name)
}
```
---

## get_database

Get details for a specific Snowflake database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name or identifier |

### Example

```js
var result = app.integrations.snowflake.get_database({
  database: "ANALYTICS",
})

console.log("Database: " + result.name)
console.log("Owner: " + (result.owner || "unknown"))
```
---

## list_schemas

List all schemas within a Snowflake database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```js
var result = app.integrations.snowflake.list_schemas({
  database: "ANALYTICS",
})

for (const schema of (result.data || [])) {
  console.log(schema.name)
}
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

```js
var result = app.integrations.snowflake.list_tables({
  database: "ANALYTICS",
  schema: "PUBLIC",
})

for (const tbl of (result.data || [])) {
  console.log(tbl.name + " (" + (tbl.kind || "unknown") + ")")
}
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

```js
var result = app.integrations.snowflake.describe_table({
  database: "ANALYTICS",
  schema: "PUBLIC",
  table: "orders",
})

for (const col of (result.columns || [])) {
  console.log(col.name + " (" + col.type + ")")
}
```
---

## list_warehouses

List all warehouses in the Snowflake account.

### Parameters

None.

### Example

```js
var result = app.integrations.snowflake.list_warehouses({})

for (const wh of (result.data || [])) {
  console.log(wh.name + " — " + (wh.size || "unknown") + " — " + (wh.state || "unknown"))
}
```
---

## get_warehouse

Get details for a specific Snowflake warehouse.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The warehouse name |

### Example

```js
var result = app.integrations.snowflake.get_warehouse({
  name: "COMPUTE_WH",
})

console.log("Warehouse: " + result.name)
console.log("Size: " + (result.size || "unknown"))
console.log("State: " + (result.state || "unknown"))
console.log("Auto-suspend: " + String(result.auto_suspend))
```
---

## get_current_user

Get the current authenticated Snowflake user and session information.

### Parameters

None.

### Example

```js
var result = app.integrations.snowflake.get_current_user({})

console.log("User: " + (result.userName || result.user || "unknown"))
console.log("Account: " + (result.account || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Snowflake accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.snowflake.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.snowflake.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.snowflake.production.function_name({ /* parameters */ })
app.integrations.snowflake.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
