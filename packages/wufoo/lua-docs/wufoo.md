# Wufoo — Lua API Reference

## list_forms

List all forms in the Wufoo account.

### Parameters

None.

### Response

Returns an array of form objects, each containing:

| Field | Description |
|-------|-------------|
| `Hash` | Form hash identifier (used as `form_id` in other tools) |
| `Name` | Form name |
| `Description` | Form description |
| `EntryCount` | Total number of entries |
| `Url` | Public URL to the form |
| `DateCreated` | Creation timestamp |
| `DateUpdated` | Last update timestamp |

### Example

```lua
local result = app.integrations.wufoo.list_forms()

for _, form in ipairs(result.forms) do
  print(form.Name .. " (" .. form.Hash .. ") — " .. form.EntryCount .. " entries")
end
```

---

## get_form

Get details for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash identifier |

### Example

```lua
local result = app.integrations.wufoo.get_form({
  form_id = "z1k08xw1ubbvkt"
})

print(result.form.Name)
print(result.form.Description)
print(result.form.EntryCount .. " entries")
```

---

## list_entries

List entries submitted to a form. Supports pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash identifier |
| `page_size` | integer | no | Number of entries per page (default: 100, max: 100) |
| `page_start` | integer | no | Entry index to start from, 0-based (for pagination) |
| `sort` | string | no | Sort direction: `"ASC"` (oldest first) or `"DESC"` (newest first) |

### Example

```lua
-- Get the 50 most recent entries
local result = app.integrations.wufoo.list_entries({
  form_id = "z1k08xw1ubbvkt",
  page_size = 50,
  sort = "DESC"
})

for _, entry in ipairs(result.entries) do
  print("Entry " .. entry.EntryId .. " by " .. (entry.Field1 or "unknown"))
end

-- Pagination: get next page
if result.total == result.page_size then
  local next = app.integrations.wufoo.list_entries({
    form_id = "z1k08xw1ubbvkt",
    page_size = 50,
    page_start = result.page_start + result.page_size,
    sort = "DESC"
  })
end
```

---

## get_entry

Get a single form entry by its unique entry ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The unique entry identifier |

### Example

```lua
local result = app.integrations.wufoo.get_entry({
  entry_id = "42"
})

local entry = result.entry
print("Entry ID: " .. entry.EntryId)
print("Created: " .. entry.DateCreated)
-- Field values are keyed by their API IDs (e.g., Field1, Field2)
for key, value in pairs(entry) do
  if key:match("^Field") then
    print("  " .. key .. " = " .. tostring(value))
  end
end
```

---

## submit_entry

Submit a new entry to a Wufoo form. Use `list_fields` first to discover the correct field API IDs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash identifier |
| `fields` | object | yes | Map of field API IDs to values |

### Example

```lua
-- First, discover fields
local fields = app.integrations.wufoo.list_fields({
  form_id = "z1k08xw1ubbvkt"
})

for _, field in ipairs(fields.fields) do
  print(field.ID .. ": " .. field.Title .. " (" .. field.Type .. ")")
end

-- Then submit an entry using the field IDs
local result = app.integrations.wufoo.submit_entry({
  form_id = "z1k08xw1ubbvkt",
  fields = {
    Field1 = "John Doe",
    Field2 = "john@example.com",
    Field3 = "Hello, I have a question.",
    Field4 = "General Inquiry"
  }
})

if result.success then
  print("Entry created with ID: " .. tostring(result.entry_id))
end
```

---

## list_fields

List all fields for a specific form. Returns field types, labels, API IDs, and validation rules.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash identifier |

### Response

Returns an array of field objects, each containing:

| Field | Description |
|-------|-------------|
| `ID` | API field ID (e.g., "Field1") — use this when submitting entries |
| `Title` | Human-readable field label |
| `Type` | Field type (e.g., "text", "email", "checkbox", "select") |
| `Required` | Whether the field is required ("1" or "0") |
| `Choices` | Available options for select/radio/checkbox fields |

### Example

```lua
local result = app.integrations.wufoo.list_fields({
  form_id = "z1k08xw1ubbvkt"
})

for _, field in ipairs(result.fields) do
  local req = field.Required == "1" and " (required)" or ""
  print(field.ID .. " — " .. field.Title .. " [" .. field.Type .. "]" .. req)
end
```

---

## list_reports

List all reports in the Wufoo account.

### Parameters

None.

### Response

Returns an array of report objects, each containing:

| Field | Description |
|-------|-------------|
| `Hash` | Report hash identifier |
| `Name` | Report name |
| `Description` | Report description |
| `Url` | Public URL to the report |
| `EntryCount` | Number of entries included |

### Example

```lua
local result = app.integrations.wufoo.list_reports()

for _, report in ipairs(result.reports) do
  print(report.Name .. " — " .. report.EntryCount .. " entries")
end
```

---

## Multi-Account Usage

If you have multiple Wufoo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wufoo.list_forms()

-- Explicit default (portable across setups)
app.integrations.wufoo.default.list_forms()

-- Named accounts
app.integrations.wufoo.marketing.list_forms()
app.integrations.wufoo.support.list_entries({ form_id = "abc123" })
```

All functions are identical across accounts — only the credentials differ.
