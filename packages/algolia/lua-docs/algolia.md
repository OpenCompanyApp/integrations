# Algolia Lua API Reference

Namespace: `app.integrations.algolia`

Use Algolia tools to search indices, manage objects and index settings, maintain synonyms and query rules, inspect tasks and logs, and manage API keys. Full write coverage needs an Admin API key. Search-only keys can use search and read tools only.

## Search

```lua
local result = app.integrations.algolia.search({
  indexName = "products",
  query = "wireless headphones",
  filters = "category:electronics",
  hitsPerPage = 10
})

local multi = app.integrations.algolia.search_multiple({
  requests = {
    { indexName = "products", params = "query=headphones&hitsPerPage=5" },
    { indexName = "articles", params = "query=headphones&hitsPerPage=5" }
  }
})

local facets = app.integrations.algolia.search_facet_values({
  indexName = "products",
  facetName = "brand",
  params = { facetQuery = "sony" }
})
```

Use `browse` when the agent needs to export or scan an index. Continue with the returned cursor until the response has no cursor.

## Objects

```lua
local object = app.integrations.algolia.get_object({
  indexName = "products",
  objectID = "prod-123"
})

app.integrations.algolia.save_object({
  indexName = "products",
  objectID = "prod-123",
  body = {
    name = "Wireless Headphones",
    price = 79.99
  }
})

app.integrations.algolia.partial_update({
  indexName = "products",
  objectID = "prod-123",
  attributes = {
    price = 69.99
  }
})
```

Batch writes use Algolia batch request objects:

```lua
app.integrations.algolia.batch({
  indexName = "products",
  requests = {
    { action = "addObject", body = { objectID = "prod-1", name = "A" } },
    { action = "deleteObject", body = { objectID = "prod-2" } }
  }
})
```

## Indices And Settings

```lua
local indices = app.integrations.algolia.list_indices({})
local settings = app.integrations.algolia.get_settings({ indexName = "products" })

app.integrations.algolia.set_settings({
  indexName = "products",
  settings = {
    searchableAttributes = { "name", "description" },
    attributesForFaceting = { "brand", "category" }
  },
  query = { forwardToReplicas = true }
})
```

`clear_index` removes records but preserves settings. `delete_index` removes the index. `index_operation` can copy or move an index to a destination index.

## Synonyms

```lua
app.integrations.algolia.save_synonym({
  indexName = "products",
  objectID = "phone-mobile",
  payload = {
    objectID = "phone-mobile",
    type = "synonym",
    synonyms = { "phone", "mobile" }
  }
})

local found = app.integrations.algolia.search_synonyms({
  indexName = "products",
  params = { query = "phone" }
})
```

Use `batch_synonyms` for bulk replacement and `clear_synonyms` only when the agent is explicitly asked to remove all synonyms.

## Rules

```lua
app.integrations.algolia.save_rule({
  indexName = "products",
  objectID = "boost-headphones",
  payload = {
    objectID = "boost-headphones",
    condition = { pattern = "headphones", anchoring = "contains" },
    consequence = {
      params = {
        filters = "category:audio"
      }
    }
  }
})

local rules = app.integrations.algolia.search_rules({
  indexName = "products",
  params = { query = "headphones" }
})
```

## Keys, Logs, And Tasks

```lua
local keys = app.integrations.algolia.list_api_keys({})
local logs = app.integrations.algolia.list_logs({
  query = { length = 10, type = "all" }
})

local task = app.integrations.algolia.get_task({
  indexName = "products",
  taskID = "123456"
})
```

The legacy `get_current_user` slug lists API keys. New agents should use `list_api_keys`.

## Raw API Helpers

Use `api_get`, `api_post`, `api_put`, and `api_delete` for relative paths below the Algolia `/1` API root when no dedicated tool exists. Full URLs and parent-directory paths are rejected.

```lua
local response = app.integrations.algolia.api_get({
  path = "/indexes/products/settings"
})
```

## Multi-Account

```lua
app.integrations.algolia.production.search({ indexName = "products", query = "headphones" })
app.integrations.algolia.staging.search({ indexName = "products", query = "headphones" })
```
