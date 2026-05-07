# Google Docs

Google Docs tools are exposed under `app.integrations.google_docs`. This package is generated from Google's official Docs API v1 Discovery document and exposes 3 REST methods.

## Coverage

- Source: `https://docs.googleapis.com/$discovery/rest?version=v1`
- Read tools: 1
- Write tools: 2
- Base URL: `https://docs.googleapis.com`

## Usage Notes

Pass `documentId` path parameters as top-level arguments. Query parameters can be passed as top-level shortcuts or inside `query`. Create and batch update methods accept the official JSON request object inside `body`.

The Docs API does not list documents or manage permissions; use the Google Drive integration for file discovery and ACL operations.

## Tools

- `google_docs_documents_get` - GET /v1/documents/{documentId}
- `google_docs_documents_batch_update` - POST /v1/documents/{documentId}:batchUpdate
- `google_docs_documents_create` - POST /v1/documents

## Examples

```lua
local doc = app.integrations.google_docs.google_docs_documents_get({ documentId = "1AbC..." })

local result = app.integrations.google_docs.google_docs_documents_batch_update({
  documentId = "1AbC...",
  body = { requests = { { insertText = { location = { index = 1 }, text = "Hello" } } } }
})
```

Responses are decoded Google Docs JSON responses.
