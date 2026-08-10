# Front JavaScript API Reference

Namespace: `app.integrations.front`

Front tools call the Front Core API with the configured bearer token. Most list endpoints return Front's normal paginated shape, usually `_results` plus `_pagination`; use `page_token` from `_pagination.next` when Front returns one. JSON helpers do not upload files. Use raw API helpers or a host-specific upload flow for multipart attachment and avatar endpoints.

## Raw API helpers

Use these when Front adds a new endpoint before a typed helper exists:

- `api_get({ path = "/tags", query = { limit = 25 } })`
- `api_post({ path = "/contacts", body = { handles = {{ source = "email", handle = "person@example.test" }} } })`
- `api_patch({ path = "/contacts/crd_123", body = { custom_fields = { Tier = "Gold" } } })`
- `api_put({ path = "/some/path", body = {} })`
- `api_delete({ path = "/tags/tag_123" })`

Paths are relative to `https://api2.frontapp.com`; a leading slash is optional.

## Conversations, Messages, and Comments

- `get_current_user({})`
- `list_conversations({ q, limit, page_token, page, status })`
- `search_conversations({ query_text, limit, page_token })`
- `get_conversation({ conversation_id })`
- `create_discussion_conversation({ type = "discussion", inbox_id, teammate_ids, subject, comment, custom_fields })`
- `update_conversation({ conversation_id, assignee_id, inbox_id, status, status_id, tag_ids, custom_fields })`
- `update_conversation_reminders({ conversation_id, teammate_id, scheduled_at, status_id })`
- `list_conversation_inboxes({ conversation_id })`
- `list_messages({ conversation_id, limit, page_token, sort_by, sort_order })`
- `get_message({ message_id })`
- `send_message({ conversation_id, channel_id, author_id, to, cc, bcc, subject, body, text, quote_body, options })`
- `create_message({ channel_id, to, cc, bcc, subject, body, text, author_id })`
- `import_message({ inbox_id, sender, to, external_id, created_at, body, metadata, tags })`
- `create_draft({ channel_id, to, cc, bcc, subject, body, author_id })`
- `list_conversation_comments({ conversation_id })`
- `add_comment({ conversation_id, body, author_id, is_pinned })`
- `add_conversation_tags({ conversation_id, tag_ids })`
- `remove_conversation_tags({ conversation_id, tag_ids })`

Example:

```js
var conversations = app.integrations.front.search_conversations({
  query_text: "billing is:open",
  limit: 10,
})

var first = conversations._results && conversations._results[0]
if (first) {
  app.integrations.front.add_comment({
    conversation_id: first.id,
    body: "Followed up from automation.",
  })
}
```
## Inboxes and Channels

- `list_inboxes({ limit, page_token })`
- `get_inbox({ inbox_id })`
- `list_inbox_conversations({ inbox_id, q, limit, page_token })`
- `list_inbox_channels({ inbox_id })`
- `create_channel({ inbox_id, type, name, send_as, settings })`
- `list_inbox_access({ inbox_id })`
- `add_inbox_access({ inbox_id, teammate_ids })`
- `remove_inbox_access({ inbox_id, teammate_ids })`
- `create_team_inbox({ team_id, name, teammate_ids, is_public, custom_fields })`

## Contacts

- `list_contacts({ q, limit, page_token, sort_by, sort_order })`
- `get_contact({ contact_id })`
- `create_contact({ handles, name, description, links, list_names, custom_fields })`
- `create_teammate_contact({ teammate_id, handles, name, description, links, list_names, custom_fields })`
- `update_contact({ contact_id, name, description, links, list_names, custom_fields })`
- `delete_contact({ contact_id })`
- `add_contact_handle({ contact_id, handle, source })`
- `list_contact_conversations({ contact_id, q, limit, page_token })`
- `list_team_contacts({ team_id, q, limit, page_token, sort_by, sort_order })`
- `list_teammate_contacts({ teammate_id, q, limit, page_token, sort_by, sort_order })`

Contact aliases are supported where Front supports them, for example `alt:email:person@example.test`.

## Teams, Teammates, Rules, and Tags

- `list_teammates({})`
- `get_teammate({ teammate_id })`
- `update_teammate({ teammate_id, body })`
- `list_assigned_conversations({ teammate_id, q, limit, page_token })`
- `list_teammate_inboxes({ teammate_id })`
- `list_teammate_rules({ teammate_id })`
- `list_teams({})`
- `get_team({ team_id })`
- `list_team_inboxes({ team_id })`
- `list_team_rules({ team_id })`
- `list_tags({ limit, page_token, sort_by, sort_order })`
- `get_tag({ tag_id })`
- `create_tag({ name, description, highlight, is_visible_in_conversation_lists })`
- `create_company_tag({ name, description, highlight, is_visible_in_conversation_lists })`
- `create_team_tag({ team_id, name, description, highlight, is_visible_in_conversation_lists })`
- `create_teammate_tag({ teammate_id, name, description, highlight, is_visible_in_conversation_lists })`
- `update_tag({ tag_id, name, description, highlight, parent_tag_id, is_visible_in_conversation_lists })`
- `delete_tag({ tag_id })`
- `list_tagged_conversations({ tag_id, q, limit, page_token })`
- `list_company_tags({ limit, page_token, sort_by, sort_order })`
- `list_team_tags({ team_id, limit, page_token, sort_by, sort_order })`
- `list_teammate_tags({ teammate_id, limit, page_token, sort_by, sort_order })`

## Multi-Account Usage

```js
app.integrations.front.list_conversations({ limit: 10 })
app.integrations.front.default.list_conversations({ limit: 10 })
app.integrations.front.support.list_conversations({ limit: 10 })
```
The tool names and return shapes are the same for each account; only credentials differ.
