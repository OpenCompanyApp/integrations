# Integration: Webex

> Cisco Webex integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list rooms, send messages, and manage meetings. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Cisco Webex messaging and meetings. List spaces, read and post messages, and query upcoming meetings — all through the [Webex REST API](https://developer.webex.com/docs/api/getting-started).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Webex tool lets AI agents read and post messages in Webex spaces, look up room details, and list scheduled meetings — enabling agents to participate in team communication.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-webex
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Webex access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'webex' => [
        'access_token' => env('WEBEX_ACCESS_TOKEN'),
        'url'          => env('WEBEX_API_URL', 'https://webexapis.com/v1'),
    ],
];
```

### Getting an Access Token

1. Go to [developer.webex.com](https://developer.webex.com/docs/getting-started)
2. Sign in with your Webex account
3. Copy your personal access token from the "Getting Started" page
4. For production use, create an OAuth integration

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `webex_list_rooms` | read | List Webex spaces (rooms) the user belongs to |
| `webex_get_room` | read | Get details for a specific room |
| `webex_list_messages` | read | List messages in a room (with date filters and pagination) |
| `webex_create_message` | write | Post a new message to a room (text or Markdown) |
| `webex_list_meetings` | read | List scheduled meetings (with date range filters) |
| `webex_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\Integrations\Webex\Tools\WebexListRooms;
use OpenCompany\Integrations\Webex\Tools\WebexCreateMessage;

// Create tools
$service = app(WebexService::class);
$tools = [
    new WebexListRooms($service),
    new WebexCreateMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Webex rooms and post a summary to the General room');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('webex');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Webex\Tools\WebexListRooms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Webex\WebexService;

$service = app(WebexService::class);

// List rooms
$rooms = $service->listRooms(max: 20);

// Get room details
$room = $service->getRoom('Y2lzY29zcGFyazovL3VzL1JPT00v...');

// List messages
$messages = $service->listMessages('Y2lzY29zcGFyazovL3VzL1JPT00v...', max: 50);

// Post a message
$service->createMessage('Y2lzY29zcGFyazovL3VzL1JPT00v...', text: 'Hello from AI!');
$service->createMessage('Y2lzY29zcGFyazovL3VzL1JPT00v...', markdown: '**Bold** and *italic* text');

// List meetings
$meetings = $service->listMeetings(from: '2025-04-01T00:00:00Z', to: '2025-04-30T23:59:59Z');

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
- A [Cisco Webex](https://www.webex.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
