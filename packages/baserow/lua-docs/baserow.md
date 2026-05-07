# Baserow Lua API Reference

Namespace: `app.integrations.baserow`

Baserow tools operate on database IDs, table IDs, field IDs, and row IDs from the Baserow REST API. Database tokens normally use `Authorization: Token ...`; account-level endpoints may require a host-provided JWT or Bearer token.

## Discovery

Use `list_databases`, `list_all_tables`, `list_database_tables`, `get_table`, and `list_fields` to find the schema before reading or writing rows.

```lua
local databases = app.integrations.baserow.list_databases({ page = 1, size = 100 })
local tables = app.integrations.baserow.list_database_tables({ database_id = 123 })
local fields = app.integrations.baserow.list_fields({ table_id = 456 })
```

`list_all_tables` returns the tables visible to the configured database token and is useful when the agent only has a database token scope.

## Rows

Use `list_rows` for new row-listing work. The older `list_tables` tool is kept only as a compatibility alias and also lists rows.

```lua
local rows = app.integrations.baserow.list_rows({
  table_id = 456,
  search = "Acme",
  order_by = "-id",
  filters = {
    { field = 789, type = "equal", value = "Active" }
  }
})

local row = app.integrations.baserow.get_row({
  table_id = 456,
  row_id = 1
})
```

Row outputs are the normalized JSON returned by Baserow. When `user_field_names` or field-name mode is used by the upstream endpoint, field names appear directly in the row object; otherwise Baserow may return field IDs such as `field_789`.

## Row Writes

```lua
local created = app.integrations.baserow.create_row({
  table_id = 456,
  data = {
    Name = "Acme",
    Status = "Active"
  }
})

local updated = app.integrations.baserow.update_row({
  table_id = 456,
  row_id = 1,
  data = {
    Status = "Inactive"
  }
})

app.integrations.baserow.move_row({
  table_id = 456,
  row_id = 1,
  before_id = 2
})

app.integrations.baserow.delete_row({
  table_id = 456,
  row_id = 1
})
```

## Batch Rows

Batch payloads use Baserow's `items` wrapper internally. You can pass a JSON array or Lua array of row objects.

```lua
local result = app.integrations.baserow.batch_create({
  table_id = 456,
  records = {
    { Name = "Acme" },
    { Name = "Globex" }
  }
})

app.integrations.baserow.batch_update({
  table_id = 456,
  records = {
    { id = 1, Status = "Active" },
    { id = 2, Status = "Inactive" }
  }
})

app.integrations.baserow.batch_delete({
  table_id = 456,
  row_ids = { 1, 2 }
})
```

## Fields

Field mutation endpoints require credentials with schema permissions.

```lua
local field = app.integrations.baserow.create_field({
  table_id = 456,
  payload = {
    name = "Status",
    type = "single_select"
  }
})

app.integrations.baserow.update_field({
  field_id = field.id,
  payload = { name = "Lifecycle status" }
})
```

## Raw API Helpers

Use `api_get`, `api_post`, `api_patch`, and `api_delete` only for relative paths inside the configured Baserow API host. Full URLs and parent-directory paths are rejected.

```lua
local response = app.integrations.baserow.api_get({
  path = "/api/database/fields/table/456/",
  query = { include = { "id", "name" } }
})
```

## Multi-Account

If multiple Baserow accounts are configured, use the generated account namespace:

```lua
app.integrations.baserow.production.list_rows({ table_id = 456 })
app.integrations.baserow.staging.list_rows({ table_id = 456 })
```
