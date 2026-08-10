# SparkPost — JavaScript API Reference

## list_sending_domains

List sending domains configured in SparkPost.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of domains to return (default: 100) |

### Example

```js
var result = app.integrations["spark-post"].list_sending_domains({
  limit: 50,
})

for (const domain of (result.results)) {
  console.log(domain.domain + " — verified: " + String(domain.status.verified))
}
```
---

## get_sending_domain

Get details for a specific sending domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain name (e.g., `"example.com"`) |

### Example

```js
var result = app.integrations["spark-post"].get_sending_domain({
  domain: "example.com",
})

console.log(result.results.domain)
console.log("DKIM verified: " + String(result.results.status.dkim_status))
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

```js
var result = app.integrations["spark-post"].list_templates({
  limit: 20,
  offset: 0,
})

for (const tpl of (result.results)) {
  console.log(tpl.id + ": " + (tpl.name || "unnamed"))
}
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

```js
var result = app.integrations["spark-post"].get_template({
  id: "my-template-id",
  draft: false,
})

console.log(result.results.name)
console.log("Subject: " + result.results.content.subject)
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

```js
const example = { address: { email: "user@example.com", name: "User Name" } }
```
### Example — Simple email

```js
var result = app.integrations["spark-post"].send_transmission({
  content: {
    from: "noreply@example.com",
    subject: "Hello from SparkPost",
    html: "<h1>Welcome!</h1><p>This is a test email.</p>",
    text: "Welcome! This is a test email.",
  },
  recipients: [
    { address: { email: "alice@example.com" } },
    { address: { email: "bob@example.com", name: "Bob" } }
  ]
})

console.log("Accepted: " + result.results.total_accepted_recipients)
console.log("Rejected: " + result.results.total_rejected_recipients)
```
### Example — Named sender

```js
var result = app.integrations["spark-post"].send_transmission({
  content: {
    from: { email: "team@example.com", name: "Team Example" },
    subject: "Monthly Newsletter",
    html: "<p>Here is your newsletter.</p>",
  },
  recipients: [
    { address: { email: "subscriber@example.com" } }
  ]
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

```js
var result = app.integrations["spark-post"].list_webhooks({
  limit: 50,
})

for (const hook of (result.results)) {
  console.log(hook.id + " → " + hook.target + " (" + hook.events.length + " events)")
}
```
---

## get_current_user

Get the current SparkPost account information.

### Parameters

None.

### Example

```js
var result = app.integrations["spark-post"].get_current_user({})

console.log("Account: " + result.results.company_name)
console.log("Status: " + result.results.status)
```
---

## Multi-Account Usage

If you have multiple SparkPost accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["spark-post"].list_sending_domains({})

// Explicit default (portable across setups)
app.integrations["spark-post"].default.list_sending_domains({})

// Named accounts
app.integrations["spark-post"].production.list_sending_domains({})
app.integrations["spark-post"].staging.list_sending_domains({})
```
All functions are identical across accounts — only the credentials differ.
