# Integration: Fathom

> Fathom Analytics integration for the [Laravel AI SDK](https://github.com/laravel/ai) — query pageviews, aggregates, events, and manage sites. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to simple, privacy-first web analytics. Query pageviews, aggregated metrics, custom events, and site details — all through the [Fathom Analytics](https://usefathom.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Fathom tool lets AI agents query website analytics, retrieve aggregated traffic data, and inspect custom events — giving agents data-driven awareness of web properties.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-fathom
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Fathom Analytics access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'fathom' => [
        'access_token' => env('FATHOM_ACCESS_TOKEN'),
        'url'          => env('FATHOM_URL', 'https://api.usefathom.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `fathom_list_sites` | read | List all tracked websites |
| `fathom_get_site` | read | Get details for a specific site |
| `fathom_list_pageviews` | read | List pageviews with date filtering and pagination |
| `fathom_get_aggregate` | read | Get aggregated analytics (pageviews, visits, visitors, bounce rate) |
| `fathom_list_events` | read | List custom events for a site |
| `fathom_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\Integrations\Fathom\Tools\FathomListSites;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAggregate;

// Create tools
$service = app(FathomService::class);
$tools = [
    new FathomListSites($service),
    new FathomGetAggregate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many pageviews did my site get last week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('fathom');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Fathom\Tools\FathomGetAggregate::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Fathom\FathomService;

$service = app(FathomService::class);

// List sites
$sites = $service->listSites();

// Get site details
$site = $service->getSite('CDCLS');

// List pageviews
$pageviews = $service->listPageviews('CDCLS', '2025-01-01', '2025-01-31');

// Get aggregated data
$aggregate = $service->getAggregate(
    siteId: 'CDCLS',
    dateFrom: '2025-01-01',
    dateTo: '2025-01-31',
    metrics: 'pageviews,visits,visitors,bounce_rate',
    groupBy: 'page_path',
);

// List events
$events = $service->listEvents('CDCLS');

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
- A [Fathom Analytics](https://usefathom.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
