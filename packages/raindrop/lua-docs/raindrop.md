# Raindrop.io — Lua API Reference

## list_bookmarks

List bookmarks with optional collection and search filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | integer | no | Collection ID to filter by. `0` = all, `-1` = unsorted, `-99` = trash |
| `search` | string | no | Search query to filter bookmarks |
| `page` | integer | no | Page number (starts at 1, default: 1) |
| `per_page` | integer | no | Results per page (max 50, default: 25) |

### Examples

#### List all bookmarks (first page)

```lua
local result = app.integrations.raindrop.list_bookmarks({})

for _, item in ipairs(result.items) do
  print(item.title .. " -> " .. item.link)
end
```

#### Search bookmarks

```lua
local result = app.integrations.raindrop.list_bookmarks({
  search = "laravel"
})
```

#### Bookmarks in a specific collection

```lua
local result = app.integrations.raindrop.list_bookmarks({
  collection_id = 12345,
  page = 2,
  per_page = 50
})
```

---

## get_bookmark

Get full details of a single bookmark.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The bookmark ID |

### Example

```lua
local result = app.integrations.raindrop.get_bookmark({ id = 12345 })
local bm = result.item
print(bm.title)
print(bm.link)
print(bm.excerpt)
```

---

## create_bookmark

Save a new bookmark.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `link` | string | yes | The URL to bookmark |
| `title` | string | no | Title override (auto-detected if omitted) |
| `tags` | array | no | Tags to assign (array of strings) |
| `collection_id` | integer | no | Target collection ID (0 = Unsorted) |
| `excerpt` | string | no | Short description or note |

### Example

```lua
local result = app.integrations.raindrop.create_bookmark({
  link = "https://laravel.com/docs",
  title = "Laravel Documentation",
  tags = { "php", "framework", "docs" },
  collection_id = 42,
  excerpt = "Official Laravel documentation"
})
```

---

## update_bookmark

Update an existing bookmark's fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The bookmark ID |
| `link` | string | no | New URL |
| `title` | string | no | New title |
| `tags` | array | no | Replace tags |
| `collection_id` | integer | no | Move to a different collection |
| `excerpt` | string | no | New description or note |

### Example

```lua
local result = app.integrations.raindrop.update_bookmark({
  id = 12345,
  title = "Updated Title",
  tags = { "updated", "important" }
})
```

---

## list_collections

List all bookmark collections (folders).

### Parameters

None.

### Example

```lua
local result = app.integrations.raindrop.list_collections({})

for _, col in ipairs(result.items) do
  print(col.title .. " (ID: " .. col._id .. ", count: " .. col.count .. ")")
end
```

---

## get_collection

Get details of a specific collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The collection ID |

### Example

```lua
local result = app.integrations.raindrop.get_collection({ id = 42 })
local col = result.item
print(col.title .. " — " .. col.count .. " bookmarks")
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.raindrop.get_current_user({})
local user = result.user
print(user.fullName .. " (" .. user.email .. ")")
print("Plan: " .. user.pro .. " | Storage: " .. user.usedSpace .. " bytes")
```

---

## Multi-Account Usage

If you have multiple Raindrop.io accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.raindrop.list_bookmarks({})

-- Explicit default (portable across setups)
app.integrations.raindrop.default.list_bookmarks({})

-- Named accounts
app.integrations.raindrop.work.list_bookmarks({})
app.integrations.raindrop.personal.list_bookmarks({})
```

All functions are identical across accounts — only the credentials differ.
