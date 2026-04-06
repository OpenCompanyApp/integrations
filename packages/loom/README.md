# Integration: Loom

> Loom video platform integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage videos, workspaces, and user profiles. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the Loom video platform. List and search videos, retrieve video details, create video placeholders, and manage workspaces — all through the [Loom API](https://developer.loom.com/docs/api-reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Loom tool lets AI agents manage video content, retrieve video metadata, and interact with workspaces — giving agents video platform awareness and management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-loom
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Loom personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'loom' => [
        'access_token' => env('LOOM_ACCESS_TOKEN'),
        'url'          => env('LOOM_API_URL', 'https://api.loom.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `loom_list_videos` | read | List Loom videos with pagination |
| `loom_get_video` | read | Get details for a specific video |
| `loom_create_video` | write | Create a new video placeholder |
| `loom_delete_video` | write | Delete a video permanently |
| `loom_list_folders` | read | List Loom folders with pagination |
| `loom_get_folder` | read | Get details for a specific folder |
| `loom_list_workspaces` | read | List all accessible workspaces |
| `loom_get_current_user` | read | Get authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\Integrations\Loom\Tools\LoomListVideos;
use OpenCompany\Integrations\Loom\Tools\LoomGetVideo;

// Create tools
$service = app(LoomService::class);
$tools = [
    new LoomListVideos($service),
    new LoomGetVideo($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent Loom videos');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('loom');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Loom\Tools\LoomListVideos::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Loom\LoomService;

$service = app(LoomService::class);

// List videos
$videos = $service->listVideos(limit: 10, offset: 0);

// Get a specific video
$video = $service->getVideo('video-id-here');

// Create a video
$video = $service->createVideo('My Video Title', 'An optional description');

// Delete a video
$service->deleteVideo('video-id-here');

// List workspaces
$workspaces = $service->listWorkspaces();

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
- A [Loom](https://loom.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
