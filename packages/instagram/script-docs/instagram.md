# Instagram — JavaScript API Reference

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

```js
var result = app.integrations.instagram.list_media({
  limit: 25,
})

for (const media of (result.data)) {
  console.log(media.id + ": " + (media.caption || "No caption") + " (" + media.media_type + ")")
}

// Use paging cursor for next page
if (result.paging && result.paging.cursors) {
  var next = app.integrations.instagram.list_media({
    limit: 25,
    after: result.paging.cursors.after,
  })
}
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

```js
var result = app.integrations.instagram.get_media({
  mediaId: "17895695668004550",
})
console.log(result.caption)
console.log(result.media_type)
console.log(result.media_url)
console.log("Likes: " + (result.like_count || 0))
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

```js
var result = app.integrations.instagram.create_media({
  imageUrl: "https://example.com/photo.jpg",
  caption: "Check out our latest product launch! 🚀",
})
console.log("Published media ID: " + result.id)
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

```js
var result = app.integrations.instagram.list_comments({
  mediaId: "17895695668004550",
  limit: 20,
})

for (const comment of (result.data)) {
  console.log(comment.username + ": " + comment.text)
}
```
---

## get_comment

Get details of a specific Instagram comment by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `commentId` | string | yes | The comment ID to retrieve |

### Example

```js
var result = app.integrations.instagram.get_comment({
  commentId: "17853788044894720",
})
console.log(result.username + ": " + result.text)
console.log("Likes: " + (result.like_count || 0))
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

```js
var result = app.integrations.instagram.list_insights({
  metric: "impressions,reach,follower_count",
  period: "day",
})

for (const insight of (result.data)) {
  console.log(insight.name + ":")
  for (const value of (insight.values)) {
    console.log("  " + value.end_time + " = " + String(value.value))
  }
}
```
---

## get_current_user

Get the currently authenticated Instagram user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.instagram.get_current_user()
console.log("Logged in as: @" + (result.username || ""))
console.log("Followers: " + (result.followers_count || 0))
console.log("Following: " + (result.follows_count || 0))
console.log("Media count: " + (result.media_count || 0))
```
---

## Multi-Account Usage

If you have multiple Instagram accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.instagram.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.instagram.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.instagram.brand_account.function_name({ /* parameters */ })
app.integrations.instagram.agency.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
