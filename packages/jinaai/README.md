# Integration: Jina AI

> Jina AI integration for OpenCompany agents — search, read, ground, embeddings, rerank, classify, and segment.

Give agents access to Jina Search Foundation APIs: web search, URL reading, factual grounding, text embeddings, document reranking, zero-shot/few-shot classification, and tokenization/segmentation.

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
| `jinaai_ground` | read | Verify factual claims with Jina Grounding |
| `jinaai_embeddings` | read | Generate text embeddings for semantic search and similarity |
| `jinaai_rerank` | read | Rerank documents by relevance to a query |
| `jinaai_classify` | read | Classify text or image inputs with labels or a classifier |
| `jinaai_segment` | read | Tokenize or segment long text |

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

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

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

// Classify inputs
$classified = $service->classify([
    'input' => ['Composer installs Laravel packages.'],
    'labels' => ['php', 'javascript', 'database'],
]);

// Segment text
$segments = $service->segment([
    'content' => 'A long paragraph that should be split before embedding.',
    'return_chunks' => true,
]);
```

## Endpoint Notes

Reader/search/grounding use the documented Jina hostnames: `r.jina.ai`, `s.jina.ai`, and `g.jina.ai`. The configured base URL applies to Jina v1 model APIs: embeddings, rerank, classify, and segment.

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
