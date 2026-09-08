# Zoho Sheet — Ruby API Reference

## zoho_sheet_list_spreadsheets

List all spreadsheets accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of spreadsheets per page (default: 25, max: 100) |

### Example

```ruby
result = app.call("integrations.zoho-sheet.list_spreadsheets", page: 1, per_page: 25)
result.spreadsheets.each do |sheet|
  puts((sheet.name).to_s + " (ID: " + (sheet.resource_id).to_s + ")")
end
```
---

## zoho_sheet_get_spreadsheet

Get details of a specific spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```ruby
result = app.call("integrations.zoho-sheet.get_spreadsheet", id: "abc123")
puts("Spreadsheet: " + (result.name).to_s)
puts("Worksheets: " + (result.worksheets.length).to_s)
```
---

## zoho_sheet_list_worksheets

List all worksheets within a spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```ruby
result = app.call("integrations.zoho-sheet.list_worksheets", id: "abc123")
result.worksheets.each do |ws|
  puts((ws.name).to_s + " — " + (ws.row_count).to_s + " rows, " + (ws.column_count).to_s + " columns")
end
```
---

## zoho_sheet_get_worksheet

Get details of a specific worksheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |

### Example

```ruby
result = app.call("integrations.zoho-sheet.get_worksheet", id: "abc123", worksheet_id: "Sheet1")
puts("Worksheet: " + (result.name).to_s)
puts("Rows: " + (result.row_count).to_s)
```
---

## zoho_sheet_list_rows

List rows in a worksheet with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of rows per page (default: 25, max: 100) |

### Example

```ruby
result = app.call("integrations.zoho-sheet.list_rows", id: "abc123", worksheet_id: "Sheet1", page: 1, per_page: 10)
result.rows.each do |row|
  puts((row.Name).to_s + " — " + (row.Email).to_s)
end
```
---

## zoho_sheet_create_row

Create a new row in a worksheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |
| `worksheet_id` | string | yes | The worksheet resource ID |
| `data` | object | yes | Row data as key-value pairs (keys = column headers) |

### Example

```ruby
result = app.call("integrations.zoho-sheet.create_row", id: "abc123", worksheet_id: "Sheet1", data: {Name: "John Doe", Email: "john@example.com", Status: "Active"})
puts("Row created successfully")
```
---

## zoho_sheet_get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.zoho-sheet.get_current_user")
puts("User: " + (result.display_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Zoho Sheet accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
