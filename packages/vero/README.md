# Integration: Vero

> Vero integration for the [Laravel AI SDK](https://github.com/laravel/ai) — identify users, track events, update profiles, and manage tags. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Vero](https://getvero.com) customer engagement platform. Identify users, track behavioral events, update user profiles, and manage tags for segmentation — all through the Vero REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Vero tool lets AI agents manage customer profiles, track engagement events, and apply tags for audience segmentation — enabling data-driven, personalized communication workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vero
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Vero auth token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'vero' => [
        'auth_token' => env('VERO_AUTH_TOKEN'),
        'url'        => env('VERO_URL', 'https://api.getvero.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vero_identify_user` | write | Identify or create a user with profile attributes |
| `vero_track_event` | write | Track a custom event for a user |
| `vero_update_user` | write | Update a user's profile attributes |
| `vero_add_tag` | write | Add tags to a user for segmentation |
| `vero_remove_tag` | write | Remove tags from a user |

## Quick Start

```php
use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;

// Create tools
$service = app(VeroService::class);
$tools = [
    new VeroIdentifyUser($service),
    new VeroTrackEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Identify user jane@example.com and track a "Signed Up" event for them.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('vero');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Vero\Tools\VeroIdentifyUser::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Vero\VeroService;

$service = app(VeroService::class);

// Identify a user
$service->identifyUser('user_123', 'jane@example.com', 'Jane Doe', [
    'plan' => 'pro',
]);

// Track an event
$service->trackEvent('user_123', 'Purchase Completed', [
    'amount' => 49.99,
]);

// Update a user
$service->updateUser('user_123', ['plan' => 'enterprise']);

// Manage tags
$service->addTag('user_123', ['VIP', 'Newsletter']);
$service->removeTag('user_123', ['Trial']);
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
- A [Vero](https://getvero.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
