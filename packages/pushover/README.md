# Integration: Pushover

> Pushover integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send push notifications, list sounds, validate users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to send push notifications through [Pushover](https://pushover.net). Send messages with custom priorities, sounds, and URLs — or validate user credentials and list available notification sounds.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Pushover integration lets AI agents send real-time push notifications to team members, escalate alerts with emergency priority, and manage notification delivery — keeping humans in the loop during automated workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pushover
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Pushover application API key (token) and a user key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pushover' => [
        'api_key'  => env('PUSHOVER_API_KEY'),      // Application/API token
        'user_key' => env('PUSHOVER_USER_KEY'),     // Your user key
        'url'      => env('PUSHOVER_URL', 'https://api.pushover.net/1'),
    ],
];
```

### Getting Your Credentials

1. **User Key** — Found on your [Pushover dashboard](https://pushover.net/) homepage.
2. **API Key** — Create an application at [pushover.net/apps](https://pushover.net/apps) to get an API token.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pushover_send_message` | write | Send a push notification with optional title, priority, sound, and URL |
| `pushover_list_sounds` | read | List available notification sounds |
| `pushover_get_current_user` | read | Validate credentials and retrieve user info |

## Quick Start

```php
use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\Integrations\Pushover\Tools\PushoverSendMessage;
use OpenCompany\Integrations\Pushover\Tools\PushoverListSounds;

// Create tools
$service = app(PushoverService::class);
$tools = [
    new PushoverSendMessage($service),
    new PushoverListSounds($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a push notification saying "Deployment complete"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 3 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pushover');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pushover\Tools\PushoverSendMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pushover\PushoverService;

$service = app(PushoverService::class);

// Send a simple message
$result = $service->sendMessage('Hello from OpenCompany!');

// Send with title and high priority
$result = $service->sendMessage(
    message: 'Server CPU above 90%',
    title: 'Server Alert',
    priority: 1,
);

// Emergency alert (requires expire and retry)
$result = $service->sendMessage(
    message: 'Database unreachable!',
    title: 'CRITICAL',
    priority: 2,
    extra: ['expire' => 3600, 'retry' => 60],
);

// List available sounds
$sounds = $service->listSounds();

// Validate user credentials
$user = $service->validateUser();
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
- A [Pushover](https://pushover.net) account with an application API key

## License

MIT — see [LICENSE](LICENSE)
