# Crisp — Lua API Reference

## list_conversations

List chat conversations for the website.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Default: 1 |
| `per_page` | integer | no | Conversations per page (max 100). Default: 25 |

### Example

```lua
local result = app.integrations.crisp.list_conversations({
  page = 1,
  per_page = 25
})

for _, conv in ipairs(result.data or {}) do
  print(conv.session_id .. " — " .. (conv.last_message or "no messages"))
end
```

---

## get_conversation

Get details and messages of a specific conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | The conversation session ID |

### Example

```lua
local result = app.integrations.crisp.get_conversation({
  conversation_id = "session_abc123"
})

for _, msg in ipairs(result.data or {}) do
  print(msg.from .. ": " .. msg.content)
end
```

---

## send_message

Send a message in a Crisp conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | The conversation session ID |
| `text` | string | yes | The message text to send |
| `type` | string | no | Message type: `"text"` (default), `"note"`, `"file"` |
| `from` | string | no | Message origin: `"operator"` (default) or `"user"` |

### Example

```lua
local result = app.integrations.crisp.send_message({
  conversation_id = "session_abc123",
  text = "Hello! How can I help you today?",
  type = "text",
  from = "operator"
})

print("Message sent: " .. tostring(result.sent))
```

### Send an internal note

```lua
local result = app.integrations.crisp.send_message({
  conversation_id = "session_abc123",
  text = "VIP customer — handle with priority.",
  type = "note",
  from = "operator"
})
```

---

## list_contacts

List contacts for the website.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Default: 1 |
| `per_page` | integer | no | Contacts per page (max 100). Default: 25 |

### Example

```lua
local result = app.integrations.crisp.list_contacts({
  page = 1,
  per_page = 50
})

for _, contact in ipairs(result.data or {}) do
  print(contact.email .. " — " .. (contact.person.nickname or "unknown"))
end
```

---

## get_contact

Get details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The contact identifier (email or Crisp contact ID) |

### Example

```lua
local result = app.integrations.crisp.get_contact({
  contact_id = "user@example.com"
})

local contact = result.data or {}
print("Name: " .. (contact.person.nickname or "N/A"))
print("Email: " .. (contact.person.email or "N/A"))
```

---

## list_campaigns

List marketing campaigns for the website.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Default: 1 |
| `per_page` | integer | no | Campaigns per page (max 100). Default: 25 |

### Example

```lua
local result = app.integrations.crisp.list_campaigns({
  page = 1,
  per_page = 25
})

for _, campaign in ipairs(result.data or {}) do
  print(campaign.name .. " — status: " .. campaign.state)
end
```

---

## get_current_user

Get the authenticated Crisp user profile. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.crisp.get_current_user({})

local user = result.data or {}
print("Connected as: " .. (user.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Crisp accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.crisp.list_conversations({...})

-- Explicit default (portable across setups)
app.integrations.crisp.default.list_conversations({...})

-- Named accounts
app.integrations.crisp.support.list_conversations({...})
app.integrations.crisp.sales.list_conversations({...})
```

All functions are identical across accounts — only the credentials differ.
