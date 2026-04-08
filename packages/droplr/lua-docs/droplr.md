# Droplr — Lua API Reference

## list_drops

List drops (short links, files, images, notes) from Droplr with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 20, max: 100) |
| `type` | string | no | Filter by drop type: `LINK`, `IMAGE`, `FILE`, or `NOTE` |
| `q` | string | no | Search query to filter drops by title or content |

### Examples

```lua
-- List recent drops
local result = app.integrations.droplr.list_drops({
  limit = 10
})

for _, drop in ipairs(result.drops) do
  print(drop.title .. ": " .. drop.short_url)
end

-- Search for links containing "docs"
local result = app.integrations.droplr.list_drops({
  q = "docs",
  type = "LINK"
})
```

---

## get_drop

Get details of a specific drop by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The drop ID (short code, e.g., `"abc123"`) |

### Examples

```lua
local result = app.integrations.droplr.get_drop({
  id = "abc123"
})

print(result.title)
print(result.long_url)
print(result.short_url)
print(result.type)
print(result.created_at)
```

---

## create_drop

Create a new drop (short link) in Droplr.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `link` | string | yes | The long URL to shorten |
| `title` | string | no | Optional title for the drop |
| `variant` | string | no | Variant type: `"redirect"` (default) or `"frame"` (embeds in a frame) |

### Examples

```lua
-- Create a simple short link
local result = app.integrations.droplr.create_drop({
  link = "https://example.com/very/long/url"
})

print("Short URL: " .. result.short_url)

-- Create a titled short link with frame variant
local result = app.integrations.droplr.create_drop({
  link = "https://example.com/docs",
  title = "Documentation",
  variant = "frame"
})
```

---

## delete_drop

Delete a drop permanently from Droplr.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The drop ID to delete (short code, e.g., `"abc123"`) |

### Examples

```lua
local result = app.integrations.droplr.delete_drop({
  id = "abc123"
})

print(result) -- "Drop 'abc123' has been deleted."
```

---

## list_boards

List boards (collections of drops) from Droplr.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 20) |

### Examples

```lua
local result = app.integrations.droplr.list_boards({
  limit = 10
})

for _, board in ipairs(result.boards) do
  print(board.name .. " (" .. board.drops_count .. " drops)")
end
```

---

## get_current_user

Get the authenticated Droplr user's profile information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.droplr.get_current_user({})

print("Name: " .. result.name)
print("Email: " .. result.email)
print("Plan: " .. result.plan)
```

---

## Multi-Account Usage

If you have multiple Droplr accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.droplr.function_name({...})

-- Explicit default (portable across setups)
app.integrations.droplr.default.function_name({...})

-- Named accounts
app.integrations.droplr.work.function_name({...})
app.integrations.droplr.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
