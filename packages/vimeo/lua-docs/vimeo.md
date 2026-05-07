# Vimeo - Lua API Reference

Namespace: `app.integrations.vimeo`

Use this integration for Vimeo videos, uploads, albums/showcases, folders/projects, comments, text tracks, thumbnails, channels, and categories. Responses are decoded Vimeo JSON; several legacy list tools return a compact normalized shape for agent readability.

## Videos

```lua
local videos = app.integrations.vimeo.list_videos({
  per_page = 25,
  page = 1,
  query = "launch"
})

local video = app.integrations.vimeo.get_video({video_id = "123456789"})

local created = app.integrations.vimeo.create_video({
  upload_approach = "pull",
  upload_link = "https://example.test/video.mp4",
  name = "Launch demo",
  privacy = "unlisted"
})

app.integrations.vimeo.update_video({
  video_id = "123456789",
  data = {
    name = "Updated launch demo",
    privacy = {view = "unlisted"}
  }
})

app.integrations.vimeo.delete_video({video_id = "123456789"})
```

`upload_video` creates an upload ticket using Vimeo's upload resource flow. It does not upload local file bytes itself.

## Comments, Text Tracks, And Pictures

```lua
local comments = app.integrations.vimeo.list_video_comments({
  video_id = "123456789",
  params = {per_page = 10}
})

local comment = app.integrations.vimeo.create_video_comment({
  video_id = "123456789",
  text = "Looks good."
})

local tracks = app.integrations.vimeo.list_video_text_tracks({
  video_id = "123456789"
})

local track = app.integrations.vimeo.create_video_text_track({
  video_id = "123456789",
  data = {
    type = "subtitles",
    language = "en",
    name = "English"
  }
})

local pictures = app.integrations.vimeo.list_video_pictures({
  video_id = "123456789"
})
```

## Albums And Folders

```lua
local albums = app.integrations.vimeo.list_albums({})
local album = app.integrations.vimeo.get_album({album_id = "98765"})

local created_album = app.integrations.vimeo.create_album({
  data = {name = "Customer demos"}
})

app.integrations.vimeo.update_album({
  album_id = "98765",
  data = {description = "Updated showcase"}
})

local album_videos = app.integrations.vimeo.list_album_videos({
  album_id = "98765"
})

app.integrations.vimeo.add_video_to_album({
  album_id = "98765",
  video_id = "123456789"
})

local folders = app.integrations.vimeo.list_folders({})

local folder = app.integrations.vimeo.create_folder({
  data = {name = "Launch assets"}
})

app.integrations.vimeo.update_folder({
  folder_id = "456",
  data = {name = "Updated launch assets"}
})
```

## Discovery

```lua
local channels = app.integrations.vimeo.list_channels({
  page = 1,
  per_page = 25
})

local categories = app.integrations.vimeo.list_categories({})

local me = app.integrations.vimeo.get_current_user({})
```

## Generic API Helpers

Use generic helpers only for documented Vimeo endpoints that do not yet have a dedicated tool. `path` must be relative to the configured API base URL; absolute URLs are rejected.

```lua
local raw = app.integrations.vimeo.api_get({
  path = "/me/videos",
  params = {per_page = 5}
})

local posted = app.integrations.vimeo.api_post({
  path = "/me/albums",
  body = {name = "New showcase"}
})

local patched = app.integrations.vimeo.api_patch({
  path = "/videos/123456789",
  body = {name = "Updated title"}
})

local deleted = app.integrations.vimeo.api_delete({
  path = "/videos/123456789"
})
```

## Multi-Account Usage

```lua
app.integrations.vimeo.list_videos({})
app.integrations.vimeo.default.list_videos({})
app.integrations.vimeo.client_account.list_videos({})
```

All account namespaces expose the same tools; only stored access tokens differ.
