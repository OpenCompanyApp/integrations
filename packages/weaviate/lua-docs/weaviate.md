# Weaviate — Lua API Reference

## list_schemas

List all schemas (collections/classes) defined in the Weaviate instance.

### Parameters

None.

### Example

```lua
local result = app.integrations.weaviate.list_schemas({})

for _, class in ipairs(result.classes or {}) do
  print("Class: " .. class.class)
  for _, prop in ipairs(class.properties or {}) do
    print("  Property: " .. prop.name .. " (" .. table.concat(prop.dataType, ", ") .. ")")
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

```lua
local result = app.integrations.weaviate.get_schema({
  class_name = "Article"
})

print("Class: " .. result.class)
for _, prop in ipairs(result.properties or {}) do
  print("  " .. prop.name .. ": " .. table.concat(prop.dataType, ", "))
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

```lua
local result = app.integrations.weaviate.create_class({
  class = {
    class = "Article",
    description = "A news article or blog post",
    properties = {
      {
        name = "title",
        dataType = { "text" },
        description = "The article title"
      },
      {
        name = "content",
        dataType = { "text" },
        description = "The article body"
      },
      {
        name = "publishedAt",
        dataType = { "date" },
        description = "Publication date"
      }
    }
  }
})

print("Created class: " .. result.class)
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

```lua
local result = app.integrations.weaviate.search_objects({
  query = [[
    {
      Get {
        Article {
          title
          content
        }
      }
    }
  ]]
})

for _, obj in ipairs(result.data.Get.Article or {}) do
  print(obj.title)
end
```

### Get with filter

```lua
local result = app.integrations.weaviate.search_objects({
  query = [[
    {
      Get {
        Article(where: {
          path: ["title"]
          operator: Equal
          valueText: "Introduction to Vectors"
        }) {
          title
          content
        }
      }
    }
  ]]
})
```

### Get with limit

```lua
local result = app.integrations.weaviate.search_objects({
  query = [[
    {
      Get {
        Article(limit: 10) {
          title
          content
        }
      }
    }
  ]]
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

```lua
local result = app.integrations.weaviate.create_object({
  class = "Article",
  properties = {
    title = "Introduction to Vector Databases",
    content = "Vector databases enable semantic search by storing embeddings...",
    publishedAt = "2026-04-06T12:00:00Z"
  }
})

print("Created object: " .. result.id)
```

### Create with explicit UUID

```lua
local result = app.integrations.weaviate.create_object({
  class = "Article",
  properties = {
    title = "Another Article",
    content = "More content here..."
  },
  id = "550e8400-e29b-41d4-a716-446655440000"
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

```lua
local result = app.integrations.weaviate.get_object({
  class_name = "Article",
  id = "550e8400-e29b-41d4-a716-446655440000"
})

print("Title: " .. result.properties.title)
print("Class: " .. result.class)
print("Created: " .. result.creationTimeUnix)
```

---

## get_health

Check the health and liveness of the Weaviate instance.

### Parameters

None.

### Example

```lua
local result = app.integrations.weaviate.get_health({})

print("Status: " .. (result.status or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Weaviate instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.weaviate.function_name({...})

-- Explicit default (portable across setups)
app.integrations.weaviate.default.function_name({...})

-- Named accounts
app.integrations.weaviate.production.function_name({...})
app.integrations.weaviate.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
