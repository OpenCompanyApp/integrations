# Ghost CMS — Lua API Reference

## list_posts

List blog posts with filtering, pagination, and ordering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Posts per page (default: 15, max: 100) |
| `filter` | string | no | Ghost filter syntax (see below) |
| `tag` | string | no | Filter by tag slug, e.g. `"news"` |
| `author` | string | no | Filter by author slug, e.g. `"john"` |
| `status` | string | no | `"published"`, `"draft"`, or `"scheduled"` |
| `order` | string | no | Sort order, e.g. `"published_at desc"` |
| `fields` | string | no | Comma-separated fields to return |
| `include` | string | no | Related data to include: `"tags"`, `"authors"`, `"tags,authors"` |

### Filter Syntax

Ghost uses a simple filter language:
- **AND**: `tag:news+status:published`
- **OR**: `tag:news,tag:engineering`
- **Comparison**: `published_at:>2025-01-01`

### Examples

```lua
-- List published posts with tags and authors
local result = app.integrations.ghost.list_posts({
  status = "published",
  include = "tags,authors",
  limit = 10
})

-- Filter by tag and paginate
local result = app.integrations.ghost.list_posts({
  tag = "engineering",
  page = 2,
  limit = 20
})

-- Search with custom filter
local result = app.integrations.ghost.list_posts({
  filter = "tag:news+status:published",
  order = "published_at desc"
})
```

---

## get_post

Get a single blog post by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Post UUID |
| `fields` | string | no | Comma-separated fields to return |
| `include` | string | no | Related data: `"tags"`, `"authors"` |
| `formats` | string | no | Content format: `"html"`, `"plaintext"` |

### Example

```lua
local result = app.integrations.ghost.get_post({
  id = "64a1b2c3d4e5f6g7h8i9j0k",
  include = "tags,authors"
})

local post = result.posts[1]
print(post.title)
print(post.html)
```

---

## create_post

Create a new blog post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Post title |
| `html` | string | no | Post content as HTML |
| `status` | string | no | `"draft"` or `"published"` (default: `"draft"`) |
| `featured` | boolean | no | Feature this post (default: false) |
| `tags` | array | no | Tag names, e.g. `{"News", "Engineering"}` |
| `authors` | array | no | Author emails, e.g. `{"admin@example.com"}` |
| `excerpt` | string | no | Custom excerpt / meta description |
| `feature_image` | string | no | URL for the cover image |

### Examples

```lua
-- Create a draft post
local result = app.integrations.ghost.create_post({
  title = "My New Post",
  html = "<p>Hello world!</p>",
  status = "draft",
  tags = {"News", "Announcement"}
})

-- Create and publish immediately
local result = app.integrations.ghost.create_post({
  title = "Breaking News",
  html = "<p>Important update...</p>",
  status = "published",
  featured = true,
  tags = {"Breaking"},
  authors = {"admin@example.com"}
})
```

---

## update_post

Update an existing blog post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Post UUID to update |
| `title` | string | no | New title |
| `html` | string | no | New HTML content |
| `status` | string | no | `"draft"` or `"published"` |
| `featured` | boolean | no | Set/unset featured flag |
| `tags` | array | no | Replace tags (e.g. `{"Updated"}`) |
| `excerpt` | string | no | New excerpt / meta description |
| `feature_image` | string | no | New cover image URL |
| `updated_at` | string | no | Last known timestamp for concurrency control |

### Example

```lua
-- Update post content and publish
local result = app.integrations.ghost.update_post({
  id = "64a1b2c3d4e5f6g7h8i9j0k",
  html = "<p>Updated content!</p>",
  status = "published"
})

-- Change tags and set featured
local result = app.integrations.ghost.update_post({
  id = "64a1b2c3d4e5f6g7h8i9j0k",
  tags = {"Featured", "Engineering"},
  featured = true
})
```

---

## list_pages

List static pages (About, Contact, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Pages per page (default: 15, max: 100) |
| `filter` | string | no | Ghost filter syntax |
| `status` | string | no | `"published"` or `"draft"` |
| `order` | string | no | Sort order |
| `fields` | string | no | Comma-separated fields to return |
| `include` | string | no | Related data: `"tags"`, `"authors"` |

### Example

```lua
local result = app.integrations.ghost.list_pages({
  status = "published",
  limit = 50
})

for _, page in ipairs(result.pages) do
  print(page.title .. " (" .. page.slug .. ")")
end
```

---

## list_members

List newsletter members.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Members per page (default: 15, max: 100) |
| `filter` | string | no | Ghost filter syntax |
| `order` | string | no | Sort order (default: `"created_at desc"`) |
| `fields` | string | no | Comma-separated fields to return |

### Examples

```lua
-- List all subscribed members
local result = app.integrations.ghost.list_members({
  filter = "subscribed:true",
  limit = 50
})

-- Search by email domain
local result = app.integrations.ghost.list_members({
  filter = "email:@example.com"
})

for _, member in ipairs(result.members) do
  print(member.name .. " <" .. member.email .. ">")
end
```

---

## get_current_user

Get the currently authenticated Ghost admin user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated fields to return |

### Example

```lua
local result = app.integrations.ghost.get_current_user({})
local user = result.users[1]
print("Connected as: " .. user.name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Ghost sites configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ghost.list_posts({status = "published"})

-- Explicit default (portable across setups)
app.integrations.ghost.default.list_posts({status = "published"})

-- Named accounts (e.g. multiple Ghost sites)
app.integrations.ghost.blog.list_posts({tag = "news"})
app.integrations.ghost.docs.list_pages({status = "published"})
```

All functions are identical across accounts — only the credentials (API key and base URL) differ.
