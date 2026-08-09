# Later — JavaScript API Reference

## list_profiles

List all social media profiles connected to the Later account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of profiles to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.later.list_profiles()

for (const profile of (result.data)) {
  console.log(profile.id + ": " + profile.platform + " (" + profile.username + ")")
}
```
---

## get_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```js
var result = app.integrations.later.get_profile({
  profileId: "abc123",
})
console.log(result.platform)
console.log(result.username)
```
---

## list_posts

List scheduled and published posts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | no | Filter posts by profile ID |
| `status` | string | no | Filter by status: "scheduled", "published", or "draft" |
| `limit` | integer | no | Number of posts to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.later.list_posts({
  status: "scheduled",
  limit: 20,
  page: 1,
})

for (const post of (result.data)) {
  console.log(post.id + ": " + post.text + " @ " + post.scheduled_at)
}
```
---

## create_post

Create and schedule a new social media post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The caption or text content of the post |
| `profileIds` | array | yes | Profile IDs to publish the post to |
| `scheduledAt` | string | no | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |
| `mediaUrl` | string | no | URL of the media to attach |
| `mediaType` | string | no | Type of media: "image" or "video" |
| `title` | string | no | Optional title for the post |

### Example

```js
var result = app.integrations.later.create_post({
  text: "Check out our latest blog post! https://example.com/blog",
  profileIds: ["abc123", "def456"],
  scheduledAt: "2025-02-01T09:00:00Z",
  mediaUrl: "https://example.com/image.jpg",
  mediaType: "image",
})
console.log("Created post: " + result.id)
```
---

## list_media

List media items in the Later media library.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of items to return per page |
| `page` | integer | no | Page number for pagination |
| `type` | string | no | Filter by type: "image" or "video" |

### Example

```js
var result = app.integrations.later.list_media({
  type: "image",
  limit: 10,
})

for (const item of (result.data)) {
  console.log(item.id + ": " + item.url)
}
```
---

## get_media

Get details of a specific media item by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mediaId` | string | yes | The media item ID to retrieve |

### Example

```js
var result = app.integrations.later.get_media({
  mediaId: "media_abc123",
})
console.log(result.url)
console.log(result.type)
```
---

## get_current_user

Get the currently authenticated Later user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.later.get_current_user()
console.log("Logged in as: " + (result.name || ""))
console.log("Email: " + (result.email || ""))
```
---

## Multi-Account Usage

If you have multiple Later accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.later.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.later.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.later.client_acct.function_name({ /* parameters */ })
app.integrations.later.agency.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
