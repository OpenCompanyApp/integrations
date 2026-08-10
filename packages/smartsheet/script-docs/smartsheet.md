# Smartsheet — JavaScript API Reference

## Authentication

This integration uses a Smartsheet Personal Access Token. Configure it in your integration settings before using any tools.

---

## smartsheet_list_sheets

List all sheets accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sheets to return (default 100, max 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```js
var result = app.integrations.smartsheet.list_sheets({
  limit: 25,
  page: 1,
})

for (const sheet of (result.data)) {
  console.log(sheet.name + " (ID: " + sheet.id + ")")
}
```
---

## smartsheet_get_sheet

Get a specific sheet by ID, including its rows and columns.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |
| `page_size` | integer | no | Number of rows per page (default 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```js
var result = app.integrations.smartsheet.get_sheet({
  sheet_id: 1234567890,
  page_size: 50,
  page: 1,
})

console.log("Sheet: " + result.name)
for (const col of (result.columns)) {
  console.log("  Column: " + col.title + " (" + col.type + ")")
}
for (const row of (result.rows)) {
  for (const cell of (row.cells)) {
    console.log("  Cell value: " + String(cell.value))
  }
}
```
---

## smartsheet_create_sheet

Create a new sheet with the specified name and column definitions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new sheet |
| `columns` | array | yes | Array of column definitions, each with `"title"` and `"type"` |

### Column Types

`TEXT_NUMBER`, `DATE`, `CHECKBOX`, `PICKLIST`, `CONTACT_LIST`, `DATETIME`, `DURATION`, `ABSTRACT_DATETIME`, `MULTI_CONTACT_LIST`, `AUTO_NUMBER`

### Example

```js
var result = app.integrations.smartsheet.create_sheet({
  name: "Project Tracker",
  columns: [
    { title: "Task Name", type: "TEXT_NUMBER", primary: true },
    { title: "Due Date", type: "DATE" },
    { title: "Status", type: "PICKLIST", options: [ "Not Started", "In Progress", "Done" ] },
    { title: "Complete", type: "CHECKBOX" }
  ]
})

console.log("Created sheet: " + result.name + " (ID: " + result.id + ")")
```
---

## smartsheet_add_rows

Add one or more rows to a sheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |
| `rows` | array | yes | Array of row objects, each with a `"cells"` array |

### Cell Format

Each cell in the `"cells"` array is an object with `"columnId"` and `"value"`:

```json
{ "columnId": 123456, "value": "Some text" }
```

Optional row positioning keys: `"toTop"`, `"toBottom"`, `"parentId"`.

### Example

```js
var result = app.integrations.smartsheet.add_rows({
  sheet_id: 1234567890,
  rows: [
    {
      toBottom: true,
      cells: [
        { columnId: 111, value: "Design mockups" },
        { columnId: 222, value: "2026-04-15" },
        { columnId: 333, value: "In Progress" }
      ]
    },
    {
      toBottom: true,
      cells: [
        { columnId: 111, value: "API integration" },
        { columnId: 222, value: "2026-04-20" },
        { columnId: 333, value: "Not Started" }
      ]
    }
  ]
})

console.log("Added " + result.result.length + " rows")
```
---

## smartsheet_update_rows

Update one or more existing rows in a sheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |
| `rows` | array | yes | Array of row objects, each must include `"id"` and updated `"cells"` |

### Example

```js
var result = app.integrations.smartsheet.update_rows({
  sheet_id: 1234567890,
  rows: [
    {
      id: 999888777,
      cells: [
        { columnId: 333, value: "Done" }
      ]
    }
  ]
})
```
---

## smartsheet_delete_rows

Delete one or more rows from a sheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |
| `row_ids` | array | yes | Array of row IDs to delete |

### Example

```js
var result = app.integrations.smartsheet.delete_rows({
  sheet_id: 1234567890,
  row_ids: [ 111, 222, 333 ],
})
```
---

## smartsheet_list_columns

List all columns in a sheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |

### Example

```js
var result = app.integrations.smartsheet.list_columns({
  sheet_id: 1234567890,
})

for (const col of (result.data)) {
  console.log(col.title + " — type: " + col.type + ", ID: " + col.id)
}
```
---

## smartsheet_add_column

Add a new column to a sheet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sheet_id` | integer | yes | The unique identifier of the sheet |
| `title` | string | yes | The title for the new column |
| `type` | string | yes | Column type (see list below) |

### Column Types

`TEXT_NUMBER`, `DATE`, `CHECKBOX`, `PICKLIST`, `CONTACT_LIST`, `DATETIME`, `DURATION`, `ABSTRACT_DATETIME`, `MULTI_CONTACT_LIST`, `AUTO_NUMBER`

### Example

```js
var result = app.integrations.smartsheet.add_column({
  sheet_id: 1234567890,
  title: "Priority",
  type: "PICKLIST",
  options: [ "High", "Medium", "Low" ],
})

console.log("Created column: " + result.title + " (ID: " + result.id + ")")
```
---

## smartsheet_list_workspaces

List all workspaces accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of workspaces to return (default 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```js
var result = app.integrations.smartsheet.list_workspaces({
  limit: 50,
})

for (const ws of (result.data)) {
  console.log("Workspace: " + ws.name + " (ID: " + ws.id + ")")
}
```
---

## smartsheet_get_workspace

Get a specific workspace by ID, including its sheets, reports, and other contents.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspace_id` | integer | yes | The unique identifier of the workspace |

### Example

```js
var result = app.integrations.smartsheet.get_workspace({
  workspace_id: 9876543210,
})

console.log("Workspace: " + result.name)
if (result.sheets) {
  for (const sheet of (result.sheets)) {
    console.log("  Sheet: " + sheet.name)
  }
}
```
---

## smartsheet_search

Search across Smartsheet sheets, reports, and templates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The search query string |
| `limit` | integer | no | Maximum number of search results to return (default 100) |

### Example

```js
var result = app.integrations.smartsheet.search({
  query: "budget review",
  limit: 10,
})

if (result.results) {
  for (const item of (result.results)) {
    console.log("Found: " + item.text + " in " + (item.parentName || "unknown"))
  }
}
```
---

## smartsheet_get_current_user

Get the currently authenticated user's profile, including name and email.

### Parameters

None.

### Example

```js
var result = app.integrations.smartsheet.get_current_user({})

console.log("Logged in as: " + result.firstName + " " + result.lastName + " <" + result.email + ">")
```
---

## Multi-Account Usage

If you have multiple smartsheet accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.smartsheet.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.smartsheet.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.smartsheet.work.function_name({ /* parameters */ })
app.integrations.smartsheet.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
