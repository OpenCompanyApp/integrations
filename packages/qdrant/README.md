# Integration: Qdrant

Qdrant integration for OpenCompany agents: collection management, vector search/query, point CRUD, payload operations, payload indexes, aliases, cluster info, and collection snapshots.

## Configuration

```php
return [
    'qdrant' => [
        'api_key' => env('QDRANT_API_KEY'),
        'url' => env('QDRANT_URL', 'https://your-cluster-url.qdrant.tech:6333'),
    ],
];
```

## Available Tool Groups

- Collections: list, get, create, delete
- Points: search, query, retrieve, scroll, count, upsert, delete
- Payloads: set, delete keys, clear all, create/delete payload indexes
- Cluster and ops: cluster info, aliases, snapshots

The old generated `qdrant_get_current_user` tool was replaced by `qdrant_get_cluster_info` because Qdrant exposes cluster information, not a user-profile endpoint.

## Service Usage

```php
use OpenCompany\Integrations\Qdrant\QdrantService;

$service = app(QdrantService::class);

$service->createCollection('documents', [
    'vectors' => ['size' => 1536, 'distance' => 'Cosine'],
]);

$service->upsertPoints('documents', [
    'points' => [
        ['id' => 1, 'vector' => [0.1, 0.2], 'payload' => ['title' => 'Doc 1']],
    ],
], ['wait' => true]);

$result = $service->queryPoints('documents', [
    'query' => [0.1, 0.2],
    'limit' => 5,
    'with_payload' => true,
]);
```
