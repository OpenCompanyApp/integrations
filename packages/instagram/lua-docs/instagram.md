# Instagram — Lua API Reference

## list_media

List media published by the authenticated Instagram user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of media items to return per page |
| `after` | string | no | Pagination cursor — return items after this cursor |
| `before` | string | no | Pagination cursor — return items before this cursor |
| `fields` | string | no | Comma-separated fields to return |

### Example

```lua
local result = app.integrations.instagram.list_media({
  limit = 25
})

for _, media in ipairs(result.data) do
  print(media.id .. ": " .. (media.caption or "No caption") .. " (" .. media.media_type .. ")")
end

-- Use paging cursor for next page
if result.paging and result.paging.cursors then
  local next = app.integrations.instagram.list_media({
    limit = 25,
    after = result.paging.cursors.after
  })
end
```

---

## get_media

Get details of a specific Instagram media item by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mediaId` | string | yes | The media ID to retrieve |
| `fields` | string | no | Comma-separated fields to return |

### Example

```lua
local result = app.integrations.instagram.get_media({
  mediaId = "17895695668004550"
})
print(result.caption)
print(result.media_type)
print(result.media_url)
print("Likes: " .. (result.like_count or 0))
```

---

## create_media

Publish a new media item (photo or video) to Instagram.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `imageUrl` | string | yes | URL of the image or video to publish |
| `caption` | string | no | Caption text for the media post |
| `mediaType` | string | no | Type of media: "IMAGE", "VIDEO", or "CAROUSEL" |
| `publish` | boolean | no | Publish immediately (default true). Set false to create container only |

### Example

```lua
local result = app.integrations.instagram.create_media({
  imageUrl = "https://example.com/photo.jpg",
  caption = "Check out our latest product launch! 🚀"
})
print("Published media ID: " .. result.id)
```

---

## list_comments

List comments on a specific Instagram media item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mediaId` | string | yes | The media ID to list comments for |
| `limit` | integer | no | Number of comments to return per page |
| `after` | string | no | Pagination cursor — return comments after this cursor |

### Example

```lua
local result = app.integrations.instagram.list_comments({
  mediaId = "17895695668004550",
  limit = 20
})

for _, comment in ipairs(result.data) do
  print(comment.username .. ": " .. comment.text)
end
```

---

## get_comment

Get details of a specific Instagram comment by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `commentId` | string | yes | The comment ID to retrieve |

### Example

```lua
local result = app.integrations.instagram.get_comment({
  commentId = "17853788044894720"
})
print(result.username .. ": " .. result.text)
print("Likes: " .. (result.like_count or 0))
```

---

## list_insights

Get account-level insights and performance metrics for the authenticated Instagram user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `metric` | string | no | Comma-separated list of metrics (e.g. "impressions,reach,profile_views,follower_count") |
| `period` | string | no | Aggregation period: "day", "week", "days_28", "month", or "lifetime" |
| `since` | string | no | Start date (UNIX timestamp or ISO date) |
| `until` | string | no | End date (UNIX timestamp or ISO date) |

### Example

```lua
local result = app.integrations.instagram.list_insights({
  metric = "impressions,reach,follower_count",
  period = "day"
})

for _, insight in ipairs(result.data) do
  print(insight.name .. ":")
  for _, value in ipairs(insight.values) do
    print("  " .. value.end_time .. " = " .. tostring(value.value))
  end
end
```

---

## get_current_user

Get the currently authenticated Instagram user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.instagram.get_current_user()
print("Logged in as: @" .. (result.username or ""))
print("Followers: " .. (result.followers_count or 0))
print("Following: " .. (result.follows_count or 0))
print("Media count: " .. (result.media_count or 0))
```

---

## Multi-Account Usage

If you have multiple Instagram accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.instagram.function_name({...})

-- Explicit default (portable across setups)
app.integrations.instagram.default.function_name({...})

-- Named accounts
app.integrations.instagram.brand_account.function_name({...})
app.integrations.instagram.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
