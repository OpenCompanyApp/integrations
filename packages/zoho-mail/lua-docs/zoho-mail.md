# Zoho Mail — Lua API Reference

## get_current_user

Get the current user's account information. Returns account IDs needed for all other operations.

### Parameters

None.

### Example

```lua
local result = app.integrations["zoho-mail"].get_current_user({})

for _, account in ipairs(result.data.accounts) do
  print(account.accountId .. ": " .. account.primaryEmailAddress)
end
```

---

## list_messages

List email messages in a folder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `accountId` | string | yes | Zoho Mail account ID |
| `folderId` | string | no | Folder ID (default: Inbox) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `limit` | integer | no | Max messages to return (default: 20, max: 100) |
| `searchKey` | string | no | Search query to filter messages |

### Example

```lua
local result = app.integrations["zoho-mail"].list_messages({
  accountId = "12345678",
  folderId = "INBOX",
  limit = 10
})

for _, msg in ipairs(result.data.list) do
  print(msg.from .. ": " .. msg.subject)
end
```

### Search messages

```lua
local result = app.integrations["zoho-mail"].list_messages({
  accountId = "12345678",
  searchKey = "project update"
})
```

---

## get_message

Get a single email message by ID with full content.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `accountId` | string | yes | Zoho Mail account ID |
| `messageId` | string | yes | The message ID to retrieve |

### Example

```lua
local result = app.integrations["zoho-mail"].get_message({
  accountId = "12345678",
  messageId = "9807654321"
})

print("From: " .. result.data.from)
print("Subject: " .. result.data.subject)
print("Content: " .. result.data.content)
```

---

## send_message

Send a new email message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `accountId` | string | yes | Account ID to send from |
| `toAddress` | string | yes | Recipient email(s), comma-separated |
| `subject` | string | yes | Email subject line |
| `content` | string | yes | Email body (HTML or plain text) |
| `ccAddress` | string | no | CC recipients, comma-separated |
| `bccAddress` | string | no | BCC recipients, comma-separated |
| `inReplyTo` | string | no | Message ID to reply to (for threading) |
| `mailFormat` | string | no | "html" or "plaintext" (default: "html") |

### Example

```lua
local result = app.integrations["zoho-mail"].send_message({
  accountId = "12345678",
  toAddress = "recipient@example.com",
  subject = "Meeting Follow-up",
  content = "<p>Thanks for the meeting today!</p>"
})
```

### Reply to a message

```lua
local result = app.integrations["zoho-mail"].send_message({
  accountId = "12345678",
  toAddress = "sender@example.com",
  subject = "Re: Project Update",
  content = "<p>Got it, thanks for the update.</p>",
  inReplyTo = "9807654321"
})
```

---

## list_folders

List all email folders in an account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `accountId` | string | yes | Zoho Mail account ID |

### Example

```lua
local result = app.integrations["zoho-mail"].list_folders({
  accountId = "12345678"
})

for _, folder in ipairs(result.data.list) do
  print(folder.folderId .. ": " .. folder.folderName)
end
```

---

## list_tasks

List tasks from Zoho Mail.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `accountId` | string | yes | Zoho Mail account ID |
| `start` | integer | no | Offset for pagination (default: 0) |
| `limit` | integer | no | Max tasks to return (default: 20) |

### Example

```lua
local result = app.integrations["zoho-mail"].list_tasks({
  accountId = "12345678",
  limit = 10
})

for _, task in ipairs(result.data.list) do
  print(task.title .. " - " .. task.status)
end
```

---

## Multi-Account Usage

If you have multiple Zoho Mail accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zoho-mail"].list_messages({accountId = "12345678"})

-- Explicit default (portable across setups)
app.integrations["zoho-mail"].default.list_messages({accountId = "12345678"})

-- Named accounts
app.integrations["zoho-mail"].work.list_messages({accountId = "12345678"})
app.integrations["zoho-mail"].personal.list_messages({accountId = "12345678"})
```

All functions are identical across accounts — only the credentials differ.
