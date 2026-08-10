# Coda — JavaScript API Reference

## coda_list_docs

List Coda docs accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter docs by name. |
| `isOwner` | boolean | no | If true, only return docs owned by the user. |
| `limit` | integer | no | Maximum number of docs to return (default: 20, max: 100). |

### Example

```js
var result = app.integrations.coda.list_docs({
  query: "project",
  limit: 10,
})

for (const doc of (result.items)) {
  console.log(doc.name + " — " + doc.id)
}
```
---

## coda_get_doc

Get details of a specific Coda doc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |

### Example

```js
var doc = app.integrations.coda.get_doc({
  doc_id: "abc123",
})
console.log(doc.name + " — " + doc.owner + " — " + doc.ownerName)
```
---

## coda_list_tables

List tables in a Coda doc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `limit` | integer | no | Maximum number of tables to return (default: 20, max: 100). |

### Example

```js
var result = app.integrations.coda.list_tables({
  doc_id: "abc123",
  limit: 50,
})

for (const table of (result.items)) {
  console.log(table.name + " — " + table.id + " (type: " + table.displayColumn + ")")
}
```
---

## coda_get_table

Get details of a specific table in a Coda doc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |

### Example

```js
var table = app.integrations.coda.get_table({
  doc_id: "abc123",
  table_id: "grid-MyTable",
})
console.log(table.name + " — columns: " + table.columnCount)
```
---

## coda_list_rows

List rows in a Coda table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `limit` | integer | no | Maximum number of rows to return (default: 20, max: 1000). |
| `useColumnNames` | boolean | no | Return values keyed by column names instead of column IDs (default: true). |

### Example

```js
var result = app.integrations.coda.list_rows({
  doc_id: "abc123",
  table_id: "grid-MyTable",
  limit: 50,
  useColumnNames: true,
})

for (const row of (result.items)) {
  console.log(row.name + ": " + row.values["Status"])
}
```
---

## coda_get_row

Get a single row from a Coda table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `row_id` | string | yes | The ID of the row. |
| `useColumnNames` | boolean | no | Return values keyed by column names (default: true). |

### Example

```js
var row = app.integrations.coda.get_row({
  doc_id: "abc123",
  table_id: "grid-MyTable",
  row_id: "i-row123",
})
console.log(row.name)
for (const [col, val] of Object.entries(row.values)) {
  console.log("  " + col + " = " + String(val))
}
```
---

## coda_insert_rows

Insert one or more rows into a Coda table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `rows` | array | yes | Array of row objects. Each row: `{cells = {column = "col-name", value = "the-value"}}`. |

### Example

```js
var result = app.integrations.coda.insert_rows({
  doc_id: "abc123",
  table_id: "grid-MyTable",
  rows: [
    {
      cells: [
        {column: "Name", value: "Alice"},
        {column: "Email", value: "alice@example.com"},
        {column: "Status", value: "Active"}
      ]
    },
    {
      cells: [
        {column: "Name", value: "Bob"},
        {column: "Email", value: "bob@example.com"},
        {column: "Status", value: "Pending"}
      ]
    }
  ]
})
console.log("Request ID: " + result.requestId)
```
---

## coda_update_row

Update cells in an existing row.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `row_id` | string | yes | The ID of the row to update. |
| `cells` | array | yes | Array of cell objects: `{column = "col-name", value = "new-value"}`. |

### Example

```js
var result = app.integrations.coda.update_row({
  doc_id: "abc123",
  table_id: "grid-MyTable",
  row_id: "i-row123",
  cells: [
    {column: "Status", value: "Completed"},
    {column: "Completed At", value: "2026-04-05"}
  ]
})
console.log("Request ID: " + result.requestId)
```
---

## coda_delete_row

Delete a row from a Coda table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `row_id` | string | yes | The ID of the row to delete. |

### Example

```js
var result = app.integrations.coda.delete_row({
  doc_id: "abc123",
  table_id: "grid-MyTable",
  row_id: "i-row123",
})
console.log(result)
```
---

## coda_list_columns

List columns in a Coda table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `table_id` | string | yes | The ID or name of the table. |
| `limit` | integer | no | Maximum number of columns to return (default: 20, max: 100). |

### Example

```js
var result = app.integrations.coda.list_columns({
  doc_id: "abc123",
  table_id: "grid-MyTable",
})

for (const col of (result.items)) {
  console.log(col.name + " (" + col.type + ") — " + col.id)
}
```
---

## coda_list_pages

List pages in a Coda doc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |
| `limit` | integer | no | Maximum number of pages to return (default: 20, max: 100). |

### Example

```js
var result = app.integrations.coda.list_pages({
  doc_id: "abc123",
  limit: 50,
})

for (const page of (result.items)) {
  console.log(page.name + " — " + page.id)
}
```
---

## coda_get_current_user

Verify authentication and get current user info.

### Parameters

None.

### Example

```js
var user = app.integrations.coda.get_current_user({})
console.log("Connected as: " + user.name + " (" + user.loginId + ")")
```
---

## Multi-Account Usage

If you have multiple Coda accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.coda.list_docs({})

// Explicit default (portable across setups)
app.integrations.coda.default.list_docs({})

// Named accounts
app.integrations.coda.work.list_docs({})
app.integrations.coda.personal.list_docs({})
```
All functions are identical across accounts — only the credentials differ.
