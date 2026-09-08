# Slack — Ruby API Reference

## Overview

The Slack integration provides 25 tools for interacting with Slack workspaces: sending and managing messages, managing channels, uploading and listing files, looking up users, adding emoji reactions, and managing usergroups.

All tools are called via `app.integrations.slack.<tool_name>({ ... })` and return a Ruby object with the API response.

## Authentication

The Slack integration uses a **Bot Token** (`xoxb-...`) obtained from your Slack app configuration.

Create a token: **Slack → Your App → OAuth & Permissions → Bot User OAuth Token**

The bot token determines which channels and actions are available based on the OAuth scopes assigned to the app (e.g. `chat:write`, `channels:read`, `files:write`).

---

## Messages

### `app.integrations.slack.send_message({ channel, text, thread_ts, blocks, reply_broadcast, unfurl_links, markdown })`

Send a message to a Slack channel or DM. Supports text formatting, Block Kit blocks, thread replies, and link unfurling.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID or name (e.g. `"#general"` or `"C12345678"`). |
| `text` | string | yes | Message text. |
| `blocks` | string | no | JSON array of Slack Block Kit blocks for rich formatting. |
| `thread_ts` | string | no | Timestamp of the parent message to reply in a thread. |
| `reply_broadcast` | boolean | no | If true, also post the reply to the channel (requires `thread_ts`). |
| `unfurl_links` | boolean | no | If true, enable unfurling of links. |
| `markdown` | boolean | no | If true, enable mrkdwn formatting in text. |

```ruby
result = app.integrations.slack.send_message(channel: "C12345678", text: "Hello from the integration!")
```
```ruby
# Reply in a thread
result = app.integrations.slack.send_message(channel: "C12345678", text: "Replying to the thread", thread_ts: "1234567890.123456")
```
```ruby
# Rich formatting with Block Kit
result = app.integrations.slack.send_message(channel: "C12345678", text: "Deploy notification", blocks: "[{\"type\":\"section\",\"text\":{\"type\":\"mrkdwn\",\"text\":\"*Deploy complete*\nVersion `2.1.0` is live.\"}}]")
```
---

### `app.integrations.slack.update_message({ channel, ts, text, blocks })`

Update an existing Slack message's text or blocks.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID where the message was posted. |
| `ts` | string | yes | Timestamp of the message to update. |
| `text` | string | no | New message text. |
| `blocks` | string | no | JSON array of Slack Block Kit blocks. |

```ruby
result = app.integrations.slack.update_message(channel: "C12345678", ts: "1234567890.123456", text: "Updated message content")
```
```ruby
# Update with Block Kit
result = app.integrations.slack.update_message(channel: "C12345678", ts: "1234567890.123456", text: "Status update", blocks: "[{\"type\":\"section\",\"text\":{\"type\":\"mrkdwn\",\"text\":\"*Status:* ✅ Complete\"}}]")
```
---

### `app.integrations.slack.delete_message({ channel, ts })`

Delete a Slack message by channel and timestamp.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID where the message was posted. |
| `ts` | string | yes | Timestamp of the message to delete. |

```ruby
result = app.integrations.slack.delete_message(channel: "C12345678", ts: "1234567890.123456")
```
---

### `app.integrations.slack.get_message({ channel, ts, thread_ts })`

Get a specific message by its timestamp. Optionally retrieve a message within a thread.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `ts` | string | yes | Timestamp of the message to retrieve. |
| `thread_ts` | string | no | If provided, fetches a reply within this thread instead. |

```ruby
result = app.integrations.slack.get_message(channel: "C12345678", ts: "1234567890.123456")
```
```ruby
# Get a specific thread reply
result = app.integrations.slack.get_message(channel: "C12345678", ts: "1234567891.654321", thread_ts: "1234567890.123456")
```
---

### `app.integrations.slack.search_messages({ query, count, page, sort, sort_dir })`

