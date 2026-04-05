# Integration: HelpScout

> HelpScout integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage conversations, customers, and mailboxes. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your help desk. List and manage support conversations, look up customers, and browse mailboxes — all through the [HelpScout](https://www.helpscout.com) API v2.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This HelpScout tool lets AI agents manage customer support conversations, look up customer details, and interact with mailboxes — enabling intelligent support workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-helpscout
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a HelpScout OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'helpscout' => [
        'access_token' => env('HELPSCOUT_ACCESS_TOKEN'),
        'url'          => env('HELPSCOUT_URL', 'https://api.helpscout.net/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `helpscout_list_conversations` | read | List conversations with filters (mailbox, status, assignee, tag, etc.) |
| `helpscout_get_conversation` | read | Get full details of a specific conversation |
| `helpscout_create_conversation` | write | Create a new conversation (email or chat) |
| `helpscout_update_conversation` | write | Update a conversation (status, assignee, tags, subject) |
| `helpscout_list_customers` | read | List or search customers |
| `helpscout_get_customer` | read | Get details of a specific customer |
| `helpscout_create_customer` | write | Create a new customer |
| `helpscout_list_mailboxes` | read | List all mailboxes |
| `helpscout_get_mailbox` | read | Get details of a specific mailbox |
| `helpscout_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutListConversations;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutGetConversation;

// Create tools
$service = app(HelpScoutService::class);
$tools = [
    new HelpScoutListConversations($service),
    new HelpScoutGetConversation($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all open conversations in the support mailbox');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('helpscout');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\HelpScout\Tools\HelpScoutListConversations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\HelpScout\HelpScoutService;

$service = app(HelpScoutService::class);

// List open conversations
$conversations = $service->listConversations(['status' => 'open']);

// Get a specific conversation
$conversation = $service->getConversation(123);

// Create a conversation
$service->createConversation([
    'subject' => 'Need help',
    'mailboxId' => 456,
    'customer' => ['email' => 'jane@example.com'],
    'threads' => [
        ['type' => 'customer', 'text' => 'I need help with my order.', 'customer' => ['email' => 'jane@example.com']],
    ],
]);

// Update a conversation
$service->updateConversation(123, ['status' => 'closed']);

// List customers
$customers = $service->listCustomers(['query' => 'jane']);

// Get mailboxes
$mailboxes = $service->listMailboxes();

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
- A [HelpScout](https://www.helpscout.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
