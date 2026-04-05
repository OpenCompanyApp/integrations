# HTTP client for the Baserow API — Lua API Reference

## baserow_batch_create

Create multiple rows in a Baserow table in a single request..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `records` | string | yes | JSON array of row objects, e.g. [{ |

### Example

```lua
local result = app.integrations.baserow.baserow_batch_create({
  table_id = 0
  records = ""
})
```

## baserow_batch_delete

Delete multiple rows from a Baserow table in a single request..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `row_ids` | string | yes |  |

### Example

```lua
local result = app.integrations.baserow.baserow_batch_delete({
  table_id = 0
  row_ids = ""
})
```

## baserow_batch_update

Update multiple rows in a Baserow table in a single request. Each row must include its.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `records` | string | yes | JSON array of row objects to update. Each must include an  |

### Example

```lua
local result = app.integrations.baserow.baserow_batch_update({
  table_id = 0
  records = ""
})
```

## baserow_create_row

Create a new row in a Baserow table with the provided field values..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `data` | string | yes | JSON object of field values, e.g. { |
| `before` | integer | no | If provided, the new row will be positioned before this row ID. |

### Example

```lua
local result = app.integrations.baserow.baserow_create_row({
  table_id = 0
  data = ""
  before = 0
})
```

## baserow_delete_row

Delete a single row from a Baserow table by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `row_id` | integer | yes | The row ID to delete. |

### Example

```lua
local result = app.integrations.baserow.baserow_delete_row({
  table_id = 0
  row_id = 0
})
```

## baserow_get_row

Get a single Baserow row by its table and row ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `row_id` | integer | yes | The row ID to retrieve. |

### Example

```lua
local result = app.integrations.baserow.baserow_get_row({
  table_id = 0
  row_id = 0
})
```

## baserow_get_table

Get details for a single Baserow table by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |

### Example

```lua
local result = app.integrations.baserow.baserow_get_table({
  table_id = 0
})
```

## baserow_list_databases

List all Baserow databases (applications) accessible to the current token..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter by application type, e.g.  |

### Example

```lua
local result = app.integrations.baserow.baserow_list_databases({
  type = ""
})
```

## baserow_list_fields

List all fields (columns) and their types in a Baserow table..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |

### Example

```lua
local result = app.integrations.baserow.baserow_list_fields({
  table_id = 0
})
```

## baserow_list_rows

List rows in a Baserow table with optional filtering, searching, sorting, and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `limit` | integer | no | Maximum number of rows to return (default: 100). |
| `offset` | integer | no | Number of rows to skip for pagination. |
| `search` | string | no | Search term to filter rows by. |
| `order_by` | string | no | Field name to order by. Prefix with  |
| `filter_type` | string | no | How to combine filters:  |
| `filters` | string | no | JSON array of filter objects, e.g. [{ |
| `field_ids` | string | no | Comma-separated list of field IDs to include in the response. |

### Example

```lua
local result = app.integrations.baserow.baserow_list_rows({
  table_id = 0
  limit = 0
  offset = 0
})
```

## baserow_list_tables

List all tables in a Baserow database (application)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | integer | yes | The Baserow database (application) ID. |

### Example

```lua
local result = app.integrations.baserow.baserow_list_tables({
  database_id = 0
})
```

## baserow_update_row

Update an existing row in a Baserow table with the provided field values..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID. |
| `row_id` | integer | yes | The row ID to update. |
| `data` | string | yes | JSON object of field values to update, e.g. { |

### Example

```lua
local result = app.integrations.baserow.baserow_update_row({
  table_id = 0
  row_id = 0
  data = ""
})
```

---

## Multi-Account Usage

If you have multiple baserow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.baserow.function_name({...})

-- Explicit default (portable across setups)
app.integrations.baserow.default.function_name({...})

-- Named accounts
app.integrations.baserow.work.function_name({...})
app.integrations.baserow.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
