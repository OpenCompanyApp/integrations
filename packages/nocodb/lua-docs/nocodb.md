# NocoDB — Lua API Reference

## nocodb_list_records

List records from a NocoDB table with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `view_id` | string | no | View ID to filter records by the view's filters. |
| `limit` | integer | no | Maximum number of records to return (default 25). |
| `offset` | integer | no | Pagination offset for skipping records. |
| `where` | string | no | NocoDB where clause for filtering (e.g., `"(Status,eq,Done)"`). |
| `sort` | string | no | JSON array of sort objects, e.g. `[{"field":"Name","direction":"asc"}]`. |
| `fields` | string | no | Comma-separated list of field names to return. |

## nocodb_get_record

Get a single NocoDB record by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `record_id` | string | yes | Record ID. |
| `fields` | string | no | Comma-separated list of field names to return. |

## nocodb_create_record

Create a new record in a NocoDB table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `data` | string | yes | JSON object of field name → value pairs (e.g., `{"Name":"John","Age":30}`). |

## nocodb_update_record

Update an existing NocoDB record.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `record_id` | string | yes | Record ID. |
| `data` | string | yes | JSON object of field name → value pairs to update (e.g., `{"Status":"Done"}`). |

## nocodb_delete_record

Delete a record from a NocoDB table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `record_id` | string | yes | Record ID. |

## nocodb_batch_create

Create multiple records in a single NocoDB API request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `records` | string | yes | JSON array of record objects (e.g., `[{"Name":"Alice"},{"Name":"Bob"}]`). |

## nocodb_batch_update

Update multiple records in a single NocoDB API request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `records` | string | yes | JSON array of record objects, each with an `"Id"` key and fields to update (e.g., `[{"Id":1,"Name":"Updated"}]`). |

## nocodb_batch_delete

Delete multiple records in a single NocoDB API request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `record_ids` | string | yes | JSON array of record IDs to delete (e.g., `[1, 2, 3]`). |

## nocodb_list_bases

List all NocoDB bases the token has access to.

### Parameters

*No parameters required.*

## nocodb_get_base

Get details of a single NocoDB base.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Base ID. |

## nocodb_list_tables

List all tables in a NocoDB base.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Base ID. |

## nocodb_get_table

Get details of a single NocoDB table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |

## nocodb_create_table

Create a new table in a NocoDB base.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Base ID. |
| `table_name` | string | yes | Name for the new table. |
| `columns` | string | yes | JSON array of column definitions (e.g., `[{"column_name":"Name","uidt":"SingleLineText"},{"column_name":"Age","uidt":"Number"}]`). |

## nocodb_list_views

List views for a NocoDB table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |

## nocodb_count_records

Count records in a NocoDB table with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | string | yes | Table ID. |
| `where` | string | no | NocoDB where clause for filtering (e.g., `"(Status,eq,Done)"`). |

## Examples

### List records with filtering

```lua
local result = app.integrations.nocodb.nocodb_list_records({
  table_id = "tbxyz123",
  where = "(Status,eq,Active)",
  sort = '[{"field":"Name","direction":"asc"}]',
  limit = 10
})
for _, record in ipairs(result.records) do
  print(record.Name .. " - " .. record.Status)
end
```

### Create a record

```lua
local result = app.integrations.nocodb.nocodb_create_record({
  table_id = "tbxyz123",
  data = '{"Name":"John","Email":"john@example.com","Status":"Active"}'
})
print("Created record ID: " .. result.Id)
```

### Batch create records

```lua
local result = app.integrations.nocodb.nocodb_batch_create({
  table_id = "tbxyz123",
  records = '[{"Name":"Alice"},{"Name":"Bob"},{"Name":"Charlie"}]'
})
```

---

## Multi-Account Usage

If you have multiple nocodb accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.nocodb.function_name({...})

-- Explicit default (portable across setups)
app.integrations.nocodb.default.function_name({...})

-- Named accounts
app.integrations.nocodb.work.function_name({...})
app.integrations.nocodb.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
