# Integration: Kimai

> Kimai time-tracking integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage timesheets, projects, and customers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Kimai](https://www.kimai.org), the open-source time-tracker. List and create timesheet entries, browse projects and customers — all through the Kimai REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Kimai tool lets AI agents query timesheets, log time entries, and browse project structures — giving agents awareness of team activity and the ability to track work automatically.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-kimai
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Kimai API token and the base URL of your Kimai instance.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'kimai' => [
        'access_token' => env('KIMAI_ACCESS_TOKEN'),
        'url'          => env('KIMAI_URL', 'https://kimai.example.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `kimai_list_timesheets` | read | List time-tracking entries with filters (user, project, date range, state) |
| `kimai_get_timesheet` | read | Get details of a specific timesheet entry |
| `kimai_create_timesheet` | write | Create a new time-tracking entry |
| `kimai_list_projects` | read | List projects with filters (customer, visibility) |
| `kimai_get_project` | read | Get details of a specific project |
| `kimai_list_customers` | read | List customers with visibility filter |
| `kimai_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\Integrations\Kimai\Tools\KimaiListTimesheets;
use OpenCompany\Integrations\Kimai\Tools\KimaiCreateTimesheet;

// Create tools
$service = app(KimaiService::class);
$tools = [
    new KimaiListTimesheets($service),
    new KimaiCreateTimesheet($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many hours did I track last week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('kimai');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Kimai\Tools\KimaiListTimesheets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Kimai\KimaiService;

$service = app(KimaiService::class);

// List timesheets
$timesheets = $service->listTimesheets([
    'begin' => '2025-01-01T00:00:00',
    'end' => '2025-01-31T23:59:59',
]);

// Create a timesheet entry
$entry = $service->createTimesheet([
    'begin' => '2025-01-15T09:00:00',
    'end' => '2025-01-15T17:00:00',
    'project' => 3,
    'activity' => 7,
    'description' => 'Implementing login feature',
]);

// List projects
$projects = $service->listProjects(['customer' => 2]);

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
- A [Kimai](https://www.kimai.org) instance with API access enabled

## License

MIT — see [LICENSE](LICENSE)
