# Integration: Sellfy

> Sellfy integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list products, create products, manage orders, and customers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Sellfy store data. Browse products, create new products, retrieve orders, and view customers — all through the [Sellfy](https://sellfy.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Sellfy tool lets AI agents query products, orders, and customers — giving agents real-time e-commerce awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-sellfy
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Sellfy API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'sellfy' => [
        'api_key' => env('SELLFY_API_KEY'),
        'url'     => env('SELLFY_URL', 'https://api.sellfy.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `sellfy_list_products` | read | List all products |
| `sellfy_get_product` | read | Get details for a specific product |
| `sellfy_create_product` | write | Create a new product |
| `sellfy_list_orders` | read | List all orders |
| `sellfy_get_order` | read | Get details for a specific order |
| `sellfy_list_customers` | read | List all customers |
| `sellfy_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Sellfy\SellfyService;
use OpenCompany\Integrations\Sellfy\Tools\SellfyListProducts;
use OpenCompany\Integrations\Sellfy\Tools\SellfyListOrders;

// Create tools
$service = app(SellfyService::class);
$tools = [
    new SellfyListProducts($service),
    new SellfyListOrders($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many orders were placed this week?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('sellfy');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Sellfy\Tools\SellfyListOrders::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Sellfy\SellfyService;

$service = app(SellfyService::class);

// List products
$products = $service->listProducts();

// Get a product
$product = $service->getProduct(12345);

// Create a product
$newProduct = $service->createProduct([
    'name' => 'My eBook',
    'price' => 9.99,
    'type' => 'digital',
]);

// List orders
$orders = $service->listOrders(pageSize: 25);

// Get an order
$order = $service->getOrder(67890);

// List customers
$customers = $service->listCustomers();

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
- A [Sellfy](https://sellfy.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
