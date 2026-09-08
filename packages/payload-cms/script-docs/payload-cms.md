# Client for the Payload CMS REST API covering collections, documents, and user management — Ruby API Reference

## payload_cms_list_collections

List all collections defined in the Payload CMS instance.

### Example

```ruby
result = app.call("integrations.payload-cms.list_collections")
```
## payload_cms_get_collection

Get detailed information about a specific collection by its slug.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The slug of the collection to retrieve. |

### Example

```ruby
result = app.call("integrations.payload-cms.get_collection", slug: "")
```
## payload_cms_list_documents

List documents in a Payload CMS collection with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection slug to query. |
| `limit` | integer | no | Maximum number of documents to return (default 10). |
| `page` | integer | no | Page number for pagination (default 1). |
| `sort` | string | no | Sort field. Prefix with "-" for descending. E.g. "createdAt" or "-updatedAt". |
| `where` | string | no | JSON object for filtering. E.g. '{"title":{"equals":"Hello"}}'. |

### Example

```ruby
result = app.call("integrations.payload-cms.list_documents", collection: "", limit: 10, page: 1)
```
## payload_cms_get_document

Get a single document by its ID within a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection slug the document belongs to. |
| `document_id` | string | yes | The ID of the document to retrieve. |

### Example

```ruby
result = app.call("integrations.payload-cms.get_document", collection: "", document_id: "")
```
## payload_cms_create_document

Create a new document in a Payload CMS collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The collection slug to create the document in. |
| `data` | string | yes | JSON object of field values. E.g. '{"title":"Hello","content":"World"}'. |

### Example

```ruby
result = app.call("integrations.payload-cms.create_document", collection: "", data: "{\"title\":\"My Title\",\"content\":\"My content\"}")
```
## payload_cms_list_users

List users in the Payload CMS instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (default 10). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```ruby
result = app.call("integrations.payload-cms.list_users", limit: 10, page: 1)
```
## payload_cms_get_current_user

Get the profile of the currently authenticated Payload CMS user.

### Example

```ruby
result = app.call("integrations.payload-cms.get_current_user")
```
---

## Multi-Account Usage

If you have multiple payload-cms accounts configured, use account-specific namespaces:

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
