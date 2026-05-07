# Google Cloud Search

Google Cloud Search tools are exposed under `app.integrations.google_cloud_search`. This package is generated from Google's official Cloud Search v1 Discovery document and exposes 49 REST methods.

Use it for enterprise search and connector workflows: query search and suggestions, index data source items, manage schemas, push and poll indexing queues, configure data sources and search applications, inspect debug state, collect stats, upload media, initialize customers, and track operations.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or `operations/example`.

## Examples

```lua
local results = app.integrations.google_cloud_search.google_cloud_search_query_search({
  body = {
    query = "quarterly report",
    pageSize = 10
  }
})

local sources = app.integrations.google_cloud_search.google_cloud_search_query_sources_list({})

local item = app.integrations.google_cloud_search.google_cloud_search_indexing_datasources_items_get({
  name = "datasources/source/items/item-id"
})
```

Returned data is the parsed JSON response from the Cloud Search API. Empty successful responses return `{ success = true, status = <http_status> }`.

Cloud Search indexing and settings endpoints usually require domain-wide delegation, connector setup, and admin privileges. Prefer query/search tools for user-facing search workflows and indexing/settings tools only when the host has the required enterprise setup.