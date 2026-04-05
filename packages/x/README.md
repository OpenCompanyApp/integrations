# Integration: X / X

> X/X integration for [OpenCompany](https://github.com/OpenCompanyApp) — read and post tweets, look up user profiles via the X API v2. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to X/X. Retrieve tweets, post new tweets with media and reply settings, and look up user profiles — all through the [X API v2](https://developer.x.com/en/docs/x-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This X tool lets AI agents read tweets, post updates, and look up user information — enabling social media monitoring, engagement, and publishing workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-x
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a X Bearer Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'x' => [
        'access_token' => env('TWITTER_BEARER_TOKEN'),
        'base_url'     => env('TWITTER_API_URL', 'https://api.x.com/2'),
    ],
];
```

### Getting Your Bearer Token

1. Go to the [X Developer Portal](https://developer.x.com/en/portal/dashboard)
2. Create a new app (or select an existing one)
3. Navigate to **Keys and tokens**
4. Generate a **Bearer Token**
5. Copy the token and add it to your configuration

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `x_get_tweet` | read | Get a single tweet by ID with optional metrics and expansions |
| `x_list_tweets` | read | Look up multiple tweets by IDs (max 100) |
| `x_create_tweet` | write | Post a new tweet (text, reply settings, media) |
| `x_get_user` | read | Get a user by numeric ID |
| `x_get_user_by_username` | read | Get a user by username (handle) |
| `x_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\X\XService;
use OpenCompany\Integrations\X\Tools\XGetTweet;
use OpenCompany\Integrations\X\Tools\XCreateTweet;

// Create tools
$service = app(XService::class);
$tools = [
    new XGetTweet($service),
    new XCreateTweet($service),
];
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('x');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\X\Tools\XGetTweet::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\X\XService;

$service = app(XService::class);

// Get a tweet
$tweet = $service->getTweet('1234567890', [
    'tweet.fields' => 'created_at,public_metrics',
]);

// Post a tweet
$newTweet = $service->createTweet([
    'text' => 'Hello from OpenCompany!',
]);

// Look up a user
$user = $service->getUserByUsername('elonmusk', [
    'user.fields' => 'public_metrics,description',
]);

// Get current user
$me = $service->getCurrentUser();
```

## API Scopes

| Tool | Required Scope |
|------|---------------|
| `x_get_tweet` | `tweet.read` |
| `x_list_tweets` | `tweet.read` |
| `x_create_tweet` | `tweet.write` + `users.read` |
| `x_get_user` | `users.read` |
| `x_get_user_by_username` | `users.read` |
| `x_get_current_user` | `users.read` |

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A [X Developer](https://developer.x.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
