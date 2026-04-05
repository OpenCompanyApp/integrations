# Vimeo — Lua API Reference

## list_videos

List videos for the authenticated Vimeo user. Returns paginated results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `per_page` | integer | no | Videos per page (max 100, default: 25) |

### Examples

```lua
local result = app.integrations.vimeo.list_videos({
  page = 1,
  per_page = 10
})

for _, video in ipairs(result.videos) do
  print(video.name .. " (" .. video.duration .. "s)")
end
```

---

## get_video

Get detailed information about a single video.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The video ID (e.g., `"123456789"`) |

### Examples

```lua
local result = app.integrations.vimeo.get_video({
  video_id = "123456789"
})

print(result.name)
print(result.description)
print("Duration: " .. result.duration .. "s")
print("Link: " .. result.link)
```

---

## upload_video

Create an upload ticket for a new video. Returns an upload URL that you can POST the video file binary to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Title of the video |
| `description` | string | no | Description of the video |
| `privacy` | string | no | Privacy: `"anybody"`, `"nobody"`, `"contacts"`, `"password"`, `"disable"`, `"unlisted"` |

### Examples

```lua
local result = app.integrations.vimeo.upload_video({
  name = "My New Video",
  description = "Uploaded via OpenCompany",
  privacy = "nobody"
})

print("Upload link: " .. result.upload_link)
print("Video URI: " .. result.video_uri)
```

---

## delete_video

Delete a video permanently. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | The video ID to delete |

### Examples

```lua
app.integrations.vimeo.delete_video({
  video_id = "123456789"
})
```

---

## list_albums

List albums (showcases) for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `per_page` | integer | no | Albums per page (default: 25) |

### Examples

```lua
local result = app.integrations.vimeo.list_albums({
  page = 1,
  per_page = 10
})

for _, album in ipairs(result.data) do
  print(album.name)
end
```

---

## get_album

Get detailed information about a single album.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `album_id` | string | yes | The album ID |

### Examples

```lua
local result = app.integrations.vimeo.get_album({
  album_id = "1234567"
})

print(result.name)
print(result.description)
```

---

## list_channels

List public Vimeo channels.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `per_page` | integer | no | Channels per page (default: 25) |

### Examples

```lua
local result = app.integrations.vimeo.list_channels({
  page = 1,
  per_page = 10
})

for _, channel in ipairs(result.data) do
  print(channel.name)
end
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.vimeo.get_current_user({})

print("Name: " .. result.name)
print("Account: " .. (result.account or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Vimeo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vimeo.function_name({...})

-- Explicit default (portable across setups)
app.integrations.vimeo.default.function_name({...})

-- Named accounts
app.integrations.vimeo.work.function_name({...})
app.integrations.vimeo.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
