# Qdrant — Lua API Reference

## list_collections

List all vector collections in the Qdrant cluster.

### Parameters

None.

### Example

```lua
local result = app.integrations.qdrant.list_collections({})

for _, col in ipairs(result.result.collections) do
  print(col.name)
end
```

---

## get_collection

Get detailed information about a specific collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Collection name |

### Example

```lua
local result = app.integrations.qdrant.get_collection({
  name = "documents"
})

print("Points count: " .. result.result.points_count)
print("Vectors count: " .. result.result.vectors_count)
```

---

## create_collection

Create a new vector collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new collection |
| `vectors` | object | yes | Vector configuration, e.g. `{size = 1536, distance = "Cosine"}` |
| `hnsw_config` | object | no | HNSW index settings (e.g. `{m = 16, ef_construct = 100}`) |
| `optimizers_config` | object | no | Optimizer settings |
| `quantization_config` | object | no | Quantization for memory savings |
| `replication_factor` | integer | no | Number of replicas per shard |
| `shard_number` | integer | no | Number of shards |

### Distance Options

`Cosine`, `Euclid`, `Dot`

### Example

```lua
local result = app.integrations.qdrant.create_collection({
  name = "documents",
  vectors = {
    size = 1536,
    distance = "Cosine"
  },
  hnsw_config = {
    m = 16,
    ef_construct = 100
  }
})

print("Status: " .. result.status)
```

---

## search

Search for similar vectors in a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | Collection to search in |
| `vector` | array | yes | Query vector (array of floats) |
| `vector_name` | string | no | Named vector to search (multi-vector collections) |
| `filter` | object | no | Filter conditions with `must`, `should`, `must_not` clauses |
| `limit` | integer | no | Max results (default: 10) |
| `offset` | integer | no | Pagination offset |
| `with_payload` | boolean | no | Include payloads (default: true) |
| `with_vectors` | boolean | no | Include vectors (default: false) |
| `score_threshold` | number | no | Minimum similarity score |

### Filter Syntax

Filters use conditions within `must` (AND), `should` (OR), and `must_not` (NOT) clauses:

```json
{
  "must": [
    {"key": "category", "match": {"value": "technology"}}
  ],
  "must_not": [
    {"key": "status", "match": {"value": "archived"}}
  ]
}
```

### Example

```lua
local result = app.integrations.qdrant.search({
  collection = "documents",
  vector = {0.1, 0.2, 0.3, /* ... */},
  limit = 5,
  with_payload = true,
  filter = {
    must = {
      { key = "category", match = { value = "technology" } }
    }
  }
})

for _, point in ipairs(result.result) do
  print("ID: " .. tostring(point.id) .. ", Score: " .. point.score)
  if point.payload then
    print("  Title: " .. (point.payload.title or "N/A"))
  end
end
```

---

## upsert_points

Insert or update points in a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection` | string | yes | Target collection |
| `points` | array | yes | Array of point objects (see below) |
| `wait` | boolean | no | Wait for completion (default: true) |
| `ordering` | string | no | Write ordering: `"weak"` or `"strong"` |

### Point Object

Each point requires:

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer or string | Unique point identifier (integer or UUID) |
| `vector` | array | Vector data (array of floats) |
| `payload` | object | Optional metadata key-value pairs |

### Example

```lua
local result = app.integrations.qdrant.upsert_points({
  collection = "documents",
  points = {
    {
      id = 1,
      vector = {0.1, 0.2, 0.3, /* ... */},
      payload = {
        title = "Introduction to Vectors",
        category = "technology",
        source = "docs"
      }
    },
    {
      id = 2,
      vector = {0.4, 0.5, 0.6, /* ... */},
      payload = {
        title = "Vector Databases Explained",
        category = "technology",
        source = "blog"
      }
    }
  }
})

print("Status: " .. result.status)
```

---

## get_current_user

Get information about the Qdrant cluster and authenticated context.

### Parameters

None.

### Example

```lua
local result = app.integrations.qdrant.get_current_user({})

if result.result then
  print("Cluster status: " .. (result.result.status or "unknown"))
  print("Nodes: " .. #result.result.peer_state)
end
```

---

## Multi-Account Usage

If you have multiple Qdrant clusters configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.qdrant.list_collections({})

-- Explicit default (portable across setups)
app.integrations.qdrant.default.list_collections({})

-- Named accounts
app.integrations.qdrant.production.list_collections({})
app.integrations.qdrant.staging.list_collections({})
```

All functions are identical across accounts — only the credentials differ.
