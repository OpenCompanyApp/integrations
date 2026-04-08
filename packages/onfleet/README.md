# Integration: Onfleet

> Onfleet delivery management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tasks, workers, teams, and recipients. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to last-mile delivery management. Create and track delivery tasks, manage drivers, view teams, and look up recipients — all through the [Onfleet](https://onfleet.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Onfleet tool lets AI agents manage delivery operations — creating tasks, tracking shipments, coordinating drivers, and monitoring fleet activity — giving agents operational awareness of logistics workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-onfleet
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Onfleet API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'onfleet' => [
        'api_key' => env('ONFLEET_API_KEY'),
        'url'     => env('ONFLEET_URL', 'https://onfleet.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `onfleet_list_tasks` | read | List delivery tasks with filters (state, worker, team, time range) |
| `onfleet_get_task` | read | Get detailed info about a specific task |
| `onfleet_create_task` | write | Create a new delivery task |
| `onfleet_update_task` | write | Update an existing task |
| `onfleet_delete_task` | write | Delete a task |
| `onfleet_list_workers` | read | List all workers (drivers) |
| `onfleet_list_teams` | read | List all teams |
| `onfleet_list_recipients` | read | List/search recipients |
| `onfleet_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetListTasks;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetCreateTask;

// Create tools
$service = app(OnfleetService::class);
$tools = [
    new OnfleetListTasks($service),
    new OnfleetCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a delivery to 456 Oak Ave for John Smith and show all unassigned tasks');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('onfleet');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Onfleet\Tools\OnfleetListTasks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Onfleet\OnfleetService;

$service = app(OnfleetService::class);

// List unassigned tasks
$tasks = $service->listTasks(['state' => 0]);

// Get a specific task
$task = $service->getTask('TASK_ID');

// Create a task
$task = $service->createTask([
    'destination' => ['address' => ['unparsed' => '123 Main St, SF, CA']],
    'recipients' => [['name' => 'Jane Doe', 'phone' => '+14155551234']],
    'notes' => 'Leave at door',
]);

// Update a task
$service->updateTask('TASK_ID', ['notes' => 'Ring doorbell']);

// Delete a task
$service->deleteTask('TASK_ID');

// List workers
$workers = $service->listWorkers();

// List teams
$teams = $service->listTeams();

// List recipients
$recipients = $service->listRecipients(['name' => 'Jane']);

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

Onfleet uses HTTP Basic Authentication. The API key is passed as the username with an empty password. This integration handles that automatically — just provide your API key in the configuration.

Find your API key in Onfleet under **Settings > API & Webhooks**.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- An [Onfleet](https://onfleet.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
