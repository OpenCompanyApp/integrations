# Mastodon — Lua API Reference

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

```lua
local result = app.integrations.mastodon.list_statuses({
  timeline = "home",
  limit = 10
})

for _, status in ipairs(result.statuses) do
  print(status.account.display_name .. ": " .. status.content)
end
```

#### Public timeline with pagination

```lua
local result = app.integrations.mastodon.list_statuses({
  timeline = "public",
  limit = 40,
  max_id = last_seen_id
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

```lua
local status = app.integrations.mastodon.get_status({ id = "1234567890" })
print(status.account.username .. " posted: " .. status.content)
print("Boosts: " .. status.reblogs_count .. ", Favs: " .. status.favourites_count)
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

```lua
local result = app.integrations.mastodon.create_status({
  status = "Hello from the API!"
})
print("Posted: " .. result.url)
```

#### Post with content warning

```lua
local result = app.integrations.mastodon.create_status({
  status = "Spoilers for the latest episode...",
  spoiler_text = "TV Show Spoilers",
  visibility = "unlisted"
})
```

#### Reply to a status

```lua
local result = app.integrations.mastodon.create_status({
  status = "Great point! I agree.",
  in_reply_to_id = "1234567890"
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

```lua
local result = app.integrations.mastodon.list_accounts({
  id = "123456",
  limit = 20
})

for _, follower in ipairs(result.followers) do
  print(follower.display_name .. " (@" .. follower.acct .. ")")
  print("  Followers: " .. follower.followers_count)
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

```lua
local account = app.integrations.mastodon.get_account({ id = "123456" })
print(account.display_name .. " (@" .. account.username .. ")")
print("Bio: " .. account.note)
print("Followers: " .. account.followers_count)
print("Following: " .. account.following_count)
print("Statuses: " .. account.statuses_count)
```

---

## get_current_user

Get the authenticated user's Mastodon profile.

### Parameters

None.

### Example

```lua
local me = app.integrations.mastodon.get_current_user({})
print("Logged in as @" .. me.username)
print("Display name: " .. me.display_name)
print("Default visibility: " .. (me.source.privacy or "public"))
```

---

## generic_api

Use generic API tools for Mastodon endpoints that do not have a dedicated wrapper.
Paths must start with `/api/` and are relative to the configured instance URL.

```lua
local notifications = app.integrations.mastodon.api_get({
  path = "/api/v1/notifications",
  params = { limit = 20 }
})

local favourite = app.integrations.mastodon.api_post({
  path = "/api/v1/statuses/123456/favourite",
  body = {}
})

local update = app.integrations.mastodon.api_put({
  path = "/api/v1/statuses/123456",
  body = { status = "Edited text" }
})

local deleted = app.integrations.mastodon.api_delete({
  path = "/api/v1/statuses/123456",
  body = {}
})
```

Generic tools return the raw Mastodon JSON response. Use the official Mastodon
API docs for endpoint-specific params, scopes, and response shapes.

---

## Multi-Account Usage

If you have multiple Mastodon accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mastodon.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mastodon.default.function_name({...})

-- Named accounts
app.integrations.mastodon.work.function_name({...})
app.integrations.mastodon.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
