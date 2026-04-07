# Integration: Patreon

> Patreon integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage campaigns, members, posts, and creator profile. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Patreon creator data. Browse campaigns, view members and their pledge details, manage posts — all through the [Patreon API v2](https://docs.patreon.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Patreon tool lets AI agents query creator campaigns, review member activity, and manage posts — giving agents creator-platform awareness for your Patreon business.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-patreon
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Patreon access token (Creator's Access Token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'patreon' => [
        'access_token' => env('PATREON_ACCESS_TOKEN'),
        'url'          => env('PATREON_URL', 'https://www.patreon.com/api/oauth2/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `patreon_list_campaigns` | read | List all campaigns for the authenticated creator |
| `patreon_get_campaign` | read | Get details for a single campaign |
| `patreon_list_members` | read | List members (patrons) for a campaign |
| `patreon_get_member` | read | Get details for a single member |
| `patreon_list_posts` | read | List posts for a campaign |
| `patreon_get_post` | read | Get details for a single post |
| `patreon_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\Integrations\Patreon\Tools\PatreonListCampaigns;
use OpenCompany\Integrations\Patreon\Tools\PatreonListMembers;

// Create tools
$service = app(PatreonService::class);
$tools = [
    new PatreonListCampaigns($service),
    new PatreonListMembers($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many patrons do I have across my campaigns?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('patreon');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Patreon\Tools\PatreonListCampaigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Patreon\PatreonService;

$service = app(PatreonService::class);

// List campaigns
$campaigns = $service->listCampaigns();

// Get a campaign
$campaign = $service->getCampaign('123456');

// List members for a campaign
$members = $service->listMembers('123456');

// Get a specific member
$member = $service->getMember('789012');

// List posts
$posts = $service->listPosts('123456');

// Get a specific post
$post = $service->getPost('345678');

// Current user
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
- A [Patreon](https://www.patreon.com/) creator account with API access

## License

MIT — see [LICENSE](LICENSE)
