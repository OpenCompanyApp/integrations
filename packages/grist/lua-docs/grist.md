# Grist — Lua API Reference

Grist is a modern relational spreadsheet. Authenticate with an API key (found in your Grist profile settings under API Keys). Works with hosted Grist (docs.getgrist.com) or self-hosted instances.

## grist_list_workspaces

List all workspaces in a Grist organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | Grist organization ID |

```lua
local result = app.integrations.grist.list_workspaces({
  org_id = 1
})

for _, ws in ipairs(result.workspaces) do
  print(ws.name)
end
```

## grist_get_workspace

Get details for a single Grist workspace, including its documents.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | Grist workspace ID |

```lua
local result = app.integrations.grist.get_workspace({
  workspace_id = 42
})

print(result.name)
-- result.docs lists documents in this workspace
```

## grist_list_docs

List all documents in a Grist organization.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | Grist organization ID |

```lua
local result = app.integrations.grist.list_docs({
  org_id = 1
})

for _, doc in ipairs(result.docs) do
  print(doc.name)
end
```

## grist_get_doc

Get details for a single Grist document by ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |

```lua
local result = app.integrations.grist.get_doc({
  doc_id = "abc123XYZ"
})

print(result.name)
print(result.workspace?.name)
```

## grist_list_tables

List all tables in a Grist document.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |

```lua
local result = app.integrations.grist.list_tables({
  doc_id = "abc123XYZ"
})

for _, t in ipairs(result.tables) do
  print(t.id)
end
```

## grist_get_table

Get a single table from a Grist document.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```lua
local result = app.integrations.grist.get_table({
  doc_id = "abc123XYZ",
  table_id = "Table1"
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

```lua
local result = app.integrations.grist.list_records({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  limit = 50,
  sort = "-CreatedAt",
  filter = '{"Status": ["Active"]}'
})

for _, rec in ipairs(result.records) do
  print(rec.id, rec.fields.Name)
end
```

## grist_create_records

Create one or more records in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `records` | string | yes | JSON array of record objects, each with a `"fields"` key |

```lua
local result = app.integrations.grist.create_records({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  records = '[{"fields": {"Name": "Alice", "Age": 30}}, {"fields": {"Name": "Bob", "Age": 25}}]'
})

-- result.records contains the created records with their IDs
```

## grist_update_records

Update one or more existing records in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `records` | string | yes | JSON array of record updates, each with `"id"` and `"fields"` keys |

```lua
local result = app.integrations.grist.update_records({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  records = '[{"id": 1, "fields": {"Name": "Alice Updated"}}]'
})
```

## grist_delete_records

Delete records from a Grist table by row IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |
| `record_ids` | string | yes | JSON array of row IDs to delete |

```lua
local result = app.integrations.grist.delete_records({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  record_ids = "[1, 2, 3]"
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

```lua
local result = app.integrations.grist.create_column({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  col_id = "Email",
  label = "Email Address",
  type = "Text"
})
```

### Formula column example

```lua
local result = app.integrations.grist.create_column({
  doc_id = "abc123XYZ",
  table_id = "Table1",
  col_id = "FullName",
  label = "Full Name",
  type = "Any",
  formula = "$FirstName & \" \" & $LastName"
})
```

## grist_list_columns

List all columns in a Grist table.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```lua
local result = app.integrations.grist.list_columns({
  doc_id = "abc123XYZ",
  table_id = "Table1"
})

for _, col in ipairs(result.columns) do
  print(col.id, col.fields.label, col.fields.type)
end
```

## grist_get_record

Get full column data for a Grist table — raw cell values per column (not record-oriented).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `doc_id` | string | yes | Grist document ID |
| `table_id` | string | yes | Grist table ID |

```lua
local result = app.integrations.grist.get_record({
  doc_id = "abc123XYZ",
  table_id = "Table1"
})

-- Returns column-oriented data: column names as keys, arrays of values
```

## Examples

### List all workspaces, then tables in a document

```lua
local ws = app.integrations.grist.list_workspaces({ org_id = 1 })

for _, workspace in ipairs(ws.workspaces) do
  print("Workspace: " .. workspace.name)

  if workspace.docs then
    for _, doc in ipairs(workspace.docs) do
      local tables = app.integrations.grist.list_tables({ doc_id = doc.id })
      for _, t in ipairs(tables.tables) do
        print("  Table: " .. t.id)
      end
    end
  end
end
```

### Query records with a filter

```lua
local result = app.integrations.grist.list_records({
  doc_id = "abc123XYZ",
  table_id = "Orders",
  filter = '{"Status": ["Shipped"]}',
  sort = "-OrderDate",
  limit = 25
})

for _, rec in ipairs(result.records) do
  print(rec.id, rec.fields.OrderDate, rec.fields.Total)
end
```

### Create and then update a record

```lua
-- Create
local created = app.integrations.grist.create_records({
  doc_id = "abc123XYZ",
  table_id = "Contacts",
  records = '[{"fields": {"Name": "Jane Doe", "Email": "jane@example.com"}}]'
})

local newId = created.records[1].id

-- Update
app.integrations.grist.update_records({
  doc_id = "abc123XYZ",
  table_id = "Contacts",
  records = '[{"id": ' .. newId .. ', "fields": {"Email": "jane.doe@example.com"}}]'
})
```

---

## Multi-Account Usage

If you have multiple grist accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.grist.function_name({...})

-- Explicit default (portable across setups)
app.integrations.grist.default.function_name({...})

-- Named accounts
app.integrations.grist.work.function_name({...})
app.integrations.grist.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
