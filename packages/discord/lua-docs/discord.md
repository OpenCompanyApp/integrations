# Discord

Discord tools are exposed under `app.integrations.discord`. The integration targets Discord REST API v10 and supports both OAuth-style `Bearer` tokens and bot tokens through the `token_type` credential.

Use `token_type = "Bot"` for Discord bot tokens. Use `token_type = "Bearer"` for OAuth access tokens. Many guild moderation, role, webhook, and message-management endpoints require bot tokens with the corresponding guild permissions.

## Raw API Helpers

Use the raw helpers for Discord REST endpoints that do not yet have a first-class tool:

- `discord_api_get`
- `discord_api_post`
- `discord_api_patch`
- `discord_api_put`
- `discord_api_delete`

Paths are relative to `https://discord.com/api/v10`.

```lua
local roles = app.integrations.discord.discord_api_get({
  path = "/guilds/1234567890/roles"
})
```

## Guild And Channel Discovery

```lua
local me = app.integrations.discord.discord_get_current_user({})

local guilds = app.integrations.discord.discord_list_guilds({
  limit = 50
})

local channels = app.integrations.discord.discord_list_channels({
  guild_id = "1234567890"
})
```

Channel lifecycle tools:

- `discord_create_guild_channel`
- `discord_get_channel`
- `discord_edit_channel`
- `discord_delete_channel`
- `discord_edit_channel_positions`

Most create/update tools accept first-class snake_case fields and a raw `body` object for Discord's exact request schema.

## Messages

```lua
local sent = app.integrations.discord.discord_send_message({
  channel_id = "2222222222",
  content = "Deployment finished."
})

local messages = app.integrations.discord.discord_list_messages({
  channel_id = "2222222222",
  limit = 25
})
```

Message management tools include:

- `discord_get_message`
- `discord_edit_message`
- `discord_delete_message`
- `discord_bulk_delete_messages`
- `discord_list_pinned_messages`
- `discord_pin_message`
- `discord_unpin_message`
- `discord_create_reaction`
- `discord_delete_own_reaction`
- `discord_list_reaction_users`

Discord restricts message reads and content fields based on bot membership, channel permissions, and privileged intents. The REST API may return messages without full content when the token is not allowed to view it.

## Members, Roles, And Moderation

```lua
local members = app.integrations.discord.discord_list_guild_members({
  guild_id = "1234567890",
  limit = 100
})

app.integrations.discord.discord_add_guild_member_role({
  guild_id = "1234567890",
  user_id = "3333333333",
  role_id = "4444444444"
})
```

Available tools:

- `discord_list_guild_members`
- `discord_get_guild_member`
- `discord_edit_guild_member`
- `discord_kick_guild_member`
- `discord_add_guild_member_role`
- `discord_remove_guild_member_role`
- `discord_list_guild_roles`
- `discord_create_guild_role`
- `discord_edit_guild_role`
- `discord_delete_guild_role`
- `discord_list_guild_bans`
- `discord_create_guild_ban`
- `discord_remove_guild_ban`

Use caution with destructive moderation tools. Discord permission errors are returned directly from the API.

## Invites And Webhooks

Invite tools:

- `discord_list_guild_invites`
- `discord_create_channel_invite`
- `discord_get_invite`
- `discord_delete_invite`

Webhook tools:

- `discord_list_channel_webhooks`
- `discord_list_guild_webhooks`
- `discord_create_webhook`
- `discord_get_webhook`
- `discord_edit_webhook`
- `discord_delete_webhook`

Webhook execution with webhook token is intentionally left to raw API helpers because it uses token-in-path authentication and may be better handled by a dedicated unauthenticated webhook-send integration.

## Output Shape

Existing compatibility tools such as `discord_list_messages`, `discord_list_channels`, and `discord_get_current_user` keep their normalized response shape. New endpoint-mapped tools return Discord's parsed JSON response directly, or an empty object for `204 No Content` responses.
