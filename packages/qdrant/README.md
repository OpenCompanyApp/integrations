# Integration: Qdrant

> Qdrant vector database integration for the [Laravel AI SDK](https://github.com/laravel/ai) — search, upsert points, manage collections. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to a high-performance vector similarity search engine. Search embeddings, upsert points, and manage collections — all through the [Qdrant](https://qdrant.tech/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Qdrant tool lets AI agents search vector embeddings, insert knowledge, and manage vector database collections — giving agents semantic search and memory capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-qdrant
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Qdrant API key and cluster URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'qdrant' => [
        'api_key' => env('QDRANT_API_KEY'),
        'url'     => env('QDRANT_URL', 'https://your-cluster-url.qdrant.tech:6333'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `qdrant_list_collections` | read | List all vector collections |
| `qdrant_get_collection` | read | Get detailed collection info |
| `qdrant_create_collection` | write | Create a new vector collection |
| `qdrant_search` | read | Search for similar vectors |
| `qdrant_upsert_points` | write | Insert or update points (vectors) |
| `qdrant_get_current_user` | read | Get cluster status and info |

## Quick Start

```php
use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\Integrations\Qdrant\Tools\QdrantSearch;
use OpenCompany\Integrations\Qdrant\Tools\QdrantUpsertPoints;

// Create tools
$service = app(QdrantService::class);
$tools = [
    new QdrantSearch($service),
    new QdrantUpsertPoints($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Search for documents similar to "machine learning basics"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('qdrant');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Qdrant\Tools\QdrantSearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Qdrant\QdrantService;

$service = app(QdrantService::class);

// List collections
$collections = $service->listCollections();

// Get collection details
$info = $service->getCollection('documents');

// Create a collection
$service->createCollection('documents', [
    'vectors' => ['size' => 1536, 'distance' => 'Cosine'],
]);

// Search
$results = $service->search('documents', [
    'vector' => [0.1, 0.2, 0.3, /* ... */],
    'limit' => 5,
]);

// Upsert points
$service->upsertPoints('documents', [
    'points' => [
        ['id' => 1, 'vector' => [0.1, 0.2], 'payload' => ['title' => 'Doc 1']],
    ],
]);

// Cluster info
$cluster = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Qdrant](https://qdrant.tech/) account (Cloud or self-hosted) with API access

## License

MIT — see [LICENSE](LICENSE)
