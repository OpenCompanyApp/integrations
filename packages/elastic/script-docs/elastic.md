# Elasticsearch — Ruby API Reference

## list_indices

List all indices in the Elasticsearch cluster. Returns index names, health status, document counts, and sizes.

### Parameters

This tool takes no parameters.

### Examples

#### List all indices

```ruby
result = app.integrations.elastic.list_indices()
result.indices.each do |index|
  puts((index.name).to_s + " — " + (index.health).to_s + " — " + (index.docs_count).to_s + " docs")
end
```
---

## get_index

Get detailed information about a specific Elasticsearch index, including mappings, settings, and aliases.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index` | string | yes | The name of the index to retrieve |

### Examples

#### Get index details

```ruby
result = app.integrations.elastic.get_index(index: "products")
puts("Aliases: " + (JSON.generate(result.aliases)).to_s)
puts("Mappings: " + (JSON.generate(result.mappings)).to_s)
```
---

## create_index

Create a new Elasticsearch index with optional settings and mappings.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index` | string | yes | The name for the new index |
| `settings` | object | no | Optional index settings and mappings. Example: `{"settings": {"number_of_shards": 1}, "mappings": {"properties": {"title": {"type": "text"}}}}` |

### Examples

#### Create an index with mappings

```ruby
result = app.integrations.elastic.create_index(index: "products", settings: {settings: {number_of_shards: 1, number_of_replicas: 0}, mappings: {properties: {title: {type: "text"}, description: {type: "text"}, price: {type: "float"}, created_at: {type: "date"}}}})
puts("Created index: " + (result.index).to_s)
```
#### Create a simple index

```ruby
result = app.integrations.elastic.create_index(index: "logs")
```
---

## search_documents

Search for documents in an Elasticsearch index. Supports full query DSL including match, term, bool, and aggregation queries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index` | string | yes | The index to search in |
| `query` | object | no | The Elasticsearch query object. Defaults to `match_all` if omitted |
| `size` | integer | no | Maximum number of results to return (default: 10) |
| `from` | integer | no | Starting offset for pagination (default: 0) |

### Examples

#### Match all documents

```ruby
result = app.integrations.elastic.search_documents(index: "products", size: 20)
result.documents.each do |doc|
  puts((doc._id).to_s + ": " + (JSON.generate(doc._source)).to_s)
end
```
#### Search with a match query

```ruby
result = app.integrations.elastic.search_documents(index: "products", query: {match: {title: "wireless keyboard"}}, size: 10)
```
#### Paginate results

```ruby
result = app.integrations.elastic.search_documents(index: "products", query: {match_all: {}}, size: 10, from: 20)
puts("Total: " + (result.total).to_s + ", Showing: " + (result.count).to_s)
```
---

## index_document

Create or update a document in an Elasticsearch index. Provide an ID to update an existing document, or omit it to let Elasticsearch auto-generate one.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index` | string | yes | The target index name |
| `document` | object | yes | The document body to index |
| `id` | string | no | Optional document ID. If omitted, Elasticsearch auto-generates an ID |

### Examples

#### Index a document with a known ID

```ruby
result = app.integrations.elastic.index_document(index: "products", id: "prod-001", document: {title: "Wireless Keyboard", description: "Ergonomic wireless keyboard", price: 49.99})
puts("Indexed: " + (result._id).to_s)
```
#### Index without an ID (auto-generated)

```ruby
result = app.integrations.elastic.index_document(index: "products", document: {title: "New Product", price: 29.99})
```
---

## get_document

Retrieve a single document from an Elasticsearch index by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `index` | string | yes | The index containing the document |
| `id` | string | yes | The document ID to retrieve |

### Examples

#### Get a document

```ruby
result = app.integrations.elastic.get_document(index: "products", id: "prod-001")
puts((result._source.title).to_s + " - $" + (result._source.price).to_s)
```
---

## cluster_health

Get the health status of the Elasticsearch cluster, including status (green/yellow/red), number of nodes, and shard information.

### Parameters

This tool takes no parameters.

### Examples

#### Check cluster health

```ruby
result = app.integrations.elastic.cluster_health()
puts("Status: " + (result.status).to_s)
puts("Nodes: " + (result.number_of_nodes).to_s)
puts("Shards: " + (result.active_shards).to_s)
```
---

## Multi-Account Usage

If you have multiple elastic accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.elastic.search_documents()
# Explicit default (portable across setups)
app.integrations.elastic.default.search_documents()
# Named accounts
app.integrations.elastic.production.search_documents()
app.integrations.elastic.staging.search_documents()
```
All functions are identical across accounts — only the credentials differ.
