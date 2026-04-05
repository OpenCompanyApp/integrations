# Mattermost — Lua API Reference

## Authentication

The Mattermost integration uses a **Personal Access Token** (or Bot Token) sent via the `Authorization: Bearer {token}` header. You also need the base URL of your Mattermost server (e.g. `https://mattermost.example.com/api/v4`).

Create a token: **Mattermost → Account Settings → Security → Personal Access Tokens**

## Pagination

List endpoints use `page` (0-indexed) and `per_page` parameters. Default page size is 60.

## Common Workflows

### Post a message to a channel

1. `mattermost_list_teams` — Find the team
2. `mattermost_list_channels` — Find the channel
3. `mattermost_create_post` — Send the message

### Reply in a thread

1. `mattermost_create_post` — Note the `id` of the parent post
2. `mattermost_create_post` — Pass `root_id` with the parent post ID

### Upload and attach a file

1. `mattermost_upload_file` — Upload the file, note the returned file ID
2. `mattermost_create_post` — Pass `file_ids` as a JSON array with the file ID

### Create a new channel

1. `mattermost_list_teams` — Get the team ID
2. `mattermost_create_channel` — Create the channel

---

## mattermost_create_post

Create a new post in a Mattermost channel. Supports file attachments, custom properties, and thread replies.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to create the post in |
| `message` | string | yes | The message content of the post |
| `root_id` | string | no | The parent post ID for creating a thread reply |
| `file_ids` | string | no | JSON array of file IDs to attach (from `mattermost_upload_file`) |
| `props` | string | no | JSON object of custom properties for the post |

```lua
local result = app.integrations.mattermost.mattermost_create_post({
  channel_id = "abc123",
  message = "Hello from the integration!"
})
-- result.id is the new post ID
```

### Thread reply

```lua
local result = app.integrations.mattermost.mattermost_create_post({
  channel_id = "abc123",
  message = "Replying to the thread",
  root_id = "parent_post_id"
})
```

## mattermost_get_post

Get a Mattermost post by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to retrieve |

```lua
local result = app.integrations.mattermost.mattermost_get_post({ post_id = "post123" })
-- result.post contains the full post object
```

## mattermost_delete_post

Delete a Mattermost post by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to delete |

```lua
local result = app.integrations.mattermost.mattermost_delete_post({ post_id = "post123" })
-- result.ok == true on success
```

## mattermost_list_posts

List posts in a Mattermost channel. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to list posts from |
| `page` | integer | no | Page number (0-indexed, default 0) |
| `per_page` | integer | no | Number of posts per page (default 60) |

```lua
local result = app.integrations.mattermost.mattermost_list_posts({
  channel_id = "abc123",
  page = 0,
  per_page = 20
})
-- result.posts contains the post list
```

## mattermost_create_channel

Create a channel in a Mattermost team.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team to create the channel in |
| `name` | string | yes | URL-friendly channel name (lowercase, no spaces) |
| `display_name` | string | no | Human-readable display name |
| `type` | string | no | `"O"` for open (default), `"P"` for private |
| `purpose` | string | no | Brief description of the channel purpose |

```lua
local result = app.integrations.mattermost.mattermost_create_channel({
  team_id = "team123",
  name = "project-alpha",
  display_name = "Project Alpha",
  type = "O",
  purpose = "Discussion for Project Alpha"
})
-- result.id is the new channel ID
```

## mattermost_list_channels

List channels in a Mattermost team. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team to list channels for |
| `page` | integer | no | Page number (0-indexed, default 0) |
| `per_page` | integer | no | Number of channels per page (default 60) |

```lua
local result = app.integrations.mattermost.mattermost_list_channels({
  team_id = "team123"
})
-- result.channels contains the channel list
```

## mattermost_get_channel

Get a Mattermost channel by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to retrieve |

```lua
local result = app.integrations.mattermost.mattermost_get_channel({ channel_id = "abc123" })
-- result.channel contains the channel object
```

## mattermost_list_teams

List all Mattermost teams. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-indexed, default 0) |
| `per_page` | integer | no | Number of teams per page (default 60) |

```lua
local result = app.integrations.mattermost.mattermost_list_teams({})
-- result.teams contains the team list
```

## mattermost_get_team

Get a Mattermost team by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team to retrieve |

```lua
local result = app.integrations.mattermost.mattermost_get_team({ team_id = "team123" })
-- result.team contains the team object
```

## mattermost_list_users

List Mattermost users. Supports pagination and filtering by team.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-indexed, default 0) |
| `per_page` | integer | no | Number of users per page (default 60) |
| `in_team_id` | string | no | Filter users to those in the specified team |

```lua
local result = app.integrations.mattermost.mattermost_list_users({
  page = 0,
  per_page = 50,
  in_team_id = "team123"
})
-- result.users contains the user list
```

## mattermost_get_user

Get a Mattermost user by their ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The ID of the user to retrieve |

```lua
local result = app.integrations.mattermost.mattermost_get_user({ user_id = "user123" })
-- result.user contains the user object
```

## mattermost_upload_file

Upload a file to Mattermost. The returned file ID can be attached to a post using the `file_ids` parameter of `mattermost_create_post`.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel_id` | string | yes | The ID of the channel to associate the file with |
| `filename` | string | yes | The name of the file to upload |
| `file_content` | string | yes | The raw file content (base64 encoded for binary files) |

```lua
local upload = app.integrations.mattermost.mattermost_upload_file({
  channel_id = "abc123",
  filename = "report.pdf",
  file_content = "<base64-encoded-content>"
})

-- Attach the uploaded file to a post
local post = app.integrations.mattermost.mattermost_create_post({
  channel_id = "abc123",
  message = "Here is the report",
  file_ids = '["' .. upload.file_infos[1].id .. '"]'
})
```
