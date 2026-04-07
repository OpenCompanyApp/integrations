# Milvus — Lua API Reference

## list_collections

List all vector collections in Milvus.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max collections to return (default: 100) |
| `offset` | integer | no | Number of collections to skip for pagination |

### Example

```lua
local result = app.integrations.milvus.list_collections({
  limit = 50
})

for _, col in ipairs(result.data) do
  print(col.collectionName)
end
```

---

## get_collection

Get details of a specific collection by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_name` | string | yes | The name of the collection |

### Example

```lua
local result = app.integrations.milvus.get_collection({
  collection_name = "knowledge_base"
})

print("Name: " .. result.collectionName)
print("Description: " .. (result.description or "none"))
```

---

## create_collection

Create a new vector collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the collection |
| `dimension` | integer | yes | Dimension of embedding vectors |
| `description` | string | no | Optional description |
| `params` | object | no | Optional parameters (index type, metric type, etc.) |

### Example

```lua
local result = app.integrations.milvus.create_collection({
  name = "knowledge_base",
  dimension = 1536,
  description = "Product documentation embeddings"
})

print("Created collection: " .. result.collectionName)
```

### Example with custom index parameters

```lua
local result = app.integrations.milvus.create_collection({
  name = "image_vectors",
  dimension = 512,
  description = "Image feature vectors",
  params = {
    indexType = "IVF_FLAT",
    metricType = "L2",
    nlist = 1024
  }
})
```

---

## insert_documents

Insert documents with embedding vectors into a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_name` | string | yes | The name of the collection |
| `data` | array | yes | Array of document objects with a `vector` field and optional scalar fields |

Each document object should contain:
- `vector` (array of floats): The embedding vector
- `id` (string/integer, optional): Custom document ID
- Additional scalar fields as defined in the collection schema

### Example

```lua
local result = app.integrations.milvus.insert_documents({
  collection_name = "knowledge_base",
  data = {
    {
      id = "doc1",
      vector = { 0.1, 0.2, 0.3, 0.4 },
      text = "Milvus is a high-performance vector database.",
      source = "readme"
    },
    {
      id = "doc2",
      vector = { 0.5, 0.6, 0.7, 0.8 },
      text = "It supports billion-scale vector search.",
      source = "docs"
    }
  }
})

print("Inserted " .. tostring(result.insertCount) .. " documents")
```

---

## search_documents

Search for similar documents using a query vector.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_name` | string | yes | The name of the collection to search |
| `vector` | array | yes | The query embedding vector (array of floats) |
| `limit` | integer | no | Number of results to return (default: 10) |
| `output_fields` | array | no | Fields to include in response, e.g. `{"id", "text"}` |
| `filter` | string | no | Filter expression, e.g. `'source == "docs"'` |

### Example

```lua
local result = app.integrations.milvus.search_documents({
  collection_name = "knowledge_base",
  vector = { 0.1, 0.2, 0.3, 0.4 },
  limit = 5,
  output_fields = { "id", "text", "source" }
})

for i, match in ipairs(result.data) do
  print(i .. ": " .. match.text .. " (distance: " .. tostring(match.distance) .. ")")
end
```

### Example with filter

```lua
local result = app.integrations.milvus.search_documents({
  collection_name = "knowledge_base",
  vector = { 0.1, 0.2, 0.3, 0.4 },
  limit = 3,
  filter = 'source == "docs"',
  output_fields = { "id", "text" }
})
```

---

## get_collection_stats

Get statistics for a collection including row count.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_name` | string | yes | The name of the collection |

### Example

```lua
local result = app.integrations.milvus.get_collection_stats({
  collection_name = "knowledge_base"
})

print("Row count: " .. tostring(result.rowCount))
```

---

## get_health

Check the health status of the Milvus server.

### Parameters

None.

### Example

```lua
local result = app.integrations.milvus.get_health({})

print("Status: " .. (result.status or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Milvus instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.milvus.function_name({...})

-- Explicit default (portable across setups)
app.integrations.milvus.default.function_name({...})

-- Named accounts
app.integrations.milvus.production.function_name({...})
app.integrations.milvus.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
