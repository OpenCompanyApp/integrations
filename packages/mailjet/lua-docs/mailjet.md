# Mailjet — Lua API Reference

## send_email

Send an email via Mailjet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_email` | string | yes | Sender email address (must be verified in Mailjet) |
| `from_name` | string | no | Sender display name |
| `to_email` | string | yes* | Recipient email address (use `to_emails` for multiple) |
| `to_emails` | array | yes* | Array of recipient email addresses |
| `subject` | string | yes | Email subject line |
| `html` | string | no | HTML body of the email |
| `text` | string | no | Plain-text body of the email |

\* Use either `to_email` (single) or `to_emails` (multiple), not both.

### Examples

```lua
-- Send a simple email
local result = app.integrations.mailjet.send_email({
  from_email = "hello@example.com",
  from_name = "Acme Inc",
  to_email = "customer@example.org",
  subject = "Welcome!",
  html = "<h1>Welcome to Acme</h1><p>Thanks for signing up!</p>"
})

-- Send to multiple recipients
local result = app.integrations.mailjet.send_email({
  from_email = "news@example.com",
  to_emails = {"alice@example.org", "bob@example.org"},
  subject = "Monthly newsletter",
  html = "<p>Here is your monthly update.</p>"
})
```

---

## list_contacts

List contacts in the Mailjet account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max contacts to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
local result = app.integrations.mailjet.list_contacts({
  limit = 50,
  offset = 0
})

for _, contact in ipairs(result.Data) do
  print(contact.Email)
end
```

---

## get_contact

Get details for a single contact by ID or email.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Contact ID or email address |

### Examples

```lua
local result = app.integrations.mailjet.get_contact({
  id = "user@example.com"
})
print(result.Data[1].Email)
```

---

## create_contact

Create a new contact in Mailjet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address of the new contact |

### Examples

```lua
local result = app.integrations.mailjet.create_contact({
  email = "newuser@example.com"
})
print("Created contact: " .. result.Data[1].Email)
```

---

## list_campaigns

List email campaigns in the Mailjet account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max campaigns to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
local result = app.integrations.mailjet.list_campaigns({
  limit = 20
})

for _, campaign in ipairs(result.Data) do
  print(campaign.ID .. ": " .. campaign.Subject)
end
```

---

## get_campaign

Get details for a single campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Campaign ID |

### Examples

```lua
local result = app.integrations.mailjet.get_campaign({
  id = "12345"
})
print(result.Data[1].Subject)
```

---

## list_templates

List email templates available in the Mailjet account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max templates to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
local result = app.integrations.mailjet.list_templates({})

for _, tpl in ipairs(result.Data) do
  print(tpl.ID .. ": " .. tpl.Name)
end
```

---

## get_stats

Get email statistics from the Mailjet statcounters endpoint.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_ts` | string | no | Start timestamp (ISO 8601 or Unix epoch) |
| `to_ts` | string | no | End timestamp (ISO 8601 or Unix epoch) |
| `limit` | integer | no | Max stat records to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Examples

```lua
local result = app.integrations.mailjet.get_stats({
  from_ts = "2026-01-01T00:00:00Z",
  to_ts = "2026-01-31T23:59:59Z"
})

for _, stat in ipairs(result.Data) do
  print("Sent: " .. stat.MessageSentCount .. ", Opened: " .. stat.MessageOpenedCount)
end
```

---

## get_current_user

Get the authenticated Mailjet user profile information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.mailjet.get_current_user({})
print(result.Data[1].Email)
```

---

## Multi-Account Usage

If you have multiple Mailjet accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mailjet.send_email({...})

-- Explicit default (portable across setups)
app.integrations.mailjet.default.send_email({...})

-- Named accounts
app.integrations.mailjet.marketing.send_email({...})
app.integrations.mailjet.transactional.send_email({...})
```

All functions are identical across accounts — only the credentials differ.
