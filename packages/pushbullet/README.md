# Integration: Pushbullet

> Pushbullet integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send pushes, manage devices, and retrieve user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to send push notifications, list devices, and manage pushes through the [Pushbullet](https://www.pushbullet.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Pushbullet tool lets AI agents send push notifications and manage devices — giving agents the ability to notify users and interact with their devices.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pushbullet
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Pushbullet access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pushbullet' => [
        'access_token' => env('PUSHBULLET_ACCESS_TOKEN'),
        'url'          => env('PUSHBULLET_URL', 'https://api.pushbullet.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pushbullet_list_pushes` | read | List recent pushes (notifications) |
| `pushbullet_create_push` | write | Send a push notification (note or link) |
| `pushbullet_delete_push` | write | Delete a push notification |
| `pushbullet_list_devices` | read | List devices registered with Pushbullet |
| `pushbullet_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreatePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListPushes;

// Create tools
$service = app(PushbulletService::class);
$tools = [
    new PushbulletCreatePush($service),
    new PushbulletListPushes($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a push notification saying "Deploy complete" to all my devices.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pushbullet');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreatePush::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pushbullet\PushbulletService;

$service = app(PushbulletService::class);

// List pushes
$pushes = $service->listPushes(limit: 20);

// Send a note push
$push = $service->createPush('note', 'Hello', 'This is a test notification.');

// Send a link push
$push = $service->createPush('link', 'Check this out', 'Interesting article', ['url' => 'https://example.com']);

// Delete a push
$service->deletePush('ujpah71o0sjpoPriAz');

// List devices
$devices = $service->listDevices();

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
- A [Pushbullet](https://www.pushbullet.com/) account with an access token

## License

MIT — see [LICENSE](LICENSE)
