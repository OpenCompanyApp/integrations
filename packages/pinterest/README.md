# Integration: Pinterest

> Pinterest integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage boards, pins, and user account. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Pinterest. List and create boards, manage pins, and retrieve user account information — all through the [Pinterest v5 API](https://developers.pinterest.com/docs/getting-started/introduction/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Pinterest tool lets AI agents manage visual content, organize boards, create and delete pins, and look up account information — giving agents the ability to curate and manage Pinterest content programmatically.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-pinterest
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Pinterest access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'pinterest' => [
        'access_token' => env('PINTEREST_ACCESS_TOKEN'),
        'base_url'     => env('PINTEREST_BASE_URL', 'https://api.pinterest.com/v5'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `pinterest_list_boards` | read | List all boards for the authenticated user |
| `pinterest_get_board` | read | Get details for a specific board |
| `pinterest_create_board` | write | Create a new board |
| `pinterest_list_pins` | read | List pins on a specific board |
| `pinterest_create_pin` | write | Create a new pin with an image URL |
| `pinterest_delete_pin` | write | Delete a pin permanently |
| `pinterest_get_current_user` | read | Get authenticated user account info |

## Quick Start

```php
use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\Integrations\Pinterest\Tools\PinterestListBoards;
use OpenCompany\Integrations\Pinterest\Tools\PinterestCreatePin;

// Create tools
$service = app(PinterestService::class);
$tools = [
    new PinterestListBoards($service),
    new PinterestCreatePin($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a pin on my Travel board with this image: https://example.com/photo.jpg');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('pinterest');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Pinterest\Tools\PinterestCreatePin::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Pinterest\PinterestService;

$service = app(PinterestService::class);

// Get current user
$user = $service->getCurrentUser();

// List boards
$boards = $service->listBoards();

// Create a board
$board = $service->createBoard('Travel Inspiration', 'Places I want to visit');

// List pins on a board
$pins = $service->listPins($boardId);

// Create a pin
$pin = $service->createPin(
    boardId: $boardId,
    title: 'Beautiful Sunset',
    imageUrl: 'https://example.com/sunset.jpg',
    description: 'A gorgeous sunset over the ocean',
    link: 'https://example.com/blog/sunset'
);

// Delete a pin
$service->deletePin($pinId);
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
- A [Pinterest](https://www.pinterest.com/) account with a developer access token

## License

MIT — see [LICENSE](LICENSE)
