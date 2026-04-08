# Hacker News — Lua API Reference

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

```lua
local item = app.integrations.hackernews.get_item({ id = 12345 })

if item then
  print(item.title)
  print("by " .. item.by .. " | score: " .. (item.score or 0))
  print("Comments: " .. (item.descendants or 0))
  if item.url then
    print("Link: " .. item.url)
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

```lua
local user = app.integrations.hackernews.get_user({ id = "pg" })

if user then
  print(user.id .. " has " .. user.karma .. " karma")
  print("Account created: " .. user.created_iso)
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

```lua
local result = app.integrations.hackernews.list_top_stories({ limit = 10 })

for _, story in ipairs(result.stories) do
  print(story.title)
  print("  by " .. (story.by or "unknown") .. " | score: " .. (story.score or 0) .. " | comments: " .. (story.descendants or 0))
  if story.url then
    print("  " .. story.url)
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

```lua
local result = app.integrations.hackernews.list_new_stories({ limit = 15 })

for _, story in ipairs(result.stories) do
  print(story.title .. " (score: " .. (story.score or 0) .. ")")
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

```lua
local result = app.integrations.hackernews.list_best_stories({ limit = 10 })

print("Top " .. result.limit .. " of " .. result.total_ids .. " best stories:")
for _, story in ipairs(result.stories) do
  print("  [" .. story.score .. "] " .. story.title)
end
```

---

## Common Patterns

### Get a story and its top comments

```lua
local story = app.integrations.hackernews.get_item({ id = 12345 })

if story and story.kids then
  for i, kid_id in ipairs(story.kids) do
    if i > 5 then break end
    local comment = app.integrations.hackernews.get_item({ id = kid_id })
    if comment then
      print(comment.by .. ": " .. (comment.text or ""))
    end
  end
end
```

### Find stories about a topic

```lua
local result = app.integrations.hackernews.list_top_stories({ limit = 50 })
local topic = "rust"

for _, story in ipairs(result.stories) do
  if story.title and string.find(string.lower(story.title), topic) then
    print("[" .. (story.score or 0) .. "] " .. story.title)
    if story.url then print("  " .. story.url) end
  end
end
```
