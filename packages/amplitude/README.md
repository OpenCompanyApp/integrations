# Integration: Amplitude

> Amplitude Analytics integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list events, users, properties, and groups. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to product analytics. Query events, look up user profiles, discover properties, and search groups — all through the [Amplitude](https://amplitude.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Amplitude tool lets AI agents query user behavior data, inspect event streams, and look up user profiles — giving agents data-driven awareness of product usage.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-amplitude
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Amplitude API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'amplitude' => [
        'api_key' => env('AMPLITUDE_API_KEY'),
        'url'     => env('AMPLITUDE_URL', 'https://amplitude.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `amplitude_list_events` | read | List events, optionally filtered by user, device, or time range |
| `amplitude_get_event` | read | Retrieve a single event by ID |
| `amplitude_list_users` | read | Search for users by query string |
| `amplitude_get_user` | read | Retrieve a user profile by user ID or device ID |
| `amplitude_list_properties` | read | List available event or user properties |
| `amplitude_list_groups` | read | Search for groups by query string |
| `amplitude_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListEvents;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetUser;

// Create tools
$service = app(AmplitudeService::class);
$tools = [
    new AmplitudeListEvents($service),
    new AmplitudeGetUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What events did user john@example.com trigger last week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('amplitude');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Amplitude\Tools\AmplitudeListEvents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Amplitude\AmplitudeService;

$service = app(AmplitudeService::class);

// List events
$events = $service->listEvents(
    userId: 'user_123',
    start: '2025-01-01T00:00:00Z',
    end: '2025-01-31T23:59:59Z',
    limit: 50,
);

// Get a single event
$event = $service->getEvent(12345);

// Search users
$users = $service->listUsers('john@example.com', limit: 10);

// Get user profile
$profile = $service->getUser(userId: 'user_123');

// List event properties
$properties = $service->listProperties('event');

// Search groups
$groups = $service->listGroups('Enterprise', limit: 20);

// Get current user
$me = $service->getCurrentUser();
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
- An [Amplitude](https://amplitude.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
