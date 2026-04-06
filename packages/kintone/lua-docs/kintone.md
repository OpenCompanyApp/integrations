# Kintone — Lua API Reference

## list_records

Retrieve records from a Kintone app with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `query` | string | no | Kintone query string to filter records |
| `fields` | array | no | List of field codes to include in the response |
| `limit` | integer | no | Maximum number of records to return (max 500, default 100) |
| `offset` | integer | no | Number of records to skip for pagination |

### Query Syntax

Kintone queries use a SQL-like syntax:

```
FieldCode operator "Value" [and|or FieldCode operator "Value"] order by FieldCode [asc|desc] limit N offset N
```

Operators: `=`, `!=`, `>`, `<`, `>=`, `<=`, `in`, `not in`, `like`, `not like`

## Examples

### List all records from an app

```lua
local result = app.integrations.kintone.list_records({
  app = 1
})

for _, record in ipairs(result.records) do
  print(record.Record_number.value .. ": " .. record.Title.value)
end
```

### Filter records with a query

```lua
local result = app.integrations.kintone.list_records({
  app = 1,
  query = 'Status = "Open" order by Record_number asc limit 20'
})
```

### Select specific fields

```lua
local result = app.integrations.kintone.list_records({
  app = 1,
  fields = {"Record_number", "Title", "Status"},
  limit = 50
})
```

### Paginate through records

```lua
local result = app.integrations.kintone.list_records({
  app = 1,
  limit = 100,
  offset = 200
})
```

---

## get_record

Retrieve a single record by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `id` | integer | yes | The record ID |

### Example

```lua
local result = app.integrations.kintone.get_record({
  app = 1,
  id = 42
})

print(result.record.Title.value)
```

---

## create_record

Create a new record in a Kintone app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `record` | object | yes | Field values keyed by field code |

### Record Format

The `record` parameter is an object where each key is a field code mapping to `{value: ...}`:

```lua
{
  FieldCode = { value = "some value" },
  NumberField = { value = 42 }
}
```

### Example

```lua
local result = app.integrations.kintone.create_record({
  app = 1,
  record = {
    Title = { value = "New Task" },
    Status = { value = "Open" },
    Priority = { value = "High" },
    DueDate = { value = "2026-04-30" }
  }
})

print("Created record ID: " .. result.id)
```

---

## list_apps

List available Kintone apps.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of apps to return (default 100, max 500) |
| `offset` | integer | no | Number of apps to skip for pagination |

### Example

```lua
local result = app.integrations.kintone.list_apps({
  limit = 50
})

for _, app in ipairs(result.apps) do
  print(app.appId .. ": " .. app.name)
end
```

---

## get_app

Get details of a specific Kintone app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The app ID |

### Example

```lua
local result = app.integrations.kintone.get_app({
  id = 1
})

print("App: " .. result.name)
print("Description: " .. result.description)
```

---

## list_spaces

List Kintone spaces.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of spaces to return (default 100, max 500) |
| `offset` | integer | no | Number of spaces to skip for pagination |

### Example

```lua
local result = app.integrations.kintone.list_spaces({
  limit = 50
})

for _, space in ipairs(result.spaces) do
  print(space.id .. ": " .. space.name)
end
```

---

## get_current_user

Get the profile of the currently authenticated Kintone user.

### Parameters

None.

### Example

```lua
local result = app.integrations.kintone.get_current_user()

print("Name: " .. result.name)
print("Email: " .. result.email)
print("Code: " .. result.code)
```

---

## Multi-Account Usage

If you have multiple Kintone accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.kintone.function_name({...})

-- Explicit default (portable across setups)
app.integrations.kintone.default.function_name({...})

-- Named accounts
app.integrations.kintone.production.function_name({...})
app.integrations.kintone.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
