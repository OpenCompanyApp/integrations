# Integration: Google Tasks

> Google Tasks integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage task lists and tasks via the Google Tasks API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to task management. List, create, and inspect task lists and tasks — all through the [Google Tasks API](https://developers.google.com/tasks/reference/rest).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Tasks integration lets AI agents manage task lists and individual tasks — giving agents the ability to create, list, and inspect tasks on behalf of users.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-tasks
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Google OAuth 2.0 access token with the `https://www.googleapis.com/auth/tasks` scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-tasks' => [
        'access_token' => env('GOOGLE_TASKS_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_TASKS_URL', 'https://tasks.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gtasks_list_task_lists` | read | List all task lists for the authenticated user |
| `gtasks_get_task_list` | read | Get a specific task list by ID |
| `gtasks_create_task_list` | write | Create a new task list |
| `gtasks_list_tasks` | read | List tasks in a task list |
| `gtasks_get_task` | read | Get a specific task by ID |
| `gtasks_create_task` | write | Create a new task in a task list |
| `gtasks_get_current_user` | read | Get the authenticated user's information |

## Quick Start

```php
use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksListTaskLists;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksCreateTask;

// Create tools
$service = app(GoogleTasksService::class);
$tools = [
    new GoogleTasksListTaskLists($service),
    new GoogleTasksCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a task "Review pull request" in my default task list due tomorrow');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-tasks');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksListTaskLists::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;

$service = app(GoogleTasksService::class);

// List task lists
$lists = $service->listTaskLists();

// Get a specific task list
$list = $service->getTaskList('taskListId');

// Create a task list
$newList = $service->createTaskList('Work Projects');

// List tasks in a task list
$tasks = $service->listTasks('taskListId', maxResults: 10);

// Get a specific task
$task = $service->getTask('taskListId', 'taskId');

// Create a task
$task = $service->createTask(
    'taskListId',
    'Buy groceries',
    notes: 'Milk, eggs, bread',
    due: '2026-04-30T00:00:00.000Z',
);

// Get current user info
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
- A Google account with OAuth 2.0 access token (tasks scope)

## License

MIT — see [LICENSE](LICENSE)
