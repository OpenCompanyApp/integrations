# DocuSign — Lua API Reference

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

```lua
local result = app.integrations.docusign.list_envelopes({
  status = "completed",
  from_date = "2026-01-01",
  to_date = "2026-03-31",
  count = 10
})

for _, env in ipairs(result.envelopes) do
  print(env.envelopeId .. ": " .. env.subject .. " (" .. env.status .. ")")
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

```lua
local result = app.integrations.docusign.get_envelope({
  envelope_id = "abc123-def456",
  include = "recipients,documents"
})

print("Subject: " .. result.emailSubject)
print("Status: " .. result.status)
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

```lua
-- Create from a template
local result = app.integrations.docusign.create_envelope({
  envelope_definition = {
    templateId = "tmpl-abc123",
    emailSubject = "Please sign the NDA",
    status = "sent",
    templateRoles = {
      {
        roleName = "signer",
        name = "Jane Doe",
        email = "jane@example.com"
      }
    }
  }
})

print("Envelope created: " .. result.envelopeId)
```

```lua
-- Create with inline documents
local result = app.integrations.docusign.create_envelope({
  envelope_definition = {
    emailSubject = "Contract for signature",
    status = "sent",
    documents = {
      {
        documentId = "1",
        name = "Contract.pdf",
        documentBase64 = "<base64-encoded PDF>"
      }
    },
    recipients = {
      signers = {
        {
          recipientId = "1",
          name = "John Smith",
          email = "john@example.com",
          tabs = {
            signHereTabs = {
              { documentId = "1", pageNumber = "1", xPosition = "100", yPosition = "500" }
            }
          }
        }
      }
    }
  }
})
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

```lua
local result = app.integrations.docusign.list_templates({
  search_text = "NDA",
  count = 10
})

for _, tmpl in ipairs(result.envelopeTemplates) do
  print(tmpl.templateId .. ": " .. tmpl.name)
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

```lua
local result = app.integrations.docusign.get_template({
  template_id = "tmpl-abc123"
})

print("Template: " .. result.name)
print("Documents: " .. #result.documents)
```

---

## list_documents

List documents attached to an envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `envelope_id` | string | yes | The envelope ID |

### Example

```lua
local result = app.integrations.docusign.list_documents({
  envelope_id = "abc123-def456"
})

for _, doc in ipairs(result.envelopeDocuments) do
  print(doc.documentId .. ": " .. doc.name .. " (" .. doc.type .. ")")
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

```lua
local result = app.integrations.docusign.get_document({
  envelope_id = "abc123-def456",
  document_id = "1"
})

print("Size: " .. result.size_bytes .. " bytes")
-- result.content_base64 contains the base64-encoded document
```

---

## get_current_user

Get information about the authenticated DocuSign user.

### Parameters

None.

### Example

```lua
local result = app.integrations.docusign.get_current_user()

print("User: " .. result.name)
print("Email: " .. result.email)

for _, acct in ipairs(result.accounts) do
  print("Account: " .. acct.account_id .. " - " .. acct.account_name)
end
```

---

## Multi-Account Usage

If you have multiple DocuSign accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.docusign.function_name({...})

-- Explicit default (portable across setups)
app.integrations.docusign.default.function_name({...})

-- Named accounts
app.integrations.docusign.production.function_name({...})
app.integrations.docusign.sandbox.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
