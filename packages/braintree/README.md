# Integration: Braintree

> Braintree payments integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list transactions, customers, plans, and subscriptions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to payment data from [Braintree](https://www.braintreepayments.com/) (a PayPal company). Query transactions, look up customers, review billing plans, and monitor subscriptions — all through the Braintree API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Braintree tool lets AI agents query payment transactions, look up customer records, review billing plans, and monitor subscription status — giving agents financial awareness for billing support and revenue analysis.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-braintree
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Braintree access token and merchant ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'braintree' => [
        'access_token' => env('BRAINTREE_ACCESS_TOKEN'),
        'merchant_id'  => env('BRAINTREE_MERCHANT_ID'),
        'url'          => env('BRAINTREE_URL', 'https://api.braintreegateway.com'),
    ],
];
```

Use `https://api.sandbox.braintreegateway.com` for the sandbox environment.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `braintree_list_transactions` | read | List payment transactions with optional status filter |
| `braintree_get_transaction` | read | Retrieve a single transaction by ID |
| `braintree_list_customers` | read | List customers stored in Braintree |
| `braintree_get_customer` | read | Retrieve a single customer by ID |
| `braintree_list_plans` | read | List recurring billing plans |
| `braintree_list_subscriptions` | read | List subscriptions with optional status filter |
| `braintree_get_current_user` | read | Get current merchant account info |

## Quick Start

```php
use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\Integrations\Braintree\Tools\BraintreeListTransactions;
use OpenCompany\Integrations\Braintree\Tools\BraintreeGetTransaction;

// Create tools
$service = app(BraintreeService::class);
$tools = [
    new BraintreeListTransactions($service),
    new BraintreeGetTransaction($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many settled transactions do we have?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('braintree');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Braintree\Tools\BraintreeListTransactions::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Braintree\BraintreeService;

$service = app(BraintreeService::class);

// List recent transactions
$transactions = $service->listTransactions(limit: 20, status: 'settled');

// Get a specific transaction
$transaction = $service->getTransaction('abc123xyz');

// List customers
$customers = $service->listCustomers(limit: 25);

// Get a specific customer
$customer = $service->getCustomer('cust_123');

// List plans
$plans = $service->listPlans();

// List active subscriptions
$subscriptions = $service->listSubscriptions(status: 'active');

// Get merchant info
$merchant = $service->getCurrentUser();
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
- A [Braintree](https://www.braintreepayments.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
