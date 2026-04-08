# Integration: Matrix

> Matrix integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list rooms, send messages, manage members and profiles. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Matrix](https://matrix.org/) decentralized messaging. List and create rooms, send messages, view members, and look up user profiles — all through the Matrix Client-Server API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Matrix tool lets AI agents interact with Matrix rooms, send messages, and retrieve user information — enabling agents to participate in decentralized communication.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-matrix
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Matrix access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'matrix' => [
        'access_token' => env('MATRIX_ACCESS_TOKEN'),
        'url'          => env('MATRIX_URL', 'https://matrix.org'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `matrix_list_rooms` | read | List rooms the authenticated user has joined |
| `matrix_get_room` | read | Get details of a specific room |
| `matrix_create_room` | write | Create a new room |
| `matrix_send_message` | write | Send a message to a room |
| `matrix_list_members` | read | List members of a room |
| `matrix_get_profile` | read | Get a user's profile information |
| `matrix_get_current_user` | read | Get the currently authenticated user's info |

## Quick Start

```php
use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\Integrations\Matrix\Tools\MatrixListRooms;
use OpenCompany\Integrations\Matrix\Tools\MatrixSendMessage;

// Create tools
$service = app(MatrixService::class);
$tools = [
    new MatrixListRooms($service),
    new MatrixSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my Matrix rooms and send "Hello!" to the general room.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('matrix');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Matrix\Tools\MatrixListRooms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Matrix\MatrixService;

$service = app(MatrixService::class);

// Get current user
$user = $service->getCurrentUser();

// List rooms
$rooms = $service->listRooms(limit: 20);

// Create a room
$room = $service->createRoom([
    'name' => 'Project Alpha',
    'topic' => 'Discussion for Project Alpha',
    'visibility' => 'private',
    'preset' => 'private_chat',
]);

// Send a message
$service->sendMessage('!roomid:matrix.org', uniqid('txn_'), 'm.text', 'Hello from the API!');

// List members
$members = $service->listMembers('!roomid:matrix.org');

// Get a user's profile
$profile = $service->getProfile('@alice:matrix.org');
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
- A [Matrix](https://matrix.org/) account with an access token

## License

MIT — see [LICENSE](LICENSE)
