# Monday.com — Ruby API Reference

Monday.com is a Work OS that powers teams to run projects and workflows with confidence. This integration lets you list boards, get board details with columns and groups, list and get items, create items, list workspaces, and get the current user — all from Ruby programs.

## Authentication

Uses an **API Token** (personal token or OAuth token). Generate a personal API token at Monday.com → Avatar (bottom-left) → Developers → API tokens. The token authenticates via the Monday.com GraphQL API at `https://api.monday.com/v2`. Tokens inherit the permissions of the user who created them.

---

## Overview

All tools are called via `app.integrations.monday.<tool_name>({ ... })`. Every function takes a single Ruby object of named parameters and returns a result table.

```ruby
result = app.integrations.monday.get_board(board_id: 12345678)
```
Errors surface as `result.error` (string). Check for it before using the response.

```ruby
if result.error
  puts("Error: " + (result.error).to_s)
  nil
end
```
---

## Boards

### `app.integrations.monday.list_boards(...)`

List Monday.com boards the authenticated user has access to. Optionally filter by workspace.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max boards to return. Default: 25. |
| `workspace_id` | integer | no | Filter boards by workspace ID. Use `list_workspaces` to discover workspace IDs. |

Returns: `boards` (array), `total`. Each board contains: `id`, `name`, `description`, `board_kind`, `workspace` (table with `id`, `name`), `owner` (table with `id`, `name`), `items_count`, `created_at`, `updated_at`.

```ruby
# List all boards
result = app.integrations.monday.list_boards(limit: 50)
result.boards.each do |board|
  puts((board.name).to_s + " (" + (board.id).to_s + ") — " + (board.items_count).to_s + " items")
end
```
```ruby
# List boards in a specific workspace
result = app.integrations.monday.list_boards(workspace_id: 98765, limit: 10)
result.boards.each do |board|
  puts((board.name).to_s + " [" + (board.board_kind).to_s + "]")
end
```
---

### `app.integrations.monday.get_board(...)`

Get a single Monday.com board by ID. Returns full board details including all columns (with types) and groups. Use `list_boards` to discover board IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | Board ID to retrieve. |

Returns: `id`, `name`, `description`, `board_kind`, `state`, `workspace`, `owner`, `items_count`, `columns` (array of tables with `id`, `title`, `type`, `archived`), `groups` (array of tables with `id`, `title`, `color`, `position`, `deleted`), `created_at`, `updated_at`.

```ruby
# Get a board with its columns and groups
result = app.integrations.monday.get_board(board_id: 12345678)
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts("Board: " + (result.name).to_s)
  puts("State: " + (result.state).to_s)
  puts("Items: " + ((result.items_count).to_s).to_s)
  puts("\nColumns:")
  result.columns.each do |col|
    puts("  " + (col.title).to_s + " (" + (col.type).to_s + ") — ID: " + (col.id).to_s)
  end
  puts("\nGroups:")
  result.groups.each do |grp|
    puts("  " + (grp.title).to_s + " [color: " + (grp.color).to_s + "] — ID: " + (grp.id).to_s)
  end
end
```
---

## Items

### `app.integrations.monday.list_items(...)`

List items on a Monday.com board with pagination. Returns item name, state, group, creator, and timestamps.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | Board ID to list items for. |
| `limit` | integer | no | Results per page. Default: 25. |
| `page` | integer | no | Page number (1-based). Default: 1. |

Returns: `items` (array), `total`, `page`, `limit`. Each item contains: `id`, `name`, `state`, `group` (table with `id`, `title`), `creator` (table with `id`, `name`), `created_at`, `updated_at`.

```ruby
# List the first 10 items on a board
result = app.integrations.monday.list_items(board_id: 12345678, limit: 10)
result.items.each do |item|
  group = ((item.group && item.group.title) || "—")
  puts((item.name).to_s + " [state: " + (item.state).to_s + ", group: " + (group).to_s + "]")
end
```
```ruby
# Paginate through all items
page = 1
all_items = []
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.monday.list_items(board_id: 12345678, limit: 100, page: page)
  if result.error
    puts("Error: " + (result.error).to_s)
    break
  end
  result.items.each do |item|
    all_items.push(item)
  end
  page = (page + 1)
  break unless (!(result.items.length < 100))
end
puts("Fetched " + (all_items.length).to_s + " items total")
```
---

### `app.integrations.monday.get_item(...)`

Get a single Monday.com item by ID with all column values.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | Item ID to retrieve. |

Returns: `id`, `name`, `state`, `board` (table with `id`, `name`), `group` (table with `id`, `title`), `creator` (table with `id`, `name`), `column_values` (array of tables with `id`, `title`, `type`, `text`, `value`), `created_at`, `updated_at`.

