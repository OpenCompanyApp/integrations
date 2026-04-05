# Monday.com — Lua API Reference

## monday_create_item

Create a new item on a Monday.com board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The ID of the board to create the item on. |
| `item_name` | string | yes | The name of the new item. |
| `group_id` | string | no | The ID of the group to create the item in. |
| `column_values` | object | no | A JSON object of column values to set, keyed by column ID. |

## monday_get_item

Get detailed information about a Monday.com item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to retrieve. |

## monday_update_item

Update column values on an existing Monday.com item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The ID of the board the item belongs to. |
| `item_id` | integer | yes | The ID of the item to update. |
| `column_values` | object | yes | A JSON object of column values to update, keyed by column ID. |

## monday_list_items

List items on a Monday.com board with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The ID of the board to list items from. |
| `limit` | integer | no | Maximum number of items to return (default 25, max 500). |
| `page` | integer | no | Page number for pagination (starts at 1). |
| `query` | string | no | Search query to filter items by name. |

## monday_delete_item

Delete an item from a Monday.com board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to delete. |

## monday_create_board

Create a new board on Monday.com.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_name` | string | yes | The name of the new board. |
| `workspace_id` | integer | no | The ID of the workspace to create the board in. |
| `board_kind` | string | no | The board kind: `"public"`, `"private"`, or `"share"`. Defaults to `"public"`. |

## monday_list_boards

List boards on Monday.com with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of boards to return (default 25). |
| `page` | integer | no | Page number for pagination (starts at 1). |
| `workspace_id` | integer | no | The ID of the workspace to filter boards by. |

## monday_get_board_columns

Get the column structure of a Monday.com board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | The ID of the board to get columns for. |

## monday_create_update

Add an update (comment) to a Monday.com item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to add the update to. |
| `body` | string | yes | The text content of the update. |

## monday_list_updates

List updates (comments) on a Monday.com item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to list updates for. |
| `limit` | integer | no | Maximum number of updates to return (default 25). |
| `page` | integer | no | Page number for pagination (starts at 1). |

## monday_list_workspaces

List workspaces on Monday.com.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of workspaces to return (default 25). |

## monday_list_users

List users on a Monday.com account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (default 25). |
| `kind` | string | no | User kind filter: `"all"`, `"guests"`, `"non_guests"`, or `"non_pending"`. |

## monday_upload_file

Upload a file to a column on a Monday.com item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to upload the file to. |
| `column_id` | string | yes | The ID of the file column. |
| `file_content` | string | yes | Base64-encoded file content. |
| `file_name` | string | yes | The name of the file including extension. |

## monday_move_item_to_group

Move a Monday.com item to a different group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The ID of the item to move. |
| `group_id` | string | yes | The ID of the target group. |

## monday_get_me

Get the currently authenticated Monday.com user.

### Parameters

*No parameters required.*

## Examples

### Create an item with column values

```lua
local result = app.integrations.monday.monday_create_item({
  board_id = 123456,
  item_name = "New Task",
  group_id = "topics",
  column_values = {
    status = "Working on it",
    date = "2026-04-05"
  }
})
print("Created item ID: " .. result.id)
```

### List items on a board

```lua
local result = app.integrations.monday.monday_list_items({
  board_id = 123456,
  limit = 10,
  page = 1
})
for _, item in ipairs(result.items) do
  print(item.name)
end
```

### Add a comment to an item

```lua
local result = app.integrations.monday.monday_create_update({
  item_id = 789,
  body = "This task is now in progress."
})
```
