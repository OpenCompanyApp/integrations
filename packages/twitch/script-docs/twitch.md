# Twitch — Ruby API Reference

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

```ruby
result = app.integrations.twitch.list_streams(game_id: "33214", first: 10)
result.streams.each do |stream|
  puts((stream.user_name).to_s + " — " + (stream.title).to_s + " (" + (stream.viewer_count).to_s + " viewers)")
end
```
#### Streams in English

```ruby
result = app.integrations.twitch.list_streams(language: "en", first: 20)
```
#### Check if a specific user is live

```ruby
result = app.integrations.twitch.list_streams(user_login: "ninja")
if (result.count > 0)
  puts((result.streams[0].user_name).to_s + " is live: " + (result.streams[0].title).to_s)
else
  puts("User is !currently streaming.")
end
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

```ruby
result = app.integrations.twitch.get_user(login: "ninja")
if (result.count > 0)
  user = result.users[0]
  puts((user.display_name).to_s + " — " + (user.description).to_s)
end
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

```ruby
result = app.integrations.twitch.list_games(name: "Fortnite")
result.games.each do |game|
  puts((game.name).to_s + " (ID: " + (game.id).to_s + ")")
end
```
---

## get_game

Get information about a specific game by its Twitch ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The game/category ID |

### Example

```ruby
result = app.integrations.twitch.get_game(id: "21779")
if result.game
  puts((result.game.name).to_s + " — IGDB: " + ((result.game.igdb_id || "N/A")).to_s)
end
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

```ruby
result = app.integrations.twitch.list_channels(broadcaster_id: "123456")
result.channels.each do |channel|
  puts((channel.broadcaster_name).to_s + " — " + (channel.game_name).to_s + " — " + (channel.title).to_s)
end
```
---

## get_channel

Get information about a specific channel by broadcaster ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `broadcaster_id` | string | yes | The broadcaster's user ID |

### Example

```ruby
result = app.integrations.twitch.get_channel(broadcaster_id: "123456")
if result.channel
  ch = result.channel
  puts((ch.broadcaster_name).to_s + " is playing " + (ch.game_name).to_s)
  puts("Title: " + (ch.title).to_s)
  puts("Live: " + ((ch.is_live).to_s).to_s)
end
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

```ruby
result = app.integrations.twitch.search_categories(query: "League", first: 5)
result.categories.each do |cat|
  puts((cat.name).to_s + " (ID: " + (cat.id).to_s + ")")
end
```
### Workflow: search then list streams

```ruby
# Step 1: Find the game
search = app.integrations.twitch.search_categories(query: "Just Chatting")
if (search.count > 0)
  game_id = search.categories[0].id
  # Step 2: Get top streams for that game
  streams = app.integrations.twitch.list_streams(game_id: game_id, first: 5)
  streams.streams.each do |stream|
    puts((stream.user_name).to_s + " — " + (stream.viewer_count).to_s + " viewers")
  end
end
```
---

## get_current_user

Get information about the authenticated Twitch user. No parameters required.

### Example

```ruby
result = app.integrations.twitch.get_current_user()
user = result.user
puts("Logged in as: " + (user.display_name).to_s)
puts("Broadcaster type: " + ((user.broadcaster_type || "none")).to_s)
puts("Bio: " + ((user.description || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple Twitch accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.twitch.list_streams(game_id: "33214")
# Explicit default (portable across setups)
app.integrations.twitch.default.list_streams(game_id: "33214")
# Named accounts
app.integrations.twitch.work.list_streams(game_id: "33214")
app.integrations.twitch.personal.list_streams(game_id: "33214")
```
All functions are identical across accounts — only the credentials differ.
