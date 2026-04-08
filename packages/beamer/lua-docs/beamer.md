# Beamer — Lua API Reference

## list_posts

List changelog posts and announcements.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of posts to return (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `status` | string | no | Filter by status: `"published"`, `"draft"`, or `"scheduled"` |

### Example

```lua
local result = app.integrations.beamer.list_posts({
  limit = 10,
  page = 1,
  status = "published"
})

for _, post in ipairs(result) do
  print(post.title .. " (" .. post.date .. ")")
end
```

---

## get_post

Retrieve a single post by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The post ID |

### Example

```lua
local post = app.integrations.beamer.get_post({ id = 123 })
print(post.title)
print(post.content)
```

---

## create_post

Create a new changelog post or announcement.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The post title |
| `content` | string | yes | The post body content (HTML supported) |
| `category` | integer | no | The category ID to assign the post to |
| `date` | string | no | Publication date in ISO 8601 format (e.g., `"2025-06-01T12:00:00Z"`). Omit to publish immediately. |

### Example

```lua
local result = app.integrations.beamer.create_post({
  title = "New Feature: Dark Mode",
  content = "<p>We just launched dark mode support!</p>",
  category = 5
})

print("Created post with ID: " .. result.id)
```

### Schedule a post

```lua
local result = app.integrations.beamer.create_post({
  title = "Upcoming Maintenance",
  content = "<p>Scheduled maintenance window: June 15, 2025</p>",
  date = "2025-06-15T09:00:00Z"
})
```

---

## list_comments

List all comments on a specific post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | integer | yes | The post ID to list comments for |

### Example

```lua
local comments = app.integrations.beamer.list_comments({ post_id = 123 })

for _, comment in ipairs(comments) do
  print(comment.user.firstName .. ": " .. comment.text)
end
```

---

## get_current_user

Get the profile of the currently authenticated Beamer user. No parameters required.

### Example

```lua
local user = app.integrations.beamer.get_current_user({})
print("Connected as: " .. user.firstName .. " " .. user.lastName)
print("Email: " .. user.email)
```

---

## list_categories

List all post categories in your Beamer account. No parameters required.

### Example

```lua
local categories = app.integrations.beamer.list_categories({})

for _, cat in ipairs(categories) do
  print(cat.id .. ": " .. cat.name)
end
```

---

## Multi-Account Usage

If you have multiple Beamer accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.beamer.list_posts({})

-- Explicit default (portable across setups)
app.integrations.beamer.default.list_posts({})

-- Named accounts
app.integrations.beamer.production.list_posts({})
app.integrations.beamer.staging.list_posts({})
```

All functions are identical across accounts — only the credentials differ.
