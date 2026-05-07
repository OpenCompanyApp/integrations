# Chroma Lua API Reference

Namespace: `app.integrations.chroma`

This package targets the official Chroma REST API v2. Configure the Chroma server origin, tenant, database, and API token. The service sends the token as `x-chroma-token` and builds paths as:

```text
/api/v2/tenants/{tenant}/databases/{database}/...
```

## System

```lua
local health = app.integrations.chroma.get_health({})
print(health["nanosecond heartbeat"])
```

## Collections

```lua
local collections = app.integrations.chroma.list_collections({
  limit = 50,
  offset = 0
})

local count = app.integrations.chroma.count_collections({})
```

Collection tools:

- `list_collections({ limit, offset })`
- `count_collections({})`
- `get_collection({ collection_id })`
- `create_collection({ name, metadata, configuration })`
- `update_collection({ collection_id, new_name, metadata, configuration })`
- `delete_collection({ collection_id })`

`collection_id` may be a collection UUID or name when the configured Chroma deployment accepts names in that path.

## Add And Upsert Records

Chroma record payloads are column-oriented. Matching array positions belong to the same record.

```lua
local added = app.integrations.chroma.add_documents({
  collection_id = "knowledge_base",
  ids = { "doc1", "doc2" },
  documents = {
    "Chroma stores embeddings.",
    "Chroma supports metadata filters."
  },
  metadatas = {
    { source = "docs" },
    { source = "docs" }
  }
})
```

Use `upsert_documents` to create missing records or update existing ones:

```lua
local upserted = app.integrations.chroma.upsert_documents({
  collection_id = "knowledge_base",
  ids = { "vec1" },
  embeddings = {
    { 0.1, 0.2, 0.3 }
  },
  documents = { "A record with a provided embedding" }
})
```

## Query And Get

Use `query_documents` for nearest-neighbor search and `get_document` for non-ranked retrieval by IDs or filters.

```lua
local result = app.integrations.chroma.query_documents({
  collection_id = "knowledge_base",
  query_embeddings = {
    { 0.1, 0.2, 0.3 }
  },
  n_results = 5,
  include = { "documents", "metadatas", "distances" }
})
```

```lua
local records = app.integrations.chroma.get_document({
  collection_id = "knowledge_base",
  ids = { "doc1", "doc2" },
  include = { "documents", "metadatas" }
})
```

Filter fields such as `where` and `where_document` are passed to Chroma as JSON objects.

## Update, Delete, And Count Records

```lua
local updated = app.integrations.chroma.update_documents({
  collection_id = "knowledge_base",
  ids = { "doc1" },
  documents = { "Updated text" },
  metadatas = { { source = "manual" } }
})

local deleted = app.integrations.chroma.delete_documents({
  collection_id = "knowledge_base",
  ids = { "doc2" }
})

local total = app.integrations.chroma.count_documents({
  collection_id = "knowledge_base"
})
```

Record tools:

- `add_documents`
- `update_documents`
- `upsert_documents`
- `delete_documents`
- `count_documents`
- `query_documents`
- `get_document`

Responses are Chroma JSON responses with no additional reshaping except count endpoints, which return `{ count = number }`.
