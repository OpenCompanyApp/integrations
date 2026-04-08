# Integration: Accelo

> Accelo integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tickets, tasks, and projects. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to professional services automation. List and create tickets, manage tasks, and browse projects — all through the [Accelo](https://www.accelo.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Accelo tool lets AI agents manage support tickets, track tasks, and view project status — giving agents visibility into service operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-accelo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Accelo access token and deployment name.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'accelo' => [
        'access_token' => env('ACCELO_ACCESS_TOKEN'),
        'deployment'   => env('ACCELO_DEPLOYMENT'), // e.g. "mycompany"
        'url'          => env('ACCELO_URL', ''),     // optional override
    ],
];
```

The base URL is constructed as `https://{deployment}.accelo.com`. You can override this by providing the `url` config key.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `accelo_list_tickets` | read | List support tickets with pagination and status filter |
| `accelo_get_ticket` | read | Get details of a specific ticket by ID |
| `accelo_create_ticket` | write | Create a new support ticket |
| `accelo_list_tasks` | read | List tasks with pagination and status filter |
| `accelo_get_task` | read | Get details of a specific task by ID |
| `accelo_list_projects` | read | List projects with pagination and status filter |
| `accelo_get_current_user` | read | Get the currently authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTickets;
use OpenCompany\Integrations\Accelo\Tools\AcceloCreateTicket;

// Create tools
$service = app(AcceloService::class);
$tools = [
    new AcceloListTickets($service),
    new AcceloCreateTicket($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all open tickets in Accelo');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('accelo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Accelo\Tools\AcceloListTickets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Accelo\AcceloService;

$service = app(AcceloService::class);

// List open tickets
$tickets = $service->listTickets(25, 1, 'open');

// Get a specific ticket
$ticket = $service->getTicket(12345);

// Create a ticket
$ticket = $service->createTicket(
    title: 'Login issue',
    body: 'User cannot log in to the portal.',
    contractId: 100,
    priority: 3,
);

// List tasks
$tasks = $service->listTasks(25, 1, 'in_progress');

// Get a specific task
$task = $service->getTask(67890);

// List projects
$projects = $service->listProjects(25, 1);

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
- An [Accelo](https://www.accelo.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
