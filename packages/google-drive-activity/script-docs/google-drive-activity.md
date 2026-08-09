# Google Drive Activity

Google Drive Activity tools are exposed under `app.integrations.google_drive_activity`. Google's Drive Activity v2 REST API currently exposes one method, `activity.query`, so this package focuses on making that request shape reliable and easy for agents to use.

Use it to inspect audit and activity history for Drive files, folders, shared drives, or ancestors.

## Example

```js
var activity = app.integrations.google_drive_activity.google_drive_activity_activity_query({
  item_name: "items/file-id",
  page_size: 10,
  filter: 'time >= "2026-01-01T00:00:00Z"',
  consolidation_strategy: {
    legacy: {},
  }
})
```
Use `ancestor_name = "items/folder-id"` to query activity under a folder or shared drive ancestor. Use `page_token` with the response `nextPageToken` to continue a long result set.

The tool accepts first-class snake_case arguments for the common QueryDriveActivityRequest fields and sends Google's expected camelCase body fields:

- `item_name` -> `itemName`
- `ancestor_name` -> `ancestorName`
- `page_size` -> `pageSize`
- `page_token` -> `pageToken`
- `filter` -> `filter`
- `consolidation_strategy` -> `consolidationStrategy`

For less common or newly added request fields, pass a `body` object using Google's exact schema. First-class arguments override matching fields in `body`.

Returned data is the parsed JSON response from the Drive Activity API, normally an `activities` array and optional `nextPageToken`.
