# Instagram — Ruby API Reference

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

```ruby
result = app.integrations.instagram.list_media(limit: 25)
result.data.each do |media|
  puts((media.id).to_s + ": " + ((media.caption || "No caption")).to_s + " (" + (media.media_type).to_s + ")")
end
# Use paging cursor for next page
if (result.paging && result.paging.cursors)
  next_value = app.integrations.instagram.list_media(limit: 25, after: result.paging.cursors.after)
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

```ruby
result = app.integrations.instagram.get_media(media_id: "17895695668004550")
puts(result.caption)
puts(result.media_type)
puts(result.media_url)
puts("Likes: " + ((result.like_count || 0)).to_s)
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

```ruby
result = app.integrations.instagram.create_media(image_url: "https://example.com/photo.jpg", caption: "Check out our latest product launch! 🚀")
puts("Published media ID: " + (result.id).to_s)
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

```ruby
result = app.integrations.instagram.list_comments(media_id: "17895695668004550", limit: 20)
result.data.each do |comment|
  puts((comment.username).to_s + ": " + (comment.text).to_s)
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

```ruby
result = app.integrations.instagram.get_comment(comment_id: "17853788044894720")
puts((result.username).to_s + ": " + (result.text).to_s)
puts("Likes: " + ((result.like_count || 0)).to_s)
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

```ruby
result = app.integrations.instagram.list_insights(metric: "impressions,reach,follower_count", period: "day")
result.data.each do |insight|
  puts((insight.name).to_s + ":")
  insight.values.each do |value|
    puts("  " + (value.end_time).to_s + " = " + ((value.value).to_s).to_s)
  end
end
```
---

## get_current_user

Get the currently authenticated Instagram user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.instagram.get_current_user()
puts("Logged in as: @" + ((result.username || "")).to_s)
puts("Followers: " + ((result.followers_count || 0)).to_s)
puts("Following: " + ((result.follows_count || 0)).to_s)
puts("Media count: " + ((result.media_count || 0)).to_s)
```
---

## Multi-Account Usage

If you have multiple Instagram accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
