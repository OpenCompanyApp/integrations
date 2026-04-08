# Integration: Cursor

> Cursor IDE integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list workspaces, members, and extensions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Cursor workspace management. List workspaces, retrieve workspace details, view team members, and inspect installed extensions — all through the [Cursor](https://cursor.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Cursor tool lets AI agents inspect workspace configuration, review team membership, and audit extensions — giving agents awareness of development environment setup.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-cursor
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Cursor API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'cursor' => [
        'api_key' => env('CURSOR_API_KEY'),
        'url'     => env('CURSOR_API_URL', 'https://api2.cursor.sh'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cursor_list_workspaces` | read | List all Cursor workspaces |
| `cursor_get_workspace` | read | Get details for a specific workspace |
| `cursor_list_team_members` | read | List all members in a workspace |
| `cursor_list_extensions` | read | List all extensions in a workspace |

## Quick Start

```php
use OpenCompany\Integrations\Cursor\CursorService;
use OpenCompany\Integrations\Cursor\Tools\CursorListWorkspaces;
use OpenCompany\Integrations\Cursor\Tools\CursorGetWorkspace;

// Create tools
$service = app(CursorService::class);
$tools = [
    new CursorListWorkspaces($service),
    new CursorGetWorkspace($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Cursor workspaces and show their members.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 4 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('cursor');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Cursor\Tools\CursorListWorkspaces::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Cursor\CursorService;

$service = app(CursorService::class);

// List workspaces
$workspaces = $service->listWorkspaces();

// Get workspace details
$workspace = $service->getWorkspace('ws_abc123');

// List team members
$members = $service->listTeamMembers('ws_abc123');

// List extensions
$extensions = $service->listExtensions('ws_abc123');
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
- A [Cursor](https://cursor.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
