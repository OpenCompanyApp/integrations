# Integration: Invoice Ninja

> Invoice Ninja integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage invoices, clients, products and payments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to invoicing and accounting. Create and manage invoices, clients, products, and payments — all through the [Invoice Ninja](https://invoiceninja.org) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Invoice Ninja tool lets AI agents manage invoices, clients, products and payments — giving agents financial awareness and the ability to act on billing data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-invoiceninja
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Invoice Ninja API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'invoiceninja' => [
        'api_token' => env('INVOICENINJA_API_TOKEN'),
        'url'       => env('INVOICENINJA_URL', 'https://invoicing.yourdomain.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `invoiceninja_list_invoices` | read | List invoices with optional filtering |
| `invoiceninja_get_invoice` | read | Get a single invoice by ID |
| `invoiceninja_create_invoice` | write | Create a new invoice |
| `invoiceninja_list_clients` | read | List clients with optional filtering |
| `invoiceninja_create_client` | write | Create a new client |
| `invoiceninja_list_products` | read | List products with optional filtering |
| `invoiceninja_list_payments` | read | List payments with optional filtering |
| `invoiceninja_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListInvoices;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaCreateClient;

// Create tools
$service = app(InvoiceNinjaService::class);
$tools = [
    new InvoiceNinjaListInvoices($service),
    new InvoiceNinjaCreateClient($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all overdue invoices');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('invoiceninja');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;

$service = app(InvoiceNinjaService::class);

// List invoices
$invoices = $service->listInvoices(['status' => 'overdue']);

// Get a specific invoice
$invoice = $service->getInvoice('inv_123');

// Create a client
$client = $service->createClient([
    'name' => 'Acme Corp',
    'contacts' => [
        ['first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@acme.com'],
    ],
]);

// Create an invoice
$invoice = $service->createInvoice([
    'client_id' => $client['data']['id'],
    'line_items' => [
        ['product_key' => 'consulting', 'notes' => 'Strategy session', 'quantity' => 2, 'cost' => 150],
    ],
]);

// List products
$products = $service->listProducts();

// List payments
$payments = $service->listPayments(['client_id' => 'client_123']);

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
- An [Invoice Ninja](https://invoiceninja.org) account (self-hosted or cloud) with API access

## License

MIT — see [LICENSE](LICENSE)
