# HTTP client for the Confluence Cloud REST API — Lua API Reference

## confluence_add_comment

Add a comment to a Confluence page. Requires the page ID and comment body in HTML..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to comment on. |
| `body` | string | yes | The comment body in Confluence storage format (HTML). Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_add_comment({
  page_id = ""
  body = ""
})
```

## confluence_add_labels

Add one or more labels to a Confluence page. Labels are provided as an array of name strings..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |
| `labels` | array | yes | Array of label name strings to add. Example: [ |

### Example

```lua
local result = app.integrations.confluence.confluence_add_labels({
  page_id = ""
  labels = {}
})
```

## confluence_create_page

Create a new page in a Confluence space. Requires space_key, title, and body (HTML). Optionally specify a parent page ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_key` | string | yes | The space key (e.g.  |
| `title` | string | yes | The title of the page. |
| `body` | string | yes | The page body in Confluence storage format (HTML). Example:  |
| `parent_id` | string | no | Optional parent page ID to nest the new page under. |
| `type` | string | no | Content type. Default:  |

### Example

```lua
local result = app.integrations.confluence.confluence_create_page({
  space_key = ""
  title = ""
  body = ""
})
```

## confluence_delete_page

Delete a Confluence page by its ID. This action moves the page to the trash..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to delete. |

### Example

```lua
local result = app.integrations.confluence.confluence_delete_page({
  page_id = ""
})
```

## confluence_get_labels

Get the labels attached to a Confluence page by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |

### Example

```lua
local result = app.integrations.confluence.confluence_get_labels({
  page_id = ""
})
```

## confluence_get_page

Get details for a specific Confluence page by ID. Returns title, body, version, space, and other metadata..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_get_page({
  page_id = ""
  expand = ""
})
```

## confluence_get_page_ancestors

Get the ancestor (parent) pages of a Confluence page by its ID. Returns the full ancestor hierarchy..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page. |

### Example

```lua
local result = app.integrations.confluence.confluence_get_page_ancestors({
  page_id = ""
})
```

## confluence_get_page_children

Get the child pages of a Confluence page by its ID. Supports pagination and property expansion..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the parent page. |
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_get_page_children({
  page_id = ""
  limit = 0
  start = 0
})
```

## confluence_get_space

Get details for a specific Confluence space by its key..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_key` | string | yes | The space key (e.g.  |

### Example

```lua
local result = app.integrations.confluence.confluence_get_space({
  space_key = ""
})
```

## confluence_get_spaces

List Confluence spaces accessible to the authenticated user. Supports pagination and filtering by type and status..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `type` | string | no | Space type filter. Example:  |
| `status` | string | no | Space status filter. Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_get_spaces({
  limit = 0
  start = 0
  type = ""
})
```

## confluence_search_pages

Search for Confluence content using CQL (Confluence Query Language). Examples: \.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cql` | string | yes | CQL query string. Example: \ |
| `limit` | integer | no | Maximum number of results per page. Default: 25. |
| `start` | integer | no | Start offset for pagination. Default: 0. |
| `expand` | string | no | Comma-separated list of properties to expand. Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_search_pages({
  cql = ""
  limit = 0
  start = 0
})
```

## confluence_update_page

Update an existing Confluence page. Requires page_id, title, body, and the new version number (current version + 1)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The content ID of the page to update. |
| `title` | string | yes | The updated title of the page. |
| `body` | string | yes | The updated page body in Confluence storage format (HTML). |
| `version` | integer | yes | The new version number (must be current version + 1). |
| `status` | string | no | Optional status. Example:  |

### Example

```lua
local result = app.integrations.confluence.confluence_update_page({
  page_id = ""
  title = ""
  body = ""
})
```

---

## Multi-Account Usage

If you have multiple confluence accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.confluence.function_name({...})

-- Explicit default (portable across setups)
app.integrations.confluence.default.function_name({...})

-- Named accounts
app.integrations.confluence.work.function_name({...})
app.integrations.confluence.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
