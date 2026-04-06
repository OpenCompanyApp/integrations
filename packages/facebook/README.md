# Integration: Facebook

> Facebook Graph API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage pages, publish posts, and view insights. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Facebook Pages. List and inspect pages, publish and retrieve posts, and pull engagement insights — all through the [Facebook Graph API](https://developers.facebook.com/docs/graph-api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Facebook tool lets AI agents manage social media presence, publish content, and analyze page performance — giving agents social media awareness and publishing capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-facebook
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Facebook Page access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'facebook' => [
        'access_token' => env('FACEBOOK_ACCESS_TOKEN'),
        'base_url'     => env('FACEBOOK_GRAPH_URL', 'https://graph.facebook.com/v21.0'),
    ],
];
```

### Required Permissions

The access token needs the following Facebook permissions:

| Permission | Purpose |
|-----------|---------|
| `pages_show_list` | List managed pages |
| `pages_read_engagement` | Read post engagement data |
| `pages_read_user_content` | Read page posts and content |
| `pages_manage_posts` | Create and publish posts |
| `pages_manage_metadata` | Read page details |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `facebook_list_pages` | read | List all Facebook Pages the user manages |
| `facebook_get_page` | read | Get details for a specific page |
| `facebook_list_posts` | read | List posts published by a page |
| `facebook_create_post` | write | Publish a new post on a page |
| `facebook_get_post` | read | Get details for a specific post |
| `facebook_list_insights` | read | Get engagement and performance metrics |
| `facebook_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\Integrations\Facebook\Tools\FacebookListPages;
use OpenCompany\Integrations\Facebook\Tools\FacebookCreatePost;

// Create tools
$service = app(FacebookService::class);
$tools = [
    new FacebookListPages($service),
    new FacebookCreatePost($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our Facebook pages and post a weekly update on the main page');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('facebook');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Facebook\Tools\FacebookListPages::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Facebook\FacebookService;

$service = app(FacebookService::class);

// List pages
$pages = $service->listPages();

// Get a page
$page = $service->getPage('123456789');

// List posts
$posts = $service->listPosts('123456789');

// Publish a post
$post = $service->createPost('123456789', 'Hello from OpenCompany!');

// Get post details
$postDetails = $service->getPost('123456789_987654321');

// Get insights
$insights = $service->listInsights('123456789', [
    'metric' => 'page_impressions,page_engaged_users',
    'period' => 'day',
]);

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
- A [Facebook](https://developers.facebook.com/) developer account with a Page access token

## License

MIT — see [LICENSE](LICENSE)
