# Integration: Daily.co

> Daily.co video API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage rooms, meetings, and recordings. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to video conferencing capabilities. Create rooms, track meetings, and browse recordings through the [Daily.co](https://daily.co) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Daily.co tool lets AI agents manage video rooms, review meeting sessions, and access recordings — enabling communication automation capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-daily-co
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Daily.co API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'daily-co' => [
        'api_key' => env('DAILY_CO_API_KEY'),
        'url'     => env('DAILY_CO_URL', 'https://api.daily.co/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `daily_co_list_rooms` | read | List video rooms with pagination |
| `daily_co_get_room` | read | Get details of a specific room |
| `daily_co_create_room` | write | Create a new video room |
| `daily_co_delete_room` | write | Delete a video room |
| `daily_co_list_meetings` | read | List meetings with optional filters |
| `daily_co_get_meeting` | read | Get details of a specific meeting |
| `daily_co_list_recordings` | read | List recordings with optional filters |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoListRooms;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoCreateRoom;

// Create tools
$service = app(DailyCoService::class);
$tools = [
    new DailyCoListRooms($service),
    new DailyCoCreateRoom($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a new Daily.co room called "standup" and list all existing rooms');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('daily-co');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\DailyCo\Tools\DailyCoListRooms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\DailyCo\DailyCoService;

$service = app(DailyCoService::class);

// List rooms
$rooms = $service->listRooms(20);

// Get a specific room
$room = $service->getRoom('standup');

// Create a room
$room = $service->createRoom([
    'name' => 'standup',
    'privacy' => 'public',
    'properties' => [
        'max_participants' => 10,
        'enable_recording' => 'cloud',
    ],
]);

// Delete a room
$service->deleteRoom('standup');

// List meetings
$meetings = $service->listMeetings(['room' => 'standup', 'limit' => 10]);

// Get a specific meeting
$meeting = $service->getMeeting('meeting-uuid-here');

// List recordings
$recordings = $service->listRecordings(['room' => 'standup']);
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
- A [Daily.co](https://daily.co) account with API access

## License

MIT — see [LICENSE](LICENSE)
