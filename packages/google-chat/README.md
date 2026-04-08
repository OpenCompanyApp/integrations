# Integration: Google Chat

> Google Chat integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list spaces, send and read messages, manage memberships. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Chat. List spaces, read and send messages, and query memberships — all through the [Google Chat API](https://developers.google.com/chat/api/reference/rest).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Chat tool lets AI agents interact with Google Chat spaces, read and send messages, and inspect memberships — enabling agents to participate in team communication channels.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-chat
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google Chat OAuth 2.0 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-chat' => [
        'access_token' => env('GOOGLE_CHAT_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_CHAT_URL', 'https://chat.googleapis.com'),
    ],
];
```

### Required OAuth Scopes

| Scope | Purpose |
|-------|---------|
| `https://www.googleapis.com/auth/chat.spaces` | List and view spaces |
| `https://www.googleapis.com/auth/chat.spaces.readonly` | Read-only space access |
| `https://www.googleapis.com/auth/chat.messages` | Send and read messages |
| `https://www.googleapis.com/auth/chat.messages.readonly` | Read-only message access |
| `https://www.googleapis.com/auth/chat.memberships` | List memberships |
| `https://www.googleapis.com/auth/chat.memberships.readonly` | Read-only membership access |
| `https://www.googleapis.com/auth/chat.bot` | Bot access (alternative to user OAuth) |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `google_chat_list_spaces` | read | List Google Chat spaces the authenticated user belongs to |
| `google_chat_get_space` | read | Get details about a specific space |
| `google_chat_list_messages` | read | List messages in a space (paginated) |
| `google_chat_get_message` | read | Get a specific message |
| `google_chat_create_message` | write | Send a message (plain text or card v2) |
| `google_chat_list_memberships` | read | List members of a space |
| `google_chat_get_current_user` | read | Get the authenticated user's membership in a space |

## Quick Start

```php
use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatListSpaces;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatCreateMessage;

// Create tools
$service = app(GoogleChatService::class);
$tools = [
    new GoogleChatListSpaces($service),
    new GoogleChatCreateMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Google Chat spaces and send "Hello!" to the first one.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-chat');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleChat\Tools\GoogleChatListSpaces::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleChat\GoogleChatService;

$service = app(GoogleChatService::class);

// List spaces
$spaces = $service->listSpaces();

// Get a specific space
$space = $service->getSpace('spaces/AAAAAAAAAAA');

// List messages
$messages = $service->listMessages('spaces/AAAAAAAAAAA');

// Send a message
$service->createMessage('spaces/AAAAAAAAAAA', text: 'Hello from the integration!');

// Send a card message
$service->createMessage('spaces/AAAAAAAAAAA', cardsV2: [
    [
        'cardId' => 'my-card',
        'card' => [
            'sections' => [
                ['widgets' => [['textParagraph' => ['text' => '<b>Hello!</b>']]]],
            ],
        ],
    ],
]);

// List memberships
$members = $service->listMemberships('spaces/AAAAAAAAAAA');

// Get current user's membership
$me = $service->getCurrentUser('spaces/AAAAAAAAAAA');
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
- A Google Workspace account with Chat API enabled and OAuth 2.0 credentials

## License

MIT — see [LICENSE](LICENSE)
