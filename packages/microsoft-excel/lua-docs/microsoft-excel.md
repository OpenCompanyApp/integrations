# Microsoft Excel

Namespace: `microsoft-excel`

This integration exposes Microsoft Excel workbook operations through the official Microsoft Graph v1.0 OpenAPI metadata. It covers workbook application settings, comments, functions, names, worksheets, ranges, tables, charts, PivotTables, filters, formats, protection, and session actions across drive, group, site, user, and shared item workbook paths.

## Authentication

Provide a Microsoft Graph OAuth access token with file or site permissions required by the target workbook, such as `Files.ReadWrite.All`, `Sites.ReadWrite.All`, or related delegated/application permissions.

## Usage notes

- Most tools require `drive_id` and `drive_item_id`, or the equivalent owner/site/shared-item path parameters, because Graph workbook APIs operate on an Excel file stored in OneDrive or SharePoint.
- Use the generated create-session tools first when you need consistent multi-step edits. Pass the returned session ID as `workbook_session_id`, which maps to the `Workbook-Session-Id` header.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- Write/function endpoints accept a `body` object matching the official Microsoft Graph request schema.
- Pass `prefer` when a Graph workbook endpoint supports a `Prefer` header.

## Example

```lua
local worksheets = microsoft_excel_drives_items_workbook_list_worksheets({
  drive_id = "drive-id",
  drive_item_id = "item-id"
})
local range = microsoft_excel_drives_items_workbook_worksheets_get_range({
  drive_id = "drive-id",
  drive_item_id = "item-id",
  workbook_worksheet_id = "sheet-id",
  address = "A1:D10"
})
```
