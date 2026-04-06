# Zoho Sheet — Lua API Reference

## list_spreadsheets

List all spreadsheets accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of spreadsheets per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.zoho_sheet.list_spreadsheets({
  page = 1,
  per_page = 25
})

for _, sheet in ipairs(result.spreadsheets) do
  print(sheet.name .. " (ID: " .. sheet.resource_id .. ")")
end
```

---

## get_spreadsheet

Get details of a specific spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```lua
local result = app.integrations.zoho_sheet.get_spreadsheet({
  id = "abc123"
})

print("Spreadsheet: " .. result.name)
print("Worksheets: " .. #result.worksheets)
```

---

## list_worksheets

List all worksheets within a spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```lua
local result = app.integrations.zoho_sheet.list_worksheets({
  id = "abc123"
})

for _, ws in ipairs(result.worksheets) do
  print(ws.name .. " — " .. ws.row_count .. " rows, " .. ws.column_count .. " columns")
end
```

---

## get_worksheet

Get details of a specific worksheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |

### Example

```lua
local result = app.integrations.zoho_sheet.get_worksheet({
  id = "abc123",
  worksheet_id = "Sheet1"
})

print("Worksheet: " .. result.name)
print("Rows: " .. result.row_count)
```

---

## list_rows

List rows in a worksheet with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of rows per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.zoho_sheet.list_rows({
  id = "abc123",
  worksheet_id = "Sheet1",
  page = 1,
  per_page = 10
})

for _, row in ipairs(result.rows) do
  print(row.Name .. " — " .. row.Email)
end
```

---

## create_row

Create a new row in a worksheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |
| `data` | object | yes | Row data as key-value pairs (keys = column headers) |

### Example

```lua
local result = app.integrations.zoho_sheet.create_row({
  id = "abc123",
  worksheet_id = "Sheet1",
  data = {
    Name = "John Doe",
    Email = "john@example.com",
    Status = "Active"
  }
})

print("Row created successfully")
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.zoho_sheet.get_current_user({})

print("User: " .. result.display_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Zoho Sheet accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.zoho_sheet.function_name({...})

-- Explicit default (portable across setups)
app.integrations.zoho_sheet.default.function_name({...})

-- Named accounts
app.integrations.zoho_sheet.work.function_name({...})
app.integrations.zoho_sheet.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
