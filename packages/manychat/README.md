# Integration: ManyChat

> ManyChat integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage flows, tags, send messages, and get user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to chat marketing automation. List and inspect flows, send messages on Instagram, Messenger, WhatsApp and SMS, manage tags, and retrieve account info — all through the [ManyChat](https://manychat.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ManyChat tool lets AI agents manage chat automations, send targeted messages, and organize subscribers through tags — enabling conversational marketing workflows driven by AI.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-manychat
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ManyChat API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'manychat' => [
        'api_key' => env('MANYCHAT_API_KEY'),
        'url'     => env('MANYCHAT_URL', 'https://api.manychat.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `manychat_list_flows` | read | List all flows (pages) in your ManyChat account |
| `manychat_get_flow` | read | Get details of a specific flow by ID |
| `manychat_send_message` | write | Send a message to a subscriber via Instagram, Messenger, WhatsApp, or SMS |
| `manychat_list_tags` | read | List all tags in your ManyChat account |
| `manychat_create_tag` | write | Create a new tag for subscriber segmentation |
| `manychat_get_current_user` | read | Get the authenticated ManyChat user profile |

## Quick Start

```php
use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListFlows;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendMessage;

// Create tools
$service = app(ManyChatService::class);
$tools = [
    new ManyChatListFlows($service),
    new ManyChatSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my ManyChat flows and send a welcome message to subscriber 12345');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('manychat');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ManyChat\Tools\ManyChatListFlows::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ManyChat\ManyChatService;

$service = app(ManyChatService::class);

// List flows
$flows = $service->listFlows();

// Get a specific flow
$flow = $service->getFlow('flow_id_here');

// Send a message
$service->sendMessage([
    'subscriber_id' => '12345',
    'message' => ['text' => 'Hello from ManyChat!'],
]);

// Manage tags
$tags = $service->listTags();
$service->createTag('VIP Customer');

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
- A [ManyChat](https://manychat.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
