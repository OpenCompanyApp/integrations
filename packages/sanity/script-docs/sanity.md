# Sanity — Ruby API Reference

## sanity_query_documents

Query documents using GROQ (Graph-Relational Object Queries).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GROQ query string |
| `params` | object | no | Parameters referenced in the query as `$paramName` |

### GROQ Basics

GROQ is Sanity's query language. Common patterns:

- `*[_type == "post"]` — all documents of type "post"
- `*[_type == "post" && defined(slug)]` — with a slug field
- `*[_type == "post"] | order(publishedAt desc) [0..9]` — first 10, newest first
- `*[_type == "post"] {title, slug, publishedAt}` — pick specific fields
- `*[_type == "post" && slug.current == $slug][0]` — find by slug using params

### Examples

```ruby
# Get all posts
result = app.integrations.sanity.query_documents(query: "*[_type === \"post\"] {title, slug, publishedAt}")
result.result.each do |doc|
  puts(doc.title)
end
```
```ruby
# Get a post by slug using params
result = app.integrations.sanity.query_documents(query: "*[_type === \"post\" && slug.current === $slug][0]", params: {slug: "hello-world"})
puts(result.result.title)
```
---

## sanity_get_document

Retrieve a single document by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID (e.g., `"post-123"`) |

### Examples

```ruby
result = app.integrations.sanity.get_document(id: "post-123")
puts(result.title)
```
---

## sanity_create_document

Create a new document in the dataset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document` | object | yes | Document data with a required `_type` field |

### Examples

```ruby
result = app.integrations.sanity.create_document(document: {_type: "post", title: "My New Post", body: "Hello world!"})
puts("Created document: " + (result.results[0].id).to_s)
```
---

## sanity_update_document

Update fields on an existing document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID to update |
| `set` | object | yes | Fields to update |

### Examples

```ruby
result = app.integrations.sanity.update_document(id: "post-123", set: {title: "Updated Title", published: true})
```
---

## sanity_delete_document

Delete a document by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID to delete |

### Examples

```ruby
result = app.integrations.sanity.delete_document(id: "post-123")
puts(result.message)
```
---

## sanity_list_projects

List all Sanity projects accessible to the authenticated user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.sanity.list_projects()
result.each do |project|
  puts((project.displayName).to_s + " (" + (project.id).to_s + ")")
end
```
---

## sanity_get_current_user

Get the currently authenticated Sanity user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.sanity.get_current_user()
puts("Logged in as: " + (result.name).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Sanity accounts configured, use account-specific namespaces:

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
