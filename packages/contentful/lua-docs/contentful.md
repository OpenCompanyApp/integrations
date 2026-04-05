# Client for the Contentful Content Management API covering content types, entries, assets, and space info — Lua API Reference

## contentful_create_content_type

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Internal name of the content type (e.g.  |
| `display_name` | string | yes | Human-readable display name (e.g.  |
| `description` | string | no | Description of the content type. |
| `fields` | string | yes | JSON array of field definitions. Each field needs id, name, and type. Example: [{ |

### Example

```lua
local result = app.integrations.contentful.contentful_create_content_type({
  name = ""
  display_name = ""
  description = ""
})
```

## contentful_create_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type_id` | string | yes | The content type ID for the new entry. |
| `fields` | string | yes | JSON object of localized field values. E.g. { |

### Example

```lua
local result = app.integrations.contentful.contentful_create_entry({
  content_type_id = ""
  fields = ""
})
```

## contentful_delete_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The ID of the entry to delete. |

### Example

```lua
local result = app.integrations.contentful.contentful_delete_entry({
  entry_id = ""
})
```

## contentful_get_content_type

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type_id` | string | yes | The ID of the content type to retrieve. |

### Example

```lua
local result = app.integrations.contentful.contentful_get_content_type({
  content_type_id = ""
})
```

## contentful_get_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The ID of the entry to retrieve. |

### Example

```lua
local result = app.integrations.contentful.contentful_get_entry({
  entry_id = ""
})
```

## contentful_get_space

No description.

### Example

```lua
local result = app.integrations.contentful.contentful_get_space({
})
```

## contentful_list_assets

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of assets to return (default 100). |
| `skip` | integer | no | Number of assets to skip for pagination. |

### Example

```lua
local result = app.integrations.contentful.contentful_list_assets({
  limit = 0
  skip = 0
})
```

## contentful_list_content_types

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of content types to return (default 100). |

### Example

```lua
local result = app.integrations.contentful.contentful_list_content_types({
  limit = 0
})
```

## contentful_list_entries

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | no | Filter entries by content type ID. |
| `limit` | integer | no | Maximum number of entries to return (default 100, max 1000). |
| `skip` | integer | no | Number of entries to skip for pagination. |
| `order` | string | no | Order entries by field. Prefix with  |
| `query` | string | no | Full-text search query to filter entries. |

### Example

```lua
local result = app.integrations.contentful.contentful_list_entries({
  content_type = ""
  limit = 0
  skip = 0
})
```

## contentful_publish_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The ID of the entry to publish. |
| `version` | integer | yes | Current version of the entry (required for optimistic locking). |

### Example

```lua
local result = app.integrations.contentful.contentful_publish_entry({
  entry_id = ""
  version = 0
})
```

## contentful_unpublish_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The ID of the entry to unpublish. |
| `version` | integer | yes | Current version of the entry (required for optimistic locking). |

### Example

```lua
local result = app.integrations.contentful.contentful_unpublish_entry({
  entry_id = ""
  version = 0
})
```

## contentful_update_entry

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `entry_id` | string | yes | The ID of the entry to update. |
| `fields` | string | yes | JSON object of localized field values to update. E.g. { |
| `version` | integer | yes | Current version of the entry (required for optimistic locking). Get this from the entry\ |

### Example

```lua
local result = app.integrations.contentful.contentful_update_entry({
  entry_id = ""
  fields = ""
  version = 0
})
```

---

## Multi-Account Usage

If you have multiple contentful accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.contentful.function_name({...})

-- Explicit default (portable across setups)
app.integrations.contentful.default.function_name({...})

-- Named accounts
app.integrations.contentful.work.function_name({...})
app.integrations.contentful.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
