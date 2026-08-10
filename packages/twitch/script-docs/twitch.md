# Twitch — JavaScript API Reference

## list_streams

List live streams on Twitch. Filter by game, language, or specific users.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `game_id` | string | no | Filter by game/category ID (use search_categories to find the ID) |
| `language` | string | no | Stream language code (e.g., `"en"`, `"es"`, `"fr"`, `"de"`) |
| `user_id` | string | no | Broadcaster user ID |
| `user_login` | string | no | Broadcaster login name |
| `first` | integer | no | Number of results (max 100, default 20) |
| `after` | string | no | Pagination cursor |
| `before` | string | no | Backward pagination cursor |

### Examples

#### Top Fortnite streams

```js
var result = app.integrations.twitch.list_streams({
  game_id: "33214",
  first: 10,
})

for (const stream of (result.streams)) {
  console.log(stream.user_name + " — " + stream.title + " (" + stream.viewer_count + " viewers)")
}
```
#### Streams in English

```js
var result = app.integrations.twitch.list_streams({
  language: "en",
  first: 20,
})
```
#### Check if a specific user is live

```js
var result = app.integrations.twitch.list_streams({
  user_login: "ninja",
})

if (result.count > 0) {
  console.log(result.streams[0].user_name + " is live: " + result.streams[0].title)
} else {
  console.log("User is !currently streaming.")
}
```
---

## get_user

Get information about a Twitch user by ID or login name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | no* | User ID |
| `login` | string | no* | Login name (e.g., `"ninja"`) |

*At least one of `id` or `login` is required.

### Example

```js
var result = app.integrations.twitch.get_user({
  login: "ninja",
})

if (result.count > 0) {
  var user = result.users[0]
  console.log(user.display_name + " — " + user.description)
}
```
---

## list_games

Get information about one or more Twitch games/categories.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | no* | Game ID |
| `name` | string | no* | Game name (e.g., `"Fortnite"`) |

*At least one of `id` or `name` is required.

### Example

```js
var result = app.integrations.twitch.list_games({
  name: "Fortnite",
})

for (const game of (result.games)) {
  console.log(game.name + " (ID: " + game.id + ")")
}
```
---

## get_game

Get information about a specific game by its Twitch ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The game/category ID |

### Example

```js
var result = app.integrations.twitch.get_game({
  id: "21779",
})

if (result.game) {
  console.log(result.game.name + " — IGDB: " + (result.game.igdb_id || "N/A"))
}
```
---

## list_channels

List channel information on Twitch.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `broadcaster_id` | string | no | Filter by broadcaster user ID |
| `first` | integer | no | Number of results (max 100, default 20) |
| `after` | string | no | Pagination cursor |

### Example

```js
var result = app.integrations.twitch.list_channels({
  broadcaster_id: "123456",
})

for (const channel of (result.channels)) {
  console.log(channel.broadcaster_name + " — " + channel.game_name + " — " + channel.title)
}
```
---

## get_channel

Get information about a specific channel by broadcaster ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `broadcaster_id` | string | yes | The broadcaster's user ID |

### Example

```js
var result = app.integrations.twitch.get_channel({
  broadcaster_id: "123456",
})

if (result.channel) {
  var ch = result.channel
  console.log(ch.broadcaster_name + " is playing " + ch.game_name)
  console.log("Title: " + ch.title)
  console.log("Live: " + String(ch.is_live))
}
```
---

## search_categories

Search for games/categories on Twitch by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query |
| `first` | integer | no | Number of results (max 100, default 20) |
| `after` | string | no | Pagination cursor |

### Example

```js
var result = app.integrations.twitch.search_categories({
  query: "League",
  first: 5,
})

for (const cat of (result.categories)) {
  console.log(cat.name + " (ID: " + cat.id + ")")
}
```
### Workflow: search then list streams

```js
// Step 1: Find the game
var search = app.integrations.twitch.search_categories({
  query: "Just Chatting",
})

if (search.count > 0) {
  var game_id = search.categories[0].id

  // Step 2: Get top streams for that game
  var streams = app.integrations.twitch.list_streams({
    game_id: game_id,
    first: 5,
  })

  for (const stream of (streams.streams)) {
    console.log(stream.user_name + " — " + stream.viewer_count + " viewers")
  }
}
```
---

## get_current_user

Get information about the authenticated Twitch user. No parameters required.

### Example

```js
var result = app.integrations.twitch.get_current_user({})

var user = result.user
console.log("Logged in as: " + user.display_name)
console.log("Broadcaster type: " + (user.broadcaster_type || "none"))
console.log("Bio: " + (user.description || ""))
```
---

## Multi-Account Usage

If you have multiple Twitch accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.twitch.list_streams({game_id: "33214"})

// Explicit default (portable across setups)
app.integrations.twitch.default.list_streams({game_id: "33214"})

// Named accounts
app.integrations.twitch.work.list_streams({game_id: "33214"})
app.integrations.twitch.personal.list_streams({game_id: "33214"})
```
All functions are identical across accounts — only the credentials differ.
