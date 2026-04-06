# Integration: Cal.com

> Cal.com scheduling integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage event types, bookings, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to scheduling and booking management. List event types, view and create bookings, and retrieve user information — all through the [Cal.com](https://cal.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Cal.com tool lets AI agents manage scheduling, check upcoming bookings, and create new appointments — giving agents calendar awareness and booking capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-cal
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Cal.com personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'cal' => [
        'access_token' => env('CAL_ACCESS_TOKEN'),
        'url'          => env('CAL_API_URL', 'https://api.cal.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cal_list_event_types` | read | List available event types (booking link templates) |
| `cal_get_event_type` | read | Get details for a specific event type |
| `cal_list_bookings` | read | List bookings with optional filters |
| `cal_get_booking` | read | Get details for a specific booking |
| `cal_create_booking` | write | Create a new booking for an event type |
| `cal_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\Integrations\Cal\Tools\CalListBookings;
use OpenCompany\Integrations\Cal\Tools\CalCreateBooking;

// Create tools
$service = app(CalService::class);
$tools = [
    new CalListBookings($service),
    new CalCreateBooking($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all confirmed bookings for next week');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('cal');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Cal\Tools\CalListBookings::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Cal\CalService;

$service = app(CalService::class);

// List event types
$eventTypes = $service->listEventTypes(limit: 10);

// Get a specific event type
$eventType = $service->getEventType(42);

// List confirmed bookings
$bookings = $service->listBookings(status: 'confirmed', limit: 20);

// Create a booking
$booking = $service->createBooking(
    eventTypeId: 42,
    start: '2026-04-10T09:00:00Z',
    end: '2026-04-10T09:30:00Z',
    responses: [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ],
);

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
- A [Cal.com](https://cal.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
