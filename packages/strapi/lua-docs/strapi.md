# Strapi — Lua API Reference

## strapi_list_entries

List entries for a content type in Strapi. Supports pagination, sorting, and population of relations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type (e.g., `"article"`, `"page"`, `"product"`) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of entries per page (default: 25) |
| `sort` | string | no | Sort field and direction (e.g., `"createdAt:desc"`, `"title:asc"`) |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name (e.g., `"author"`, `"image"`) |

### Examples

```lua
-- List all articles
local result = app.integrations.strapi.list_entries({
  content_type = "article",
  page_size = 10,
  sort = "createdAt:desc",
  populate = "*"
})

for _, entry in ipairs(result.data) do
  print(entry.id .. ": " .. entry.attributes.title)
end
```

```lua
-- List products with pagination
local result = app.integrations.strapi.list_entries({
  content_type = "product",
  page = 2,
  page_size = 50,
  populate = "image"
})
```

---

## strapi_get_entry

Get a single entry by content type and ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name |

### Examples

```lua
-- Get a single article with all relations
local result = app.integrations.strapi.get_entry({
  content_type = "article",
  id = 42,
  populate = "*"
})

print(result.data.attributes.title)
```

---

## strapi_create_entry

Create a new entry for a content type. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `data` | object | yes | The entry data (fields depend on the content type) |

### Examples

```lua
-- Create a new article
local result = app.integrations.strapi.create_entry({
  content_type = "article",
  data = {
    title = "Hello World",
    body = "This is my first article.",
    publishedAt = nil   -- set to nil for draft
  }
})

print("Created entry with ID: " .. result.data.id)
```

---

## strapi_update_entry

Update an existing entry by content type and ID. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to update |
| `data` | object | yes | The fields to update |

### Examples

```lua
-- Update an article's title
local result = app.integrations.strapi.update_entry({
  content_type = "article",
  id = 42,
  data = {
    title = "Updated Title"
  }
})
```

---

## strapi_delete_entry

Delete an entry by content type and ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to delete |

### Examples

```lua
local result = app.integrations.strapi.delete_entry({
  content_type = "article",
  id = 42
})

print(result.message)
```

---

## strapi_list_content_types

List all content types defined in the Strapi Content-Type Builder. Returns API IDs, display names, and schema information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.strapi.list_content_types()

for _, ct in ipairs(result.data) do
  print(ct.uid .. " — " .. ct.schema.displayName)
end
```

---

## strapi_get_current_user

Get the currently authenticated Strapi user. Useful for verifying the API token and checking permissions.

### Parameters

None.

### Examples

```lua
local result = app.integrations.strapi.get_current_user()

print("Connected as: " .. result.username .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Strapi instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.strapi.function_name({...})

-- Explicit default (portable across setups)
app.integrations.strapi.default.function_name({...})

-- Named accounts
app.integrations.strapi.production.function_name({...})
app.integrations.strapi.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
