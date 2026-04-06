# Integration: OneSignal

> OneSignal integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send push notifications, manage devices and apps. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to push notifications via [OneSignal](https://onesignal.com). Send notifications, list devices, view delivery stats, and manage apps — all through the OneSignal REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This OneSignal tool lets AI agents send push notifications, monitor delivery, and manage device registrations — enabling proactive communication workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-one-signal
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a OneSignal REST API key and App ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'one-signal' => [
        'api_key' => env('ONESIGNAL_API_KEY'),
        'app_id'  => env('ONESIGNAL_APP_ID'),
        'url'     => env('ONESIGNAL_URL', 'https://onesignal.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `onesignal_list_notifications` | read | List push notifications sent via OneSignal |
| `onesignal_get_notification` | read | Get details of a specific notification |
| `onesignal_create_notification` | write | Send a new push notification |
| `onesignal_list_devices` | read | List devices registered in an app |
| `onesignal_get_device` | read | Get details of a specific device |
| `onesignal_list_apps` | read | List all OneSignal apps |
| `onesignal_get_current_app` | read | Get details of a specific app |

## Quick Start

```php
use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalCreateNotification;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalListNotifications;

// Create tools
$service = app(OneSignalService::class);
$tools = [
    new OneSignalCreateNotification($service),
    new OneSignalListNotifications($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a push notification saying "Welcome!" to all users');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('one-signal');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\OneSignal\Tools\OneSignalCreateNotification::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\OneSignal\OneSignalService;

$service = app(OneSignalService::class);
$appId = $service->getAppId();

// List notifications
$notifications = $service->listNotifications($appId, limit: 10);

// Send a notification
$result = $service->createNotification(
    appId: $appId,
    contents: ['en' => 'Hello from AI!'],
    headings: ['en' => 'New Message'],
    includedSegments: ['All'],
);

// List devices
$devices = $service->listDevices($appId);

// List all apps
$apps = $service->listApps();
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
- A [OneSignal](https://onesignal.com) account with REST API access

## License

MIT — see [LICENSE](LICENSE)
