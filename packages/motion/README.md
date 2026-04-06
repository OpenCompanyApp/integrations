# Integration: Motion

> Motion API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage tasks, projects, schedules, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Motion's intelligent task management. Create and list tasks, browse projects, view schedules, and get user info — all through the [Motion](https://www.motion.dev) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Motion tool lets AI agents manage tasks, review projects, check schedules, and interact with the Motion workspace — giving agents project management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-motion
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Motion API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'motion' => [
        'access_token' => env('MOTION_ACCESS_TOKEN'),
        'url'          => env('MOTION_URL', 'https://api.usemotion.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `motion_list_tasks` | read | List tasks with filters (status, project, assignee, pagination) |
| `motion_get_task` | read | Get details of a specific task |
| `motion_create_task` | write | Create a new task (auto-scheduled by Motion) |
| `motion_list_projects` | read | List all projects |
| `motion_get_project` | read | Get details of a specific project |
| `motion_list_schedules` | read | List schedules within a date range |
| `motion_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\Integrations\Motion\Tools\MotionListTasks;
use OpenCompany\Integrations\Motion\Tools\MotionCreateTask;

// Create tools
$service = app(MotionService::class);
$tools = [
    new MotionListTasks($service),
    new MotionCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a task called "Review Q1 report" due Friday, then list my tasks');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('motion');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Motion\Tools\MotionListTasks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Motion\MotionService;

$service = app(MotionService::class);

// List tasks
$tasks = $service->listTasks(['status' => 'Todo', 'limit' => 10]);

// Get a specific task
$task = $service->getTask('task_abc123');

// Create a task
$task = $service->createTask([
    'name' => 'Review Q1 report',
    'priority' => 'HIGH',
    'dueDate' => '2025-03-28',
]);

// List projects
$projects = $service->listProjects();

// List schedules
$schedules = $service->listSchedules([
    'startDate' => '2025-01-01',
    'endDate' => '2025-01-31',
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
- A [Motion](https://www.motion.dev) account with API access

## License

MIT — see [LICENSE](LICENSE)
