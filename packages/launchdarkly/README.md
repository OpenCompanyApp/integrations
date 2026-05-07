# Integration: LaunchDarkly

> LaunchDarkly feature-management integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage projects, environments, flags, segments, members, teams, and raw REST API calls. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to LaunchDarkly release management. List flags, check their status, toggle them on or off, manage project and environment configuration, inspect segments and members, and call newer LaunchDarkly REST endpoints as needed.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This LaunchDarkly package lets AI agents inspect feature flag states, toggle flags across environments, manage project configuration, and use LaunchDarkly account APIs with host-controlled credentials.

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

This package exposes 38 tools:

| Area | Tools |
|------|-------|
| Raw API | `launchdarkly_api_get`, `launchdarkly_api_post`, `launchdarkly_api_patch`, `launchdarkly_api_put`, `launchdarkly_api_delete` |
| Projects | `launchdarkly_list_projects`, `launchdarkly_get_project`, `launchdarkly_create_project`, `launchdarkly_update_project`, `launchdarkly_delete_project` |
| Environments | `launchdarkly_list_environments`, `launchdarkly_get_environment`, `launchdarkly_create_environment`, `launchdarkly_update_environment`, `launchdarkly_delete_environment` |
| Feature flags | `launchdarkly_list_flags`, `launchdarkly_get_flag`, `launchdarkly_create_feature_flag`, `launchdarkly_update_feature_flag`, `launchdarkly_toggle_flag`, `launchdarkly_copy_feature_flag`, `launchdarkly_delete_feature_flag` |
| Segments | `launchdarkly_list_segments`, `launchdarkly_get_segment`, `launchdarkly_create_segment`, `launchdarkly_update_segment`, `launchdarkly_delete_segment` |
| Members | `launchdarkly_get_current_user`, `launchdarkly_list_members`, `launchdarkly_get_member`, `launchdarkly_invite_members`, `launchdarkly_update_member`, `launchdarkly_delete_member` |
| Teams | `launchdarkly_list_teams`, `launchdarkly_get_team`, `launchdarkly_create_team`, `launchdarkly_update_team`, `launchdarkly_delete_team` |

The legacy convenience tools return normalized payloads. Endpoint-mapped tools return LaunchDarkly's parsed JSON response directly.

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

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

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

MIT - see [LICENSE](LICENSE)
