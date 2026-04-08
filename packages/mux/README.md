# Integration: Mux

> Mux video integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage on-demand assets, live streams, and realtime viewer data. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Mux](https://mux.com) video infrastructure. List and create video assets, manage live streams, and retrieve realtime viewer data — all through the Mux API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mux integration lets AI agents manage video assets and live streams, and monitor realtime viewership — giving agents media-awareness capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mux
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Mux access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mux' => [
        'access_token' => env('MUX_ACCESS_TOKEN'),
        'url'          => env('MUX_API_URL', 'https://api.mux.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mux_list_assets` | read | List video assets stored in Mux |
| `mux_get_asset` | read | Retrieve details of a specific video asset |
| `mux_create_asset` | write | Create a new video asset from an input URL |
| `mux_list_live_streams` | read | List live streams in Mux |
| `mux_get_live_stream` | read | Retrieve details of a specific live stream |
| `mux_create_live_stream` | write | Create a new live stream |
| `mux_get_current_user` | read | Get realtime viewer data from Mux Data |

## Quick Start

```php
use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\Integrations\Mux\Tools\MuxListAssets;
use OpenCompany\Integrations\Mux\Tools\MuxCreateAsset;

// Create tools
$service = app(MuxService::class);
$tools = [
    new MuxListAssets($service),
    new MuxCreateAsset($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all video assets and create a new one from https://example.com/video.mp4');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mux');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mux\Tools\MuxListAssets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mux\MuxService;

$service = app(MuxService::class);

// List assets
$assets = $service->listAssets(limit: 10);

// Get a specific asset
$asset = $service->getAsset('abc123xyz');

// Create an asset
$newAsset = $service->createAsset(
    input: 'https://storage.example.com/video.mp4',
    playbackPolicy: ['public'],
);

// List live streams
$streams = $service->listLiveStreams();

// Create a live stream
$stream = $service->createLiveStream(
    playbackPolicy: ['public'],
    newAssetSettings: ['mp4_support' => 'standard'],
);

// Get realtime data
$realtime = $service->getRealtime();
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
- A [Mux](https://mux.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