Search for messages across all Slack channels and DMs. Supports Slack search modifiers.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query. Supports modifiers like `from:`, `in:`, `has:`, `after:`, `before:`. |
| `count` | integer | no | Number of results per page (default 20, max 100). |
| `page` | integer | no | Page number of results (default 1). |
| `sort` | string | no | Sort order: `"score"` (default) or `"timestamp"`. |
| `sort_dir` | string | no | Sort direction: `"desc"` (default) or `"asc"`. |

```ruby
result = app.integrations.slack.search_messages(query: "deploy after:2024-01-01")
```
```ruby
# Search with modifiers
result = app.integrations.slack.search_messages(query: "from:@alice in:engineering.length has:link", count: 50, sort: "timestamp", sort_dir: "desc")
```
---

### `app.integrations.slack.get_permalink({ channel, message_ts })`

Get a permalink URL for a specific Slack message.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID where the message is posted. |
| `message_ts` | string | yes | Timestamp of the message. |

```ruby
result = app.integrations.slack.get_permalink(channel: "C12345678", message_ts: "1234567890.123456")
```
---

### `app.integrations.slack.get_channel_history({ channel, limit, oldest, latest, cursor })`

Get message history for a Slack channel. Supports cursor-based pagination and time range filtering.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `limit` | integer | no | Number of messages to return (default 100, max 1000). |
| `oldest` | string | no | Start of time range, as a Unix timestamp. |
| `latest` | string | no | End of time range, as a Unix timestamp. |
| `cursor` | string | no | Pagination cursor from a previous response. |

```ruby
result = app.integrations.slack.get_channel_history(channel: "C12345678", limit: 50)
```
```ruby
# Filter by time range
result = app.integrations.slack.get_channel_history(channel: "C12345678", oldest: "1704067200", latest: "1704153600", limit: 100)
```
```ruby
# Paginate through history
result = app.integrations.slack.get_channel_history(channel: "C12345678", limit: 100, cursor: "dXNlcjpVMDYxTkZUVDI=")
```
---

### `app.integrations.slack.get_thread_replies({ channel, ts, limit, cursor })`

Get all replies in a Slack message thread.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `ts` | string | yes | Timestamp of the parent message (thread root). |
| `limit` | integer | no | Number of replies to return per page (default 1000). |
| `cursor` | string | no | Pagination cursor from a previous response. |

```ruby
result = app.integrations.slack.get_thread_replies(channel: "C12345678", ts: "1234567890.123456")
```
---

## Channels

### `app.integrations.slack.list_channels({ types, exclude_archived, limit, cursor })`

List all Slack channels visible to the bot. Supports filtering by channel type and cursor-based pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `types` | string | no | Comma-separated channel types: `"public_channel"`, `"private_channel"`, `"mpim"`, `"im"`. Default: `"public_channel"`. |
| `exclude_archived` | boolean | no | Exclude archived channels (default: true). |
| `limit` | integer | no | Number of channels to return per page (default 100, max 1000). |
| `cursor` | string | no | Pagination cursor from a previous response. |

```ruby
result = app.integrations.slack.list_channels(types: "public_channel,private_channel", exclude_archived: true)
```
```ruby
# Include DMs and group messages
result = app.integrations.slack.list_channels(types: "public_channel,private_channel,mpim,im", limit: 200)
```
---

### `app.integrations.slack.get_channel({ channel })`

Get detailed information about a Slack channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |

```ruby
result = app.integrations.slack.get_channel(channel: "C12345678")
```
---

### `app.integrations.slack.create_channel({ name, is_private })`

Create a new Slack channel (public or private).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Channel name (lowercase, no spaces, max 80 chars). |
| `is_private` | boolean | no | Create a private channel instead of public (default: false). |

```ruby
result = app.integrations.slack.create_channel(name: "project-alpha", is_private: false)
```
```ruby
# Create a private channel
result = app.integrations.slack.create_channel(name: "secret-project", is_private: true)
```
---

### `app.integrations.slack.set_topic({ channel, topic })`

Set the topic text on a Slack channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `topic` | string | yes | The new topic text. |

