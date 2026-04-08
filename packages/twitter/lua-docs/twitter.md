# Twitter / X — Lua API Reference

## search_tweets

Search recent tweets (last 7 days) matching a query.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query with operators (see below) |
| `max_results` | integer | no | Results per page (10–100, default: 10) |
| `page` | string | no | Next token from a previous response |
| `tweet_fields` | array | no | Additional fields (e.g. `created_at`, `public_metrics`, `author_id`) |
| `expansions` | array | no | Expansions (e.g. `author_id` to include user objects) |

### Search Operators

| Operator | Example | Description |
|----------|---------|-------------|
| keyword | `laravel` | Contains keyword |
| `"phrase"` | `"open source"` | Exact phrase |
| `from:user` | `from:laravelphp` | Tweets from a specific user |
| `to:user` | `to:laravelphp` | Replies to a specific user |
| `#hashtag` | `#laravel` | Contains hashtag |
| `-exclude` | `-retweet` | Exclude keyword/operator |
| `is:retweet` | `is:retweet` | Only retweets |
| `has:links` | `has:links` | Contains links |
| `lang:en` | `lang:en` | Language filter |

### Examples

```lua
-- Search for recent tweets about Laravel
local result = app.integrations.twitter.search_tweets({
  query = "laravel",
  max_results = 20,
  tweet_fields = {"created_at", "public_metrics", "author_id"},
  expansions = {"author_id"}
})

for _, tweet in ipairs(result.tweets) do
  print("@" .. tweet.author_id .. ": " .. tweet.text)
end

-- Get next page
if result.next_page then
  local page2 = app.integrations.twitter.search_tweets({
    query = "laravel",
    page = result.next_page
  })
end
```

---

## list_tweets

List recent tweets with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `max_results` | integer | no | Results per page (5–100, default: 10) |
| `page` | string | no | Pagination token from previous response |
| `tweet_fields` | array | no | Additional fields (e.g. `created_at`, `public_metrics`) |

### Example

```lua
local result = app.integrations.twitter.list_tweets({
  max_results = 20,
  tweet_fields = {"created_at", "public_metrics"}
})

for _, tweet in ipairs(result.tweets) do
  print(tweet.id .. ": " .. tweet.text)
end
```

---

## get_tweet

Get a single tweet by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The tweet ID |
| `tweet_fields` | array | no | Additional fields (e.g. `created_at`, `public_metrics`, `author_id`) |
| `expansions` | array | no | Expansions (e.g. `author_id`) |

### Example

```lua
local tweet = app.integrations.twitter.get_tweet({
  id = "1234567890",
  tweet_fields = {"created_at", "public_metrics", "author_id", "lang"},
  expansions = {"author_id"}
})

print(tweet.text)
print("Likes: " .. tweet.public_metrics.like_count)
```

---

## list_users

List followers of a user by their user ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The user ID whose followers to list |
| `max_results` | integer | no | Results per page (1–1000, default: 100) |
| `page` | string | no | Pagination token from previous response |
| `user_fields` | array | no | Additional fields (e.g. `description`, `public_metrics`, `profile_image_url`) |

### Example

```lua
local result = app.integrations.twitter.list_users({
  id = "2244994945",
  max_results = 50,
  user_fields = {"description", "public_metrics", "profile_image_url"}
})

for _, user in ipairs(result.users) do
  print("@" .. user.username .. " (" .. user.name .. ")")
end
```

---

## get_user

Get a user's profile by their user ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The user ID |
| `user_fields` | array | no | Additional fields (e.g. `description`, `public_metrics`, `profile_image_url`, `verified`) |

### Example

```lua
local user = app.integrations.twitter.get_user({
  id = "2244994945",
  user_fields = {"created_at", "description", "public_metrics", "profile_image_url"}
})

print(user.name .. " @" .. user.username)
print("Followers: " .. user.public_metrics.followers_count)
print(user.description)
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_fields` | array | no | Additional fields (e.g. `description`, `public_metrics`, `profile_image_url`) |
| `tweet_fields` | array | no | Tweet fields if requesting pinned tweet data |

### Example

```lua
local me = app.integrations.twitter.get_current_user({
  user_fields = {"public_metrics", "description", "profile_image_url"}
})

print("Logged in as @" .. me.username)
print("Followers: " .. me.public_metrics.followers_count)
```

---

## Multi-Account Usage

If you have multiple Twitter accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.twitter.function_name({...})

-- Explicit default (portable across setups)
app.integrations.twitter.default.function_name({...})

-- Named accounts
app.integrations.twitter.marketing.function_name({...})
app.integrations.twitter.support.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
