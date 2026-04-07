# YouTube — Lua API Reference

All YouTube tools are available under `app.integrations.youtube`.

## search_videos

Search for videos, channels, or playlists on YouTube using keywords, filters, and sorting options.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query text |
| `type` | string | no | Resource type: `video`, `channel`, or `playlist`. Default: `video` |
| `max_results` | integer | no | Max results per page (1-50). Default: 10 |
| `page_token` | string | no | Token for the next page of results |
| `order` | string | no | Sort order: `date`, `rating`, `relevance`, `title`, `videoCount`, `viewCount` |
| `published_after` | string | no | RFC 3339 date-time (e.g., `"2024-01-01T00:00:00Z"`) |
| `published_before` | string | no | RFC 3339 date-time |
| `region_code` | string | no | ISO 3166-1 alpha-2 country code (e.g., `"US"`) |
| `channel_id` | string | no | Limit search to a specific channel |
| `video_duration` | string | no | Duration filter: `any`, `long`, `medium`, `short` |
| `safe_search` | string | no | Safe search: `moderate`, `none`, `strict` |

### Example

```lua
local result = app.integrations.youtube.search_videos({
  query = "rust programming tutorial",
  max_results = 5,
  order = "viewCount",
  video_duration = "long"
})

if result and result.items then
  for _, item in ipairs(result.items) do
    print(item.snippet.title)
    print("  Channel: " .. item.snippet.channelTitle)
    print("  Published: " .. item.snippet.publishedAt)
  end
end
```

---

## get_video_details

Get detailed information about one or more YouTube videos by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `video_ids` | string | yes | Comma-separated video IDs (max 50). E.g., `"dQw4w9WgXcQ"` |
| `part` | string | no | Comma-separated resource parts. Default: `snippet,contentDetails,statistics` |

### Example

```lua
local result = app.integrations.youtube.get_video_details({
  video_ids = "dQw4w9WgXcQ"
})

if result and result.items then
  for _, video in ipairs(result.items) do
    print(video.snippet.title)
    print("  Views: " .. (video.statistics.viewCount or "N/A"))
    print("  Likes: " .. (video.statistics.likeCount or "N/A"))
    print("  Duration: " .. (video.contentDetails.duration or "N/A"))
  end
end
```

---

## list_channels

List YouTube channels by username, channel ID, or category.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `for_username` | string | no* | YouTube username |
| `channel_ids` | string | no* | Comma-separated channel IDs (max 50) |
| `category_id` | string | no* | Guide category ID |
| `mine` | boolean | no* | Set `true` for authenticated user's channel |
| `max_results` | integer | no | Max results per page (1-50). Default: 5 |
| `page_token` | string | no | Token for the next page of results |
| `hl` | string | no | Language code for localized text (e.g., `"en"`) |

*At least one filter is required.

### Example

```lua
local result = app.integrations.youtube.list_channels({
  for_username = "Google"
})

if result and result.items then
  for _, channel in ipairs(result.items) do
    print(channel.snippet.title)
    print("  Subscribers: " .. (channel.statistics.subscriberCount or "hidden"))
    print("  Videos: " .. (channel.statistics.videoCount or "N/A"))
  end
end
```

---

## get_channel

Get detailed information about a specific YouTube channel by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | YouTube channel ID (e.g., `"UC_x5XG1OV2P6uZZ5FSM9Ttw"`) |
| `part` | string | no | Comma-separated resource parts. Default: `snippet,contentDetails,statistics,brandingSettings` |

### Example

```lua
local result = app.integrations.youtube.get_channel({
  channel_id = "UC_x5XG1OV2P6uZZ5FSM9Ttw"
})

if result and result.items and result.items[1] then
  local ch = result.items[1]
  print(ch.snippet.title)
  print("  Description: " .. (ch.snippet.description or ""))
  print("  Subscribers: " .. (ch.statistics.subscriberCount or "hidden"))
  print("  Total views: " .. (ch.statistics.viewCount or "N/A"))
end
```

---

## list_playlists

List playlists for a YouTube channel or by playlist IDs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | no* | Channel ID to list playlists for |
| `playlist_ids` | string | no* | Comma-separated playlist IDs (max 50) |
| `mine` | boolean | no* | Set `true` for authenticated user's playlists |
| `max_results` | integer | no | Max results per page (1-50). Default: 5 |
| `page_token` | string | no | Token for the next page of results |

*At least one filter is required.

### Example

```lua
local result = app.integrations.youtube.list_playlists({
  channel_id = "UC_x5XG1OV2P6uZZ5FSM9Ttw",
  max_results = 10
})

if result and result.items then
  for _, pl in ipairs(result.items) do
    print(pl.snippet.title)
    print("  Item count: " .. (pl.contentDetails.itemCount or "N/A"))
  end
end
```

---

## get_playlist

Get details about a specific YouTube playlist and its items.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `playlist_id` | string | yes | YouTube playlist ID |
| `max_results` | integer | no | Max playlist items to return (1-50). Default: 10 |
| `page_token` | string | no | Token for the next page of items |

### Example

```lua
local result = app.integrations.youtube.get_playlist({
  playlist_id = "PLrAXtmErZgOeiKm4sgNOknGvNjby9efdf",
  max_results = 5
})

if result and result.items and result.items.items then
  print("Playlist: " .. (result.items.items[1].snippet.title or "Unknown"))
  for _, item in ipairs(result.items.items or {}) do
    print("  " .. item.snippet.title)
  end
end
```

---

## get_current_user

Get the authenticated user's YouTube channel information.

### Parameters

None.

### Example

```lua
local result = app.integrations.youtube.get_current_user({})

if result and result.items and result.items[1] then
  local ch = result.items[1]
  print("Channel: " .. ch.snippet.title)
  print("Subscribers: " .. (ch.statistics.subscriberCount or "hidden"))
  print("Total views: " .. (ch.statistics.viewCount or "N/A"))
  print("Videos: " .. (ch.statistics.videoCount or "N/A"))
end
```

---

## Common Patterns

### Search videos and get full details

```lua
local search = app.integrations.youtube.search_videos({
  query = "machine learning intro",
  max_results = 3,
  order = "relevance"
})

if search and search.items then
  local ids = {}
  for _, item in ipairs(search.items) do
    table.insert(ids, item.id.videoId)
  end

  local details = app.integrations.youtube.get_video_details({
    video_ids = table.concat(ids, ",")
  })

  if details and details.items then
    for _, video in ipairs(details.items) do
      print(video.snippet.title)
      print("  Views: " .. (video.statistics.viewCount or "0"))
      print("  Duration: " .. (video.contentDetails.duration or "N/A"))
    end
  end
end
```

### Paginate through search results

```lua
local page = nil
local all_items = {}

for i = 1, 3 do
  local params = {
    query = "web development 2024",
    max_results = 10
  }
  if page then
    params.page_token = page
  end

  local result = app.integrations.youtube.search_videos(params)

  if not result or not result.items then break end

  for _, item in ipairs(result.items) do
    table.insert(all_items, item.snippet.title)
  end

  page = result.nextPageToken
  if not page then break end
end

print("Found " .. #all_items .. " results")
```
