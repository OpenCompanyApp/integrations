# Integration: Datadog

> Datadog integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage monitors, query metrics, view dashboards, and post events. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to infrastructure and application monitoring. Manage alert monitors, query time-series metrics, view dashboards, and post events — all through the [Datadog](https://www.datadoghq.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Datadog tool lets AI agents monitor infrastructure health, manage alerting rules, query metrics, and post status events — giving agents real-time awareness of system state.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-datadog
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Datadog API key and Application key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'datadog' => [
        'api_key' => env('DD_API_KEY'),
        'app_key' => env('DD_APP_KEY'),
        'site'    => env('DD_SITE', 'us'),  // "us" or "eu"
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `datadog_list_monitors` | read | List monitors with optional filtering by name or tags |
| `datadog_get_monitor` | read | Get details of a specific monitor |
| `datadog_create_monitor` | write | Create a new monitor with query and alert options |
| `datadog_update_monitor` | write | Update an existing monitor |
| `datadog_delete_monitor` | write | Delete a monitor |
| `datadog_query_metrics` | read | Query time-series metrics |
| `datadog_list_dashboards` | read | List all dashboards |
| `datadog_get_dashboard` | read | Get details of a specific dashboard |
| `datadog_post_event` | write | Post an event to the event stream |
| `datadog_get_current_user` | read | Get the authenticated user (verify credentials) |

## Quick Start

```php
use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\Integrations\Datadog\Tools\DatadogListMonitors;

// Create tools
$service = app(DatadogService::class);
$tools = [
    new DatadogListMonitors($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all monitors that are currently alerting');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('datadog');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Datadog\Tools\DatadogListMonitors::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Datadog\DatadogService;

$service = app(DatadogService::class);

// List monitors
$monitors = $service->listMonitors(['tags' => 'env:production']);

// Query metrics
$metrics = $service->queryMetrics(
    from: time() - 3600,
    to: time(),
    query: 'avg:system.cpu.user{env:production} by {host}'
);

// List dashboards
$dashboards = $service->listDashboards();

// Post an event
$service->postEvent([
    'title' => 'Deployment completed',
    'text' => 'Version 2.1.0 deployed to production',
    'priority' => 'normal',
    'tags' => ['env:production', 'source:deploy'],
    'alert_type' => 'success',
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
- A [Datadog](https://www.datadoghq.com/) account with API and Application keys

## License

MIT — see [LICENSE](LICENSE)
