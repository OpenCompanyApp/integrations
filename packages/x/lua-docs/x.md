# X / X — Lua API Reference

## get_tweet

Retrieve a single tweet by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The tweet ID to look up |
| `tweet_fields` | array | no | Additional fields: `created_at`, `public_metrics`, `entities`, `attachments`, `geo`, `lang` |
| `expansions` | array | no | Expansions: `author_id`, `referenced_tweets.id`, `attachments.media_keys` |
| `user_fields` | array | no | User fields when `author_id` expansion is used: `created_at`, `description`, `profile_image_url`, `public_metrics`, `verified` |

### Example

```lua
local tweet = app.integrations.x.get_tweet({
  id = "1234567890",
  tweet_fields = {"created_at", "public_metrics"}
})

print(tweet.data.text)
print("Likes: " .. tweet.data.public_metrics.like_count)
```

---

## list_tweets

Look up multiple tweets by their IDs in a single call. Maximum 100 tweets.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ids` | array | yes | Array of tweet IDs (max 100) |
| `tweet_fields` | array | no | Additional fields (same as `get_tweet`) |
| `expansions` | array | no | Expansions (same as `get_tweet`) |
| `user_fields` | array | no | User fields for expansions |

### Example

```lua
local result = app.integrations.x.list_tweets({
  ids = {"1234567890", "0987654321"},
  tweet_fields = {"created_at", "public_metrics", "author_id"},
  expansions = {"author_id"},
  user_fields = {"username", "profile_image_url"}
})

for _, tweet in ipairs(result.data) do
  print(tweet.id .. ": " .. tweet.text)
end
```

---

## create_tweet

Post a new tweet. Supports text, reply settings, media attachments, and threaded replies.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Tweet text (max 280 characters) |
| `reply_settings` | string | no | Who can reply: `everyone`, `mentionedUsers`, or `following` |
| `media_ids` | array | no | Pre-uploaded media IDs (max 4 images or 1 video) |
| `reply_to` | string | no | Tweet ID to reply to (creates a thread) |

### Example

```lua
-- Simple tweet
local tweet = app.integrations.x.create_tweet({
  text = "Hello from OpenCompany!"
})
print("Posted tweet: " .. tweet.data.id)

-- Reply to a tweet
local reply = app.integrations.x.create_tweet({
  text = "Great point!",
  reply_to = "1234567890"
})

-- Tweet with restricted replies
local locked = app.integrations.x.create_tweet({
  text = "Only followers can reply to this",
  reply_settings = "following"
})
```

---

## get_user

Retrieve a X user by their numeric ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The numeric X user ID |
| `user_fields` | array | no | Additional fields: `created_at`, `description`, `profile_image_url`, `public_metrics`, `verified`, `url`, `location` |

### Example

```lua
local user = app.integrations.x.get_user({
  id = "2244994945",
  user_fields = {"description", "public_metrics", "profile_image_url"}
})

print(user.data.name .. " @" .. user.data.username)
print("Followers: " .. user.data.public_metrics.followers_count)
```

---

## get_user_by_username

Retrieve a X user by their username (handle). The `@` prefix is optional.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `username` | string | yes | X username without @ (e.g. `"elonmusk"`) |
| `user_fields` | array | no | Additional fields (same as `get_user`) |

### Example

```lua
local user = app.integrations.x.get_user_by_username({
  username = "elonmusk",
  user_fields = {"public_metrics", "description"}
})

print(user.data.id)
print(user.data.name .. " — " .. (user.data.description or ""))
```

---

## get_current_user

Get the authenticated user's own profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_fields` | array | no | Additional fields (same as `get_user`) |

### Example

```lua
local me = app.integrations.x.get_current_user({
  user_fields = {"public_metrics", "profile_image_url"}
})

print("Connected as @" .. me.data.username)
print("ID: " .. me.data.id)
```

---

## Common Workflows

### Resolve a username to an ID and fetch their tweets

```lua
-- Step 1: Look up the user
local user = app.integrations.x.get_user_by_username({
  username = "opencompanyapp",
  user_fields = {"public_metrics"}
})

print("Found: " .. user.data.name)
print("ID: " .. user.data.id)
print("Followers: " .. user.data.public_metrics.followers_count)
```

### Post a threaded reply

```lua
-- Post the original tweet
local original = app.integrations.x.create_tweet({
  text = "Thread: 3 things about AI agents..."
})

-- Reply to it (thread)
local reply1 = app.integrations.x.create_tweet({
  text = "1/ They compose tools like building blocks.",
  reply_to = original.data.id
})

local reply2 = app.integrations.x.create_tweet({
  text = "2/ They write and execute code autonomously.",
  reply_to = reply1.data.id
})

local reply3 = app.integrations.x.create_tweet({
  text = "3/ They collaborate with human teammates.",
  reply_to = reply2.data.id
})
```

### Batch lookup tweets with metrics

```lua
local result = app.integrations.x.list_tweets({
  ids = {"111", "222", "333"},
  tweet_fields = {"public_metrics", "created_at", "author_id"},
  expansions = {"author_id"},
  user_fields = {"username", "profile_image_url"}
})

for _, tweet in ipairs(result.data) do
  local metrics = tweet.public_metrics
  print(string.format(
    "%s by @%s: %d likes, %d retweets",
    tweet.id,
    tweet.author_id,
    metrics.like_count,
    metrics.retweet_count
  ))
end
```

## Notes

- **Rate limits**: X API v2 has per-endpoint rate limits. The free tier allows 1,500 tweets/month read and 50 tweets/month write. Check your plan at the Developer Portal.
- **280 character limit**: Tweet text must not exceed 280 characters. Use `mb_strlen()` semantics — emoji and special characters count differently.
- **Media uploads**: The `media_ids` parameter requires IDs from X's media upload endpoint (not included in this integration). Pre-upload media via the X API directly.
- **Field parameters**: When passing `tweet_fields`, `user_fields`, or `expansions`, use arrays of strings. The tool will join them with commas for the API query.
- **Authentication**: This integration uses Bearer Token authentication (app-only). User-context endpoints like `create_tweet` require OAuth 2.0 with user context — ensure your token has the appropriate scopes (`tweet.read`, `tweet.write`, `users.read`).

---

## Multi-Account Usage

If you have multiple X accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.x.get_tweet({id = "123"})

-- Explicit default (portable across setups)
app.integrations.x.default.get_tweet({id = "123"})

-- Named accounts
app.integrations.x.work.create_tweet({text = "Work announcement"})
app.integrations.x.personal.create_tweet({text = "Personal update"})
```

All functions are identical across accounts — only the credentials differ.
