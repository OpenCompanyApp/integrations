# Notion — Lua API Reference

Notion is a workspace for wikis, docs, and databases. This integration lets you search, create, update, and archive pages; manage databases and query rows; manipulate content blocks; read users; and work with comments — all from Lua scripts.

## Authentication

Uses a **Notion Internal Integration Secret** (starts with `secret_…`). Configure it in your integration settings. The integration must be explicitly shared with any pages or databases you want to access — in Notion, open a page → **⋯** → **Connections** → add your integration. Unshared resources return `object_not_found` errors.

---

## Overview

All tools are called via `app.integrations.notion.<tool_name>({ ... })`. Every function takes a single Lua table of named parameters and returns a result table.

```lua
local result = app.integrations.notion.search({ query = "meeting notes" })
```

Errors surface as `result.error` (string). Check for it before using the response.

---

## Search

### `app.integrations.notion.search(...)`

Search pages and databases in the Notion workspace. Returns matching results with IDs, types, titles, and URLs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query text |
| `filter_type` | string | no | Filter by object type: `"page"` or `"database"` |
| `sort_direction` | string | no | `"ascending"` or `"descending"` (default: descending by last edited time) |
| `page_size` | integer | no | Results per page, max 100, default 10 |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
-- Search for pages matching "meeting notes"
local result = app.integrations.notion.search({
  query = "meeting notes",
  filter_type = "page",
  page_size = 5
})

for _, item in ipairs(result.results) do
  print(item.title, item.url)
end
```

```lua
-- Search for databases only, sorted oldest first
local result = app.integrations.notion.search({
  filter_type = "database",
  sort_direction = "ascending"
})
```

---

## Pages

### `app.integrations.notion.create_page(...)`

Create a new page in Notion — either as a row in a database or as a sub-page under another page.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent_type` | string | yes | `"database"` or `"page"` |
| `parent_id` | string | yes | ID of the parent database or page |
| `properties` | string | no | Page properties as a JSON object. For database parents, keys must match database property names |
| `children` | string | no | Page content as a JSON array of block objects |

```lua
-- Create a database row (page in a database)
local result = app.integrations.notion.create_page({
  parent_type = "database",
  parent_id = "abc123def456",
  properties = '{"Name": {"title": [{"text": {"content": "New Task"}}]}, "Status": {"select": {"name": "Todo"}}}'
})

print(result.id, result.url)
```

```lua
-- Create a sub-page under an existing page with content
local result = app.integrations.notion.create_page({
  parent_type = "page",
  parent_id = "page123abc",
  children = '[{"object":"block","type":"heading_2","heading_2":{"rich_text":[{"type":"text","text":{"content":"Section Title"}}]}},{"object":"block","type":"paragraph","paragraph":{"rich_text":[{"type":"text","text":{"content":"Some body text here."}}]}}]'
})

print(result.id, result.url)
```

### `app.integrations.notion.get_page(...)`

Retrieve a page by its ID. Returns the full page object including properties, title, icon, cover, parent info, and timestamps.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The ID of the page to retrieve |

```lua
local result = app.integrations.notion.get_page({
  page_id = "abc123def456"
})

print(result.url, result.created_time)
-- result.properties contains all page properties
```

### `app.integrations.notion.update_page(...)`

Update properties on a page and/or change its archived status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The ID of the page to update |
| `properties` | string | no | Properties to update as a JSON object matching the page/database schema |
| `archived` | boolean | no | Set to `true` to archive or `false` to unarchive |

```lua
-- Update a page's Status property
local result = app.integrations.notion.update_page({
  page_id = "abc123def456",
  properties = '{"Status": {"select": {"name": "Done"}}}'
})

print(result.id, result.last_edited_time)
```

```lua
-- Unarchive a previously archived page
local result = app.integrations.notion.update_page({
  page_id = "abc123def456",
  archived = false
})
```

### `app.integrations.notion.archive_page(...)`

