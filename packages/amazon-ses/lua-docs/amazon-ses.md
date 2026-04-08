# Amazon SES — Lua API Reference

## send_email

Send an email via Amazon SES. Supports simple emails and template-based emails.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_email_address` | string | yes | Sender email address (must be verified in SES) |
| `destination` | object | yes | Recipient addresses: `{ ToAddresses: {}, CcAddresses: {}, BccAddresses: {} }` |
| `subject` | string | no* | Email subject line. Required unless using a template. |
| `html_body` | string | no | HTML content of the email body |
| `text_body` | string | no | Plain text content of the email body |
| `template_name` | string | no* | SES template name. If provided, subject/html_body/text_body are ignored. |
| `template_data` | object | no | Key-value pairs for template variable substitution |
| `reply_to_addresses` | array | no | Reply-to email addresses |
| `configuration_set_name` | string | no | SES configuration set for tracking and analytics |

\* Either `subject` or `template_name` must be provided.

### Examples

#### Send a simple email

```lua
local result = app.integrations["amazon-ses"].send_email({
  from_email_address = "hello@example.com",
  destination = {
    ToAddresses = { "user@example.com" }
  },
  subject = "Welcome!",
  html_body = "<h1>Welcome to our service</h1><p>Thanks for signing up!</p>",
  text_body = "Welcome to our service. Thanks for signing up!"
})

print("Message ID: " .. result.message_id)
```

#### Send a template-based email

```lua
local result = app.integrations["amazon-ses"].send_email({
  from_email_address = "hello@example.com",
  destination = {
    ToAddresses = { "user@example.com" }
  },
  template_name = "welcome-email",
  template_data = { name = "John", company = "Acme" }
})

print("Message ID: " .. result.message_id)
```

---

## get_template

Retrieve an email template by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The template name |

### Example

```lua
local result = app.integrations["amazon-ses"].get_template({
  name = "welcome-email"
})

print("Subject: " .. result.TemplateContent.Subject)
print("HTML: " .. result.TemplateContent.Html)
```

---

## list_templates

List all email templates in Amazon SES.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Max templates per page (default: 10, max: 100) |
| `next_token` | string | no | Pagination token from a previous response |

### Example

```lua
local result = app.integrations["amazon-ses"].list_templates({
  page_size = 20
})

for _, tmpl in ipairs(result.TemplatesMetadata) do
  print(tmpl.TemplateName .. " (created: " .. tmpl.CreatedTimestamp .. ")")
end
```

---

## create_template

Create a new email template with optional substitution variables.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_name` | string | yes | Unique name for the template |
| `subject` | string | yes | Subject line (supports `{{variable}}` syntax) |
| `html_content` | string | no | HTML body (supports `{{variable}}` syntax) |
| `text_content` | string | no | Plain text body (supports `{{variable}}` syntax) |

### Example

```lua
local result = app.integrations["amazon-ses"].create_template({
  template_name = "order-confirmation",
  subject = "Your order #{{order_id}} is confirmed",
  html_content = "<h1>Hi {{name}}</h1><p>Order #{{order_id}} confirmed.</p>",
  text_content = "Hi {{name}}, Order #{{order_id}} confirmed."
})

print(result.message)
```

---

## list_suppressions

List email addresses on the suppression list for a configuration set.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `configuration_set` | string | yes | Configuration set name |
| `page_size` | integer | no | Max results per page |
| `next_token` | string | no | Pagination token from a previous response |

### Example

```lua
local result = app.integrations["amazon-ses"].list_suppressions({
  configuration_set = "my-config-set",
  page_size = 50
})

for _, sup in ipairs(result.SuppressionSummaries) do
  print(sup.EmailAddress .. " — reason: " .. sup.Reason)
end
```

---

## get_current_user

Get the currently authenticated user. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations["amazon-ses"].get_current_user({})

print("User: " .. (result.username or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Amazon SES accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["amazon-ses"].send_email({...})

-- Explicit default (portable across setups)
app.integrations["amazon-ses"].default.send_email({...})

-- Named accounts
app.integrations["amazon-ses"].production.send_email({...})
app.integrations["amazon-ses"].marketing.send_email({...})
```

All functions are identical across accounts — only the credentials differ.
