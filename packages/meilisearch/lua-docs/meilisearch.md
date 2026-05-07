# Meilisearch Lua Reference

Namespace: `meilisearch`

This integration covers Meilisearch's official HTTP API from the v1.43.0 OpenAPI release asset. Tools map directly to documented operations for indexes, documents, search, settings, tasks, API keys, dumps, snapshots, webhooks, network topology, metrics, logs, and experimental chat or AI-search surfaces.

Meilisearch API keys are optional for unsecured local instances. Protected instances use `Authorization: Bearer <api_key>`. All JSON responses are returned as decoded tables. Non-JSON responses, such as metrics or streamed text payloads, return `{ body, content_type }`.

## Common Patterns

List indexes:

```lua
local indexes = app.integrations.meilisearch.list_indexes({
  limit = 20,
  offset = 0
})
```

Create an index:

```lua
local task = app.integrations.meilisearch.create_index({
  uid = "books",
  primaryKey = "id"
})
```

Add or replace documents:

```lua
local task = app.integrations.meilisearch.add_documents({
  index_uid = "books",
  body = {
    { id = 1, title = "Search Basics", author = "Example Author" },
    { id = 2, title = "Ranking Rules", author = "Example Author" }
  }
})
```

Search with POST:

```lua
local results = app.integrations.meilisearch.search_documents({
  index_uid = "books",
  q = "ranking",
  limit = 10,
  filter = "author = 'Example Author'"
})
```

Update index settings:

```lua
local task = app.integrations.meilisearch.update_all({
  index_uid = "books",
  body = {
    searchableAttributes = { "title", "author" },
    filterableAttributes = { "author" },
    sortableAttributes = { "title" }
  }
})
```

Inspect tasks:

```lua
local tasks = app.integrations.meilisearch.get_tasks({
  indexUids = { "books" },
  statuses = { "enqueued", "processing", "succeeded" },
  limit = 10
})
```

## Tool Families

- Indexes: `list_indexes`, `create_index`, `get_index`, `delete_index`, `swap_indexes`, `compact`
- Documents: `add_documents`, `update_documents`, `get_documents`, `documents_by_query_post`, `get_document`, `delete_document`, `delete_documents_batch`, `delete_documents_by_filter`, `clear_all_documents`, `edit_documents_by_function`
- Search: `search_documents`, `search_with_url_query`, `multi_search_with_post`, `search`, `similar_get`, `similar_post`
- Settings: `get_all`, `update_all`, `delete_all`, and per-setting get/update/reset tools for displayed attributes, searchable attributes, filterable attributes, sortable attributes, synonyms, stop words, ranking rules, typo tolerance, faceting, pagination, embedders, chat, and related settings
- Tasks and batches: `get_tasks`, `get_task`, `cancel_tasks`, `delete_tasks`, `compact_task_queue`, `get_batches`, `get_batch`, `get_task_documents_file`
- API keys: `list_api_keys`, `create_api_key`, `get_api_key`, `patch_api_key`, `delete_api_key`
- Operations and diagnostics: `get_health`, `get_version`, `get_stats`, `get_index_stats`, `get_metrics`, `get_logs`, `cancel_logs`
- Dumps and snapshots: `create_dump`, `create_snapshot`
- Webhooks: `get_webhooks`, `post_webhook`, `get_webhook`, `patch_webhook`, `delete_webhook`
- Network: `get_network`, `patch_network`, `post_network_change`
- Experimental AI and chat: `list_workspaces`, `chat`, `get_chat`, `delete_chat`, `get_settings`, `patch_settings`, `reset_settings`

For operations with a request body, pass `body = { ... }` or pass body fields directly when there is no ambiguity. Path and query parameters preserve Meilisearch's documented names, but snake_case aliases work for camelCase parameters, such as `primary_key` for `primaryKey`.
