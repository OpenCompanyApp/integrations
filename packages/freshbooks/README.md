# Integration: FreshBooks

> FreshBooks accounting integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage invoices, clients, projects, and payments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to FreshBooks accounting data. List and create invoices, manage clients, track projects, and review payments — all through the [FreshBooks API](https://www.freshbooks.com/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This FreshBooks tool lets AI agents query invoices, retrieve client details, track projects, and review payment history — giving agents financial awareness and the ability to manage billing workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshbooks
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a FreshBooks access token and account ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshbooks' => [
        'access_token' => env('FRESHBOOKS_ACCESS_TOKEN'),
        'account_id'   => env('FRESHBOOKS_ACCOUNT_ID'),
        'url'          => env('FRESHBOOKS_URL', 'https://api.freshbooks.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshbooks_list_invoices` | read | List invoices with optional filtering by status, client, date |
| `freshbooks_get_invoice` | read | Get full details of a specific invoice |
| `freshbooks_create_invoice` | write | Create a new invoice with line items |
| `freshbooks_list_clients` | read | List clients with optional search filters |
| `freshbooks_get_client` | read | Get details of a specific client |
| `freshbooks_list_projects` | read | List projects with optional filtering |
| `freshbooks_list_payments` | read | List payments with optional filtering |
| `freshbooks_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\FreshBooks\FreshBooksService;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListInvoices;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksCreateInvoice;

// Create tools
$service = app(FreshBooksService::class);
$tools = [
    new FreshBooksListInvoices($service),
    new FreshBooksCreateInvoice($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all unpaid invoices from last month');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshbooks');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\FreshBooks\FreshBooksService;

$service = app(FreshBooksService::class);

// List invoices
$invoices = $service->listInvoices(['search[status]' => 'sent']);

// Get a specific invoice
$invoice = $service->getInvoice(12345);

// Create an invoice
$result = $service->createInvoice([
    'invoice' => [
        'customerid' => 100,
        'lines' => [
            ['name' => 'Consulting', 'qty' => 10, 'unit_cost' => ['amount' => '150.00', 'code' => 'USD']],
        ],
    ],
]);

// List clients
$clients = $service->listClients();

// List projects
$projects = $service->listProjects();

// List payments
$payments = $service->listPayments(['search[date_from]' => '2025-01-01']);

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
- A [FreshBooks](https://www.freshbooks.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
