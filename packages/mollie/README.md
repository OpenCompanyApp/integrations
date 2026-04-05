# Integration: Mollie

> Mollie payments integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage payments, customers, subscriptions and invoices. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Mollie payment operations. List and create payments, manage customers, handle subscriptions, and retrieve invoices — all through the [Mollie API](https://docs.mollie.com).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mollie tool lets AI agents manage payments, customers and subscriptions — giving agents financial awareness and the ability to act on billing data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mollie
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Mollie API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mollie' => [
        'access_token' => env('MOLLIE_ACCESS_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mollie_list_payments` | read | List payments with optional filters |
| `mollie_get_payment` | read | Retrieve a single payment by ID |
| `mollie_create_payment` | write | Create a new payment |
| `mollie_list_customers` | read | List customers |
| `mollie_create_customer` | write | Create a new customer |
| `mollie_list_subscriptions` | read | List subscriptions for a customer |
| `mollie_create_subscription` | write | Create a subscription for a customer |
| `mollie_list_invoices` | read | List invoices |
| `mollie_get_current_user` | read | Retrieve enabled payment methods |

## Quick Start

```php
use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\Integrations\Mollie\Tools\MollieListPayments;
use OpenCompany\Integrations\Mollie\Tools\MollieCreatePayment;

// Create tools
$service = app(MollieService::class);
$tools = [
    new MollieListPayments($service),
    new MollieCreatePayment($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the last 10 payments');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mollie');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mollie\Tools\MollieListPayments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mollie\MollieService;

$service = app(MollieService::class);

// List payments
$payments = $service->listPayments(['limit' => 10]);

// Get a specific payment
$payment = $service->getPayment('tr_abc123');

// Create a payment
$payment = $service->createPayment([
    'amount' => ['currency' => 'EUR', 'value' => '10.00'],
    'description' => 'Order #123',
    'redirectUrl' => 'https://example.com/return',
]);

// List customers
$customers = $service->listCustomers();

// Create a customer
$customer = $service->createCustomer([
    'name' => 'John Doe',
    'email' => 'john@example.com',
]);

// List subscriptions for a customer
$subscriptions = $service->listSubscriptions('cst_abc123');

// Create a subscription
$subscription = $service->createSubscription('cst_abc123', [
    'amount' => ['currency' => 'EUR', 'value' => '25.00'],
    'interval' => '1 month',
    'description' => 'Monthly subscription',
]);

// List invoices
$invoices = $service->listInvoices();

// Get enabled payment methods
$methods = $service->getCurrentUser();
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
- A [Mollie](https://www.mollie.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
