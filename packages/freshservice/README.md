# Integration: Freshservice

> Freshservice ITSM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tickets, agents, and assets. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to IT service management. Create, update, and delete support tickets; look up agents and their availability; and browse IT assets — all through the [Freshservice](https://freshservice.com) API v2.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshservice tool lets AI agents manage IT support tickets, look up agent details, and query the asset inventory — enabling intelligent triage and automation.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshservice
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Freshservice API key and your account domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshservice' => [
        'api_key' => env('FRESHSERVICE_API_KEY'),
        'domain'  => env('FRESHSERVICE_DOMAIN'), // e.g., "acme" for acme.freshservice.com
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshservice_list_tickets` | read | List support tickets with pagination and filters |
| `freshservice_get_ticket` | read | Get details of a specific ticket |
| `freshservice_create_ticket` | write | Create a new support ticket |
| `freshservice_update_ticket` | write | Update an existing ticket (status, priority, assignee, etc.) |
| `freshservice_delete_ticket` | write | Delete a ticket permanently |
| `freshservice_list_agents` | read | List all agents in the account |
| `freshservice_get_agent` | read | Get details of a specific agent |
| `freshservice_list_assets` | read | List IT assets with pagination |
| `freshservice_get_asset` | read | Get details of a specific asset |
| `freshservice_get_current_user` | read | Get the currently authenticated agent |

## Quick Start

```php
use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceListTickets;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceCreateTicket;

// Create tools
$service = app(FreshserviceService::class);
$tools = [
    new FreshserviceListTickets($service),
    new FreshserviceCreateTicket($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my open tickets and create one for the VPN outage');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshservice');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Freshservice\Tools\FreshserviceListTickets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Freshservice\FreshserviceService;

$service = app(FreshserviceService::class);

// List open tickets
$tickets = $service->listTickets(filter: 'new_and_my_open');

// Get a specific ticket
$ticket = $service->getTicket(42);

// Create a ticket
$ticket = $service->createTicket(
    subject: 'VPN connection issue',
    description: '<p>Cannot connect to VPN. Error 691.</p>',
    email: 'john@example.com',
    priority: 3,
);

// Update a ticket
$service->updateTicket(42, ['status' => 4, 'priority' => 4]);

// Delete a ticket
$service->deleteTicket(42);

// List agents
$agents = $service->listAgents();

// Get current user
$me = $service->getCurrentUser();

// List assets
$assets = $service->listAssets(page: 1);
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
- A [Freshservice](https://freshservice.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
