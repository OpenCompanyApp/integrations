# Integration: NASA

> NASA API integration for Laravel: APOD, Mars rover photos, asteroid tracking, DONKI space weather, EPIC Earth imagery, Earth assets, Image Library, and EONET events. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [NASA's Open APIs](https://api.nasa.gov). Fetch the Astronomy Picture of the Day, browse Mars rover photos, track near-Earth asteroids, query space-weather events, inspect Earth imagery, search the NASA Image and Video Library, and monitor EONET natural events through a clean tool interface.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This NASA tool lets AI agents access space science data, imagery, and astronomical information — enabling science-aware agents in your workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-nasa
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

The NASA API is **public** and works out of the box with the shared `DEMO_KEY`. For higher rate limits, register for a free API key at [api.nasa.gov](https://api.nasa.gov).

**In OpenCompany**, the integration is available immediately with the default DEMO_KEY.

**For standalone usage**, add to `config/services.php`:

```php
return [
    'nasa' => [
        'api_key' => env('NASA_API_KEY', 'DEMO_KEY'),
        'url'     => env('NASA_API_URL', 'https://api.nasa.gov'),
    ],
];
```

### Rate Limits

| API Key | Requests per hour | Requests per day |
|---------|-------------------|------------------|
| `DEMO_KEY` | 30 | 50 |
| Personal key (free) | 1,000 | — |

Get your free key at [api.nasa.gov](https://api.nasa.gov).

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `nasa_get_apod` | read | Astronomy Picture of the Day: single date, range, or random count |
| `nasa_get_mars_rover_photos` | read | Photos from Curiosity, Opportunity, Spirit, or Perseverance |
| `nasa_get_asteroids` | read | Near Earth Objects (asteroids) for a date range |
| `nasa_browse_asteroids` | read | Browse the overall Near Earth Object dataset |
| `nasa_get_asteroid` | read | Detailed info for a specific asteroid by NASA ID |
| `nasa_get_donki_events` | read | DONKI space-weather event endpoints |
| `nasa_get_epic_images` | read | EPIC latest image metadata, date metadata, or available dates |
| `nasa_get_earth_imagery` | read | Earth imagery for a coordinate |
| `nasa_get_earth_assets` | read | Available Earth asset dates for a coordinate |
| `nasa_search_images` | read | Search the NASA Image and Video Library |
| `nasa_get_image_asset` | read | Image Library asset manifest by NASA ID |
| `nasa_get_image_metadata` | read | Image Library metadata document by NASA ID |
| `nasa_get_image_captions` | read | Image Library caption locations by NASA ID |
| `nasa_get_eonet_events` | read | EONET v3 natural events |
| `nasa_get_eonet_event` | read | One EONET v3 event by ID |
| `nasa_get_eonet_categories` | read | EONET v3 event categories |
| `nasa_get_eonet_sources` | read | EONET v3 event sources |

## Quick Start

```php
use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\Integrations\Nasa\Tools\NasaGetApod;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;

// Create tools
$service = app(NasaService::class);
$tools = [
    new NasaGetApod($service),
    new NasaSearchImages($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me today\'s astronomy picture of the day');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 17 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('nasa');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Nasa\Tools\NasaGetApod::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Nasa\NasaService;

$service = app(NasaService::class);

// Astronomy Picture of the Day
$apod = $service->getApod(date: '2025-06-15');

// APOD for a date range
$apods = $service->getApod(startDate: '2025-06-01', endDate: '2025-06-07');

// Mars rover photos (Curiosity, sol 1000)
$photos = $service->getMarsRoverPhotos('curiosity', sol: 1000);

// Asteroids near Earth this week
$asteroids = $service->getAsteroids(startDate: '2025-06-01', endDate: '2025-06-08');

// Browse asteroid IDs
$browse = $service->browseAsteroids(page: 0, size: 20);

// Specific asteroid details
$asteroid = $service->getAsteroid('2534304');

// DONKI solar flare events
$flares = $service->getDonkiEvents('FLR', ['startDate' => '2025-06-01']);

// EPIC latest natural-color image metadata
$epic = $service->getEpicImages('natural');

// Search NASA images
$images = $service->searchImages('black hole');
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
- A [NASA API key](https://api.nasa.gov) (optional — `DEMO_KEY` works for testing)

## License

MIT — see [LICENSE](LICENSE)
