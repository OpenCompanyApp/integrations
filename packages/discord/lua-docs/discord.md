# Client for the Discord REST API (v10) covering channels, messages, guilds, and users — Lua API Reference

## discord_list_channels

List all channels in a Discord guild.
Returns channel IDs, names, types, and topics.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to list channels for. |

### Example

```lua
local result = app.integrations.discord.discord_list_channels({
  guild_id = "1234567890"
})
```

## discord_get_channel

Get information about a Discord channel by its ID.
Returns the channel's ID, name, type, topic, and other properties.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_channel({
  channel_id = "1234567890"
})
```

## discord_send_message

Send a message to a Discord channel. Supports text content and rich embeds.
Returns the sent message ID and channel ID.

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
  channel_id = "1234567890"
  content = "Hello from the integration!"
})
```

## discord_list_messages

Get messages from a Discord channel. Supports pagination with before/after and limit.
Returns message IDs, content, author info, and timestamps.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to get messages from. |
| `limit` | integer | no | Number of messages to retrieve (1–100, default 50). |
| `before` | string | no | Message ID to get messages before (for pagination). |
| `after` | string | no | Message ID to get messages after (for pagination). |

### Example

```lua
local result = app.integrations.discord.discord_list_messages({
  channel_id = "1234567890"
  limit = 25
})
```

## discord_list_guilds

List guilds the current Discord user is a member of.
Returns guild IDs, names, icons, and owner status.
Use limit, before, and after for pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of guilds to retrieve (1–200, default 200). |
| `before` | string | no | Guild ID to get guilds before (for pagination). |
| `after` | string | no | Guild ID to get guilds after (for pagination). |

### Example

```lua
local result = app.integrations.discord.discord_list_guilds({
  limit = 50
})
```

## discord_get_guild

Get information about a Discord guild by its ID.
Returns the guild's ID, name, icon, description, member count, and other properties.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guild_id` | string | yes | The ID of the guild to retrieve. |

### Example

```lua
local result = app.integrations.discord.discord_get_guild({
  guild_id = "1234567890"
})
```

## discord_get_current_user

Retrieve the currently authenticated Discord user.
Returns the user's ID, username, discriminator, and avatar.
Useful for identifying which account or token is in use.

### Example

```lua
local result = app.integrations.discord.discord_get_current_user({
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
