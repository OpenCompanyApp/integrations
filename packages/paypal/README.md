# Integration: PayPal

> PayPal integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage orders, payments, and invoices via the PayPal REST API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to PayPal's payment platform. Create and retrieve orders, list payments, manage invoices, and look up user profiles — all through the PayPal REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This PayPal tool lets AI agents manage checkout orders, retrieve payment details, list invoices, and check user identity — giving agents full awareness of payment and billing activity.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-paypal
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a PayPal API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'paypal' => [
        'access_token' => env('PAYPAL_ACCESS_TOKEN'),
        'url'          => env('PAYPAL_API_URL', 'https://api-m.paypal.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `paypal_get_order` | read | Get details of a specific PayPal order |
| `paypal_create_order` | write | Create a new PayPal checkout order |
| `paypal_capture_order` | write | Capture a previously approved PayPal checkout order |
| `paypal_list_payments` | read | List PayPal payments with optional filters |
| `paypal_get_payment` | read | Get details of a specific PayPal payment |
| `paypal_list_invoices` | read | List PayPal invoices |
| `paypal_get_current_user` | read | Get the authenticated PayPal user profile |

## Quick Start

```php
use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalCreateOrder;

// Create tools
$service = app(PayPalService::class);
$tools = [
    new PayPalGetOrder($service),
    new PayPalCreateOrder($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a PayPal order and then retrieve its status');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('paypal');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\PayPal\Tools\PayPalGetOrder::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\PayPal\PayPalService;

$service = app(PayPalService::class);

// Get a specific order
$order = $service->getOrder('5O190127TN364715T');

// Create an order
$order = $service->createOrder([
    'intent' => 'CAPTURE',
    'purchase_units' => [
        [
            'amount' => [
                'currency_code' => 'USD',
                'value' => '29.99',
            ],
        ],
    ],
]);

// Capture an approved order
$capture = $service->captureOrder('5O190127TN364715T');

// List payments
$payments = $service->listPayments(['count' => 10]);

// Get a payment
$payment = $service->getPayment('PAY-1AB23456CD789012EFGHIJKL');

// List invoices
$invoices = $service->listInvoices(['page' => 1, 'page_size' => 20]);

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
- A [PayPal](https://developer.paypal.com/) developer account with API credentials

## License

MIT — see [LICENSE](LICENSE)
