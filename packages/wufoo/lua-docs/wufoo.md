# Wufoo — Lua API Reference

## list_forms

List all forms in your Wufoo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| — | — | — | This tool takes no parameters. |

### Response

Returns an object containing a `Forms` array with form details including:

| Field | Type | Description |
|-------|------|-------------|
| `Hash` | string | Unique form identifier |
| `Name` | string | Form name |
| `Description` | string | Form description |
| `Url` | string | Public form URL |
| `DateCreated` | string | Creation date |
| `DateUpdated` | string | Last update date |
| `EntryCount` | string | Total number of entries |

### Example

```lua
local result = app.integrations.wufoo.list_forms()

for _, form in ipairs(result.Forms) do
  print(form.Name .. " (" .. form.Hash .. ") — " .. form.EntryCount .. " entries")
end
```

---

## get_form

Get details for a specific Wufoo form by its identifier.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash or identifier |

### Example

```lua
local result = app.integrations.wufoo.get_form({
  form_id = "q1w2e3r4t5y6"
})

local form = result.Forms[1]
print("Form: " .. form.Name)
print("Fields: " .. #form.Fields)
```

---

## list_entries

List entries submitted to a Wufoo form with pagination and optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form hash or identifier |
| `page` | integer | no | Page number (0-based). Default: 0 |
| `page_size` | integer | no | Entries per page. Default: 25, max: 100 |
| `filters` | object | no | Optional field filters (see below) |

### Filter Parameters

Filters are passed as key-value pairs. Common filter keys:

| Key | Description |
|-----|-------------|
| `Filter1` | First filter expression (e.g., `"Field1+Is+equal_to+value"`) |
| `Match` | Match logic: `"AND"` or `"OR"` when using multiple filters |
| `SortBy` | Field to sort by (prefix with `-` for descending) |
| `SortDirection` | Sort direction: `"ASC"` or `"DESC"` |

### Example

```lua
-- Get first page of entries
local result = app.integrations.wufoo.list_entries({
  form_id = "q1w2e3r4t5y6",
  page = 0,
  page_size = 25
})

for _, entry in ipairs(result.Entries) do
  print(entry.EntryId .. ": " .. (entry.Field1 or "no value"))
end

-- Get next page
local page2 = app.integrations.wufoo.list_entries({
  form_id = "q1w2e3r4t5y6",
  page = 1,
  page_size = 25
})

-- With filters
local filtered = app.integrations.wufoo.list_entries({
  form_id = "q1w2e3r4t5y6",
  filters = {
    Filter1 = "Field1+Is+equal_to+John"
  }
})
```

---

## get_entry

Get a single form entry by its identifier.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The entry identifier |

### Example

```lua
local result = app.integrations.wufoo.get_entry({
  entry_id = "12345"
})

local entry = result.Entries[1]
print("Entry ID: " .. entry.EntryId)
print("Date Created: " .. entry.DateCreated)
```

---

## list_reports

List all reports in your Wufoo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| — | — | — | This tool takes no parameters. |

### Example

```lua
local result = app.integrations.wufoo.list_reports()

for _, report in ipairs(result.Reports) do
  print(report.Name .. " — Form: " .. report.FormName)
end
```

---

## get_current_user

Get the authenticated Wufoo user's profile information.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| — | — | — | This tool takes no parameters. |

### Example

```lua
local result = app.integrations.wufoo.get_current_user()

local user = result.Users[1]
print("User: " .. user.FirstName .. " " .. user.LastName)
print("Email: " .. user.Email)
print("Organization: " .. user.Organization)
```

---

## Multi-Account Usage

If you have multiple Wufoo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wufoo.list_forms({})

-- Explicit default (portable across setups)
app.integrations.wufoo.default.list_forms({})

-- Named accounts
app.integrations.wufoo.marketing.list_forms({})
app.integrations.wufoo.support.list_entries({
  form_id = "abc123",
  page_size = 50
})
```

All functions are identical across accounts — only the credentials differ.
