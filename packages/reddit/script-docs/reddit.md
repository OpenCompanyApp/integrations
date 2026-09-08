# Reddit — Ruby API Reference

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

```ruby
# List hot posts from a subreddit
result = app.integrations.reddit.list_posts(subreddit: "programming", sort: "hot", limit: 10)
result.data.children.each do |post|
  puts((post.data.title).to_s + " (score: " + (post.data.score).to_s + ")")
end
# List new posts from the front page
result = app.integrations.reddit.list_posts(sort: "new", limit: 25)
result.data.children.each do |post|
  puts(post.data.title)
end
# Paginate through results
result = app.integrations.reddit.list_posts(subreddit: "worldnews", limit: 25)
# Use the last post's fullname to get the next page
last = result.data.children[result.data.children.length]
next_page = app.integrations.reddit.list_posts(subreddit: "worldnews", limit: 25, after: last.data.name)
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

```ruby
result = app.integrations.reddit.get_post(subreddit: "programming", post_id: "abc123")
# result is an array with two elements: [1]: post listing, [2]: comments
post = result[0].data.children[0].data
puts(post.title)
puts("Score: " + (post.score).to_s)
puts("Author: u/" + (post.author).to_s)
puts("Comments: " + (post.num_comments).to_s)
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

```ruby
# Create a text post
result = app.integrations.reddit.create_post(subreddit: "test", title: "Hello from OpenCompany!", kind: "self", text: "This is a test post created via the API.")
puts("Post created: " + (result.json.data.name).to_s)
# Create a link post
result = app.integrations.reddit.create_post(subreddit: "programming", title: "Interesting article about Ruby", kind: "link", url: "https://www.lua.org/")
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

```ruby
# List popular subreddits
result = app.integrations.reddit.list(sort: "popular", limit: 10)
result.data.children.each do |sub|
  puts("r/" + (sub.data.display_name).to_s + " - " + (sub.data.subscribers).to_s + " subscribers")
end
# List new subreddits
result = app.integrations.reddit.list(sort: "new", limit: 10)
result.data.children.each do |sub|
  puts("r/" + (sub.data.display_name).to_s + " - " + (sub.data.title).to_s)
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

```ruby
result = app.integrations.reddit.get(subreddit: "programming")
puts("r/" + (result.data.display_name).to_s)
puts("Title: " + (result.data.title).to_s)
puts("Subscribers: " + (result.data.subscribers).to_s)
puts("Description: " + (result.data.public_description).to_s)
puts("Created (Unix seconds): " + (result.data.created_utc).to_s)
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

```ruby
result = app.integrations.reddit.list_comments(subreddit: "programming", post_id: "abc123", limit: 10, sort: "top")
# Comments are in the second element of the response array
result[1].data.children.each do |comment|
  if (comment.kind == "t1")
    puts("u/" + (comment.data.author).to_s + ": " + (comment.data.body[(1 - 1)...100]).to_s)
    puts("Score: " + (comment.data.score).to_s)
  end
end
```
---

## get_current_user

Get the profile of the currently authenticated Reddit user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.reddit.get_current_user()
puts("Logged in as: u/" + (result.name).to_s)
puts("Link karma: " + (result.link_karma).to_s)
puts("Comment karma: " + (result.comment_karma).to_s)
```
---

## Multi-Account Usage

If you have multiple Reddit accounts configured, use account-specific namespaces:

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
