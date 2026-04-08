# Microsoft Teams — Lua API Reference

## Overview

The Microsoft Teams integration provides 7 tools for interacting with Microsoft Teams via the Microsoft Graph API: listing and viewing teams and channels, sending and listing messages, and getting the current user.

All tools are called via `app.integrations.teams.<tool_name>({ ... })` and return a Lua table with the API response.

## Authentication

The Microsoft Teams integration uses a **Bearer Access Token** obtained from Microsoft Entra ID (Azure AD).

Create a token: **Microsoft Entra ID → App Registrations → Your App → Certificates & Secrets**

The access token must have the required delegated permissions (e.g. `Team.ReadBasic.All`, `Channel.ReadBasic.All`, `ChannelMessage.Send`, `ChannelMessage.Read.All`, `User.Read`).

---

## Teams

### `app.integrations.teams.list_teams({ top, skip })`

List all Microsoft Teams the authenticated user is a member of. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Number of teams to return (default 20, max 999). |
| `skip` | integer | no | Number of teams to skip for pagination. |

```lua
local result = app.integrations.teams.list_teams({
  top = 50
})
-- result.teams contains the team list
-- Each team has: id, displayName, description, isArchived, etc.
```

```lua
-- Paginate through teams
local result = app.integrations.teams.list_teams({
  top = 20,
  skip = 20
})
```

---

### `app.integrations.teams.get_team({ team_id })`

Get detailed information about a specific Microsoft Team.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team. |

```lua
local result = app.integrations.teams.get_team({
  team_id = "19:abc123..."
})
-- result.team contains the team object (displayName, description, visibility, etc.)
```

---

## Channels

### `app.integrations.teams.list_channels({ team_id, top, skip })`

List all channels in a Microsoft Team. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team. |
| `top` | integer | no | Number of channels to return (default 20, max 999). |
| `skip` | integer | no | Number of channels to skip for pagination. |

```lua
local result = app.integrations.teams.list_channels({
  team_id = "19:abc123..."
})
-- result.channels contains the channel list
-- Each channel has: id, displayName, description, membershipType, etc.
```

```lua
-- With pagination
local result = app.integrations.teams.list_channels({
  team_id = "19:abc123...",
  top = 50
})
```

---

### `app.integrations.teams.get_channel({ team_id, channel_id })`

Get detailed information about a specific Teams channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team. |
| `channel_id` | string | yes | The ID of the channel. |

```lua
local result = app.integrations.teams.get_channel({
  team_id = "19:abc123...",
  channel_id = "19:def456..."
})
-- result.channel contains the channel object (displayName, description, webUrl, etc.)
```

---

## Messages

### `app.integrations.teams.send_message({ team_id, channel_id, content, content_type })`

Send a message to a Microsoft Teams channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team. |
| `channel_id` | string | yes | The ID of the channel. |
| `content` | string | yes | The message content to send. |
| `content_type` | string | no | Content type: `"text"` (default) or `"html"`. |

```lua
local result = app.integrations.teams.send_message({
  team_id = "19:abc123...",
  channel_id = "19:def456...",
  content = "Hello from the integration!"
})
-- result.message contains the sent message object
-- result.message.id is the message ID
-- result.message.webUrl is the link to the message in Teams
```

```lua
-- Send an HTML-formatted message
local result = app.integrations.teams.send_message({
  team_id = "19:abc123...",
  channel_id = "19:def456...",
  content = "<b>Deploy complete!</b> Version <code>2.1.0</code> is live.",
  content_type = "html"
})
```

---

### `app.integrations.teams.list_messages({ team_id, channel_id, top, skip })`

List messages in a Microsoft Teams channel. Supports pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The ID of the team. |
| `channel_id` | string | yes | The ID of the channel. |
| `top` | integer | no | Number of messages to return (default 20, max 50). |
| `skip` | integer | no | Number of messages to skip for pagination. |

```lua
local result = app.integrations.teams.list_messages({
  team_id = "19:abc123...",
  channel_id = "19:def456...",
  top = 25
})
-- result.messages contains the message list
-- Each message has: id, body, from, createdDateTime, etc.
```

```lua
-- Paginate through messages
local result = app.integrations.teams.list_messages({
  team_id = "19:abc123...",
  channel_id = "19:def456...",
  top = 25,
  skip = 25
})
```

---

## Users

### `app.integrations.teams.get_current_user()`

Get information about the currently authenticated Microsoft 365 user.

```lua
local result = app.integrations.teams.get_current_user()
-- result.user contains the user object
-- result.user.displayName is the user's display name
-- result.user.userPrincipalName is the user's UPN / email
-- result.user.id is the user's ID
```

---

## Pagination

Several list endpoints support pagination via `$top` and `$skip` parameters. When a response includes an `@odata.nextLink` field, there are more results available. The `top` parameter controls page size and `skip` offsets into the result set.

| Tool | Pagination style | Key params |
|------|-----------------|------------|
| `list_teams` | OData ($top/$skip) | `top`, `skip` |
| `list_channels` | OData ($top/$skip) | `top`, `skip` |
| `list_messages` | OData ($top/$skip) | `top`, `skip` |

---

## Notes

- **Team and channel IDs:** Microsoft Teams uses opaque string IDs (e.g. `"19:abc123..."`). Always use the exact ID returned by the API — do not construct IDs manually.
- **Message body format:** Messages use a `body` structure with `content` and `contentType` fields. The content type can be `"text"` or `"html"`.
- **Permissions:** The access token must have the appropriate Microsoft Graph delegated permissions for each operation:
  - `Team.ReadBasic.All` — list and get teams
  - `Channel.ReadBasic.All` — list and get channels
  - `ChannelMessage.Send` — send messages
  - `ChannelMessage.Read.All` — list messages
  - `User.Read` — get current user
- **Rate limits:** Microsoft Graph API rate limits apply. Use pagination parameters rather than requesting large result sets in a single call.
- **Token expiry:** Access tokens have a limited lifetime. Implement token refresh logic if making long-running calls.

---

## Multi-Account Usage

If you have multiple teams accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.teams.function_name({...})

-- Explicit default (portable across setups)
app.integrations.teams.default.function_name({...})

-- Named accounts
app.integrations.teams.work.function_name({...})
app.integrations.teams.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
