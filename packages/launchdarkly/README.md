# Integration: LaunchDarkly

> LaunchDarkly feature flags integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list and toggle flags, manage projects and environments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to feature flag management. List flags, check their status, toggle them on or off, and manage projects and environments — all through the [LaunchDarkly](https://launchdarkly.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This LaunchDarkly tool lets AI agents inspect feature flag states, toggle flags across environments, and manage project configuration — giving agents the ability to control feature rollouts.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-launchdarkly
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a LaunchDarkly API access token and a default project key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'launchdarkly' => [
        'access_token' => env('LAUNCHDARKLY_ACCESS_TOKEN'),
        'project_key'  => env('LAUNCHDARKLY_PROJECT_KEY', 'default'),
        'url'          => env('LAUNCHDARKLY_URL', 'https://app.launchdarkly.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `launchdarkly_list_flags` | read | List feature flags in a project (paginated) |
| `launchdarkly_get_flag` | read | Get details of a specific feature flag |
| `launchdarkly_toggle_flag` | write | Turn a feature flag on or off in an environment |
| `launchdarkly_list_environments` | read | List environments for a project |
| `launchdarkly_list_projects` | read | List all LaunchDarkly projects |
| `launchdarkly_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListFlags;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyToggleFlag;

// Create tools
$service = app(LaunchDarklyService::class);
$tools = [
    new LaunchDarklyListFlags($service),
    new LaunchDarklyToggleFlag($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all feature flags and tell me which ones are enabled in production');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('launchdarkly');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListFlags::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;

$service = app(LaunchDarklyService::class);

// List flags
$flags = $service->listFlags();

// Get a specific flag
$flag = $service->getFlag('enable-new-dashboard');

// Toggle a flag on in production
$result = $service->toggleFlag('enable-new-dashboard', true, 'production');

// List environments
$envs = $service->listEnvironments();

// List projects
$projects = $service->listProjects();

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
- A [LaunchDarkly](https://launchdarkly.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
