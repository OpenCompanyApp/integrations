# Integration: Lark

> Lark Suite integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list chats, send messages, manage members, and get current user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Lark team messaging. Browse chats, read and send messages, manage chat members, and retrieve user information — all through the [Lark Open API](https://open.larksuite.com/document).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lark tool lets AI agents interact with team chats — reading messages, sending notifications, and managing group conversations — enabling agents to participate in Lark-based workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-lark
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Lark access token (tenant or user token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'lark' => [
        'access_token' => env('LARK_ACCESS_TOKEN'),
        'url'          => env('LARK_URL', 'https://open.larksuite.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lark_list_chats` | read | List chats the current user belongs to |
| `lark_get_chat` | read | Get detailed information about a specific chat |
| `lark_create_chat` | write | Create a new group chat |
| `lark_list_messages` | read | List messages in a specific chat |
| `lark_send_message` | write | Send a message to a specific chat |
| `lark_list_members` | read | List members of a specific chat |
| `lark_get_current_user` | read | Get information about the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\Integrations\Lark\Tools\LarkListChats;
use OpenCompany\Integrations\Lark\Tools\LarkSendMessage;

// Create tools
$service = app(LarkService::class);
$tools = [
    new LarkListChats($service),
    new LarkSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send "Hello team!" to the general chat');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('lark');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Lark\Tools\LarkListChats::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Lark\LarkService;

$service = app(LarkService::class);

// List chats
$chats = $service->listChats();

// Get a specific chat
$chat = $service->getChat('oc_a0553eda9014c201e6969b478895c230');

// Send a message
$service->sendMessage('oc_a0553eda9014c201e6969b478895c230', '{"text":"Hello!"}', 'text');

// List members
$members = $service->listMembers('oc_a0553eda9014c201e6969b478895c230');

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
- A [Lark Suite](https://www.larksuite.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
