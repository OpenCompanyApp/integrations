# Integration: Zoho Books

> Zoho Books integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage invoices, contacts, items, and estimates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to online accounting. Create and manage invoices, contacts (customers and vendors), items (products and services), and estimates (quotes) — all through the [Zoho Books API](https://www.zoho.com/books/api/v3/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Books tool lets AI agents manage invoicing, create estimates, look up customer details, and maintain your product catalog — enabling agents to handle billing workflows autonomously.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-books
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zoho Books OAuth access token and organization ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho_books' => [
        'access_token'     => env('ZOHO_BOOKS_ACCESS_TOKEN'),
        'organization_id'  => env('ZOHO_BOOKS_ORGANIZATION_ID'),
        'url'              => env('ZOHO_BOOKS_URL', 'https://www.zohoapis.com/books/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zohobooks_list_invoices` | read | List invoices with optional filters |
| `zohobooks_get_invoice` | read | Get full details of a specific invoice |
| `zohobooks_create_invoice` | write | Create a new invoice |
| `zohobooks_update_invoice` | write | Update an existing invoice |
| `zohobooks_list_contacts` | read | List contacts (customers and vendors) |
| `zohobooks_get_contact` | read | Get details of a specific contact |
| `zohobooks_create_contact` | write | Create a new contact |
| `zohobooks_list_items` | read | List items (products and services) |
| `zohobooks_create_item` | write | Create a new item |
| `zohobooks_list_estimates` | read | List estimates (quotes) |
| `zohobooks_create_estimate` | write | Create a new estimate |
| `zohobooks_get_current_user` | read | Get the authenticated user info |

## Quick Start

```php
use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListInvoices;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksCreateInvoice;

// Create tools
$service = app(ZohoBooksService::class);
$tools = [
    new ZohoBooksListInvoices($service),
    new ZohoBooksCreateInvoice($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all unpaid invoices and tell me the total outstanding amount.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 12 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zoho_books');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;

$service = app(ZohoBooksService::class);

// List invoices
$invoices = $service->listInvoices(['status' => 'unpaid']);

// Get a specific invoice
$invoice = $service->getInvoice('4815000000046819');

// Create an invoice
$invoice = $service->createInvoice([
    'customer_id' => '4815000000044001',
    'line_items' => [
        ['name' => 'Consulting', 'rate' => 150.00, 'quantity' => 10],
    ],
]);

// List contacts
$contacts = $service->listContacts(['contact_type' => 'customer']);

// Create a contact
$contact = $service->createContact([
    'contact_name' => 'Acme Corp',
    'email' => 'billing@acme.com',
]);

// List items
$items = $service->listItems();

// Create an item
$item = $service->createItem([
    'name' => 'Consulting Hour',
    'rate' => 175.00,
]);

// List estimates
$estimates = $service->listEstimates(['status' => 'accepted']);

// Create an estimate
$estimate = $service->createEstimate([
    'customer_id' => '4815000000044001',
    'line_items' => [
        ['name' => 'Website Build', 'rate' => 5000.00, 'quantity' => 1],
    ],
]);

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

This integration uses Zoho OAuth2 tokens. To obtain an access token:

1. Go to the [Zoho API Console](https://api-console.zoho.com/)
2. Register a server-based application
3. Generate an authorization code
4. Exchange it for an access token
5. Required scope: `ZohoBooks.invoices.READ`, `ZohoBooks.contacts.READ`, etc.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Zoho Books](https://www.zoho.com/books/) account with API access

## License

MIT — see [LICENSE](LICENSE)
