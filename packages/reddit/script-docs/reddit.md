# Reddit — JavaScript API Reference

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

```js
// List hot posts from a subreddit
var result = app.integrations.reddit.list_posts({
  subreddit: "programming",
  sort: "hot",
  limit: 10,
})

for (const post of (result.data.children)) {
  console.log(post.data.title + " (score: " + post.data.score + ")")
}

// List new posts from the front page
var result = app.integrations.reddit.list_posts({
  sort: "new",
  limit: 25,
})

for (const post of (result.data.children)) {
  console.log(post.data.title)
}

// Paginate through results
var result = app.integrations.reddit.list_posts({
  subreddit: "worldnews",
  limit: 25,
})

// Use the last post's fullname to get the next page
var last = result.data.children[result.data.children.length]
var next_page = app.integrations.reddit.list_posts({
  subreddit: "worldnews",
  limit: 25,
  after: last.data.name,
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

```js
var result = app.integrations.reddit.get_post({
  subreddit: "programming",
  post_id: "abc123",
})

// result is an array with two elements: [1]: post listing, [2]: comments
var post = result[0].data.children[0].data
console.log(post.title)
console.log("Score: " + post.score)
console.log("Author: u/" + post.author)
console.log("Comments: " + post.num_comments)
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

```js
// Create a text post
var result = app.integrations.reddit.create_post({
  subreddit: "test",
  title: "Hello from OpenCompany!",
  kind: "self",
  text: "This is a test post created via the API.",
})

console.log("Post created: " + result.json.data.name)

// Create a link post
var result = app.integrations.reddit.create_post({
  subreddit: "programming",
  title: "Interesting article about JavaScript",
  kind: "link",
  url: "https://www.lua.org/",
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

```js
// List popular subreddits
var result = app.integrations.reddit.list_subreddits({
  sort: "popular",
  limit: 10,
})

for (const sub of (result.data.children)) {
  console.log("r/" + sub.data.display_name + " - " + sub.data.subscribers + " subscribers")
}

// List new subreddits
var result = app.integrations.reddit.list_subreddits({
  sort: "new",
  limit: 10,
})

for (const sub of (result.data.children)) {
  console.log("r/" + sub.data.display_name + " - " + sub.data.title)
}
```
---

## get_subreddit

Get information about a specific subreddit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subreddit` | string | yes | Subreddit name (without r/ prefix) |

### Examples

```js
var result = app.integrations.reddit.get_subreddit({
  subreddit: "programming",
})

console.log("r/" + result.data.display_name)
console.log("Title: " + result.data.title)
console.log("Subscribers: " + result.data.subscribers)
console.log("Description: " + result.data.public_description)
console.log("Created: " + new Date(result.data.created_utc * 1000).toISOString().slice(0, 10))
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

```js
var result = app.integrations.reddit.list_comments({
  subreddit: "programming",
  post_id: "abc123",
  limit: 10,
  sort: "top",
})

// Comments are in the second element of the response array
for (const comment of (result[1].data.children)) {
  if (comment.kind === "t1") {
    console.log("u/" + comment.data.author + ": " + comment.data.body.slice(1 - 1, 100))
    console.log("Score: " + comment.data.score)
  }
}
```
---

## get_current_user

Get the profile of the currently authenticated Reddit user.

### Parameters

None.

### Examples

```js
var result = app.integrations.reddit.get_current_user({})
console.log("Logged in as: u/" + result.name)
console.log("Link karma: " + result.link_karma)
console.log("Comment karma: " + result.comment_karma)
```
---

## Multi-Account Usage

If you have multiple Reddit accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.reddit.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.reddit.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.reddit.production.function_name({ /* parameters */ })
app.integrations.reddit.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
