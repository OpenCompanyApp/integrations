# DocuSign — Ruby API Reference

## list_envelopes

List envelopes in the DocuSign account with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `sent`, `delivered`, `completed`, `signed`, `declined`, `voided`, or `all` (default: all) |
| `from_date` | string | no | Start date (YYYY-MM-DD). Defaults to 30 days ago. |
| `to_date` | string | no | End date (YYYY-MM-DD). Defaults to today. |
| `search_text` | string | no | Search envelope subjects and recipient names |
| `count` | integer | no | Number of results (default: 25, max: 100) |
| `start_position` | integer | no | Zero-based pagination index |
| `order` | string | no | Sort direction: `"asc"` or `"desc"` |
| `order_by` | string | no | Sort field: `"last_modified"`, `"created"`, or `"sent"` |

### Example

```ruby
result = app.integrations.docusign.list_envelopes(status: "completed", from_date: "2026-01-01", to_date: "2026-03-31", count: 10)
result.envelopes.each do |env|
  puts((env.envelopeId).to_s + ": " + (env.subject).to_s + " (" + (env.status).to_s + ")")
end
```
---

## get_envelope

Get detailed information about a specific envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `envelope_id` | string | yes | The envelope ID |
| `include` | string | no | Comma-separated: `recipients`, `documents`, `extensions`, `custom_fields`, `tabs` |

### Example

```ruby
result = app.integrations.docusign.get_envelope(envelope_id: "abc123-def456", include: "recipients,documents")
puts("Subject: " + (result.emailSubject).to_s)
puts("Status: " + (result.status).to_s)
```
---

## create_envelope

Create a new envelope for electronic signature.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `envelope_definition` | object | yes | Full envelope definition (see below) |

### Envelope Definition Fields

The `envelope_definition` object must contain:

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `emailSubject` | string | yes | Email subject line |
| `documents` | array | yes* | Array of document objects (not needed if using templateId) |
| `templateId` | string | yes* | Template ID to create from (alternative to documents) |
| `recipients` | object | yes | Recipient roles: signers, ccs, etc. |
| `status` | string | no | `"sent"` to send immediately or `"created"` to save as draft (default: sent) |

### Examples

```ruby
# Create from a template
result = app.integrations.docusign.create_envelope(envelope_definition: {templateId: "tmpl-abc123", emailSubject: "Please sign the NDA", status: "sent", templateRoles: [{roleName: "signer", name: "Jane Doe", email: "jane@example.com"}]})
puts("Envelope created: " + (result.envelopeId).to_s)
```
```ruby
# Create with inline documents
result = app.integrations.docusign.create_envelope(envelope_definition: {emailSubject: "Contract for signature", status: "sent", documents: [{documentId: "1", name: "Contract.pdf", documentBase64: "<base64-encoded PDF>"}], recipients: {signers: [{recipientId: "1", name: "John Smith", email: "john@example.com", tabs: {signHereTabs: [{documentId: "1", pageNumber: "1", xPosition: "100", yPosition: "500"}]}}]}})
```
---

## list_templates

List templates available in the DocuSign account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search_text` | string | no | Filter by name or description |
| `count` | integer | no | Number of results (default: 25) |
| `start_position` | integer | no | Zero-based pagination index |
| `folder_id` | string | no | Filter by folder ID |
| `order` | string | no | Sort direction: `"asc"` or `"desc"` |
| `order_by` | string | no | Sort field: `"name"` or `"modified"` |

### Example

```ruby
result = app.integrations.docusign.list_templates(search_text: "NDA", count: 10)
result.envelopeTemplates.each do |tmpl|
  puts((tmpl.templateId).to_s + ": " + (tmpl.name).to_s)
end
```
---

## get_template

Get full details for a DocuSign template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | The template ID |

### Example

```ruby
result = app.integrations.docusign.get_template(template_id: "tmpl-abc123")
puts("Template: " + (result.name).to_s)
puts("Documents: " + (result.documents.length).to_s)
```
---

## list_documents

List documents attached to an envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `envelope_id` | string | yes | The envelope ID |

### Example

```ruby
result = app.integrations.docusign.list_documents(envelope_id: "abc123-def456")
result.envelopeDocuments.each do |doc|
  puts((doc.documentId).to_s + ": " + (doc.name).to_s + " (" + (doc.type).to_s + ")")
end
```
---

## get_document

Download a document from an envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `envelope_id` | string | yes | The envelope ID |
| `document_id` | string | yes | The document ID, or `"combined"` for all docs as one PDF |

### Example

```ruby
result = app.integrations.docusign.get_document(envelope_id: "abc123-def456", document_id: "1")
puts("Size: " + (result.size_bytes).to_s + " bytes")
```
---

## get_current_user

Get information about the authenticated DocuSign user.

### Parameters

None.

### Example

```ruby
result = app.integrations.docusign.get_current_user()
puts("User: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
result.accounts.each do |acct|
  puts("Account: " + (acct.account_id).to_s + " - " + (acct.account_name).to_s)
end
```
---

## Multi-Account Usage

If you have multiple DocuSign accounts configured, use account-specific namespaces:

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
