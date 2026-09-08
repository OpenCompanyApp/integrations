# SendGrid — Ruby API Reference

## list_emails

List emails in your SendGrid account with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of emails to return (default: 20, max: 100) |
| `query` | string | no | Search query to filter emails (e.g., `subject="Welcome"`) |

### Example

```ruby
result = app.integrations.sendgrid.list_emails(limit: 10, query: "subject=\"Welcome\"")
result.messages.each do |email|
  puts((email.from_email).to_s + " -> " + (email.subject).to_s)
end
```
---

## send_email

Send an email via SendGrid.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | object | yes | Sender with `email` and optionally `name` keys |
| `to` | array | yes | Array of recipient objects, each with `email` and optionally `name` |
| `subject` | string | yes | The email subject line |
| `htmlContent` | string | no | HTML body of the email |
| `textContent` | string | no | Plain text body of the email |

### Example

```ruby
result = app.integrations.sendgrid.email(from: {email: "noreply@example.com", name: "My App"}, to: [{email: "user@example.com", name: "John"}], subject: "Welcome!", html_content: "<h1>Hello!</h1><p>Welcome to our service.</p>", text_content: "Hello! Welcome to our service.")
puts("Email sent successfully")
```
---

## list_templates

List email templates in your SendGrid account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of templates to return per page (default: 20, max: 100) |
| `page_token` | string | no | Token for the next page of results |

### Example

```ruby
result = app.integrations.sendgrid.list_templates(page_size: 10)
result.templates.each do |template|
  puts((template.id).to_s + ": " + (template.name).to_s)
end
```
---

## get_template

Get details of a specific email template by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the template to retrieve |

### Example

```ruby
result = app.integrations.sendgrid.get_template(id: "d-abc123def456")
puts("Template: " + (result.name).to_s)
if result.versions
  result.versions.each do |version|
    puts("  Version: " + (version.name).to_s + " (active: " + ((version.active).to_s).to_s + ")")
  end
end
```
---

## list_contacts

List contacts in your SendGrid marketing contacts database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of contacts to return per page (default: 50, max: 100) |
| `page_token` | string | no | Token for the next page of results |

### Example

```ruby
result = app.integrations.sendgrid.list_contacts(page_size: 20)
result.result.each do |contact|
  puts(contact.email)
end
```
---

## get_contact

Get details of a specific contact by their ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the contact to retrieve |

### Example

```ruby
result = app.integrations.sendgrid.get_contact(id: "abc123-def456-ghi789")
puts("Email: " + (result.email).to_s)
puts("First name: " + ((result.first_name || "N/A")).to_s)
puts("Last name: " + ((result.last_name || "N/A")).to_s)
```
---

## get_current_user

Get the profile of the currently authenticated SendGrid user.

### Parameters

None.

### Example

```ruby
result = app.integrations.sendgrid.get_current_user()
puts("Email: " + (result.email).to_s)
puts("Name: " + ((result.first_name || "")).to_s + " " + ((result.last_name || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple SendGrid accounts configured, use account-specific namespaces:

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
