# Spotify — Lua API Reference

## search

Search for tracks, artists, albums, or playlists on Spotify.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | yes | Search query. Supports operators: `artist:`, `album:`, `track:`, `year:`, `genre:`, `isrc:` |
| `type` | string | no | Result type: `"track"` (default), `"artist"`, `"album"`, `"playlist"` |
| `limit` | integer | no | Max results (default 20, max 50) |
| `offset` | integer | no | Pagination offset (default 0) |

### Search Operators

| Operator | Example | Description |
|----------|---------|-------------|
| `artist:` | `artist:Queen` | Filter by artist name |
| `album:` | `album:Abbey Road` | Filter by album name |
| `track:` | `track:Bohemian Rhapsody` | Filter by track name |
| `year:` | `year:2024` | Filter by release year or range (`year:2020-2024`) |
| `genre:` | `genre:rock` | Filter by genre |
| `isrc:` | `isrc:GBBKS1500214` | Look up by International Standard Recording Code |

Operators can be combined: `artist:Beatles year:1967`

### Examples

```lua
local result = app.integrations.spotify.search({
  q = "Bohemian Rhapsody",
  type = "track",
  limit = 5
})

for _, track in ipairs(result.items) do
  print(track.name .. " by " .. track.artists[1].name)
end
```

```lua
-- Search with operators
local result = app.integrations.spotify.search({
  q = "artist:Radiohead album:OK Computer",
  type = "album"
})
```

---

## get_track

Get detailed information about a specific track.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify track ID |

### Example

```lua
local track = app.integrations.spotify.get_track({
  id = "4cOdK2wGLETKBW3PvgPWqT"
})

print(track.name)
print("Duration: " .. math.floor(track.duration_ms / 1000) .. "s")
print("Popularity: " .. track.popularity)
for _, artist in ipairs(track.artists) do
  print("Artist: " .. artist.name)
end
```

---

## get_artist

Get detailed information about a specific artist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify artist ID |

### Example

```lua
local artist = app.integrations.spotify.get_artist({
  id = "1dfeR4HaWDbWqFHLkxsg1d"
})

print(artist.name)
print("Followers: " .. artist.followers)
print("Genres: " .. table.concat(artist.genres, ", "))
print("Popularity: " .. artist.popularity)
```

---

## list_playlists

List the current user's playlists.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max playlists (default 20, max 50) |
| `offset` | integer | no | Pagination offset (default 0) |

### Example

```lua
local result = app.integrations.spotify.list_playlists({
  limit = 10
})

for _, pl in ipairs(result.playlists) do
  print(pl.name .. " (" .. pl.tracks_total .. " tracks)")
end
```

---

## get_playlist

Get detailed information about a playlist and its tracks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify playlist ID |
| `limit` | integer | no | Max tracks to return (default 20, max 100) |
| `offset` | integer | no | Pagination offset (default 0) |

### Example

```lua
local result = app.integrations.spotify.get_playlist({
  id = "37i9dQZF1DXcBWIGoYBM5M",
  limit = 50
})

print("Playlist: " .. result.name)
print("Total tracks: " .. result.tracks_total)

for _, t in ipairs(result.tracks) do
  print(t.name .. " — " .. t.artists[1].name)
end

if result.has_more then
  print("More tracks available, use offset to paginate")
end
```

---

## create_playlist

Create a new playlist for the current user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The Spotify user ID (get from `get_current_user`) |
| `name` | string | yes | Name for the new playlist |
| `description` | string | no | Playlist description |
| `public` | boolean | no | Public visibility (default `true`) |

### Example

```lua
-- First get the user ID
local user = app.integrations.spotify.get_current_user({})

-- Then create the playlist
local result = app.integrations.spotify.create_playlist({
  user_id = user.id,
  name = "My Lua Playlist",
  description = "Created via the OpenCompany Spotify integration",
  public = false
})

print("Created: " .. result.name)
print("URL: " .. result.url)
```

---

## list_albums

List albums by a specific artist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify artist ID |
| `include_groups` | string | no | Album types, comma-separated: `"album"`, `"single"`, `"appears_on"`, `"compilation"` (default `"album,single"`) |
| `limit` | integer | no | Max albums (default 20, max 50) |
| `offset` | integer | no | Pagination offset (default 0) |

### Example

```lua
local result = app.integrations.spotify.list_albums({
  id = "1dfeR4HaWDbWqFHLkxsg1d",
  include_groups = "album",
  limit = 10
})

for _, album in ipairs(result.albums) do
  print(album.name .. " (" .. album.release_date .. ")")
end
```

---

## get_current_user

Get the authenticated user's Spotify profile. Returns the user ID needed for creating playlists.

### Parameters

None.

### Example

```lua
local user = app.integrations.spotify.get_current_user({})

print("User: " .. user.display_name)
print("ID: " .. user.id)
print("Followers: " .. (user.followers or 0))
print("Country: " .. (user.country or "N/A"))
print("Plan: " .. (user.product or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Spotify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.spotify.search({q = "Queen", type = "track"})

-- Explicit default (portable across setups)
app.integrations.spotify.default.search({q = "Queen", type = "track"})

-- Named accounts
app.integrations.spotify.work.search({q = "focus music", type = "playlist"})
app.integrations.spotify.personal.search({q = "road trip", type = "playlist"})
```

All functions are identical across accounts — only the credentials differ.
