# Weaviate — Ruby API Reference

## list_schemas

List all schemas (collections/classes) defined in the Weaviate instance.

### Parameters

None.

### Example

```ruby
result = app.integrations.weaviate.list_schemas()
(result.classes || []).each do |classInfo|
  puts("Class: " + (classInfo.class).to_s)
  (classInfo.properties || []).each do |prop|
    puts("  Property: " + (prop.name).to_s + " (" + (prop.dataType.join(", ")).to_s + ")")
  end
end
```
---

## get_schema

Get the schema definition for a specific class (collection).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class_name` | string | yes | The class name (e.g., `"Article"`, `"Document"`) |

### Example

```ruby
result = app.integrations.weaviate.get_schema(class_name: "Article")
puts("Class: " + (result.class).to_s)
(result.properties || []).each do |prop|
  puts("  " + (prop.name).to_s + ": " + (prop.dataType.join(", ")).to_s)
end
```
---

## create_class

Create a new class (collection) in the Weaviate schema.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class` | object | yes | Class definition with `class` (string name) and `properties` (array of property definitions) |

### Class Definition

The `class` object must include:

- `class` — the class name (PascalCase, e.g., `"Article"`)
- `properties` — array of property definitions, each with:
  - `name` — the property name (camelCase)
  - `dataType` — array of type strings (e.g., `{"text"}`, `{"int"}`, `{"date"}`)

Optional fields: `description`, `vectorizer`, `moduleConfig`, etc.

### Example

```ruby
result = app.integrations.weaviate.create_class(class: {class: "Article", description: "A news article || blog post", properties: [{name: "title", dataType: ["text"], description: "The article title"}, {name: "content", dataType: ["text"], description: "The article body"}, {name: "publishedAt", dataType: ["date"], description: "Publication date"}]})
puts("Created class: " + (result.class).to_s)
```
---

## search_objects

Search and query objects using GraphQL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The GraphQL query string |

### Example

### Simple Get query

```ruby
result = app.integrations.weaviate.search_objects(query: "\n    {\n      Get {\n        Article {\n          title\n          content\n        }\n      }\n    }\n  ")
(result.data.Get.Article || []).each do |obj|
  puts(obj.title)
end
```
### Get with filter

```ruby
result = app.integrations.weaviate.search_objects(query: "\n    {\n      Get {\n        Article(where: {\n          path: [\"title\"],\n          operator: Equal,\n          valueText: \"Introduction to Vectors\",\n        }) {\n          title\n          content\n        }\n      }\n    }\n  ")
```
### Get with limit

```ruby
result = app.integrations.weaviate.search_objects(query: "\n    {\n      Get {\n        Article(limit: 10) {\n          title\n          content\n        }\n      }\n    }\n  ")
```
---

## create_object

Create a new data object in a Weaviate class.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class` | string | yes | The class/collection name |
| `properties` | object | yes | Key-value pairs matching the class schema properties |
| `id` | string | no | Optional UUID for the object |

### Example

```ruby
result = app.integrations.weaviate.create_object(class: "Article", properties: {title: "Introduction to Vector Databases", content: "Vector databases enable semantic search by storing embeddings...", publishedAt: "2026-04-06T12:00:00Z"})
puts("Created object: " + (result.id).to_s)
```
### Create with explicit UUID

```ruby
result = app.integrations.weaviate.create_object(class: "Article", properties: {title: "Another Article", content: "More content here..."}, id: "550e8400-e29b-41d4-a716-446655440000")
```
---

## get_object

Retrieve a specific data object by class name and UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class_name` | string | yes | The class/collection name |
| `id` | string | yes | The UUID of the object |

### Example

```ruby
result = app.integrations.weaviate.get_object(class_name: "Article", id: "550e8400-e29b-41d4-a716-446655440000")
puts("Title: " + (result.properties.title).to_s)
puts("Class: " + (result.class).to_s)
puts("Created (Unix seconds): " + (result.creationTimeUnix).to_s)
```
---

## get_health

Check the health and liveness of the Weaviate instance.

### Parameters

None.

### Example

```ruby
result = app.integrations.weaviate.get_health()
puts("Status: " + ((result.status || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Weaviate instances configured, use account-specific namespaces:

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
