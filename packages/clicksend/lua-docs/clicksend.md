# Client for the ClickSend REST API — Lua API Reference

## clicksend_get_account_balance

Get the current ClickSend account balance..

### Example

```lua
local result = app.integrations.clicksend.clicksend_get_account_balance({
})
```

## clicksend_get_email_history

Get email message history from ClickSend with pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of records per page (default 15). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.clicksend.clicksend_get_email_history({
  limit = 0
  page = 0
})
```

## clicksend_get_sms_history

Get SMS message history from ClickSend. Supports date range filtering and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date_from` | string | no | Start date for history (YYYY-MM-DD or Unix timestamp). |
| `date_to` | string | no | End date for history (YYYY-MM-DD or Unix timestamp). |
| `limit` | integer | no | Number of records per page (default 15). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.clicksend.clicksend_get_sms_history({
  date_from = ""
  date_to = ""
  limit = 0
})
```

## clicksend_get_sms_price

Get pricing for SMS messages before sending. Uses the same message format as send SMS but returns cost estimates only..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | yes | Array of message objects. Each object must have  |

### Example

```lua
local result = app.integrations.clicksend.clicksend_get_sms_price({
  messages = {}
})
```

## clicksend_get_voice_history

Get voice message history from ClickSend with pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of records per page (default 15). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.clicksend.clicksend_get_voice_history({
  limit = 0
  page = 0
})
```

## clicksend_list_contact_lists

List all contact lists from ClickSend with pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of records per page (default 15). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.clicksend.clicksend_list_contact_lists({
  limit = 0
  page = 0
})
```

## clicksend_send_email

Send an email message via ClickSend. Requires recipient, subject, and body..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient email address. |
| `subject` | string | yes | Email subject line. |
| `body` | string | yes | Email body content (HTML supported). |
| `from_email_address` | string | no | Sender email address. |
| `from_name` | string | no | Sender display name. |

### Example

```lua
local result = app.integrations.clicksend.clicksend_send_email({
  to = ""
  subject = ""
  body = ""
})
```

## clicksend_send_post_letter

Send a post letter via ClickSend. Provide a file URL or template ID with recipient details..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_url` | string | no | URL to the PDF file to send as a letter. |
| `template_id` | integer | no | ClickSend template ID to use instead of a file URL. |
| `recipients` | array | yes | Array of recipient objects with name, address, city, state, postal_code, country. |
| `duplex` | integer | no | Print on both sides: 0 for simplex, 1 for duplex (default 0). |

### Example

```lua
local result = app.integrations.clicksend.clicksend_send_post_letter({
  file_url = ""
  template_id = 0
  recipients = {}
})
```

## clicksend_send_sms

Send one or more SMS messages via ClickSend. Each message requires a.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | yes | Array of message objects. Each object must have  |

### Example

```lua
local result = app.integrations.clicksend.clicksend_send_sms({
  messages = {}
})
```

## clicksend_send_voice

Send one or more voice messages via ClickSend. Each message requires a.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | yes | Array of voice message objects. Each object must have  |

### Example

```lua
local result = app.integrations.clicksend.clicksend_send_voice({
  messages = {}
})
```

---

## Multi-Account Usage

If you have multiple clicksend accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.clicksend.function_name({...})

-- Explicit default (portable across setups)
app.integrations.clicksend.default.function_name({...})

-- Named accounts
app.integrations.clicksend.work.function_name({...})
app.integrations.clicksend.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
