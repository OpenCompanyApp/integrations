# Integration: Freshchat

> Freshchat integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage conversations, agents, and groups. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Freshchat customer support. List and retrieve conversations, create new ones, manage agents, and organize groups — all through the [Freshchat API](https://developers.freshchat.com/api-docs/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshchat tool lets AI agents manage customer support conversations, look up agent details, and interact with support teams — giving agents real-time awareness of support operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshchat
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Freshchat API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshchat' => [
        'access_token' => env('FRESHCHAT_ACCESS_TOKEN'),
        'url'          => env('FRESHCHAT_URL', 'https://api.freshchat.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshchat_list_conversations` | read | List support conversations with optional filters (status, inbox) |
| `freshchat_get_conversation` | read | Get full details of a specific conversation |
| `freshchat_create_conversation` | write | Start a new support conversation |
| `freshchat_list_agents` | read | List support agents with pagination |
| `freshchat_get_agent` | read | Get details of a specific agent |
| `freshchat_list_groups` | read | List support groups (teams) |
| `freshchat_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatListConversations;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatGetConversation;

// Create tools
$service = app(FreshchatService::class);
$tools = [
    new FreshchatListConversations($service),
    new FreshchatGetConversation($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all open support conversations');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshchat');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Freshchat\Tools\FreshchatListConversations::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Freshchat\FreshchatService;

$service = app(FreshchatService::class);

// List open conversations
$conversations = $service->listConversations(1, 50, 'open');

// Get a specific conversation
$conversation = $service->getConversation('conv-123');

// Create a conversation
$conversation = $service->createConversation('user-456', 'I need help with my order');

// List agents
$agents = $service->listAgents(1, 50);

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
- A [Freshchat](https://www.freshworks.com/live-chat-software/) account with API access

## License

MIT — see [LICENSE](LICENSE)
