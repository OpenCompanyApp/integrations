# Mattermost — Lua API Reference

## list_channels

List channels the current user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-indexed). Default: 0. |
| `per_page` | integer | no | Number of channels per page. Default: 60. |

### Response

Returns an array of channel objects:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Channel ID |
| `name` | string | Channel URL name |
| `display_name` | string | Human-readable name |
| `type` | string | Channel type: `O` (public), `P` (private), `D` (direct) |
| `team_id` | string | Team this channel belongs to |
| `header` | string | Channel header text |
| `purpose` | string | Channel purpose text |

### Example

```lua
local channels = app.integrations.mattermost.list_channels({
  page = 0,
  per_page = 20
})

for _, ch in ipairs(channels) do
  print(ch.display_name .. " (" .. ch.type .. ") - " .. ch.id)
end
```

---

## get_channel

Get details of a specific channel by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The channel ID. |

### Example

```lua
local channel = app.integrations.mattermost.get_channel({
  channel_id = "abc123def456"
})

print(channel.display_name .. ": " .. (channel.purpose or "No purpose set"))
```

---

## create_post

Post a message to a channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The channel to post the message in. |
| `message` | string | yes | The message text. Supports Markdown. |

### Response

Returns the created post object with `id`, `create_at`, `update_at`, and the message content.

### Example

```lua
local post = app.integrations.mattermost.create_post({
  channel_id = "abc123def456",
  message = "Hello from the AI agent! :robot:"
})

print("Posted message ID: " .. post.id)
```

---

## list_posts

List posts in a channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The channel ID. |
| `page` | integer | no | Page number (0-indexed). Default: 0. |
| `per_page` | integer | no | Number of posts per page. Default: 60. |

### Response

Returns an object with `order` (array of post IDs) and `posts` (map of post ID → post object). Each post has:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Post ID |
| `message` | string | Post content |
| `user_id` | string | Author user ID |
| `channel_id` | string | Channel ID |
| `create_at` | integer | Creation timestamp (ms) |
| `update_at` | integer | Last update timestamp (ms) |

### Example

```lua
local result = app.integrations.mattermost.list_posts({
  channel_id = "abc123def456",
  page = 0,
  per_page = 10
})

for _, postId in ipairs(result.order) do
  local post = result.posts[postId]
  print(post.user_id .. ": " .. post.message)
end
```

---

## get_post

Get a specific post by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The post ID. |

### Example

```lua
local post = app.integrations.mattermost.get_post({
  post_id = "xyz789"
})

print("Message: " .. post.message)
print("Author: " .. post.user_id)
```

---

## list_teams

List teams the current user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-indexed). Default: 0. |
| `per_page` | integer | no | Number of teams per page. Default: 60. |

### Response

Returns an array of team objects:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Team ID |
| `name` | string | Team URL name |
| `display_name` | string | Human-readable team name |
| `description` | string | Team description |
| `type` | string | Team type: `O` (open), `I` (invite) |
| `email` | string | Team email |

### Example

```lua
local teams = app.integrations.mattermost.list_teams({})

for _, team in ipairs(teams) do
  print(team.display_name .. " (" .. team.type .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Response

Returns a user object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | User ID |
| `username` | string | Username |
| `email` | string | Email address |
| `nickname` | string | Display nickname |
| `first_name` | string | First name |
| `last_name` | string | Last name |
| `roles` | string | User roles (e.g., "system_admin") |
| `locale` | string | User locale (e.g., "en") |

### Example

```lua
local user = app.integrations.mattermost.get_current_user({})

print("Logged in as: @" .. user.username .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Mattermost accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mattermost.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mattermost.default.function_name({...})

-- Named accounts
app.integrations.mattermost.work.function_name({...})
app.integrations.mattermost.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
