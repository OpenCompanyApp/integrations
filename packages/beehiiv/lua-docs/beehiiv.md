# Beehiiv — Lua API Reference

## list_posts

List posts from your Beehiiv publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"draft"`, `"confirmed"`, `"scheduled"`, `"published"` |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Examples

```lua
local result = app.integrations.beehiiv.list_posts({
  status = "published",
  limit = 10,
  page = 1
})

for _, post in ipairs(result.data) do
  print(post.title .. " — " .. post.status)
end
```

---

## get_post

Get a single post by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to retrieve |

### Examples

```lua
local result = app.integrations.beehiiv.get_post({
  post_id = "post_abc123"
})

print(result.data.title)
print(result.data.status)
```

---

## create_post

Create a new post in your Beehiiv publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Post title |
| `content` | string | yes | Post content (HTML or Markdown) |
| `status` | string | no | `"draft"` or `"confirmed"` (default: `"draft"`) |
| `subtitle` | string | no | Optional subtitle |
| `audience` | string | no | `"free"`, `"premium"`, or `"all"` (default: `"free"`) |
| `thumbnail_url` | string | no | URL for the post thumbnail image |
| `content_tags` | array | no | Array of tag strings |

### Examples

```lua
-- Create a draft post
local result = app.integrations.beehiiv.create_post({
  title = "My Newsletter Issue #1",
  content = "<h1>Hello World</h1><p>This is my first post.</p>",
  status = "draft",
  content_tags = {"newsletter", "weekly"}
})

print("Created post: " .. result.data.id)
```

```lua
-- Create and publish immediately
local result = app.integrations.beehiiv.create_post({
  title = "Breaking News",
  content = "<p>Important update...</p>",
  status = "confirmed",
  audience = "free"
})
```

---

## update_post

Update an existing post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to update |
| `title` | string | no | Updated title |
| `content` | string | no | Updated content (HTML or Markdown) |
| `status` | string | no | Updated status: `"draft"`, `"confirmed"`, `"scheduled"` |
| `subtitle` | string | no | Updated subtitle |
| `audience` | string | no | Updated audience: `"free"`, `"premium"`, `"all"` |
| `thumbnail_url` | string | no | Updated thumbnail URL |
| `content_tags` | array | no | Updated array of tag strings |

### Examples

```lua
local result = app.integrations.beehiiv.update_post({
  post_id = "post_abc123",
  title = "Updated Title",
  status = "confirmed"
})
```

---

## delete_post

Delete a post from your publication. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to delete |

### Examples

```lua
local result = app.integrations.beehiiv.delete_post({
  post_id = "post_abc123"
})

print("Deleted: " .. tostring(result.deleted))
```

---

## list_subscribers

List subscribers for your Beehiiv publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"`, `"inactive"`, `"pending"` |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Examples

```lua
local result = app.integrations.beehiiv.list_subscribers({
  status = "active",
  limit = 50,
  page = 1
})

for _, sub in ipairs(result.data) do
  print(sub.email .. " — " .. sub.status)
end
```

---

## get_subscriber

Get a single subscriber by their subscription ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | string | yes | The subscription ID of the subscriber |

### Examples

```lua
local result = app.integrations.beehiiv.get_subscriber({
  subscription_id = "sub_abc123"
})

print(result.data.email)
print(result.data.status)
```

---

## create_subscriber

Add a new subscriber to your publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address of the new subscriber |
| `reactivate_existing` | boolean | no | Reactivate if email already exists (default: false) |
| `utm_source` | string | no | UTM source attribution |
| `utm_medium` | string | no | UTM medium attribution |
| `utm_campaign` | string | no | UTM campaign attribution |
| `referring_pub` | string | no | Referring publication ID |

### Examples

```lua
local result = app.integrations.beehiiv.create_subscriber({
  email = "new@example.com",
  reactivate_existing = true,
  utm_source = "landing-page"
})

print("Added subscriber: " .. result.data.id)
```

---

## get_stats

Get analytics and stats for your publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `intent` | string | no | Stat type: `"overview"`, `"traffic"`, `"growth"`, `"subscribers"` (default: `"overview"`) |
| `days` | integer | no | Number of days to look back (default: 30) |
| `start_date` | string | no | Start date for custom range (ISO 8601) |
| `end_date` | string | no | End date for custom range (ISO 8601) |

### Examples

```lua
-- Overview stats for the last 30 days
local result = app.integrations.beehiiv.get_stats({
  intent = "overview",
  days = 30
})

-- Traffic breakdown
local result = app.integrations.beehiiv.get_stats({
  intent = "traffic",
  start_date = "2026-01-01",
  end_date = "2026-01-31"
})

-- Subscriber growth
local result = app.integrations.beehiiv.get_stats({
  intent = "growth",
  days = 90
})
```

---

## get_current_user

Verify your API key and list all publications you have access to.

### Parameters

None.

### Examples

```lua
local result = app.integrations.beehiiv.get_current_user({})

for _, pub in ipairs(result.data) do
  print(pub.name .. " — " .. pub.id)
end
```

---

## Multi-Account Usage

If you have multiple Beehiiv accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.beehiiv.list_posts({})

-- Explicit default (portable across setups)
app.integrations.beehiiv.default.list_posts({})

-- Named accounts
app.integrations.beehiiv.tech_newsletter.list_posts({})
app.integrations.beehiiv.marketing_blog.list_posts({})
```

All functions are identical across accounts — only the credentials differ.
