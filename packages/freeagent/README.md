# Integration: FreeAgent

> FreeAgent accounting integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage invoices, contacts, projects and expenses. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to FreeAgent accounting. List and create invoices, manage contacts, track projects, and review expenses — all through the [FreeAgent API](https://dev.freeagent.com).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This FreeAgent tool lets AI agents manage invoicing, contacts, projects, and expenses — giving agents financial awareness and automation capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freeagent
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a FreeAgent OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freeagent' => [
        'access_token' => env('FREEAGENT_ACCESS_TOKEN'),
        'url'          => env('FREEAGENT_URL', 'https://api.freeagent.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freeagent_list_invoices` | read | List invoices with filtering by status, date, contact, project |
| `freeagent_get_invoice` | read | Get full details of a specific invoice |
| `freeagent_create_invoice` | write | Create a new invoice with line items |
| `freeagent_list_contacts` | read | List contacts (customers, suppliers) |
| `freeagent_get_contact` | read | Get full details of a specific contact |
| `freeagent_create_contact` | write | Create a new contact (customer or supplier) |
| `freeagent_list_projects` | read | List projects with status filtering |
| `freeagent_list_expenses` | read | List expenses with date and project filtering |
| `freeagent_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListInvoices;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentCreateInvoice;

// Create tools
$service = app(FreeAgentService::class);
$tools = [
    new FreeAgentListInvoices($service),
    new FreeAgentCreateInvoice($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all unpaid invoices and create a reminder');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freeagent');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListInvoices::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\FreeAgent\FreeAgentService;

$service = app(FreeAgentService::class);

// List invoices
$invoices = $service->listInvoices(['status' => 'Sent']);

// Get a specific invoice
$invoice = $service->getInvoice(12345);

// Create an invoice
$invoice = $service->createInvoice([
    'contact' => 'https://api.freeagent.com/v2/contacts/123',
    'dated_on' => '2025-04-01',
    'invoice_items' => [
        ['description' => 'Consulting', 'quantity' => 10, 'price' => 75.00],
    ],
]);

// List contacts
$contacts = $service->listContacts(['view' => 'customers']);

// Create a contact
$contact = $service->createContact([
    'organisation_name' => 'Acme Corp',
    'email' => 'billing@acme.com',
]);

// List projects
$projects = $service->listProjects(['view' => 'active']);

// List expenses
$expenses = $service->listExpenses(['from_date' => '2025-01-01']);

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
- A [FreeAgent](https://www.freeagent.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
