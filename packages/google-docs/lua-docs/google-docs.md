# Google Docs — Lua API Reference

## list_documents

List Google Docs documents visible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max results per page (default: 100, max: 1000) |
| `pageToken` | string | no | Token for the next page of results |
| `q` | string | no | Drive API query string for filtering (defaults to Google Docs mimeType) |

### Query Examples

```lua
-- Filter by name
app.integrations["google-docs"].list_documents({
  q = "name contains 'report'"
})

-- Filter by modification time
app.integrations["google-docs"].list_documents({
  q = "modifiedTime > '2025-01-01T00:00:00'"
})

-- Combine filters
app.integrations["google-docs"].list_documents({
  q = "name contains 'meeting' and modifiedTime > '2025-06-01T00:00:00'"
})
```

### Response

Returns an array of documents with `id`, `name`, `owners`, `createdTime`, `modifiedTime`, and `webViewLink`. If there are more results, `nextPageToken` is included for pagination.

---

## get_document

Get the full content and structure of a Google Docs document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `documentId` | string | yes | The document ID (from the document URL) |

### Example

```lua
local doc = app.integrations["google-docs"].get_document({
  documentId = "1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms"
})

print(doc.title)
print(doc.plainText)
```

### Response

Returns `documentId`, `title`, `revisionId`, `plainText` (extracted text content), and `raw` (full API response with styling and structure).

---

## create_document

Create a new Google Docs document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Title for the new document |

### Example

```lua
local result = app.integrations["google-docs"].create_document({
  title = "Project Meeting Notes"
})

print("Created: " .. result.editUrl)
```

### Response

Returns `documentId`, `title`, `revisionId`, and `editUrl`.

---

## batch_update

Send batch update requests to a document (insert text, styling, etc.).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `documentId` | string | yes | The document ID to update |
| `requests` | array | yes | Array of Google Docs API request objects |

### Common Request Types

| Request Type | Description |
|-------------|-------------|
| `insertText` | Insert text at a specific location |
| `updateTextStyle` | Change font, size, bold, italic, etc. |
| `createParagraphBullets` | Add bullet points to paragraphs |
| `updateParagraphStyle` | Change alignment, spacing, etc. |
| `deleteContentRange` | Delete content in a range |

### Example — Insert text at end of document

```lua
app.integrations["google-docs"].batch_update({
  documentId = "1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms",
  requests = {
    {
      insertText = {
        location = { endIndex = 1 },
        text = "Hello, world!\n"
      }
    }
  }
})
```

### Response

Returns `documentId`, `replies` (per-request responses), and `writeControl`.

---

## list_permissions

List all permissions (sharing settings) for a Google Docs document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fileId` | string | yes | The document ID |
| `pageSize` | integer | no | Max results per page (default: 100) |

### Example

```lua
local result = app.integrations["google-docs"].list_permissions({
  fileId = "1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms"
})

for _, perm in ipairs(result.permissions) do
  print(perm.emailAddress .. " — " .. perm.role)
end
```

### Response

Returns `permissions` array with `id`, `type`, `emailAddress`, `role`, and `displayName`.

---

## get_permission

Get details of a specific permission for a document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fileId` | string | yes | The document ID |
| `permissionId` | string | yes | The permission ID (from list_permissions) |

### Example

```lua
local perm = app.integrations["google-docs"].get_permission({
  fileId = "1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgVE2upms",
  permissionId = "1234567890"
})

print(perm.emailAddress .. " (" .. perm.role .. ")")
```

---

## get_current_user

Get the authenticated Google user's profile information.

### Parameters

None required.

### Example

```lua
local user = app.integrations["google-docs"].get_current_user({})

print("Connected as: " .. user.email .. " (" .. user.name .. ")")
```

### Response

Returns `id`, `email`, `name`, `givenName`, `familyName`, `picture`, `locale`, and `verifiedEmail`.

---

## Multi-Account Usage

If you have multiple Google accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["google-docs"].list_documents({})

-- Explicit default (portable across setups)
app.integrations["google-docs"].default.list_documents({})

-- Named accounts
app.integrations["google-docs"].work.list_documents({})
app.integrations["google-docs"].personal.list_documents({})
```

All functions are identical across accounts — only the credentials differ.
