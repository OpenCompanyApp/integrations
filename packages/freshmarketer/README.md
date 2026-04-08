# Integration: Freshmarketer

> Freshmarketer (Freshworks) integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage campaigns, segments, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to marketing automation. List and create campaigns, browse contact segments, and manage users — all through the Freshmarketer API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshmarketer tool lets AI agents manage marketing campaigns, explore contact segments, and look up user information — enabling data-driven marketing workflows within the workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshmarketer
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Freshmarketer access token and your Freshworks domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshmarketer' => [
        'access_token' => env('FRESHMARKETER_ACCESS_TOKEN'),
        'domain'       => env('FRESHMARKETER_DOMAIN', 'mycompany'),
        'base_url'     => env('FRESHMARKETER_BASE_URL', ''),
    ],
];
```

### Configuration Fields

| Field | Required | Description |
|-------|----------|-------------|
| `access_token` | yes | API access token from Freshworks admin settings |
| `domain` | yes | Your Freshworks subdomain (before `.myfreshworks.com`) |
| `base_url` | no | Override the auto-generated base URL (`https://{domain}.myfreshworks.com/crm/sales`) |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshmarketer_list_campaigns` | read | List marketing campaigns with pagination and status filter |
| `freshmarketer_get_campaign` | read | Get details of a specific campaign |
| `freshmarketer_create_campaign` | write | Create a new marketing campaign |
| `freshmarketer_list_segments` | read | List contact segments with pagination |
| `freshmarketer_get_segment` | read | Get details of a specific segment |
| `freshmarketer_list_users` | read | List users in the Freshmarketer account |
| `freshmarketer_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerListCampaigns;
use OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerCreateCampaign;

// Create tools
$service = app(FreshmarketerService::class);
$tools = [
    new FreshmarketerListCampaigns($service),
    new FreshmarketerCreateCampaign($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active campaigns and show their performance.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshmarketer');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Freshmarketer\Tools\FreshmarketerListCampaigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;

$service = app(FreshmarketerService::class);

// List campaigns
$campaigns = $service->listCampaigns(page: 1, limit: 20, status: 'active');

// Get a specific campaign
$campaign = $service->getCampaign(123);

// Create a campaign
$newCampaign = $service->createCampaign(
    name: 'Welcome Email Series',
    channelList: ['email'],
    schedule: ['type' => 'immediate'],
);

// List segments
$segments = $service->listSegments(page: 1, limit: 20);

// Get a specific segment
$segment = $service->getSegment(456);

// List users
$users = $service->listUsers();

// Get current user
$me = $service->getCurrentUser();
```

## Multi-Account Support

The integration supports multiple Freshmarketer accounts. Each account has its own `access_token`, `domain`, and optional `base_url`. Tools are instantiated with account-specific credentials via the `createTool` method:

```php
$tool = $provider->createTool(
    FreshmarketerListCampaigns::class,
    ['account' => 'work']
);
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
- A [Freshmarketer](https://www.freshworks.com/freshmarketer/) account with API access

## License

MIT — see [LICENSE](LICENSE)
