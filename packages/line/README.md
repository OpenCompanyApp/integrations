# Integration: LINE

> LINE Messaging API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send messages, manage webhooks, inspect followers and groups, and operate rich menus. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the LINE Messaging API. Send reply, push, multicast, narrowcast, and broadcast messages; validate message objects; manage webhook endpoints; inspect bot, user, follower, and group data; and manage rich menus through the [LINE Messaging API](https://developers.line.biz/en/reference/messaging-api/).

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
        'url'          => env('LINE_API_URL', 'https://api.line.me'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `line_reply_message` | write | Reply to a webhook event with a reply token |
| `line_send_message` | write | Send a push message to a user, group, or room |
| `line_multicast_message` | write | Send messages to multiple user IDs |
| `line_narrowcast_message` | write | Send messages to filtered recipients |
| `line_get_narrowcast_progress` | read | Check narrowcast delivery progress |
| `line_broadcast_message` | write | Broadcast a message to all followers |
| `line_mark_as_read` | write | Mark a chat as read |
| `line_start_loading_animation` | write | Display a loading animation in a chat |
| `line_get_message_quota` | read | Get monthly message quota |
| `line_get_message_quota_consumption` | read | Get monthly message consumption |
| `line_get_delivery_count` | read | Get sent message counts by type and date |
| `line_validate_messages` | write | Validate message objects for a send endpoint |
| `line_set_webhook_endpoint` | write | Set the channel webhook endpoint |
| `line_get_webhook_endpoint` | read | Get webhook endpoint settings |
| `line_test_webhook_endpoint` | write | Test webhook endpoint delivery |
| `line_get_profile` | read | Get a LINE user profile |
| `line_list_friends` | read | List follower user IDs |
| `line_get_current_user` | read | Get LINE bot information |
| `line_get_group_summary` | read | Get group chat summary |
| `line_get_group_member_count` | read | Get group member count |
| `line_list_group_member_ids` | read | List group member user IDs |
| `line_get_group_member_profile` | read | Get a group member profile |
| `line_leave_group` | write | Leave a group chat |
| `line_create_rich_menu` | write | Create rich menu metadata |
| `line_validate_rich_menu` | write | Validate rich menu metadata |
| `line_list_rich_menus` | read | List rich menus |
| `line_get_rich_menu` | read | Get rich menu metadata |
| `line_delete_rich_menu` | write | Delete a rich menu |
| `line_set_default_rich_menu` | write | Set the default rich menu |
| `line_get_default_rich_menu` | read | Get the default rich menu ID |
| `line_clear_default_rich_menu` | write | Clear the default rich menu |
| `line_link_rich_menu_to_user` | write | Link a rich menu to one user |
| `line_get_user_rich_menu` | read | Get a user's linked rich menu |
| `line_unlink_rich_menu_from_user` | write | Remove a user's rich menu link |
| `line_issue_link_token` | write | Issue an account-link token |

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

If you have `integration-core` installed, the tools auto-register with the `ToolProviderRegistry`:

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
    ['type' => 'text', 'text' => 'Announcement for everyone!'],
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
