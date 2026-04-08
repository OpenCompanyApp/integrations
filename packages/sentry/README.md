# Integration: Sentry

> Sentry integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list projects, issues, releases, and manage errors. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to application error monitoring. View issues, inspect stacktraces, track releases, and create new error reports — all through the [Sentry](https://sentry.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Sentry integration lets AI agents monitor application errors, inspect stacktraces, review releases, and report new issues — giving agents real-time awareness of application health.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-sentry
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Sentry auth token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'sentry' => [
        'auth_token' => env('SENTRY_AUTH_TOKEN'),
        'url'        => env('SENTRY_URL', 'https://sentry.io/api/0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `sentry_list_projects` | read | List all Sentry projects accessible to the authenticated user |
| `sentry_get_project` | read | Get details for a specific Sentry project |
| `sentry_list_issues` | read | List issues (errors) for a Sentry project |
| `sentry_get_issue` | read | Get details for a specific Sentry issue |
| `sentry_list_releases` | read | List releases for a Sentry project |
| `sentry_create_issue` | write | Create a new issue (user report) in a Sentry project |
| `sentry_get_current_user` | read | Get the currently authenticated Sentry user |

## Quick Start

```php
use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\Integrations\Sentry\Tools\SentryListProjects;
use OpenCompany\Integrations\Sentry\Tools\SentryListIssues;

// Create tools
$service = app(SentryService::class);
$tools = [
    new SentryListProjects($service),
    new SentryListIssues($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top 5 unresolved errors in the production project?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('sentry');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Sentry\Tools\SentryListIssues::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Sentry\SentryService;

$service = app(SentryService::class);

// List projects
$projects = $service->listProjects();

// Get a specific project
$project = $service->getProject('my-org', 'my-project');

// List issues
$issues = $service->listIssues('my-org', 'my-project', [
    'query' => 'is:unresolved level:error',
    'sort' => 'freq',
    'limit' => 10,
]);

// Get issue details
$issue = $service->getIssue('1234567890');

// List releases
$releases = $service->listReleases('my-org', 'my-project');

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
- A [Sentry](https://sentry.io) account with an auth token

## License

MIT — see [LICENSE](LICENSE)