```ruby
result = app.integrations.slack.set_topic(channel: "C12345678", topic: "Sprint 42 — Apr 1–15")
```
---

### `app.integrations.slack.set_purpose({ channel, purpose })`

Set the purpose text on a Slack channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `purpose` | string | yes | The new purpose text. |

```ruby
result = app.integrations.slack.set_purpose(channel: "C12345678", purpose: "Coordination for the Q2 product launch")
```
---

### `app.integrations.slack.archive_channel({ channel })`

Archive a Slack channel by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID to archive. |

```ruby
result = app.integrations.slack.archive_channel(channel: "C12345678")
```
---

### `app.integrations.slack.invite_to_channel({ channel, users })`

Invite one or more users to a Slack channel.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID. |
| `users` | string | yes | Comma-separated list of user IDs to invite. |

```ruby
result = app.integrations.slack.invite_channel(channel: "C12345678", users: "U11111111,U22222222")
```
---

## Files

### `app.integrations.slack.upload_file({ channel, content, filename, title, initial_comment, thread_ts })`

Upload a file to Slack using the modern external upload flow. The file content is posted to a channel, optionally as a thread reply.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID to post the file to. |
| `content` | string | yes | File content (text). |
| `filename` | string | yes | Filename with extension (e.g. `"report.txt"`). |
| `title` | string | no | Title of the file. |
| `initial_comment` | string | no | Comment to include with the file post. |
| `thread_ts` | string | no | Timestamp of the parent message to reply in a thread. |

```ruby
result = app.integrations.slack.upload_file(channel: "C12345678", content: "Name,Email\nAlice,alice@example.com\nBob,bob@example.com", filename: "contacts.csv", title: "Contact List", initial_comment: "Here is the latest contact list.")
```
```ruby
# Upload as a thread reply
result = app.integrations.slack.upload_file(channel: "C12345678", content: "Line 1\nLine 2\nLine 3", filename: "log-output.txt", thread_ts: "1234567890.123456", initial_comment: "Here are the logs you asked for.")
```
---

### `app.integrations.slack.list_files({ channel, user, types, count, page })`

List files in the Slack workspace, with optional filtering by channel, user, or file type. Supports page-based pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | no | Channel ID to filter files by. |
| `user` | string | no | User ID to filter files by. |
| `types` | string | no | Comma-separated file types: `"spaces"`, `"snippets"`, `"images"`, `"gdocs"`, `"zips"`, `"pdfs"`. |
| `count` | integer | no | Number of files per page (default 100). |
| `page` | integer | no | Page number (default 1). |

```ruby
result = app.integrations.slack.list_files(channel: "C12345678", count: 20, page: 1)
```
```ruby
# Filter by file type
result = app.integrations.slack.list_files(user: "U11111111", types: "images,pdfs", count: 50)
```
---

### `app.integrations.slack.get_file({ file })`

Get detailed information about a Slack file by its ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file` | string | yes | File ID. |

```ruby
result = app.integrations.slack.get_file(file: "F12345678")
```
---

## Users

### `app.integrations.slack.list_users({ limit, cursor, include_locale })`

List all users in the Slack workspace. Supports cursor-based pagination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default 100, max 1000). |
| `cursor` | string | no | Pagination cursor from a previous response. |
| `include_locale` | boolean | no | Include user locale information (default: false). |

```ruby
result = app.integrations.slack.list_users(limit: 200)
```
```ruby
# Paginate through all users
all_users = []
cursor = ""
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.slack.list_users(limit: 200, cursor: cursor)
  (result.members || []).each do |user|
    all_users.push(user)
  end
  cursor = ((result.response_metadata || {}).next_cursor || "")
  break unless (!(cursor == ""))
end
```
---

### `app.integrations.slack.get_user({ user })`

Get detailed information about a Slack user by their ID.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user` | string | yes | User ID. |

```ruby
result = app.integrations.slack.get_user(user: "U12345678")
```
---

### `app.integrations.slack.find_user_by_email({ email })`

Look up a Slack user by their email address.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address to look up. |

