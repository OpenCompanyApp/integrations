# Discourse — JavaScript API Reference

## list_topics

List the latest topics from the forum.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

```js
var result = app.integrations.discourse.list_topics({ page: 1 })

for (const topic of (result.topic_list.topics)) {
  console.log(topic.id + ": " + topic.title + " (category: " + topic.category_id + ")")
}
```
---

## get_topic

Get a single topic with its posts and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_id` | integer | yes | The ID of the topic to retrieve |

### Examples

```js
var result = app.integrations.discourse.get_topic({ topic_id: 42 })

console.log("Title: " + result.title)
console.log("Posts: " + result.posts_count)

for (const post of (result.post_stream.posts)) {
  console.log(post.username + ": " + post.cooked)
}
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

```js
var result = app.integrations.discourse.create_topic({
  title: "Welcome to the new forum",
  raw: "This is the first post in our new category!",
  category: 5,
  tags: [ "announcement", "welcome" ],
})

console.log("Created topic ID: " + result.topic_id)
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

```js
// Rename a topic
app.integrations.discourse.update_topic({
  topic_id: 42,
  title: "Updated Topic Title",
})

// Move a topic to a different category
app.integrations.discourse.update_topic({
  topic_id: 42,
  category: 10,
})
```
---

## list_categories

List all categories on the forum.

### Parameters

None.

### Examples

```js
var result = app.integrations.discourse.list_categories({})

for (const cat of (result.category_list.categories)) {
  console.log(cat.id + ": " + cat.name + " — " + (cat.description_text || ""))
}
```
---

## get_category

Get a single category with its recent topics.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `category_id` | integer | yes | The ID of the category to retrieve |

### Examples

```js
var result = app.integrations.discourse.get_category({ category_id: 5 })

console.log("Category: " + result.topic_list.name)
console.log("Description: " + (result.topic_list.description_text || ""))

for (const topic of (result.topic_list.topics)) {
  console.log("  " + topic.id + ": " + topic.title)
}
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

```js
var result = app.integrations.discourse.create_post({
  topic_id: 42,
  raw: "Thanks for the update! This looks great.",
})

console.log("Created post ID: " + result.id)
```
---

## get_current_user

Get the currently authenticated user profile. Useful for verifying API credentials.

### Parameters

None.

### Examples

```js
var result = app.integrations.discourse.get_current_user({})

console.log("User: " + result.current_user.username)
console.log("Name: " + (result.current_user.name || ""))
console.log("Admin: " + String(result.current_user.admin))
```
---

## Multi-Account Usage

If you have multiple Discourse instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.discourse.list_topics({})

// Explicit default (portable across setups)
app.integrations.discourse.default.list_topics({})

// Named accounts
app.integrations.discourse.community.list_topics({})
app.integrations.discourse.support.list_topics({})
```
All functions are identical across accounts — only the credentials differ.
