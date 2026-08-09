# WordPress — JavaScript API Reference

## list_posts

List posts from the WordPress site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of posts per page (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `search` | string | no | Search term to filter by title or content |
| `status` | string | no | Post status: publish, draft, pending, private, trash, any (default: publish) |
| `author` | integer | no | Filter by author user ID |
| `categories` | string | no | Comma-separated category IDs |
| `tags` | string | no | Comma-separated tag IDs |
| `order` | string | no | Sort order: asc or desc (default: desc) |
| `orderby` | string | no | Sort field: date, title, author, id (default: date) |

### Example

```js
var result = app.integrations.wordpress.list_posts({
  per_page: 5,
  status: "publish",
  orderby: "date",
  order: "desc",
})

for (const post of (result)) {
  console.log(post.id + ": " + post.title.rendered)
}
```
---

## get_post

Get a single post by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The post ID |

### Example

```js
var post = app.integrations.wordpress.get_post({ id: 123 })
console.log(post.title.rendered)
console.log(post.content.rendered)
```
---

## create_post

Create a new post. Defaults to draft status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Post title |
| `content` | string | no | Post content (HTML) |
| `status` | string | no | draft, publish, pending, private (default: draft) |
| `excerpt` | string | no | Post excerpt (HTML) |
| `author` | integer | no | Author user ID |
| `categories` | array | no | Array of category IDs |
| `tags` | array | no | Array of tag IDs |
| `featured_media` | integer | no | Featured image media ID |
| `slug` | string | no | URL slug (auto-generated if omitted) |

### Example

```js
var post = app.integrations.wordpress.create_post({
  title: "My New Post",
  content: "<p>Hello world!</p>",
  status: "draft",
  categories: [ 1, 5 ],
})

console.log("Created post ID: " + post.id)
```
---

## update_post

Update an existing post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | Post ID to update |
| `title` | string | no | New title |
| `content` | string | no | New content (HTML) |
| `status` | string | no | New status |
| `excerpt` | string | no | New excerpt (HTML) |
| `author` | integer | no | New author user ID |
| `categories` | array | no | New category IDs (replaces existing) |
| `tags` | array | no | New tag IDs (replaces existing) |
| `featured_media` | integer | no | New featured image media ID |
| `slug` | string | no | New URL slug |

### Example

```js
var post = app.integrations.wordpress.update_post({
  id: 123,
  title: "Updated Title",
  status: "publish",
})

console.log("Updated: " + post.title.rendered)
```
---

## list_pages

List pages from the WordPress site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of pages per page (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `search` | string | no | Search term |
| `status` | string | no | Page status (default: publish) |
| `author` | integer | no | Filter by author user ID |
| `parent` | integer | no | Filter by parent page ID |
| `order` | string | no | Sort order (default: desc) |
| `orderby` | string | no | Sort field (default: date) |

### Example

```js
var pages = app.integrations.wordpress.list_pages({
  per_page: 20,
  status: "publish",
})

for (const page of (pages)) {
  console.log(page.id + ": " + page.title.rendered)
}
```
---

## list_users

List users registered on the WordPress site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of users per page (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `search` | string | no | Search by name, email, or slug |
| `roles` | string | no | Comma-separated roles (e.g. "administrator,editor") |
| `order` | string | no | Sort order (default: asc) |
| `orderby` | string | no | Sort field (default: name) |

### Example

```js
var users = app.integrations.wordpress.list_users({
  roles: "administrator,editor",
  per_page: 50,
})

for (const user of (users)) {
  console.log(user.id + ": " + user.name + " (" + user.slug + ")")
}
```
---

## list_comments

List comments from the WordPress site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of comments per page (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `post` | integer | no | Filter by post ID |
| `search` | string | no | Search term |
| `status` | string | no | Comment status: approved, hold, spam, trash, any (default: approved) |
| `author` | integer | no | Filter by comment author user ID |
| `order` | string | no | Sort order (default: desc) |
| `orderby` | string | no | Sort field (default: date_gmt) |

### Example

```js
var comments = app.integrations.wordpress.list_comments({
  post: 123,
  status: "approved",
  per_page: 20,
})

for (const comment of (comments)) {
  console.log(comment.author_name + ": " + comment.content.rendered)
}
```
---

## get_current_user

Get the currently authenticated WordPress user profile. No parameters required.

### Example

```js
var user = app.integrations.wordpress.get_current_user({})
console.log("Logged in as: " + user.name)
console.log("Roles: " + user.roles.join(", "))
```