# Integration: HeyGen

> HeyGen AI video generation integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create videos, manage avatars, list voices, and more. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to AI-powered video generation. Create videos with customizable avatars and voices, manage your avatar library, and monitor video status — all through the [HeyGen](https://www.heygen.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This HeyGen tool lets AI agents generate AI videos, manage avatars, and query account information — enabling automated video content creation workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-heygen
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a HeyGen API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'heygen' => [
        'api_key' => env('HEYGEN_API_KEY'),
        'url'     => env('HEYGEN_URL', 'https://api.heygen.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `heygen_create_video` | write | Generate a new AI video with an avatar and voice |
| `heygen_get_video` | read | Get the status and details of a video |
| `heygen_list_videos` | read | List generated videos with pagination |
| `heygen_list_avatars` | read | List available avatars for video generation |
| `heygen_get_avatar` | read | Get details of a specific avatar |
| `heygen_list_voices` | read | List available voices for video generation |
| `heygen_create_avatar` | write | Create a new custom avatar |
| `heygen_get_current_user` | read | Get the authenticated user's account information |

## Quick Start

```php
use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateVideo;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenGetVideo;

// Create tools
$service = app(HeyGenService::class);
$tools = [
    new HeyGenCreateVideo($service),
    new HeyGenGetVideo($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a short product demo video using the default avatar');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('heygen');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateVideo::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\HeyGen\HeyGenService;

$service = app(HeyGenService::class);

// Create a video
$video = $service->createVideo([
    'video_inputs' => [
        [
            'avatar' => ['avatar_id' => 'avatar_abc123', 'avatar_style' => 'normal'],
            'voice'  => ['voice_id' => 'voice_def456'],
            'script' => ['text' => 'Hello world!'],
        ],
    ],
    'test' => true,
]);

// Check video status
$status = $service->getVideo($video['data']['video_id']);

// List avatars
$avatars = $service->listAvatars();

// List voices
$voices = $service->listVoices();

// Get user info
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
- A [HeyGen](https://www.heygen.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
