# HeyGen — Lua API Reference

## create_video

Generate a new AI video with a customizable avatar and voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_inputs` | array | yes | Array of video input objects (see below) |
| `test` | boolean | no | Set to `true` for a test video (free, watermarked) |
| `title` | string | no | Optional title for the video |
| `dimension` | object | no | Video dimensions, e.g. `{ width = 1920, height = 1080 }` |

### Video Input Object

Each element in `video_inputs` should contain:

| Field | Type | Description |
|-------|------|-------------|
| `avatar` | object | `{ avatar_id = "xxx", avatar_style = "normal" }` |
| `voice` | object | `{ voice_id = "yyy" }` |
| `script` | object | `{ text = "Your script text here" }` |

### Example

```lua
local result = app.integrations.heygen.create_video({
  video_inputs = {
    {
      avatar = {
        avatar_id = "avatar_abc123",
        avatar_style = "normal"
      },
      voice = {
        voice_id = "voice_def456"
      },
      script = {
        text = "Hello! Welcome to our product demo."
      }
    }
  },
  test = true,
  title = "Product Demo"
})

print("Video ID: " .. result.data.video_id)
```

---

## get_video

Retrieve the status, URL, and details of a video by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the video |

### Example

```lua
local result = app.integrations.heygen.get_video({
  video_id = "video_abc123"
})

print("Status: " .. result.data.status)
if result.data.video_url then
  print("URL: " .. result.data.video_url)
end
```

---

## list_videos

List generated videos with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max videos per page (default: 10) |
| `offset` | integer | no | Pagination offset (0-based) |

### Example

```lua
local result = app.integrations.heygen.list_videos({
  limit = 5,
  offset = 0
})

for _, video in ipairs(result.data.videos) do
  print(video.video_id .. ": " .. video.title .. " [" .. video.status .. "]")
end
```

---

## list_avatars

List all available avatars for video generation. No parameters required.

### Example

```lua
local result = app.integrations.heygen.list_avatars({})

for _, avatar in ipairs(result.data.avatars) do
  print(avatar.avatar_id .. ": " .. avatar.avatar_name)
end
```

---

## get_avatar

Retrieve details of a specific avatar by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `avatar_id` | string | yes | The unique identifier of the avatar |

### Example

```lua
local result = app.integrations.heygen.get_avatar({
  avatar_id = "avatar_abc123"
})

print("Name: " .. result.data.avatar_name)
print("Preview: " .. result.data.preview_image_url)
```

---

## list_voices

List all available voices for video generation. No parameters required.

### Example

```lua
local result = app.integrations.heygen.list_voices({})

for _, voice in ipairs(result.data.voices) do
  print(voice.voice_id .. ": " .. voice.display_name .. " (" .. voice.language .. ", " .. voice.gender .. ")")
end
```

---

## create_avatar

Create a new custom avatar by providing a training video URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_url` | string | yes | URL of the training video (2-5 min single-person video) |
| `name` | string | yes | A name for the new avatar |
| `description` | string | no | Optional description for the avatar |

### Example

```lua
local result = app.integrations.heygen.create_avatar({
  video_url = "https://example.com/training-video.mp4",
  name = "John - Sales Avatar",
  description = "Sales team avatar for product demos"
})

print("Avatar ID: " .. result.data.avatar_id)
```

---

## get_current_user

Retrieve the authenticated user's account information. No parameters required.

### Example

```lua
local result = app.integrations.heygen.get_current_user({})

print("Name: " .. result.data.name)
print("Plan: " .. result.data.plan)
print("Credits remaining: " .. result.data.remaining_credits)
```

---

## Multi-Account Usage

If you have multiple HeyGen accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.heygen.function_name({...})

-- Explicit default (portable across setups)
app.integrations.heygen.default.function_name({...})

-- Named accounts
app.integrations.heygen.production.function_name({...})
app.integrations.heygen.marketing.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
