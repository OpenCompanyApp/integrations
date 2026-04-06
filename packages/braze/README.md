# Integration: Braze

> Braze integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage campaigns, canvases, and user data. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to the Braze marketing platform. List and inspect campaigns and canvases, export user profiles by segment or ID, and verify connections — all through the [Braze REST API](https://www.braze.com/docs/api/basics/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Braze tool lets AI agents query campaign and canvas data, look up user profiles, and surface marketing insights — giving agents data-driven awareness of your customer engagement strategy.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-braze
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Braze REST API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'braze' => [
        'api_key' => env('BRAZE_API_KEY'),
        'url'     => env('BRAZE_REST_URL', 'https://rest.iad-01.braze.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `braze_list_campaigns` | read | List marketing campaigns with pagination |
| `braze_get_campaign` | read | Get details for a specific campaign |
| `braze_list_canvases` | read | List canvases (multi-step journeys) with pagination |
| `braze_get_canvas` | read | Get details for a specific canvas |
| `braze_list_users` | read | Export users by segment ID or external IDs |
| `braze_get_user` | read | Get a single user profile by external ID |
| `braze_get_current_user` | read | Get the current authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCampaign;

// Create tools
$service = app(BrazeService::class);
$tools = [
    new BrazeListCampaigns($service),
    new BrazeGetCampaign($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the 5 most recent campaigns and show their status.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('braze');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Braze\BrazeService;

$service = app(BrazeService::class);

// List campaigns
$campaigns = $service->listCampaigns(page: 0, limit: 10);

// Get campaign details
$details = $service->getCampaign('campaign-abc-123');

// List canvases
$canvases = $service->listCanvases();

// Export users by segment
$users = $service->exportUsers(segmentId: 'segment-xyz', limit: 50);

// Get a specific user
$user = $service->exportUsers(externalIds: ['user-123']);

// Verify connection
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
- A [Braze](https://www.braze.com) account with REST API access

## License

MIT — see [LICENSE](LICENSE)
