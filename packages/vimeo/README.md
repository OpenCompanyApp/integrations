# Integration: Vimeo

> Vimeo video integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list, get, and create videos, manage albums and folders. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Vimeo video management. List and search videos, retrieve video details, create upload slots, and browse albums and folders — all through the [Vimeo API](https://developer.vimeo.com/api/reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Vimeo integration lets AI agents manage video content, search and browse video libraries, and initiate uploads — giving agents media management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vimeo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Vimeo personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'vimeo' => [
        'access_token' => env('VIMEO_ACCESS_TOKEN'),
        'base_url'     => env('VIMEO_BASE_URL', 'https://api.vimeo.com'),
    ],
];
```

Generate a personal access token at [developer.vimeo.com/apps](https://developer.vimeo.com/apps) with the scopes you need (`public`, `private`, `create`, `edit`, `delete`, `interact`, `upload`, `stats`).

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vimeo_list_videos` | read | List videos with pagination, query search, and filters |
| `vimeo_get_video` | read | Get detailed video information by ID |
| `vimeo_create_video` | write | Create a new video upload slot (pull, post, or streaming) |
| `vimeo_list_albums` | read | List albums (showcases) with pagination |
| `vimeo_list_folders` | read | List folders (projects) with pagination |
| `vimeo_get_current_user` | read | Get the authenticated user's Vimeo profile |

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

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

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
$videos = $service->listVideos(['per_page' => 10, 'sort' => 'date']);

// Get a video
$video = $service->getVideo('123456789');

// Create an upload slot (pull approach)
$result = $service->createVideo([
    'upload' => ['approach' => 'pull', 'link' => 'https://example.com/video.mp4'],
    'name' => 'My Video',
]);

// List albums
$albums = $service->listAlbums(['per_page' => 10]);

// List folders
$folders = $service->listFolders();

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
- A [Vimeo](https://vimeo.com) account with a personal access token

## License

MIT — see [LICENSE](LICENSE)
