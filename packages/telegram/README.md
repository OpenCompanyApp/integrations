# Integration: Telegram

> Telegram Bot integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send messages, photos, manage chats and updates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Telegram messaging. Send text messages and photos, read incoming updates, and manage chats — all through the [Telegram Bot API](https://core.telegram.org/bots/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Telegram tool lets AI agents send messages, share photos, and interact with chats — enabling agents to communicate with teams and users on Telegram.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-telegram
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Telegram Bot token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'url'       => env('TELEGRAM_API_URL', 'https://api.telegram.org'),
    ],
];
```

### Getting a Bot Token

1. Open Telegram and search for [@BotFather](https://t.me/BotFather)
2. Send `/newbot` and follow the instructions
3. Copy the provided bot token

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `telegram_send_message` | write | Send a text message to a chat |
| `telegram_send_photo` | write | Send a photo to a chat |
| `telegram_get_updates` | read | Get incoming updates (messages, callbacks, etc.) |
| `telegram_list_chats` | read | List chats the bot has interacted with (derived from updates) |
| `telegram_get_chat` | read | Get information about a specific chat |
| `telegram_get_me` | read | Get information about the authenticated bot |

## Quick Start

```php
use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\Integrations\Telegram\Tools\TelegramSendMessage;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetMe;

// Create tools
$service = app(TelegramService::class);
$tools = [
    new TelegramSendMessage($service),
    new TelegramGetMe($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send "Hello!" to chat ID 123456789');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('telegram');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Telegram\Tools\TelegramSendMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Telegram\TelegramService;

$service = app(TelegramService::class);

// Get bot info
$me = $service->getMe();

// Send a message
$service->sendMessage(123456789, 'Hello from the bot!');

// Send with formatting
$service->sendMessage(123456789, '*Bold text*', ['parse_mode' => 'MarkdownV2']);

// Send a photo
$service->sendPhoto(123456789, 'https://example.com/photo.jpg', [
    'caption' => 'Check this out!',
]);

// Get updates
$updates = $service->getUpdates(['limit' => 10]);

// Get chat info
$chat = $service->getChat(123456789);
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
- A [Telegram Bot](https://core.telegram.org/bots) token from @BotFather

## License

MIT — see [LICENSE](LICENSE)
