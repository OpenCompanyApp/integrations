# Zoho Sheet — JavaScript API Reference

## zoho_sheet_list_spreadsheets

List all spreadsheets accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of spreadsheets per page (default: 25, max: 100) |

### Example

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_list_spreadsheets({
  page: 1,
  per_page: 25,
})

for (const sheet of (result.spreadsheets)) {
  console.log(sheet.name + " (ID: " + sheet.resource_id + ")")
}
```
---

## zoho_sheet_get_spreadsheet

Get details of a specific spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_get_spreadsheet({
  id: "abc123",
})

console.log("Spreadsheet: " + result.name)
console.log("Worksheets: " + result.worksheets.length)
```
---

## zoho_sheet_list_worksheets

List all worksheets within a spreadsheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The spreadsheet resource ID |

### Example

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_list_worksheets({
  id: "abc123",
})

for (const ws of (result.worksheets)) {
  console.log(ws.name + " — " + ws.row_count + " rows, " + ws.column_count + " columns")
}
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

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_get_worksheet({
  id: "abc123",
  worksheet_id: "Sheet1",
})

console.log("Worksheet: " + result.name)
console.log("Rows: " + result.row_count)
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

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_list_rows({
  id: "abc123",
  worksheet_id: "Sheet1",
  page: 1,
  per_page: 10,
})

for (const row of (result.rows)) {
  console.log(row.Name + " — " + row.Email)
}
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

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_create_row({
  id: "abc123",
  worksheet_id: "Sheet1",
  data: {
    Name: "John Doe",
    Email: "john@example.com",
    Status: "Active",
  }
})

console.log("Row created successfully")
```
---

## zoho_sheet_get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```js
var result = app.integrations["zoho-sheet"].zoho_sheet_get_current_user({})

console.log("User: " + result.display_name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Zoho Sheet accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-sheet"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-sheet"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["zoho-sheet"].work.function_name({ /* parameters */ })
app.integrations["zoho-sheet"].personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
