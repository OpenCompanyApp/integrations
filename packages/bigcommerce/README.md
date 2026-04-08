# Integration: BigCommerce

> BigCommerce integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage products, orders, customers, and categories. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your BigCommerce store. Manage products, track orders, handle customers, and browse categories — all through the [BigCommerce API](https://developer.bigcommerce.com/docs/rest).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This BigCommerce tool lets AI agents manage e-commerce operations — listing and updating products, tracking orders, managing customer data, and browsing categories — giving agents full awareness of store activity.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-bigcommerce
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires three BigCommerce API credentials:

1. **Access Token** — Generated when you create an API account
2. **Store ID** — Your store hash (found in the store URL or API settings)
3. **Client ID** — The client ID associated with your API account

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'bigcommerce' => [
        'access_token' => env('BIGCOMMERCE_ACCESS_TOKEN'),
        'store_id'     => env('BIGCOMMERCE_STORE_ID'),
        'client_id'    => env('BIGCOMMERCE_CLIENT_ID'),
    ],
];
```

### Creating API Credentials

1. Go to your BigCommerce store admin
2. Navigate to **Advanced Settings > API Accounts**
3. Click **Create API Account**
4. Set the desired permissions (read/write as needed)
5. Copy the **Access Token**, **Store Hash**, and **Client ID**

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `bigcommerce_list_products` | read | List products from the catalog with filtering and pagination |
| `bigcommerce_get_product` | read | Get a single product by ID with full details |
| `bigcommerce_create_product` | write | Create a new product (name, price, type required) |
| `bigcommerce_update_product` | write | Update an existing product's fields |
| `bigcommerce_delete_product` | write | Delete a product permanently |
| `bigcommerce_list_orders` | read | List orders with filtering by status, date, and customer |
| `bigcommerce_get_order` | read | Get a single order by ID |
| `bigcommerce_update_order` | write | Update order status, notes, or other fields |
| `bigcommerce_list_customers` | read | List customers with filtering and pagination |
| `bigcommerce_get_customer` | read | Get a single customer by ID |
| `bigcommerce_create_customer` | write | Create a new customer |
| `bigcommerce_list_categories` | read | List catalog categories |
| `bigcommerce_get_current_user` | read | Get storefront status and verify API connection |

## Quick Start

```php
use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListOrders;

// Create tools
$service = app(BigCommerceService::class);
$tools = [
    new BigCommerceListProducts($service),
    new BigCommerceListOrders($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the top 10 products by price and recent orders');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 13 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('bigcommerce');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\BigCommerce\BigCommerceService;

$service = app(BigCommerceService::class);

// List products
$products = $service->listProducts(['limit' => 10, 'include' => 'variants,images']);

// Get a single product
$product = $service->getProduct(123);

// Create a product
$product = $service->createProduct([
    'name' => 'New Product',
    'price' => '29.99',
    'type' => 'physical',
    'weight' => 1.5,
    'categories' => [1, 2],
]);

// List orders
$orders = $service->listOrders(['status_id' => 2, 'limit' => 25]);

// Update an order
$service->updateOrder(456, ['status_id' => 3, 'staff_notes' => 'Shipped via FedEx']);

// List customers
$customers = $service->listCustomers(['email' => 'john@example.com']);

// Create a customer
$customer = $service->createCustomer([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
]);

// List categories
$categories = $service->listCategories(['parent_id' => 0]);

// Verify connection
$status = $service->getStorefrontStatus();
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
- A [BigCommerce](https://www.bigcommerce.com) store with API access enabled

## License

MIT — see [LICENSE](LICENSE)
