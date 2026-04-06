# Integration: Basecamp 3

> Basecamp 3 integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage projects, to-dos, and messages. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Basecamp project management. List projects, manage to-dos, read messages, and look up user profiles — all through the [Basecamp 3 API](https://github.com/basecamp/api/blob/master/README.md).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Basecamp tool lets AI agents read and manage projects, create and track to-dos, and read messages — giving agents project management awareness and the ability to act on tasks.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-basecamp
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Basecamp OAuth access token and account ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'basecamp' => [
        'access_token' => env('BASECAMP_ACCESS_TOKEN'),
        'account_id'   => env('BASECAMP_ACCOUNT_ID'),
        'url'          => env('BASECAMP_URL', 'https://3.basecampapi.com'),
    ],
];
```

The API base URL is constructed as `https://3.basecampapi.com/{account_id}`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `basecamp_list_projects` | read | List all Basecamp projects |
| `basecamp_get_project` | read | Get details for a single project |
| `basecamp_list_todos` | read | List to-dos in a specific to-do list |
| `basecamp_create_todo` | write | Create a new to-do in a to-do list |
| `basecamp_list_messages` | read | List messages for a project |
| `basecamp_get_message` | read | Get a single message from a project |
| `basecamp_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\Integrations\Basecamp\Tools\BasecampListProjects;
use OpenCompany\Integrations\Basecamp\Tools\BasecampCreateTodo;

// Create tools
$service = app(BasecampService::class);
$tools = [
    new BasecampListProjects($service),
    new BasecampCreateTodo($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Basecamp projects and create a to-do in project 12345');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('basecamp');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Basecamp\Tools\BasecampListProjects::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Basecamp\BasecampService;

$service = app(BasecampService::class);

// List projects
$projects = $service->listProjects();

// Get a project
$project = $service->getProject(12345);

// List to-dos (requires todoset_id and todolist_id from the project)
$todos = $service->listTodos(12345, 67890, 11111);

// Create a to-do
$todo = $service->createTodo(
    projectId: 12345,
    todosetId: 67890,
    todolistId: 11111,
    content: 'Review pull request',
    description: 'Check the latest PR',
    dueOn: '2026-04-30',
    assigneeIds: [1234, 5678],
);

// List messages
$messages = $service->listMessages(12345);

// Get a single message
$message = $service->getMessage(12345, 99999);

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
- A [Basecamp 3](https://basecamp.com) account with OAuth API access

## License

MIT — see [LICENSE](LICENSE)
