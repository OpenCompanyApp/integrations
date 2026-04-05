# Reddit — Lua API Reference

## list_posts

List hot posts from a subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name without r/ prefix (e.g., `"laravel"`) |
| `limit` | integer | no | Max posts to return (default: 25, max: 100) |
| `after` | string | no | Pagination cursor — fullname from previous response |
| `before` | string | no | Pagination cursor — fullname for backward paging |

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `posts` | array | List of post objects |
| `count` | integer | Number of posts returned |
| `after` | string\|nil | Cursor for next page |
| `before` | string\|nil | Cursor for previous page |

Each post contains: `id`, `name`, `title`, `author`, `subreddit`, `score`, `numComments`, `url`, `permalink`, `selftext`, `createdUtc`, `isSelf`, `linkFlairText`.

### Examples

```lua
-- Get hot posts from r/laravel
local result = app.integrations.reddit.list_posts({
  subreddit = "laravel",
  limit = 10
})

for _, post in ipairs(result.posts) do
  print(post.title .. " (score: " .. post.score .. ")")
end
```

```lua
-- Paginate through posts
local page1 = app.integrations.reddit.list_posts({
  subreddit = "php",
  limit = 25
})

local page2 = app.integrations.reddit.list_posts({
  subreddit = "php",
  limit = 25,
  after = page1.after
})
```

---

## get_post

Get a specific post with its top comments.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The base36 post ID (from Reddit URL) |
| `comment_limit` | integer | no | Max comments to return (default: 25, max: 100) |
| `deep` | boolean | no | Deeply expand comment replies (default: false) |

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `post` | table | Post details |
| `comments` | array | List of comment objects (with nested `replies`) |
| `commentCount` | integer | Number of top-level comments returned |

### Examples

```lua
-- Get a post and its comments
local result = app.integrations.reddit.get_post({
  id = "abc123"
})

print(result.post.title)
print("Score: " .. result.post.score)

for _, comment in ipairs(result.comments) do
  print("  u/" .. comment.author .. ": " .. comment.body)
end
```

```lua
-- Get a post with deep comment expansion
local result = app.integrations.reddit.get_post({
  id = "abc123",
  comment_limit = 50,
  deep = true
})
```

---

## create_post

Submit a new post to a subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Target subreddit (without r/ prefix) |
| `title` | string | yes | Post title (max 300 characters) |
| `kind` | string | no | Post type: `"self"`, `"link"`, `"image"`, `"video"` (default: `"self"`) |
| `text` | string | no | Body text for self posts (Markdown). Required when kind is `"self"`. |
| `url` | string | no | URL for link/image/video posts. Required when kind is `"link"`, `"image"`, or `"video"`. |

### Response

| Field | Type | Description |
|-------|------|-------------|
| `success` | boolean | Whether the post was created |
| `id` | string | New post ID |
| `url` | string | Reddit URL of the post |
| `permalink` | string | Full permalink URL |

### Examples

```lua
-- Create a text post
local result = app.integrations.reddit.create_post({
  subreddit = "test",
  title = "Hello from OpenCompany!",
  kind = "self",
  text = "This is a test post created via the Reddit integration."
})

print("Created post: " .. result.permalink)
```

```lua
-- Share a link
local result = app.integrations.reddit.create_post({
  subreddit = "php",
  title = "Great article about PHP 8.4",
  kind = "link",
  url = "https://example.com/php-84-features"
})
```

---

## search

Search Reddit for posts, subreddits, or users.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query string |
| `type` | string | no | Result type: `"link"`, `"sr"`, `"user"`, or combinations (default: `"link"`) |
| `sort` | string | no | Sort: `"relevance"`, `"hot"`, `"top"`, `"new"`, `"comments"` (default: `"relevance"`) |
| `time` | string | no | Time range: `"hour"`, `"day"`, `"week"`, `"month"`, `"year"`, `"all"` (default: `"all"`) |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `after` | string | no | Pagination cursor |

### Examples

```lua
-- Search for posts about Laravel
local result = app.integrations.reddit.search({
  query = "laravel queues",
  type = "link",
  sort = "relevance",
  limit = 10
})

for _, post in ipairs(result.results) do
  print(post.title .. " (r/" .. post.subreddit .. ")")
end
```

```lua
-- Search for subreddits about programming
local result = app.integrations.reddit.search({
  query = "programming",
  type = "sr",
  limit = 10
})

for _, sr in ipairs(result.results) do
  print(sr.name .. " - " .. sr.subscribers .. " subscribers")
end
```

```lua
-- Search for recent posts
local result = app.integrations.reddit.search({
  query = "vue 3 composition API",
  sort = "new",
  time = "week",
  limit = 15
})
```

---

## list_subreddits

List popular subreddits.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max subreddits to return (default: 25, max: 100) |
| `after` | string | no | Pagination cursor |

### Examples

```lua
local result = app.integrations.reddit.list_subreddits({
  limit = 20
})

for _, sr in ipairs(result.subreddits) do
  print(sr.name .. " - " .. sr.subscribers .. " subscribers")
end
```

---

## get_subreddit

Get detailed information about a subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Subreddit name without r/ prefix |

### Response

Returns subreddit details: `id`, `name`, `title`, `description`, `subscribers`, `activeUsers`, `url`, `over18`, `submissionType`, `subredditType`, `createdUtc`, `headerImageUrl`, `iconUrl`.

### Examples

```lua
local info = app.integrations.reddit.get_subreddit({
  name = "laravel"
})

print(info.title)
print("Subscribers: " .. info.subscribers)
print("Active now: " .. info.activeUsers)
print("Description: " .. info.description)
```

---

## create_comment

Post a comment on a post or reply to an existing comment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `parent` | string | yes | Fullname of the parent. Use `"t3_{id}"` for posts, `"t1_{id}"` for comments. |
| `text` | string | yes | Comment body (supports Markdown) |

### Response

| Field | Type | Description |
|-------|------|-------------|
| `success` | boolean | Whether the comment was created |
| `id` | string | New comment ID |
| `body` | string | The comment text |
| `permalink` | string | Full permalink URL |

### Examples

```lua
-- Comment on a post
local result = app.integrations.reddit.create_comment({
  parent = "t3_abc123",
  text = "Great post! Thanks for sharing."
})

print("Comment created: " .. result.permalink)
```

```lua
-- Reply to a comment
local result = app.integrations.reddit.create_comment({
  parent = "t1_def456",
  text = "I agree with this point. Here's my perspective..."
})
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Response

Returns user profile: `id`, `name`, `linkKarma`, `commentKarma`, `totalKarma`, `isGold`, `isMod`, `isVerified`, `hasVerifiedEmail`, `createdUtc`, `over18`, `iconImg`, `snoovatarImg`.

### Examples

```lua
local user = app.integrations.reddit.get_current_user({})

print("Logged in as: u/" .. user.name)
print("Link karma: " .. user.linkKarma)
print("Comment karma: " .. user.commentKarma)
```

---

## Multi-Account Usage

If you have multiple Reddit accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.reddit.list_posts({ subreddit = "laravel" })

-- Explicit default (portable across setups)
app.integrations.reddit.default.list_posts({ subreddit = "laravel" })

-- Named accounts
app.integrations.reddit.work.list_posts({ subreddit = "php" })
app.integrations.reddit.personal.list_posts({ subreddit = "funny" })
```

All functions are identical across accounts — only the credentials differ.
