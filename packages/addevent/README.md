# Integration: AddEvent

> AddEvent integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage calendar events, categories, and groups. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to calendar event management. Create and browse events, organize them with categories and groups — all through the [AddEvent](https://www.addevent.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This AddEvent tool lets AI agents manage calendar events, browse categories, and organize events into groups — giving agents scheduling and event management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-addevent
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an AddEvent access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'addevent' => [
        'access_token' => env('ADDEVENT_ACCESS_TOKEN'),
        'url'          => env('ADDEVENT_URL', 'https://api.addevent.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `addevent_list_events` | read | List calendar events with pagination and category filtering |
| `addevent_get_event` | read | Get details for a specific event |
| `addevent_create_event` | write | Create a new calendar event |
| `addevent_list_categories` | read | List all event categories |
| `addevent_list_groups` | read | List event groups with pagination |
| `addevent_get_group` | read | Get details for a specific group |
| `addevent_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListEvents;
use OpenCompany\Integrations\AddEvent\Tools\AddEventCreateEvent;

// Create tools
$service = app(AddEventService::class);
$tools = [
    new AddEventListEvents($service),
    new AddEventCreateEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my upcoming events');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('addevent');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\AddEvent\Tools\AddEventListEvents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\AddEvent\AddEventService;

$service = app(AddEventService::class);

// List events
$events = $service->listEvents(limit: 10, page: 1);

// Get a specific event
$event = $service->getEvent(12345);

// Create an event
$event = $service->createEvent(
    title: 'Team Standup',
    startDate: '2026-04-10T09:00:00',
    endDate: '2026-04-10T09:30:00',
    location: 'Zoom Meeting Room',
    description: 'Daily team standup meeting',
);

// List categories
$categories = $service->listCategories();

// List groups
$groups = $service->listGroups();

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
- An [AddEvent](https://www.addevent.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
