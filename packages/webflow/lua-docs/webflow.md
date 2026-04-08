# Webflow — Lua API Reference

## list_sites

List all Webflow sites the authenticated user has access to.

### Parameters

None.

### Example

```lua
local result = app.integrations.webflow.list_sites({})

for _, site in ipairs(result.sites) do
  print(site.name .. " (" .. site.id .. ")")
end
```

---

## get_site

Get details for a specific Webflow site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the Webflow site |

### Example

```lua
local result = app.integrations.webflow.get_site({
  id = "641d84b8f0bca14670785897"
})

print(result.name)
print(result.domain)
```

---

## list_collections

List CMS collections for a Webflow site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The unique identifier of the Webflow site |
| `limit` | integer | no | Maximum number of collections to return (default: 100) |
| `offset` | integer | no | Number of collections to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.webflow.list_collections({
  site_id = "641d84b8f0bca14670785897"
})

for _, collection in ipairs(result.collections) do
  print(collection.displayName .. " (" .. collection.slug .. ")")
end
```

---

## list_items

List items in a Webflow CMS collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `limit` | integer | no | Maximum number of items to return (default: 100) |
| `offset` | integer | no | Number of items to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.webflow.list_items({
  collection_id = "641d84b8f0bca14670785901",
  limit = 10
})

for _, item in ipairs(result.items) do
  print(item.fieldData.name)
end
```

### Paginated example

```lua
local offset = 0
local limit = 50
local all_items = {}

repeat
  local result = app.integrations.webflow.list_items({
    collection_id = "641d84b8f0bca14670785901",
    limit = limit,
    offset = offset
  })

  for _, item in ipairs(result.items) do
    table.insert(all_items, item)
  end

  offset = offset + limit
until #result.items < limit
```

---

## get_item

Get a single CMS item from a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `id` | string | yes | The unique identifier of the CMS item |

### Example

```lua
local result = app.integrations.webflow.get_item({
  collection_id = "641d84b8f0bca14670785901",
  id = "641d84b8f0bca14670785905"
})

print(result.fieldData.name)
print(result.fieldData.slug)
```

---

## create_item

Create a new item in a Webflow CMS collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `fields` | object | yes | Field data as key-value pairs matching the collection schema |
| `live` | boolean | no | Whether to publish the item immediately (default: false) |

### Common Fields

| Field | Description |
|-------|-------------|
| `name` | Item display name |
| `slug` | URL slug (auto-generated from name if omitted) |
| `_draft` | Whether the item is a draft |
| `_archived` | Whether the item is archived |

Field names vary by collection. Use `list_collections` to inspect schema fields.

### Examples

#### Create a draft item

```lua
local result = app.integrations.webflow.create_item({
  collection_id = "641d84b8f0bca14670785901",
  fields = {
    name = "My New Blog Post",
    slug = "my-new-blog-post",
    _draft = true
  }
})

print("Created item: " .. result.id)
```

#### Create and publish immediately

```lua
local result = app.integrations.webflow.create_item({
  collection_id = "641d84b8f0bca14670785901",
  fields = {
    name = "Breaking News",
    slug = "breaking-news"
  },
  live = true
})

print("Published item: " .. result.id)
```

---

## get_current_user

Get the currently authenticated Webflow user.

### Parameters

None.

### Example

```lua
local result = app.integrations.webflow.get_current_user({})

print(result.user.email)
print(result.user.firstName .. " " .. result.user.lastName)
```

---

## Multi-Account Usage

If you have multiple Webflow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.webflow.list_sites({})

-- Explicit default (portable across setups)
app.integrations.webflow.default.list_sites({})

-- Named accounts
app.integrations.webflow.production.list_sites({})
app.integrations.webflow.staging.list_sites({})
```

All functions are identical across accounts — only the credentials differ.
