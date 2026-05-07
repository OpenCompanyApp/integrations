# Mattermost

Mattermost tools are exposed under `app.integrations.mattermost`. The integration targets the Mattermost REST API v4 using a personal access token or bot token.

## Raw API Helpers

Use raw helpers for REST API v4 endpoints that do not yet have a first-class tool:

- `mattermost_api_get`
- `mattermost_api_post`
- `mattermost_api_put`
- `mattermost_api_patch`
- `mattermost_api_delete`

Paths can be relative to `/api/v4` or include `/api/v4`.

```lua
local users = app.integrations.mattermost.mattermost_api_get({
  path = "/users",
  query = {
    page = 0,
    per_page = 20
  }
})
```

## Users

```lua
local me = app.integrations.mattermost.mattermost_get_current_user({})

local results = app.integrations.mattermost.mattermost_search_users({
  term = "alex",
  team_id = "team_123"
})
```

User tools:

- `mattermost_list_users`
- `mattermost_search_users`
- `mattermost_get_user`
- `mattermost_get_user_by_username`
- `mattermost_create_user`
- `mattermost_patch_user`
- `mattermost_deactivate_user`
- `mattermost_get_current_user`

User creation and activation changes require server permissions for the token.

## Teams

```lua
local teams = app.integrations.mattermost.mattermost_list_teams({
  page = 0,
  per_page = 60
})

app.integrations.mattermost.mattermost_add_team_member({
  team_id = "team_123",
  user_id = "user_123"
})
```

Team tools:

- `mattermost_list_teams`
- `mattermost_get_team`
- `mattermost_create_team`
- `mattermost_patch_team`
- `mattermost_list_team_members`
- `mattermost_add_team_member`
- `mattermost_remove_team_member`

## Channels

```lua
local channels = app.integrations.mattermost.mattermost_list_team_channels({
  team_id = "team_123",
  page = 0,
  per_page = 50
})

local created = app.integrations.mattermost.mattermost_create_channel({
  team_id = "team_123",
  name = "release-updates",
  display_name = "Release Updates",
  type = "O"
})
```

Channel tools:

- `mattermost_list_channels`
- `mattermost_list_team_channels`
- `mattermost_search_channels`
- `mattermost_create_channel`
- `mattermost_get_channel`
- `mattermost_patch_channel`
- `mattermost_delete_channel`
- `mattermost_list_channel_members`
- `mattermost_add_channel_member`
- `mattermost_remove_channel_member`

The legacy `mattermost_list_channels` tool lists channels for the current user. Use `mattermost_list_team_channels` when you need channels in a specific team.

## Posts, Threads, And Reactions

```lua
local post = app.integrations.mattermost.mattermost_create_post({
  channel_id = "channel_123",
  message = "Deployment finished."
})

local thread = app.integrations.mattermost.mattermost_get_post_thread({
  post_id = post.id
})
```

Post and reaction tools:

- `mattermost_create_post`
- `mattermost_list_posts`
- `mattermost_get_post`
- `mattermost_patch_post`
- `mattermost_delete_post`
- `mattermost_search_posts`
- `mattermost_get_post_thread`
- `mattermost_list_post_reactions`
- `mattermost_create_reaction`
- `mattermost_delete_reaction`

## Files

`mattermost_get_file_info` returns metadata for a file ID. File upload/download endpoints can involve multipart or binary payloads, so use raw helpers only when the host can handle that request or response shape.

## Output Shape

Existing compatibility tools such as `mattermost_list_posts`, `mattermost_list_channels`, and `mattermost_get_current_user` keep their current normalized responses. New endpoint-mapped tools return Mattermost's parsed JSON response directly, or an empty object for `204 No Content`.
