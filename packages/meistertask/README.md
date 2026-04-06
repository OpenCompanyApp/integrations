# Integration: MeisterTask

> MeisterTask integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage projects and tasks via the MeisterTask API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to MeisterTask project management. List and browse projects, create and update tasks, assign work, and track progress — all through the [MeisterTask API](https://developers.meistertask.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MeisterTask integration lets AI agents manage tasks and projects — keeping work coordinated across tools and teams.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-meistertask
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a MeisterTask access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'meistertask' => [
        'access_token' => env('MEISTERTASK_ACCESS_TOKEN'),
        'url'          => env('MEISTERTASK_URL', 'https://www.meistertask.com/api'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `meistertask_list_projects` | read | List all projects you have access to |
| `meistertask_get_project` | read | Get details of a specific project |
| `meistertask_create_task` | write | Create a new task in a project |
| `meistertask_list_tasks` | read | List tasks with optional filters |
| `meistertask_get_task` | read | Get details of a specific task |
| `meistertask_update_task` | write | Update an existing task |
| `meistertask_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskListProjects;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskCreateTask;

// Create tools
$service = app(MeisterTaskService::class);
$tools = [
    new MeisterTaskListProjects($service),
    new MeisterTaskCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my MeisterTask projects and create a task called "Review docs" in the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('meistertask');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskListProjects::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MeisterTask\MeisterTaskService;

$service = app(MeisterTaskService::class);

// List projects
$projects = $service->listProjects();

// Get a project
$project = $service->getProject(12345);

// Create a task
$task = $service->createTask(12345, [
    'name' => 'Review quarterly report',
    'due_date' => '2026-04-30',
    'priority' => 3,
]);

// Update a task
$service->updateTask(67890, ['status' => 'completed']);

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
- A [MeisterTask](https://www.meistertask.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
