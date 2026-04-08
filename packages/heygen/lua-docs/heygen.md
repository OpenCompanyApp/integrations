# HeyGen — Lua API Reference

## list_videos

List generated videos with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 10, max: 100) |
| `offset` | integer | no | Number of videos to skip for pagination (default: 0) |

### Examples

```lua
-- List recent videos
local result = app.integrations.heygen.list_videos({
  limit = 10,
  offset = 0
})

for _, video in ipairs(result.data.videos) do
  print(video.video_id .. ": " .. video.status)
end
```

---

## get_video

Get the status and details of a specific video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The unique identifier of the video |

### Example

```lua
local result = app.integrations.heygen.get_video({
  video_id = "abc123"
})

print("Status: " .. result.data.status)
if result.data.video_url then
  print("Download: " .. result.data.video_url)
end
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

```lua
{
  character = {
    avatar_id = "avatar-id-here",
    voice_id = "voice-id-here"
  },
  script = "Your script text here",
  voice_settings = {
    speed = 1.0,
    stability = 0.5
  }
}
```

### Examples

```lua
-- Create a simple avatar video
local result = app.integrations.heygen.create_video({
  video_inputs = {
    {
      character = {
        avatar_id = "avatar-abc123",
        voice_id = "voice-xyz789"
      },
      script = "Welcome to our product demo!"
    }
  },
  test = true
})

print("Video ID: " .. result.data.video_id)
```

```lua
-- Create a video with custom dimensions
local result = app.integrations.heygen.create_video({
  video_inputs = {
    {
      character = {
        avatar_id = "avatar-abc123",
        voice_id = "voice-xyz789"
      },
      script = "This is a landscape video."
    }
  },
  dimension = { width = 1920, height = 1080 },
  test = false
})
```

---

## list_avatars

List all available talking avatars.

### Parameters

None.

### Example

```lua
local result = app.integrations.heygen.list_avatars({})

for _, avatar in ipairs(result.data.avatars) do
  print(avatar.avatar_id .. ": " .. avatar.avatar_name)
end
```

---

## list_voices

List all available voices for video generation.

### Parameters

None.

### Example

```lua
local result = app.integrations.heygen.list_voices({})

for _, voice in ipairs(result.data.voices) do
  print(voice.voice_id .. ": " .. voice.display_name .. " (" .. voice.language .. ")")
end
```

---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.heygen.get_current_user({})

print("Plan: " .. result.data.plan)
print("Remaining credits: " .. result.data.remaining_quota)
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

```lua
local result = app.integrations.heygen.list_templates({
  limit = 20,
  offset = 0
})

for _, template in ipairs(result.data.templates) do
  print(template.template_id .. ": " .. template.name)
end
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
app.integrations.heygen.work.function_name({...})
app.integrations.heygen.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
