# Integration: Gumroad

> Gumroad integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage products, sales, subscribers, and offers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Gumroad digital commerce data. Browse products, track sales, manage subscribers, and view offers — all through the [Gumroad API](https://help.gumroad.com/article/280-gumroad-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Gumroad tool lets AI agents query digital product catalogs, review sales data, and manage subscriber information — giving agents commerce-awareness for your digital business.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-gumroad
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Gumroad access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'gumroad' => [
        'access_token' => env('GUMROAD_ACCESS_TOKEN'),
        'url'          => env('GUMROAD_URL', 'https://api.gumroad.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gumroad_list_products` | read | List all digital products |
| `gumroad_get_product` | read | Get details for a single product |
| `gumroad_list_sales` | read | List sales with optional filters |
| `gumroad_list_subscribers` | read | List all subscribers |
| `gumroad_get_subscriber` | read | Get details for a single subscriber |
| `gumroad_list_offers` | read | List all offers (discount codes) |
| `gumroad_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListProducts;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListSales;

// Create tools
$service = app(GumroadService::class);
$tools = [
    new GumroadListProducts($service),
    new GumroadListSales($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many sales did we make this week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('gumroad');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Gumroad\Tools\GumroadListProducts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Gumroad\GumroadService;

$service = app(GumroadService::class);

// List products
$products = $service->listProducts();

// Get a product
$product = $service->getProduct('ABC123');

// List sales
$sales = $service->listSales(['product_id' => 'ABC123']);

// Manage subscribers
$subscribers = $service->listSubscribers();
$subscriber = $service->getSubscriber('SUB123');

// List offers
$offers = $service->listOffers();

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
- A [Gumroad](https://gumroad.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
