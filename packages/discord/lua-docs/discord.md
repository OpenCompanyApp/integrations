# Client for the Discord Bot API (v10) — Lua API Reference

## discord_add_member_role

Add a role to a guild member in Discord..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild. |
| `user_id` | string | yes | The ID of the user to add the role to. |
| `role_id` | string | yes | The ID of the role to add. |

### Example

```lua
local result = app.integrations.discord.discord_add_member_role({
  guild_id = ""
  user_id = ""
  role_id = ""
})
```

## discord_add_reaction

Add an emoji reaction to a Discord message..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel the message is in. |
| `message_id` | string | yes | The ID of the message to react to. |
| `emoji` | string | yes | The emoji to react with. URL-encoded for unicode (e.g.,  |

### Example

```lua
local result = app.integrations.discord.discord_add_reaction({
  channel_id = ""
  message_id = ""
  emoji = ""
})
```

## discord_create_channel

Create a channel in a Discord guild. Supports text, voice, category, stage, and forum channel types..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to create the channel in. |
| `name` | string | yes | The name of the new channel (1–100 characters). |
| `type` | integer | no | Channel type: 0=text, 2=voice, 4=category, 13=stage, 15=forum. Default: 0 (text). |
| `topic` | string | no | The channel topic (0–1024 characters). |
| `parent_id` | string | no | The ID of the parent category channel. |

### Example

```lua
local result = app.integrations.discord.discord_create_channel({
  guild_id = ""
  name = ""
  type = 0
})
```

## discord_delete_message

Delete a Discord message by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel the message is in. |
| `message_id` | string | yes | The ID of the message to delete. |

### Example

```lua
local result = app.integrations.discord.discord_delete_message({
  channel_id = ""
  message_id = ""
})
```

## discord_get_channel

Get information about a Discord channel by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_channel({
  channel_id = ""
})
```

## discord_get_current_user

Get information about the current Discord bot user..

### Example

```lua
local result = app.integrations.discord.discord_get_current_user({
})
```

## discord_get_guild

Get information about a Discord guild by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_guild({
  guild_id = ""
})
```

## discord_get_message

Get a single Discord message by its ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel the message is in. |
| `message_id` | string | yes | The ID of the message to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_message({
  channel_id = ""
  message_id = ""
})
```

## discord_get_messages

Get messages from a Discord channel. Supports pagination with before/after and limit..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to get messages from. |
| `limit` | integer | no | Number of messages to retrieve (1–100, default 50). |
| `before` | string | no | Message ID to get messages before (for pagination). |
| `after` | string | no | Message ID to get messages after (for pagination). |

### Example

```lua
local result = app.integrations.discord.discord_get_messages({
  channel_id = ""
  limit = 0
  before = ""
})
```

## discord_get_user

Get information about a Discord user by their ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The ID of the user to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_user({
  user_id = ""
})
```

## discord_list_guild_channels

List all channels in a Discord guild..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to list channels for. |

### Example

```lua
local result = app.integrations.discord.discord_list_guild_channels({
  guild_id = ""
})
```

## discord_list_guild_members

List members of a Discord guild. Supports pagination with limit and after..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to list members for. |
| `limit` | integer | no | Number of members to retrieve (1–1000, default 1). |
| `after` | string | no | Member ID to get members after (for pagination). |

### Example

```lua
local result = app.integrations.discord.discord_list_guild_members({
  guild_id = ""
  limit = 0
  after = ""
})
```

## discord_list_guild_roles

List all roles in a Discord guild..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to list roles for. |

### Example

```lua
local result = app.integrations.discord.discord_list_guild_roles({
  guild_id = ""
})
```

## discord_modify_guild_member

Modify a guild member\.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild. |
| `user_id` | string | yes | The ID of the member to modify. |
| `nick` | string | no | The new nickname for the member. |
| `roles` | string | no | JSON array of role IDs to assign to the member. |
| `mute` | boolean | no | Whether to mute the member in voice channels. |
| `deaf` | boolean | no | Whether to deafen the member in voice channels. |

### Example

```lua
local result = app.integrations.discord.discord_modify_guild_member({
  guild_id = ""
  user_id = ""
  nick = ""
})
```

## discord_remove_member_role

Remove a role from a guild member in Discord..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild. |
| `user_id` | string | yes | The ID of the user to remove the role from. |
| `role_id` | string | yes | The ID of the role to remove. |

### Example

```lua
local result = app.integrations.discord.discord_remove_member_role({
  guild_id = ""
  user_id = ""
  role_id = ""
})
```

## discord_send_message

Send a message to a Discord channel. Supports text content and rich embeds..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to send the message to. |
| `content` | string | no | The text content of the message. |
| `embeds` | string | no | JSON array of embed objects for rich formatting. |
| `tts` | boolean | no | If true, the message will be read aloud via text-to-speech. |

### Example

```lua
local result = app.integrations.discord.discord_send_message({
  channel_id = ""
  content = ""
  embeds = ""
})
```

## discord_send_webhook

Execute a Discord webhook to send a message. Does not require bot authentication..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `webhook_id` | string | yes | The ID of the webhook. |
| `webhook_token` | string | yes | The token of the webhook. |
| `content` | string | no | The text content of the message. |
| `embeds` | string | no | JSON array of embed objects for rich formatting. |
| `username` | string | no | Override the default webhook username. |
| `avatar_url` | string | no | Override the default webhook avatar with a URL. |

### Example

```lua
local result = app.integrations.discord.discord_send_webhook({
  webhook_id = ""
  webhook_token = ""
  content = ""
})
```

## discord_update_channel

Update a Discord channel\.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to update. |
| `name` | string | no | The new name of the channel. |
| `topic` | string | no | The new channel topic (0–1024 characters). |
| `slowmode_interval` | integer | no | Slowmode delay in seconds (0–21600). Set to 0 to disable. |

### Example

```lua
local result = app.integrations.discord.discord_update_channel({
  channel_id = ""
  name = ""
  topic = ""
})
```

---

## Multi-Account Usage

If you have multiple discord accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.discord.function_name({...})

-- Explicit default (portable across setups)
app.integrations.discord.default.function_name({...})

-- Named accounts
app.integrations.discord.work.function_name({...})
app.integrations.discord.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
