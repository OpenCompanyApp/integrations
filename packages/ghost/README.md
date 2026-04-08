# Integration: Ghost CMS

> Ghost CMS integration for [OpenCompany](https://github.com/OpenCompanyApp) — manage posts, pages, members, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full access to your Ghost CMS content. List, create, and update blog posts, manage static pages, view newsletter members, and verify credentials — all through the [Ghost Admin API](https://ghost.org/docs/admin-api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Ghost integration lets AI agents publish and manage content, review member lists, and interact with your blog — enabling content-driven workflows and data-aware agents.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ghost
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Ghost Admin API key and your Ghost API base URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'ghost' => [
        'api_key' => env('GHOST_ADMIN_API_KEY'),
        'url'     => env('GHOST_API_URL', 'https://yoursite.ghost.io/ghost/api/admin'),
    ],
];
```

### Getting Your Credentials

1. Go to your Ghost Admin panel → **Settings** → **Integrations**
2. Click **Add custom integration** and give it a name (e.g. "OpenCompany")
3. Copy the **Admin API Key** (format: `id:secret`)
4. Your API base URL is `https://yoursite.ghost.io/ghost/api/admin` for Ghost(Pro), or `https://yourdomain.com/ghost/api/admin` for self-hosted

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `ghost_list_posts` | read | List blog posts with filtering, pagination, and ordering |
| `ghost_get_post` | read | Get a single post by ID with full content |
| `ghost_create_post` | write | Create a new post (title, HTML, status, tags, authors) |
| `ghost_update_post` | write | Update an existing post |
| `ghost_list_pages` | read | List static pages with filtering and pagination |
| `ghost_list_members` | read | List newsletter members with filtering and pagination |
| `ghost_get_current_user` | read | Get the authenticated Ghost admin user |

## Quick Start

```php
use OpenCompany\Integrations\Ghost\GhostService;
use OpenCompany\Integrations\Ghost\Tools\GhostListPosts;
use OpenCompany\Integrations\Ghost\Tools\GhostCreatePost;

// Create tools
$service = app(GhostService::class);
$tools = [
    new GhostListPosts($service),
    new GhostCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the 5 most recent published posts from my Ghost blog');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('ghost');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Ghost\Tools\GhostListPosts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Ghost\GhostService;

$service = app(GhostService::class);

// List published posts
$posts = $service->listPosts(['filter' => 'status:published', 'limit' => 10]);

// Get a single post
$post = $service->getPost('64a1b2c3d4e5f6g7h8i9j0k');

// Create a post
$newPost = $service->createPost([
    'title' => 'Hello World',
    'html' => '<p>My first post!</p>',
    'status' => 'draft',
    'tags' => ['News'],
]);

// Update a post
$service->updatePost('64a1b2c3d4e5f6g7h8i9j0k', [
    'status' => 'published',
]);

// List pages
$pages = $service->listPages();

// List members
$members = $service->listMembers(['filter' => 'subscribed:true']);

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
- A [Ghost](https://ghost.org) instance with Admin API access

## License

MIT — see [LICENSE](LICENSE)
