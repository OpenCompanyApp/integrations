# Integration: MessageBird

> MessageBird REST API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — SMS, voice messages, contacts, groups, lookup, HLR, Verify, balance, and numbers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the [MessageBird](https://messagebird.com) REST API. Send SMS and voice messages, track delivery status, manage contacts and groups, validate numbers, run HLR checks, send verification tokens, check account balance, and manage purchased phone numbers.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MessageBird tool lets AI agents operate communication workflows while keeping every external API operation explicit and auditable.

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
        'url'     => env('MESSAGEBIRD_URL', 'https://rest.messagebird.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `messagebird_send_sms`, `messagebird_list_messages`, `messagebird_get_message`, `messagebird_delete_message` | read/write | SMS send, list, detail, and scheduled-message delete |
| `messagebird_send_voice_message`, `messagebird_list_voice_messages`, `messagebird_get_voice_message`, `messagebird_delete_voice_message` | read/write | Voice message send, list, detail, and scheduled-message delete |
| `messagebird_list_contacts`, `messagebird_create_contact`, `messagebird_get_contact`, `messagebird_update_contact`, `messagebird_delete_contact`, `messagebird_list_contact_groups`, `messagebird_list_contact_messages` | read/write | Contact management and contact-related lists |
| `messagebird_list_groups`, `messagebird_create_group`, `messagebird_get_group`, `messagebird_update_group`, `messagebird_delete_group`, `messagebird_list_group_contacts`, `messagebird_add_contact_to_group`, `messagebird_remove_contact_from_group` | read/write | Group management and contact membership |
| `messagebird_lookup_phone_number`, `messagebird_get_hlr_lookup`, `messagebird_request_hlr_lookup` | read/write | Number lookup and HLR checks |
| `messagebird_create_verify`, `messagebird_get_verify`, `messagebird_verify_token`, `messagebird_delete_verify` | read/write | Verification lifecycle |
| `messagebird_list_balance`, `messagebird_list_numbers`, `messagebird_get_number`, `messagebird_update_number`, `messagebird_get_current_user` | read/write | Balance and purchased number operations |

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

If you have `integration-core` installed, the tools auto-register with the `ToolProviderRegistry`:

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
$messages = $service->listMessages(['status' => 'delivered']);

// Check balance
$balance = $service->listBalance();

// List numbers
$numbers = $service->listNumbers(['country_code' => 'NL', 'number_type' => 'mobile']);

// Create a contact and group
$contact = $service->createContact(['msisdn' => 31612345678, 'firstName' => 'Ada']);
$group = $service->createGroup('Customers');

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
