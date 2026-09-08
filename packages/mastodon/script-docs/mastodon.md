# Mastodon — Ruby API Reference

## list_statuses

Browse statuses (toots) from a Mastodon timeline.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `timeline` | string | no | Timeline to retrieve: `"home"` (default), `"local"`, or `"public"` |
| `limit` | integer | no | Max statuses to return (1–40, default: 20) |
| `max_id` | string | no | Return results older than this status ID (pagination) |
| `since_id` | string | no | Return results newer than this status ID (pagination) |

### Examples

#### Home timeline

```ruby
result = app.integrations.mastodon.list_statuses(timeline: "home", limit: 10)
result.statuses.each do |status|
  puts((status.account.display_name).to_s + ": " + (status.content).to_s)
end
```
#### Public timeline with pagination

```ruby
result = app.integrations.mastodon.list_statuses(timeline: "public", limit: 40, max_id: last_seen_id)
```
---

## get_status

Retrieve a single status (toot) by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the status to retrieve |

### Example

```ruby
status = app.integrations.mastodon.get_status(id: "1234567890")
puts((status.account.username).to_s + " posted: " + (status.content).to_s)
puts("Boosts: " + (status.reblogs_count).to_s + ", Favs: " + (status.favourites_count).to_s)
```
---

## create_status

Publish a new status (toot) on Mastodon.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | yes | The text content of the status |
| `visibility` | string | no | `"public"` (default), `"unlisted"`, `"private"`, or `"direct"` |
| `in_reply_to_id` | string | no | ID of the status to reply to |
| `spoiler_text` | string | no | Content warning text |
| `sensitive` | boolean | no | Whether the status contains sensitive media |
| `language` | string | no | ISO 639-1 language code (e.g., `"en"`, `"nl"`) |

### Examples

#### Simple post

```ruby
result = app.integrations.mastodon.create_status(status: "Hello from the API!")
puts("Posted: " + (result.url).to_s)
```
#### Post with content warning

```ruby
result = app.integrations.mastodon.create_status(status: "Spoilers for the latest episode...", spoiler_text: "TV Show Spoilers", visibility: "unlisted")
```
#### Reply to a status

```ruby
result = app.integrations.mastodon.create_status(status: "Great point! I agree.", in_reply_to_id: "1234567890")
```
---

## list_accounts

List followers of a Mastodon account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID whose followers to list |
| `limit` | integer | no | Max accounts to return (1–80, default: 40) |
| `max_id` | string | no | Return results older than this account ID (pagination) |

### Example

```ruby
result = app.integrations.mastodon.list_accounts(id: "123456", limit: 20)
result.followers.each do |follower|
  puts((follower.display_name).to_s + " (@" + (follower.acct).to_s + ")")
  puts("  Followers: " + (follower.followers_count).to_s)
end
```
---

## get_account

Retrieve a Mastodon account profile by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID to retrieve |

### Example

```ruby
account = app.integrations.mastodon.get_account(id: "123456")
puts((account.display_name).to_s + " (@" + (account.username).to_s + ")")
puts("Bio: " + (account.note).to_s)
puts("Followers: " + (account.followers_count).to_s)
puts("Following: " + (account.following_count).to_s)
puts("Statuses: " + (account.statuses_count).to_s)
```
---

## get_current_user

Get the authenticated user's Mastodon profile.

### Parameters

None.

### Example

```ruby
me = app.integrations.mastodon.get_current_user()
puts("Logged in as @" + (me.username).to_s)
puts("Display name: " + (me.display_name).to_s)
puts("Default visibility: " + ((me.source.privacy || "public")).to_s)
```
---

## generic_api

Use generic API tools for Mastodon endpoints that do not have a dedicated wrapper.
Paths must start with `/api/` and are relative to the configured instance URL.

```ruby
notifications = app.integrations.mastodon.api_get(path: "/api/v1/notifications", params: {limit: 20})
favourite = app.integrations.mastodon.api_post(path: "/api/v1/statuses/123456/favourite", body: {})
update = app.integrations.mastodon.api_put(path: "/api/v1/statuses/123456", body: {status: "Edited text"})
deleted = app.integrations.mastodon.api_delete(path: "/api/v1/statuses/123456", body: {})
```
Generic tools return the raw Mastodon JSON response. Use the official Mastodon
API docs for endpoint-specific params, scopes, and response shapes.

---

## Multi-Account Usage

If you have multiple Mastodon accounts configured, use account-specific namespaces:

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
