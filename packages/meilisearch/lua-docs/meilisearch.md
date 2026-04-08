# Meilisearch — Lua API Reference

## list_indexes

List all indexes in the Meilisearch instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of indexes to return (default: 20) |
| `offset` | integer | no | Number of indexes to skip for pagination |

### Examples

```lua
local result = app.integrations.meilisearch.list_indexes({})

for _, index in ipairs(result.results) do
  print(index.uid .. " (primary key: " .. (index.primaryKey or "none") .. ")")
end
```

---

## get_index

Get detailed information about a specific Meilisearch index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uid` | string | yes | The index unique identifier (e.g., `"movies"`) |

### Examples

```lua
local result = app.integrations.meilisearch.get_index({
  uid = "movies"
})

print("Index: " .. result.uid)
print("Primary key: " .. (result.primaryKey or "not set"))
```

---

## create_index

Create a new index in Meilisearch. Returns a task object that can be used to track the creation progress.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `uid` | string | yes | The unique identifier for the new index |
| `primary_key` | string | no | The primary key field (e.g., `"id"`) |

### Examples

```lua
local result = app.integrations.meilisearch.create_index({
  uid = "products",
  primary_key = "product_id"
})

print("Task UID: " .. result.taskUid)
print("Status: " .. result.status)
```

---

## search_documents

Search for documents in a Meilisearch index. Supports full-text search with filters, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index_uid` | string | yes | The index unique identifier to search in |
| `q` | string | no | The search query string. Use `""` to return all documents |
| `limit` | integer | no | Maximum number of documents to return (default: 20) |
| `offset` | integer | no | Number of documents to skip for pagination |
| `filter` | string | no | Filter expression as a JSON string, e.g., `'[["genre = Comedy"]]'` |
| `sort` | array | no | Sort criteria, e.g., `{"price:asc"}`. Requires a sortable attribute |

### Filter Syntax

Filters are JSON strings containing filter expressions:

```
[["field = value"]]
[["field > 10"]]
[["field IN [\"a\", \"b\"]"]]
```

### Sort Syntax

An array of attribute-direction pairs:

```lua
sort = {"price:asc", "name:desc"}
```

### Examples

```lua
-- Basic search
local result = app.integrations.meilisearch.search_documents({
  index_uid = "movies",
  q = "avengers",
  limit = 10
})

for _, hit in ipairs(result.hits) do
  print(hit.title .. " (" .. hit.year .. ")")
end
```

```lua
-- Search with filter
local result = app.integrations.meilisearch.search_documents({
  index_uid = "movies",
  q = "action",
  filter = '[["genre = Action"]]',
  sort = {"rating:desc"},
  limit = 5
})

for _, hit in ipairs(result.hits) do
  print(hit.title .. " — rating: " .. hit.rating)
end
```

```lua
-- Return all documents with pagination
local result = app.integrations.meilisearch.search_documents({
  index_uid = "movies",
  q = "",
  limit = 50,
  offset = 0
})

print("Total: " .. result.estimatedTotalHits .. " documents")
```

---

## add_documents

Add or replace documents in a Meilisearch index. Returns a task object to track indexing progress.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index_uid` | string | yes | The index unique identifier |
| `documents` | array | yes | An array of document objects to add |
| `primary_key` | string | no | The primary key field name (only needed if not set on the index) |

### Examples

```lua
local result = app.integrations.meilisearch.add_documents({
  index_uid = "movies",
  documents = {
    { id = 1, title = "Inception", year = 2010, genre = "Sci-Fi" },
    { id = 2, title = "The Dark Knight", year = 2008, genre = "Action" }
  }
})

print("Task UID: " .. result.taskUid)
print("Status: " .. result.status)
```

---

## get_document

Retrieve a single document from an index by its primary key value.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index_uid` | string | yes | The index unique identifier |
| `doc_id` | string | yes | The document primary key value |

### Examples

```lua
local result = app.integrations.meilisearch.get_document({
  index_uid = "movies",
  doc_id = "1"
})

print(result.title .. " (" .. result.year .. ")")
```

---

## get_health

Check the health status of the Meilisearch instance.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.meilisearch.get_health({})

print("Status: " .. result.status)
-- Expected: { status = "available" }
```

---

## Multi-Account Usage

If you have multiple Meilisearch instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.meilisearch.function_name({...})

-- Explicit default (portable across setups)
app.integrations.meilisearch.default.function_name({...})

-- Named accounts
app.integrations.meilisearch.production.function_name({...})
app.integrations.meilisearch.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