Archive a page by setting its archived flag to `true`. To restore, use `notion_update_page` with `archived = false`.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The ID of the page to archive |

```lua
local result = app.integrations.notion.archive_page({
  page_id = "abc123def456"
})

print(result.id, result.archived)
```

---

## Databases

### `app.integrations.notion.create_database(...)`

Create a new database as a child of a page. You define the property schema (columns) at creation time.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent_id` | string | yes | ID of the parent page where the database will be created |
| `title` | string | yes | Title of the new database |
| `properties` | string | yes | Database property schema as a JSON object. Each key is a property name with its type configuration |

```lua
local result = app.integrations.notion.create_database({
  parent_id = "page123abc",
  title = "Project Tracker",
  properties = '{"Name": {"title": {}}, "Status": {"select": {"options": [{"name": "Todo"}, {"name": "In Progress"}, {"name": "Done"}]}}, "Priority": {"select": {"options": [{"name": "Low"}, {"name": "Medium"}, {"name": "High"}]}}, "Due Date": {"date": {}}}'
})

print(result.id, result.url)
```

### `app.integrations.notion.get_database(...)`

Retrieve a database's full schema by its ID, including all property definitions (columns), title, and parent info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The ID of the database to retrieve |

```lua
local result = app.integrations.notion.get_database({
  database_id = "db123abc456"
})

-- result.properties contains all column definitions
-- result.title contains the database title
```

### `app.integrations.notion.update_database(...)`

Update a database's title and/or property schema. Only included fields are changed.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The ID of the database to update |
| `title` | string | no | New title for the database |
| `properties` | string | no | Updated property schema as a JSON object. Only included properties will be changed |

```lua
-- Rename the database and add a new column
local result = app.integrations.notion.update_database({
  database_id = "db123abc456",
  title = "Project Tracker 2025",
  properties = '{"Tags": {"multi_select": {"options": [{"name": "Design"}, {"name": "Engineering"}, {"name": "Marketing"}]}}}'
})
```

### `app.integrations.notion.query_database(...)`

Query a database to retrieve rows (pages). Supports filtering, sorting, and pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The ID of the database to query |
| `filter` | string | no | Filter condition as a JSON object, e.g. `{"property": "Status", "select": {"equals": "Done"}}` |
| `sorts` | string | no | Sort rules as a JSON array, e.g. `[{"property": "Name", "direction": "ascending"}]` |
| `page_size` | integer | no | Number of results per page (max 100, default 100) |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
-- Query tasks where Status is "Todo", sorted by Due Date
local result = app.integrations.notion.query_database({
  database_id = "db123abc456",
  filter = '{"property": "Status", "select": {"equals": "Todo"}}',
  sorts = '[{"property": "Due Date", "direction": "ascending"}]',
  page_size = 25
})

print("Found " .. result.count .. " tasks")
for _, row in ipairs(result.results) do
  print(row.id, row.url)
end
```

```lua
-- Compound filter: Status is "In Progress" AND Priority is "High"
local result = app.integrations.notion.query_database({
  database_id = "db123abc456",
  filter = '{"and": [{"property": "Status", "select": {"equals": "In Progress"}}, {"property": "Priority", "select": {"equals": "High"}}]}'
})
```

### `app.integrations.notion.list_databases(...)`

List all databases accessible to the integration. Uses the search endpoint filtered to database objects. Optionally filter by name.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query to filter database names |
| `page_size` | integer | no | Number of results per page (max 100, default 10) |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
local result = app.integrations.notion.list_databases({
  query = "projects"
})

for _, db in ipairs(result.databases) do
  print(db.id, db.title, db.url)
end
```

---

## Blocks

### `app.integrations.notion.get_block_children(...)`

Get the child blocks of a page or block. Returns a list of block objects with IDs, types, and `has_children` flags. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | ID of the block or page to get children for |
| `page_size` | integer | no | Number of results per page (max 100, default 100) |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
-- Read all top-level blocks on a page
local result = app.integrations.notion.get_block_children({
  block_id = "page123abc",
  page_size = 100
})

for _, block in ipairs(result.results) do
  print(block.id, block.type, block.has_children)
end

-- result.raw contains the full block data including text content
```

