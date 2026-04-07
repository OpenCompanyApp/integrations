# Integration: Instagram

> Instagram integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage media, comments, and insights via the Instagram Graph API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Instagram publishing and analytics. List and publish media, read comments, track engagement insights, and look up account details — all through the [Instagram Graph API](https://developers.facebook.com/docs/instagram-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Instagram tool lets AI agents manage social media publishing, monitor comments, and track performance metrics — enabling automated Instagram workflows within the OpenCompany workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-instagram
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Instagram Graph API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'instagram' => [
        'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
        'url'          => env('INSTAGRAM_URL', 'https://graph.instagram.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `instagram_list_media` | read | List media published by the authenticated user |
| `instagram_get_media` | read | Get details of a specific media item by ID |
| `instagram_create_media` | write | Publish a new media item (photo or video) |
| `instagram_list_comments` | read | List comments on a specific media item |
| `instagram_get_comment` | read | Get details of a specific comment by ID |
| `instagram_list_insights` | read | Get account-level insights and performance metrics |
| `instagram_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\Integrations\Instagram\Tools\InstagramListMedia;
use OpenCompany\Integrations\Instagram\Tools\InstagramCreateMedia;

// Create tools
$service = app(InstagramService::class);
$tools = [
    new InstagramListMedia($service),
    new InstagramCreateMedia($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our recent Instagram posts and their engagement');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('instagram');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Instagram\Tools\InstagramListMedia::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Instagram\InstagramService;

$service = app(InstagramService::class);

// List media
$media = $service->listMedia(limit: 25);

// Get a specific media item
$item = $service->getMedia('17895695668004550');

// Publish a new photo
$result = $service->createMedia(
    imageUrl: 'https://example.com/photo.jpg',
    caption: 'Check out our latest product! 🚀',
);

// List comments on a media item
$comments = $service->listComments('17895695668004550', limit: 20);

// Get a specific comment
$comment = $service->getComment('17853788044894720');

// Get account insights
$insights = $service->listInsights(
    metric: 'impressions,reach,follower_count',
    period: 'day',
);

// Get current user
$me = $service->getCurrentUser();
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
- An [Instagram Business or Creator account](https://developers.facebook.com/docs/instagram-api/getting-started) with Graph API access

## License

MIT — see [LICENSE](LICENSE)
