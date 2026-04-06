# Integration: Pinecone

> Pinecone vector database integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage indexes, upsert vectors, and query embeddings. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to a powerful vector database. Create indexes, store embeddings, and perform similarity search — all through the [Pinecone](https://pinecone.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Pinecone tool lets AI agents manage vector indexes, store and retrieve embeddings, and perform similarity searches — enabling agents to work with semantic search, RAG, and recommendation systems.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pinecone
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Pinecone API key (access token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pinecone' => [
        'access_token' => env('PINECONE_API_KEY'),
        'url'          => env('PINECONE_URL', 'https://api.pinecone.io'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pinecone_list_indexes` | read | List all vector indexes in the project |
| `pinecone_get_index` | read | Get details of a specific index |
| `pinecone_create_index` | write | Create a new serverless vector index |
| `pinecone_upsert_vectors` | write | Upsert vectors into an index |
| `pinecone_query_vectors` | read | Search for similar vectors in an index |
| `pinecone_list_collections` | read | List all collections in the project |
| `pinecone_get_current_user` | read | Get info about the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\Integrations\Pinecone\Tools\PineconeListIndexes;
use OpenCompany\Integrations\Pinecone\Tools\PineconeQueryVectors;

// Create tools
$service = app(PineconeService::class);
$tools = [
    new PineconeListIndexes($service),
    new PineconeQueryVectors($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Pinecone indexes');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pinecone');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pinecone\Tools\PineconeQueryVectors::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pinecone\PineconeService;

$service = app(PineconeService::class);

// List indexes
$indexes = $service->listIndexes();

// Create an index
$service->createIndex('my-index', 1536, 'cosine');

// Get index details (includes host URL for data operations)
$index = $service->getIndex('my-index');
$host = $index['host'];

// Upsert vectors
$service->upsertVectors($host, [
    ['id' => 'vec1', 'values' => [0.1, 0.2, 0.3, ...], 'metadata' => ['source' => 'doc1']],
    ['id' => 'vec2', 'values' => [0.4, 0.5, 0.6, ...], 'metadata' => ['source' => 'doc2']],
]);

// Query similar vectors
$results = $service->queryVectors($host, [0.1, 0.2, 0.3, ...], topK: 5);

// List collections
$collections = $service->listCollections();

// Get current user
$user = $service->getCurrentUser();
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
- A [Pinecone](https://pinecone.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
