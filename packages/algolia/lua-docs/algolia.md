# Algolia — Lua API Reference

## search

Search an Algolia index with full-text search, filters, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index to search |
| `query` | string | yes | The search query string. Use `""` to retrieve all records |
| `filters` | string | no | Filter expression (e.g., `"category:electronics AND price<100"`) |
| `hitsPerPage` | integer | no | Results per page (default: 20, max: 1000) |
| `page` | integer | no | Page number, 0-based (default: 0) |
| `attributesToRetrieve` | array | no | Attributes to include in results |
| `facets` | array | no | Facet attributes to compute |
| `facetFilters` | array | no | Filter by facet values |
| `numericFilters` | array | no | Numeric filters (e.g., `{"price>50", "price<200"}`) |

### Examples

```lua
local result = app.integrations.algolia.search({
  indexName = "products",
  query = "wireless headphones",
  hitsPerPage = 10
})

for _, hit in ipairs(result.hits) do
  print(hit.objectID .. ": " .. hit.name)
end
```

```lua
-- Filtered search
local result = app.integrations.algolia.search({
  indexName = "products",
  query = "",
  filters = "category:electronics AND price<100",
  hitsPerPage = 50
})
```

---

## get_object

Retrieve a single record by its objectID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |
| `objectID` | string | yes | The unique identifier of the record |
| `attributesToRetrieve` | array | no | Attributes to include in the response |

### Example

```lua
local result = app.integrations.algolia.get_object({
  indexName = "products",
  objectID = "prod-123"
})
print(result.name)
```

---

## save_object

Create or replace a record in an index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |
| `objectID` | string | yes | The unique identifier for the record |
| `body` | object | yes | The complete record data |

### Example

```lua
local result = app.integrations.algolia.save_object({
  indexName = "products",
  objectID = "prod-123",
  body = {
    name = "Wireless Headphones",
    price = 79.99,
    category = "electronics"
  }
})
```

---

## delete_object

Delete a record from an index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |
| `objectID` | string | yes | The unique identifier of the record |

### Example

```lua
local result = app.integrations.algolia.delete_object({
  indexName = "products",
  objectID = "prod-123"
})
```

---

## partial_update

Update specific attributes without replacing the entire object.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |
| `objectID` | string | yes | The unique identifier of the record |
| `attributes` | object | yes | Key-value pairs to update |

### Example

```lua
local result = app.integrations.algolia.partial_update({
  indexName = "products",
  objectID = "prod-123",
  attributes = {
    price = 89.99,
    inStock = true
  }
})
```

### Atomic Operations

Use special `_operation` values for atomic updates:

```lua
-- Increment a numeric field
local result = app.integrations.algolia.partial_update({
  indexName = "products",
  objectID = "prod-123",
  attributes = {
    viewCount = { _operation = "Increment", value = 1 }
  }
})
```

---

## list_indices

List all indices in the Algolia application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-based) |
| `hitsPerPage` | integer | no | Indices per page (default: 100) |

### Example

```lua
local result = app.integrations.algolia.list_indices({})
for _, idx in ipairs(result.indices) do
  print(idx.name .. " (" .. idx.entries .. " records)")
end
```

---

## get_settings

Get the configuration settings of an index.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |

### Example

```lua
local result = app.integrations.algolia.get_settings({
  indexName = "products"
})
-- result contains searchableAttributes, ranking, customRanking, etc.
```

---

## clear_index

Remove all records from an index (settings are preserved).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index to clear |

### Example

```lua
local result = app.integrations.algolia.clear_index({
  indexName = "products"
})
```

---

## batch

Perform multiple write operations in a single request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `indexName` | string | yes | The name of the index |
| `requests` | array | yes | Array of `{action, body}` operations |

### Actions

- `addObject` — Add a new record (objectID auto-generated if not provided)
- `updateObject` — Update a record (body must include objectID)
- `partialUpdateObject` — Partial update (body must include objectID)
- `deleteObject` — Delete a record (body must include objectID)

### Example

```lua
local result = app.integrations.algolia.batch({
  indexName = "products",
  requests = {
    { action = "addObject", body = { name = "New Product", price = 29.99 } },
    { action = "updateObject", body = { objectID = "prod-1", name = "Updated Name" } },
    { action = "deleteObject", body = { objectID = "prod-2" } }
  }
})
print("Processed " .. result.operationCount .. " operations")
```

---

## get_current_user

List API keys to verify authentication.

### Parameters

None.

### Example

```lua
local result = app.integrations.algolia.get_current_user({})
print("Connected to app: " .. result.applicationId)
print("Found " .. result.keyCount .. " API keys")
```

---

## Multi-Account Usage

If you have multiple Algolia accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.algolia.search({...})

-- Explicit default (portable across setups)
app.integrations.algolia.default.search({...})

-- Named accounts
app.integrations.algolia.production.search({...})
app.integrations.algolia.staging.search({...})
```

All functions are identical across accounts — only the credentials differ.
