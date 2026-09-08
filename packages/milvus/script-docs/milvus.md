# Milvus — Ruby API Reference

## list_collections

List all vector collections in Milvus.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max collections to return (default: 100) |
| `offset` | integer | no | Number of collections to skip for pagination |

### Example

```ruby
result = app.integrations.milvus.list_collections(limit: 50)
result.data.each do |col|
  puts(col.collectionName)
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

```ruby
result = app.integrations.milvus.get_collection(collection_name: "knowledge_base")
puts("Name: " + (result.collectionName).to_s)
puts("Description: " + ((result.description || "none")).to_s)
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

```ruby
result = app.integrations.milvus.create_collection(name: "knowledge_base", dimension: 1536, description: "Product documentation embeddings")
puts("Created collection: " + (result.collectionName).to_s)
```
### Example with custom index parameters

```ruby
result = app.integrations.milvus.create_collection(name: "image_vectors", dimension: 512, description: "Image feature vectors", params: {indexType: "IVF_FLAT", metricType: "L2", nlist: 1024})
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

```ruby
result = app.integrations.milvus.insert_documents(collection_name: "knowledge_base", data: [{id: "doc1", vector: [0.1, 0.2, 0.3, 0.4], text: "Milvus is a high-performance vector database.", source: "readme"}, {id: "doc2", vector: [0.5, 0.6, 0.7, 0.8], text: "It supports billion-scale vector search.", source: "docs"}])
puts("Inserted " + ((result.insertCount).to_s).to_s + " documents")
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

```ruby
result = app.integrations.milvus.search_documents(collection_name: "knowledge_base", vector: [0.1, 0.2, 0.3, 0.4], limit: 5, output_fields: ["id", "text", "source"])
result.data.each_with_index.map { |value, index| [index, value] }.each do |__index, match|
  i = (__index + 1)
  puts((i).to_s + ": " + (match.text).to_s + " (distance: " + ((match.distance).to_s).to_s + ")")
end
```
### Example with filter

```ruby
result = app.integrations.milvus.search_documents(collection_name: "knowledge_base", vector: [0.1, 0.2, 0.3, 0.4], limit: 3, filter: "source === \"docs\"", output_fields: ["id", "text"])
```
---

## get_collection_stats

Get statistics for a collection including row count.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_name` | string | yes | The name of the collection |

### Example

```ruby
result = app.integrations.milvus.get_collection_stats(collection_name: "knowledge_base")
puts("Row count: " + ((result.rowCount).to_s).to_s)
```
---

## get_health

Check the health status of the Milvus server.

### Parameters

None.

### Example

```ruby
result = app.integrations.milvus.get_health()
puts("Status: " + ((result.status || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Milvus instances configured, use account-specific namespaces:

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
