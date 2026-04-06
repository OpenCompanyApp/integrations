# Integration: Raindrop.io

> Raindrop.io bookmark manager integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage bookmarks and collections. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to bookmark management. Save, search, organize, and retrieve bookmarks and collections — all through the [Raindrop.io](https://raindrop.io) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Raindrop.io tool lets AI agents manage bookmarks — saving links, searching saved content, and organizing collections — giving agents knowledge management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-raindrop
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Raindrop.io access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'raindrop' => [
        'access_token' => env('RAINDROP_ACCESS_TOKEN'),
        'url'          => env('RAINDROP_URL', 'https://api.raindrop.io/rest/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `raindrop_list_bookmarks` | read | List bookmarks with optional collection and search filters |
| `raindrop_get_bookmark` | read | Get a single bookmark by ID |
| `raindrop_create_bookmark` | write | Save a new bookmark (URL, title, tags, collection) |
| `raindrop_update_bookmark` | write | Update an existing bookmark's fields |
| `raindrop_list_collections` | read | List all bookmark collections |
| `raindrop_get_collection` | read | Get details of a specific collection |
| `raindrop_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\Integrations\Raindrop\Tools\RaindropListBookmarks;
use OpenCompany\Integrations\Raindrop\Tools\RaindropCreateBookmark;

// Create tools
$service = app(RaindropService::class);
$tools = [
    new RaindropListBookmarks($service),
    new RaindropCreateBookmark($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Save this link to my bookmarks: https://laravel.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('raindrop');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Raindrop\Tools\RaindropListBookmarks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Raindrop\RaindropService;

$service = app(RaindropService::class);

// List bookmarks
$bookmarks = $service->listBookmarks(collectionId: 0, page: 1);

// Search bookmarks
$results = $service->listBookmarks(search: 'laravel');

// Create a bookmark
$bookmark = $service->createBookmark(
    link: 'https://laravel.com/docs',
    title: 'Laravel Documentation',
    tags: ['php', 'framework'],
    collectionId: 42,
);

// Get a single bookmark
$bookmark = $service->getBookmark(12345);

// Update a bookmark
$service->updateBookmark(12345, [
    'title' => 'Updated Title',
    'tags' => ['updated'],
]);

// List collections
$collections = $service->listCollections();

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
- A [Raindrop.io](https://raindrop.io) account

## License

MIT — see [LICENSE](LICENSE)
