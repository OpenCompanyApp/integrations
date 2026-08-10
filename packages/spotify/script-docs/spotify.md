# Spotify — JavaScript API Reference

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

```js
var result = app.integrations.spotify.search({
  q: "Bohemian Rhapsody",
  type: "track",
  limit: 5,
})

for (const track of (result.items)) {
  console.log(track.name + " by " + track.artists[0].name)
}
```
```js
// Search with operators
var result = app.integrations.spotify.search({
  q: "artist:Radiohead album:OK Computer",
  type: "album",
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

```js
var track = app.integrations.spotify.get_track({
  id: "4cOdK2wGLETKBW3PvgPWqT",
})

console.log(track.name)
console.log("Duration: " + Math.floor(track.duration_ms / 1000) + "s")
console.log("Popularity: " + track.popularity)
for (const artist of (track.artists)) {
  console.log("Artist: " + artist.name)
}
```
---

## get_artist

Get detailed information about a specific artist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Spotify artist ID |

### Example

```js
var artist = app.integrations.spotify.get_artist({
  id: "1dfeR4HaWDbWqFHLkxsg1d",
})

console.log(artist.name)
console.log("Followers: " + artist.followers)
console.log("Genres: " + artist.genres.join(", "))
console.log("Popularity: " + artist.popularity)
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

```js
var result = app.integrations.spotify.list_playlists({
  limit: 10,
})

for (const pl of (result.playlists)) {
  console.log(pl.name + " (" + pl.tracks_total + " tracks)")
}
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

```js
var result = app.integrations.spotify.get_playlist({
  id: "37i9dQZF1DXcBWIGoYBM5M",
  limit: 50,
})

console.log("Playlist: " + result.name)
console.log("Total tracks: " + result.tracks_total)

for (const t of (result.tracks)) {
  console.log(t.name + " — " + t.artists[0].name)
}

if (result.has_more) {
  console.log("More tracks available, use offset to paginate")
}
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

```js
// First get the user ID
var user = app.integrations.spotify.get_current_user({})

// Then create the playlist
var result = app.integrations.spotify.create_playlist({
  user_id: user.id,
  name: "My JavaScript Playlist",
  description: "Created via the OpenCompany Spotify integration",
  public: false,
})

console.log("Created: " + result.name)
console.log("URL: " + result.url)
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

```js
var result = app.integrations.spotify.list_albums({
  id: "1dfeR4HaWDbWqFHLkxsg1d",
  include_groups: "album",
  limit: 10,
})

for (const album of (result.albums)) {
  console.log(album.name + " (" + album.release_date + ")")
}
```
---

## get_current_user

Get the authenticated user's Spotify profile. Returns the user ID needed for creating playlists.

### Parameters

None.

### Example

```js
var user = app.integrations.spotify.get_current_user({})

console.log("User: " + user.display_name)
console.log("ID: " + user.id)
console.log("Followers: " + (user.followers || 0))
console.log("Country: " + (user.country || "N/A"))
console.log("Plan: " + (user.product || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Spotify accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.spotify.search({q: "Queen", type: "track"})

// Explicit default (portable across setups)
app.integrations.spotify.default.search({q: "Queen", type: "track"})

// Named accounts
app.integrations.spotify.work.search({q: "focus music", type: "playlist"})
app.integrations.spotify.personal.search({q: "road trip", type: "playlist"})
```
All functions are identical across accounts — only the credentials differ.
