# Pinecone — Lua API Reference

## list_indexes

List all vector indexes in your Pinecone project.

### Parameters

None.

### Example

```lua
local result = app.integrations.pinecone.list_indexes({})

for _, index in ipairs(result.indexes or {}) do
  print(index.name .. " (" .. index.dimension .. "d, " .. index.metric .. ")")
end
```

---

## get_index

Get detailed information about a specific vector index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The index name |

### Example

```lua
local result = app.integrations.pinecone.get_index({
  name = "my-index"
})

print("Host: " .. result.host)
print("Dimension: " .. result.dimension)
print("Status: " .. (result.status and result.status.ready and "ready" or "not ready"))
```

---

## create_index

Create a new serverless vector index in Pinecone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Unique index name |
| `dimension` | integer | yes | Vector dimension (e.g., 1536 for OpenAI ada-002) |
| `metric` | string | no | Similarity metric: `"cosine"` (default), `"euclidean"`, or `"dotproduct"` |

### Example

```lua
local result = app.integrations.pinecone.create_index({
  name = "documents",
  dimension = 1536,
  metric = "cosine"
})

print("Created index: " .. result.name)
```

---

## upsert_vectors

Insert or update vectors in an index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index_host` | string | yes | The index host URL (from get_index response) |
| `vectors` | array | yes | Array of vector objects |

### Vector Object

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `id` | string | yes | Unique vector identifier |
| `values` | array | yes | Array of floats (must match index dimension) |
| `metadata` | object | no | Key-value metadata for filtering |

### Example

```lua
local result = app.integrations.pinecone.upsert_vectors({
  index_host = "idx-abc123.svc.us-east-1.pinecone.io",
  vectors = {
    {
      id = "doc1",
      values = {0.1, 0.2, 0.3, 0.4},
      metadata = { title = "Introduction", category = "docs" }
    },
    {
      id = "doc2",
      values = {0.5, 0.6, 0.7, 0.8},
      metadata = { title = "Getting Started", category = "docs" }
    }
  }
})

print("Upserted " .. (result.upserted_count or 0) .. " vectors")
```

---

## query_vectors

Search for similar vectors in an index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index_host` | string | yes | The index host URL (from get_index response) |
| `vector` | array | yes | Query vector embedding (must match index dimension) |
| `top_k` | integer | no | Number of results to return (default: 10) |
| `filter` | object | no | Metadata filter expression |
| `include_metadata` | boolean | no | Include metadata in results (default: true) |

### Filter Syntax

Metadata filters use Pinecone's filter expressions:

```lua
filter = {
  category = { ["$eq"] = "docs" }
}

-- Multiple conditions
filter = {
  category = { ["$in"] = { "docs", "blog" } },
  year = { ["$gte"] = 2024 }
}
```

Operators: `$eq`, `$ne`, `$gt`, `$gte`, `$lt`, `$lte`, `$in`, `$nin`

### Example

```lua
local result = app.integrations.pinecone.query_vectors({
  index_host = "idx-abc123.svc.us-east-1.pinecone.io",
  vector = {0.1, 0.2, 0.3, 0.4},
  top_k = 5,
  include_metadata = true,
  filter = {
    category = { ["$eq"] = "docs" }
  }
})

for _, match in ipairs(result.matches or {}) do
  print(match.id .. " (score: " .. match.score .. ")")
  if match.metadata then
    print("  title: " .. (match.metadata.title or "N/A"))
  end
end
```

---

## list_collections

List all collections in your Pinecone project.

### Parameters

None.

### Example

```lua
local result = app.integrations.pinecone.list_collections({})

for _, col in ipairs(result.collections or {}) do
  print(col.name .. " (source: " .. (col.source or "N/A") .. ")")
end
```

---

## get_current_user

Get information about the currently authenticated Pinecone user.

### Parameters

None.

### Example

```lua
local result = app.integrations.pinecone.get_current_user({})

print("User: " .. (result.user_name or "N/A"))
print("Email: " .. (result.user_email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Pinecone accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pinecone.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pinecone.default.function_name({...})

-- Named accounts
app.integrations.pinecone.production.function_name({...})
app.integrations.pinecone.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.

---

## Common Workflows

### Create an index, upsert, and query

```lua
-- Step 1: Create an index
local index = app.integrations.pinecone.create_index({
  name = "my-docs",
  dimension = 1536,
  metric = "cosine"
})

-- Step 2: Get the host URL (once index is ready)
local details = app.integrations.pinecone.get_index({ name = "my-docs" })
local host = details.host

-- Step 3: Upsert vectors
app.integrations.pinecone.upsert_vectors({
  index_host = host,
  vectors = {
    { id = "doc1", values = {0.1, 0.2, ...}, metadata = { title = "Doc 1" } },
    { id = "doc2", values = {0.3, 0.4, ...}, metadata = { title = "Doc 2" } }
  }
})

-- Step 4: Query for similar vectors
local results = app.integrations.pinecone.query_vectors({
  index_host = host,
  vector = {0.1, 0.15, ...},
  top_k = 5
})
```