### `app.integrations.notion.append_block_children(...)`

Append blocks to a page or existing block. Provide `children` as a JSON array of block objects.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | ID of the parent block or page to append children to |
| `children` | string | yes | Array of block objects to append, as a JSON string |

```lua
-- Add a heading and a paragraph to a page
local result = app.integrations.notion.append_block_children({
  block_id = "page123abc",
  children = '[{"object":"block","type":"heading_2","heading_2":{"rich_text":[{"type":"text","text":{"content":"New Section"}}]}},{"object":"block","type":"paragraph","paragraph":{"rich_text":[{"type":"text","text":{"content":"Content goes here."}}]}}]'
})

print("Appended " .. result.count .. " blocks")
```

```lua
-- Add a to-do list
local result = app.integrations.notion.append_block_children({
  block_id = "page123abc",
  children = '[{"object":"block","type":"to_do","to_do":{"rich_text":[{"type":"text","text":{"content":"Review draft"}}],"checked":false}},{"object":"block","type":"to_do","to_do":{"rich_text":[{"type":"text","text":{"content":"Submit for approval"}}],"checked":false}}]'
})
```

```lua
-- Add a bulleted list
local result = app.integrations.notion.append_block_children({
  block_id = "page123abc",
  children = '[{"object":"block","type":"bulleted_list_item","bulleted_list_item":{"rich_text":[{"type":"text","text":{"content":"First item"}}]}},{"object":"block","type":"bulleted_list_item","bulleted_list_item":{"rich_text":[{"type":"text","text":{"content":"Second item"}}]}}]'
})
```

### `app.integrations.notion.get_block(...)`

Retrieve a single block by its ID. Returns the full block object including type-specific content, `has_children`, and parent info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | The ID of the block to retrieve |

```lua
local result = app.integrations.notion.get_block({
  block_id = "block123abc"
})

print(result.id, result.type, result.has_children)
-- Type-specific content is under result[result.type]
-- e.g. result.paragraph.rich_text for a paragraph block
```

### `app.integrations.notion.update_block(...)`

Update a block's content or archived state. Provide the block type and type-specific content to change.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | The ID of the block to update |
| `type` | string | no | Block type to update (e.g. `"paragraph"`, `"heading_1"`, `"to_do"`) |
| `content` | string | no | Type-specific content as a JSON object, e.g. `'{"rich_text": [{"text": {"content": "Updated text"}}]}'` |
| `archived` | boolean | no | Set to `true` to archive the block |

```lua
-- Update a paragraph block's text
local result = app.integrations.notion.update_block({
  block_id = "block123abc",
  type = "paragraph",
  content = '{"rich_text": [{"text": {"content": "Updated paragraph text."}}]}'
})

print(result.id, result.type, result.updated)
```

```lua
-- Check a to-do item
local result = app.integrations.notion.update_block({
  block_id = "block123abc",
  type = "to_do",
  content = '{"rich_text": [{"text": {"content": "Review draft"}}], "checked": true}'
})
```

### `app.integrations.notion.delete_block(...)`

Delete a block by its ID. Permanently removes the block (top-level pages are moved to trash).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | The ID of the block to delete |

```lua
local result = app.integrations.notion.delete_block({
  block_id = "block123abc"
})

print(result.id, result.deleted)
```

---

## Users

### `app.integrations.notion.get_current_user(...)`

Get information about the current integration bot user. Returns the bot's name, avatar, and workspace info.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | | | |

```lua
local result = app.integrations.notion.get_current_user({})

print(result.name, result.type, result.avatar_url)
-- result.bot contains bot-specific info
```

### `app.integrations.notion.list_users(...)`

