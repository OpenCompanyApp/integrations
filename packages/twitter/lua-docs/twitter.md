# Twitter / X — Lua API Reference

## get_current_user

Get the authenticated user's Twitter profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_fields` | array | no | Additional fields: created_at, description, location, profile_image_url, public_metrics, url, verified, verified_type |

### Example

```lua
local user = app.integrations.twitter.get_current_user({
  user_fields = { "public_metrics", "description", "profile_image_url" }
})

print("@" .. user.username .. " (" .. user.name .. ")")
print("Followers: " .. user.public_metrics.followers_count)
```

---

## get_user

Get a Twitter user by their numeric ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Twitter user ID (numeric) |
| `user_fields` | array | no | Additional fields (see get_current_user) |

### Example

```lua
local user = app.integrations.twitter.get_user({
  id = "2244994945",
  user_fields = { "public_metrics", "created_at" }
})

print("@" .. user.username .. " — joined " .. user.created_at)
```

---

## get_user_by_username

Look up a Twitter user by their username (handle).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `username` | string | yes | Twitter username (without @) |
| `user_fields` | array | no | Additional fields (see get_current_user) |

### Example

```lua
local user = app.integrations.twitter.get_user_by_username({
  username = "twitterapi",
  user_fields = { "public_metrics", "description" }
})

print(user.name .. " — " .. user.description)
print("Following: " .. user.public_metrics.following_count)
print("Followers: " .. user.public_metrics.followers_count)
```

---

## list_tweets

List recent tweets from a user by their user ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | Twitter user ID |
| `max_results` | integer | no | Number of tweets to return (10–100, default 10) |
| `tweet_fields` | array | no | Additional fields: author_id, created_at, public_metrics, entities, referenced_tweets, etc. |
| `pagination_token` | string | no | Token for paginating through results |

### Example

```lua
local result = app.integrations.twitter.list_tweets({
  user_id = "2244994945",
  max_results = 10,
  tweet_fields = { "created_at", "public_metrics" }
})

for _, tweet in ipairs(result.tweets) do
  print("[" .. tweet.created_at .. "] " .. tweet.text)
  print("  Likes: " .. tweet.public_metrics.like_count .. " | Retweets: " .. tweet.public_metrics.retweet_count)
end

-- Paginate
if result.next_token then
  local next = app.integrations.twitter.list_tweets({
    user_id = "2244994945",
    max_results = 10,
    pagination_token = result.next_token,
    tweet_fields = { "created_at", "public_metrics" }
  })
end
```

---

## get_tweet

Get a single tweet by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tweet_id` | string | yes | The tweet ID |
| `tweet_fields` | array | no | Additional fields: author_id, created_at, public_metrics, entities, etc. |

### Example

```lua
local tweet = app.integrations.twitter.get_tweet({
  tweet_id = "1234567890",
  tweet_fields = { "author_id", "created_at", "public_metrics", "entities" }
})

print(tweet.text)
print("Posted: " .. tweet.created_at)
print("Likes: " .. tweet.public_metrics.like_count)
```

---

## search_tweets

Search recent tweets from the last 7 days.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query (supports operators below) |
| `max_results` | integer | no | Number of tweets to return (10–100, default 10) |
| `tweet_fields` | array | no | Additional fields: author_id, created_at, public_metrics, entities, etc. |
| `next_token` | string | no | Token for paginating through results |

### Search Operators

| Operator | Example |
|----------|---------|
| `from:user` | `from:twitterapi` — tweets from a specific user |
| `to:user` | `to:twitterapi` — replies to a specific user |
| `@user` | `@twitterapi` — mentioning a user |
| `#hashtag` | `#Laravel` — containing a hashtag |
| `"exact phrase"` | `"open source"` — exact phrase match |
| `lang:xx` | `lang:en` — tweets in a specific language |
| `has:links` | Tweets containing links |
| `is:retweet` | Only retweets |
| `-keyword` | Exclude a keyword |

### Examples

```lua
-- Search by hashtag
local result = app.integrations.twitter.search_tweets({
  query = "#Laravel",
  max_results = 10,
  tweet_fields = { "author_id", "created_at", "public_metrics" }
})

for _, tweet in ipairs(result.tweets) do
  print("[" .. tweet.created_at .. "] " .. tweet.text)
end

-- Search tweets from a specific user
local result = app.integrations.twitter.search_tweets({
  query = "from:twitterapi API",
  max_results = 5,
  tweet_fields = { "created_at", "public_metrics" }
})

-- Paginate
if result.next_token then
  local next = app.integrations.twitter.search_tweets({
    query = "#Laravel",
    max_results = 10,
    next_token = result.next_token,
    tweet_fields = { "created_at" }
  })
end
```

---

## create_tweet

Post a new tweet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Tweet text (max 280 characters) |

### Example

```lua
local result = app.integrations.twitter.create_tweet({
  text = "Hello from OpenCompany! 🚀"
})

print("Tweet posted! ID: " .. result.id)
print("Text: " .. result.text)
```

---

## delete_tweet

Delete a tweet by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tweet_id` | string | yes | The ID of the tweet to delete |

### Example

```lua
local result = app.integrations.twitter.delete_tweet({
  tweet_id = "1234567890"
})

if result.deleted then
  print("Tweet deleted successfully.")
end
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
app.integrations.twitter.company.function_name({...})
app.integrations.twitter.support.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
