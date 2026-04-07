# Chroma — Lua API Reference

## list_collections

List all vector collections in Chroma.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max collections to return (default: 100) |
| `after` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.chroma.list_collections({
  limit = 50
})

for _, col in ipairs(result) do
  print(col.name .. " (id: " .. col.id .. ")")
end
```

---

## get_collection

Get details of a specific collection by name or UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | Collection name or UUID |

### Example

```lua
local result = app.integrations.chroma.get_collection({
  collection_id = "my_collection"
})

print("Name: " .. result.name)
print("Documents: " .. tostring(result.count))
```

---

## create_collection

Create a new vector collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the collection |
| `description` | string | no | Optional description |
| `metadata` | object | no | Optional metadata (string key-value pairs) |

### Example

```lua
local result = app.integrations.chroma.create_collection({
  name = "knowledge_base",
  description = "Product documentation embeddings",
  metadata = { category = "docs", version = "1.0" }
})

print("Created collection: " .. result.id)
```

---

## add_documents

Add documents with embeddings to a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | Collection name or UUID |
| `ids` | array | yes | Array of unique document IDs |
| `embeddings` | array | no | Array of embedding vectors (float arrays) |
| `documents` | array | no | Array of text documents (auto-embedded) |
| `metadatas` | array | no | Array of metadata objects per document |

Either `embeddings` or `documents` must be provided.

### Example

```lua
-- Add documents with auto-generated embeddings
local result = app.integrations.chroma.add_documents({
  collection_id = "knowledge_base",
  ids = { "doc1", "doc2", "doc3" },
  documents = {
    "Chroma is an open-source vector database.",
    "It supports similarity search with embeddings.",
    "You can store metadata alongside documents."
  },
  metadatas = {
    { source = "readme" },
    { source = "docs" },
    { source = "tutorial" }
  }
})
```

### Example with pre-computed embeddings

```lua
local result = app.integrations.chroma.add_documents({
  collection_id = "knowledge_base",
  ids = { "vec1" },
  embeddings = {
    { 0.1, 0.2, 0.3, 0.4, 0.5 }
  },
  documents = { "A document with a pre-computed embedding" }
})
```

---

## query_documents

Search for similar documents using query embeddings or text.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | Collection name or UUID |
| `query_embeddings` | array | no | Array of query embedding vectors |
| `query_texts` | array | no | Array of query text strings (auto-embedded) |
| `n_results` | integer | no | Number of results per query (default: 10) |
| `where` | string | no | JSON metadata filter, e.g. `{"category": "tech"}` |
| `where_document` | string | no | JSON document content filter, e.g. `{"$contains": "term"}` |
| `include` | array | no | Fields to include: `documents`, `embeddings`, `metadatas`, `distances` |

Either `query_embeddings` or `query_texts` must be provided.

### Example

```lua
-- Query by text (auto-embedded)
local result = app.integrations.chroma.query_documents({
  collection_id = "knowledge_base",
  query_texts = { "What is Chroma?" },
  n_results = 5
})

for i, doc in ipairs(result.documents[1]) do
  print(i .. ": " .. doc .. " (distance: " .. tostring(result.distances[1][i]) .. ")")
end
```

### Example with metadata filter

```lua
local result = app.integrations.chroma.query_documents({
  collection_id = "knowledge_base",
  query_texts = { "vector search" },
  n_results = 3,
  where = '{"source": "docs"}',
  include = { "documents", "metadatas", "distances" }
})
```

---

## get_document

Retrieve specific documents by ID from a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | Collection name or UUID |
| `ids` | array | no | Array of document IDs to retrieve |
| `where` | string | no | JSON metadata filter |
| `where_document` | string | no | JSON document content filter |
| `include` | array | no | Fields: `documents`, `embeddings`, `metadatas` |
| `limit` | integer | no | Max documents to return (default: 100) |
| `offset` | integer | no | Number to skip for pagination |

### Example

```lua
local result = app.integrations.chroma.get_document({
  collection_id = "knowledge_base",
  ids = { "doc1", "doc2" }
})

for i, id in ipairs(result.ids) do
  print(id .. ": " .. result.documents[i])
end
```

### Example with filter and pagination

```lua
local result = app.integrations.chroma.get_document({
  collection_id = "knowledge_base",
  where = '{"source": "readme"}',
  limit = 10,
  offset = 0,
  include = { "documents", "metadatas" }
})
```

---

## get_health

Check the health status of the Chroma server.

### Parameters

None.

### Example

```lua
local result = app.integrations.chroma.get_health({})

print("Status: " .. (result.status or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Chroma instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.chroma.function_name({...})

-- Explicit default (portable across setups)
app.integrations.chroma.default.function_name({...})

-- Named accounts
app.integrations.chroma.production.function_name({...})
app.integrations.chroma.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
