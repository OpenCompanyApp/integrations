# Integration: Taiga

> Taiga project management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list projects, manage user stories and issues. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Taiga project management. List projects, query user stories and issues, and create new stories — all through the [Taiga REST API](https://docs.taiga.io/api.html).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Taiga tool lets AI agents query project data, manage user stories, and list issues — giving agents visibility into your agile workflow.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-taiga
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Taiga personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'taiga' => [
        'access_token' => env('TAIGA_ACCESS_TOKEN'),
        'url'          => env('TAIGA_URL', 'https://api.taiga.io/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `taiga_list_projects` | read | List all Taiga projects you have access to |
| `taiga_get_project` | read | Get detailed information about a specific project |
| `taiga_list_user_stories` | read | List user stories, optionally filtered by project, status, etc. |
| `taiga_get_user_story` | read | Get detailed information about a specific user story |
| `taiga_create_user_story` | write | Create a new user story in a project |
| `taiga_list_issues` | read | List issues, optionally filtered by project, status, priority, etc. |
| `taiga_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\Integrations\Taiga\Tools\TaigaListProjects;
use OpenCompany\Integrations\Taiga\Tools\TaigaListUserStories;

// Create tools
$service = app(TaigaService::class);
$tools = [
    new TaigaListProjects($service),
    new TaigaListUserStories($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all projects and their open user stories');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('taiga');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Taiga\Tools\TaigaListProjects::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Taiga\TaigaService;

$service = app(TaigaService::class);

// List projects
$projects = $service->listProjects();

// Get a specific project
$project = $service->getProject(123);

// List user stories for a project
$stories = $service->listUserStories(['project' => 123]);

// Get a specific user story
$story = $service->getUserStory(456);

// Create a user story
$newStory = $service->createUserStory([
    'project' => 123,
    'subject' => 'As a user, I want to export reports',
    'description' => 'Users should be able to export reports as PDF.',
]);

// List issues
$issues = $service->listIssues(['project' => 123, 'status' => 'New']);

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
- A [Taiga](https://taiga.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
