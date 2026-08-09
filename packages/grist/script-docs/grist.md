# Grist — JavaScript API Reference

Grist is a modern relational spreadsheet. Authenticate with an API key (found in your Grist profile settings under API Keys). Works with hosted Grist (docs.getgrist.com) or self-hosted instances.

## grist_list_workspaces

List all workspaces in a Grist organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | Grist organization ID |

```js
var result = app.integrations.grist.list_workspaces({
  org_id: 1,
})

for (const ws of (result.workspaces)) {
  console.log(ws.name)
}
```
## grist_get_workspace

Get details for a single Grist workspace, including its documents.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | Grist workspace ID |

```js
var result = app.integrations.grist.get_workspace({
  workspace_id: 42,
})

console.log(result.name)
// result.docs lists documents in this workspace
```
## grist_list_docs

List all documents in a Grist organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | Grist organization ID |

```js
var result = app.integrations.grist.list_docs({
  org_id: 1,
})

for (const doc of (result.docs)) {
  console.log(doc.name)
}
```
## grist_get_doc

Get details for a single Grist document by ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |

```js
var result = app.integrations.grist.get_doc({
  doc_id: "abc123XYZ",
})

console.log(result.name)
console.log(result.workspace?.name)
```
## grist_list_tables

List all tables in a Grist document.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |

```js
var result = app.integrations.grist.list_tables({
  doc_id: "abc123XYZ",
})

for (const t of (result.tables)) {
  console.log(t.id)
}
```
## grist_get_table

Get a single table from a Grist document.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```js
var result = app.integrations.grist.get_table({
  doc_id: "abc123XYZ",
  table_id: "Table1",
})
```
## grist_list_records

List records from a Grist table with optional filtering, sorting, and limiting.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `limit` | integer | no | Maximum number of records to return |
| `sort` | string | no | Sort expression, e.g. `"Col1"` (ascending) or `"-Col1"` (descending) |
| `filter` | string | no | JSON object for column filtering, e.g. `'{"Col1": ["val1", "val2"]}'` |

```js
var result = app.integrations.grist.list_records({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  limit: 50,
  sort: "-CreatedAt",
  filter: '{"Status": ["Active"]}',
})

for (const rec of (result.records)) {
  console.log(rec.id, rec.fields.Name)
}
```
## grist_create_records

Create one or more records in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `records` | string | yes | JSON array of record objects, each with a `"fields"` key |

```js
var result = app.integrations.grist.create_records({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  records: '[{"fields": {"Name": "Alice", "Age": 30}}, {"fields": {"Name": "Bob", "Age": 25}}]',
})

// result.records contains the created records with their IDs
```
## grist_update_records

Update one or more existing records in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `records` | string | yes | JSON array of record updates, each with `"id"` and `"fields"` keys |

```js
var result = app.integrations.grist.update_records({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  records: '[{"id": 1, "fields": {"Name": "Alice Updated"}}]',
})
```
## grist_delete_records

Delete records from a Grist table by row IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `record_ids` | string | yes | JSON array of row IDs to delete |

```js
var result = app.integrations.grist.delete_records({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  record_ids: "[1, 2, 3]",
})
```
## grist_create_column

Create a new column in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `col_id` | string | yes | Column identifier (field key, e.g. `"FirstName"`) |
| `label` | string | yes | Human-readable column label |
| `type` | string | yes | Grist column type: `"Text"`, `"Int"`, `"Numeric"`, `"Bool"`, `"Date"`, `"Choice"`, `"Ref"`, `"Any"` |
| `formula` | string | no | Optional formula (e.g. `"$A + $B"`) |

```js
var result = app.integrations.grist.create_column({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  col_id: "Email",
  label: "Email Address",
  type: "Text",
})
```
### Formula column example

```js
var result = app.integrations.grist.create_column({
  doc_id: "abc123XYZ",
  table_id: "Table1",
  col_id: "FullName",
  label: "Full Name",
  type: "Any",
  formula: "$FirstName & \" \" & $LastName",
})
```
## grist_list_columns

List all columns in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```js
var result = app.integrations.grist.list_columns({
  doc_id: "abc123XYZ",
  table_id: "Table1",
})

for (const col of (result.columns)) {
  console.log(col.id, col.fields.label, col.fields.type)
}
```
## grist_get_record

Get full column data for a Grist table — raw cell values per column (not record-oriented).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```js
var result = app.integrations.grist.get_record({
  doc_id: "abc123XYZ",
  table_id: "Table1",
})

// Returns column-oriented data: column names as keys, arrays of values
```
## Examples

### List all workspaces, then tables in a document

```js
var ws = app.integrations.grist.list_workspaces({ org_id: 1 })

for (const workspace of (ws.workspaces)) {
  console.log("Workspace: " + workspace.name)

  if (workspace.docs) {
    for (const doc of (workspace.docs)) {
      var tables = app.integrations.grist.list_tables({ doc_id: doc.id })
      for (const t of (tables.tables)) {
        console.log("  Table: " + t.id)
      }
    }
  }
}
```
### Query records with a filter

```js
var result = app.integrations.grist.list_records({
  doc_id: "abc123XYZ",
  table_id: "Orders",
  filter: '{"Status": ["Shipped"]}',
  sort: "-OrderDate",
  limit: 25,
})

for (const rec of (result.records)) {
  console.log(rec.id, rec.fields.OrderDate, rec.fields.Total)
}
```
### Create and then update a record

```js
// Create
var created = app.integrations.grist.create_records({
  doc_id: "abc123XYZ",
  table_id: "Contacts",
  records: '[{"fields": {"Name": "Jane Doe", "Email": "jane@example.com"}}]',
})

var newId = created.records[0].id

// Update
app.integrations.grist.update_records({
  doc_id: "abc123XYZ",
  table_id: "Contacts",
  records: '[{"id": ' + newId + ', "fields": {"Email": "jane.doe@example.com"}}]',
})
```
---

## Multi-Account Usage

If you have multiple grist accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.grist.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.grist.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.grist.work.function_name({ /* parameters */ })
app.integrations.grist.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
