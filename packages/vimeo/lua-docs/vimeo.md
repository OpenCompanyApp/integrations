# Vimeo — Lua API Reference

## list_videos

List videos for the authenticated Vimeo user with pagination, search, and filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Videos per page (1–100, default: 25) |
| `page` | integer | no | Page number (default: 1) |
| `query` | string | no | Full-text search by name or description |
| `filter` | string | no | Filter category: `"embeddable"`, `"playable"`, `"purchase_price"`, `"privacy"` |
| `filter_embeddable` | boolean | no | When filter is `"embeddable"`: true = only embeddable |
| `filter_playable` | boolean | no | When filter is `"playable"`: true = only playable |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` |
| `sort` | string | no | Sort field: `"alphabetical"`, `"comments"`, `"date"`, `"duration"`, `"likes"`, `"plays"` |

### Example

```lua
-- List recent videos
local result = app.integrations.vimeo.list_videos({per_page = 10, sort = "date", direction = "desc"})

for _, video in ipairs(result.videos) do
  print(video.name .. " (" .. video.duration .. "s)")
end

-- Search for a video
local result = app.integrations.vimeo.list_videos({query = "product demo"})
```

---

## get_video

Get detailed information about a single video by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_id` | string | yes | Vimeo video ID (e.g. `"123456789"`) |

### Example

```lua
local video = app.integrations.vimeo.get_video({video_id = "123456789"})
print(video.name)
print("Duration: " .. (video.duration or 0) .. "s")
print("Plays: " .. (video.stats.plays or 0))
```

---

## create_video

Create a new video upload slot on Vimeo. Choose an upload approach:

- **`pull`** — Vimeo downloads from a URL you provide (simplest for hosted files)
- **`post`** — You POST the file to the returned upload link (direct upload)
- **`streaming`** — Use the Tus protocol for large or resumable uploads

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `upload_approach` | string | no | Upload method: `"pull"`, `"post"`, or `"streaming"` (default: `"post"`) |
| `upload_link` | string | conditional | Required when approach is `"pull"`. URL Vimeo will download from |
| `name` | string | no | Video title |
| `description` | string | no | Video description |
| `privacy` | string | no | Privacy: `"anybody"`, `"nobody"`, `"contacts"`, `"password"`, `"unlisted"`, `"disable"` |
| `password` | string | conditional | Required when privacy is `"password"` |
| `folder_uri` | string | no | Folder (project) URI to add the video to |

### Examples

```lua
-- Pull a video from a URL
local result = app.integrations.vimeo.create_video({
  upload_approach = "pull",
  upload_link = "https://example.com/video.mp4",
  name = "Product Demo",
  description = "Latest product walkthrough",
  privacy = "anybody"
})
print("Video created: " .. result.uri)

-- Create an upload slot for direct upload
local result = app.integrations.vimeo.create_video({
  upload_approach = "post",
  name = "My New Video"
})
-- Use result.upload.upload_link to POST the file bytes
```

---

## list_albums

List albums (showcases) for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Albums per page (1–100, default: 25) |
| `page` | integer | no | Page number (default: 1) |
| `query` | string | no | Search albums by name or description |
| `sort` | string | no | Sort field: `"alphabetical"`, `"date"`, `"duration"`, `"manual"`, `"modified_time"`, `"name"` |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```lua
local result = app.integrations.vimeo.list_albums({per_page = 10})

for _, album in ipairs(result.albums) do
  local videoCount = album.metadata.connections.videos or 0
  print(album.name .. " (" .. videoCount .. " videos)")
end
```

---

## list_folders

List folders (projects) for the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Folders per page (1–100, default: 25) |
| `page` | integer | no | Page number (default: 1) |
| `query` | string | no | Search folders by name |

### Example

```lua
local result = app.integrations.vimeo.list_folders()

for _, folder in ipairs(result.folders) do
  local videos = folder.metadata.connections.videos or 0
  local subs = folder.metadata.connections.subfolders or 0
  print(folder.name .. " — " .. videos .. " videos, " .. subs .. " subfolders")
end
```

---

## get_current_user

Get the authenticated user's Vimeo profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.vimeo.get_current_user()
print("Connected as: " .. user.name)
print("Account type: " .. user.account)
print("Videos: " .. (user.metadata.connections.videos or 0))
print("Upload quota: " .. (user.upload_quota.space.free or 0) .. " / " .. (user.upload_quota.space.max or 0) .. " bytes free")
```

---

## Common Workflows

### Search for a video and get its details

```lua
local results = app.integrations.vimeo.list_videos({query = "onboarding", per_page = 5})

if #results.videos > 0 then
  local video = app.integrations.vimeo.get_video({video_id = results.videos[1].id})
  print("Found: " .. video.name)
  print("Duration: " .. (video.duration or 0) .. "s")
  print("Plays: " .. (video.stats.plays or 0))
end
```

### Browse all videos with pagination

```lua
local page = 1
local all_videos = {}

repeat
  local result = app.integrations.vimeo.list_videos({page = page, per_page = 100})
  for _, v in ipairs(result.videos) do
    table.insert(all_videos, v)
  end
  page = page + 1
until not result.paging.next or #result.videos == 0

print("Total videos fetched: " .. #all_videos)
```

---

## Privacy Values

| Value | Meaning |
|-------|---------|
| `anybody` | Public — anyone can view |
| `nobody` | Private — only the owner |
| `contacts` | Only contacts of the owner |
| `password` | Password-protected |
| `unlisted` | Unlisted — only those with the link |
| `disable` | Hide from Vimeo |

---

## Multi-Account Usage

If you have multiple Vimeo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vimeo.list_videos({per_page = 10})

-- Explicit default (portable across setups)
app.integrations.vimeo.default.list_videos({per_page = 10})

-- Named accounts
app.integrations.vimeo.work.list_videos({per_page = 10})
app.integrations.vimeo.personal.list_videos({per_page = 10})
```

All functions are identical across accounts — only the credentials differ.
