# Front — Lua API Reference

## list_conversations

List and search conversations in Front.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `limit` | integer | no | Results per page (max 100) |
| `status` | string | no | Filter by status: `open`, `archived`, `assigned`, `unassigned`, `starred`, `snoozed` |
| `q` | string | no | Search query (subject, content, contact) |

### Examples

```lua
-- List open conversations
local result = app.integrations.front.list_conversations({
  status = "open",
  limit = 10
})

-- Search conversations
local result = app.integrations.front.list_conversations({
  q = "billing",
  limit = 5
})

-- Paginate through all conversations
local result = app.integrations.front.list_conversations({
  page = 2,
  limit = 50
})
```

---

## get_conversation

Get details of a specific conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Conversation ID (e.g., `"cnv_123abc"`) |

### Example

```lua
local result = app.integrations.front.get_conversation({
  id = "cnv_123abc"
})
print(result.subject)
```

---

## list_messages

List all messages in a conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Conversation ID (e.g., `"cnv_123abc"`) |
| `limit` | integer | no | Results per page (max 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```lua
local result = app.integrations.front.list_messages({
  conversation_id = "cnv_123abc",
  limit = 20
})

for _, msg in ipairs(result._results) do
  print(msg.sender.name .. ": " .. (msg.text or msg.body))
end
```

---

## send_message

Send a reply to an existing conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | Conversation ID to reply to |
| `body` | string | yes | HTML body of the message |
| `text` | string | no | Plain-text version of the message |
| `to` | array | no | Recipients: `{{"handle" = "user@example.com"}}` |
| `cc` | array | no | CC recipients: `{{"handle" = "mgr@example.com"}}` |

### Example

```lua
local result = app.integrations.front.send_message({
  conversation_id = "cnv_123abc",
  body = "<p>Hi there, thanks for your message!</p>",
  text = "Hi there, thanks for your message!",
  to = {{ handle = "customer@example.com" }},
  cc = {{ handle = "manager@example.com" }}
})
```

---

## list_contacts

List and search contacts in Front.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `limit` | integer | no | Results per page (max 100) |
| `q` | string | no | Search query (name, email, etc.) |

### Examples

```lua
-- Search contacts
local result = app.integrations.front.list_contacts({
  q = "john",
  limit = 10
})

-- List all contacts (paginated)
local result = app.integrations.front.list_contacts({
  page = 1,
  limit = 100
})
```

---

## get_contact

Get details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Contact ID (e.g., `"crd_123abc"`) |

### Example

```lua
local result = app.integrations.front.get_contact({
  id = "crd_123abc"
})
print(result.name)
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.front.get_current_user({})
print(result.first_name .. " " .. result.last_name)
print(result.email)
```

---

## Multi-Account Usage

If you have multiple Front accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.front.list_conversations({...})

-- Explicit default (portable across setups)
app.integrations.front.default.list_conversations({...})

-- Named accounts
app.integrations.front.support.list_conversations({...})
app.integrations.front.sales.list_conversations({...})
```

All functions are identical across accounts — only the credentials differ.
