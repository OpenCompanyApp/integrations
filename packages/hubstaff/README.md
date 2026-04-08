# Integration: Hubstaff

> Hubstaff integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list time entries, manage projects, and view organizations. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to time tracking and productivity data. List and create time entries, browse projects, and view organization details — all through the [Hubstaff](https://hubstaff.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Hubstaff tool lets AI agents query time tracking data, log manual time entries, and browse project information — giving agents visibility into team productivity and work patterns.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-hubstaff
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Hubstaff personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'hubstaff' => [
        'access_token' => env('HUBSTAFF_ACCESS_TOKEN'),
        'url'          => env('HUBSTAFF_URL', 'https://api.hubstaff.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `hubstaff_list_time_entries` | read | List time entries with date range, user, and project filters |
| `hubstaff_get_time_entry` | read | Get details for a specific time entry |
| `hubstaff_create_time_entry` | write | Create a manual time entry for a project |
| `hubstaff_list_projects` | read | List projects with optional status filter |
| `hubstaff_get_project` | read | Get details for a specific project |
| `hubstaff_list_organizations` | read | List organizations the user belongs to |
| `hubstaff_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffListTimeEntries;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffListProjects;

// Create tools
$service = app(HubstaffService::class);
$tools = [
    new HubstaffListTimeEntries($service),
    new HubstaffListProjects($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many hours were tracked this week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('hubstaff');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Hubstaff\Tools\HubstaffListTimeEntries::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Hubstaff\HubstaffService;

$service = app(HubstaffService::class);

// List time entries for a date range
$entries = $service->listTimeEntries([
    'startTime' => '2026-04-01T00:00:00Z',
    'endTime'   => '2026-04-06T23:59:59Z',
    'limit'     => 50,
]);

// Get a specific time entry
$entry = $service->getTimeEntry(12345);

// Create a time entry
$entry = $service->createTimeEntry([
    'project_id' => 100,
    'date'       => '2026-04-06',
    'duration'   => 3600,
    'notes'      => 'Code review and bug fixes',
]);

// List projects
$projects = $service->listProjects(['status' => 'active']);

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
- A [Hubstaff](https://hubstaff.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
