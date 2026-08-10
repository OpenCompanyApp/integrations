# Monday.com — JavaScript API Reference

Monday.com is a Work OS that powers teams to run projects and workflows with confidence. This integration lets you list boards, get board details with columns and groups, list and get items, create items, list workspaces, and get the current user — all from JavaScript programs.

## Authentication

Uses an **API Token** (personal token or OAuth token). Generate a personal API token at Monday.com → Avatar (bottom-left) → Developers → API tokens. The token authenticates via the Monday.com GraphQL API at `https://api.monday.com/v2`. Tokens inherit the permissions of the user who created them.

---

## Overview

All tools are called via `app.integrations.monday.<tool_name>({ ... })`. Every function takes a single JavaScript object of named parameters and returns a result table.

```js
var result = app.integrations.monday.get_board({ board_id: 12345678 })
```
Errors surface as `result.error` (string). Check for it before using the response.

```js
if (result.error) {
  console.log("Error: " + result.error)
  return
}
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

```js
// List all boards
var result = app.integrations.monday.list_boards({ limit: 50 })

for (const board of (result.boards)) {
  console.log(board.name + " (" + board.id + ") — " + board.items_count + " items")
}
```
```js
// List boards in a specific workspace
var result = app.integrations.monday.list_boards({
  workspace_id: 98765,
  limit: 10,
})

for (const board of (result.boards)) {
  console.log(board.name + " [" + board.board_kind + "]")
}
```
---

### `app.integrations.monday.get_board(...)`

Get a single Monday.com board by ID. Returns full board details including all columns (with types) and groups. Use `list_boards` to discover board IDs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `board_id` | integer | yes | Board ID to retrieve. |

Returns: `id`, `name`, `description`, `board_kind`, `state`, `workspace`, `owner`, `items_count`, `columns` (array of tables with `id`, `title`, `type`, `archived`), `groups` (array of tables with `id`, `title`, `color`, `position`, `deleted`), `created_at`, `updated_at`.

```js
// Get a board with its columns and groups
var result = app.integrations.monday.get_board({ board_id: 12345678 })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log("Board: " + result.name)
  console.log("State: " + result.state)
  console.log("Items: " + String(result.items_count))

  console.log("\nColumns:")
  for (const col of (result.columns)) {
    console.log("  " + col.title + " (" + col.type + ") — ID: " + col.id)
  }

  console.log("\nGroups:")
  for (const grp of (result.groups)) {
    console.log("  " + grp.title + " [color: " + grp.color + "] — ID: " + grp.id)
  }
}
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

```js
// List the first 10 items on a board
var result = app.integrations.monday.list_items({
  board_id: 12345678,
  limit: 10,
})

for (const item of (result.items)) {
  var group = item.group && item.group.title || "—"
  console.log(item.name + " [state: " + item.state + ", group: " + group + "]")
}
```
```js
// Paginate through all items
var page = 1
var all_items = []

do {
  var result = app.integrations.monday.list_items({
    board_id: 12345678,
    limit: 100,
    page: page,
  })

  if (result.error) {
    console.log("Error: " + result.error)
    break
  }

  for (const item of (result.items)) {
    all_items.push(item)
  }

  page = page + 1
} while (!(result.items.length < 100));

console.log("Fetched " + all_items.length + " items total")
```
---

### `app.integrations.monday.get_item(...)`

Get a single Monday.com item by ID with all column values.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | Item ID to retrieve. |

Returns: `id`, `name`, `state`, `board` (table with `id`, `name`), `group` (table with `id`, `title`), `creator` (table with `id`, `name`), `column_values` (array of tables with `id`, `title`, `type`, `text`, `value`), `created_at`, `updated_at`.

```js
// Get an item with its column values
var result = app.integrations.monday.get_item({ item_id: 42 })

if (result.error) {
  console.log("Error: " + result.error)
} else {
  console.log("Item: " + result.name)
  console.log("Board: " + (result.board && result.board.name || "—"))
  console.log("Group: " + (result.group && result.group.title || "—"))
  console.log("State: " + result.state)

  console.log("\nColumn Values:")
  for (const cv of (result.column_values)) {
    console.log("  " + cv.title + " (" + cv.type + "): " + (cv.text || "—"))
  }
}
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

```js
// Create a simple item
var result = app.integrations.monday.create_item({
  board_id: 12345678,
  item_name: "New task from integration",
})

if (!result.error) {
  console.log("Created item: " + result.name + " (ID: " + result.id + ")")
}
```
```js
// Create an item with group and column values
var result = app.integrations.monday.create_item({
  board_id: 12345678,
  item_name: "Fix production bug",
  group_id: "topics",
  column_values: {
    status: "Working on it",
    priority: "High",
    date4: "2026-04-10",
  }
})

if (!result.error) {
  console.log("Created: " + result.name + " in group " + (result.group && result.group.title || "—"))
}
```
---

## Workspaces

### `app.integrations.monday.list_workspaces(...)`

List Monday.com workspaces the authenticated user has access to. Returns workspace name, kind, description, and subscriber counts.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max workspaces to return. Default: 50. |

Returns: `workspaces` (array), `total`. Each workspace contains: `id`, `name`, `description`, `kind`, `owners_count`, `subscribers_count`, `is_deleted`, `created_at`.

```js
// List all workspaces
var result = app.integrations.monday.list_workspaces({})

for (const ws of (result.workspaces)) {
  console.log(ws.name + " (" + ws.kind + ") — " + ws.subscribers_count + " subscribers")
}
```
---

## User

### `app.integrations.monday.get_current_user(...)`

Get the currently authenticated Monday.com user's profile, including ID, name, email, avatar URL, title, location, and timezone.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | This tool takes no parameters. Pass an empty table `{}`. |

Returns: `id`, `name`, `email`, `avatar_url`, `title`, `country_code`, `location`, `phone`, `timezone`, `join_date`, `enabled`.

```js
// Get the authenticated user's profile
var result = app.integrations.monday.get_current_user({})

console.log("Logged in as: " + result.name + " <" + result.email + ">")
console.log("Title: " + (result.title || "—"))
console.log("Timezone: " + (result.timezone || "—"))
console.log("User ID: " + result.id)
```
---

## Pagination

The `list_items` tool supports page-based pagination. The response includes:

| Field | Type | Description |
|-------|------|-------------|
| `page` | integer | Current page number. |
| `limit` | integer | Results per page. |

### Paginating through all items

```js
var items = []
var page = 1

do {
  var result = app.integrations.monday.list_items({
    board_id: 12345678,
    limit: 100,
    page: page,
  })

  if (result.error) {
    console.log("Error: " + result.error)
    break
  }

  for (const item of (result.items)) {
    items.push(item)
  }

  page = page + 1
} while (!(result.items.length < 100));

console.log("Fetched " + items.length + " items total")
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

```js
// Default account (always works)
app.integrations.monday.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.monday.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.monday.work.function_name({ /* parameters */ })
app.integrations.monday.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
