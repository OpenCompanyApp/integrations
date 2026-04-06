# Integration: WhatsApp Business

> WhatsApp Business API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send messages, manage templates and contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to WhatsApp Business messaging. Send text and template messages, retrieve message status, list approved templates, manage contacts, and verify account info — all through the [WhatsApp Cloud API](https://developers.facebook.com/docs/whatsapp/cloud-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This WhatsApp tool lets AI agents send and retrieve WhatsApp messages, list templates for structured communication, and manage contacts — enabling conversational workflows directly from the platform.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-whatsapp
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Meta System User access token and a WhatsApp Business phone number ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'whatsapp' => [
        'access_token'    => env('WHATSAPP_ACCESS_TOKEN'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
        'base_url'        => env('WHATSAPP_BASE_URL', 'https://graph.facebook.com/v21.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `whatsapp_send_message` | write | Send a text message to a WhatsApp recipient |
| `whatsapp_get_message` | read | Retrieve a specific message by ID |
| `whatsapp_list_templates` | read | List approved message templates |
| `whatsapp_list_contacts` | read | List WhatsApp contacts for the business number |
| `whatsapp_send_template` | write | Send a template-based message |
| `whatsapp_get_current_user` | read | Get the authenticated user / business info |

## Quick Start

```php
use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppSendMessage;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppListTemplates;

// Create tools
$service = app(WhatsAppService::class);
$tools = [
    new WhatsAppSendMessage($service),
    new WhatsAppListTemplates($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send "Hello!" to +1 555 123 4567 via WhatsApp');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('whatsapp');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\WhatsApp\Tools\WhatsAppSendMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\WhatsApp\WhatsAppService;

$service = app(WhatsAppService::class);

// Send a text message
$result = $service->sendMessage('15551234567', 'Hello from OpenCompany!');

// Send a template message
$result = $service->sendTemplate('15551234567', 'hello_world', 'en');

// Get a message
$message = $service->getMessage('wamid.HBgM...');

// List templates
$templates = $service->listTemplates();

// List contacts
$contacts = $service->listContacts();

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
- A [Meta Developer](https://developers.facebook.com/) account with WhatsApp Business API access

## License

MIT — see [LICENSE](LICENSE)
