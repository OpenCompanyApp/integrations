# Integration: Twitter / X

> Twitter/X integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list tweets, search, and manage users via the Twitter API v2. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Twitter data. Retrieve tweets, search recent posts, look up user profiles, and list followers — all through the [Twitter API v2](https://developer.twitter.com/en/docs/twitter-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Twitter tool lets AI agents search tweets, look up user profiles, and monitor social media activity — giving agents real-time social awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-twitter
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Twitter API v2 Bearer token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'twitter' => [
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'url'          => env('TWITTER_API_URL', 'https://api.twitter.com/2'),
    ],
];
```

### Getting a Bearer Token

1. Go to the [Twitter Developer Portal](https://developer.twitter.com/en/portal/dashboard).
2. Create a project and app.
3. Navigate to **Keys and tokens**.
4. Generate a **Bearer Token**.
5. Copy the token and add it to your configuration.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `twitter_list_tweets` | read | List recent tweets with pagination |
| `twitter_get_tweet` | read | Get a single tweet by ID |
| `twitter_list_users` | read | List followers of a user with pagination |
| `twitter_get_user` | read | Get a user's profile by ID |
| `twitter_search_tweets` | read | Search recent tweets matching a query |
| `twitter_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\Integrations\Twitter\Tools\TwitterSearchTweets;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetCurrentUser;

// Create tools
$service = app(TwitterService::class);
$tools = [
    new TwitterSearchTweets($service),
    new TwitterGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Search for recent tweets about Laravel and summarize the sentiment.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('twitter');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Twitter\Tools\TwitterSearchTweets::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Twitter\TwitterService;

$service = app(TwitterService::class);

// Get current user
$me = $service->getCurrentUser();

// Search tweets
$results = $service->searchTweets('laravel php', 10);

// Get a specific tweet
$tweet = $service->getTweet('1234567890', ['created_at', 'public_metrics']);

// Get a user
$user = $service->getUser('2244994945', ['public_metrics', 'description']);

// List followers
$followers = $service->listUsers('2244994945', 100);
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
- A [Twitter Developer](https://developer.twitter.com/) account with API v2 access

## License

MIT — see [LICENSE](LICENSE)
