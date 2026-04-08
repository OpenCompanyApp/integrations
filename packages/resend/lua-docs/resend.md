# Resend — Lua API Reference

## resend_send_email

Send an email via Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient email address. |
| `from` | string | yes | Sender email address (must be a verified domain). |
| `subject` | string | yes | Email subject line. |
| `html` | string | no | HTML body content. |
| `text` | string | no | Plain-text body content. |
| `cc` | array | no | CC recipient email addresses. |
| `bcc` | array | no | BCC recipient email addresses. |
| `reply_to` | array | no | Reply-to email addresses. |
| `tags` | array | no | Tags to attach to the email. Each item should have `"name"` and `"value"` keys. |
| `headers` | object | no | Custom email headers (key-value pairs). |

## resend_get_email

Retrieve a single email by ID from Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email_id` | string | yes | The ID of the email to retrieve. |

## resend_list_emails

List emails from Resend with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of emails to return (default 100, max 100). |
| `token` | string | no | Cursor token for pagination — use the token from the previous response to get the next page. |

## resend_create_api_key

Create a new API key in Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | A descriptive name for the API key. |
| `permission` | string | no | Permission scope: `"full_access"` or `"sending_access"`. |
| `domain_id` | string | no | Domain ID to restrict the key to (only for `sending_access`). |

## resend_list_api_keys

List all API keys in Resend.

### Parameters

*No parameters required.*

## resend_create_domain

Create a new domain in Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Domain name (e.g. `"example.com"`). |
| `region` | string | no | Region for the domain: `"us-east-1"` or `"eu-west-1"`. |

## resend_get_domain

Retrieve a single domain by ID from Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | string | yes | The ID of the domain to retrieve. |

## resend_list_domains

List all domains in Resend.

### Parameters

*No parameters required.*

## resend_verify_domain

Trigger domain verification in Resend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | string | yes | The ID of the domain to verify. |

## resend_create_contact

Create a contact in a Resend audience.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `audience_id` | string | yes | The audience ID to add the contact to. |
| `email` | string | yes | Contact email address. |
| `first_name` | string | no | Contact first name. |
| `last_name` | string | no | Contact last name. |
| `unsubscribed` | boolean | no | Whether the contact is unsubscribed (default false). |

## Examples

### Send an email

```lua
local result = app.integrations.resend.resend_send_email({
  to = "recipient@example.com",
  from = "noreply@myapp.com",
  subject = "Welcome to MyApp",
  html = "<h1>Hello!</h1><p>Welcome aboard.</p>",
  tags = {
    { name = "category", value = "welcome" }
  }
})
print("Email ID: " .. result.id)
```

### Send a plain-text email with CC

```lua
local result = app.integrations.resend.resend_send_email({
  to = "alice@example.com",
  from = "noreply@myapp.com",
  subject = "Meeting Notes",
  text = "Hi Alice,\n\nHere are the meeting notes from today...",
  cc = { "bob@example.com" }
})
```

### Create and verify a domain

```lua
local domain = app.integrations.resend.resend_create_domain({
  name = "myapp.com",
  region = "us-east-1"
})

-- After adding DNS records...
local result = app.integrations.resend.resend_verify_domain({
  domain_id = domain.id
})
```

### Create a contact

```lua
local result = app.integrations.resend.resend_create_contact({
  audience_id = "aud_abc123",
  email = "newuser@example.com",
  first_name = "Jane",
  last_name = "Doe"
})
```

---

## Multi-Account Usage

If you have multiple resend accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.resend.function_name({...})

-- Explicit default (portable across setups)
app.integrations.resend.default.function_name({...})

-- Named accounts
app.integrations.resend.work.function_name({...})
app.integrations.resend.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
