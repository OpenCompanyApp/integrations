# Integration: Teamwork

> Teamwork project management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage projects, tasks, teams, and time entries. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Teamwork project management. Create and manage projects and tasks, track time, coordinate teams — all through the [Teamwork](https://teamwork.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Teamwork tool lets AI agents manage projects, track task progress, log time, and coordinate team work — giving agents direct access to your project management workflow.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-teamwork
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Teamwork API key and your Teamwork hostname.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'teamwork' => [
        'api_key'  => env('TEAMWORK_API_KEY'),
        'hostname' => env('TEAMWORK_HOSTNAME', 'yourcompany.teamwork.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `teamwork_list_projects` | read | List all projects |
| `teamwork_get_project` | read | Get details of a specific project |
| `teamwork_create_project` | write | Create a new project |
| `teamwork_list_tasks` | read | List tasks in a project |
| `teamwork_get_task` | read | Get details of a specific task |
| `teamwork_create_task` | write | Create a new task in a project |
| `teamwork_update_task` | write | Update an existing task |
| `teamwork_complete_task` | write | Mark a task as complete |
| `teamwork_list_teams` | read | List all teams |
| `teamwork_get_team` | read | Get details of a specific team |
| `teamwork_list_time_entries` | read | List time entries for a project |
| `teamwork_create_time_entry` | write | Log time against a project |
| `teamwork_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListProjects;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCreateTask;

// Create tools
$service = app(TeamworkService::class);
$tools = [
    new TeamworkListProjects($service),
    new TeamworkCreateTask($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a task called "Review designs" in project 12345');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 13 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('teamwork');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Teamwork\Tools\TeamworkListProjects::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Teamwork\TeamworkService;

$service = app(TeamworkService::class);

// List projects
$projects = $service->listProjects(['status' => 'active']);

// Create a project
$project = $service->createProject([
    'name' => 'Website Redesign',
    'description' => 'Q2 redesign initiative',
]);

// List tasks
$tasks = $service->listTasks(12345);

// Create a task
$task = $service->createTask(12345, [
    'name' => 'Design homepage',
    'description' => 'Create high-fidelity mockup',
]);

// Complete a task
$service->completeTask(67890);

// Log time
$entry = $service->createTimeEntry(12345, [
    'date' => '2026-04-05',
    'hours' => 3.5,
    'description' => 'Implemented auth flow',
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
- A [Teamwork](https://teamwork.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
