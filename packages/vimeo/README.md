# Integration: Vimeo

> Vimeo integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage videos, albums, and channels via the Vimeo API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Vimeo video management. List and search videos, manage albums and channels, create upload tickets, and more — all through the [Vimeo API](https://developer.vimeo.com/api/reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Vimeo tool lets AI agents manage video content, browse albums, and interact with channels — giving agents media management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vimeo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Vimeo personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'vimeo' => [
        'access_token' => env('VIMEO_ACCESS_TOKEN'),
        'url'          => env('VIMEO_API_URL', 'https://api.vimeo.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vimeo_list_videos` | read | List videos for the authenticated user (paginated) |
| `vimeo_get_video` | read | Get details for a single video by ID |
| `vimeo_upload_video` | write | Create an upload ticket for a new video |
| `vimeo_delete_video` | write | Delete a video permanently |
| `vimeo_list_albums` | read | List albums (showcases) for the authenticated user |
| `vimeo_get_album` | read | Get details for a single album by ID |
| `vimeo_list_channels` | read | List public Vimeo channels |
| `vimeo_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetVideo;

// Create tools
$service = app(VimeoService::class);
$tools = [
    new VimeoListVideos($service),
    new VimeoGetVideo($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my 5 most recent Vimeo videos');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('vimeo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Vimeo\VimeoService;

$service = app(VimeoService::class);

// List videos
$videos = $service->listVideos(page: 1, perPage: 10);

// Get a video
$video = $service->getVideo('123456789');

// Create upload ticket
$ticket = $service->uploadVideo([
    'name' => 'My Video',
    'description' => 'Video description',
]);

// List albums
$albums = $service->listAlbums();

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
- A [Vimeo](https://vimeo.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