List all users in the Notion workspace. Returns user IDs, names, types, and avatar URLs. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (max 100, default 100) |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
local result = app.integrations.notion.list_users({
  page_size = 50
})

for _, user in ipairs(result.users) do
  print(user.id, user.name, user.type)
end
```

### `app.integrations.notion.get_user(...)`

Retrieve a single user by their ID. Returns name, type, avatar URL, and email (if available).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The ID of the user to retrieve |

```lua
local result = app.integrations.notion.get_user({
  user_id = "user123abc"
})

print(result.name, result.type, result.avatar_url)
```

---

## Comments

### `app.integrations.notion.create_comment(...)`

Create a comment on a Notion page. Start a new discussion with `parent_id`, or reply to an existing discussion with `discussion_id`.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent_id` | string | conditional | Page ID to comment on. Required if `discussion_id` is not provided |
| `discussion_id` | string | conditional | Discussion ID to reply to. Required if `parent_id` is not provided |
| `body_text` | string | conditional | Simple text content for the comment. Required if `body_children` is not provided |
| `body_children` | string | conditional | Rich text block content as a JSON array. Required if `body_text` is not provided |

```lua
-- Add a simple text comment to a page
local result = app.integrations.notion.create_comment({
  parent_id = "page123abc",
  body_text = "Looks good to me! Ready to merge."
})

print(result.id, result.created_time)
```

```lua
-- Reply to an existing discussion with rich content
local result = app.integrations.notion.create_comment({
  discussion_id = "discussion789",
  body_children = '[{"text": {"content": "Updated with "}}, {"text": {"content": "new findings"}, "annotations": {"bold": true}}]'
})
```

### `app.integrations.notion.get_comments(...)`

Retrieve all comments on a page or block. Returns comment text, authors, timestamps, and discussion IDs. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `block_id` | string | yes | The ID of the block or page to get comments for |
| `page_size` | integer | no | Number of results per page (max 100, default 100) |
| `start_cursor` | string | no | Pagination cursor from a previous response |

```lua
local result = app.integrations.notion.get_comments({
  block_id = "page123abc"
})

for _, comment in ipairs(result.comments) do
  print(comment.created_time, comment.text, comment.created_by.id)
end
```

---

## Pagination

Several endpoints return paginated results. When `has_more` is `true`, use `next_cursor` to fetch the next page.

```lua
local all_results = {}
local cursor = nil

repeat
  local params = {
    database_id = "db123abc456",
    page_size = 100
  }
  if cursor then
    params.start_cursor = cursor
  end

  local result = app.integrations.notion.query_database(params)

  for _, row in ipairs(result.results) do
    table.insert(all_results, row)
  end

  cursor = result.next_cursor
until not result.has_more

print("Total rows: " .. #all_results)
```

This pagination pattern applies to:

- `notion_search`
- `notion_query_database`
- `notion_list_databases`
- `notion_get_block_children`
- `notion_list_users`
- `notion_get_comments`

---

## Notes

- **Object IDs** — Notion IDs can be passed with or without hyphens (`abc123def456…` or `abc123de-f456-…`).
- **JSON parameters** — Complex structures (`properties`, `filter`, `sorts`, `children`, `content`) are passed as JSON strings. Use single-quoted Lua strings to wrap JSON.
- **Block types** — Common block types: `paragraph`, `heading_1`, `heading_2`, `heading_3`, `bulleted_list_item`, `numbered_list_item`, `to_do`, `toggle`, `quote`, `callout`, `code`, `divider`, `image`.
- **Rate limits** — The Notion API enforces rate limits (approx. 3 requests/sec). If you hit limits, add delays between calls.
- **Integration scope** — The integration can only access pages and databases it has been explicitly added to via **Connections** in Notion.
- **Archiving vs. deleting** — Pages are archived (recoverable). Blocks are permanently deleted.
- **Database rows are pages** — Each row in a Notion database is a page object. Use `notion_query_database` to list rows and `notion_update_page` to modify row properties.
