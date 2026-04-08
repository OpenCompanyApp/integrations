# QuickBase — Lua API Reference

## list_tables

List all tables in a QuickBase application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `appId` | string | yes | The application ID (dbid) to list tables for |

### Example

```lua
local result = app.integrations.quickbase.list_tables({
  appId = "bqxxx"
})

for _, table in ipairs(result) do
  print(table.id .. ": " .. table.name)
end
```

---

## get_table

Get details for a specific QuickBase table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tableId` | string | yes | The table ID (dbid) to retrieve |

### Example

```lua
local result = app.integrations.quickbase.get_table({
  tableId = "bqxxx"
})

print("Table: " .. result.name)
print("Fields:")
for _, field in ipairs(result.fields or {}) do
  print("  " .. field.id .. " - " .. field.label .. " (" .. field.fieldType .. ")")
end
```

---

## list_records

Query records from a QuickBase table with filters, field selection, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tableId` | string | yes | The table ID (dbid) to query |
| `where` | string | no | Filter expression in QuickBase query syntax |
| `select` | array | no | Array of field IDs to include in the response |
| `sortBy` | array | no | Sort specification: `[{fieldId: 3, order: "ASC"}]` |
| `groupBy` | array | no | Grouping specification: `[{fieldId: 3, grouping: "equal-values"}]` |
| `options` | object | no | Additional options: `{skip: 0, top: 100, includeRids: true}` |

### QuickBase Query Syntax

The `where` parameter uses QuickBase's query string format:

```
{fieldId.operator.'value'}
```

**Common operators:**

| Operator | Meaning |
|----------|---------|
| `EX` | Equals |
| `NE` | Not equal |
| `GT` | Greater than |
| `GTE` | Greater than or equal |
| `LT` | Less than |
| `LTE` | Less than or equal |
| `CT` | Contains |
| `SW` | Starts with |
| `XEX` | Does not equal |
| `XCT` | Does not contain |

**Combine conditions with:**
- `AND` — both conditions must match
- `OR` — either condition matches

**Example:** `{6.CT.'urgent'}AND{7.GT.100}`

### Examples

#### Get all records (first 100)

```lua
local result = app.integrations.quickbase.list_records({
  tableId = "bqxxx",
  options = { skip = 0, top = 100 }
})
```

#### Filter records with a condition

```lua
local result = app.integrations.quickbase.list_records({
  tableId = "bqxxx",
  where = "{6.EX.'Complete'}",
  select = {3, 6, 7, 8}
})

for _, record in ipairs(result.data or {}) do
  for _, field in ipairs(record) do
    print("Field " .. field.id .. ": " .. tostring(field.value))
  end
end
```

#### Sorted and paginated

```lua
local result = app.integrations.quickbase.list_records({
  tableId = "bqxxx",
  sortBy = {{fieldId = 3, order = "DESC"}},
  options = { skip = 0, top = 50 }
})
```

---

## get_record

Get a single QuickBase record by its record ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tableId` | string | yes | The table ID (dbid) |
| `recordId` | integer | yes | The record ID to retrieve |

### Example

```lua
local result = app.integrations.quickbase.get_record({
  tableId = "bqxxx",
  recordId = 42
})

for _, field in ipairs(result.data or {}) do
  print("Field " .. field.id .. ": " .. tostring(field.value))
end
```

---

## create_record

Create a new record in a QuickBase table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tableId` | string | yes | The table ID (dbid) to create the record in |
| `fields` | array | yes | Array of field data: `[{fieldId: 6, value: "New value"}, ...]` |

### Example

```lua
local result = app.integrations.quickbase.create_record({
  tableId = "bqxxx",
  fields = {
    {fieldId = 6, value = "New Project"},
    {fieldId = 7, value = 42},
    {fieldId = 8, value = "2025-06-01"}
  }
})

print("Created record ID: " .. tostring(result.metadata.createdRecordIds[1]))
```

---

## get_current_user

Get the currently authenticated QuickBase user.

### Parameters

None.

### Example

```lua
local result = app.integrations.quickbase.get_current_user({})

print("User: " .. (result.firstName or "") .. " " .. (result.lastName or ""))
print("Email: " .. (result.email or ""))
print("ID: " .. (result.id or ""))
```

---

## Multi-Account Usage

If you have multiple QuickBase accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.quickbase.function_name({...})

-- Explicit default (portable across setups)
app.integrations.quickbase.default.function_name({...})

-- Named accounts
app.integrations.quickbase.production.function_name({...})
app.integrations.quickbase.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
