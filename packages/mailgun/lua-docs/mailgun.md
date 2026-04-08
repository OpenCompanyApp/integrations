# Mailgun — Lua API Reference

## list_messages

List message events in your Mailgun domain with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of events to return (default: 300, max: 300) |
| `page` | string | no | Pagination cursor from a previous response |
| `event` | string | no | Filter by event type (e.g., "stored", "delivered", "failed", "rejected") |
| `begin` | string | no | Start of time range in RFC 2822 or epoch format |
| `end` | string | no | End of time range in RFC 2822 or epoch format |
| `ascending` | boolean | no | Sort results in ascending order (default: no / descending) |
| `recipient` | string | no | Filter by recipient email address |
| `subject` | string | no | Filter by email subject |

### Example

```lua
local result = app.integrations.mailgun.list_messages({
  limit = 10,
  event = "delivered"
})

for _, item in ipairs(result.items) do
  print(item.event .. ": " .. item.message.headers.subject)
end
```

---

## send_email

Send an email via Mailgun.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender email address, e.g. `"My App <noreply@example.com>"` |
| `to` | array | yes | Array of recipient email addresses, e.g. `{"user@example.com"}` |
| `subject` | string | yes | The email subject line |
| `text` | string | no | Plain text body of the email (required unless `html` provided) |
| `html` | string | no | HTML body of the email (required unless `text` provided) |
| `cc` | array | no | Array of CC recipient email addresses |
| `bcc` | array | no | Array of BCC recipient email addresses |
| `tag` | array | no | Array of tag strings for categorization |
| `reply_to` | string | no | Reply-to email address |

### Example

```lua
local result = app.integrations.mailgun.send_email({
  from = "My App <noreply@example.com>",
  to = { "user@example.com" },
  subject = "Welcome!",
  html = "<h1>Hello!</h1><p>Welcome to our service.</p>",
  text = "Hello! Welcome to our service."
})

print("Message ID: " .. result.id)
print("Queued: " .. tostring(result.message))
```

---

## list_domains

List all domains in your Mailgun account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of domains to return (default: 100, max: 1000) |
| `skip` | integer | no | Number of domains to skip for pagination |

### Example

```lua
local result = app.integrations.mailgun.list_domains({
  limit = 20
})

for _, domain in ipairs(result.items) do
  print(domain.name .. " (state: " .. domain.state .. ")")
end
```

---

## get_domain

Get details and DNS records for a specific domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | no | The domain name to retrieve. Defaults to the configured sending domain. |

### Example

```lua
local result = app.integrations.mailgun.get_domain({
  domain = "mg.example.com"
})

print("Domain: " .. result.domain.name)
print("State: " .. result.domain.state)

for _, record in ipairs(result.sending_dns_records) do
  print(record.record_type .. ": " .. record.value)
end
```

---

## list_routes

List all routes in your Mailgun account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of routes to return (default: 100, max: 1000) |
| `skip` | integer | no | Number of routes to skip for pagination |

### Example

```lua
local result = app.integrations.mailgun.list_routes({
  limit = 20
})

for _, route in ipairs(result.items) do
  print(route.id .. ": " .. route.expression .. " -> " .. route.description)
end
```

---

## list_webhooks

List all webhooks configured for a domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | no | The domain name. Defaults to the configured sending domain. |

### Example

```lua
local result = app.integrations.mailgun.list_webhooks()

for event, urls in pairs(result.webhooks) do
  print(event .. ": " .. urls.url)
end
```

---

## get_current_user

Verify the Mailgun API connection and retrieve basic account info by listing domains.

### Parameters

None.

### Example

```lua
local result = app.integrations.mailgun.get_current_user()

print("Total domains: " .. result.total_count)

for _, domain in ipairs(result.items) do
  print(domain.name .. " - " .. domain.state)
end
```

---

## Multi-Account Usage

If you have multiple Mailgun accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mailgun.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mailgun.default.function_name({...})

-- Named accounts
app.integrations.mailgun.work.function_name({...})
app.integrations.mailgun.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
