# Integration: Fellow

> Fellow meeting management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list meetings, manage notes, action items, and goals. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to meeting management. List upcoming and past meetings, create notes, track action items, and monitor goals — all through the [Fellow](https://fellow.app) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Fellow tool lets AI agents access meeting data, create notes, and track action items — giving agents context-aware meeting intelligence.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-fellow
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Fellow API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'fellow' => [
        'access_token' => env('FELLOW_ACCESS_TOKEN'),
        'url'          => env('FELLOW_URL', 'https://api.fellow.app/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `fellow_list_meetings` | read | List meetings with date filters and pagination |
| `fellow_get_meeting` | read | Get details of a specific meeting |
| `fellow_create_note` | write | Create a note for a meeting |
| `fellow_list_action_items` | read | List action items with pagination |
| `fellow_list_goals` | read | List goals |
| `fellow_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\Integrations\Fellow\Tools\FellowListMeetings;
use OpenCompany\Integrations\Fellow\Tools\FellowCreateNote;

// Create tools
$service = app(FellowService::class);
$tools = [
    new FellowListMeetings($service),
    new FellowCreateNote($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What meetings do I have today?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('fellow');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Fellow\Tools\FellowListMeetings::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Fellow\FellowService;

$service = app(FellowService::class);

// List meetings
$meetings = $service->listMeetings(['date_from' => '2026-04-01', 'date_to' => '2026-04-30']);

// Get a specific meeting
$meeting = $service->getMeeting('meeting-uuid-here');

// Create a note
$note = $service->createNote('meeting-uuid-here', [
    'content' => 'Key decisions from the meeting...',
]);

// List action items
$actionItems = $service->listActionItems(['status' => 'open']);

// List goals
$goals = $service->listGoals();

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
- A [Fellow](https://fellow.app) account with API access

## License

MIT — see [LICENSE](LICENSE)
