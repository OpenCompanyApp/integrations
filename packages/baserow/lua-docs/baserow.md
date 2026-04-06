# Baserow — Lua API Reference

## list_tables

List rows in a Baserow database table with pagination and optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID to list rows from |
| `page` | integer | no | Page number (1-based). Defaults to 1. |
| `size` | integer | no | Number of rows per page. Defaults to 100. |
| `filters` | object | no | Optional Baserow filter parameters |

### Filter Parameters

Filters are passed as a key-value object. Common filter keys:

| Key | Description |
|-----|-------------|
| `search` | Full-text search across all fields |
| `filter__field_{id}__equal` | Field equals value |
| `filter__field_{id}__contains` | Field contains value |
| `filter__field_{id}__contains_not` | Field does not contain value |
| `filter__field_{id}__higher_than` | Field value is higher than |
| `filter__field_{id}__lower_than` | Field value is lower than |
| `filter__field_{id}__empty` | Field is empty (set to "true") |
| `filter__field_{id}__not_empty` | Field is not empty (set to "true") |
| `filter_type` | `"AND"` (default) or `"OR"` for combining filters |

### Examples

```lua
-- List first page of rows from table 42
local result = app.integrations.baserow.list_tables({
  table_id = 42
})

-- Paginated results
local result = app.integrations.baserow.list_tables({
  table_id = 42,
  page = 2,
  size = 50
})

-- Search rows
local result = app.integrations.baserow.list_tables({
  table_id = 42,
  filters = { search = "John" }
})

-- Filter by specific field value
local result = app.integrations.baserow.list_tables({
  table_id = 42,
  filters = {
    filter__field_123__equal = "Active"
  }
})
```

---

## get_row

Get a single row from a Baserow database table by its row ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID |
| `row_id` | integer | yes | The ID of the row to retrieve |

### Example

```lua
local row = app.integrations.baserow.get_row({
  table_id = 42,
  row_id = 1
})

print(row.id, row.Name, row.Email)
```

---

## create_row

Create a new row in a Baserow database table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID |
| `data` | object | yes | Row data with field names as keys |

### Example

```lua
local row = app.integrations.baserow.create_row({
  table_id = 42,
  data = {
    Name = "John Doe",
    Email = "john@example.com",
    Status = "Active",
    Notes = "New customer"
  }
})

print("Created row with ID: " .. row.id)
```

---

## update_row

Update fields of an existing row in a Baserow database table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID |
| `row_id` | integer | yes | The ID of the row to update |
| `data` | object | yes | Updated field data (only specified fields are changed) |

### Example

```lua
local row = app.integrations.baserow.update_row({
  table_id = 42,
  row_id = 1,
  data = {
    Status = "Inactive",
    Notes = "Customer churned"
  }
})

print("Updated row: " .. row.id)
```

---

## delete_row

Delete a row from a Baserow database table. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table_id` | integer | yes | The Baserow table ID |
| `row_id` | integer | yes | The ID of the row to delete |

### Example

```lua
app.integrations.baserow.delete_row({
  table_id = 42,
  row_id = 1
})
```

---

## list_databases

List all databases (applications) in the Baserow workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Defaults to 1. |
| `size` | integer | no | Number of results per page. Defaults to 100. |

### Example

```lua
local result = app.integrations.baserow.list_databases()

for _, db in ipairs(result) do
  print(db.id, db.name, db.type)
end
```

---

## get_current_user

Get the currently authenticated Baserow user profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.baserow.get_current_user()

print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
print("Workspaces: " .. #user.workspaces)
```

---

## Multi-Account Usage

If you have multiple Baserow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.baserow.function_name({...})

-- Explicit default (portable across setups)
app.integrations.baserow.default.function_name({...})

-- Named accounts
app.integrations.baserow.production.function_name({...})
app.integrations.baserow.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
