# HeyGen — Ruby API Reference

## list_videos

List generated videos with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of videos to return (default: 10, max: 100) |
| `offset` | integer | no | Number of videos to skip for pagination (default: 0) |

### Examples

```ruby
# List recent videos
result = app.integrations.heygen.list_videos(limit: 10, offset: 0)
result.data.videos.each do |video|
  puts((video.video_id).to_s + ": " + (video.status).to_s)
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

```ruby
result = app.integrations.heygen.get_video(video_id: "abc123")
puts("Status: " + (result.data.status).to_s)
if result.data.video_url
  puts("Download: " + (result.data.video_url).to_s)
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

```ruby
example = {character: {avatar_id: "avatar-id-here", voice_id: "voice-id-here"}, script: "Your script text here", voice_settings: {speed: 1, stability: 0.5}}
```
### Examples

```ruby
# Create a simple avatar video
result = app.integrations.heygen.create_video(video_inputs: [{character: {avatar_id: "avatar-abc123", voice_id: "voice-xyz789"}, script: "Welcome to our product demo!"}], test: true)
puts("Video ID: " + (result.data.video_id).to_s)
```
```ruby
# Create a video with custom dimensions
result = app.integrations.heygen.create_video(video_inputs: [{character: {avatar_id: "avatar-abc123", voice_id: "voice-xyz789"}, script: "This is a landscape video."}], dimension: {width: 1920, height: 1080}, test: false)
```
---

## list_avatars

List all available talking avatars.

### Parameters

None.

### Example

```ruby
result = app.integrations.heygen.list_avatars()
result.data.avatars.each do |avatar|
  puts((avatar.avatar_id).to_s + ": " + (avatar.avatar_name).to_s)
end
```
---

## list_voices

List all available voices for video generation.

### Parameters

None.

### Example

```ruby
result = app.integrations.heygen.list_voices()
result.data.voices.each do |voice|
  puts((voice.voice_id).to_s + ": " + (voice.display_name).to_s + " (" + (voice.language).to_s + ")")
end
```
---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```ruby
result = app.integrations.heygen.get_current_user()
puts("Plan: " + (result.data.plan).to_s)
puts("Remaining credits: " + (result.data.remaining_quota).to_s)
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

```ruby
result = app.integrations.heygen.list_templates(limit: 20, offset: 0)
result.data.templates.each do |template|
  puts((template.template_id).to_s + ": " + (template.name).to_s)
end
```
---

## Multi-Account Usage

If you have multiple HeyGen accounts configured, use account-specific namespaces:

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
