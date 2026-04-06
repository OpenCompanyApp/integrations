# Integration: Firecrawl

> Firecrawl integration for the [Laravel AI SDK](https://github.com/laravel/ai) — scrape, crawl, map, and extract web content. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to scrape web pages, crawl entire websites, discover URLs, and extract structured data — all through the [Firecrawl](https://firecrawl.dev) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Firecrawl tool lets AI agents scrape web content, crawl websites, discover page structures, and extract structured data — giving agents the ability to interact with and understand web content.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-firecrawl
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Firecrawl API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'firecrawl' => [
        'api_key' => env('FIRECRAWL_API_KEY'),
        'url'     => env('FIRECRAWL_URL', 'https://api.firecrawl.dev/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `firecrawl_scrape` | read | Scrape a single URL and extract its content |
| `firecrawl_crawl` | read | Start a crawl job to scrape all pages from a website |
| `firecrawl_get_crawl_status` | read | Check status and retrieve results of a crawl job |
| `firecrawl_map` | read | Discover all URLs on a website |
| `firecrawl_extract` | read | Extract structured data from URLs using AI |
| `firecrawl_get_current_user` | read | Get authenticated user's account information |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlScrape;

// Create tools
$service = app(FirecrawlService::class);
$tools = [
    new FirecrawlScrape($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Scrape the content from https://example.com and summarize it.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('firecrawl');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Firecrawl\Tools\FirecrawlScrape::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

$service = app(FirecrawlService::class);

// Scrape a page
$result = $service->scrape('https://example.com');

// Start a crawl
$crawl = $service->crawl('https://example.com', ['limit' => 50]);
$status = $service->getCrawlStatus($crawl['id']);

// Map a site
$urls = $service->map('https://example.com');

// Extract structured data
$data = $service->extract(
    ['https://example.com/product/1'],
    ['prompt' => 'Extract the product name, price, and description.']
);

// Check account info
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
- A [Firecrawl](https://firecrawl.dev) account with API access

## License

MIT — see [LICENSE](LICENSE)
