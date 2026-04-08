# Bluesky — Lua API Reference

## create_post

Create a new post on Bluesky.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Post text (max 300 graphemes) |
| `langs` | array | no | BCP-47 language tags, e.g. `{"en", "nl"}` |
| `facets` | array | no | Rich-text facets (mentions, links, tags) |
| `createdAt` | string | no | ISO 8601 timestamp (defaults to now) |

### Examples

```lua
-- Simple text post
local result = app.integrations.bluesky.create_post({
  text = "Hello from the integration!"
})
print("Post URI: " .. result.uri)

-- Post with language tags
local result = app.integrations.bluesky.create_post({
  text = "Hallo wereld!",
  langs = { "nl" }
})
```

---

## get_profile

Get the public profile of a Bluesky user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `actor` | string | yes | Handle (e.g. `"alice.bsky.social"`) or DID |

### Examples

```lua
local profile = app.integrations.bluesky.get_profile({
  actor = "alice.bsky.social"
})
print(profile.displayName .. " has " .. profile.followersCount .. " followers")
```

---

## list_followers

List followers of a Bluesky account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `actor` | string | yes | Handle or DID |
| `limit` | integer | no | Results per page (1–100, default 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
local result = app.integrations.bluesky.list_followers({
  actor = "alice.bsky.social",
  limit = 10
})

for _, follower in ipairs(result.followers) do
  print(follower.handle .. " (" .. (follower.displayName or "no name") .. ")")
end

-- Paginate
if result.cursor then
  local next = app.integrations.bluesky.list_followers({
    actor = "alice.bsky.social",
    cursor = result.cursor
  })
end
```

---

## list_following

List accounts that a Bluesky user follows.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `actor` | string | yes | Handle or DID |
| `limit` | integer | no | Results per page (1–100, default 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
local result = app.integrations.bluesky.list_following({
  actor = "alice.bsky.social",
  limit = 10
})

for _, follow in ipairs(result.follows) do
  print(follow.handle)
end
```

---

## search_posts

Search for posts on the Bluesky network.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | yes | Search query |
| `limit` | integer | no | Results per page (1–100, default 25) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Search Operators

- `"from:user.bsky.social"` — posts from a specific user
- `"has:images"` — posts containing images
- `"lang:en"` — posts in a specific language
- Boolean: `"term1 term2"` (AND), `"term1 OR term2"` (OR), `"-term"` (exclude)

### Examples

```lua
-- Simple search
local result = app.integrations.bluesky.search_posts({
  q = "Laravel",
  limit = 5
})

for _, post in ipairs(result.posts) do
  print(post.author.handle .. ": " .. post.record.text)
end

-- Search with operators
local result = app.integrations.bluesky.search_posts({
  q = "from:alice.bsky.social PHP",
  limit = 10
})
```

---

## get_current_user

Get the authenticated user's own Bluesky profile. No parameters required.

### Examples

```lua
local me = app.integrations.bluesky.get_current_user({})
print("Logged in as @" .. me.handle)
print("Display name: " .. (me.displayName or "not set"))
print("Followers: " .. me.followersCount)
print("Following: " .. me.followsCount)
print("Posts: " .. me.postsCount)
```

---

## Multi-Account Usage

If you have multiple Bluesky accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bluesky.create_post({ text = "Hello!" })

-- Explicit default (portable across setups)
app.integrations.bluesky.default.create_post({ text = "Hello!" })

-- Named accounts
app.integrations.bluesky.work.create_post({ text = "Work update" })
app.integrations.bluesky.personal.search_posts({ q = "hobbies" })
```

All functions are identical across accounts — only the credentials differ.
