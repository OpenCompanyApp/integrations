# Integration: Microsoft To Do

> Microsoft To Do integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage task lists and tasks via the Microsoft Graph API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Microsoft To Do. List and create task lists, manage tasks with titles, bodies, and due dates — all through the [Microsoft Graph API](https://learn.microsoft.com/en-us/graph/api/resources/todo-overview).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Microsoft To Do tool lets AI agents manage personal and shared task lists, create tasks with due dates, and look up user information — giving agents the ability to help users stay organized.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-microsoft-todo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Microsoft Graph OAuth2 access token with `Tasks.ReadWrite` and `User.Read` scopes.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'microsoft_todo' => [
        'access_token' => env('MICROSOFT_TODO_ACCESS_TOKEN'),
        'url'          => env('MICROSOFT_GRAPH_URL', 'https://graph.microsoft.com/v1.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `todo_list_lists` | read | List all Microsoft To Do task lists |
| `todo_get_list` | read | Get a specific task list by ID |
| `todo_create_list` | write | Create a new task list |
| `todo_list_tasks` | read | List all tasks in a task list |
| `todo_get_task` | read | Get a specific task by ID |
| `todo_create_task` | write | Create a new task (title, body, due date) |
| `todo_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListLists;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoCreateTask;

// Create tools
$service = app(MicrosoftTodoService::class);
$tools = [
    new TodoListLists($service),
    new TodoCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a task "Review PR" in my Work list due next Friday');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('microsoft_todo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListLists::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;

$service = app(MicrosoftTodoService::class);

// List all task lists
$lists = $service->listLists();

// Create a new list
$list = $service->createList('Work Tasks');

// List tasks in a list
$tasks = $service->listTasks($list['id']);

// Create a task with a due date
$task = $service->createTask(
    listId: $list['id'],
    title: 'Review pull request',
    body: 'Check the new authentication module',
    dueDateTime: ['dateTime' => '2026-04-30T17:00:00', 'timeZone' => 'UTC'],
);

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
- A [Microsoft 365](https://www.microsoft.com/en-us/microsoft-365) account with To Do access
- OAuth2 access token with `Tasks.ReadWrite` and `User.Read` scopes

## License

MIT — see [LICENSE](LICENSE)
