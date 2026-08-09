# Mailtrap — JavaScript API Reference

## list_inboxes

List all inboxes in the Mailtrap account. Returns inbox IDs, names, and email addresses.

### Parameters

None.

### Examples

```js
var inboxes = app.integrations.mailtrap.list_inboxes()

for (const inbox of (inboxes)) {
  console.log(inbox.name + " — " + inbox.email + " (ID: " + inbox.id + ")")
}
```
---

## get_inbox

Get details for a specific Mailtrap inbox by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |

### Examples

```js
var inbox = app.integrations.mailtrap.get_inbox({
  inbox_id: 12345,
})

console.log("Inbox: " + inbox.name)
console.log("Email: " + inbox.email)
console.log("Messages: " + (inbox.messages_count || 0))
```
---

## list_messages

List messages in a Mailtrap inbox with optional search and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID to list messages from. |
| `page` | integer | no | Page number for pagination (1-based). |
| `per_page` | integer | no | Number of messages per page (default: 25). |
| `search` | string | no | Search query to filter messages by subject, from, or to. |

### Examples

```js
var result = app.integrations.mailtrap.list_messages({
  inbox_id: 12345,
  per_page: 10,
})

for (const msg of (result)) {
  console.log(msg.subject + " from " + msg.from_email)
}
```
```js
// Search messages
var result = app.integrations.mailtrap.list_messages({
  inbox_id: 12345,
  search: "welcome",
})
```
---

## get_message

Get a single message from a Mailtrap inbox by its ID, including subject, sender, recipient, and body.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |
| `message_id` | integer | yes | The message ID. |

### Examples

```js
var msg = app.integrations.mailtrap.get_message({
  inbox_id: 12345,
  message_id: 67890,
})

console.log("Subject: " + msg.subject)
console.log("From: " + msg.from_email)
console.log("To: " + msg.to_email)
console.log("HTML body length: " + (msg.html_body || "").length)
```
---

## send_test_email

Send a test email through Mailtrap. Provide sender, recipient(s), subject, and either text or HTML body.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | object | yes | Sender object with `email` and optionally `name`. |
| `to` | array | yes | Array of recipient objects, each with `email` and optionally `name`. |
| `subject` | string | yes | Email subject line. |
| `text` | string | no | Plain text email body. |
| `html` | string | no | HTML email body. |
| `inbox_id` | integer | no | Inbox ID to send from (required for Testing inbox type). |

### Examples

```js
var result = app.integrations.mailtrap.send_test_email({
  from: { email: "sender@example.com", name: "Sender" },
  to: [ { email: "recipient@example.com", name: "Recipient" } ],
  subject: "Test Email",
  text: "This is a test email sent via Mailtrap.",
  html: "<h1>Test</h1><p>This is a test email sent via Mailtrap.</p>",
})

console.log("Email sent successfully")
```
---

## list_suppressions

List suppressions (blocked recipients) for a Mailtrap inbox.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |
| `page` | integer | no | Page number for pagination (1-based). |
| `per_page` | integer | no | Number of results per page. |

### Examples

```js
var result = app.integrations.mailtrap.list_suppressions({
  inbox_id: 12345,
})

for (const sup of (result)) {
  console.log("Suppressed: " + sup.email + " — " + (sup.reason || "unknown"))
}
```
---

## get_current_user

Get the current Mailtrap user profile and account info. Useful as a health check.

### Parameters

None.

### Examples

```js
var user = app.integrations.mailtrap.get_current_user()

console.log("Logged in as: " + user.email)
console.log("Account: " + (user.company || "personal"))
```
---

## Multi-Account Usage

If you have multiple mailtrap accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.mailtrap.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.mailtrap.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.mailtrap.testing.function_name({ /* parameters */ })
app.integrations.mailtrap.production.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
