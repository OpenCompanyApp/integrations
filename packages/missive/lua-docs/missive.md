# Missive — Lua API Reference

## list_conversations

List conversations from Missive with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox` | string | no | Filter by inbox ID |
| `assignee` | string | no | Filter by assignee user ID or email |
| `state` | string | no | Filter by state: `"open"`, `"closed"`, or `"spam"` |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `offset` | integer | no | Offset for pagination |

### Examples

```lua
-- List open conversations
local result = app.integrations.missive.list_conversations({
  state = "open",
  limit = 10
})

for _, conv in ipairs(result.conversations) do
  print(conv.subject .. " - " .. conv.state)
end
```

```lua
-- List conversations assigned to a specific user
local result = app.integrations.missive.list_conversations({
  assignee = "user@example.com",
  state = "open"
})
```

---

## get_conversation

Get a single conversation by ID, including messages and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The conversation UUID |

### Example

```lua
local result = app.integrations.missive.get_conversation({
  id = "abc123-def456-..."
})

print(result.conversation.subject)
for _, msg in ipairs(result.conversation.messages) do
  print(msg.from .. ": " .. msg.body)
end
```

---

## create_comment

Add a comment to a Missive conversation. Use this for internal notes or replies.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | The UUID of the conversation |
| `body` | string | yes | Comment body text (supports Markdown) |
| `assignees` | array | no | List of user IDs or emails to assign |

### Example

```lua
local result = app.integrations.missive.create_comment({
  conversation_id = "abc123-def456-...",
  body = "Reviewed the proposal — approved. Ready to proceed.",
  assignees = {"colleague@example.com"}
})
```

---

## list_tasks

List tasks from Missive with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by state: `"open"` or `"completed"` |
| `assignee` | string | no | Filter by assignee user ID or email |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `offset` | integer | no | Offset for pagination |

### Examples

```lua
-- List open tasks
local result = app.integrations.missive.list_tasks({
  state = "open"
})

for _, task in ipairs(result.tasks) do
  print(task.title .. " (due: " .. (task.due_date or "no date") .. ")")
end
```

```lua
-- List completed tasks for a user
local result = app.integrations.missive.list_tasks({
  state = "completed",
  assignee = "user@example.com",
  limit = 20
})
```

---

## create_task

Create a new task in Missive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The task title |
| `description` | string | no | Detailed description (supports Markdown) |
| `assignee` | string | no | User ID or email to assign the task to |
| `due_date` | string | no | Due date in ISO 8601 format (e.g., `"2025-12-31"`) |

### Example

```lua
local result = app.integrations.missive.create_task({
  title = "Follow up with client",
  description = "Reply to the pricing inquiry from the conversation thread.",
  assignee = "teammate@example.com",
  due_date = "2025-12-31"
})

print("Created task: " .. result.task.id)
```

---

## get_current_user

Get the profile of the currently authenticated Missive user.

### Parameters

None.

### Example

```lua
local result = app.integrations.missive.get_current_user({})

print("Logged in as: " .. result.user.name .. " (" .. result.user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Missive accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.missive.function_name({...})

-- Explicit default (portable across setups)
app.integrations.missive.default.function_name({...})

-- Named accounts
app.integrations.missive.work.function_name({...})
app.integrations.missive.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
