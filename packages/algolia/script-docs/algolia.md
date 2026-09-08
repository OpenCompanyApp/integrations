# Algolia Ruby API Reference

Namespace: `app.integrations.algolia`

Use Algolia tools to search indices, manage objects and index settings, maintain synonyms and query rules, inspect tasks and logs, and manage API keys. Full write coverage needs an Admin API key. Search-only keys can use search and read tools only.

## Search

```ruby
result = app.integrations.algolia.search(index_name: "products", query: "wireless headphones", filters: "category:electronics", hits_per_page: 10)
multi = app.integrations.algolia.search_multiple(requests: [{indexName: "products", params: "query=headphones&hitsPerPage=5"}, {indexName: "articles", params: "query=headphones&hitsPerPage=5"}])
facets = app.integrations.algolia.search_facet_values(index_name: "products", facet_name: "brand", params: {facetQuery: "sony"})
```
Use `browse` when the agent needs to export or scan an index. Continue with the returned cursor until the response has no cursor.

## Objects

```ruby
object = app.integrations.algolia.get_object(index_name: "products", object_id: "prod-123")
app.integrations.algolia.save_object(index_name: "products", object_id: "prod-123", body: {name: "Wireless Headphones", price: 79.99})
app.integrations.algolia.partial_update(index_name: "products", object_id: "prod-123", attributes: {price: 69.99})
```
Batch writes use Algolia batch request objects:

```ruby
app.integrations.algolia.batch(index_name: "products", requests: [{action: "addObject", body: {objectID: "prod-1", name: "A"}}, {action: "deleteObject", body: {objectID: "prod-2"}}])
```
## Indices And Settings

```ruby
indices = app.integrations.algolia.list_indices()
settings = app.integrations.algolia.get_settings(index_name: "products")
app.integrations.algolia.set_settings(index_name: "products", settings: {searchableAttributes: ["name", "description"], attributesForFaceting: ["brand", "category"]}, query: {forwardToReplicas: true})
```
`clear_index` removes records but preserves settings. `delete_index` removes the index. `index_operation` can copy or move an index to a destination index.

## Synonyms

```ruby
app.integrations.algolia.save_synonym(index_name: "products", object_id: "phone-mobile", payload: {objectID: "phone-mobile", type: "synonym", synonyms: ["phone", "mobile"]})
found = app.integrations.algolia.search_synonyms(index_name: "products", params: {query: "phone"})
```
Use `batch_synonyms` for bulk replacement and `clear_synonyms` only when the agent is explicitly asked to remove all synonyms.

## Rules

```ruby
app.integrations.algolia.save_rule(index_name: "products", object_id: "boost-headphones", payload: {objectID: "boost-headphones", condition: {pattern: "headphones", anchoring: "contains"}, consequence: {params: {filters: "category:audio"}}})
rules = app.integrations.algolia.search_rules(index_name: "products", params: {query: "headphones"})
```
## Keys, Logs, And Tasks

```ruby
keys = app.integrations.algolia.list_api_keys()
logs = app.integrations.algolia.list_logs(query: {length: 10, type: "all"})
task = app.integrations.algolia.get_task(index_name: "products", task_id: "123456")
```
The legacy `get_current_user` slug lists API keys. New agents should use `list_api_keys`.

## Raw API Helpers

Use `api_get`, `api_post`, `api_put`, and `api_delete` for relative paths below the Algolia `/1` API root when no dedicated tool exists. Full URLs and parent-directory paths are rejected.

```ruby
response = app.integrations.algolia.api_get(path: "/indexes/products/settings")
```
## Multi-Account

```ruby
app.integrations.algolia.production.search(index_name: "products", query: "headphones")
app.integrations.algolia.staging.search(index_name: "products", query: "headphones")
```