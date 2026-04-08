# Integration: Beamer

> Beamer integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage changelog posts, comments, categories, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your product changelog and announcements. Create posts, retrieve feedback, manage categories — all through the [Beamer](https://www.getbeamer.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Beamer tool lets AI agents manage changelogs and announcements, read user feedback via comments, and organize content by category — keeping users informed and engaged.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-beamer
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Beamer API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'beamer' => [
        'api_key' => env('BEAMER_API_KEY'),
        'url'     => env('BEAMER_URL', 'https://api.getbeamer.com/v0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `beamer_list_posts` | read | List changelog posts with pagination and status filtering |
| `beamer_get_post` | read | Retrieve a single post by ID |
| `beamer_create_post` | write | Create a new post with title, content, category, and optional date |
| `beamer_list_comments` | read | List comments on a specific post |
| `beamer_get_current_user` | read | Get the authenticated Beamer user profile |
| `beamer_list_categories` | read | List all post categories |

## Quick Start

```php
use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\Integrations\Beamer\Tools\BeamerListPosts;
use OpenCompany\Integrations\Beamer\Tools\BeamerCreatePost;

// Create tools
$service = app(BeamerService::class);
$tools = [
    new BeamerListPosts($service),
    new BeamerCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our latest 5 published announcements');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('beamer');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Beamer\Tools\BeamerListPosts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Beamer\BeamerService;

$service = app(BeamerService::class);

// List published posts
$posts = $service->listPosts(limit: 10, page: 1, status: 'published');

// Get a specific post
$post = $service->getPost(123);

// Create a new post
$service->createPost(
    title: 'New Feature: Dark Mode',
    content: '<p>We just launched dark mode support!</p>',
    category: 5,
);

// List comments on a post
$comments = $service->listComments(123);

// Get current user
$user = $service->getCurrentUser();

// List categories
$categories = $service->listCategories();
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
- A [Beamer](https://www.getbeamer.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
