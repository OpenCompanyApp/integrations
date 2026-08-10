# Hacker News — JavaScript API Reference

All Hacker News tools are available under `app.integrations.hackernews`.

## get_item

Fetch a single Hacker News item (story, comment, job, poll, or poll option) by its numeric ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Hacker News item ID (e.g., `12345`) |

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Item ID |
| `type` | string | Item type: `story`, `comment`, `job`, `poll`, `pollopt` |
| `title` | string\|null | Title (stories, jobs, polls) |
| `url` | string\|null | External URL (stories, jobs) |
| `text` | string\|null | HTML body text (comments, text posts, poll options) |
| `by` | string\|null | Author username |
| `score` | integer\|null | Score / upvotes |
| `time` | integer\|null | Unix timestamp |
| `time_iso` | string\|null | ISO 8601 formatted time |
| `descendants` | integer\|null | Total comment count |
| `kids` | array | Direct child item IDs (comments) |
| `parent` | integer\|null | Parent item ID (for comments) |
| `deleted` | boolean | Whether the item was deleted |

### Example

```js
var item = app.integrations.hackernews.get_item({ id: 12345 })

if (item) {
  console.log(item.title)
  console.log("by " + item.by + " | score: " + (item.score || 0))
  console.log("Comments: " + (item.descendants || 0))
  if (item.url) {
    console.log("Link: " + item.url)
  }
}
```
---

## get_user

Fetch a Hacker News user profile by username.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Hacker News username (e.g., `"pg"`, `"dang"`) |

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Username |
| `karma` | integer | Karma score |
| `about` | string\|null | Profile about text (HTML) |
| `created` | integer | Unix timestamp of account creation |
| `created_iso` | string | ISO 8601 formatted creation time |
| `submitted` | array | List of submitted item IDs |

### Example

```js
var user = app.integrations.hackernews.get_user({ id: "pg" })

if (user) {
  console.log(user.id + " has " + user.karma + " karma")
  console.log("Account created: " + user.created_iso)
}
```
---

## list_top_stories

Fetch the current top stories from Hacker News, ranked by the HN algorithm (combination of score, recency, and flags).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_top_stories({ limit: 10 })

for (const story of (result.stories)) {
  console.log(story.title)
  console.log("  by " + (story.by || "unknown") + " | score: " + (story.score || 0) + " | comments: " + (story.descendants || 0))
  if (story.url) {
    console.log("  " + story.url)
  }
}
```
---

## list_new_stories

Fetch the newest stories from Hacker News. These are the most recently submitted stories, not yet ranked by the HN algorithm.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_new_stories({ limit: 15 })

for (const story of (result.stories)) {
  console.log(story.title + " (score: " + (story.score || 0) + ")")
}
```
---

## list_best_stories

Fetch the highest-scoring stories from Hacker News, regardless of age.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_best_stories({ limit: 10 })

console.log("Top " + result.limit + " of " + result.total_ids + " best stories:")
for (const story of (result.stories)) {
  console.log("  [" + story.score + "] " + story.title)
}
```
---

## list_ask_stories

Fetch the latest Ask HN stories. The official API returns up to 200 Ask HN item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_ask_stories({ limit: 10 })

for (const story of (result.stories)) {
  console.log(story.title)
  console.log(story.text || "")
}
```
---

## list_show_stories

Fetch the latest Show HN stories. The official API returns up to 200 Show HN item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_show_stories({ limit: 10 })

for (const story of (result.stories)) {
  console.log(story.title)
  if (story.url) { console.log(story.url); }
}
```
---

## list_job_stories

Fetch the latest Hacker News job stories. The official API returns up to 200 job item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max job stories to return (default: 30, max: 100) |

### Example

```js
var result = app.integrations.hackernews.list_job_stories({ limit: 10 })

for (const job of (result.stories)) {
  console.log(job.title)
  console.log(job.url || job.text || "")
}
```
---

## get_max_item

Fetch the current largest Hacker News item ID. This is useful when walking backward through all public HN items.

### Parameters

No parameters required.

### Example

```js
var result = app.integrations.hackernews.get_max_item()
console.log(result.max_item)
```
---

## get_updates

Fetch recently changed item IDs and user profile IDs from the official updates endpoint.

### Parameters

No parameters required.

### Example

```js
var updates = app.integrations.hackernews.get_updates()

console.log("Changed items: " + updates.item_count)
console.log("Changed profiles: " + updates.profile_count)
```
---

## Common Patterns

### Get a story and its top comments

```js
var story = app.integrations.hackernews.get_item({ id: 12345 })

if (story && story.kids) {
  for (const [__index, kid_id] of Array.from(story.kids).entries()) {
    const i = __index + 1;
    if (i > 5) { break; }
    var comment = app.integrations.hackernews.get_item({ id: kid_id })
    if (comment) {
      console.log(comment.by + ": " + (comment.text || ""))
    }
  }
}
```
### Find stories about a topic

```js
var result = app.integrations.hackernews.list_top_stories({ limit: 50 })
var topic = "rust"

for (const story of (result.stories)) {
  if (story.title && String(story.title).toLowerCase().includes(topic)) {
    console.log("[" + (story.score || 0) + "] " + story.title)
    if (story.url) { console.log("  " + story.url); }
  }
}
```