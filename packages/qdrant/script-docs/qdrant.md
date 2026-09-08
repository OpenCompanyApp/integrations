# Qdrant — Ruby API Reference

Namespace: `app.integrations.qdrant`

## Collections

```ruby
collections = app.integrations.qdrant.list_collections()
info = app.integrations.qdrant.get_collection(name: "documents")
app.integrations.qdrant.create_collection(name: "documents", vectors: {size: 1536, distance: "Cosine"})
app.integrations.qdrant.delete_collection(name: "documents", timeout: 30)
```
## Points

```ruby
app.integrations.qdrant.upsert_points(collection: "documents", points: [{id: 1, vector: [0.1, 0.2], payload: {title: "Doc 1"}}], wait: true)
search = app.integrations.qdrant.search_points(collection: "documents", vector: [0.1, 0.2], limit: 5, with_payload: true)
query = app.integrations.qdrant.query_points(collection: "documents", query: [0.1, 0.2], limit: 5, with_payload: true)
retrieved = app.integrations.qdrant.retrieve_points(collection: "documents", ids: [1, 2], with_payload: true)
page = app.integrations.qdrant.scroll_points(collection: "documents", limit: 100, with_payload: true)
count = app.integrations.qdrant.count_points(collection: "documents", filter: {must: [{key: "category", match: {value: "docs"}}]}, exact: true)
```
Use `delete_points` with either `points` or `filter`.

## Payloads And Indexes

```ruby
app.integrations.qdrant.set_payload(collection: "documents", points: [0], payload: {reviewed: true})
app.integrations.qdrant.delete_payload(collection: "documents", points: [0], keys: ["reviewed"])
app.integrations.qdrant.clear_payload(collection: "documents", points: [0])
app.integrations.qdrant.create_payload_index(collection: "documents", field_name: "category", field_schema: "keyword")
```
## Aliases, Cluster, Snapshots

```ruby
cluster = app.integrations.qdrant.get_cluster_info()
aliases = app.integrations.qdrant.list_aliases()
collection_aliases = app.integrations.qdrant.list_collection_aliases(collection: "documents")
app.integrations.qdrant.update_aliases(actions: [{create_alias: {collection_name: "documents", alias_name: "active_docs"}}])
snapshots = app.integrations.qdrant.list_snapshots(collection: "documents")
snapshot = app.integrations.qdrant.create_snapshot(collection: "documents")
```
## Multi-Account Usage

```ruby
app.integrations.qdrant.list_collections()
app.integrations.qdrant.default.list_collections()
app.integrations.qdrant.production.list_collections()
```