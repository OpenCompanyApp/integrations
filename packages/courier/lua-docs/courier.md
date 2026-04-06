# Courier — Lua API Reference

## send_message

Send a notification message through Courier.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message` | object | yes | Message payload — includes template, content, data, routing, etc. |
| `recipient` | string | yes | Recipient — a Courier user ID, email, or JSON recipient object. |

### Message Object

The `message` object can include:

| Field | Type | Description |
|-------|------|-------------|
| `template` | string | Template ID to use (e.g., `"ABCD1234"`) |
| `content` | object | Inline content with `title` and `body` blocks |
| `data` | object | Template variables to merge into the message |
| `routing` | object | Channel routing overrides |
| `channels` | object | Per-channel content overrides |

### Recipient Formats

- Email: `"user@example.com"`
- User ID: `"user_123"`
- Object: `'{email: "user@example.com"}'`

### Examples

```lua
-- Send using a template
local result = app.integrations.courier.send_message({
  message = {
    template = "ABCD1234",
    data = { name = "John", plan = "Pro" }
  },
  recipient = "user@example.com"
})
print("Request ID: " .. result.request_id)

-- Send inline content
local result = app.integrations.courier.send_message({
  message = {
    content = {
      title = "Welcome!",
      body = "Thanks for signing up."
    }
  },
  recipient = "user@example.com"
})
```

---

## list_messages

List messages with optional filtering and cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max messages to return (default: 20, max: 200) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter: "delivered", "undelivered", "opened", "clicked", "bounced", "enqueued" |

### Example

```lua
local result = app.integrations.courier.list_messages({
  limit = 50,
  status = "delivered"
})
for _, msg in ipairs(result.results or {}) do
  print(msg.id .. " - " .. msg.status)
end
```

---

## get_message

Get details of a specific message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The message ID |

### Example

```lua
local result = app.integrations.courier.get_message({
  id = "msg_1234567890"
})
print("Status: " .. result.status)
print("To: " .. result.to)
```

---

## list_recipients

List notification recipients with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max recipients to return (default: 20, max: 200) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.courier.list_recipients({
  limit = 50
})
for _, r in ipairs(result.results or {}) do
  print(r.id .. " - " .. (r.email or "no email"))
end
```

---

## get_recipient

Get details of a specific recipient.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The recipient ID |

### Example

```lua
local result = app.integrations.courier.get_recipient({
  id = "rcpt_1234567890"
})
print("Email: " .. (result.email or "N/A"))
```

---

## list_templates

List notification templates with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max templates to return (default: 20, max: 200) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.courier.list_templates({
  limit = 50
})
for _, t in ipairs(result.results or {}) do
  print(t.id .. " - " .. t.name)
end
```

---

## get_current_user

Get the currently authenticated Courier user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.courier.get_current_user({})
print("User: " .. (result.user.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Courier accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.courier.function_name({...})

-- Explicit default (portable across setups)
app.integrations.courier.default.function_name({...})

-- Named accounts
app.integrations.courier.production.function_name({...})
app.integrations.courier.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
