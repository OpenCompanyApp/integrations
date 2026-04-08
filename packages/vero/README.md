# Integration: Vero

> Vero email marketing integration for the [Laravel AI SDK](https://github.com/laravel/ai) — identify users, track events, manage subscriptions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Vero](https://getvero.com) email marketing. Identify users, track behavioral events, and manage email subscriptions — all through the Vero REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Vero integration lets AI agents manage user identities, trigger behavioral events for automated email campaigns, and control subscription status — enabling data-driven email workflows without manual intervention.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vero
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Vero auth token.

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
| `vero_identify_user` | write | Identify (create or update) a user with email, name, and custom attributes |
| `vero_track_event` | write | Track a behavioral event for a user |
| `vero_update_user` | write | Update a user's email and custom attributes |
| `vero_unsubscribe` | write | Unsubscribe a user from all email campaigns |
| `vero_resubscribe` | write | Resubscribe a user to email campaigns |
| `vero_get_current_user` | read | Get the currently authenticated user's profile |

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
    ->prompt('Create a user in Vero for john@example.com named John Doe');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

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
$service->identifyUser('usr_123', 'john@example.com', 'John Doe', [
    'plan' => 'premium',
    'signup_date' => '2025-01-15',
]);

// Track an event
$service->trackEvent('usr_123', 'Purchased', [
    'product' => 'Widget',
    'price' => 29.99,
]);

// Update user attributes
$service->updateUser('usr_123', '', ['plan' => 'enterprise']);

// Manage subscriptions
$service->unsubscribe('usr_123');
$service->resubscribe('usr_123');

// Get current user
$profile = $service->getCurrentUser();
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
