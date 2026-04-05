# Integration: Metabase

> Metabase BI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — query dashboards, cards, and databases. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to business intelligence data. Browse dashboards, execute saved questions, and explore database schemas — all through the [Metabase](https://www.metabase.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Metabase tool lets AI agents explore BI dashboards, run saved queries, and inspect database schemas — giving agents data-driven awareness of your organization's metrics.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-metabase
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Metabase hostname, username, and password.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'metabase' => [
        'hostname' => env('METABASE_URL', 'https://your-metabase.example.com'),
        'username' => env('METABASE_USERNAME'),
        'password' => env('METABASE_PASSWORD'),
    ],
];
```

## Authentication

The integration authenticates via `POST /api/session` using the configured username and password. A session token is cached in memory for the request lifetime and automatically refreshed on 401 responses.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `metabase_list_dashboards` | read | List all dashboards |
| `metabase_get_dashboard` | read | Get a dashboard with its cards and layout |
| `metabase_list_cards` | read | List all cards (saved questions) |
| `metabase_get_card` | read | Get a card definition |
| `metabase_query_card` | read | Execute a card and return results |
| `metabase_list_databases` | read | List all connected databases |
| `metabase_get_database` | read | Get database metadata (tables, fields) |
| `metabase_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\Integrations\Metabase\Tools\MetabaseQueryCard;
use OpenCompany\Integrations\Metabase\Tools\MetabaseListDashboards;

// Create tools
$service = app(MetabaseService::class);
$tools = [
    new MetabaseListDashboards($service),
    new MetabaseQueryCard($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What were the top 5 dashboards last month?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('metabase');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Metabase\Tools\MetabaseQueryCard::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Metabase\MetabaseService;

$service = app(MetabaseService::class);

// List dashboards
$dashboards = $service->listDashboards();

// Get a specific dashboard
$dashboard = $service->getDashboard(1);

// List and query cards (saved questions)
$cards = $service->listCards();
$results = $service->queryCard(10);

// Explore databases
$databases = $service->listDatabases();
$db = $service->getDatabase(1);

// Check current user
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
- A [Metabase](https://www.metabase.com) instance (self-hosted or Metabase Cloud)

## License

MIT — see [LICENSE](LICENSE)
