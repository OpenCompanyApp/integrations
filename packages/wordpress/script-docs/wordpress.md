# WordPress — Ruby API Reference

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

```ruby
result = app.integrations.wordpress.list_posts(per_page: 5, status: "publish", orderby: "date", order: "desc")
result.each do |post|
  puts((post.id).to_s + ": " + (post.title.rendered).to_s)
end
```
---

## get_post

Get a single post by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The post ID |

### Example

```ruby
post = app.integrations.wordpress.get_post(id: 123)
puts(post.title.rendered)
puts(post.content.rendered)
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

```ruby
post = app.integrations.wordpress.create_post(title: "My New Post", content: "<p>Hello world!</p>", status: "draft", categories: [1, 5])
puts("Created post ID: " + (post.id).to_s)
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

```ruby
post = app.integrations.wordpress.update_post(id: 123, title: "Updated Title", status: "publish")
puts("Updated: " + (post.title.rendered).to_s)
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

```ruby
pages = app.integrations.wordpress.list_pages(per_page: 20, status: "publish")
pages.each do |page|
  puts((page.id).to_s + ": " + (page.title.rendered).to_s)
end
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

```ruby
users = app.integrations.wordpress.list_users(roles: "administrator,editor", per_page: 50)
users.each do |user|
  puts((user.id).to_s + ": " + (user.name).to_s + " (" + (user.slug).to_s + ")")
end
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

```ruby
comments = app.integrations.wordpress.list_comments(post: 123, status: "approved", per_page: 20)
comments.each do |comment|
  puts((comment.author_name).to_s + ": " + (comment.content.rendered).to_s)
end
```
---

## get_current_user

Get the currently authenticated WordPress user profile. No parameters required.

### Example

```ruby
user = app.integrations.wordpress.get_current_user()
puts("Logged in as: " + (user.name).to_s)
puts("Roles: " + (user.roles.join(", ")).to_s)
```