# PandaDoc — Lua API Reference

## list_documents

List documents from PandaDoc.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `count` | integer | no | Number of documents per page (default: 50, max: 100) |

### Examples

```lua
local result = app.integrations.pandadoc.list_documents({
  page = 1,
  count = 20
})

for _, doc in ipairs(result.results) do
  print(doc.name .. " — " .. doc.status)
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

```lua
local result = app.integrations.pandadoc.get_document({
  id = "abc123-def456-..."
})

print("Document: " .. result.name)
print("Status: " .. result.status)
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

```lua
local result = app.integrations.pandadoc.create_document({
  name = "NDA - Acme Corp",
  template_id = "template-uuid-here",
  recipients = {
    {
      email = "john@example.com",
      first_name = "John",
      last_name = "Doe",
      role = "Signer"
    }
  },
  tokens = {
    { name = "Company Name", value = "Acme Corp" },
    { name = "Date", value = "2026-04-05" }
  }
})

print("Created document: " .. result.id)
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

```lua
local result = app.integrations.pandadoc.send_document({
  id = "document-uuid-here",
  message = "Please review and sign this document at your earliest convenience."
})

print("Document sent successfully")
```

---

## list_templates

List available document templates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

```lua
local result = app.integrations.pandadoc.list_templates({
  page = 1
})

for _, tmpl in ipairs(result.results) do
  print(tmpl.name .. " — " .. tmpl.id)
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

```lua
local result = app.integrations.pandadoc.get_template({
  id = "template-uuid-here"
})

print("Template: " .. result.name)
print("Fields: " .. #result.fields)
```

---

## download_document

Download a document as PDF. Returns base64-encoded content.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document UUID to download |

### Examples

```lua
local result = app.integrations.pandadoc.download_document({
  id = "document-uuid-here"
})

print("Content type: " .. result.content_type)
-- result.content is base64-encoded PDF data
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

```lua
local result = app.integrations.pandadoc.create_link({
  id = "document-uuid-here",
  lifetime = 7200
})

print("Sharing link: " .. result.session_url)
```

---

## get_current_user

Get the profile of the currently authenticated PandaDoc user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.pandadoc.get_current_user({})

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
print("Company: " .. result.company)
```

---

## Multi-Account Usage

If you have multiple PandaDoc accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pandadoc.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pandadoc.default.function_name({...})

-- Named accounts
app.integrations.pandadoc.sales.function_name({...})
app.integrations.pandadoc.legal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.

## Typical Workflow

```lua
-- 1. Find a template
local templates = app.integrations.pandadoc.list_templates({})
local template_id = templates.results[1].id

-- 2. Create a document from the template
local doc = app.integrations.pandadoc.create_document({
  name = "Service Agreement - New Client",
  template_id = template_id,
  recipients = {
    { email = "client@example.com", first_name = "Jane", last_name = "Smith", role = "Client" }
  },
  tokens = {
    { name = "Client Name", value = "Jane Smith" },
    { name = "Service Date", value = "2026-04-05" }
  }
})

-- 3. Send for signature
app.integrations.pandadoc.send_document({
  id = doc.id,
  message = "Please review and sign at your convenience."
})

-- 4. Share a link for viewing
local link = app.integrations.pandadoc.create_link({
  id = doc.id,
  lifetime = 86400
})
print("View link: " .. link.session_url)
```
