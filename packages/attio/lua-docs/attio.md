# Attio CRM — Lua API Reference

## list_records

List records for an object type in Attio with filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object_id` | string | yes | Object slug or ID (e.g. `"people"`, `"companies"`, `"deals"`) |
| `limit` | integer | no | Max records to return (default: 20, max: 500) |
| `offset` | integer | no | Records to skip for pagination (default: 0) |
| `sorts` | array | no | Sort definitions. Each entry: `{attribute = {slug = "name"}, direction = "asc"}` |
| `filters` | object | no | Filter definitions following Attio's filter grammar (see below) |

### Sort Syntax

Each sort entry is a table with:

- `attribute` — table with `slug` (string) for the attribute to sort on
- `direction` — `"asc"` or `"desc"`

```lua
sorts = {
  { attribute = { slug = "name" }, direction = "asc" }
}
```

### Filter Syntax

Filters use a JSON-like structure. Wrap multiple filters with `$and` or `$or`:

```lua
-- Single filter
filters = {
  attribute = { slug = "name" },
  condition = "contains",
  value = "Acme"
}

-- Compound filter
filters = {
  ["$and"] = {
    {
      attribute = { slug = "name" },
      condition = "contains",
      value = "Acme"
    },
    {
      attribute = { slug = "stage" },
      condition = "equals",
      value = "lead"
    }
  }
}
```

Common conditions: `equals`, `not_equals`, `contains`, `not_contains`, `starts_with`, `ends_with`, `is_empty`, `is_not_empty`, `greater_than`, `less_than`, `in`, `not_in`.

### Example

```lua
local result = app.integrations.attio.list_records({
  object_id = "companies",
  limit = 10,
  offset = 0,
  sorts = {
    { attribute = { slug = "name" }, direction = "asc" }
  },
  filters = {
    ["$and"] = {
      {
        attribute = { slug = "name" },
        condition = "contains",
        value = "Acme"
      }
    }
  }
})

for _, record in ipairs(result.data) do
  print(record.id.record_id .. ": " .. (record.values.name and record.values.name[1].value or "Unnamed"))
end
```

---

## get_record

Get a single record by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object_id` | string | yes | Object slug or ID (e.g. `"people"`, `"companies"`) |
| `id` | string | yes | The record UUID |

### Example

```lua
local result = app.integrations.attio.get_record({
  object_id = "companies",
  id = "aa1b2c3d-..."
})

local company = result.data
print(company.values.name[1].value)
```

---

## create_record

Create a new record for a given object type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object_id` | string | yes | Object slug or ID (e.g. `"people"`, `"companies"`) |
| `data` | object | yes | Attribute values keyed by attribute slug |

### Example

```lua
local result = app.integrations.attio.create_record({
  object_id = "companies",
  data = {
    name = "Acme Corp",
    domains = { "acme.com" },
    website = "https://acme.com"
  }
})

print("Created company: " .. result.data.id.record_id)
```

---

## list_objects

List all object types defined in the workspace.

### Parameters

None.

### Example

```lua
local result = app.integrations.attio.list_objects()

for _, obj in ipairs(result.data) do
  print(obj.api_slug .. " — " .. obj.singular_noun)
end
```

---

## get_object

Get details for a specific object type, including its attributes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Object slug or UUID |

### Example

```lua
local result = app.integrations.attio.get_object({
  id = "companies"
})

for _, attr in ipairs(result.data.attributes) do
  print(attr.api_slug .. " (" .. attr.attribute_type .. ")")
end
```

---

## list_workspaces

List all workspaces accessible to the authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.attio.list_workspaces()

for _, ws in ipairs(result.data) do
  print(ws.id.workspace_id .. ": " .. ws.name)
end
```

---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.attio.get_current_user()

print("User: " .. result.data.first_name .. " " .. result.data.last_name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Attio workspaces configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.attio.list_records({ object_id = "companies" })

-- Explicit default (portable across setups)
app.integrations.attio.default.list_records({ object_id = "companies" })

-- Named accounts
app.integrations.attio.production.list_records({ object_id = "companies" })
app.integrations.attio.staging.list_records({ object_id = "companies" })
```

All functions are identical across accounts — only the credentials differ.
