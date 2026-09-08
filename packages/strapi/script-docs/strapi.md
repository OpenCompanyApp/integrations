# Strapi — Ruby API Reference

## strapi_list_entries

List entries for a content type in Strapi. Supports pagination, sorting, and population of relations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type (e.g., `"article"`, `"page"`, `"product"`) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of entries per page (default: 25) |
| `sort` | string | no | Sort field and direction (e.g., `"createdAt:desc"`, `"title:asc"`) |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name (e.g., `"author"`, `"image"`) |

### Examples

```ruby
# List all articles
result = app.integrations.strapi.list_entries(content_type: "article", page_size: 10, sort: "createdAt:desc", populate: "*")
result.data.each do |entry|
  puts((entry.id).to_s + ": " + (entry.attributes.title).to_s)
end
```
```ruby
# List products with pagination
result = app.integrations.strapi.list_entries(content_type: "product", page: 2, page_size: 50, populate: "image")
```
---

## strapi_get_entry

Get a single entry by content type and ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name |

### Examples

```ruby
# Get a single article with all relations
result = app.integrations.strapi.get_entry(content_type: "article", id: 42, populate: "*")
puts(result.data.attributes.title)
```
---

## strapi_create_entry

Create a new entry for a content type. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `data` | object | yes | The entry data (fields depend on the content type) |

### Examples

```ruby
# Create a new article
result = app.integrations.strapi.create_entry(content_type: "article", data: {title: "Hello World", body: "This is my first article.", publishedAt: nil})
puts("Created entry with ID: " + (result.data.id).to_s)
```
---

## strapi_update_entry

Update an existing entry by content type and ID. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to update |
| `data` | object | yes | The fields to update |

### Examples

```ruby
# Update an article's title
result = app.integrations.strapi.update_entry(content_type: "article", id: 42, data: {title: "Updated Title"})
```
---

## strapi_delete_entry

Delete an entry by content type and ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to delete |

### Examples

```ruby
result = app.integrations.strapi.delete_entry(content_type: "article", id: 42)
puts(result.message)
```
---

## strapi_list_content_types

List all content types defined in the Strapi Content-Type Builder. Returns API IDs, display names, and schema information.

### Parameters

None.

### Examples

```ruby
result = app.integrations.strapi.list_content_types()
result.data.each do |ct|
  puts((ct.uid).to_s + " — " + (ct.schema.displayName).to_s)
end
```
---

## strapi_get_current_user

Get the currently authenticated Strapi user. Useful for verifying the API token and checking permissions.

### Parameters

None.

### Examples

```ruby
result = app.integrations.strapi.get_current_user()
puts("Connected as: " + (result.username).to_s + " (" + (result.email).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Strapi instances configured, use account-specific namespaces:

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
