# Google Chat

Google Chat tools are exposed under `app.integrations.google_chat`. This package is generated from Google's official Chat API v1 Discovery document and exposes 45 REST methods.

## Coverage

- Source: `https://chat.googleapis.com/$discovery/rest?version=v1`
- Read tools: 21
- Write tools: 24
- Base URL: `https://chat.googleapis.com`

## Usage Notes

Pass resource names such as `spaces/AAAA`, `spaces/AAAA/messages/BBBB`, `users/me/spaces/AAAA`, or `customEmojis/ID` exactly as Google Chat documents them. Path parameters named `name` and `parent` use reserved expansion, so slash-delimited resource names are preserved. Query parameters can be passed as top-level shortcuts or inside `query`. Create, update, patch, watch, and move methods accept the official JSON request object inside `body`.

`google_chat_media_upload` accepts `file_path`, optional `mime_type`, and optional metadata in `body`. The integration sends a Google multipart upload request with `uploadType=multipart`.

## Tools

- `google_chat_spaces_setup` - POST /v1/spaces:setup
- `google_chat_spaces_complete_import` - POST /v1/{+name}:completeImport
- `google_chat_spaces_find_group_chats` - GET /v1/spaces:findGroupChats
- `google_chat_spaces_patch` - PATCH /v1/{+name}
- `google_chat_spaces_search` - GET /v1/spaces:search
- `google_chat_spaces_create` - POST /v1/spaces
- `google_chat_spaces_delete` - DELETE /v1/{+name}
- `google_chat_spaces_find_direct_message` - GET /v1/spaces:findDirectMessage
- `google_chat_spaces_list` - GET /v1/spaces
- `google_chat_spaces_get` - GET /v1/{+name}
- `google_chat_spaces_space_events_get` - GET /v1/{+name}
- `google_chat_spaces_space_events_list` - GET /v1/{+parent}/spaceEvents
- `google_chat_spaces_members_create` - POST /v1/{+parent}/members
- `google_chat_spaces_members_patch` - PATCH /v1/{+name}
- `google_chat_spaces_members_get` - GET /v1/{+name}
- `google_chat_spaces_members_delete` - DELETE /v1/{+name}
- `google_chat_spaces_members_list` - GET /v1/{+parent}/members
- `google_chat_spaces_messages_get` - GET /v1/{+name}
- `google_chat_spaces_messages_delete` - DELETE /v1/{+name}
- `google_chat_spaces_messages_list` - GET /v1/{+parent}/messages
- `google_chat_spaces_messages_create` - POST /v1/{+parent}/messages
- `google_chat_spaces_messages_patch` - PATCH /v1/{+name}
- `google_chat_spaces_messages_update` - PUT /v1/{+name}
- `google_chat_spaces_messages_attachments_get` - GET /v1/{+name}
- `google_chat_spaces_messages_reactions_list` - GET /v1/{+parent}/reactions
- `google_chat_spaces_messages_reactions_delete` - DELETE /v1/{+name}
- `google_chat_spaces_messages_reactions_create` - POST /v1/{+parent}/reactions
- `google_chat_custom_emojis_create` - POST /v1/customEmojis
- `google_chat_custom_emojis_get` - GET /v1/{+name}
- `google_chat_custom_emojis_delete` - DELETE /v1/{+name}
- `google_chat_custom_emojis_list` - GET /v1/customEmojis
- `google_chat_media_upload` - POST /v1/{+parent}/attachments:upload (media upload)
- `google_chat_media_download` - GET /v1/media/{+resourceName}
- `google_chat_users_spaces_get_space_read_state` - GET /v1/{+name}
- `google_chat_users_spaces_update_space_read_state` - PATCH /v1/{+name}
- `google_chat_users_spaces_space_notification_setting_get` - GET /v1/{+name}
- `google_chat_users_spaces_space_notification_setting_patch` - PATCH /v1/{+name}
- `google_chat_users_spaces_threads_get_thread_read_state` - GET /v1/{+name}
- `google_chat_users_sections_delete` - DELETE /v1/{+name}
- `google_chat_users_sections_list` - GET /v1/{+parent}/sections
- `google_chat_users_sections_position` - POST /v1/{+name}:position
- `google_chat_users_sections_patch` - PATCH /v1/{+name}
- `google_chat_users_sections_create` - POST /v1/{+parent}/sections
- `google_chat_users_sections_items_list` - GET /v1/{+parent}/items
- `google_chat_users_sections_items_move` - POST /v1/{+name}:move

## Examples

```lua
local spaces = app.integrations.google_chat.google_chat_spaces_list({ pageSize = 10 })

local message = app.integrations.google_chat.google_chat_spaces_messages_create({
  parent = "spaces/AAAAexample",
  body = { text = "Deployment complete" }
})
```

Responses are decoded Google Chat JSON responses, or `{ success = true, status = ... }` for successful empty responses such as deletes.
