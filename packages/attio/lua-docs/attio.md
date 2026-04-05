# Attio CRM — Lua API Reference

## list_records

List records for an object type in Attio.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object` | string | yes | Object slug (e.g. `"people"`, `"companies"`, `"deals"`) |
| `limit` | integer | no | Max records to return (default: 20, max: 500) |
| `offset` | integer | no | Records to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.attio.list_records({
  object = "companies",
  limit = 10,
  offset = 0
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
| `object` | string | yes | Object slug (e.g. `"people"`, `"companies"`) |
| `id` | string | yes | The record UUID |

### Example

```lua
local result = app.integrations.attio.get_record({
  object = "companies",
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
| `object` | string | yes | Object slug (e.g. `"people"`, `"companies"`) |
| `data` | object | yes | Attribute values keyed by attribute slug |

### Example

```lua
local result = app.integrations.attio.create_record({
  object = "companies",
  data = {
    name = "Acme Corp",
    domains = { "acme.com" },
    website = "https://acme.com"
  }
})

print("Created company: " .. result.data.id.record_id)
```

---

## update_record

Update an existing record by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object` | string | yes | Object slug (e.g. `"people"`, `"companies"`) |
| `id` | string | yes | The record UUID |
| `data` | object | yes | Attribute values to update, keyed by attribute slug |

### Example

```lua
local result = app.integrations.attio.update_record({
  object = "companies",
  id = "aa1b2c3d-...",
  data = {
    name = "Acme Corp (Updated)"
  }
})

print("Updated: " .. result.data.values.name[1].value)
```

---

## delete_record

Delete a record by ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object` | string | yes | Object slug (e.g. `"people"`, `"companies"`) |
| `id` | string | yes | The record UUID |

### Example

```lua
app.integrations.attio.delete_record({
  object = "companies",
  id = "aa1b2c3d-..."
})

print("Record deleted.")
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
| `object` | string | yes | Object slug or UUID |

### Example

```lua
local result = app.integrations.attio.get_object({
  object = "companies"
})

for _, attr in ipairs(result.data.attributes) do
  print(attr.api_slug .. " (" .. attr.attribute_type .. ")")
end
```

---

## list_lists

List all lists in the workspace.

### Parameters

None.

### Example

```lua
local result = app.integrations.attio.list_lists()

for _, list in ipairs(result.data) do
  print(list.id.list_id .. ": " .. list.title)
end
```

---

## get_list

Get details for a specific list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The list UUID |

### Example

```lua
local result = app.integrations.attio.get_list({
  id = "list-uuid-here"
})

print("List: " .. result.data.title)
print("Parent object: " .. result.data.parent_object_api_slug)
```

---

## list_entries

List entries (records) in a specific list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The list UUID |
| `limit` | integer | no | Max entries to return (default: 20) |
| `offset` | integer | no | Entries to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.attio.list_entries({
  id = "list-uuid-here",
  limit = 10
})

for _, entry in ipairs(result.data) do
  print(entry.id.entry_id)
end
```

---

## create_note

Create a note attached to a record.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent_object` | string | yes | Parent object slug (e.g. `"people"`, `"companies"`) |
| `parent_record_id` | string | yes | UUID of the parent record |
| `content` | string | yes | Note content (plain text or markdown) |

### Example

```lua
local result = app.integrations.attio.create_note({
  parent_object = "companies",
  parent_record_id = "aa1b2c3d-...",
  content = "Had a great call with the CEO. Follow up next week."
})

print("Note created: " .. result.data.id.note_id)
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
app.integrations.attio.list_records({ object = "companies" })

-- Explicit default (portable across setups)
app.integrations.attio.default.list_records({ object = "companies" })

-- Named accounts
app.integrations.attio.production.list_records({ object = "companies" })
app.integrations.attio.staging.list_records({ object = "companies" })
```

All functions are identical across accounts — only the credentials differ.
