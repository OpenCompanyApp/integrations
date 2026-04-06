# Integration: Courier

> Courier integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send messages, list messages, manage recipients and templates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to programmable notifications through [Courier](https://www.courier.com). Send messages via templates or inline content, track delivery status, manage recipients, and browse notification templates — all through the Courier API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Courier tool lets AI agents send notifications, check delivery status, and manage communication channels — enabling agents to keep teams informed and take action through messaging.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-courier
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Courier API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'courier' => [
        'api_key' => env('COURIER_API_KEY'),
        'url'     => env('COURIER_URL', 'https://api.courier.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `courier_send_message` | write | Send a notification message via Courier |
| `courier_list_messages` | read | List messages with filtering and pagination |
| `courier_get_message` | read | Get details of a specific message |
| `courier_list_recipients` | read | List notification recipients |
| `courier_get_recipient` | read | Get details of a specific recipient |
| `courier_list_templates` | read | List notification templates |
| `courier_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\Integrations\Courier\Tools\CourierSendMessage;
use OpenCompany\Integrations\Courier\Tools\CourierListMessages;

// Create tools
$service = app(CourierService::class);
$tools = [
    new CourierSendMessage($service),
    new CourierListMessages($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome email to john@example.com using the welcome template');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('courier');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Courier\Tools\CourierSendMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Courier\CourierService;

$service = app(CourierService::class);

// Send a message
$result = $service->sendMessage([
    'template' => 'ABCD1234',
    'data' => ['name' => 'John'],
], 'user@example.com');

// List messages
$messages = $service->listMessages(limit: 50, status: 'delivered');

// Get a message
$message = $service->getMessage('msg_1234567890');

// List recipients
$recipients = $service->listRecipients(limit: 50);

// Get a recipient
$recipient = $service->getRecipient('rcpt_1234567890');

// List templates
$templates = $service->listTemplates();

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
- A [Courier](https://www.courier.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
