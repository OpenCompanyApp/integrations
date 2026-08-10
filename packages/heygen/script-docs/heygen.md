# HeyGen — JavaScript API Reference

## list_videos

List generated videos with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 10, max: 100) |
| `offset` | integer | no | Number of videos to skip for pagination (default: 0) |

### Examples

```js
// List recent videos
var result = app.integrations.heygen.list_videos({
  limit: 10,
  offset: 0,
})

for (const video of (result.data.videos)) {
  console.log(video.video_id + ": " + video.status)
}
```
---

## get_video

Get the status and details of a specific video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the video |

### Example

```js
var result = app.integrations.heygen.get_video({
  video_id: "abc123",
})

console.log("Status: " + result.data.status)
if (result.data.video_url) {
  console.log("Download: " + result.data.video_url)
}
```
---

## create_video

Generate a new AI video with avatars and voices. Returns a `video_id` to track generation progress.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_inputs` | array | yes | Array of video input objects defining scenes |
| `dimension` | object | no | Video dimensions, e.g. `{width = 1920, height = 1080}` |
| `test` | boolean | no | Generate a test/preview video (default: false) |

### Video Input Structure

Each video input defines a scene:

```js
const example = {
  character: {
    avatar_id: "avatar-id-here",
    voice_id: "voice-id-here",
  },
  script: "Your script text here",
  voice_settings: {
    speed: 1.0,
    stability: 0.5,
  }
}
```
### Examples

```js
// Create a simple avatar video
var result = app.integrations.heygen.create_video({
  video_inputs: [
    {
      character: {
        avatar_id: "avatar-abc123",
        voice_id: "voice-xyz789",
      },
      script: "Welcome to our product demo!",
    }
  ],
  test: true,
})

console.log("Video ID: " + result.data.video_id)
```
```js
// Create a video with custom dimensions
var result = app.integrations.heygen.create_video({
  video_inputs: [
    {
      character: {
        avatar_id: "avatar-abc123",
        voice_id: "voice-xyz789",
      },
      script: "This is a landscape video.",
    }
  ],
  dimension: { width: 1920, height: 1080 },
  test: false,
})
```
---

## list_avatars

List all available talking avatars.

### Parameters

None.

### Example

```js
var result = app.integrations.heygen.list_avatars({})

for (const avatar of (result.data.avatars)) {
  console.log(avatar.avatar_id + ": " + avatar.avatar_name)
}
```
---

## list_voices

List all available voices for video generation.

### Parameters

None.

### Example

```js
var result = app.integrations.heygen.list_voices({})

for (const voice of (result.data.voices)) {
  console.log(voice.voice_id + ": " + voice.display_name + " (" + voice.language + ")")
}
```
---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```js
var result = app.integrations.heygen.get_current_user({})

console.log("Plan: " + result.data.plan)
console.log("Remaining credits: " + result.data.remaining_quota)
```
---

## list_templates

List available video templates with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of templates to return (default: 10, max: 100) |
| `offset` | integer | no | Number of templates to skip for pagination (default: 0) |

### Example

```js
var result = app.integrations.heygen.list_templates({
  limit: 20,
  offset: 0,
})

for (const template of (result.data.templates)) {
  console.log(template.template_id + ": " + template.name)
}
```
---

## Multi-Account Usage

If you have multiple HeyGen accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.heygen.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.heygen.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.heygen.work.function_name({ /* parameters */ })
app.integrations.heygen.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
