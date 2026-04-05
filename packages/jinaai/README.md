# Integration: Jina AI

> Jina AI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — search, read, ground, embeddings, and rerank. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful AI capabilities: web search, content extraction, factual grounding, text embeddings, and document reranking — all through the [Jina AI](https://jina.ai) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Jina AI integration lets AI agents search the web, read web pages, verify claims against context, generate embeddings for semantic search, and rerank documents by relevance.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-jinaai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Jina AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'jinaai' => [
        'api_key' => env('JINAAI_API_KEY'),
        'url'     => env('JINAAI_URL', 'https://api.jina.ai/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `jinaai_search` | read | Search the web — returns results with titles, URLs, and content |
| `jinaai_read` | read | Read and extract clean content from a URL |
| `jinaai_ground` | read | Ground a statement against context — verify factual claims |
| `jinaai_embeddings` | read | Generate text embeddings for semantic search and similarity |
| `jinaai_rerank` | read | Rerank documents by relevance to a query |

## Quick Start

```php
use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\Integrations\JinaAI\Tools\JinaAISearch;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIRead;

// Create tools
$service = app(JinaAIService::class);
$tools = [
    new JinaAISearch($service),
    new JinaAIRead($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Search for the latest Laravel news and read the top result');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('jinaai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\JinaAI\Tools\JinaAISearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\JinaAI\JinaAIService;

$service = app(JinaAIService::class);

// Search the web
$results = $service->search(['q' => 'Laravel 12 features']);

// Read a web page
$content = $service->read(['url' => 'https://laravel.com/docs']);

// Ground a statement
$grounding = $service->ground([
    'statement' => 'PHP 8.4 was released in 2024',
    'context' => 'PHP 8.4 was released on November 21, 2024.',
]);

// Generate embeddings
$embeddings = $service->embeddings([
    'input' => ['Hello world', 'Machine learning'],
    'model' => 'jina-embeddings-v3',
]);

// Rerank documents
$reranked = $service->rerank([
    'query' => 'How to install Laravel',
    'documents' => [
        'Laravel is a PHP framework.',
        'Install Laravel via Composer.',
        'Vue.js is a JS framework.',
    ],
]);
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
- A [Jina AI](https://jina.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
