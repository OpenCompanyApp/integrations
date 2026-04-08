# Integration: ShipBob

> ShipBob fulfillment integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage orders, products, and shipments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to e-commerce fulfillment data. List and create orders, browse inventory products, track shipments, and verify account connectivity — all through the [ShipBob](https://www.shipbob.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ShipBob tool lets AI agents manage fulfillment orders, check inventory, and track shipments — giving agents operational awareness of e-commerce logistics.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-shipbob
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ShipBob access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'shipbob' => [
        'access_token' => env('SHIPBOB_ACCESS_TOKEN'),
        'url'          => env('SHIPBOB_URL', 'https://api.shipbob.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `shipbob_list_orders` | read | List fulfillment orders with pagination and status filtering |
| `shipbob_get_order` | read | Get details for a specific order |
| `shipbob_create_order` | write | Create a new fulfillment order |
| `shipbob_list_products` | read | List products in inventory |
| `shipbob_get_product` | read | Get details for a specific product |
| `shipbob_list_shipments` | read | List shipments with pagination |
| `shipbob_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobListOrders;
use OpenCompany\Integrations\ShipBob\Tools\ShipBobListProducts;

// Create tools
$service = app(ShipBobService::class);
$tools = [
    new ShipBobListOrders($service),
    new ShipBobListProducts($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all pending orders and current inventory levels');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('shipbob');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ShipBob\Tools\ShipBobListOrders::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ShipBob\ShipBobService;

$service = app(ShipBobService::class);

// List orders
$orders = $service->listOrders(page: 1, limit: 25, status: 'pending');

// Get a specific order
$order = $service->getOrder(12345);

// Create an order
$order = $service->createOrder(
    receivingNote: 'Priority shipment',
    products: [['id' => 678, 'quantity' => 2]],
    shippingMethod: 'expedited',
);

// List products
$products = $service->listProducts(page: 1, limit: 50);

// Get a specific product
$product = $service->getProduct(678);

// List shipments
$shipments = $service->listShipments(page: 1, limit: 25);

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
- A [ShipBob](https://www.shipbob.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
