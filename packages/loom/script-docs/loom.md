# Loom — JavaScript API Reference

## list_videos

List Loom videos with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 20, max: 50) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List recent videos

```js
var result = app.integrations.loom.list_videos({
  limit: 10,
  page: 1,
})

for (const video of (result.videos)) {
  console.log(video.id + ": " + video.title)
}
```
#### Paginate through all videos

```js
var page = 1
var limit = 50

do {
  var result = app.integrations.loom.list_videos({
    limit: limit,
    page: page,
  })

  for (const video of (result.videos || [])) {
    console.log(video.title)
  }

  page = page + 1
} while (!(result.length === 0 || result.length < limit));
```
---

## get_video

Get detailed information about a specific Loom video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the Loom video |

### Examples

#### Get video details

```js
var result = app.integrations.loom.get_video({
  video_id: "abc123-def456",
})

console.log(result.title)
console.log(result.duration)
console.log(result.playback_url)
```
---

## create_video

Create a new Loom video placeholder with a title and optional description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title of the video |
| `description` | string | no | An optional description for the video |

### Examples

#### Create a video

```js
var result = app.integrations.loom.create_video({
  title: "Sprint Review - Week 14",
  description: "Weekly sprint review covering completed features && blockers.",
})

console.log("Created video: " + result.id)
```
---

## delete_video

Delete a Loom video permanently. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the video to delete |

### Examples

#### Delete a video

```js
var result = app.integrations.loom.delete_video({
  video_id: "abc123-def456",
})

console.log(result)
```
---

## list_folders

List Loom folders with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of folders to return (default: 20) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List folders

```js
var result = app.integrations.loom.list_folders({
  limit: 20,
  page: 1,
})

for (const folder of (result.folders || result)) {
  console.log(folder.name + " (ID: " + folder.id + ")")
}
```
---

## get_folder

Get detailed information about a specific Loom folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `folder_id` | string | yes | The unique identifier of the Loom folder |

### Examples

#### Get folder details

```js
var result = app.integrations.loom.get_folder({
  folder_id: "folder-abc123",
})

console.log(result.name)
console.log("Video count: " + result.video_count)
```
---

## list_workspaces

List all Loom workspaces accessible to the authenticated user.

### Parameters

No parameters required.

### Examples

#### List workspaces

```js
var result = app.integrations.loom.list_workspaces({})

for (const workspace of (result.workspaces || result)) {
  console.log(workspace.name + " (ID: " + workspace.id + ")")
}
```
---

## get_current_user

Get the authenticated Loom user's profile information.

### Parameters

No parameters required.

### Examples

#### Get current user profile

```js
var result = app.integrations.loom.get_current_user({})

console.log("Logged in as: " + result.name + " (" + result.email + ")")
```
---

## Multi-Account Usage

If you have multiple Loom accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.loom.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.loom.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.loom.work.function_name({ /* parameters */ })
app.integrations.loom.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
