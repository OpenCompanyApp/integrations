# Discourse — Ruby API Reference

## list_topics

List the latest topics from the forum.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

```ruby
result = app.integrations.discourse.list_topics(page: 1)
result.topic_list.topics.each do |topic|
  puts((topic.id).to_s + ": " + (topic.title).to_s + " (category: " + (topic.category_id).to_s + ")")
end
```
---

## get_topic

Get a single topic with its posts and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_id` | integer | yes | The ID of the topic to retrieve |

### Examples

```ruby
result = app.integrations.discourse.get_topic(topic_id: 42)
puts("Title: " + (result.title).to_s)
puts("Posts: " + (result.posts_count).to_s)
result.post_stream.posts.each do |post|
  puts((post.username).to_s + ": " + (post.cooked).to_s)
end
```
---

## create_topic

Create a new topic (first post) in a category.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The topic title |
| `raw` | string | yes | Body content in Markdown |
| `category` | integer | yes | Category ID to post in |
| `tags` | array | no | Tags for the topic |

### Examples

```ruby
result = app.integrations.discourse.create_topic(title: "Welcome to the new forum", raw: "This is the first post in our new category!", category: 5, tags: ["announcement", "welcome"])
puts("Created topic ID: " + (result.topic_id).to_s)
```
---

## update_topic

Update an existing topic's title or move it to a different category.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_id` | integer | yes | The ID of the topic to update |
| `title` | string | no | New title for the topic |
| `category` | integer | no | New category ID to move the topic to |

At least one of `title` or `category` must be provided.

### Examples

```ruby
# Rename a topic
app.integrations.discourse.update_topic(topic_id: 42, title: "Updated Topic Title")
# Move a topic to a different category
app.integrations.discourse.update_topic(topic_id: 42, category: 10)
```
---

## list_categories

List all categories on the forum.

### Parameters

None.

### Examples

```ruby
result = app.integrations.discourse.list_categories()
result.category_list.categories.each do |cat|
  puts((cat.id).to_s + ": " + (cat.name).to_s + " — " + ((cat.description_text || "")).to_s)
end
```
---

## get_category

Get a single category with its recent topics.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `category_id` | integer | yes | The ID of the category to retrieve |

### Examples

```ruby
result = app.integrations.discourse.get_category(category_id: 5)
puts("Category: " + (result.topic_list.name).to_s)
puts("Description: " + ((result.topic_list.description_text || "")).to_s)
result.topic_list.topics.each do |topic|
  puts("  " + (topic.id).to_s + ": " + (topic.title).to_s)
end
```
---

## create_post

Reply to an existing topic with a new post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_id` | integer | yes | The ID of the topic to reply to |
| `raw` | string | yes | Post body content in Markdown |

### Examples

```ruby
result = app.integrations.discourse.create_post(topic_id: 42, raw: "Thanks for the update! This looks great.")
puts("Created post ID: " + (result.id).to_s)
```
---

## get_current_user

Get the currently authenticated user profile. Useful for verifying API credentials.

### Parameters

None.

### Examples

```ruby
result = app.integrations.discourse.get_current_user()
puts("User: " + (result.current_user.username).to_s)
puts("Name: " + ((result.current_user.name || "")).to_s)
puts("Admin: " + ((result.current_user.admin).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple Discourse instances configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.discourse.list_topics()
# Explicit default (portable across setups)
app.integrations.discourse.default.list_topics()
# Named accounts
app.integrations.discourse.community.list_topics()
app.integrations.discourse.support.list_topics()
```
All functions are identical across accounts — only the credentials differ.
