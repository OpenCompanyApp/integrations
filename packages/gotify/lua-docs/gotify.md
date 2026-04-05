# Gotify — Lua API Reference

## list_messages

List messages from the Gotify application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of messages to return (default: 100, max: 200) |
| `since` | integer | no | Return messages with ID greater than this value (for polling) |

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `messages` | array | List of message objects |
| `paging` | table | Pagination info with `size` and `limit` |

Each message object contains:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Unique message ID |
| `appid` | integer | Application ID |
| `message` | string | Message body (may contain Markdown) |
| `title` | string | Message title |
| `priority` | integer | Message priority (0–10) |
| `date` | string | ISO 8601 timestamp |
| `extras` | table | Optional extra fields |

### Examples

```lua
-- List the 10 most recent messages
local result = app.integrations.gotify.list_messages({
  limit = 10
})

for _, msg in ipairs(result.messages) do
  print("[" .. msg.id .. "] " .. msg.title .. " (priority: " .. msg.priority .. ")")
  print(msg.message)
end
```

```lua
-- Poll for new messages since ID 1234
local result = app.integrations.gotify.list_messages({
  since = 1234,
  limit = 50
})

print("New messages: " .. #result.messages)
```

---

## create_message

Send a notification message via Gotify.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Message title |
| `message` | string | yes | Message body (supports Markdown) |
| `priority` | integer | no | Priority from 0 (lowest) to 10 (highest). Default: 5 |

### Priority Levels

| Range | Level |
|-------|-------|
| 0–4 | Low priority |
| 5 | Normal (default) |
| 6–10 | High priority |

### Examples

```lua
-- Send a simple notification
local result = app.integrations.gotify.create_message({
  title = "Deploy Complete",
  message = "Version 2.1.0 deployed to production successfully.",
  priority = 5
})

print("Message sent with ID: " .. result.id)
```

```lua
-- Send a high-priority alert
app.integrations.gotify.create_message({
  title = "⚠️ Server Alert",
  message = "CPU usage above 90% on web-01.example.com",
  priority = 8
})
```

```lua
-- Send a Markdown-formatted message
app.integrations.gotify.create_message({
  title = "Weekly Report",
  message = [[## Summary

- **Pageviews**: 12,450 (+15%)
- **Visitors**: 3,200 (+8%)
- **Bounce Rate**: 42%

Full report: [Dashboard](https://example.com/dashboard)]],
  priority = 5
})
```

---

## delete_message

Delete a message by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the message to delete |

### Examples

```lua
-- Delete a specific message
app.integrations.gotify.delete_message({
  id = 42
})
```

```lua
-- Delete all listed messages
local result = app.integrations.gotify.list_messages({ limit = 100 })

for _, msg in ipairs(result.messages) do
  app.integrations.gotify.delete_message({ id = msg.id })
end

print("Deleted " .. #result.messages .. " messages")
```

---

## get_health

Check the health status of the Gotify server.

### Parameters

None.

### Response

Returns a table with health information:

| Field | Type | Description |
|-------|------|-------------|
| `health` | string | Health status (e.g., `"green"`) |
| `database` | string | Database status (e.g., `"green"`) |

### Examples

```lua
-- Check server health
local health = app.integrations.gotify.get_health()

if health.health == "green" then
  print("Gotify server is healthy")
else
  print("Gotify server status: " .. health.health)
end
```

---

## get_current_user

Get information about the currently authenticated Gotify user.

### Parameters

None.

### Response

Returns a user object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | User ID |
| `name` | string | Username |
| `admin` | boolean | Whether the user is an admin |

### Examples

```lua
-- Get current user info
local user = app.integrations.gotify.get_current_user()

print("Logged in as: " .. user.name .. (user.admin and " (admin)" or ""))
```

---

## Multi-Account Usage

If you have multiple Gotify servers or application tokens configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.gotify.create_message({ title = "Hello", message = "World" })

-- Explicit default (portable across setups)
app.integrations.gotify.default.create_message({ title = "Hello", message = "World" })

-- Named accounts
app.integrations.gotify.work.create_message({ title = "Build passed", message = "CI build #42 passed" })
app.integrations.gotify.personal.create_message({ title = "Reminder", message = "Check backups" })
```

All functions are identical across accounts — only the credentials differ.
