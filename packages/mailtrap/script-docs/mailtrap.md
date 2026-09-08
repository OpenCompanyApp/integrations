# Mailtrap — Ruby API Reference

## list_inboxes

List all inboxes in the Mailtrap account. Returns inbox IDs, names, and email addresses.

### Parameters

None.

### Examples

```ruby
inboxes = app.integrations.mailtrap.list_inboxes()
inboxes.each do |inbox|
  puts((inbox.name).to_s + " — " + (inbox.email).to_s + " (ID: " + (inbox.id).to_s + ")")
end
```
---

## get_inbox

Get details for a specific Mailtrap inbox by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `inbox_id` | integer | yes | The inbox ID. |

### Examples

```ruby
inbox = app.integrations.mailtrap.get_inbox(inbox_id: 12345)
puts("Inbox: " + (inbox.name).to_s)
puts("Email: " + (inbox.email).to_s)
puts("Messages: " + ((inbox.messages_count || 0)).to_s)
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

```ruby
result = app.integrations.mailtrap.list_messages(inbox_id: 12345, per_page: 10)
result.each do |msg|
  puts((msg.subject).to_s + " from " + (msg.from_email).to_s)
end
```
```ruby
# Search messages
result = app.integrations.mailtrap.list_messages(inbox_id: 12345, search: "welcome")
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

```ruby
msg = app.integrations.mailtrap.get_message(inbox_id: 12345, message_id: 67890)
puts("Subject: " + (msg.subject).to_s)
puts("From: " + (msg.from_email).to_s)
puts("To: " + (msg.to_email).to_s)
puts("HTML body length: " + ((msg.html_body || "").length).to_s)
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

```ruby
result = app.integrations.mailtrap.send_test_email(from: {email: "sender@example.com", name: "Sender"}, to: [{email: "recipient@example.com", name: "Recipient"}], subject: "Test Email", text: "This is a test email sent via Mailtrap.", html: "<h1>Test</h1><p>This is a test email sent via Mailtrap.</p>")
puts("Email sent successfully")
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

```ruby
result = app.integrations.mailtrap.list_suppressions(inbox_id: 12345)
result.each do |sup|
  puts("Suppressed: " + (sup.email).to_s + " — " + ((sup.reason || "unknown")).to_s)
end
```
---

## get_current_user

Get the current Mailtrap user profile and account info. Useful as a health check.

### Parameters

None.

### Examples

```ruby
user = app.integrations.mailtrap.get_current_user()
puts("Logged in as: " + (user.email).to_s)
puts("Account: " + ((user.company || "personal")).to_s)
```
---

## Multi-Account Usage

If you have multiple mailtrap accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
