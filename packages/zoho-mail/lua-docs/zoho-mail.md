# Zoho Mail Lua API Reference

Namespace: `app.integrations["zoho-mail"]`

Configure a Zoho OAuth `access_token` and the regional Mail API base URL. The
default is `https://mail.zoho.com/api`; use the matching regional host such as
`https://mail.zoho.eu/api` when required.

## Accounts

```lua
local accounts = app.integrations["zoho-mail"].get_current_user({})
local account = app.integrations["zoho-mail"].get_account({
  accountId = "12345678"
})
```

The returned account IDs are required for every mailbox operation.

## Messages

List or search messages:

```lua
local page = app.integrations["zoho-mail"].list_messages({
  accountId = "12345678",
  folderId = "987654",
  start = 0,
  limit = 50
})

local search = app.integrations["zoho-mail"].search_messages({
  accountId = "12345678",
  params = {
    searchKey = "from:billing@example.test",
    limit = 20
  }
})
```

Read content, metadata, headers, and original MIME:

```lua
local body = app.integrations["zoho-mail"].get_message({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555",
  includeBlockContent = false
})

local details = app.integrations["zoho-mail"].get_message_details({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555"
})

local headers = app.integrations["zoho-mail"].get_message_headers({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555"
})

local original = app.integrations["zoho-mail"].get_original_message({
  accountId = "12345678",
  messageId = "555555"
})
```

Send, reply, update, or delete:

```lua
app.integrations["zoho-mail"].send_message({
  accountId = "12345678",
  toAddress = "recipient@example.test",
  subject = "Status update",
  content = "<p>All set.</p>",
  mailFormat = "html"
})

app.integrations["zoho-mail"].reply_message({
  accountId = "12345678",
  messageId = "555555",
  payload = {
    toAddress = "sender@example.test",
    content = "<p>Thanks.</p>"
  }
})

app.integrations["zoho-mail"].update_messages({
  accountId = "12345678",
  payload = {
    mode = "markAsRead",
    messageId = { "555555" }
  }
})

app.integrations["zoho-mail"].delete_message({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555"
})
```

## Attachments

```lua
local info = app.integrations["zoho-mail"].get_attachment_info({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555"
})

local attachment = app.integrations["zoho-mail"].get_attachment_content({
  accountId = "12345678",
  folderId = "987654",
  messageId = "555555",
  attachmentId = "att-123"
})
```

## Folders

```lua
local folders = app.integrations["zoho-mail"].list_folders({
  accountId = "12345678"
})

local folder = app.integrations["zoho-mail"].get_folder({
  accountId = "12345678",
  folderId = "987654"
})

app.integrations["zoho-mail"].create_folder({
  accountId = "12345678",
  payload = { folderName = "Invoices" }
})

app.integrations["zoho-mail"].update_folder({
  accountId = "12345678",
  folderId = "987654",
  payload = { mode = "renameFolder", folderName = "Receipts" }
})
```

## Labels

```lua
local labels = app.integrations["zoho-mail"].list_labels({
  accountId = "12345678"
})

app.integrations["zoho-mail"].create_label({
  accountId = "12345678",
  payload = { labelName = "Follow up", color = "#3366cc" }
})
```

## Tasks

```lua
local tasks = app.integrations["zoho-mail"].list_tasks({
  accountId = "12345678",
  limit = 20
})
```

## Raw API Helpers

Use raw helpers for documented Zoho Mail endpoints that do not yet have a named
tool. Paths must be relative; full URLs and parent-directory segments are
rejected.

```lua
local raw = app.integrations["zoho-mail"].api_get({
  path = "/accounts/12345678/folders"
})

local posted = app.integrations["zoho-mail"].api_post({
  path = "/accounts/12345678/labels",
  payload = { labelName = "Review" }
})
```

## Multi-Account Usage

```lua
app.integrations["zoho-mail"].list_messages({ accountId = "12345678" })
app.integrations["zoho-mail"].work.list_messages({ accountId = "12345678" })
```
