# Client for the Convex REST API — Lua API Reference

## convex_list_tables

List all tables in the Convex deployment.

### Example

```lua
local result = app.integrations.convex.convex_list_tables({
})
```

## convex_get_table

Get metadata and schema for a specific Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name or ID. |

### Example

```lua
local result = app.integrations.convex.convex_get_table({
  table = "users"
})
```

## convex_query_documents

Query documents from a Convex table with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `filter` | string | no | JSON object of field name → value pairs to filter documents by. |
| `order` | string | no | Field name to order results by. Prefix with "-" for descending (e.g., "-createdAt"). |
| `limit` | integer | no | Maximum number of documents to return. |
| `cursor` | string | no | Pagination cursor from a previous response. |

### Example

```lua
local result = app.integrations.convex.convex_query_documents({
  table = "users"
  filter = '{"status": "active"}'
  limit = 50
})
```

## convex_create_document

Create a new document in a Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `fields` | string | yes | JSON object of field name → value pairs (e.g., {"name":"John","age":30}). |

### Example

```lua
local result = app.integrations.convex.convex_create_document({
  table = "users"
  fields = '{"name": "John", "email": "john@example.com"}'
})
```

## convex_update_document

Update an existing document in a Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `document_id` | string | yes | Document ID. |
| `fields` | string | yes | JSON object of field name → value pairs to update. |

### Example

```lua
local result = app.integrations.convex.convex_update_document({
  table = "users"
  document_id = "doc_abc123"
  fields = '{"name": "Jane"}'
})
```

## convex_delete_document

Delete a document from a Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `document_id` | string | yes | Document ID. |

### Example

```lua
local result = app.integrations.convex.convex_delete_document({
  table = "users"
  document_id = "doc_abc123"
})
```

## convex_get_current_user

Get the authenticated Convex user's profile information. Returns account details like name and email. Use this to verify API connectivity.

### Example

```lua
local result = app.integrations.convex.convex_get_current_user({
})
```

---

## Multi-Account Usage

If you have multiple convex accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.convex.function_name({...})

-- Explicit default (portable across setups)
app.integrations.convex.default.function_name({...})

-- Named accounts
app.integrations.convex.staging.function_name({...})
app.integrations.convex.production.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
