# Hacker News — Ruby API Reference

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

```ruby
item = app.integrations.hackernews.get_item(id: 12345)
if item
  puts(item.title)
  puts("by " + (item.by).to_s + " | score: " + ((item.score || 0)).to_s)
  puts("Comments: " + ((item.descendants || 0)).to_s)
  if item.url
    puts("Link: " + (item.url).to_s)
  end
end
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

```ruby
user = app.integrations.hackernews.get_user(id: "pg")
if user
  puts((user.id).to_s + " has " + (user.karma).to_s + " karma")
  puts("Account created: " + (user.created_iso).to_s)
end
```
---

## list_top_stories

Fetch the current top stories from Hacker News, ranked by the HN algorithm (combination of score, recency, and flags).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_top_stories(limit: 10)
result.stories.each do |story|
  puts(story.title)
  puts("  by " + ((story.by || "unknown")).to_s + " | score: " + ((story.score || 0)).to_s + " | comments: " + ((story.descendants || 0)).to_s)
  if story.url
    puts("  " + (story.url).to_s)
  end
end
```
---

## list_new_stories

Fetch the newest stories from Hacker News. These are the most recently submitted stories, not yet ranked by the HN algorithm.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_stories(limit: 15)
result.stories.each do |story|
  puts((story.title).to_s + " (score: " + ((story.score || 0)).to_s + ")")
end
```
---

## list_best_stories

Fetch the highest-scoring stories from Hacker News, regardless of age.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_best_stories(limit: 10)
puts("Top " + (result.limit).to_s + " of " + (result.total_ids).to_s + " best stories:")
result.stories.each do |story|
  puts("  [" + (story.score).to_s + "] " + (story.title).to_s)
end
```
---

## list_ask_stories

Fetch the latest Ask HN stories. The official API returns up to 200 Ask HN item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_ask_stories(limit: 10)
result.stories.each do |story|
  puts(story.title)
  puts((story.text || ""))
end
```
---

## list_show_stories

Fetch the latest Show HN stories. The official API returns up to 200 Show HN item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_show_stories(limit: 10)
result.stories.each do |story|
  puts(story.title)
  if story.url
    puts(story.url)
  end
end
```
---

## list_job_stories

Fetch the latest Hacker News job stories. The official API returns up to 200 job item IDs; this tool resolves the first `limit` IDs to item data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max job stories to return (default: 30, max: 100) |

### Example

```ruby
result = app.integrations.hackernews.list_job_stories(limit: 10)
result.stories.each do |job|
  puts(job.title)
  puts(((job.url || job.text) || ""))
end
```
---

## get_max_item

Fetch the current largest Hacker News item ID. This is useful when walking backward through all public HN items.

### Parameters

No parameters required.

### Example

```ruby
result = app.integrations.hackernews.get_max_item()
puts(result.max_item)
```
---

## get_updates

Fetch recently changed item IDs and user profile IDs from the official updates endpoint.

### Parameters

No parameters required.

### Example

```ruby
updates = app.integrations.hackernews.get_updates()
puts("Changed items: " + (updates.item_count).to_s)
puts("Changed profiles: " + (updates.profile_count).to_s)
```
---

## Common Patterns

### Get a story and its top comments

```ruby
story = app.integrations.hackernews.get_item(id: 12345)
if (story && story.kids)
  story.kids.each_with_index.map { |value, index| [index, value] }.each do |__index, kid_id|
    i = (__index + 1)
    if (i > 5)
      break
    end
    comment = app.integrations.hackernews.get_item(id: kid_id)
    if comment
      puts((comment.by).to_s + ": " + ((comment.text || "")).to_s)
    end
  end
end
```
### Find stories about a topic

```ruby
result = app.integrations.hackernews.list_top_stories(limit: 50)
topic = "rust"
result.stories.each do |story|
  if (story.title && (story.title).to_s.downcase().include?(topic))
    puts("[" + ((story.score || 0)).to_s + "] " + (story.title).to_s)
    if story.url
      puts("  " + (story.url).to_s)
    end
  end
end
```