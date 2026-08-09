# Typesense JavaScript Docs

Namespace: `typesense`

This integration is generated from Typesense's official OpenAPI schema and exposes 79 operations. Use it for search collections, documents, aliases, API keys, synonym sets, curation sets, analytics rules, presets, stopwords, overrides, health/debug endpoints, and cluster operations.

## Authentication

Configure a Typesense API key and node URL. Requests use the `X-TYPESENSE-API-KEY` header.

## Common Tools

- `typesense_list_collections`, `typesense_get_collection`, `typesense_create_collection`
- `typesense_search_documents`, `typesense_index_document`, `typesense_get_document`
- `typesense_get_keys`, `typesense_create_key`, `typesense_delete_key`
- `typesense_get_aliases`, `typesense_upsert_alias`, `typesense_delete_alias`
- `typesense_get_health`, `typesense_debug`

## Generated Operation Pattern

Path and query parameters use snake_case names. For write operations, pass the JSON payload as `body`. Extra top-level arguments that are not path, query, or header parameters are sent as the JSON body.

The official spec represents search as a `searchParameters` query object. In JavaScript, pass it as `search_parameters`, or pass `q`, `query_by`, `filter_by`, and other search keys directly; the integration flattens them into Typesense query parameters.

```js
var results = typesense.typesense_search_documents({
  collection_name: "companies",
  search_parameters: {
    q: "acme",
    query_by: "name,description",
    per_page: 10,
  }
})

var created = typesense.typesense_create_collection({
  body: {
    name: "companies",
    fields: [
      { name: "name", type: "string" }
    ]
  }
})
```
Return values are the parsed Typesense JSON response for the selected operation.
