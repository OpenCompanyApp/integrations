# Sendy — Lua API Reference

## subscribe

Subscribe an email address to a Sendy mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list` | string | yes | The list ID to subscribe to |
| `email` | string | yes | The subscriber's email address |
| `name` | string | no | The subscriber's name |

### Response

On success, returns `{ list, email, message }`. Common messages include `"Subscribed successfully."` and `"Already subscribed."`.

### Examples

```lua
local result = app.integrations.sendy.subscribe({
  list = "abc123",
  email = "user@example.com",
  name = "John Doe"
})

print(result.message)
```

---

## unsubscribe

Unsubscribe an email address from a Sendy mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list` | string | yes | The list ID to unsubscribe from |
| `email` | string | yes | The subscriber's email address |

### Examples

```lua
local result = app.integrations.sendy.unsubscribe({
  list = "abc123",
  email = "user@example.com"
})

print(result.message)
```

---

## list_subscribers

Get the total subscriber count for a Sendy list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The list ID to query |

### Examples

```lua
local result = app.integrations.sendy.list_subscribers({
  list_id = "abc123"
})

print("Subscribers: " .. result.subscribers)
```

---

## create_campaign

Create a new email campaign in Sendy. Can be saved as a draft or sent immediately.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_name` | string | yes | Sender name |
| `from_email` | string | yes | Sender email address |
| `reply_to` | string | yes | Reply-to email address |
| `title` | string | yes | Internal campaign title (for reference) |
| `subject` | string | yes | Email subject line |
| `html_text` | string | yes | HTML content of the email |
| `list_ids` | string | yes | Comma-separated list IDs to send to |
| `plain_text` | string | no | Plain text version (auto-generated if omitted) |
| `send_campaign` | integer | no | `1` to send immediately, `0` or omit to save as draft |
| `brand_id` | string | no | Brand ID (required for multi-brand setups) |
| `query_string` | string | no | UTM query string appended to links |

### Examples

#### Save as draft

```lua
local result = app.integrations.sendy.create_campaign({
  from_name = "Acme Corp",
  from_email = "hello@acme.com",
  reply_to = "hello@acme.com",
  title = "April Newsletter",
  subject = "What's new at Acme",
  html_text = "<h1>Hello!</h1><p>Here's what's new...</p>",
  list_ids = "abc123,def456"
})

print("Campaign created: " .. (result.campaign_id or "draft"))
```

#### Send immediately

```lua
local result = app.integrations.sendy.create_campaign({
  from_name = "Acme Corp",
  from_email = "hello@acme.com",
  reply_to = "hello@acme.com",
  title = "Flash Sale!",
  subject = "50% off — today only",
  html_text = "<h1>Flash Sale!</h1><p>Get 50% off everything...</p>",
  list_ids = "abc123",
  send_campaign = 1
})

print(result.message)
```

---

## get_current_user

Get the current brand/account information from Sendy. Useful for verifying credentials.

### Parameters

None.

### Examples

```lua
local result = app.integrations.sendy.get_current_user({})

print("Brand: " .. (result.message or "verified"))
```

---

## Multi-Account Usage

If you have multiple Sendy instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.sendy.subscribe({...})

-- Explicit default (portable across setups)
app.integrations.sendy.default.subscribe({...})

-- Named accounts
app.integrations.sendy.marketing.subscribe({...})
app.integrations.sendy.internal.subscribe({...})
```

All functions are identical across accounts — only the credentials differ.
