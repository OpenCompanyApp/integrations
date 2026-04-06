# Postmark — Lua API Reference

## send_email

Send an email through Postmark.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `From` | string | yes | Sender email address (must be verified) |
| `To` | string | yes | Recipient email (comma-separated for multiple) |
| `Subject` | string | yes | Email subject line |
| `HtmlBody` | string | no* | HTML email body |
| `TextBody` | string | no* | Plain text email body |
| `Tag` | string | no | Tag for categorization (e.g., "welcome") |
| `Cc` | string | no | CC recipients (comma-separated) |
| `Bcc` | string | no | BCC recipients (comma-separated) |
| `ReplyTo` | string | no | Reply-to email address |
| `TrackOpens` | boolean | no | Enable open tracking |
| `TrackLinks` | string | no | Link tracking: "None", "HtmlAndText", "HtmlOnly", "TextOnly" |

*At least one of `HtmlBody` or `TextBody` is required.

### Example

```lua
local result = app.integrations.postmark.send_email({
  From = "hello@example.com",
  To = "john@example.com",
  Subject = "Welcome!",
  HtmlBody = "<h1>Welcome, John!</h1><p>Thanks for signing up.</p>",
  TextBody = "Welcome, John!\n\nThanks for signing up.",
  Tag = "welcome"
})

print("Message ID: " .. result.message_id)
print("Submitted at: " .. result.submitted_at)
```

---

## send_template

Send an email using a Postmark template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `From` | string | yes | Sender email address |
| `To` | string | yes | Recipient email |
| `TemplateId` | integer | no* | Template ID (use this or TemplateAlias) |
| `TemplateAlias` | string | no* | Template alias (use this or TemplateId) |
| `TemplateModel` | array | no | Key-value pairs for template variables |
| `Tag` | string | no | Tag for categorization |
| `Cc` | string | no | CC recipients |
| `Bcc` | string | no | BCC recipients |
| `ReplyTo` | string | no | Reply-to email |
| `TrackOpens` | boolean | no | Enable open tracking |
| `TrackLinks` | string | no | Link tracking mode |

*Either `TemplateId` or `TemplateAlias` is required.

### Example

```lua
local result = app.integrations.postmark.send_template({
  From = "hello@example.com",
  To = "john@example.com",
  TemplateAlias = "welcome-email",
  TemplateModel = {
    name = "John",
    company = "Acme Corp"
  },
  Tag = "welcome"
})

print("Message ID: " .. result.message_id)
```

---

## get_delivery_stats

Get email delivery statistics for the server.

### Parameters

None.

### Example

```lua
local result = app.integrations.postmark.get_delivery_stats()

print("Sent: " .. result.Sent)
print("Bounced: " .. result.Bounced)
print("Spam complaints: " .. result.SpamComplaint)
```

---

## list_messages

List outbound email messages with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of messages (default: 100, max: 500) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `recipient` | string | no | Filter by recipient email |
| `status` | string | no | Filter by status: "queued", "sent", "delivered", "bounced", etc. |

### Example

```lua
local result = app.integrations.postmark.list_messages({
  count = 25,
  status = "sent"
})

for _, msg in ipairs(result.Messages) do
  print(msg.To .. " - " .. msg.Subject .. " (" .. msg.Status .. ")")
end
```

### Filter by recipient

```lua
local result = app.integrations.postmark.list_messages({
  recipient = "john@example.com",
  count = 10
})
```

---

## get_message

Get details of a specific outbound message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The message ID |

### Example

```lua
local result = app.integrations.postmark.get_message({
  id = "0a1296ee-8a12-4c4e-8b0c-3abcd1234567"
})

print("Subject: " .. result.Subject)
print("Status: " .. result.Status)
print("To: " .. result.To[1].Email)
```

---

## list_templates

List email templates available in the server.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of templates (default: 100, max: 500) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.postmark.list_templates()

for _, tpl in ipairs(result.Templates) do
  print(tpl.Name .. " (Alias: " .. (tpl.Alias or "N/A") .. ", ID: " .. tpl.TemplateId .. ")")
end
```

---

## get_current_user

Get Postmark server information.

### Parameters

None.

### Example

```lua
local result = app.integrations.postmark.get_current_user()

print("Server: " .. result.Name)
print("ID: " .. result.ID)
print("Color: " .. result.Color)
```

---

## Multi-Account Usage

If you have multiple Postmark accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.postmark.send_email({...})

-- Explicit default (portable across setups)
app.integrations.postmark.default.send_email({...})

-- Named accounts
app.integrations.postmark.transactional.send_email({...})
app.integrations.postmark.marketing.send_email({...})
```

All functions are identical across accounts — only the credentials differ.
