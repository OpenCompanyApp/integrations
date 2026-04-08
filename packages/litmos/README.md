# Integration: Litmos

> Litmos LMS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage users, courses, and teams via the Litmos API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Litmos learning management system. List and create users, browse courses, and manage teams — all through the [Litmos API](https://support.litmos.com/hc/en-us/articles/227734727-Litmos-API-v1-0-Documentation).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Litmos tool lets AI agents manage learners, browse training content, and organize teams — bringing LMS data directly into agent workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-litmos
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Litmos API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'litmos' => [
        'api_key' => env('LITMOS_API_KEY'),
        'url'     => env('LITMOS_URL', 'https://api.litmos.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `litmos_list_users` | read | List users with pagination and search |
| `litmos_get_user` | read | Get a specific user by ID |
| `litmos_create_user` | write | Create a new user (first name, last name, email, username) |
| `litmos_list_courses` | read | List courses with pagination and search |
| `litmos_get_course` | read | Get a specific course by ID |
| `litmos_list_teams` | read | List teams with pagination |
| `litmos_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\Integrations\Litmos\Tools\LitmosListUsers;
use OpenCompany\Integrations\Litmos\Tools\LitmosListCourses;

// Create tools
$service = app(LitmosService::class);
$tools = [
    new LitmosListUsers($service),
    new LitmosListCourses($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active users and their assigned courses');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('litmos');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Litmos\Tools\LitmosListUsers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Litmos\LitmosService;

$service = app(LitmosService::class);

// List users
$users = $service->listUsers(limit: 50, page: 1, search: 'john');

// Get a specific user
$user = $service->getUser('abc123');

// Create a user
$newUser = $service->createUser('Jane', 'Doe', 'jane@example.com', 'janedoe');

// List courses
$courses = $service->listCourses(limit: 50, search: 'onboarding');

// Get a course
$course = $service->getCourse('course-456');

// List teams
$teams = $service->listTeams(limit: 50);

// Get current user
$me = $service->getCurrentUser();
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
- A [Litmos](https://www.litmos.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