```ruby
result = app.integrations.slack.find_user_by_email(email: "alice@example.com")
```
---

## Reactions & Usergroups

### `app.integrations.slack.add_reaction({ channel, name, timestamp })`

Add an emoji reaction to a Slack message.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID where the message is posted. |
| `name` | string | yes | Emoji name without colons (e.g. `"thumbsup"`, `"heart"`). |
| `timestamp` | string | yes | Timestamp of the message to react to. |

```ruby
result = app.integrations.slack.add_reaction(channel: "C12345678", name: "thumbsup", timestamp: "1234567890.123456")
```
```ruby
# React to a newly sent message
msg = app.integrations.slack.send_message(channel: "C12345678", text: "Great work everyone!")
app.integrations.slack.add_reaction(channel: msg.channel, name: "rocket", timestamp: msg.ts)
```
---

### `app.integrations.slack.remove_reaction({ channel, name, timestamp })`

Remove an emoji reaction from a Slack message.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channel` | string | yes | Channel ID where the message is posted. |
| `name` | string | yes | Emoji name without colons (e.g. `"thumbsup"`, `"heart"`). |
| `timestamp` | string | yes | Timestamp of the message. |

```ruby
result = app.integrations.slack.remove_reaction(channel: "C12345678", name: "thumbsup", timestamp: "1234567890.123456")
```
---

### `app.integrations.slack.list_usergroups({ include_count, include_disabled, include_users })`

List all Slack usergroups in the workspace.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `include_count` | boolean | no | Include the number of users in each usergroup (default: false). |
| `include_disabled` | boolean | no | Include disabled usergroups (default: false). |
| `include_users` | boolean | no | Include the list of users in each usergroup (default: false). |

```ruby
result = app.integrations.slack.list_usergroups(include_count: true, include_users: true)
```
---

### `app.integrations.slack.update_usergroup_members({ usergroup, users })`

Set the member list for a Slack usergroup. **Note:** This replaces the entire member list, not appends to it.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `usergroup` | string | yes | Usergroup ID. |
| `users` | string | yes | Comma-separated list of user IDs to set as members. |

```ruby
result = app.integrations.slack.update_usergroup_members(usergroup: "S12345678", users: "U11111111,U22222222,U33333333")
```
---

## Pagination

Several list endpoints support cursor-based pagination. When a response includes `response_metadata.next_cursor`, pass that value as `cursor` in the next call to retrieve the next page. An empty cursor string means no more results.

| Tool | Pagination style | Key params |
|------|-----------------|------------|
| `list_channels` | Cursor | `limit`, `cursor` |
| `list_users` | Cursor | `limit`, `cursor` |
| `get_channel_history` | Cursor | `limit`, `cursor` |
| `get_thread_replies` | Cursor | `limit`, `cursor` |
| `search_messages` | Page number | `count`, `page` |
| `list_files` | Page number | `count`, `page` |

---

## Notes

- **Channel identifiers:** Channels can be referenced by ID (e.g. `"C12345678"`) or name (e.g. `"#general"`). IDs are preferred for reliability.
- **Message timestamps:** Slack uses floating-point Unix timestamps (e.g. `"1234567890.123456"`) as unique message identifiers. Always store and pass these as strings.
- **Block Kit:** The `blocks` parameter accepts a JSON string, not a Ruby object. Use `JSON.stringify()` or construct the JSON manually.
- **Bot scope requirements:** Ensure your Slack app has the necessary OAuth scopes for each operation (e.g. `chat:write` for sending messages, `channels:read` for listing channels, `files:write` for uploads).
- **Rate limits:** Slack API rate limits apply. Use pagination parameters rather than requesting large result sets in a single call.
- **Usergroups:** The `update_usergroup_members` tool **replaces** the entire member list. Fetch the current list first if you need to add or remove individual members.
- **Thread replies:** When replying in a thread, pass the parent message's `ts` value as `thread_ts` in `send_message`, not the `ts` of another reply.

---

## Multi-Account Usage

If you have multiple slack accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
