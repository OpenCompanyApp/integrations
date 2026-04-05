# Integration: Hacker News

> Hacker News integration for the [Laravel AI SDK](https://github.com/laravel/ai) — fetch stories, items, and user profiles. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Hacker News](https://news.ycombinator.com) content. Fetch top, new, and best stories, look up individual items (stories, comments, jobs), and retrieve user profiles — all through the public HN API. **No authentication required.**

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Hacker News tool lets AI agents monitor tech news, look up discussions, and reference HN content in conversations and workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-hackernews
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

No API key or credentials are needed — the Hacker News API is fully public.

**Optionally**, you can override the base URL (e.g., for testing or caching proxies):

```php
// config/services.php
'hackernews' => [
    'url' => env('HACKERNEWS_API_URL', 'https://hacker-news.firebaseio.com/v0'),
],
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `hackernews_get_item` | read | Fetch a single item (story, comment, job, poll) by ID |
| `hackernews_get_user` | read | Fetch a user profile by username |
| `hackernews_list_top_stories` | read | Current top stories (ranked by HN algorithm) |
| `hackernews_list_new_stories` | read | Newest submitted stories |
| `hackernews_list_best_stories` | read | Highest-scoring stories of all time |

## Quick Start

```php
use OpenCompany\Integrations\HackerNews\HackerNewsService;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsListTopStories;
use OpenCompany\Integrations\HackerNews\Tools\HackerNewsGetItem;

// Create tools
$service = app(HackerNewsService::class);
$tools = [
    new HackerNewsListTopStories($service),
    new HackerNewsGetItem($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top 10 Hacker News stories right now?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('hackernews');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\HackerNews\Tools\HackerNewsListTopStories::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\HackerNews\HackerNewsService;

$service = app(HackerNewsService::class);

// Get top 10 stories
$ids = $service->topStories();
$stories = $service->fetchItems($ids, 10);

// Get a specific item
$item = $service->getItem(12345);

// Get a user profile
$user = $service->getUser('pg');
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

## License

MIT — see [LICENSE](LICENSE)
