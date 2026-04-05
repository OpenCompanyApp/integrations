# Bubble — Lua API Reference

## list_records

List records from a Bubble data type with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Bubble data type name (case-sensitive), e.g. `"User"`, `"Product"` |
| `constraints` | string | no | JSON-encoded array of constraint objects for filtering |
| `limit` | integer | no | Max records to return (1–100, default: 100) |
| `cursor` | integer | no | Offset for pagination (0-based) |

### Constraint Format

Each constraint is an object with three fields:

```json
[
  {"key": "field_name", "constraint_type": "equals", "value": "some_value"},
  {"key": "age", "constraint_type": "greater than", "value": 18}
]
```

### Constraint Types

| Type | Description |
|------|-------------|
| `equals` | Exact match |
| `not equal` | Does not match |
| `contains` | String contains substring |
| `not contains` | String does not contain |
| `is empty` | Field is empty (no value needed) |
| `is not empty` | Field has a value (no value needed) |
| `greater than` | Numeric greater than |
| `less than` | Numeric less than |
| `greater than or equal` | Numeric ≥ |
| `less than or equal` | Numeric ≤ |
| `begins with` | String starts with |
| `ends with` | String ends with |

### Response

```json
{
  "response": [
    {"_id": "abc123", "name": "John", "email": "john@example.com"}
  ],
  "remaining": 42
}
```

`remaining` is the count of additional records available after this page.

### Examples

#### List all users

```lua
local result = app.integrations.bubble.list_records({
  type = "User"
})

for _, record in ipairs(result.response) do
  print(record.name .. " <" .. record.email .. ">")
end
```

#### Filter users by email domain

```lua
local result = app.integrations.bubble.list_records({
  type = "User",
  constraints = '[{"key": "email", "constraint_type": "contains", "value": "@company.com"}]'
})

for _, record in ipairs(result.response) do
  print(record.name)
end
```

#### Paginate through records

```lua
local page_size = 50
local cursor = 0
local all_records = {}

repeat
  local result = app.integrations.bubble.list_records({
    type = "Product",
    limit = page_size,
    cursor = cursor
  })

  for _, record in ipairs(result.response) do
    table.insert(all_records, record)
  end

  cursor = cursor + page_size
until result.remaining == 0
```

---

## get_record

Get a single record by its unique Bubble ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Bubble data type name |
| `id` | string | yes | The unique identifier (UUID) of the record |

### Example

```lua
local record = app.integrations.bubble.get_record({
  type = "User",
  id = "1704982345123x456789"
})

print("Name: " .. record.name)
print("Email: " .. record.email)
print("Created: " .. record["Created Date"])
```

---

## create_record

Create a new record in a Bubble data type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Bubble data type name |
| `fields` | string | yes | JSON object of field names and values |

### Example

```lua
local result = app.integrations.bubble.create_record({
  type = "User",
  fields = '{"name": "Jane Doe", "email": "jane@example.com", "role": "admin"}'
})

print("Created record with ID: " .. result.id)
```

---

## update_record

Update an existing record. Only the provided fields are changed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Bubble data type name |
| `id` | string | yes | The unique identifier of the record |
| `fields` | string | yes | JSON object of field names and values to update |

### Example

```lua
local result = app.integrations.bubble.update_record({
  type = "User",
  id = "1704982345123x456789",
  fields = '{"name": "Jane Smith", "role": "editor"}'
})

print("Updated: " .. result.name)
```

---

## delete_record

Delete a record permanently by its unique ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Bubble data type name |
| `id` | string | yes | The unique identifier of the record |

### Example

```lua
app.integrations.bubble.delete_record({
  type = "User",
  id = "1704982345123x456789"
})
```

---

## Multi-Account Usage

If you have multiple Bubble apps configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bubble.list_records({ type = "User" })

-- Explicit default (portable across setups)
app.integrations.bubble.default.list_records({ type = "User" })

-- Named accounts
app.integrations.bubble.main_app.list_records({ type = "User" })
app.integrations.bubble.staging.list_records({ type = "User" })
```

All functions are identical across accounts — only the credentials (API key and hostname) differ.
