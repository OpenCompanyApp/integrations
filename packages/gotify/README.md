# Integration: Gotify

> Gotify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send, list, and delete messages via a self-hosted notification server. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to push notifications through [Gotify](https://gotify.net), a self-hosted notification server. Send alerts, list pending messages, and manage notifications — all through the Gotify REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Gotify tool lets AI agents send push notifications, monitor server health, and manage messages — enabling real-time alerting and notification workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-gotify
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Gotify application token and server URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'gotify' => [
        'app_token' => env('GOTIFY_APP_TOKEN'),
        'hostname'  => env('GOTIFY_HOSTNAME', 'https://gotify.example.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gotify_list_messages` | read | List messages from the application (with pagination) |
| `gotify_create_message` | write | Send a notification message (title, body, priority) |
| `gotify_delete_message` | write | Delete a message by ID |
| `gotify_get_health` | read | Check the Gotify server health status |
| `gotify_get_current_user` | read | Get info about the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\Integrations\Gotify\Tools\GotifyCreateMessage;
use OpenCompany\Integrations\Gotify\Tools\GotifyListMessages;

// Create tools
$service = app(GotifyService::class);
$tools = [
    new GotifyCreateMessage($service),
    new GotifyListMessages($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a notification to the team: deployment complete.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('gotify');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Gotify\Tools\GotifyCreateMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Gotify\GotifyService;

$service = app(GotifyService::class);

// Send a message
$message = $service->createMessage('Deploy Complete', 'Version 2.1.0 deployed.', 5);

// List messages
$messages = $service->listMessages(limit: 10);

// Delete a message
$service->deleteMessage($message['id']);

// Check health
$health = $service->getHealth();

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
- A [Gotify](https://gotify.net) server with an application token

## License

MIT — see [LICENSE](LICENSE)
