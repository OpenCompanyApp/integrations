# Integration: Front

> Front (frontapp.com) integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage conversations, messages, and contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Front inbox. List and search conversations, read and send messages, and manage contacts — all through the [Front API](https://dev.frontapp.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Front tool lets AI agents manage customer conversations, reply to messages, and look up contact information — giving agents full communication awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-front
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Front API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'front' => [
        'access_token' => env('FRONT_ACCESS_TOKEN'),
        'url'          => env('FRONT_API_URL', 'https://api2.frontapp.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `front_list_conversations` | read | List and search conversations with filters |
| `front_get_conversation` | read | Get details of a specific conversation |
| `front_list_messages` | read | List messages in a conversation |
| `front_send_message` | write | Send a reply to a conversation |
| `front_list_contacts` | read | List and search contacts |
| `front_get_contact` | read | Get details of a specific contact |
| `front_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\Integrations\Front\Tools\FrontListConversations;
use OpenCompany\Integrations\Front\Tools\FrontSendMessage;

// Create tools
$service = app(FrontService::class);
$tools = [
    new FrontListConversations($service),
    new FrontSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my open conversations and reply to the most recent one with a thank you note.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('front');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Front\Tools\FrontListConversations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Front\FrontService;

$service = app(FrontService::class);

// List open conversations
$conversations = $service->listConversations(status: 'open', limit: 10);

// Get a specific conversation
$conversation = $service->getConversation('cnv_123abc');

// List messages
$messages = $service->listMessages('cnv_123abc');

// Send a reply
$service->sendMessage(
    id: 'cnv_123abc',
    body: '<p>Thanks for reaching out! We\'ll get back to you shortly.</p>',
);

// Search contacts
$contacts = $service->listContacts(q: 'john');

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
- A [Front](https://frontapp.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
