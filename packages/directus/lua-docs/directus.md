# Directus — Lua API Reference

## list_items

List items in a Directus collection with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection name to query (e.g. `"articles"`, `"products"`). |
| `limit` | integer | no | Maximum number of items to return (default: 100). |
| `offset` | integer | no | Number of items to skip for pagination. |
| `sort` | string | no | Sort field(s). Prefix with `"-"` for descending (e.g. `"-date_created"`). |
| `filter` | object | no | Directus filter object. E.g. `{status = {_eq = "published"}}`. |
| `fields` | string | no | Comma-separated list of fields to include in the response. |
| `search` | string | no | Search query to filter items across searchable fields. |
| `page` | integer | no | Page number for pagination (alternative to offset). |
| `meta` | string | no | Metadata to include. Use `"total_count"` to get total matching items. |

### Filter Syntax

Directus filters use an object notation with operators:

```lua
filter = {
  status = { _eq = "published" },
  views = { _gte = 100 }
}
```

Common operators: `_eq`, `_neq`, `_lt`, `_lte`, `_gt`, `_gte`, `_contains`, `_ncontains`, `_in`, `_null`

### Examples

```lua
local result = app.integrations.directus.list_items({
  collection = "articles",
  limit = 10,
  sort = "-date_created",
  fields = "id,title,slug,date_created"
})

for _, item in ipairs(result.data) do
  print(item.title)
end
```

```lua
-- With filter
local result = app.integrations.directus.list_items({
  collection = "products",
  filter = {
    category = { _eq = "electronics" },
    price = { _lte = 100 }
  },
  sort = "price",
  limit = 20
})
```

```lua
-- Search across fields
local result = app.integrations.directus.list_items({
  collection = "articles",
  search = "climate change",
  limit = 5
})
```

---

## get_item

Retrieve a single item from a Directus collection by its primary key ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection name (e.g. `"articles"`, `"products"`). |
| `id` | string | yes | The primary key of the item to retrieve. |
| `fields` | string | no | Comma-separated list of fields to include in the response. |

### Examples

```lua
local item = app.integrations.directus.get_item({
  collection = "articles",
  id = "42",
  fields = "id,title,body,author"
})

print(item.data.title)
```

---

## create_item

Create a new item in a Directus collection with the provided field values.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection name (e.g. `"articles"`, `"products"`). |
| `data` | object | yes | Object containing the field values for the new item. Keys are field names, values are the field data. |

### Examples

```lua
local item = app.integrations.directus.create_item({
  collection = "articles",
  data = {
    title = "My New Article",
    body = "Article content here...",
    status = "draft"
  }
})

print("Created with ID: " .. item.data.id)
```

---

## update_item

Update an existing item in a Directus collection by its primary key ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection name (e.g. `"articles"`, `"products"`). |
| `id` | string | yes | The primary key of the item to update. |
| `data` | object | yes | Object containing the field values to update. Keys are field names, values are the new data. |

### Examples

```lua
local item = app.integrations.directus.update_item({
  collection = "articles",
  id = "42",
  data = {
    title = "Updated Title",
    status = "published"
  }
})

print("Updated: " .. item.data.title)
```

---

## delete_item

Delete an item from a Directus collection by its primary key ID. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection name (e.g. `"articles"`, `"products"`). |
| `id` | string | yes | The primary key of the item to delete. |

### Examples

```lua
app.integrations.directus.delete_item({
  collection = "articles",
  id = "42"
})

print("Item deleted")
```

---

## list_collections

List all available collections (tables) in the Directus instance. Returns collection names and metadata.

### Parameters

None.

### Examples

```lua
local result = app.integrations.directus.list_collections()

for _, col in ipairs(result.data) do
  print(col.collection .. " — " .. (col.meta.icon or "no icon"))
end
```

---

## get_current_user

Get the profile of the currently authenticated Directus user. Useful for verifying the connection and understanding user permissions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated list of user fields to include (e.g. `"id,email,first_name,last_name,role"`). |

### Examples

```lua
local result = app.integrations.directus.get_current_user()

print("Logged in as: " .. result.data.email)
print("Role: " .. (result.data.role or "unknown"))
```

---

## Multi-Account Usage

If you have multiple directus accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.directus.function_name({...})

-- Explicit default (portable across setups)
app.integrations.directus.default.function_name({...})

-- Named accounts
app.integrations.directus.production.function_name({...})
app.integrations.directus.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
