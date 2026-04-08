---
# Integration: Zoho Bills

> Zoho Bills integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage invoices, customers, items, and billing. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to billing and invoicing through [Zoho Bills](https://www.zoho.com/bills/). List and create invoices, manage customers, browse items, and verify the authenticated user — all through the Zoho Bills API v3.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Bills tool lets AI agents query invoices, create bills, and manage customer data — giving agents financial awareness and billing automation capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-bills
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Zoho Bills OAuth access token and organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho_bills' => [
        'access_token'    => env('ZOHO_BILLS_ACCESS_TOKEN'),
        'organization_id' => env('ZOHO_BILLS_ORGANIZATION_ID'),
        'url'             => env('ZOHO_BILLS_URL', 'https://billing.zoho.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zoho_bills_list_invoices` | read | List invoices with optional status and customer filters |
| `zoho_bills_get_invoice` | read | Retrieve a single invoice by ID |
| `zoho_bills_create_invoice` | write | Create a new invoice for a customer |
| `zoho_bills_list_customers` | read | List customers (contacts) with optional type filter |
| `zoho_bills_get_customer` | read | Retrieve a single customer by ID |
| `zoho_bills_list_items` | read | List items (products and services) |
| `zoho_bills_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListInvoices;
use OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsCreateInvoice;

// Create tools
$service = app(ZohoBillsService::class);
$tools = [
    new ZohoBillsListInvoices($service),
    new ZohoBillsCreateInvoice($service),
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
$provider = $registry->get('zoho_bills');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoBills\Tools\ZohoBillsListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoBills\ZohoBillsService;

$service = app(ZohoBillsService::class);

// List overdue invoices
$invoices = $service->listInvoices(1, 25, 'overdue');

// Get a specific invoice
$invoice = $service->getInvoice('inv_12345');

// Create an invoice
$invoice = $service->createInvoice(
    customerId: 'cnt_12345',
    lineItems: [
        ['item_id' => 'itm_001', 'quantity' => 2, 'rate' => 50.00],
    ],
    date: '2026-04-06',
    dueDate: '2026-05-06',
);

// List customers
$customers = $service->listCustomers(1, 25, 'customer');

// List items
$items = $service->listItems();

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
- A [Zoho Bills](https://www.zoho.com/bills/) account with API access

## License

MIT — see [LICENSE](LICENSE)
