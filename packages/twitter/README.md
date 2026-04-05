# Integration: Twitter / X

> Twitter/X integration for the [Laravel AI SDK](https://github.com/laravel/ai) — post tweets, search content, manage profiles. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Twitter/X. Post tweets, search recent content, look up user profiles, and manage your account — all through the [Twitter API v2](https://developer.twitter.com/en/docs/twitter-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Twitter tool lets AI agents post tweets, search conversations, and interact with Twitter/X on behalf of your organization — enabling social media management within agent workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-twitter
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Twitter API Bearer Token.

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

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `twitter_get_current_user` | read | Get the authenticated user's profile |
| `twitter_get_user` | read | Get a user by numeric ID |
| `twitter_get_user_by_username` | read | Look up a user by username (handle) |
| `twitter_list_tweets` | read | List recent tweets from a user |
| `twitter_get_tweet` | read | Get a single tweet by ID |
| `twitter_search_tweets` | read | Search recent tweets (last 7 days) |
| `twitter_create_tweet` | write | Post a new tweet |
| `twitter_delete_tweet` | write | Delete a tweet by ID |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\Integrations\Twitter\Tools\TwitterSearchTweets;
use OpenCompany\Integrations\Twitter\Tools\TwitterCreateTweet;

// Create tools
$service = app(TwitterService::class);
$tools = [
    new TwitterSearchTweets($service),
    new TwitterCreateTweet($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Search for recent tweets about Laravel and post a summary');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

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

// Get authenticated user
$me = $service->getCurrentUser(['public_metrics', 'description']);

// Look up a user
$user = $service->getUserByUsername('twitterapi', ['public_metrics']);

// List tweets
$tweets = $service->listTweets($userId, maxResults: 10, tweetFields: ['created_at', 'public_metrics']);

// Search tweets
$results = $service->searchTweets('#Laravel', maxResults: 10, tweetFields: ['author_id', 'created_at']);

// Post a tweet
$tweet = $service->createTweet('Hello from OpenCompany! 🚀');

// Delete a tweet
$service->deleteTweet($tweetId);
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
- A [Twitter Developer](https://developer.twitter.com/) account with API v2 access and a Bearer Token

## License

MIT — see [LICENSE](LICENSE)
