# Integration: HeyGen

> HeyGen AI video generation integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create videos, manage avatars, voices, and templates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to AI-powered video generation. Create talking avatar videos, list available avatars and voices, manage templates, and track video status — all through the [HeyGen](https://heygen.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This HeyGen tool lets AI agents generate AI videos, check rendering progress, and browse available avatars, voices, and templates — enabling automated video production workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-heygen
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a HeyGen API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'heygen' => [
        'access_token' => env('HEYGEN_API_TOKEN'),
        'url'          => env('HEYGEN_API_URL', 'https://api.heygen.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `heygen_list_videos` | read | List generated videos with pagination |
| `heygen_get_video` | read | Get status and details of a specific video |
| `heygen_create_video` | write | Generate a new AI video with avatars and voices |
| `heygen_list_avatars` | read | List all available talking avatars |
| `heygen_list_voices` | read | List all available voices |
| `heygen_get_current_user` | read | Get authenticated user's account information |
| `heygen_list_templates` | read | List available video templates |

## Quick Start

```php
use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenListAvatars;
use OpenCompany\Integrations\HeyGen\Tools\HeyGenCreateVideo;

// Create tools
$service = app(HeyGenService::class);
$tools = [
    new HeyGenListAvatars($service),
    new HeyGenCreateVideo($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my available avatars and create a test video with the first one.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('heygen');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\HeyGen\Tools\HeyGenListAvatars::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\HeyGen\HeyGenService;

$service = app(HeyGenService::class);

// List avatars
$avatars = $service->listAvatars();

// List voices
$voices = $service->listVoices();

// Create a video
$result = $service->createVideo(
    videoInputs: [
        [
            'character' => [
                'avatar_id' => 'avatar-abc123',
                'voice_id' => 'voice-xyz789',
            ],
            'script' => 'Welcome to our product demo!',
        ],
    ],
    test: true,
);

$videoId = $result['data']['video_id'];

// Check video status
$status = $service->getVideo($videoId);

// List templates
$templates = $service->listTemplates(limit: 20);

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
- A [HeyGen](https://heygen.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