```ruby
# Get an item with its column values
result = app.integrations.monday.get_item(item_id: 42)
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts("Item: " + (result.name).to_s)
  puts("Board: " + (((result.board && result.board.name) || "—")).to_s)
  puts("Group: " + (((result.group && result.group.title) || "—")).to_s)
  puts("State: " + (result.state).to_s)
  puts("\nColumn Values:")
  result.column_values.each do |cv|
    puts("  " + (cv.title).to_s + " (" + (cv.type).to_s + "): " + ((cv.text || "—")).to_s)
  end
end
```
---

### `app.integrations.monday.create_item(...)`

Create a new item on a Monday.com board. Requires a board ID and item name. Optionally set a group and initial column values.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | Board ID to create the item on. |
| `item_name` | string | yes | Name of the new item. |
| `group_id` | string | no | Group ID to place the item in. Use `get_board` to discover group IDs. |
| `column_values` | table | no | Column values to set, keyed by column ID. Values depend on column type. |

Returns: `id`, `name`, `state`, `board` (table with `id`, `name`), `group` (table with `id`, `title`), `created_at`.

```ruby
# Create a simple item
result = app.integrations.monday.create_item(board_id: 12345678, item_name: "New task from integration")
if (!result.error)
  puts("Created item: " + (result.name).to_s + " (ID: " + (result.id).to_s + ")")
end
```
```ruby
# Create an item with group and column values
result = app.integrations.monday.create_item(board_id: 12345678, item_name: "Fix production bug", group_id: "topics", column_values: {status: "Working on it", priority: "High", date4: "2026-04-10"})
if (!result.error)
  puts("Created (Unix seconds): " + (result.name).to_s + " in group " + (((result.group && result.group.title) || "—")).to_s)
end
```
---

## Workspaces

### `app.integrations.monday.list_workspaces(...)`

List Monday.com workspaces the authenticated user has access to. Returns workspace name, kind, description, and subscriber counts.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max workspaces to return. Default: 50. |

Returns: `workspaces` (array), `total`. Each workspace contains: `id`, `name`, `description`, `kind`, `owners_count`, `subscribers_count`, `is_deleted`, `created_at`.

```ruby
# List all workspaces
result = app.integrations.monday.list_workspaces()
result.workspaces.each do |ws|
  puts((ws.name).to_s + " (" + (ws.kind).to_s + ") — " + (ws.subscribers_count).to_s + " subscribers")
end
```
---

## User

### `app.integrations.monday.get_current_user(...)`

Get the currently authenticated Monday.com user's profile, including ID, name, email, avatar URL, title, location, and timezone.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `id`, `name`, `email`, `avatar_url`, `title`, `country_code`, `location`, `phone`, `timezone`, `join_date`, `enabled`.

```ruby
# Get the authenticated user's profile
result = app.integrations.monday.get_current_user()
puts("Logged in as: " + (result.name).to_s + " <" + (result.email).to_s + ">")
puts("Title: " + ((result.title || "—")).to_s)
puts("Timezone: " + ((result.timezone || "—")).to_s)
puts("User ID: " + (result.id).to_s)
```
---

## Pagination

The `list_items` tool supports page-based pagination. The response includes:

| Field | Type | Description |
|-------|------|-------------|
| `page` | integer | Current page number. |
| `limit` | integer | Results per page. |

### Paginating through all items

```ruby
items = []
page = 1
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.monday.list_items(board_id: 12345678, limit: 100, page: page)
  if result.error
    puts("Error: " + (result.error).to_s)
    break
  end
  result.items.each do |item|
    items.push(item)
  end
  page = (page + 1)
  break unless (!(result.items.length < 100))
end
puts("Fetched " + (items.length).to_s + " items total")
```
---

## Notes

- **Board IDs are integers**: Monday.com uses numeric IDs for boards and items. You can find these in the Monday.com UI URL or via the `list_boards` tool.
- **Column values format**: When setting column values in `create_item`, use the column ID (not the title) as the key. Use `get_board` to discover column IDs and types. The value format depends on the column type (e.g., status columns use label strings, date columns use `"YYYY-MM-DD"` format).
- **GraphQL backend**: All operations use the Monday.com GraphQL API at `https://api.monday.com/v2`.
- **Rate limits**: Monday.com enforces API rate limits based on your plan. If you encounter errors during bulk operations, add delays between calls.
- **Discovery flow**: Call `list_workspaces({})` to find workspace IDs → `list_boards({ workspace_id = ... })` to find board IDs → `get_board({ board_id = ... })` to see columns and groups → `create_item` or `list_items` to work with items.

---

## Multi-Account Usage

If you have multiple Monday.com accounts configured, use account-specific namespaces:

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
