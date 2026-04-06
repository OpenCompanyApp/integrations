# Integration: Droplr

> Droplr integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list drops, manage short links, boards, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to link shortening and file sharing. Create short links, browse drops and boards, and manage your Droplr account — all through the [Droplr API](https://droplr.com/docs/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Droplr tool lets AI agents create short links, list and search drops, manage boards, and retrieve user information — giving agents the ability to handle link management tasks autonomously.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-droplr
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Droplr access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'droplr' => [
        'access_token' => env('DROPLR_ACCESS_TOKEN'),
        'url'          => env('DROPLR_URL', 'https://api.droplr.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `droplr_list_drops` | read | List drops (short links, files, images, notes) with filtering |
| `droplr_get_drop` | read | Get details of a specific drop |
| `droplr_create_drop` | write | Create a new short link |
| `droplr_delete_drop` | write | Delete a drop permanently |
| `droplr_list_boards` | read | List boards (collections of drops) |
| `droplr_get_current_user` | read | Get authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\Integrations\Droplr\Tools\DroplrListDrops;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateDrop;

// Create tools
$service = app(DroplrService::class);
$tools = [
    new DroplrListDrops($service),
    new DroplrCreateDrop($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Shorten this URL: https://example.com/very/long/url and list my recent drops');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('droplr');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Droplr\Tools\DroplrCreateDrop::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Droplr\DroplrService;

$service = app(DroplrService::class);

// List drops
$drops = $service->listDrops(page: 1, limit: 20);

// Get a specific drop
$drop = $service->getDrop('abc123');

// Create a short link
$drop = $service->createDrop(
    link: 'https://example.com/very/long/url',
    title: 'My Link',
    variant: 'redirect',
);

// Delete a drop
$service->deleteDrop('abc123');

// List boards
$boards = $service->listBoards(page: 1, limit: 20);

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
- A [Droplr](https://droplr.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
