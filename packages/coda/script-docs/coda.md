# Coda — Ruby API Reference

## coda_list_docs

List Coda docs accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter docs by name. |
| `isOwner` | boolean | no | If true, only return docs owned by the user. |
| `limit` | integer | no | Maximum number of docs to return (default: 20, max: 100). |

### Example

```ruby
result = app.integrations.coda.list_docs(query: "project", limit: 10)
result.items.each do |doc|
  puts((doc.name).to_s + " — " + (doc.id).to_s)
end
```
---

## coda_get_doc

Get details of a specific Coda doc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | The ID of the doc. |

### Example

```ruby
doc = app.integrations.coda.get_doc(doc_id: "abc123")
puts((doc.name).to_s + " — " + (doc.owner).to_s + " — " + (doc.ownerName).to_s)
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

```ruby
result = app.integrations.coda.list_tables(doc_id: "abc123", limit: 50)
result.items.each do |table|
  puts((table.name).to_s + " — " + (table.id).to_s + " (type: " + (table.displayColumn).to_s + ")")
end
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

```ruby
table = app.integrations.coda.get_table(doc_id: "abc123", table_id: "grid-MyTable")
puts((table.name).to_s + " — columns: " + (table.columnCount).to_s)
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

```ruby
result = app.integrations.coda.list_rows(doc_id: "abc123", table_id: "grid-MyTable", limit: 50, use_column_names: true)
result.items.each do |row|
  puts((row.name).to_s + ": " + (row.values["Status"]).to_s)
end
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

```ruby
row = app.integrations.coda.get_row(doc_id: "abc123", table_id: "grid-MyTable", row_id: "i-row123")
puts(row.name)
row.values.to_a.each do |col, val|
  puts("  " + (col).to_s + " = " + ((val).to_s).to_s)
end
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

```ruby
result = app.integrations.coda.insert_rows(doc_id: "abc123", table_id: "grid-MyTable", rows: [{cells: [{column: "Name", value: "Alice"}, {column: "Email", value: "alice@example.com"}, {column: "Status", value: "Active"}]}, {cells: [{column: "Name", value: "Bob"}, {column: "Email", value: "bob@example.com"}, {column: "Status", value: "Pending"}]}])
puts("Request ID: " + (result.requestId).to_s)
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

```ruby
result = app.integrations.coda.update_row(doc_id: "abc123", table_id: "grid-MyTable", row_id: "i-row123", cells: [{column: "Status", value: "Completed"}, {column: "Completed At", value: "2026-04-05"}])
puts("Request ID: " + (result.requestId).to_s)
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

```ruby
result = app.integrations.coda.delete_row(doc_id: "abc123", table_id: "grid-MyTable", row_id: "i-row123")
puts(result)
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

```ruby
result = app.integrations.coda.list_columns(doc_id: "abc123", table_id: "grid-MyTable")
result.items.each do |col|
  puts((col.name).to_s + " (" + (col.type).to_s + ") — " + (col.id).to_s)
end
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

```ruby
result = app.integrations.coda.list_pages(doc_id: "abc123", limit: 50)
result.items.each do |page|
  puts((page.name).to_s + " — " + (page.id).to_s)
end
```
---

## coda_get_current_user

Verify authentication and get current user info.

### Parameters

None.

### Example

```ruby
user = app.integrations.coda.get_current_user()
puts("Connected as: " + (user.name).to_s + " (" + (user.loginId).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Coda accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.coda.list_docs()
# Explicit default (portable across setups)
app.integrations.coda.default.list_docs()
# Named accounts
app.integrations.coda.work.list_docs()
app.integrations.coda.personal.list_docs()
```
All functions are identical across accounts — only the credentials differ.
