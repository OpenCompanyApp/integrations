# Integration: Novu

> Novu notification platform integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage notifications, subscribers, and trigger events. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [Novu](https://novu.co) notification platform. List and view notifications, manage subscribers, and trigger notification events — all through the Novu API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Novu tool lets AI agents send notifications, manage subscribers, and monitor notification delivery — enabling automated communication workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-novu
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Novu API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'novu' => [
        'api_key' => env('NOVU_API_KEY'),
        'url'     => env('NOVU_API_URL', 'https://api.novu.co'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `novu_list_notifications` | read | List notifications with optional channel filter |
| `novu_get_notification` | read | Get details of a specific notification |
| `novu_list_subscribers` | read | List all notification subscribers |
| `novu_get_subscriber` | read | Get details of a specific subscriber |
| `novu_create_subscriber` | write | Create a new notification subscriber |
| `novu_trigger_event` | write | Trigger a notification event to subscribers |
| `novu_get_current_user` | read | Get the currently authenticated Novu user |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\Integrations\Novu\Tools\NovuListNotifications;
use OpenCompany\Integrations\Novu\Tools\NovuTriggerEvent;

// Create tools
$service = app(NovuService::class);
$tools = [
    new NovuListNotifications($service),
    new NovuTriggerEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome notification to john@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('novu');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Novu\Tools\NovuTriggerEvent::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Novu\NovuService;

$service = app(NovuService::class);

// List notifications
$notifications = $service->listNotifications(page: 1, limit: 20);

// Get a specific notification
$notification = $service->getNotification('notification-id');

// List subscribers
$subscribers = $service->listSubscribers(page: 0, limit: 20);

// Create a subscriber
$subscriber = $service->createSubscriber(
    email: 'john@example.com',
    firstName: 'John',
    lastName: 'Doe',
    phone: '+1234567890',
);

// Trigger an event
$result = $service->triggerEvent(
    name: 'onboarding-welcome',
    to: 'john@example.com',
    payload: ['name' => 'John', 'plan' => 'Pro'],
);

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
- A [Novu](https://novu.co) account with API access

## License

MIT — see [LICENSE](LICENSE)
