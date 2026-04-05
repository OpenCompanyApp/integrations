# Integration: Eventbrite

> Eventbrite integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage events, attendees, and venues. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full access to Eventbrite event management. List and search events, create and update events, manage attendees, and handle venues — all through the [Eventbrite API](https://www.eventbrite.com/platform/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Eventbrite tool lets AI agents manage events, track attendees, and create venues — giving agents the ability to handle event workflows end-to-end.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-eventbrite
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Eventbrite private token and organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'eventbrite' => [
        'token'            => env('EVENTBRITE_TOKEN'),
        'organization_id'  => env('EVENTBRITE_ORGANIZATION_ID'),
        'url'              => env('EVENTBRITE_API_URL', 'https://www.eventbriteapi.com/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `eventbrite_list_events` | read | List events for the organization with filtering and pagination |
| `eventbrite_get_event` | read | Get full details for a single event |
| `eventbrite_create_event` | write | Create a new event (in-person or online) |
| `eventbrite_update_event` | write | Update an existing event's details or status |
| `eventbrite_list_attendees` | read | List attendees for an event with profiles and ticket info |
| `eventbrite_get_attendee` | read | Get full details for a single attendee |
| `eventbrite_list_venues` | read | List venues for the organization |
| `eventbrite_create_venue` | write | Create a new venue with address and capacity |
| `eventbrite_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteListEvents;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteCreateEvent;

// Create tools
$service = app(EventbriteService::class);
$tools = [
    new EventbriteListEvents($service),
    new EventbriteCreateEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our upcoming live events on Eventbrite');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('eventbrite');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Eventbrite\Tools\EventbriteListEvents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Eventbrite\EventbriteService;

$service = app(EventbriteService::class);

// List live events
$events = $service->listEvents(['status' => 'live']);

// Get a specific event
$event = $service->getEvent('123456789');

// Create an event
$event = $service->createEvent([
    'event' => [
        'name' => ['html' => 'Tech Meetup 2026'],
        'start' => ['utc' => '2026-06-15T18:00:00Z'],
        'end' => ['utc' => '2026-06-15T21:00:00Z'],
        'currency' => 'USD',
    ],
]);

// List attendees
$attendees = $service->listAttendees('123456789');

// Create a venue
$venue = $service->createVenue([
    'venue' => [
        'name' => 'Convention Center',
        'address' => [
            'address_1' => '123 Main St',
            'city' => 'San Francisco',
            'country' => 'US',
        ],
    ],
]);
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
- An [Eventbrite](https://www.eventbrite.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
