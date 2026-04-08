# Integration: Exa AI

> Exa AI search integration for Laravel — neural search, find similar links, retrieve page contents. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful neural web search via the [Exa AI](https://exa.ai) API. Search the web with natural language, find similar pages, and retrieve full page contents — all through a clean tool interface.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Exa integration lets AI agents search the web, discover similar content, and retrieve page contents — giving agents real-time information retrieval capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-exa
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires an Exa AI API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'exa' => [
        'api_key' => env('EXA_API_KEY'),
        'url'     => env('EXA_URL', 'https://api.exa.ai'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `exa_search` | read | Neural web search with natural language queries |
| `exa_find_similar` | read | Find pages similar to a given URL |
| `exa_get_contents` | read | Retrieve full contents for document IDs |
| `exa_search_and_contents` | read | Search and retrieve contents in one call |
| `exa_get_current_user` | read | Get authenticated user profile and usage info |

## Quick Start

```php
use OpenCompany\Integrations\Exa\ExaService;
use OpenCompany\Integrations\Exa\Tools\ExaSearch;
use OpenCompany\Integrations\Exa\Tools\ExaFindSimilar;

// Create tools
$service = app(ExaService::class);
$tools = [
    new ExaSearch($service),
    new ExaFindSimilar($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find recent articles about Laravel 12 features');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('exa');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Exa\Tools\ExaSearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Exa\ExaService;

$service = app(ExaService::class);

// Search the web
$results = $service->search([
    'query' => 'best practices for Laravel API development',
    'numResults' => 5,
    'type' => 'neural',
]);

// Find similar pages
$similar = $service->findSimilar([
    'url' => 'https://laravel.com/docs',
    'numResults' => 5,
]);

// Get page contents
$contents = $service->getContents([
    'ids' => ['https://example.com/article'],
    'text' => true,
]);

// Check user profile
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
- An [Exa AI](https://exa.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
