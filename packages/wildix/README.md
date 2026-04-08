# Integration: Wildix

> Wildix PBX integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list calls, extensions, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Wildix unified communications platform. Look up call records, browse PBX extensions, and retrieve user information — all through the Wildix REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Wildix tool lets AI agents query call history, look up extensions, and access user information — giving agents telephony awareness for support and productivity workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wildix
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Wildix API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wildix' => [
        'access_token' => env('WILDIX_ACCESS_TOKEN'),
        'url'          => env('WILDIX_URL', 'https://api.wildix.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wildix_list_calls` | read | List call records with pagination and date filtering |
| `wildix_get_call` | read | Get details of a specific call by ID |
| `wildix_list_extensions` | read | List PBX extensions |
| `wildix_get_extension` | read | Get details of a specific extension by ID |
| `wildix_list_users` | read | List Wildix PBX users |
| `wildix_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\Integrations\Wildix\Tools\WildixListCalls;
use OpenCompany\Integrations\Wildix\Tools\WildixGetCurrentUser;

// Create tools
$service = app(WildixService::class);
$tools = [
    new WildixListCalls($service),
    new WildixGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many calls did we have yesterday?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wildix');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Wildix\Tools\WildixListCalls::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Wildix\WildixService;

$service = app(WildixService::class);

// List recent calls
$calls = $service->listCalls(limit: 10);

// Get a specific call
$call = $service->getCall('call-123');

// List extensions
$extensions = $service->listExtensions();

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
- A [Wildix](https://www.wildix.com) PBX system with API access enabled

## License

MIT — see [LICENSE](LICENSE)
