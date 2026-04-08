# Integration: Podio

> Podio integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage workspaces, apps, and items. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Podio workspace. Browse organizations, explore apps and their data structures, and query items — all through the [Podio API](https://developers.podio.com).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Podio tool lets AI agents navigate workspaces, inspect app structures, and retrieve item data — enabling agents to work with your team's structured data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-podio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Podio OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'podio' => [
        'access_token' => env('PODIO_ACCESS_TOKEN'),
        'url'          => env('PODIO_API_URL', 'https://api.podio.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `podio_list_spaces` | read | List all workspaces in a Podio organization |
| `podio_get_space` | read | Get details of a specific workspace |
| `podio_list_apps` | read | List all apps in a workspace |
| `podio_get_app` | read | Get app details including field definitions |
| `podio_list_items` | read | List and filter items in an app |
| `podio_get_item` | read | Get details of a specific item |
| `podio_get_current_user` | read | Get the authenticated user's status |

## Quick Start

```php
use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\Integrations\Podio\Tools\PodioListSpaces;
use OpenCompany\Integrations\Podio\Tools\PodioListItems;

// Create tools
$service = app(PodioService::class);
$tools = [
    new PodioListSpaces($service),
    new PodioListItems($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all workspaces in my Podio org 12345');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('podio');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Podio\Tools\PodioListItems::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Podio\PodioService;

$service = app(PodioService::class);

// List spaces in an organization
$spaces = $service->listSpaces(12345);

// Get space details
$space = $service->getSpace(67890);

// List apps in a space
$apps = $service->listApps(67890);

// Get app with field definitions
$app = $service->getApp(11111);

// List items with filters
$items = $service->listItems(11111, [
    'limit' => 50,
    'sort_by' => 'created_on',
    'sort_desc' => true,
]);

// Get a single item
$item = $service->getItem(22222);

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
- A [Podio](https://podio.com) account with OAuth2 API access

## License

MIT — see [LICENSE](LICENSE)
