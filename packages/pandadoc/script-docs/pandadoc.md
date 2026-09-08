# PandaDoc — Ruby API Reference

## list_documents

List documents from PandaDoc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `count` | integer | no | Number of documents per page (default: 50, max: 100) |

### Examples

```ruby
result = app.integrations.pandadoc.list_documents(page: 1, count: 20)
result.results.each do |doc|
  puts((doc.name).to_s + " — " + (doc.status).to_s)
end
```
---

## get_document

Get details of a specific PandaDoc document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document UUID |

### Examples

```ruby
result = app.integrations.pandadoc.get_document(id: "abc123-def456-...")
puts("Document: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
```
---

## create_document

Create a new document from an existing PandaDoc template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new document |
| `template_id` | string | yes | UUID of the template to use |
| `recipients` | array | no | List of recipients with `email`, `first_name`, `last_name`, `role` |
| `tokens` | array | no | Template tokens to fill, each with `name` and `value` |
| `fields` | array | no | Prefill fields, each with `name` (or `field_uuid`) and `value` |
| `metadata` | object | no | Custom metadata key-value pairs |

### Examples

```ruby
result = app.integrations.pandadoc.create_document(name: "NDA - Acme Corp", template_id: "template-uuid-here", recipients: [{email: "john@example.com", first_name: "John", last_name: "Doe", role: "Signer"}], tokens: [{name: "Company Name", value: "Acme Corp"}, {name: "Date", value: "2026-04-05"}])
puts("Created document: " + (result.id).to_s)
```
---

## send_document

Send a document to recipients for signature.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document UUID to send |
| `message` | string | no | Custom message for the email notification |
| `silent` | boolean | no | If true, change status without sending email (default: false) |

### Examples

```ruby
result = app.integrations.pandadoc.send_document(id: "document-uuid-here", message: "Please review && sign this document at your earliest convenience.")
puts("Document sent successfully")
```
---

## list_templates

List available document templates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

```ruby
result = app.integrations.pandadoc.list_templates(page: 1)
result.results.each do |tmpl|
  puts((tmpl.name).to_s + " — " + (tmpl.id).to_s)
end
```
---

## get_template

Get details of a specific PandaDoc template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The template UUID |

### Examples

```ruby
result = app.integrations.pandadoc.get_template(id: "template-uuid-here")
puts("Template: " + (result.name).to_s)
puts("Fields: " + (result.fields.length).to_s)
```
---

## download_document

Download a document as PDF. Returns base64-encoded content.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document UUID to download |

### Examples

```ruby
result = app.integrations.pandadoc.download_document(id: "document-uuid-here")
puts("Content type: " + (result.content_type).to_s)
```
---

## create_link

Create a signed sharing link for a document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document UUID |
| `lifetime` | integer | no | Session lifetime in seconds (default: 3600) |

### Examples

```ruby
result = app.integrations.pandadoc.create_sharing_link(id: "document-uuid-here", lifetime: 7200)
puts("Sharing link: " + (result.session_url).to_s)
```
---

## get_current_user

Get the profile of the currently authenticated PandaDoc user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.pandadoc.get_current_user()
puts("Logged in as: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email).to_s)
puts("Company: " + (result.company).to_s)
```
---

## Multi-Account Usage

If you have multiple PandaDoc accounts configured, use account-specific namespaces:

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

## Typical Workflow

```ruby
# 1. Find a template
templates = app.integrations.pandadoc.list_templates()
template_id = templates.results[0].id
# 2. Create a document from the template
doc = app.integrations.pandadoc.create_document(name: "Service Agreement - New Client", template_id: template_id, recipients: [{email: "client@example.com", first_name: "Jane", last_name: "Smith", role: "Client"}], tokens: [{name: "Client Name", value: "Jane Smith"}, {name: "Service Date", value: "2026-04-05"}])
# 3. Send for signature
app.integrations.pandadoc.send_document(id: doc.id, message: "Please review && sign at your convenience.")
# 4. Share a link for viewing
link = app.integrations.pandadoc.create_sharing_link(id: doc.id, lifetime: 86400)
puts("View link: " + (link.session_url).to_s)
```