# Integration: PagerDuty

> PagerDuty integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage incidents, services, and teams. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your PagerDuty incident management platform. List and inspect incidents, services, and teams — all through the [PagerDuty REST API](https://developer.pagerduty.com/api-reference/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This PagerDuty tool lets AI agents query active incidents, inspect service health, review team membership, and monitor alert states — giving agents real-time visibility into operational status.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pagerduty
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a PagerDuty API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pagerduty' => [
        'api_token' => env('PAGERDUTY_API_TOKEN'),
        'base_url'  => env('PAGERDUTY_BASE_URL', 'https://api.pagerduty.com'),
    ],
];
```

### Generating an API Token

1. In PagerDuty, go to **Developer Tools → API Access Keys**.
2. Create a new API key with appropriate scopes (read-only for listing, read/write for managing incidents).
3. Copy the token and use it as the `api_token`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pagerduty_list_incidents` | read | List incidents with filters |
| `pagerduty_get_incident` | read | Get incident details by ID |
| `pagerduty_list_services` | read | List services with optional team filter |
| `pagerduty_get_service` | read | Get service details by ID |
| `pagerduty_list_teams` | read | List teams |
| `pagerduty_get_team` | read | Get team details by ID |
| `pagerduty_get_current_user` | read | Get authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListIncidents;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetIncident;

// Create tools
$service = app(PagerdutyService::class);
$tools = [
    new PagerdutyListIncidents($service),
    new PagerdutyGetIncident($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all triggered PagerDuty incidents');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pagerduty');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListIncidents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pagerduty\PagerdutyService;

$service = app(PagerdutyService::class);

// List triggered incidents
$incidents = $service->listIncidents('triggered');

// Get a specific incident
$incident = $service->getIncident('Q02JTSZO2VGFBH');

// List services
$services = $service->listServices();

// Get a specific service
$service = $service->getService('PIJ90N7');

// List teams
$teams = $service->listTeams();

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
- A [PagerDuty](https://www.pagerduty.com) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
