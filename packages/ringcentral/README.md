# Integration: RingCentral

> RingCentral integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage SMS, messages, call logs, contacts, extensions, phone numbers, and presence. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to business communications. Send and retrieve SMS messages, browse call logs, look up contacts, and inspect account details - all through the [RingCentral](https://developers.ringcentral.com/api-reference/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This RingCentral tool lets AI agents manage SMS communications, review call activity, inspect phone-number assignments, and access contact information.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ringcentral
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a RingCentral OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'ringcentral' => [
        'access_token' => env('RINGCENTRAL_ACCESS_TOKEN'),
        'url'          => env('RINGCENTRAL_API_URL', 'https://platform.ringcentral.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `ringcentral_list_messages` | read | List messages from the message store (SMS, Fax, VoiceMail) |
| `ringcentral_get_message` | read | Get details of a specific message by ID |
| `ringcentral_update_message` | write | Update message status, commonly read/unread |
| `ringcentral_delete_message` | write | Delete a message store record |
| `ringcentral_send_sms` | write | Send an SMS message |
| `ringcentral_list_calls` | read | List call log records |
| `ringcentral_list_account_calls` | read | List account-level call log records |
| `ringcentral_get_call` | read | Get a specific call log record |
| `ringcentral_list_contacts` | read | List contacts from the personal address book |
| `ringcentral_get_contact` | read | Get one personal address book contact |
| `ringcentral_create_contact` | write | Create a personal address book contact |
| `ringcentral_update_contact` | write | Update a personal address book contact |
| `ringcentral_delete_contact` | write | Delete a personal address book contact |
| `ringcentral_get_account` | read | Get account metadata |
| `ringcentral_list_extensions` | read | List account extensions |
| `ringcentral_get_extension` | read | Get one extension by ID |
| `ringcentral_list_account_phone_numbers` | read | List account phone numbers |
| `ringcentral_list_extension_phone_numbers` | read | List phone numbers assigned to the current extension |
| `ringcentral_get_presence` | read | Get current extension presence |
| `ringcentral_get_current_user` | read | Get the authenticated user's extension info |
| `ringcentral_api_get` | read | Call a relative RingCentral API GET endpoint |
| `ringcentral_api_post` | write | Call a relative RingCentral API POST endpoint |
| `ringcentral_api_put` | write | Call a relative RingCentral API PUT endpoint |
| `ringcentral_api_delete` | write | Call a relative RingCentral API DELETE endpoint |

## Quick Start

```php
use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralSendSms;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralListMessages;

// Create tools
$service = app(RingCentralService::class);
$tools = [
    new RingCentralSendSms($service),
    new RingCentralListMessages($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send an SMS to +16505559876 saying "Hello from RingCentral!"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('ringcentral');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\RingCentral\Tools\RingCentralSendSms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\RingCentral\RingCentralService;

$service = app(RingCentralService::class);

// Send SMS
$message = $service->sendSms('+16505551234', '+16505559876', 'Hello!');

// List messages
$messages = $service->listMessages(['messageType' => 'Sms', 'perPage' => 25]);

// Get a specific message
$message = $service->getMessage('1234567890');

// List calls
$calls = $service->listCalls(['dateFrom' => '2025-01-01T00:00:00Z']);

// List contacts
$contacts = $service->listContacts(['startsWith' => 'John']);

// Inspect phone numbers and presence
$numbers = $service->listExtensionPhoneNumbers();
$presence = $service->getPresence(['detailedTelephonyState' => true]);

// Get current user info
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
- A [RingCentral](https://www.ringcentral.com/) account with REST API access

## License

MIT - see [LICENSE](LICENSE)
