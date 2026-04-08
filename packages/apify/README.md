# Integration: Apify

> Apify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — run actors, manage datasets, key-value stores, and more. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Apify](https://apify.com) web scraping and automation platform. Run actors, retrieve scraped data from datasets, access key-value store records, and manage your Apify account — all through the Apify API v2.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Apify tool lets AI agents run web scrapers, retrieve structured data, and automate web workflows — enabling data-driven agents that can extract and process web content on demand.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-apify
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Apify API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'apify' => [
        'api_token' => env('APIFY_API_TOKEN'),
        'url'       => env('APIFY_URL', 'https://api.apify.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `apify_run_actor` | write | Run an Apify actor with input configuration |
| `apify_get_run` | read | Get details and status of an actor run |
| `apify_list_actors` | read | List available Apify actors |
| `apify_get_actor` | read | Get details and input schema of a specific actor |
| `apify_list_datasets` | read | List accessible datasets |
| `apify_get_dataset` | read | Get details of a specific dataset |
| `apify_get_dataset_items` | read | Retrieve items from a dataset (JSON, CSV, etc.) |
| `apify_list_key_value_stores` | read | List accessible key-value stores |
| `apify_get_record` | read | Get a record from a key-value store |
| `apify_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\Integrations\Apify\Tools\ApifyRunActor;
use OpenCompany\Integrations\Apify\Tools\ApifyGetRun;
use OpenCompany\Integrations\Apify\Tools\ApifyGetDatasetItems;

// Create tools
$service = app(ApifyService::class);
$tools = [
    new ApifyRunActor($service),
    new ApifyGetRun($service),
    new ApifyGetDatasetItems($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Scrape https://example.com using the cheerio scraper and show me the results');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('apify');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Apify\Tools\ApifyRunActor::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Apify\ApifyService;

$service = app(ApifyService::class);

// Run an actor
$run = $service->runActor('apify/cheerio-scraper', [
    'startUrls' => [['url' => 'https://example.com']],
]);

// Check run status
$status = $service->getRun($run['data']['id']);

// Get dataset items
$items = $service->getDatasetItems($run['data']['defaultDatasetId']);

// Get a key-value store record
$record = $service->getRecord($run['data']['defaultKeyValueStoreId'], 'OUTPUT');

// List actors
$actors = $service->listActors(0, 10);

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
- An [Apify](https://apify.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
