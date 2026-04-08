# Integration: Baserow

> Baserow database integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list databases, manage table rows, and query user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Baserow databases. List databases and tables, create/read/update/delete rows — all through the [Baserow](https://baserow.io) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Baserow tool lets AI agents interact with no-code databases — querying data, creating records, updating entries, and managing database structures — giving agents structured data capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-baserow
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Baserow personal access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'baserow' => [
        'access_token' => env('BASEROW_ACCESS_TOKEN'),
        'url'          => env('BASEROW_URL', 'https://api.baserow.io'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `baserow_list_tables` | read | List rows in a Baserow database table with pagination and filtering |
| `baserow_get_row` | read | Get a single row by ID from a database table |
| `baserow_create_row` | write | Create a new row with specified field values |
| `baserow_update_row` | write | Update fields of an existing row |
| `baserow_delete_row` | write | Delete a row from a database table |
| `baserow_list_databases` | read | List all databases (applications) in the workspace |
| `baserow_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\Integrations\Baserow\Tools\BaserowListTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateRow;

// Create tools
$service = app(BaserowService::class);
$tools = [
    new BaserowListTables($service),
    new BaserowCreateRow($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all rows in table 42 and show me the results');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('baserow');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Baserow\Tools\BaserowListTables::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Baserow\BaserowService;

$service = app(BaserowService::class);

// List rows in a table
$rows = $service->listTableRows(tableId: 42, page: 1, size: 50);

// Get a specific row
$row = $service->getRow(tableId: 42, rowId: 1);

// Create a row
$newRow = $service->createRow(tableId: 42, data: [
    'Name' => 'John Doe',
    'Email' => 'john@example.com',
    'Status' => 'Active',
]);

// Update a row
$updated = $service->updateRow(tableId: 42, rowId: 1, data: [
    'Status' => 'Inactive',
]);

// Delete a row
$service->deleteRow(tableId: 42, rowId: 1);

// List databases
$databases = $service->listDatabases();

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
- A [Baserow](https://baserow.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
