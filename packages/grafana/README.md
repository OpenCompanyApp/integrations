# Integration: Grafana

> Grafana integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage dashboards, datasources, teams, users, and alerts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Grafana observability platform. List and create dashboards, inspect datasources, manage teams and users, and monitor alerts — all through the [Grafana HTTP API](https://grafana.com/docs/grafana/latest/developers/http_api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Grafana tool lets AI agents query dashboards, inspect datasources, review team membership, and monitor alert states — giving agents real-time visibility into infrastructure and application health.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-grafana
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Grafana API token and your instance hostname.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'grafana' => [
        'api_token' => env('GRAFANA_API_TOKEN'),
        'hostname'  => env('GRAFANA_HOSTNAME', 'grafana.example.com'),
    ],
];
```

### Generating an API Token

1. In Grafana, go to **Configuration → Service Accounts** (or **API Keys** on older versions).
2. Create a Service Account with appropriate permissions.
3. Generate a token and use it as the `api_token`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `grafana_list_dashboards` | read | Search and list dashboards |
| `grafana_get_dashboard` | read | Get a dashboard by UID |
| `grafana_create_dashboard` | write | Create or update a dashboard |
| `grafana_list_datasources` | read | List all configured datasources |
| `grafana_get_datasource` | read | Get a datasource by ID |
| `grafana_list_teams` | read | List all teams with pagination |
| `grafana_get_team` | read | Get a team by ID |
| `grafana_list_users` | read | List organization users |
| `grafana_list_alerts` | read | List alerts with optional filters |
| `grafana_get_current_user` | read | Get current org info (verify auth) |

## Quick Start

```php
use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDashboards;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetDashboard;

// Create tools
$service = app(GrafanaService::class);
$tools = [
    new GrafanaListDashboards($service),
    new GrafanaGetDashboard($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all Grafana dashboards');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('grafana');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Grafana\Tools\GrafanaListDashboards::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Grafana\GrafanaService;

$service = app(GrafanaService::class);

// List dashboards
$dashboards = $service->listDashboards();

// Get a specific dashboard
$dashboard = $service->getDashboard('abc123uid');

// Create a dashboard
$result = $service->createDashboard([
    'title' => 'My Dashboard',
    'panels' => [],
]);

// List datasources
$datasources = $service->listDatasources();

// List teams
$teams = $service->listTeams();

// List org users
$users = $service->listUsers();

// List alerts
$alerts = $service->listAlerts();

// Get org info
$org = $service->getOrg();
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
- A [Grafana](https://grafana.com) instance with API access enabled

## License

MIT — see [LICENSE](LICENSE)
