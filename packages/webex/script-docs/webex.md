# Cisco Webex JavaScript API Reference

Namespace: `app.integrations.webex`

Use this integration for Webex Messaging, Teams, Meetings, People, Memberships,
Webhooks, and relative Webex REST API calls. Returned data is the parsed Webex
JSON response with the package's parameter validation applied before the request.

## Common Patterns

List rooms before reading messages or posting:

```js
var rooms = app.integrations.webex.list_rooms({ max: 20 })

for (const room of (rooms.items || [])) {
  console.log(room.id + " " + room.title)
}
```
Create a message with either `text`, `markdown`, or both:

```js
app.integrations.webex.create_message({
  room_id: "room_123",
  text: "Summary report attached.",
  markdown: "**Summary report**\n\n* Revenue is up\n* Churn is flat",
})
```
Pass official Webex fields that are not first-class parameters through
`payload` on create/update tools:

```js
app.integrations.webex.create_webhook({
  name: "Room messages",
  targetUrl: "https://example.test/webex",
  resource: "messages",
  event: "created",
  filter: "roomId=room_123",
})
```
## Rooms

| Function | Purpose |
|----------|---------|
| `list_rooms({ max?, before?, after? })` | List rooms visible to the token. `max` is capped at 1000. |
| `get_room({ room_id })` | Get one room by ID. |
| `create_room({ title, teamId?, classificationId?, payload? })` | Create a standalone or team room. |
| `update_room({ room_id, title?, isLocked?, isPublic?, payload? })` | Update room metadata. |
| `delete_room({ room_id })` | Delete one room. |

## Messages

| Function | Purpose |
|----------|---------|
| `list_messages({ room_id, max?, before?, after? })` | List messages from a room. `max` is capped at 1000. |
| `create_message({ room_id, text?, markdown? })` | Post a message. At least one of `text` or `markdown` is required. |
| `get_message({ message_id })` | Get one message by ID. |
| `update_message({ message_id, text?, markdown?, payload? })` | Update a message. At least one update field is required. |
| `delete_message({ message_id })` | Delete one message. |

Bots can only see messages in rooms where they are present, and bot tokens only
receive messages where the bot is mentioned unless the upstream token has wider
scopes.

## People And Memberships

| Function | Purpose |
|----------|---------|
| `list_people({ email?, displayName?, id?, orgId?, max? })` | Search or list people visible to the token. |
| `get_person({ person_id })` | Get one person profile. |
| `list_memberships({ roomId?, personId?, personEmail?, max? })` | List room memberships. |
| `create_membership({ roomId, personId?, personEmail?, isModerator?, payload? })` | Add a person to a room. |
| `delete_membership({ membership_id })` | Remove a room membership. |

Use either `personId` or `personEmail` when creating a membership.

## Teams

| Function | Purpose |
|----------|---------|
| `list_teams({ max? })` | List teams visible to the token. |
| `get_team({ team_id })` | Get one team by ID. |
| `create_team({ name, payload? })` | Create a team. |
| `update_team({ team_id, name?, payload? })` | Update a team. |
| `delete_team({ team_id })` | Delete one team. |
| `list_team_memberships({ teamId?, personId?, personEmail?, max? })` | List team memberships. |

## Meetings

| Function | Purpose |
|----------|---------|
| `list_meetings({ from?, to?, max? })` | List scheduled meetings. `max` is capped at 100. |
| `get_meeting({ meeting_id })` | Get one meeting by ID. |
| `create_meeting({ title, start, end, invitees?, payload? })` | Create a meeting. |
| `update_meeting({ meeting_id, title?, start?, end?, invitees?, payload? })` | Update a meeting. |
| `delete_meeting({ meeting_id })` | Delete one meeting. |

Meeting create and update payloads are forwarded as Webex JSON fields, so include
only fields supported by the meeting scopes available to the stored token.

## Webhooks

| Function | Purpose |
|----------|---------|
| `list_webhooks({ max? })` | List webhooks. |
| `get_webhook({ webhook_id })` | Get one webhook. |
| `create_webhook({ name, targetUrl, resource, event, filter?, payload? })` | Register a webhook callback. |
| `update_webhook({ webhook_id, name?, targetUrl?, status?, payload? })` | Update a webhook. |
| `delete_webhook({ webhook_id })` | Delete one webhook. |

Webhook resources and events are scope-dependent. Some Webex for Government
deployments do not expose every resource type.

## Generic API Helpers

| Function | Purpose |
|----------|---------|
| `api_get({ path, params? })` | Send GET to a relative Webex API path. |
| `api_post({ path, payload? })` | Send POST to a relative Webex API path. |
| `api_put({ path, payload? })` | Send PUT to a relative Webex API path. |
| `api_delete({ path, payload? })` | Send DELETE to a relative Webex API path. |

Generic API helpers reject absolute URLs. Use paths such as `/rooms`,
`/messages/message_123`, or `/team/memberships` so host credentials and base URL
stay centralized in the service layer.

## Current User

`get_current_user({})` returns the authenticated profile from `/people/me`.
Use it to confirm which Webex identity a configured account represents.

## Multi-Account Usage

All functions work the same way under account-specific namespaces:

```js
app.integrations.webex.list_rooms({ max: 20 })
app.integrations.webex.default.list_rooms({ max: 20 })
app.integrations.webex.work.list_rooms({ max: 20 })
```