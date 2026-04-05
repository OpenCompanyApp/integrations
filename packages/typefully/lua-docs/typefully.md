# Typefully — Lua API Reference

## create_draft

Create a new draft in Typefully. Supports tweets, threads, and newsletters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content` | string | yes | Draft content. For threads, separate tweets with four newlines (`\n\n\n\n`). |
| `type` | string | no | Draft type: `"tweet"`, `"thread"`, or `"mail"`. Auto-detected if omitted. |
| `schedule_date` | string | no | ISO 8601 date to schedule (e.g., `"2026-04-10T09:00:00Z"`). Omit to save unscheduled. |
| `thread_connector` | boolean | no | Add "Show more" between thread tweets (default: `true`). |
| `is_tweet_pin` | boolean | no | Pin the tweet after publishing (default: `false`). |
| `is_tweet_reply` | boolean | no | Publish as a reply (default: `false`). Requires `reply_to`. |
| `reply_to` | string | no | Tweet ID to reply to. |
| `mail_subject` | string | no | Subject line for newsletter drafts. |
| `mail_subtitle` | string | no | Subtitle for newsletter drafts. |
| `audience_id` | string | no | Audience ID for newsletter drafts. |
| `label_ids` | array | no | Label IDs to assign. |

### Examples

#### Simple tweet

```lua
local result = app.integrations.typefully.create_draft({
  content = "Hello world! This is my first scheduled tweet via the API."
})
print("Draft ID: " .. result.id)
```

#### Thread with scheduling

```lua
local result = app.integrations.typefully.create_draft({
  content = "🧵 Thread: 3 tips for better tweets\n\n\n\n1/ Keep it concise. Short tweets get more engagement.\n\n\n\n2/ Use a hook. Start with a bold statement or question.\n\n\n\n3/ End with a CTA. Tell people what to do next.",
  type = "thread",
  schedule_date = "2026-04-10T09:00:00Z"
})
print("Scheduled thread ID: " .. result.id)
```

#### Newsletter draft

```lua
local result = app.integrations.typefully.create_draft({
  content = "# Weekly Update\n\nHere's what happened this week...",
  type = "mail",
  mail_subject = "Weekly Update — April 2026",
  mail_subtitle = "News, updates, and tips"
})
```

---

## list_scheduled

List scheduled drafts awaiting publication.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 20, max: 100). |
| `offset` | integer | no | Skip N results for pagination (default: 0). |

### Example

```lua
local result = app.integrations.typefully.list_scheduled({
  limit = 10
})

for _, draft in ipairs(result.drafts or {}) do
  print(draft.id .. ": scheduled for " .. (draft.schedule_date or "unscheduled"))
end
```

---

## list_published

List already published drafts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 20, max: 100). |
| `offset` | integer | no | Skip N results for pagination (default: 0). |

### Example

```lua
local result = app.integrations.typefully.list_published({
  limit = 10
})

for _, draft in ipairs(result.drafts or {}) do
  print(draft.id .. ": published " .. (draft.published_at or "unknown"))
end
```

---

## get_draft

Get details of a specific draft by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Typefully draft ID. |

### Example

```lua
local result = app.integrations.typefully.get_draft({
  id = "abc123"
})

print("Content: " .. result.content)
print("Status: " .. (result.status or "unknown"))
```

---

## get_current_user

Get the authenticated user's Typefully profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.typefully.get_current_user({})
print("Handle: @" .. (result.handle or "unknown"))
print("Name: " .. (result.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Typefully accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.typefully.function_name({...})

-- Explicit default (portable across setups)
app.integrations.typefully.default.function_name({...})

-- Named accounts
app.integrations.typefully.work.function_name({...})
app.integrations.typefully.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
