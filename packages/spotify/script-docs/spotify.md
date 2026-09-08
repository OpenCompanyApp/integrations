# Spotify — Ruby API Reference

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

```ruby
result = app.integrations.spotify.search(q: "Bohemian Rhapsody", type: "track", limit: 5)
result.items.each do |track|
  puts((track.name).to_s + " by " + (track.artists[0].name).to_s)
end
```
```ruby
# Search with operators
result = app.integrations.spotify.search(q: "artist:Radiohead album:OK Computer", type: "album")
```
---

## get_track

Get detailed information about a specific track.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify track ID |

### Example

```ruby
track = app.integrations.spotify.get_track(id: "4cOdK2wGLETKBW3PvgPWqT")
puts(track.name)
puts("Duration: " + (((track.duration_ms / 1000)).floor).to_s + "s")
puts("Popularity: " + (track.popularity).to_s)
track.artists.each do |artist|
  puts("Artist: " + (artist.name).to_s)
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

```ruby
artist = app.integrations.spotify.get_artist(id: "1dfeR4HaWDbWqFHLkxsg1d")
puts(artist.name)
puts("Followers: " + (artist.followers).to_s)
puts("Genres: " + (artist.genres.join(", ")).to_s)
puts("Popularity: " + (artist.popularity).to_s)
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

```ruby
result = app.integrations.spotify.list_playlists(limit: 10)
result.playlists.each do |pl|
  puts((pl.name).to_s + " (" + (pl.tracks_total).to_s + " tracks)")
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

```ruby
result = app.integrations.spotify.get_playlist(id: "37i9dQZF1DXcBWIGoYBM5M", limit: 50)
puts("Playlist: " + (result.name).to_s)
puts("Total tracks: " + (result.tracks_total).to_s)
result.tracks.each do |t|
  puts((t.name).to_s + " — " + (t.artists[0].name).to_s)
end
if result.has_more
  puts("More tracks available, use offset to paginate")
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

```ruby
# First get the user ID
user = app.integrations.spotify.get_current_user()
# Then create the playlist
result = app.integrations.spotify.create_playlist(user_id: user.id, name: "My Ruby Playlist", description: "Created via the OpenCompany Spotify integration", public: false)
puts("Created (Unix seconds): " + (result.name).to_s)
puts("URL: " + (result.url).to_s)
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

```ruby
result = app.integrations.spotify.list_albums(id: "1dfeR4HaWDbWqFHLkxsg1d", include_groups: "album", limit: 10)
result.albums.each do |album|
  puts((album.name).to_s + " (" + (album.release_date).to_s + ")")
end
```
---

## get_current_user

Get the authenticated user's Spotify profile. Returns the user ID needed for creating playlists.

### Parameters

None.

### Example

```ruby
user = app.integrations.spotify.get_current_user()
puts("User: " + (user.display_name).to_s)
puts("ID: " + (user.id).to_s)
puts("Followers: " + ((user.followers || 0)).to_s)
puts("Country: " + ((user.country || "N/A")).to_s)
puts("Plan: " + ((user.product || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Spotify accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.spotify.search(q: "Queen", type: "track")
# Explicit default (portable across setups)
app.integrations.spotify.default.search(q: "Queen", type: "track")
# Named accounts
app.integrations.spotify.work.search(q: "focus music", type: "playlist")
app.integrations.spotify.personal.search(q: "road trip", type: "playlist")
```
All functions are identical across accounts — only the credentials differ.
