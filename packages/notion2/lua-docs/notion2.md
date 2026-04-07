# Client for the Notion REST API — Lua API Reference

## notion2_list_pages

Search and list pages in your Notion workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter pages by title. |
| `filter` | object | no | Filter object, e.g. `{"property":"object","value":"page"}`. |
| `sort` | object | no | Sort object, e.g. `{"direction":"descending","timestamp":"last_edited_time"}`. |
| `start_cursor` | string | no | Cursor for pagination from a previous response. |
| `page_size` | integer | no | Number of results per page (1–100, default 100). |

### Example

```lua
local result = app.integrations.notion2.notion2_list_pages({
  query = ""
})
```

## notion2_get_page

Get detailed information about a Notion page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The ID of the Notion page (UUID). |

### Example

```lua
local result = app.integrations.notion2.notion2_get_page({
  page_id = ""
})
```

## notion2_create_page

Create a new page in Notion.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | object | yes | Parent object, e.g. `{"page_id":"..."}` or `{"database_id":"..."}`. |
| `properties` | object | no | Page property values (title, etc.). |
| `children` | array | no | Array of block objects to append as page content. |
| `icon` | object | no | Icon for the page (emoji or external). |
| `cover` | object | no | Cover image for the page. |

### Example

```lua
local result = app.integrations.notion2.notion2_create_page({
  parent = { page_id = "" }
})
```

## notion2_list_databases

List databases in your Notion workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter databases by title. |
| `sort` | object | no | Sort object, e.g. `{"direction":"descending","timestamp":"last_edited_time"}`. |
| `start_cursor` | string | no | Cursor for pagination from a previous response. |
| `page_size` | integer | no | Number of results per page (1–100, default 100). |

### Example

```lua
local result = app.integrations.notion2.notion2_list_databases({
  query = ""
})
```

## notion2_query_database

Query a Notion database with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The ID of the Notion database to query (UUID). |
| `filter` | object | no | Filter object to narrow results. |
| `sorts` | array | no | Array of sort objects. |
| `start_cursor` | string | no | Cursor for pagination from a previous response. |
| `page_size` | integer | no | Number of results per page (1–100, default 100). |

### Example

```lua
local result = app.integrations.notion2.notion2_query_database({
  database_id = ""
})
```

## notion2_list_users

List all users in your Notion workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_cursor` | string | no | Cursor for pagination from a previous response. |
| `page_size` | integer | no | Number of results per page (1–100, default 100). |

### Example

```lua
local result = app.integrations.notion2.notion2_list_users({})
```

## notion2_get_current_user

Get the currently authenticated Notion user/bot.

### Parameters

None.

### Example

```lua
local result = app.integrations.notion2.notion2_get_current_user({})
```
