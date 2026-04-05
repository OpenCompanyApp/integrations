# Integration: Atlassian Statuspage

> Atlassian Statuspage integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage incidents, components, and status updates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to manage service status and incidents. Create, update, and resolve incidents, list components, and verify API access — all through the [Atlassian Statuspage API](https://developer.statuspage.io/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Statuspage tool lets AI agents create and manage service incidents, update component statuses, and monitor service health — giving agents the ability to communicate service status to stakeholders automatically.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-statuspage
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Atlassian Statuspage API key and Page ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'statuspage' => [
        'api_key' => env('STATUSPAGE_API_KEY'),
        'page_id' => env('STATUSPAGE_PAGE_ID'),
        'url'     => env('STATUSPAGE_URL', 'https://api.statuspage.io/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `statuspage_list_incidents` | read | List all incidents for your Statuspage |
| `statuspage_create_incident` | write | Create a new incident |
| `statuspage_update_incident` | write | Update an existing incident |
| `statuspage_list_components` | read | List all components on your Statuspage |
| `statuspage_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Statuspage\StatuspageService;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListIncidents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageCreateIncident;

// Create tools
$service = app(StatuspageService::class);
$tools = [
    new StatuspageListIncidents($service),
    new StatuspageCreateIncident($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all open incidents on our status page');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('statuspage');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Statuspage\Tools\StatuspageCreateIncident::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Statuspage\StatuspageService;

$service = app(StatuspageService::class);

// List incidents
$incidents = $service->listIncidents();

// Create an incident
$incident = $service->createIncident([
    'name' => 'API Latency in EU Region',
    'status' => 'investigating',
    'impact' => 'major',
    'body' => 'We are investigating increased API latency in the EU region.',
]);

// Update an incident
$service->updateIncident($incident['id'], [
    'status' => 'resolved',
    'body' => 'The issue has been resolved.',
]);

// List components
$components = $service->listComponents();

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
- An [Atlassian Statuspage](https://www.statuspage.io/) account with API access

## License

MIT — see [LICENSE](LICENSE)
