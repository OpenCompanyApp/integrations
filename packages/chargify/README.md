# Integration: Chargify

> Chargify integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage subscriptions, customers, products, and invoices. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to subscription billing data. Query subscriptions, customers, products, and invoices — all through the [Chargify](https://www.chargify.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Chargify tool lets AI agents query subscription data, look up customer details, review invoices, and check billing status — giving agents financial awareness of recurring revenue.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-chargify
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Chargify API key and your subdomain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'chargify' => [
        'api_key'   => env('CHARGIFY_API_KEY'),
        'subdomain' => env('CHARGIFY_SUBDOMAIN'),
        'url'       => env('CHARGIFY_URL'), // optional override
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `chargify_list_subscriptions` | read | List subscriptions with optional state filtering |
| `chargify_get_subscription` | read | Get details for a single subscription |
| `chargify_list_customers` | read | List customers with pagination |
| `chargify_get_customer` | read | Get details for a single customer |
| `chargify_list_products` | read | List available products |
| `chargify_list_invoices` | read | List invoices with optional status filtering |
| `chargify_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListSubscriptions;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetCustomer;

// Create tools
$service = app(ChargifyService::class);
$tools = [
    new ChargifyListSubscriptions($service),
    new ChargifyGetCustomer($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many active subscriptions do we have?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('chargify');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Chargify\Tools\ChargifyListSubscriptions::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Chargify\ChargifyService;

$service = app(ChargifyService::class);

// List active subscriptions
$subscriptions = $service->listSubscriptions(1, 20, 'active');

// Get a specific subscription
$subscription = $service->getSubscription(12345);

// List customers
$customers = $service->listCustomers(1, 50);

// Get a customer
$customer = $service->getCustomer(67890);

// List products
$products = $service->listProducts();

// List paid invoices
$invoices = $service->listInvoices(1, 20, 'paid');

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
- A [Chargify](https://www.chargify.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
