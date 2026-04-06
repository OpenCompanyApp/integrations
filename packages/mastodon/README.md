# Integration: Mastodon

> Mastodon integration for the [Laravel AI SDK](https://github.com/laravel/ai) — post statuses, browse timelines, and manage accounts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Mastodon](https://joinmastodon.org), the decentralized social network. Browse timelines, publish statuses, look up accounts, and manage followers — all through the Mastodon API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mastodon tool lets AI agents interact with the fediverse — posting updates, reading timelines, and looking up account information.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mastodon
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Mastodon access token and instance URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mastodon' => [
        'access_token' => env('MASTODON_ACCESS_TOKEN'),
        'instance_url' => env('MASTODON_INSTANCE_URL', 'https://mastodon.social'),
    ],
];
```

To create an access token, go to your Mastodon instance → Settings → Development → New Application.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mastodon_list_statuses` | read | Browse statuses from a timeline (home, local, public) |
| `mastodon_get_status` | read | Retrieve a single status (toot) by ID |
| `mastodon_create_status` | write | Publish a new status (toot) on Mastodon |
| `mastodon_list_accounts` | read | List followers of a Mastodon account |
| `mastodon_get_account` | read | Retrieve a Mastodon account profile by ID |
| `mastodon_get_current_user` | read | Get the authenticated user's Mastodon profile |

## Quick Start

```php
use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\Integrations\Mastodon\Tools\MastodonListStatuses;
use OpenCompany\Integrations\Mastodon\Tools\MastodonCreateStatus;

// Create tools
$service = app(MastodonService::class);
$tools = [
    new MastodonListStatuses($service),
    new MastodonCreateStatus($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Post a hello world toot and show my home timeline');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mastodon');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mastodon\Tools\MastodonListStatuses::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mastodon\MastodonService;

$service = app(MastodonService::class);

// Browse home timeline
$statuses = $service->listStatuses('home', limit: 10);

// Get a specific status
$status = $service->getStatus('1234567890');

// Post a new status
$newStatus = $service->createStatus(
    status: 'Hello from the API! 🐘',
    visibility: 'public',
);

// Get an account
$account = $service->getAccount('123456');

// List followers
$followers = $service->listAccounts('123456', limit: 20);

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
- A [Mastodon](https://joinmastodon.org) account with an access token

## License

MIT — see [LICENSE](LICENSE)
