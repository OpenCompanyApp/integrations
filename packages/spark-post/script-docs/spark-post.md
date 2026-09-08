# SparkPost — Ruby API Reference

## list_sending_domains

List sending domains configured in SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of domains to return (default: 100) |

### Example

```ruby
result = app.call("integrations.spark-post.list_sending_domains", limit: 50)
result.results.each do |domain|
  puts((domain.domain).to_s + " — verified: " + ((domain.status.verified).to_s).to_s)
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

```ruby
result = app.call("integrations.spark-post.get_sending_domain", domain: "example.com")
puts(result.results.domain)
puts("DKIM verified: " + ((result.results.status.dkim_status).to_s).to_s)
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

```ruby
result = app.call("integrations.spark-post.list_templates", limit: 20, offset: 0)
result.results.each do |tpl|
  puts((tpl.id).to_s + ": " + ((tpl.name || "unnamed")).to_s)
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

```ruby
result = app.call("integrations.spark-post.get_template", id: "my-template-id", draft: false)
puts(result.results.name)
puts("Subject: " + (result.results.content.subject).to_s)
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

```ruby
example = {address: {email: "user@example.com", name: "User Name"}}
```
### Example — Simple email

```ruby
result = app.call("integrations.spark-post.send_transmission", content: {from: "noreply@example.com", subject: "Hello from SparkPost", html: "<h1>Welcome!</h1><p>This is a test email.</p>", text: "Welcome! This is a test email."}, recipients: [{address: {email: "alice@example.com"}}, {address: {email: "bob@example.com", name: "Bob"}}])
puts("Accepted: " + (result.results.total_accepted_recipients).to_s)
puts("Rejected: " + (result.results.total_rejected_recipients).to_s)
```
### Example — Named sender

```ruby
result = app.call("integrations.spark-post.send_transmission", content: {from: {email: "team@example.com", name: "Team Example"}, subject: "Monthly Newsletter", html: "<p>Here is your newsletter.</p>"}, recipients: [{address: {email: "subscriber@example.com"}}])
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

```ruby
result = app.call("integrations.spark-post.list_webhooks", limit: 50)
result.results.each do |hook|
  puts((hook.id).to_s + " → " + (hook.target).to_s + " (" + (hook.events.length).to_s + " events)")
end
```
---

## get_current_user

Get the current SparkPost account information.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.spark-post.get_current_user")
puts("Account: " + (result.results.company_name).to_s)
puts("Status: " + (result.results.status).to_s)
```
---

## Multi-Account Usage

If you have multiple SparkPost accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.spark-post.list_sending_domains")
# Explicit default (portable across setups)
app.call("integrations.spark-post.default.list_sending_domains")
# Named accounts
app.call("integrations.spark-post.production.list_sending_domains")
app.call("integrations.spark-post.staging.list_sending_domains")
```
All functions are identical across accounts — only the credentials differ.
