# Integration: Google Calendar

> Google Calendar integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list events, create events, manage calendars. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Calendar. List upcoming events, create new meetings, browse calendars, and verify the connected user — all through the [Google Calendar API v3](https://developers.google.com/calendar/api/v3/reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Calendar tool lets AI agents view schedules, book meetings, and manage calendar events — enabling agents to coordinate with humans on timing and availability.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-calendar
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth2 access token with calendar scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-calendar' => [
        'access_token' => env('GOOGLE_CALENDAR_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_CALENDAR_URL', 'https://www.googleapis.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gcalendar_list_events` | read | List events on a calendar with optional time range, search, and ordering |
| `gcalendar_get_event` | read | Get details of a specific event |
| `gcalendar_create_event` | write | Create a new event with summary, times, attendees, location |
| `gcalendar_list_calendars` | read | List all calendars on the user's account |
| `gcalendar_get_calendar` | read | Get details of a specific calendar |
| `gcalendar_list_colors` | read | Get available color definitions for events and calendars |
| `gcalendar_get_current_user` | read | Get the authenticated user's profile info |

## Quick Start

```php
use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarListEvents;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarCreateEvent;

// Create tools
$service = app(GoogleCalendarService::class);
$tools = [
    new GoogleCalendarListEvents($service),
    new GoogleCalendarCreateEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What do I have on my calendar today?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-calendar');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarListEvents::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;

$service = app(GoogleCalendarService::class);

// List events for the coming week
$events = $service->listEvents('primary', [
    'timeMin' => '2026-04-06T00:00:00Z',
    'timeMax' => '2026-04-13T00:00:00Z',
    'orderBy' => 'startTime',
]);

// Get a specific event
$event = $service->getEvent('primary', 'event_id_here');

// Create a new event
$event = $service->createEvent('primary', [
    'summary' => 'Team Standup',
    'start' => ['dateTime' => '2026-04-06T10:00:00+02:00', 'timeZone' => 'Europe/Amsterdam'],
    'end' => ['dateTime' => '2026-04-06T10:30:00+02:00', 'timeZone' => 'Europe/Amsterdam'],
    'attendees' => [['email' => 'alice@example.com']],
    'location' => 'https://meet.google.com/abc-defg-hij',
]);

// List calendars
$calendars = $service->listCalendars();

// Get calendar colors
$colors = $service->listColors();

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
- A Google account with an OAuth2 access token (calendar scope)

## License

MIT — see [LICENSE](LICENSE)
