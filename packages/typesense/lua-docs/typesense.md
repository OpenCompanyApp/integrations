# Typesense — Lua API Reference

## list_collections

List all collections in the Typesense search instance. Returns collection names, document counts, and schema details.

### Parameters

This tool takes no parameters.

### Examples

#### List all collections

```lua
local result = app.integrations.typesense.list_collections({})

for _, collection in ipairs(result.collections) do
  print(collection.name .. " (" .. collection.num_documents .. " documents)")
end
```

---

## get_collection

Get details of a specific Typesense collection by name, including its schema, field definitions, and document count.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the collection to retrieve |

### Examples

#### Get collection details

```lua
local result = app.integrations.typesense.get_collection({
  name = "products"
})

print("Fields:")
for _, field in ipairs(result.fields) do
  print("  " .. field.name .. " (" .. field.type .. ")")
end
print("Documents: " .. result.num_documents)
```

---

## create_collection

Create a new collection in Typesense with a specified schema including field definitions and optional default sorting field.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new collection |
| `fields` | array | yes | Array of field definitions. Each field should have `name`, `type` (e.g., `"string"`, `"int32"`, `"float"`, `"bool"`), and optionally `facet`, `optional`, `index` |
| `default_sorting_field` | string | no | The name of an int32 or float field to use for default sorting |

### Examples

#### Create a collection

```lua
local result = app.integrations.typesense.create_collection({
  name = "products",
  fields = {
    { name = "title", type = "string" },
    { name = "description", type = "string", optional = true },
    { name = "price", type = "float", facet = true },
    { name = "category", type = "string[]", facet = true },
    { name = "in_stock", type = "bool", optional = true }
  },
  default_sorting_field = "price"
})

print("Created collection: " .. result.name)
```

---

## search_documents

Search for documents in a Typesense collection. Supports full-text search, filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The name of the collection to search in |
| `q` | string | yes | The search query string. Use `"*"` to match all documents |
| `query_by` | string | yes | Comma-separated list of fields to search in (e.g., `"title,description"`) |
| `filter_by` | string | no | Filter conditions (e.g., `"category:electronics AND price:<100"`) |
| `sort_by` | string | no | Sort criteria (e.g., `"price:asc"`, `"created_at:desc"`) |
| `per_page` | integer | no | Number of results per page (default: 10, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### Search documents

```lua
local result = app.integrations.typesense.search_documents({
  collection = "products",
  q = "wireless keyboard",
  query_by = "title,description"
})

for _, hit in ipairs(result.hits) do
  print(hit.document.title .. " - $" .. hit.document.price)
end
```

#### Search with filters and sorting

```lua
local result = app.integrations.typesense.search_documents({
  collection = "products",
  q = "keyboard",
  query_by = "title,description",
  filter_by = "price:<50 && category:electronics",
  sort_by = "price:asc",
  per_page = 20
})
```

#### Match all documents

```lua
local result = app.integrations.typesense.search_documents({
  collection = "products",
  q = "*",
  query_by = "title",
  per_page = 50
})
```

---

## index_document

Index (create or update) a document in a Typesense collection. The document must conform to the collection's schema.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The name of the collection to index the document into |
| `document` | object | yes | The document data to index. Must include an `id` field matching the collection schema |

### Examples

#### Index a document

```lua
local result = app.integrations.typesense.index_document({
  collection = "products",
  document = {
    id = "prod-001",
    title = "Wireless Keyboard",
    description = "Ergonomic wireless keyboard",
    price = 49.99,
    category = "electronics",
    in_stock = true
  }
})

print("Indexed document: " .. result.id)
```

---

## get_document

Retrieve a single document from a Typesense collection by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | The name of the collection containing the document |
| `id` | string | yes | The ID of the document to retrieve |

### Examples

#### Get a document

```lua
local result = app.integrations.typesense.get_document({
  collection = "products",
  id = "prod-001"
})

print(result.title .. " - $" .. result.price)
```

---

## get_health

Check the health status of the Typesense search instance. Returns whether the service is reachable and healthy.

### Parameters

This tool takes no parameters.

### Examples

#### Health check

```lua
local result = app.integrations.typesense.get_health({})

if result.ok then
  print("Typesense is healthy")
else
  print("Typesense is unhealthy")
end
```

---

## Multi-Account Usage

If you have multiple typesense accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.typesense.search_documents({...})

-- Explicit default (portable across setups)
app.integrations.typesense.default.search_documents({...})

-- Named accounts
app.integrations.typesense.production.search_documents({...})
app.integrations.typesense.staging.search_documents({...})
```

All functions are identical across accounts — only the credentials differ.
