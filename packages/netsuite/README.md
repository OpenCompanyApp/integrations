# Integration: NetSuite

> NetSuite ERP integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage customers, invoices, sales orders, and items. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your NetSuite ERP data. Query customers, invoices, sales orders, and items — all through the [NetSuite SuiteTalk REST API](https://docs.oracle.com/en/cloud/saas/netsuite/ns-online-help/chapter_1540391674.html).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This NetSuite tool lets AI agents query and manage ERP data — giving agents awareness of customers, financial documents, and inventory.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-netsuite
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a NetSuite OAuth 2.0 access token and the SuiteTalk REST API base URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'netsuite' => [
        'access_token' => env('NETSUITE_ACCESS_TOKEN'),
        'url'          => env('NETSUITE_URL', 'https://1234567.suitetalk.api.netsuite.com/services/rest/record/v1'),
    ],
];
```

### Setting up NetSuite OAuth 2.0

1. In NetSuite, go to **Setup → Integration → OAuth 2.0**
2. Create an integration with the appropriate scopes
3. Generate an access token
4. Use the REST API base URL format: `https://{account_id}.suitetalk.api.netsuite.com/services/rest/record/v1`

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `netsuite_list_customers` | read | List customers with pagination |
| `netsuite_get_customer` | read | Get a single customer by internal ID |
| `netsuite_create_customer` | write | Create a new customer |
| `netsuite_list_invoices` | read | List invoices with pagination |
| `netsuite_list_sales_orders` | read | List sales orders with pagination |
| `netsuite_list_items` | read | List items (products and services) with pagination |
| `netsuite_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\NetSuite\NetSuiteService;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteListCustomers;
use OpenCompany\Integrations\NetSuite\Tools\NetSuiteGetCustomer;

// Create tools
$service = app(NetSuiteService::class);
$tools = [
    new NetSuiteListCustomers($service),
    new NetSuiteGetCustomer($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our top 10 customers and show their details');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('netsuite');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\NetSuite\Tools\NetSuiteListCustomers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\NetSuite\NetSuiteService;

$service = app(NetSuiteService::class);

// List customers
$customers = $service->listCustomers(limit: 10);

// Get a specific customer
$customer = $service->getCustomer('12345');

// Create a customer
$newCustomer = $service->createCustomer([
    'companyname' => 'Acme Corp',
    'email' => 'billing@acme.com',
    'phone' => '+1-555-0123',
]);

// List invoices
$invoices = $service->listInvoices(limit: 20);

// List sales orders
$salesOrders = $service->listSalesOrders();

// List items
$items = $service->listItems();

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
- A [NetSuite](https://www.netsuite.com) account with SuiteTalk REST API access

## License

MIT — see [LICENSE](LICENSE)
