# Integration: Nifty

> Nifty project management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list projects, manage tasks, and get user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to project management data. List and view projects, manage tasks, and retrieve user information — all through the [Nifty](https://nifty.co) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Nifty tool lets AI agents interact with project management data — listing projects, creating and querying tasks, and retrieving user information.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-nifty
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Nifty personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'nifty' => [
        'access_token' => env('NIFTY_ACCESS_TOKEN'),
        'url'          => env('NIFTY_API_URL', 'https://api.niftyco.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `nifty_list_projects` | read | List all projects in Nifty |
| `nifty_get_project` | read | Get details of a specific project |
| `nifty_list_tasks` | read | List tasks with optional filters (project, status, assignee) |
| `nifty_get_task` | read | Get details of a specific task |
| `nifty_create_task` | write | Create a new task in a project |
| `nifty_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\Integrations\Nifty\Tools\NiftyListProjects;
use OpenCompany\Integrations\Nifty\Tools\NiftyCreateTask;

// Create tools
$service = app(NiftyService::class);
$tools = [
    new NiftyListProjects($service),
    new NiftyCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Nifty projects and create a task called "Review designs" in the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('nifty');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Nifty\Tools\NiftyListProjects::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Nifty\NiftyService;

$service = app(NiftyService::class);

// List projects
$projects = $service->listProjects();

// Get a specific project
$project = $service->getProject('project-123');

// List tasks in a project
$tasks = $service->listTasks(['project_id' => 'project-123', 'status' => 'open']);

// Create a task
$task = $service->createTask([
    'title' => 'Review designs',
    'project_id' => 'project-123',
    'description' => 'Review the new landing page designs',
    'priority' => 'high',
]);

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
- A [Nifty](https://nifty.co) account with API access

## License

MIT — see [LICENSE](LICENSE)
