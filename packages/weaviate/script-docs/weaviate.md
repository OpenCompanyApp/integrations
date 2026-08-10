# Weaviate — JavaScript API Reference

## list_schemas

List all schemas (collections/classes) defined in the Weaviate instance.

### Parameters

None.

### Example

```js
var result = app.integrations.weaviate.list_schemas({})

for (const classInfo of (result.classes || [])) {
  console.log("Class: " + classInfo.class)
  for (const prop of (classInfo.properties || [])) {
    console.log("  Property: " + prop.name + " (" + prop.dataType.join(", ") + ")")
  }
}
```
---

## get_schema

Get the schema definition for a specific class (collection).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class_name` | string | yes | The class name (e.g., `"Article"`, `"Document"`) |

### Example

```js
var result = app.integrations.weaviate.get_schema({
  class_name: "Article",
})

console.log("Class: " + result.class)
for (const prop of (result.properties || [])) {
  console.log("  " + prop.name + ": " + prop.dataType.join(", "))
}
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

```js
var result = app.integrations.weaviate.create_class({
  class: {
    class: "Article",
    description: "A news article || blog post",
    properties: [
      {
        name: "title",
        dataType: [ "text" ],
        description: "The article title",
      },
      {
        name: "content",
        dataType: [ "text" ],
        description: "The article body",
      },
      {
        name: "publishedAt",
        dataType: [ "date" ],
        description: "Publication date",
      }
    ]
  }
})

console.log("Created class: " + result.class)
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

```js
var result = app.integrations.weaviate.search_objects({
  query: String.raw`,
    {
      Get {
        Article {
          title
          content
        }
      }
    }
  `
})

for (const obj of (result.data.Get.Article || [])) {
  console.log(obj.title)
}
```
### Get with filter

```js
var result = app.integrations.weaviate.search_objects({
  query: String.raw`,
    {
      Get {
        Article(where: {
          path: ["title"],
          operator: Equal,
          valueText: "Introduction to Vectors",
        }) {
          title
          content
        }
      }
    }
  `
})
```
### Get with limit

```js
var result = app.integrations.weaviate.search_objects({
  query: String.raw`,
    {
      Get {
        Article(limit: 10) {
          title
          content
        }
      }
    }
  `
})
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

```js
var result = app.integrations.weaviate.create_object({
  class: "Article",
  properties: {
    title: "Introduction to Vector Databases",
    content: "Vector databases enable semantic search by storing embeddings...",
    publishedAt: "2026-04-06T12:00:00Z",
  }
})

console.log("Created object: " + result.id)
```
### Create with explicit UUID

```js
var result = app.integrations.weaviate.create_object({
  class: "Article",
  properties: {
    title: "Another Article",
    content: "More content here...",
  },
  id: "550e8400-e29b-41d4-a716-446655440000",
})
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

```js
var result = app.integrations.weaviate.get_object({
  class_name: "Article",
  id: "550e8400-e29b-41d4-a716-446655440000",
})

console.log("Title: " + result.properties.title)
console.log("Class: " + result.class)
console.log("Created: " + result.creationTimeUnix)
```
---

## get_health

Check the health and liveness of the Weaviate instance.

### Parameters

None.

### Example

```js
var result = app.integrations.weaviate.get_health({})

console.log("Status: " + (result.status || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Weaviate instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.weaviate.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.weaviate.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.weaviate.production.function_name({ /* parameters */ })
app.integrations.weaviate.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
