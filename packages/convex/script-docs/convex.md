# Client for the Convex REST API — Ruby API Reference

## convex_list_tables

List all tables in the Convex deployment.

### Example

```ruby
result = app.integrations.convex.list_tables()
```
## convex_get_table

Get metadata and schema for a specific Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name or ID. |

### Example

```ruby
result = app.integrations.convex.get_table(table: "users")
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

```ruby
result = app.integrations.convex.query_documents(table: "users", filter: "{\"status\": \"active\"}", limit: 50)
```
## convex_create_document

Create a new document in a Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `fields` | string | yes | JSON object of field name → value pairs (e.g., {"name":"John","age":30}). |

### Example

```ruby
result = app.integrations.convex.create_document(table: "users", fields: "{\"name\": \"John\", \"email\": \"john@example.com\"}")
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

```ruby
result = app.integrations.convex.update_document(table: "users", document_id: "doc_abc123", fields: "{\"name\": \"Jane\"}")
```
## convex_delete_document

Delete a document from a Convex table.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `table` | string | yes | Table name. |
| `document_id` | string | yes | Document ID. |

### Example

```ruby
result = app.integrations.convex.delete_document(table: "users", document_id: "doc_abc123")
```
## convex_get_current_user

Get the authenticated Convex user's profile information. Returns account details like name and email. Use this to verify API connectivity.

### Example

```ruby
result = app.integrations.convex.get_current_user()
```
---

## Multi-Account Usage

If you have multiple convex accounts configured, use account-specific namespaces:

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
