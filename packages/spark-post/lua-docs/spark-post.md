# SparkPost — Lua API Reference

## list_sending_domains

List sending domains configured in SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of domains to return (default: 100) |

### Example

```lua
local result = app.integrations["spark-post"].list_sending_domains({
  limit = 50
})

for _, domain in ipairs(result.results) do
  print(domain.domain .. " — verified: " .. tostring(domain.status.verified))
end
```

---

## get_sending_domain

Get details for a specific sending domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain name (e.g., `"example.com"`) |

### Example

```lua
local result = app.integrations["spark-post"].get_sending_domain({
  domain = "example.com"
})

print(result.results.domain)
print("DKIM verified: " .. tostring(result.results.status.dkim_status))
```

---

## list_templates

List email templates in SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of templates to return (default: 100) |
| `offset` | integer | no | Number of templates to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations["spark-post"].list_templates({
  limit = 20,
  offset = 0
})

for _, tpl in ipairs(result.results) do
  print(tpl.id .. ": " .. (tpl.name or "unnamed"))
end
```

---

## get_template

Get a specific email template by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The template ID |
| `draft` | boolean | no | Set to `true` to retrieve the draft version (default: `false`) |

### Example

```lua
local result = app.integrations["spark-post"].get_template({
  id = "my-template-id",
  draft = false
})

print(result.results.name)
print("Subject: " .. result.results.content.subject)
```

---

## send_transmission

Send an email transmission via SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content` | object | yes | Email content with `from`, `subject`, and optional `html`/`text` |
| `recipients` | array | yes | Array of recipient objects, each with `address.email` |

### Content Object

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `from` | string or object | yes | Sender email address (string) or object with `email` and `name` |
| `subject` | string | yes | Email subject line |
| `html` | string | no | HTML body content |
| `text` | string | no | Plain text body content |

### Recipient Format

Each recipient is an object with an `address` field:

```lua
{ address = { email = "user@example.com", name = "User Name" } }
```

### Example — Simple email

```lua
local result = app.integrations["spark-post"].send_transmission({
  content = {
    from = "noreply@example.com",
    subject = "Hello from SparkPost",
    html = "<h1>Welcome!</h1><p>This is a test email.</p>",
    text = "Welcome! This is a test email."
  },
  recipients = {
    { address = { email = "alice@example.com" } },
    { address = { email = "bob@example.com", name = "Bob" } }
  }
})

print("Accepted: " .. result.results.total_accepted_recipients)
print("Rejected: " .. result.results.total_rejected_recipients)
```

### Example — Named sender

```lua
local result = app.integrations["spark-post"].send_transmission({
  content = {
    from = { email = "team@example.com", name = "Team Example" },
    subject = "Monthly Newsletter",
    html = "<p>Here is your newsletter.</p>"
  },
  recipients = {
    { address = { email = "subscriber@example.com" } }
  }
})
```

---

## list_webhooks

List webhooks configured in SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of webhooks to return (default: 100) |
| `offset` | integer | no | Number of webhooks to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations["spark-post"].list_webhooks({
  limit = 50
})

for _, hook in ipairs(result.results) do
  print(hook.id .. " → " .. hook.target .. " (" .. #hook.events .. " events)")
end
```

---

## get_current_user

Get the current SparkPost account information.

### Parameters

None.

### Example

```lua
local result = app.integrations["spark-post"].get_current_user({})

print("Account: " .. result.results.company_name)
print("Status: " .. result.results.status)
```

---

## Multi-Account Usage

If you have multiple SparkPost accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["spark-post"].list_sending_domains({})

-- Explicit default (portable across setups)
app.integrations["spark-post"].default.list_sending_domains({})

-- Named accounts
app.integrations["spark-post"].production.list_sending_domains({})
app.integrations["spark-post"].staging.list_sending_domains({})
```

All functions are identical across accounts — only the credentials differ.
