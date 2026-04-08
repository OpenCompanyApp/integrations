# Integration: Odoo

> Odoo ERP integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, sales orders, invoices, products, and leads. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Odoo ERP data. Manage contacts, track sales orders, review invoices, browse products, and monitor CRM leads — all through the Odoo API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Odoo tool lets AI agents manage contacts, review sales data, check invoices, and monitor CRM pipelines — giving agents business-aware context for ERP operations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-odoo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Odoo API key and your instance URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'odoo' => [
        'api_key'  => env('ODOO_API_KEY'),
        'url'      => env('ODOO_URL', 'https://your-odoo-instance.com'),
        'database' => env('ODOO_DATABASE', ''),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `odoo_list_contacts` | read | List contacts (customers, vendors) with pagination |
| `odoo_get_contact` | read | Get a single contact by ID |
| `odoo_create_contact` | write | Create a new contact in Odoo |
| `odoo_list_sales_orders` | read | List sales orders with pagination and filtering |
| `odoo_list_invoices` | read | List invoices with pagination and filtering |
| `odoo_list_products` | read | List products with pagination and filtering |
| `odoo_list_leads` | read | List CRM leads and opportunities |
| `odoo_get_current_user` | read | Get the currently authenticated Odoo user |

## Quick Start

```php
use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\Integrations\Odoo\Tools\OdooListContacts;
use OpenCompany\Integrations\Odoo\Tools\OdooCreateContact;

// Create tools
$service = app(OdooService::class);
$tools = [
    new OdooListContacts($service),
    new OdooCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all contacts named John');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('odoo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Odoo\Tools\OdooListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Odoo\OdooService;

$service = app(OdooService::class);

// List contacts (paginated)
$contacts = $service->listContacts(page: 1, limit: 20);

// Get a specific contact
$contact = $service->getContact(42);

// Create a contact
$newContact = $service->createContact([
    'name' => 'Acme Corp',
    'email' => 'info@acme.com',
    'is_company' => true,
]);

// List sales orders
$orders = $service->listSalesOrders(page: 1, limit: 10);

// List invoices
$invoices = $service->listInvoices();

// List products
$products = $service->listProducts();

// List CRM leads
$leads = $service->listLeads();

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
- An [Odoo](https://www.odoo.com) instance with API access enabled

## License

MIT — see [LICENSE](LICENSE)
