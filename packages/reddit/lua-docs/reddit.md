# Reddit — Lua API Reference

## list_posts

List posts from a subreddit or the Reddit front page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | no | Subreddit name (without r/ prefix). Leave empty for front page. |
| `sort` | string | no | Sort method: hot, new, top, rising, controversial (default: hot) |
| `limit` | integer | no | Number of posts to return (default: 25, max: 100) |
| `after` | string | no | Fullname of a post to fetch results after (for pagination) |
| `before` | string | no | Fullname of a post to fetch results before (for pagination) |

### Examples

```lua
-- List hot posts from a subreddit
local result = app.integrations.reddit.list_posts({
  subreddit = "programming",
  sort = "hot",
  limit = 10
})

for _, post in ipairs(result.data.children) do
  print(post.data.title .. " (score: " .. post.data.score .. ")")
end

-- List new posts from the front page
local result = app.integrations.reddit.list_posts({
  sort = "new",
  limit = 25
})

for _, post in ipairs(result.data.children) do
  print(post.data.title)
end

-- Paginate through results
local result = app.integrations.reddit.list_posts({
  subreddit = "worldnews",
  limit = 25
})

-- Use the last post's fullname to get the next page
local last = result.data.children[#result.data.children]
local next_page = app.integrations.reddit.list_posts({
  subreddit = "worldnews",
  limit = 25,
  after = last.data.name
})
```

---

## get_post

Get details for a specific Reddit post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name (without r/ prefix) |
| `post_id` | string | yes | The base36 post ID (e.g., "abc123") |

### Examples

```lua
local result = app.integrations.reddit.get_post({
  subreddit = "programming",
  post_id = "abc123"
})

-- result is an array with two elements: [1] = post listing, [2] = comments
local post = result[1].data.children[1].data
print(post.title)
print("Score: " .. post.score)
print("Author: u/" .. post.author)
print("Comments: " .. post.num_comments)
```

---

## create_post

Submit a new post to a subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name (without r/ prefix) |
| `title` | string | yes | Post title |
| `kind` | string | no | Post type: self (text), link, image, or video (default: self) |
| `text` | string | no | Post body text for self posts (supports Markdown) |
| `url` | string | no | URL for link posts |
| `nsfw` | boolean | no | Whether the post is NSFW (default: false) |
| `spoiler` | boolean | no | Whether the post is a spoiler (default: false) |

### Examples

```lua
-- Create a text post
local result = app.integrations.reddit.create_post({
  subreddit = "test",
  title = "Hello from OpenCompany!",
  kind = "self",
  text = "This is a test post created via the API."
})

print("Post created: " .. result.json.data.name)

-- Create a link post
local result = app.integrations.reddit.create_post({
  subreddit = "programming",
  title = "Interesting article about Lua",
  kind = "link",
  url = "https://www.lua.org/"
})
```

---

## list_subreddits

List popular or new subreddits.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sort` | string | no | Sort method: popular or new (default: popular) |
| `limit` | integer | no | Number of subreddits to return (default: 25, max: 100) |
| `after` | string | no | Fullname of a subreddit to fetch results after (for pagination) |
| `before` | string | no | Fullname of a subreddit to fetch results before (for pagination) |

### Examples

```lua
-- List popular subreddits
local result = app.integrations.reddit.list_subreddits({
  sort = "popular",
  limit = 10
})

for _, sub in ipairs(result.data.children) do
  print("r/" .. sub.data.display_name .. " - " .. sub.data.subscribers .. " subscribers")
end

-- List new subreddits
local result = app.integrations.reddit.list_subreddits({
  sort = "new",
  limit = 10
})

for _, sub in ipairs(result.data.children) do
  print("r/" .. sub.data.display_name .. " - " .. sub.data.title)
end
```

---

## get_subreddit

Get information about a specific subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name (without r/ prefix) |

### Examples

```lua
local result = app.integrations.reddit.get_subreddit({
  subreddit = "programming"
})

print("r/" .. result.data.display_name)
print("Title: " .. result.data.title)
print("Subscribers: " .. result.data.subscribers)
print("Description: " .. result.data.public_description)
print("Created: " .. os.date("!%Y-%m-%d", result.data.created_utc))
```

---

## list_comments

List comments for a specific Reddit post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name (without r/ prefix) |
| `post_id` | string | yes | The base36 post ID (e.g., "abc123") |
| `limit` | integer | no | Maximum number of comments to return (default: 25, max: 100) |
| `sort` | string | no | Comment sort order: best, top, new, controversial, old, q&a (default: best) |
| `depth` | integer | no | Maximum comment depth (default: unlimited) |

### Examples

```lua
local result = app.integrations.reddit.list_comments({
  subreddit = "programming",
  post_id = "abc123",
  limit = 10,
  sort = "top"
})

-- Comments are in the second element of the response array
for _, comment in ipairs(result[2].data.children) do
  if comment.kind == "t1" then
    print("u/" .. comment.data.author .. ": " .. comment.data.body:sub(1, 100))
    print("Score: " .. comment.data.score)
  end
end
```

---

## get_current_user

Get the profile of the currently authenticated Reddit user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.reddit.get_current_user({})
print("Logged in as: u/" .. result.name)
print("Link karma: " .. result.link_karma)
print("Comment karma: " .. result.comment_karma)
```

---

## Multi-Account Usage

If you have multiple Reddit accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.reddit.function_name({...})

-- Explicit default (portable across setups)
app.integrations.reddit.default.function_name({...})

-- Named accounts
app.integrations.reddit.production.function_name({...})
app.integrations.reddit.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
