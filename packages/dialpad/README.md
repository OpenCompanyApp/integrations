# Integration: Dialpad

> Dialpad integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage calls, SMS messages, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to business communications. Query call history, send and list SMS messages, and manage users — all through the [Dialpad](https://dialpad.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Dialpad tool lets AI agents query call history, send SMS messages, and look up contact information — giving agents communication awareness and action capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-dialpad
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Dialpad API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'dialpad' => [
        'access_token' => env('DIALPAD_ACCESS_TOKEN'),
        'url'          => env('DIALPAD_URL', 'https://dialpad.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `dialpad_list_calls` | read | List call history records with date filtering and pagination |
| `dialpad_get_call` | read | Get details of a specific call by ID |
| `dialpad_list_sms` | read | List SMS messages with date filtering and pagination |
| `dialpad_send_sms` | write | Send an SMS message |
| `dialpad_list_users` | read | List users in the organization |
| `dialpad_get_user` | read | Get details of a specific user by ID |
| `dialpad_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\Integrations\Dialpad\Tools\DialpadListCalls;
use OpenCompany\Integrations\Dialpad\Tools\DialpadSendSms;

// Create tools
$service = app(DialpadService::class);
$tools = [
    new DialpadListCalls($service),
    new DialpadSendSms($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many calls did we receive yesterday?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('dialpad');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Dialpad\Tools\DialpadListCalls::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Dialpad\DialpadService;

$service = app(DialpadService::class);

// List recent calls
$calls = $service->listCalls(limit: 20);

// Get a specific call
$call = $service->getCall('call_abc123');

// List SMS messages
$messages = $service->listSms(limit: 25);

// Send an SMS
$service->sendSms('+14155551234', '+14155559876', 'Hello!');

// List users
$users = $service->listUsers();

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
- A [Dialpad](https://dialpad.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
