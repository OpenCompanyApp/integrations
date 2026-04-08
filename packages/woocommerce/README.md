# Integration: WooCommerce

> WooCommerce integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage products, orders, and customers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full control over your WooCommerce store. List, create, update, and delete products; manage orders; and handle customers — all through the [WooCommerce REST API](https://woocommerce.github.io/woocommerce-rest-api-docs/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This WooCommerce tool lets AI agents manage e-commerce operations — products, orders, and customers — giving agents real-time store management capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-woocommerce
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires WooCommerce REST API credentials (consumer key and consumer secret).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'woocommerce' => [
        'url'             => env('WOOCOMMERCE_STORE_URL', 'https://example.com'),
        'consumer_key'    => env('WOOCOMMERCE_CONSUMER_KEY'),
        'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET'),
    ],
];
```

### Generating API Keys

1. Go to **WooCommerce → Settings → Advanced → REST API**
2. Click **Add key**
3. Set a description, choose the user, and select permissions (Read/Write)
4. Click **Generate API key**
5. Copy the **Consumer Key** and **Consumer Secret**

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `woocommerce_list_products` | read | List products with filtering and pagination |
| `woocommerce_get_product` | read | Get details for a single product |
| `woocommerce_create_product` | write | Create a new product |
| `woocommerce_update_product` | write | Update an existing product |
| `woocommerce_delete_product` | write | Delete (trash or permanently remove) a product |
| `woocommerce_list_orders` | read | List orders with filtering and pagination |
| `woocommerce_get_order` | read | Get details for a single order |
| `woocommerce_update_order` | write | Update an existing order (e.g. change status) |
| `woocommerce_list_customers` | read | List customers with filtering and pagination |
| `woocommerce_get_customer` | read | Get details for a single customer |
| `woocommerce_create_customer` | write | Create a new customer |
| `woocommerce_get_current_user` | read | Get system status / verify credentials |

## Quick Start

```php
use OpenCompany\Integrations\WooCommerce\WooCommerceService;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceListProducts;
use OpenCompany\Integrations\WooCommerce\Tools\WooCommerceGetOrder;

// Create tools
$service = app(WooCommerceService::class);
$tools = [
    new WooCommerceListProducts($service),
    new WooCommerceGetOrder($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List the 5 most recent orders');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 12 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('woocommerce');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\WooCommerce\Tools\WooCommerceListProducts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

$service = app(WooCommerceService::class);

// List products
$products = $service->listProducts(['per_page' => 20, 'status' => 'publish']);

// Get a product
$product = $service->getProduct(123);

// Create a product
$new = $service->createProduct([
    'name' => 'T-Shirt',
    'type' => 'simple',
    'regular_price' => '29.99',
]);

// List orders
$orders = $service->listOrders(['status' => 'processing']);

// Update an order
$service->updateOrder(456, ['status' => 'completed']);

// List customers
$customers = $service->listCustomers(['search' => 'john']);

// System status
$status = $service->getSystemStatus();
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
- A [WooCommerce](https://woocommerce.com) store with REST API enabled

## License

MIT — see [LICENSE](LICENSE)
