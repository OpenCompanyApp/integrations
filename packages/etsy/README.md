# Integration: Etsy

> Etsy e-commerce integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage listings, orders, and inventory. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Etsy shop. List and create listings, view orders, check inventory, and retrieve seller profile data — all through the [Etsy Open API](https://developers.etsy.com/documentation/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Etsy integration lets AI agents manage shop listings, track orders, and monitor inventory — giving agents full visibility into your e-commerce operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-etsy
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires an Etsy OAuth access token and your shop ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'etsy' => [
        'access_token' => env('ETSY_ACCESS_TOKEN'),
        'shop_id'      => env('ETSY_SHOP_ID'),
        'base_url'     => env('ETSY_BASE_URL', 'https://openapi.etsy.com/v3/application'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `etsy_list_listings` | read | List all shop listings with pagination and state filtering |
| `etsy_get_listing` | read | Get full details for a specific listing |
| `etsy_create_listing` | write | Create a new listing with title, description, price, quantity, and shipping |
| `etsy_list_orders` | read | List shop orders (receipts) with pagination and filters |
| `etsy_get_listing_inventory` | read | Get inventory (products, offerings) for a listing |
| `etsy_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Etsy\EtsyService;
use OpenCompany\Integrations\Etsy\Tools\EtsyListListings;
use OpenCompany\Integrations\Etsy\Tools\EtsyCreateListing;

// Create tools
$service = app(EtsyService::class);
$tools = [
    new EtsyListListings($service),
    new EtsyCreateListing($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me my recent Etsy orders');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('etsy');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Etsy\Tools\EtsyListListings::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Etsy\EtsyService;

$service = app(EtsyService::class);

// List active listings
$listings = $service->listListings(['state' => 'active']);

// Get a single listing
$listing = $service->getListing(1234567890);

// Create a listing
$newListing = $service->createListing([
    'title' => 'Handmade Mug',
    'description' => 'A beautiful ceramic mug.',
    'price' => 28.00,
    'quantity' => 10,
    'shipping_profile_id' => 567890,
]);

// List orders
$orders = $service->listOrders(['was_paid' => true, 'limit' => 10]);

// Get listing inventory
$inventory = $service->getListingInventory(1234567890);

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
- An [Etsy](https://www.etsy.com) seller account with API access

## License

MIT — see [LICENSE](LICENSE)
