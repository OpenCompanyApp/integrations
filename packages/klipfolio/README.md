# Integration: Klipfolio

> Klipfolio integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list and view dashboards, metrics, and data sources. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Klipfolio business intelligence. Browse dashboards, inspect metrics, and review data source configurations — all through the [Klipfolio](https://www.klipfolio.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Klipfolio tool lets AI agents query dashboard configurations, inspect metrics, and review data sources — giving agents visibility into your business intelligence setup.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-klipfolio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Klipfolio API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'klipfolio' => [
        'access_token' => env('KLIPFOLIO_ACCESS_TOKEN'),
        'url'          => env('KLIPFOLIO_URL', 'https://app.klipfolio.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `klipfolio_list_dashboards` | read | List all dashboards accessible to the authenticated user |
| `klipfolio_get_dashboard` | read | Get details for a specific dashboard |
| `klipfolio_list_metrics` | read | List all metrics accessible to the authenticated user |
| `klipfolio_get_metric` | read | Get details for a specific metric |
| `klipfolio_list_datasources` | read | List all data sources accessible to the authenticated user |
| `klipfolio_get_datasource` | read | Get details for a specific data source |
| `klipfolio_get_current_user` | read | Get the authenticated user's profile information |

## Quick Start

```php
use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioListDashboards;
use OpenCompany\Integrations\Klipfolio\Tools\KlipfolioGetDashboard;

// Create tools
$service = app(KlipfolioService::class);
$tools = [
    new KlipfolioListDashboards($service),
    new KlipfolioGetDashboard($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Klipfolio dashboards');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('klipfolio');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Klipfolio\Tools\KlipfolioListDashboards::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Klipfolio\KlipfolioService;

$service = app(KlipfolioService::class);

// List dashboards
$dashboards = $service->listDashboards();

// Get a specific dashboard
$dashboard = $service->getDashboard('abc123');

// List metrics
$metrics = $service->listMetrics();

// Get a specific metric
$metric = $service->getMetric('def456');

// List data sources
$datasources = $service->listDatasources();

// Get a specific data source
$datasource = $service->getDatasource('ghi789');

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
- A [Klipfolio](https://www.klipfolio.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
