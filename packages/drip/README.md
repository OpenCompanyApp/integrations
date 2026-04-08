# Integration: Drip

> Drip email marketing integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage subscribers, campaigns, and orders. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Drip email marketing data. Manage subscribers, list campaigns, and track orders — all through the [Drip](https://www.getdrip.com/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Drip tool lets AI agents manage email subscribers, review campaigns, and access order data — giving agents visibility into your email marketing pipeline.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-drip
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Drip API key and Account ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'drip' => [
        'api_key'    => env('DRIP_API_KEY'),
        'account_id' => env('DRIP_ACCOUNT_ID'),
        'url'        => env('DRIP_URL', 'https://api.getdrip.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `drip_list_subscribers` | read | List subscribers with email, status, tags, and custom fields |
| `drip_get_subscriber` | read | Fetch a single subscriber by ID or email |
| `drip_create_subscriber` | write | Create or update a subscriber |
| `drip_list_campaigns` | read | List email campaigns |
| `drip_list_orders` | read | List orders recorded in Drip |
| `drip_get_current_user` | read | Get the currently authenticated Drip user |

## Quick Start

```php
use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\Integrations\Drip\Tools\DripListSubscribers;
use OpenCompany\Integrations\Drip\Tools\DripCreateSubscriber;

// Create tools
$service = app(DripService::class);
$tools = [
    new DripListSubscribers($service),
    new DripCreateSubscriber($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Drip subscribers and add john@example.com as a new subscriber');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('drip');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Drip\Tools\DripListSubscribers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Drip\DripService;

$service = app(DripService::class);

// List subscribers
$subscribers = $service->listSubscribers(page: 1, perPage: 50);

// Get a specific subscriber
$subscriber = $service->getSubscriber('john@example.com');

// Create a subscriber
$service->createSubscriber('jane@example.com', [
    'first_name' => 'Jane',
    'last_name' => 'Doe',
    'tags' => ['newsletter', 'lead'],
]);

// List campaigns
$campaigns = $service->listCampaigns();

// List orders
$orders = $service->listOrders();

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
- A [Drip](https://www.getdrip.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
