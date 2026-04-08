# Integration: Plivo

> Plivo integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send SMS, manage calls, phone numbers, and applications. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the Plivo communications platform. Send and list SMS messages, query call history, manage phone numbers, and list voice applications — all through the [Plivo REST API](https://www.plivo.com/docs/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Plivo tool lets AI agents send SMS messages, retrieve call logs, manage phone numbers, and inspect voice applications — giving agents communication capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-plivo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Plivo Auth ID and Auth Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'plivo' => [
        'auth_id'    => env('PLIVO_AUTH_ID'),
        'auth_token' => env('PLIVO_AUTH_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `plivo_list_messages` | read | List SMS messages with optional filters (direction, state, date, numbers) |
| `plivo_send_sms` | write | Send an SMS message to one or more recipients |
| `plivo_list_numbers` | read | List phone numbers on the Plivo account |
| `plivo_get_number` | read | Retrieve details of a specific phone number |
| `plivo_list_calls` | read | List calls with optional filters (direction, state, date, numbers) |
| `plivo_get_call` | read | Retrieve details of a specific call by UUID |
| `plivo_list_applications` | read | List Plivo voice applications |

## Quick Start

```php
use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\Integrations\Plivo\Tools\PlivoListMessages;
use OpenCompany\Integrations\Plivo\Tools\PlivoSendSms;

// Create tools
$service = app(PlivoService::class);
$tools = [
    new PlivoListMessages($service),
    new PlivoSendSms($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send an SMS to +14155552671 saying "Hello from Plivo!"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('plivo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Plivo\Tools\PlivoSendSms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Plivo\PlivoService;

$service = app(PlivoService::class);

// Send an SMS
$service->sendMessage([
    'src'  => '+14155552671',
    'dst'  => '+14155552672',
    'text' => 'Hello from Plivo!',
]);

// List recent messages
$messages = $service->listMessages(['limit' => 10]);

// List phone numbers
$numbers = $service->listNumbers();

// Get a specific number
$number = $service->getNumber('+14155552671');

// List calls
$calls = $service->listCalls(['limit' => 10]);

// Get a specific call
$call = $service->getCall('abc123-def456-...');

// List applications
$apps = $service->listApplications();
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
- A [Plivo](https://www.plivo.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
