# Integration: Toggl Track

> Toggl Track integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage time entries, projects, and workspaces. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to time tracking data. List and create time entries, browse projects and workspaces — all through the [Toggl Track](https://toggl.com/track/) API v9.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Toggl Track tool lets AI agents query time tracking data, create entries, and manage projects — giving agents visibility into team productivity and time allocation.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-toggl-track
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Toggl Track API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'toggl-track' => [
        'api_token' => env('TOGGL_TRACK_API_TOKEN'),
        'url'       => env('TOGGL_TRACK_URL', 'https://api.track.toggl.com'),
    ],
];
```

Find your API token at the bottom of your [Toggl Track profile page](https://track.toggl.com/profile).

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `toggl_list_time_entries` | read | List time entries with optional date/workspace/project filters |
| `toggl_get_time_entry` | read | Get details of a specific time entry |
| `toggl_create_time_entry` | write | Create a new time entry |
| `toggl_list_projects` | read | List projects with optional workspace/active filters |
| `toggl_get_project` | read | Get details of a specific project |
| `toggl_list_workspaces` | read | List all workspaces accessible to the user |
| `toggl_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\Integrations\TogglTrack\Tools\TogglListTimeEntries;
use OpenCompany\Integrations\TogglTrack\Tools\TogglCreateTimeEntry;

// Create tools
$service = app(TogglTrackService::class);
$tools = [
    new TogglListTimeEntries($service),
    new TogglCreateTimeEntry($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many hours did I track this week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('toggl-track');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\TogglTrack\Tools\TogglListTimeEntries::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\TogglTrack\TogglTrackService;

$service = app(TogglTrackService::class);

// Get current user
$user = $service->getCurrentUser();

// List workspaces
$workspaces = $service->listWorkspaces();

// List recent time entries
$entries = $service->listTimeEntries([
    'start_date' => '2025-01-01T00:00:00Z',
    'end_date'   => '2025-01-31T23:59:59Z',
]);

// Get a specific time entry
$entry = $service->getTimeEntry(123456789);

// Create a time entry
$newEntry = $service->createTimeEntry([
    'workspace_id' => 12345,
    'description'  => 'Writing documentation',
    'duration'     => 3600,
    'start'        => '2025-01-15T09:00:00Z',
    'pid'          => 67890,
    'tags'         => ['docs', 'client-work'],
    'billable'     => true,
    'created_with' => 'OpenCompany',
]);

// List projects
$projects = $service->listProjects(['active' => 'true']);

// Get a specific project
$project = $service->getProject(67890);
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
- A [Toggl Track](https://toggl.com/track/) account

## License

MIT — see [LICENSE](LICENSE)
