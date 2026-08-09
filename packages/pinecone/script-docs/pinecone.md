# Pinecone JavaScript Reference

Namespace: `pinecone`

This integration covers common Pinecone Database control-plane and data-plane operations from the REST API. Pinecone requests use an `Api-Key` header and the configured `X-Pinecone-Api-Version`, defaulting to `2026-04`.

Control-plane tools use the configured API base URL, usually `https://api.pinecone.io`. Data-plane tools require the target index host returned by `pinecone.get_index`.

## Indexes

### `pinecone.list_indexes`

List indexes in the project.

```js
var indexes = app.integrations.pinecone.list_indexes({})
```
### `pinecone.get_index`

Get one index description, including its host.

```js
var index = app.integrations.pinecone.get_index({ name: "docs-example" })
```
### `pinecone.create_index`

Create a serverless index.

```js
var created = app.integrations.pinecone.create_index({
  name: "docs-example",
  dimension: 1536,
  metric: "cosine",
  cloud: "aws",
  region: "us-east-1",
})
```
### `pinecone.configure_index`

Patch configurable index settings.

```js
var updated = app.integrations.pinecone.configure_index({
  name: "docs-example",
  config: {
    deletion_protection: "enabled",
    tags: { environment: "test" },
  }
})
```
### `pinecone.delete_index`

Delete an index after deletion protection is disabled.

```js
app.integrations.pinecone.delete_index({ name: "docs-example" })
```
## Vectors

### `pinecone.upsert_vectors`

Upsert dense vectors into an index host.

```js
var result = app.integrations.pinecone.upsert_vectors({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
  namespace: "docs",
  vectors: [
    { id: "vec1", values: [ 0.1, 0.2 ], metadata: { source: "example" } }
  ]
})
```
### `pinecone.query_vectors`

Search by vector.

```js
var result = app.integrations.pinecone.query_vectors({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
  namespace: "docs",
  vector: [ 0.1, 0.2 ],
  top_k: 5,
  include_metadata: true,
  include_values: false,
})
```
### `pinecone.fetch_vectors`

Fetch vectors by ID.

```js
var result = app.integrations.pinecone.fetch_vectors({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
  namespace: "docs",
  ids: [ "vec1", "vec2" ],
})
```
### `pinecone.update_vector`

Update values or metadata by ID, or metadata across records matching a filter.

```js
var result = app.integrations.pinecone.update_vector({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
  namespace: "docs",
  id: "vec1",
  set_metadata: { status: "reviewed" },
})
```
### `pinecone.delete_vectors`

Delete by IDs, metadata filter, or `delete_all`.

```js
app.integrations.pinecone.delete_vectors({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
  namespace: "docs",
  ids: [ "vec1" ],
})
```
### `pinecone.describe_index_stats`

Describe vector counts and namespace stats.

```js
var stats = app.integrations.pinecone.describe_index_stats({
  index_host: "https://example-index.svc.us-east-1.pinecone.io",
})
```
## Collections

### `pinecone.list_collections`

List collections in the project.

```js
var collections = app.integrations.pinecone.list_collections({})
```
Collections are part of Pinecone's control-plane API. Prefer index and vector tools for current RAG workflows.
