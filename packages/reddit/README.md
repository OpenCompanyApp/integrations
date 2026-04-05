# Integration: Reddit

> Reddit integration for the [Laravel AI SDK](https://github.com/laravel/ai) — browse subreddits, read and create posts, search content, and post comments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Reddit's social news platform. Browse trending posts, search for content, retrieve detailed subreddit information, and create posts and comments — all through the [Reddit API](https://www.reddit.com/dev/api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Reddit tool lets AI agents browse discussions, search for relevant content, and participate in community conversations — giving agents social awareness and engagement capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-reddit
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Reddit OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'reddit' => [
        'access_token' => env('REDDIT_ACCESS_TOKEN'),
        'url'          => env('REDDIT_URL', 'https://oauth.reddit.com'),
        'user_agent'   => env('REDDIT_USER_AGENT', 'OpenCompany/1.0'),
    ],
];
```

### Obtaining an Access Token

1. Create a Reddit app at [https://www.reddit.com/prefs/apps](https://www.reddit.com/prefs/apps).
2. Use the OAuth2 authorization flow to obtain an access token.
3. Required scopes depend on tool usage: `read` (browsing), `submit` (posting/commenting), `identity` (user profile).

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `reddit_list_posts` | read | List hot posts from a subreddit |
| `reddit_get_post` | read | Get a specific post with its comments |
| `reddit_create_post` | write | Submit a new post (text, link, image, video) |
| `reddit_search` | read | Search Reddit for posts, subreddits, or users |
| `reddit_list_subreddits` | read | List popular subreddits |
| `reddit_get_subreddit` | read | Get detailed subreddit information |
| `reddit_create_comment` | write | Post a comment or reply on a post/comment |
| `reddit_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\Integrations\Reddit\Tools\RedditListPosts;
use OpenCompany\Integrations\Reddit\Tools\RedditSearch;

// Create tools
$service = app(RedditService::class);
$tools = [
    new RedditListPosts($service),
    new RedditSearch($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What are the top posts in r/laravel today?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('reddit');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Reddit\Tools\RedditSearch::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Reddit\RedditService;

$service = app(RedditService::class);

// List hot posts
$posts = $service->listPosts('laravel', limit: 10);

// Get a post with comments
$post = $service->getPost('abc123');

// Search
$results = $service->search('php frameworks', type: 'link', sort: 'new');

// Get subreddit info
$info = $service->getSubreddit('php');

// Create a post
$service->createPost('test', 'Hello from OpenCompany!', 'self', text: 'Testing the integration.');

// Post a comment
$service->createComment('t3_abc123', 'Great post!');

// Current user
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
- A Reddit account with an OAuth2 application configured

## License

MIT — see [LICENSE](LICENSE)
