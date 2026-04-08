# MailerSend — Lua API Reference

## list_messages

List email messages from your MailerSend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 25) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations["mailer-send"].list_messages({
  limit = 10,
  page = 1
})

for _, msg in ipairs(result.data or {}) do
  print(msg.id .. ": " .. (msg.subject or "(no subject)"))
end
```

---

## get_message

Get detailed information about a specific email message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique message ID |

### Example

```lua
local result = app.integrations["mailer-send"].get_message({
  id = "msg_abc123"
})

print("Status: " .. result.data.status)
print("Subject: " .. result.data.subject)
```

---

## send_email

Send an email through MailerSend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | object | yes | Sender with `email` and `name` keys |
| `to` | array | yes | Array of recipient objects with `email` and optional `name` |
| `subject` | string | yes | Email subject line |
| `html` | string | no | HTML body content |
| `text` | string | no | Plain text body content |

### Example

```lua
local result = app.integrations["mailer-send"].send_email({
  from = {
    email = "noreply@example.com",
    name = "Acme Corp"
  },
  to = {
    { email = "user@example.com", name = "John Doe" }
  },
  subject = "Welcome to Acme!",
  html = "<h1>Welcome!</h1><p>Thanks for signing up.</p>",
  text = "Welcome! Thanks for signing up."
})

print("Message ID: " .. result.data.message_id)
```

---

## list_templates

List email templates from your MailerSend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 25) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations["mailer-send"].list_templates({
  limit = 20
})

for _, tpl in ipairs(result.data or {}) do
  print(tpl.id .. ": " .. tpl.name)
end
```

---

## list_domains

List sending domains configured in your MailerSend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 25) |
| `page` | integer | no | Page number (default: 1) |
| `verified` | boolean | no | Filter by verification status |

### Example

```lua
local result = app.integrations["mailer-send"].list_domains({
  limit = 50,
  verified = true
})

for _, domain in ipairs(result.data or {}) do
  print(domain.name .. " - verified: " .. tostring(domain.verified))
end
```

---

## list_recipients

List recipients (contacts) from your MailerSend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 25) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations["mailer-send"].list_recipients({
  limit = 50,
  page = 1
})

for _, rcpt in ipairs(result.data or {}) do
  print(rcpt.email .. " - " .. (rcpt.name or ""))
end
```

---

## get_current_user

Verify MailerSend API connectivity and token validity.

### Parameters

None.

### Example

```lua
local result = app.integrations["mailer-send"].get_current_user({})

if result.status == "connected" then
  print("MailerSend API is reachable!")
end
```

---

## Multi-Account Usage

If you have multiple MailerSend accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["mailer-send"].list_messages({})

-- Explicit default (portable across setups)
app.integrations["mailer-send"].default.list_messages({})

-- Named accounts
app.integrations["mailer-send"].production.list_messages({})
app.integrations["mailer-send"].staging.list_messages({})
```

All functions are identical across accounts — only the credentials differ.
