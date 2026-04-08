# Integration: MessageBird

> MessageBird integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send SMS, retrieve messages, check balance, and manage numbers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [MessageBird](https://messagebird.com) messaging platform. Send SMS messages, track delivery status, check account balance, and manage purchased phone numbers — all through the MessageBird REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MessageBird tool lets AI agents send SMS notifications, check message delivery status, and manage messaging resources — enabling agent-driven communication workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-messagebird
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a MessageBird API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'messagebird' => [
        'api_key' => env('MESSAGEBIRD_API_KEY'),
        'url'     => env('MESSAGEBIRD_URL', 'https://api.messagebird.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `messagebird_send_sms` | write | Send an SMS message to one or more recipients |
| `messagebird_get_message` | read | Retrieve details of a specific message |
| `messagebird_list_messages` | read | List sent and received messages with filters |
| `messagebird_list_balance` | read | Check your account balance |
| `messagebird_list_numbers` | read | List purchased phone numbers |
| `messagebird_get_current_user` | read | Get current account information and balance |

## Quick Start

```php
use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendSms;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdListBalance;

// Create tools
$service = app(MessageBirdService::class);
$tools = [
    new MessageBirdSendSms($service),
    new MessageBirdListBalance($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send an SMS to +31612345678 saying "Hello from OpenCompany"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('messagebird');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendSms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MessageBird\MessageBirdService;

$service = app(MessageBirdService::class);

// Send an SMS
$message = $service->sendSms('OpenCompany', ['+31612345678'], 'Hello World');

// Get a message
$message = $service->getMessage('a6e89f50c0d25b35a212345678901234');

// List messages
$messages = $service->listMessages(20, 0, 'delivered');

// Check balance
$balance = $service->listBalance();

// List numbers
$numbers = $service->listNumbers(20, 0, 'NL', 'mobile');

// Get account info
$account = $service->getCurrentUser();
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
- A [MessageBird](https://messagebird.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
