# Integration: RingCentral

> RingCentral integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send SMS, list messages, view call logs, and manage contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to business communications. Send and retrieve SMS messages, browse call logs, look up contacts, and inspect account details — all through the [RingCentral](https://www.ringcentral.com/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This RingCentral tool lets AI agents manage SMS communications, review call activity, and access contact information — giving agents communication-aware capabilities.

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
| `ringcentral_send_sms` | write | Send an SMS message |
| `ringcentral_list_calls` | read | List call log records |
| `ringcentral_list_contacts` | read | List contacts from the personal address book |
| `ringcentral_get_current_user` | read | Get the authenticated user's extension info |

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

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

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

MIT — see [LICENSE](LICENSE)
