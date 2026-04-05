# Twitch — Lua API Reference

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

```lua
local result = app.integrations.twitch.list_streams({
  game_id = "33214",
  first = 10
})

for _, stream in ipairs(result.streams) do
  print(stream.user_name .. " — " .. stream.title .. " (" .. stream.viewer_count .. " viewers)")
end
```

#### Streams in English

```lua
local result = app.integrations.twitch.list_streams({
  language = "en",
  first = 20
})
```

#### Check if a specific user is live

```lua
local result = app.integrations.twitch.list_streams({
  user_login = "ninja"
})

if result.count > 0 then
  print(result.streams[1].user_name .. " is live: " .. result.streams[1].title)
else
  print("User is not currently streaming.")
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

```lua
local result = app.integrations.twitch.get_user({
  login = "ninja"
})

if result.count > 0 then
  local user = result.users[1]
  print(user.display_name .. " — " .. user.description)
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

```lua
local result = app.integrations.twitch.list_games({
  name = "Fortnite"
})

for _, game in ipairs(result.games) do
  print(game.name .. " (ID: " .. game.id .. ")")
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

```lua
local result = app.integrations.twitch.get_game({
  id = "21779"
})

if result.game then
  print(result.game.name .. " — IGDB: " .. (result.game.igdb_id or "N/A"))
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

```lua
local result = app.integrations.twitch.list_channels({
  broadcaster_id = "123456"
})

for _, channel in ipairs(result.channels) do
  print(channel.broadcaster_name .. " — " .. channel.game_name .. " — " .. channel.title)
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

```lua
local result = app.integrations.twitch.get_channel({
  broadcaster_id = "123456"
})

if result.channel then
  local ch = result.channel
  print(ch.broadcaster_name .. " is playing " .. ch.game_name)
  print("Title: " .. ch.title)
  print("Live: " .. tostring(ch.is_live))
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

```lua
local result = app.integrations.twitch.search_categories({
  query = "League",
  first = 5
})

for _, cat in ipairs(result.categories) do
  print(cat.name .. " (ID: " .. cat.id .. ")")
end
```

### Workflow: search then list streams

```lua
-- Step 1: Find the game
local search = app.integrations.twitch.search_categories({
  query = "Just Chatting"
})

if search.count > 0 then
  local game_id = search.categories[1].id

  -- Step 2: Get top streams for that game
  local streams = app.integrations.twitch.list_streams({
    game_id = game_id,
    first = 5
  })

  for _, stream in ipairs(streams.streams) do
    print(stream.user_name .. " — " .. stream.viewer_count .. " viewers")
  end
end
```

---

## get_current_user

Get information about the authenticated Twitch user. No parameters required.

### Example

```lua
local result = app.integrations.twitch.get_current_user({})

local user = result.user
print("Logged in as: " .. user.display_name)
print("Broadcaster type: " .. (user.broadcaster_type or "none"))
print("Bio: " .. (user.description or ""))
```

---

## Multi-Account Usage

If you have multiple Twitch accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.twitch.list_streams({game_id = "33214"})

-- Explicit default (portable across setups)
app.integrations.twitch.default.list_streams({game_id = "33214"})

-- Named accounts
app.integrations.twitch.work.list_streams({game_id = "33214"})
app.integrations.twitch.personal.list_streams({game_id = "33214"})
```

All functions are identical across accounts — only the credentials differ.
