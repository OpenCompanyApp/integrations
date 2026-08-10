# Mastodon — JavaScript API Reference

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

```js
var result = app.integrations.mastodon.list_statuses({
  timeline: "home",
  limit: 10,
})

for (const status of (result.statuses)) {
  console.log(status.account.display_name + ": " + status.content)
}
```
#### Public timeline with pagination

```js
var result = app.integrations.mastodon.list_statuses({
  timeline: "public",
  limit: 40,
  max_id: last_seen_id,
})
```
---

## get_status

Retrieve a single status (toot) by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the status to retrieve |

### Example

```js
var status = app.integrations.mastodon.get_status({ id: "1234567890" })
console.log(status.account.username + " posted: " + status.content)
console.log("Boosts: " + status.reblogs_count + ", Favs: " + status.favourites_count)
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

```js
var result = app.integrations.mastodon.create_status({
  status: "Hello from the API!",
})
console.log("Posted: " + result.url)
```
#### Post with content warning

```js
var result = app.integrations.mastodon.create_status({
  status: "Spoilers for the latest episode...",
  spoiler_text: "TV Show Spoilers",
  visibility: "unlisted",
})
```
#### Reply to a status

```js
var result = app.integrations.mastodon.create_status({
  status: "Great point! I agree.",
  in_reply_to_id: "1234567890",
})
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

```js
var result = app.integrations.mastodon.list_accounts({
  id: "123456",
  limit: 20,
})

for (const follower of (result.followers)) {
  console.log(follower.display_name + " (@" + follower.acct + ")")
  console.log("  Followers: " + follower.followers_count)
}
```
---

## get_account

Retrieve a Mastodon account profile by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID to retrieve |

### Example

```js
var account = app.integrations.mastodon.get_account({ id: "123456" })
console.log(account.display_name + " (@" + account.username + ")")
console.log("Bio: " + account.note)
console.log("Followers: " + account.followers_count)
console.log("Following: " + account.following_count)
console.log("Statuses: " + account.statuses_count)
```
---

## get_current_user

Get the authenticated user's Mastodon profile.

### Parameters

None.

### Example

```js
var me = app.integrations.mastodon.get_current_user({})
console.log("Logged in as @" + me.username)
console.log("Display name: " + me.display_name)
console.log("Default visibility: " + (me.source.privacy || "public"))
```
---

## generic_api

Use generic API tools for Mastodon endpoints that do not have a dedicated wrapper.
Paths must start with `/api/` and are relative to the configured instance URL.

```js
var notifications = app.integrations.mastodon.api_get({
  path: "/api/v1/notifications",
  params: { limit: 20 },
})

var favourite = app.integrations.mastodon.api_post({
  path: "/api/v1/statuses/123456/favourite",
  body: {},
})

var update = app.integrations.mastodon.api_put({
  path: "/api/v1/statuses/123456",
  body: { status: "Edited text" },
})

var deleted = app.integrations.mastodon.api_delete({
  path: "/api/v1/statuses/123456",
  body: {},
})
```
Generic tools return the raw Mastodon JSON response. Use the official Mastodon
API docs for endpoint-specific params, scopes, and response shapes.

---

## Multi-Account Usage

If you have multiple Mastodon accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mastodon.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mastodon.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.mastodon.work.function_name({ /* parameters */ })
app.integrations.mastodon.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
