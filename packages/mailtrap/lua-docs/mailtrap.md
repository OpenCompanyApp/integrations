# Mailtrap — Lua API Reference

## list_inboxes

List all inboxes in the Mailtrap account. Returns inbox IDs, names, and email addresses.

### Parameters

None.

### Examples

```lua
local inboxes = app.integrations.mailtrap.list_inboxes()

for _, inbox in ipairs(inboxes) do
  print(inbox.name .. " — " .. inbox.email .. " (ID: " .. inbox.id .. ")")
end
```

---

## get_inbox

Get details for a specific Mailtrap inbox by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |

### Examples

```lua
local inbox = app.integrations.mailtrap.get_inbox({
  inbox_id = 12345
})

print("Inbox: " .. inbox.name)
print("Email: " .. inbox.email)
print("Messages: " .. (inbox.messages_count or 0))
```

---

## list_messages

List messages in a Mailtrap inbox with optional search and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID to list messages from. |
| `page` | integer | no | Page number for pagination (1-based). |
| `per_page` | integer | no | Number of messages per page (default: 25). |
| `search` | string | no | Search query to filter messages by subject, from, or to. |

### Examples

```lua
local result = app.integrations.mailtrap.list_messages({
  inbox_id = 12345,
  per_page = 10
})

for _, msg in ipairs(result) do
  print(msg.subject .. " from " .. msg.from_email)
end
```

```lua
-- Search messages
local result = app.integrations.mailtrap.list_messages({
  inbox_id = 12345,
  search = "welcome"
})
```

---

## get_message

Get a single message from a Mailtrap inbox by its ID, including subject, sender, recipient, and body.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |
| `message_id` | integer | yes | The message ID. |

### Examples

```lua
local msg = app.integrations.mailtrap.get_message({
  inbox_id = 12345,
  message_id = 67890
})

print("Subject: " .. msg.subject)
print("From: " .. msg.from_email)
print("To: " .. msg.to_email)
print("HTML body length: " .. #(msg.html_body or ""))
```

---

## send_test_email

Send a test email through Mailtrap. Provide sender, recipient(s), subject, and either text or HTML body.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | object | yes | Sender object with `email` and optionally `name`. |
| `to` | array | yes | Array of recipient objects, each with `email` and optionally `name`. |
| `subject` | string | yes | Email subject line. |
| `text` | string | no | Plain text email body. |
| `html` | string | no | HTML email body. |
| `inbox_id` | integer | no | Inbox ID to send from (required for Testing inbox type). |

### Examples

```lua
local result = app.integrations.mailtrap.send_test_email({
  from = { email = "sender@example.com", name = "Sender" },
  to = { { email = "recipient@example.com", name = "Recipient" } },
  subject = "Test Email",
  text = "This is a test email sent via Mailtrap.",
  html = "<h1>Test</h1><p>This is a test email sent via Mailtrap.</p>"
})

print("Email sent successfully")
```

---

## list_suppressions

List suppressions (blocked recipients) for a Mailtrap inbox.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |
| `page` | integer | no | Page number for pagination (1-based). |
| `per_page` | integer | no | Number of results per page. |

### Examples

```lua
local result = app.integrations.mailtrap.list_suppressions({
  inbox_id = 12345
})

for _, sup in ipairs(result) do
  print("Suppressed: " .. sup.email .. " — " .. (sup.reason or "unknown"))
end
```

---

## get_current_user

Get the current Mailtrap user profile and account info. Useful as a health check.

### Parameters

None.

### Examples

```lua
local user = app.integrations.mailtrap.get_current_user()

print("Logged in as: " .. user.email)
print("Account: " .. (user.company or "personal"))
```

---

## Multi-Account Usage

If you have multiple mailtrap accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mailtrap.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mailtrap.default.function_name({...})

-- Named accounts
app.integrations.mailtrap.testing.function_name({...})
app.integrations.mailtrap.production.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
