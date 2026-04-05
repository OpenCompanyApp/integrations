# Client for the Airtable REST API — Lua API Reference

## airtable_batch_create

Create up to 10 records in a single Airtable API request..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `records` | string | yes | JSON array of record objects, each with a  |

### Example

```lua
local result = app.integrations.airtable.airtable_batch_create({
  base_id = ""
  table = ""
  records = ""
})
```

## airtable_batch_delete

Delete up to 10 records in a single Airtable API request..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `record_ids` | string | yes | JSON array of record IDs to delete (e.g., [ |

### Example

```lua
local result = app.integrations.airtable.airtable_batch_delete({
  base_id = ""
  table = ""
  record_ids = ""
})
```

## airtable_batch_update

Update up to 10 records in a single Airtable API request..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `records` | string | yes | JSON array of record objects, each with  |

### Example

```lua
local result = app.integrations.airtable.airtable_batch_update({
  base_id = ""
  table = ""
  records = ""
})
```

## airtable_create_field

Create a new field in an Airtable table..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table_id` | string | yes | Table ID (e.g.,  |
| `name` | string | yes | Name for the new field. |
| `type` | string | yes | Airtable field type (e.g.,  |
| `description` | string | no | Optional description for the field. |
| `options` | string | no | JSON object of field-type-specific options (e.g., { |

### Example

```lua
local result = app.integrations.airtable.airtable_create_field({
  base_id = ""
  table_id = ""
  name = ""
})
```

## airtable_create_record

Create a new record in an Airtable table..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `fields` | string | yes | JSON object of field name → value pairs (e.g., { |

### Example

```lua
local result = app.integrations.airtable.airtable_create_record({
  base_id = ""
  table = ""
  fields = ""
})
```

## airtable_delete_record

Delete a record from an Airtable table..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `record_id` | string | yes | Record ID (e.g.,  |

### Example

```lua
local result = app.integrations.airtable.airtable_delete_record({
  base_id = ""
  table = ""
  record_id = ""
})
```

## airtable_get_base_schema

Get the tables and fields schema for an Airtable base..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |

### Example

```lua
local result = app.integrations.airtable.airtable_get_base_schema({
  base_id = ""
})
```

## airtable_get_record

Get a single Airtable record by ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `record_id` | string | yes | Record ID (e.g.,  |

### Example

```lua
local result = app.integrations.airtable.airtable_get_record({
  base_id = ""
  table = ""
  record_id = ""
})
```

## airtable_get_record_attachments

Get attachment URLs from a specific attachment field on a record..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `record_id` | string | yes | Record ID (e.g.,  |
| `field` | string | yes | Name of the attachment field to extract. |

### Example

```lua
local result = app.integrations.airtable.airtable_get_record_attachments({
  base_id = ""
  table = ""
  record_id = ""
})
```

## airtable_list_bases

List all Airtable bases the token has access to..

### Example

```lua
local result = app.integrations.airtable.airtable_list_bases({
})
```

## airtable_list_records

List records from an Airtable table with optional filtering, sorting, and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `view` | string | no | View name or ID to filter records by the view\ |
| `filter_by_formula` | string | no | Airtable formula expression to filter records (e.g.,  |
| `max_records` | integer | no | Maximum number of records to return. |
| `offset` | string | no | Pagination offset from a previous response. |
| `fields` | string | no | Comma-separated list of field names to return. |
| `sort` | string | no | JSON array of sort objects, e.g. [{ |

### Example

```lua
local result = app.integrations.airtable.airtable_list_records({
  base_id = ""
  table = ""
  view = ""
})
```

## airtable_list_views

List views for an Airtable base..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |

### Example

```lua
local result = app.integrations.airtable.airtable_list_views({
  base_id = ""
})
```

## airtable_search_records

Search records in an Airtable table using an Airtable formula expression..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `filter_by_formula` | string | yes | Airtable formula expression (e.g.,  |
| `max_records` | integer | no | Maximum number of records to return. |

### Example

```lua
local result = app.integrations.airtable.airtable_search_records({
  base_id = ""
  table = ""
  filter_by_formula = ""
})
```

## airtable_update_record

Update an existing Airtable record (partial update)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `record_id` | string | yes | Record ID (e.g.,  |
| `fields` | string | yes | JSON object of field name → value pairs to update. |

### Example

```lua
local result = app.integrations.airtable.airtable_update_record({
  base_id = ""
  table = ""
  record_id = ""
})
```

## airtable_upsert_record

Create or update a record based on field matching (upsert)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `base_id` | string | yes | Airtable base ID (e.g.,  |
| `table` | string | yes | Table ID or name. |
| `fields` | string | yes | JSON object of field name → value pairs. |
| `field_names_to_merge_on` | string | yes | Field name(s) to match existing records. Pass a single field name as a string, or a JSON array of field names for composite matching. |

### Example

```lua
local result = app.integrations.airtable.airtable_upsert_record({
  base_id = ""
  table = ""
  fields = ""
})
```
