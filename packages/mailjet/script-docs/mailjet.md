# Mailjet — JavaScript API Reference

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

```js
// Send a simple email
var result = app.integrations.mailjet.send_email({
  from_email: "hello@example.com",
  from_name: "Acme Inc",
  to_email: "customer@example.org",
  subject: "Welcome!",
  html: "<h1>Welcome to Acme</h1><p>Thanks for signing up!</p>",
})

// Send to multiple recipients
var result = app.integrations.mailjet.send_email({
  from_email: "news@example.com",
  to_emails: ["alice@example.org", "bob@example.org"],
  subject: "Monthly newsletter",
  html: "<p>Here is your monthly update.</p>",
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

```js
var result = app.integrations.mailjet.list_contacts({
  limit: 50,
  offset: 0,
})

for (const contact of (result.Data)) {
  console.log(contact.Email)
}
```
---

## get_contact

Get details for a single contact by ID or email.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Contact ID or email address |

### Examples

```js
var result = app.integrations.mailjet.get_contact({
  id: "user@example.com",
})
console.log(result.Data[0].Email)
```
---

## create_contact

Create a new contact in Mailjet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address of the new contact |

### Examples

```js
var result = app.integrations.mailjet.create_contact({
  email: "newuser@example.com",
})
console.log("Created contact: " + result.Data[0].Email)
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

```js
var result = app.integrations.mailjet.list_campaigns({
  limit: 20,
})

for (const campaign of (result.Data)) {
  console.log(campaign.ID + ": " + campaign.Subject)
}
```
---

## get_campaign

Get details for a single campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Campaign ID |

### Examples

```js
var result = app.integrations.mailjet.get_campaign({
  id: "12345",
})
console.log(result.Data[0].Subject)
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

```js
var result = app.integrations.mailjet.list_templates({})

for (const tpl of (result.Data)) {
  console.log(tpl.ID + ": " + tpl.Name)
}
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

```js
var result = app.integrations.mailjet.get_stats({
  from_ts: "2026-01-01T00:00:00Z",
  to_ts: "2026-01-31T23:59:59Z",
})

for (const stat of (result.Data)) {
  console.log("Sent: " + stat.MessageSentCount + ", Opened: " + stat.MessageOpenedCount)
}
```
---

## get_current_user

Get the authenticated Mailjet user profile information.

### Parameters

None.

### Examples

```js
var result = app.integrations.mailjet.get_current_user({})
console.log(result.Data[0].Email)
```
---

## Multi-Account Usage

If you have multiple Mailjet accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mailjet.send_email({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mailjet.default.send_email({ /* parameters */ })

// Named accounts
app.integrations.mailjet.marketing.send_email({ /* parameters */ })
app.integrations.mailjet.transactional.send_email({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
