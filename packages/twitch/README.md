# Integration: Twitch

> Twitch integration for the [Laravel AI SDK](https://github.com/laravel/ai) — stream discovery, user info, channel management, and game search. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the Twitch platform. Discover live streams, look up user profiles, browse channel information, and search for games and categories — all through the [Twitch Helix API](https://dev.twitch.tv/docs/api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Twitch tool lets AI agents discover live content, look up streamer profiles, and browse categories — giving agents awareness of the live streaming ecosystem.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-twitch
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Twitch access token and client ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'twitch' => [
        'access_token' => env('TWITCH_ACCESS_TOKEN'),
        'client_id'    => env('TWITCH_CLIENT_ID'),
        'base_url'     => env('TWITCH_BASE_URL', 'https://api.twitch.tv/helix'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `twitch_list_streams` | read | List live streams, filter by game, language, or user |
| `twitch_get_user` | read | Get user info by ID or login name |
| `twitch_list_games` | read | Get game/category info by ID or name |
| `twitch_get_game` | read | Get a specific game by ID |
| `twitch_list_channels` | read | List channel information |
| `twitch_get_channel` | read | Get channel info for a specific broadcaster |
| `twitch_search_categories` | read | Search for games/categories by name |
| `twitch_get_current_user` | read | Get the authenticated user's info |

## Quick Start

```php
use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\Integrations\Twitch\Tools\TwitchListStreams;
use OpenCompany\Integrations\Twitch\Tools\TwitchSearchCategories;

// Create tools
$service = app(TwitchService::class);
$tools = [
    new TwitchListStreams($service),
    new TwitchSearchCategories($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top 5 live Fortnite streams right now?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('twitch');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Twitch\Tools\TwitchListStreams::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Twitch\TwitchService;

$service = app(TwitchService::class);

// List live streams
$streams = $service->listStreams(['game_id' => '33214', 'first' => 10]);

// Get user info
$user = $service->getUser(login: 'ninja');

// Search categories
$categories = $service->searchCategories('Just Chatting', first: 5);

// Get current authenticated user
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
- A [Twitch Developer](https://dev.twitch.tv/) application with access token and client ID

## License

MIT — see [LICENSE](LICENSE)
