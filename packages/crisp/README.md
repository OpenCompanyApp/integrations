# Integration: Crisp

> Crisp integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage conversations, contacts, campaigns, and messaging. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to live chat and customer messaging. List and read conversations, reply to customers, browse contacts, and review campaigns — all through the [Crisp](https://crisp.chat/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Crisp tool lets AI agents interact with customer conversations, look up contact details, and manage messaging — enabling agents to handle support, sales, and engagement workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-crisp
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Crisp API token and Website ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'crisp' => [
        'api_key'    => env('CRISP_API_KEY'),       // Token ID
        'website_id' => env('CRISP_WEBSITE_ID'),    // Website ID (UUID)
        'url'        => env('CRISP_URL', 'https://api.crisp.chat/v1'),
    ],
];
```

### Getting Your Credentials

1. **API Key (Token ID)**: In your Crisp dashboard, go to **Plugins → Marketplace → Custom API** and generate a new token. Use the **Token ID** as the API key.
2. **Website ID**: Find it in **Settings → Site Settings** in your Crisp dashboard.
3. Authentication uses HTTP Basic Auth where the API key is the username and the Website ID is the password.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `crisp_list_conversations` | read | List chat conversations with pagination |
| `crisp_get_conversation` | read | Get a conversation's messages and details |
| `crisp_send_message` | write | Send a message (text, note, file) in a conversation |
| `crisp_list_contacts` | read | List contacts with profile info |
| `crisp_get_contact` | read | Get a contact's full profile |
| `crisp_list_campaigns` | read | List marketing campaigns |
| `crisp_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\Integrations\Crisp\Tools\CrispListConversations;
use OpenCompany\Integrations\Crisp\Tools\CrispSendMessage;

// Create tools
$service = app(CrispService::class);
$tools = [
    new CrispListConversations($service),
    new CrispSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Reply to the latest unread conversation with a greeting.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('crisp');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Crisp\Tools\CrispListConversations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Crisp\CrispService;

$service = app(CrispService::class);

// List conversations
$conversations = $service->listConversations(page: 1, perPage: 25);

// Get a specific conversation
$conversation = $service->getConversation('session_abc123');

// Send a message
$service->sendMessage('session_abc123', 'Hello! How can we help?', type: 'text', from: 'operator');

// List contacts
$contacts = $service->listContacts();

// Get a contact
$contact = $service->getContact('user@example.com');

// List campaigns
$campaigns = $service->listCampaigns();

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
- A [Crisp](https://crisp.chat/) account with API access

## License

MIT — see [LICENSE](LICENSE)
