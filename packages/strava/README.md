# Integration: Strava

> Strava fitness/activity integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list activities, view athlete profiles, manage clubs. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to fitness and activity data. List recent workouts, retrieve detailed activity information, create manual activities, and explore athlete profiles and clubs — all through the [Strava API](https://developers.strava.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Strava integration lets AI agents query fitness activities, retrieve athlete profiles, and explore clubs — giving agents awareness of team health, fitness goals, and activity trends.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-strava
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Strava access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'strava' => [
        'access_token' => env('STRAVA_ACCESS_TOKEN'),
        'url'          => env('STRAVA_URL', 'https://www.strava.com/api/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `strava_list_activities` | read | List recent activities for the authenticated athlete (paginated, with date filters) |
| `strava_get_activity` | read | Get detailed information about a specific activity |
| `strava_create_activity` | write | Create a manual activity (name, type, start date, elapsed time) |
| `strava_get_athlete` | read | Get the authenticated athlete's profile |
| `strava_list_clubs` | read | List clubs the authenticated athlete belongs to |
| `strava_get_current_user` | read | Get the current authenticated user's profile (alias for Get Athlete) |

## Quick Start

```php
use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\Integrations\Strava\Tools\StravaListActivities;
use OpenCompany\Integrations\Strava\Tools\StravaGetAthlete;

// Create tools
$service = app(StravaService::class);
$tools = [
    new StravaListActivities($service),
    new StravaGetAthlete($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What were my last 5 runs?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('strava');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Strava\Tools\StravaListActivities::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Strava\StravaService;

$service = app(StravaService::class);

// List activities
$activities = $service->listActivities(page: 1, perPage: 10);

// Get a specific activity
$activity = $service->getActivity(1234567890);

// Create a manual activity
$activity = $service->createActivity(
    name: 'Morning Run',
    type: 'Run',
    startDateLocal: '2025-01-15T09:30:00',
    elapsedTime: 1800,
    extra: ['distance' => 5000, 'description' => 'Easy run in the park'],
);

// Get athlete profile
$athlete = $service->getAthlete();

// List clubs
$clubs = $service->listClubs();
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
- A [Strava](https://www.strava.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
