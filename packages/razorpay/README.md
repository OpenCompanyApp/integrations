# Integration: Razorpay

> Razorpay integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list payments, orders, refunds, and customers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Razorpay payment data. List and retrieve payments, manage orders, track refunds, and browse customers — all through the [Razorpay API](https://razorpay.com/docs/api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Razorpay tool lets AI agents query payment data, create orders, and manage customer information — giving agents real-time visibility into payment operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-razorpay
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Razorpay Key ID and Key Secret.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'razorpay' => [
        'key_id'     => env('RAZORPAY_KEY_ID'),
        'key_secret' => env('RAZORPAY_KEY_SECRET'),
        'url'        => env('RAZORPAY_URL', 'https://api.razorpay.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `razorpay_list_payments` | read | List payments with pagination and date-range filters |
| `razorpay_get_payment` | read | Get details of a specific payment by ID |
| `razorpay_list_orders` | read | List orders with pagination and date-range filters |
| `razorpay_get_order` | read | Get details of a specific order by ID |
| `razorpay_create_order` | write | Create a new payment order |
| `razorpay_list_refunds` | read | List refunds with pagination and date-range filters |
| `razorpay_list_customers` | read | List customers with pagination |
| `razorpay_get_current_user` | read | Get current user/account information |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListPayments;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayCreateOrder;

// Create tools
$service = app(RazorpayService::class);
$tools = [
    new RazorpayListPayments($service),
    new RazorpayCreateOrder($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the last 5 payments and their statuses');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('razorpay');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Razorpay\Tools\RazorpayListPayments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Razorpay\RazorpayService;

$service = app(RazorpayService::class);

// List payments
$payments = $service->listPayments(['count' => 10]);

// Get a specific payment
$payment = $service->getPayment('pay_1234567890');

// List orders
$orders = $service->listOrders(['count' => 20]);

// Create an order (amount in paise: 10000 = ₹100.00)
$order = $service->createOrder(10000, 'INR', 'receipt_001');

// List refunds
$refunds = $service->listRefunds(['count' => 10]);

// List customers
$customers = $service->listCustomers(['count' => 20]);

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
- A [Razorpay](https://razorpay.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
