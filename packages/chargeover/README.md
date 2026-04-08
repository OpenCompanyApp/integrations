# Integration: ChargeOver

> ChargeOver integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage customers, subscriptions, invoices and transactions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to billing and subscription data. Query customers, subscriptions, invoices, and payment transactions — all through the [ChargeOver](https://www.chargeover.com/) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ChargeOver tool lets AI agents look up customer details, check subscription status, review invoices and payments — giving agents financial awareness for billing support and revenue analysis.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-chargeover
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ChargeOver API access token and either a subdomain or custom URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'chargeover' => [
        'access_token' => env('CHARGEOVER_ACCESS_TOKEN'),
        'subdomain'    => env('CHARGEOVER_SUBDOMAIN'), // e.g. "mycompany" for mycompany.chargeover.com
        'url'          => env('CHARGEOVER_URL'),        // Override base URL (takes priority over subdomain)
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `chargeover_list_customers` | read | List customers with pagination and status filtering |
| `chargeover_get_customer` | read | Get a specific customer by ID |
| `chargeover_list_subscriptions` | read | List subscriptions, optionally filtered by customer |
| `chargeover_list_invoices` | read | List invoices with pagination and status filtering |
| `chargeover_get_invoice` | read | Get a specific invoice by ID |
| `chargeover_list_transactions` | read | List transactions (payments) with pagination |
| `chargeover_get_current_user` | read | Get the authenticated user / account info |

## Quick Start

```php
use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListCustomers;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetInvoice;

// Create tools
$service = app(ChargeOverService::class);
$tools = [
    new ChargeOverListCustomers($service),
    new ChargeOverGetInvoice($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all overdue invoices');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('chargeover');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ChargeOver\ChargeOverService;

$service = app(ChargeOverService::class);

// List customers
$customers = $service->listCustomers(limit: 25, page: 1, status: 'active');

// Get a specific customer
$customer = $service->getCustomer(12345);

// List subscriptions for a customer
$subscriptions = $service->listSubscriptions(customerId: 12345);

// List overdue invoices
$invoices = $service->listInvoices(status: 'overdue');

// Get invoice details
$invoice = $service->getInvoice(67890);

// List transactions
$transactions = $service->listTransactions(limit: 50);

// Get current user info
$me = $service->getCurrentUser();
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
- A [ChargeOver](https://www.chargeover.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
