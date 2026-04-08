# Integration: LINE

> LINE Messaging API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send messages, broadcast announcements, and manage contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the LINE Messaging API. Send push messages to users, broadcast announcements to all followers, look up user profiles, and list friends — all through the [LINE Messaging API](https://developers.line.biz/en/docs/messaging-api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This LINE tool lets AI agents interact with LINE users — sending messages, broadcasting updates, and retrieving contact information — giving agents a communication channel on one of Asia's most popular messaging platforms.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-line
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a LINE channel access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'line' => [
        'access_token' => env('LINE_CHANNEL_ACCESS_TOKEN'),
        'url'          => env('LINE_API_URL', 'https://api.line.me/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `line_send_message` | write | Send a push message to a specific LINE user or group |
| `line_broadcast_message` | write | Broadcast a message to all friends of the LINE Official Account |
| `line_get_profile` | read | Get the profile of a LINE user |
| `line_list_friends` | read | List friends (followers) of the LINE Official Account |
| `line_get_current_user` | read | Get the profile of the LINE Official Account (bot info) |

## Quick Start

```php
use OpenCompany\Integrations\Line\LineService;
use OpenCompany\Integrations\Line\Tools\LineSendMessage;
use OpenCompany\Integrations\Line\Tools\LineGetProfile;

// Create tools
$service = app(LineService::class);
$tools = [
    new LineSendMessage($service),
    new LineGetProfile($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a greeting to LINE user U4af4980629...');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('line');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Line\Tools\LineSendMessage::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Line\LineService;

$service = app(LineService::class);

// Send a message
$service->sendMessage('U4af4980629...', [
    ['type' => 'text', 'text' => 'Hello from the bot!'],
]);

// Broadcast
$service->broadcastMessage([
    ['type' => 'text', 'text' => '📢 Announcement for everyone!'],
]);

// Get user profile
$profile = $service->getProfile('U4af4980629...');

// List friends
$friends = $service->listFriends(100);

// Get bot info
$botInfo = $service->getCurrentUser();
```

## Message Types

The LINE Messaging API supports several message types:

- **text** — Simple text messages
- **image** — Image messages with preview
- **video** — Video messages
- **audio** — Audio messages
- **location** — Location with title and coordinates
- **sticker** — LINE sticker messages
- **flex** — Customizable flex messages
- **imagemap** — Interactive image messages
- **template** — Buttons, confirms, carousels

See the [LINE Messaging API documentation](https://developers.line.biz/en/reference/messaging-api/) for full message object specifications.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [LINE Official Account](https://developers.line.biz/en/docs/messaging-api/) with a channel access token

## License

MIT — see [LICENSE](LICENSE)
