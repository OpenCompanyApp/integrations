# Integration: Lemon Squeezy

> Lemon Squeezy integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list products, orders, customers, and subscriptions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Lemon Squeezy store data. Browse products, retrieve orders, view customers, and manage subscriptions — all through the [Lemon Squeezy](https://lemonsqueezy.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lemon Squeezy tool lets AI agents query products, orders, customers, and subscriptions — giving agents real-time e-commerce awareness.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-lemon-squeezy
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Lemon Squeezy API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'lemon-squeezy' => [
        'api_key' => env('LEMON_SQUEEZY_API_KEY'),
        'url'     => env('LEMON_SQUEEZY_URL', 'https://api.lemonsqueezy.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lemonsqueezy_list_products` | read | List all digital products |
| `lemonsqueezy_get_product` | read | Get details for a specific product |
| `lemonsqueezy_list_orders` | read | List all orders |
| `lemonsqueezy_get_order` | read | Get details for a specific order |
| `lemonsqueezy_list_customers` | read | List all customers |
| `lemonsqueezy_list_subscriptions` | read | List all subscriptions |
| `lemonsqueezy_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListProducts;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListOrders;

// Create tools
$service = app(LemonSqueezyService::class);
$tools = [
    new LemonSqueezyListProducts($service),
    new LemonSqueezyListOrders($service),
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
$provider = $registry->get('lemon-squeezy');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyListOrders::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;

$service = app(LemonSqueezyService::class);

// List products
$products = $service->listProducts();

// Get a product
$product = $service->getProduct(12345);

// List orders
$orders = $service->listOrders(pageSize: 25);

// List customers
$customers = $service->listCustomers();

// List subscriptions
$subscriptions = $service->listSubscriptions();

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
- A [Lemon Squeezy](https://lemonsqueezy.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
