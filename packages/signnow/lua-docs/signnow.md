# SignNow — Lua API Reference

## list_documents

List documents accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based). Default: 1. |
| `per_page` | integer | no | Number of documents per page. Default: 20. |

### Examples

```lua
local result = app.integrations.signnow.list_documents({
  page = 1,
  per_page = 20
})

for _, doc in ipairs(result.documents or {}) do
  print(doc.id .. ": " .. (doc.document_name or "Untitled"))
end
```

---

## get_document

Get full details for a specific document by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document_id` | string | yes | The unique document identifier. |

### Examples

```lua
local result = app.integrations.signnow.get_document({
  document_id = "abc123def456"
})

print("Document: " .. (result.name or "Untitled"))
print("Status: " .. (result.status or "unknown"))
```

---

## create_document

Upload a PDF file to create a new document in SignNow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_path` | string | yes | Absolute path to the PDF file to upload. |
| `file_name` | string | no | Name for the uploaded file. Defaults to the basename of file_path. |

### Examples

```lua
local result = app.integrations.signnow.create_document({
  file_path = "/tmp/contract.pdf",
  file_name = "Client Contract.pdf"
})

print("Created document ID: " .. result.id)
```

---

## list_templates

List document templates available in your SignNow account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.signnow.list_templates({})

for _, tmpl in ipairs(result.templates or {}) do
  print(tmpl.id .. ": " .. (tmpl.name or "Unnamed Template"))
end
```

---

## send_invite

Send a signing invitation for a document. The recipient receives an email with a link to sign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document_id` | string | yes | The document to send an invite for. |
| `to` | string | yes | Recipient email address. |
| `from` | string | yes | Sender email address (must be the authenticated user email). |
| `subject` | string | yes | Email subject line for the invite. |
| `message` | string | no | Optional custom message body for the invitation email. |

### Examples

```lua
local result = app.integrations.signnow.send_invite({
  document_id = "abc123def456",
  to = "client@example.com",
  from = "me@company.com",
  subject = "Please sign the NDA",
  message = "Hi, please review and sign the attached NDA at your earliest convenience."
})

print("Invite sent successfully")
```

---

## get_current_user

Get the authenticated SignNow user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.signnow.get_current_user({})

print("User: " .. (result.email or "unknown"))
print("Name: " .. (result.first_name or "") .. " " .. (result.last_name or ""))
```

---

## Multi-Account Usage

If you have multiple SignNow accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.signnow.list_documents({page = 1})

-- Explicit default (portable across setups)
app.integrations.signnow.default.list_documents({page = 1})

-- Named accounts
app.integrations.signnow.legal.list_documents({})
app.integrations.signnow.hr.list_documents({})
```

All functions are identical across accounts — only the credentials differ.
