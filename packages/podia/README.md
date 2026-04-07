# Integration: Podia

> Podia integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage online courses, digital downloads, customers, and sales. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Podia online course and digital download data. Browse products, track sales, manage customers — all through the Podia API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Podia tool lets AI agents query online course catalogs, review sales data, and manage customer information — giving agents commerce-awareness for your digital business.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-podia
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Podia API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'podia' => [
        'access_token' => env('PODIA_ACCESS_TOKEN'),
        'url'          => env('PODIA_URL', 'https://api.podia.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `podia_list_products` | read | List all online courses and digital downloads |
| `podia_get_product` | read | Get details for a single product |
| `podia_list_customers` | read | List all customers |
| `podia_get_customer` | read | Get details for a single customer |
| `podia_list_sales` | read | List sales with optional filters |
| `podia_get_sale` | read | Get details for a single sale |
| `podia_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\Integrations\Podia\Tools\PodiaListProducts;
use OpenCompany\Integrations\Podia\Tools\PodiaListSales;

// Create tools
$service = app(PodiaService::class);
$tools = [
    new PodiaListProducts($service),
    new PodiaListSales($service),
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
$provider = $registry->get('podia');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Podia\Tools\PodiaListProducts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Podia\PodiaService;

$service = app(PodiaService::class);

// List products
$products = $service->listProducts();

// Get a product
$product = $service->getProduct('12345');

// List customers
$customers = $service->listCustomers();

// Get a customer
$customer = $service->getCustomer('67890');

// List sales
$sales = $service->listSales(['product_id' => '12345']);

// Get a sale
$sale = $service->getSale('SALE123');

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
- A [Podia](https://www.podia.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
