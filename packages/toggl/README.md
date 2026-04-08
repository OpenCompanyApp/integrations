# Integration: Toggl Track

> Toggl Track integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage workspaces, projects, and time entries. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to time tracking. List workspaces and projects, create and manage time entries, and query tracked time — all through the [Toggl Track](https://toggl.com/track/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Toggl Track tool lets AI agents manage time entries, create projects, and track work — enabling automated time tracking as part of your team's workflow.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-toggl
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Toggl Track API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'toggl' => [
        'api_token' => env('TOGGL_API_TOKEN'),
        'url'       => env('TOGGL_API_URL', 'https://api.track.toggl.com/api/v9'),
    ],
];
```

Find your API token at the bottom of your [Toggl Profile Settings](https://track.toggl.com/profile) page.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `toggl_get_current_user` | read | Get the authenticated user profile |
| `toggl_list_workspaces` | read | List all workspaces the user has access to |
| `toggl_list_projects` | read | List projects in a workspace |
| `toggl_create_project` | write | Create a new project in a workspace |
| `toggl_list_time_entries` | read | List time entries for the authenticated user |
| `toggl_create_time_entry` | write | Create a new time entry |
| `toggl_update_time_entry` | write | Update an existing time entry |
| `toggl_delete_time_entry` | write | Delete a time entry |

## Quick Start

```php
use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\Integrations\Toggl\Tools\TogglListTimeEntries;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateTimeEntry;

// Create tools
$service = app(TogglService::class);
$tools = [
    new TogglListTimeEntries($service),
    new TogglCreateTimeEntry($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How much time did I track yesterday?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('toggl');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Toggl\Tools\TogglListTimeEntries::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Toggl\TogglService;

$service = app(TogglService::class);

// Get user profile
$user = $service->getCurrentUser();

// List workspaces
$workspaces = $service->listWorkspaces();

// List projects
$projects = $service->listProjects($workspaceId);

// Create a project
$project = $service->createProject($workspaceId, [
    'name' => 'Website Redesign',
    'color' => '#0b83d9',
    'billable' => true,
]);

// List time entries
$entries = $service->listTimeEntries('2026-04-01', '2026-04-05');

// Create a time entry
$entry = $service->createTimeEntry($workspaceId, [
    'description' => 'Working on API integration',
    'start' => '2026-04-05T09:00:00Z',
    'duration' => 3600,
    'project_id' => $projectId,
    'billable' => true,
]);

// Update a time entry
$updated = $service->updateTimeEntry($workspaceId, $entryId, [
    'description' => 'Updated description',
    'stop' => '2026-04-05T10:30:00Z',
]);

// Delete a time entry
$service->deleteTimeEntry($workspaceId, $entryId);
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
- A [Toggl Track](https://toggl.com/track/) account with API access

## License

MIT — see [LICENSE](LICENSE)
