# Integration: Coda

> Coda integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage docs, tables, rows, columns, and pages. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Coda documents and tables. Browse docs, query table data, insert and update rows, and explore pages — all through the [Coda API](https://coda.io/developers/apis/v1).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Coda tool lets AI agents read and modify Coda docs and tables — giving agents data-driven access to project trackers, knowledge bases, and operational documents.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-coda
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Coda API token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'coda' => [
        'api_token' => env('CODA_API_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `coda_list_docs` | read | List docs accessible to the user |
| `coda_get_doc` | read | Get details of a specific doc |
| `coda_list_tables` | read | List tables in a doc |
| `coda_get_table` | read | Get details of a specific table |
| `coda_list_rows` | read | List rows in a table |
| `coda_get_row` | read | Get a single row by ID |
| `coda_insert_rows` | write | Insert new rows into a table |
| `coda_update_row` | write | Update cells in an existing row |
| `coda_delete_row` | write | Delete a row from a table |
| `coda_list_columns` | read | List columns in a table |
| `coda_list_pages` | read | List pages in a doc |
| `coda_get_current_user` | read | Verify auth and get user info |

## Quick Start

```php
use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\Integrations\Coda\Tools\CodaListDocs;
use OpenCompany\Integrations\Coda\Tools\CodaListRows;

// Create tools
$service = app(CodaService::class);
$tools = [
    new CodaListDocs($service),
    new CodaListRows($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Coda docs and show the rows in the first table');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 12 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('coda');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Coda\Tools\CodaListRows::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Coda\CodaService;

$service = app(CodaService::class);

// List docs
$docs = $service->listDocs(['limit' => 10]);

// Get a doc
$doc = $service->getDoc('doc-id-here');

// List tables
$tables = $service->listTables('doc-id-here');

// List rows
$rows = $service->listRows('doc-id-here', 'table-id', [
    'limit' => 50,
    'useColumnNames' => 'true',
]);

// Insert rows
$service->insertRows('doc-id-here', 'table-id', [
    ['cells' => [['column' => 'Name', 'value' => 'Alice']]],
]);

// Update a row
$service->updateRow('doc-id-here', 'table-id', 'row-id', [
    ['column' => 'Status', 'value' => 'Done'],
]);

// Delete a row
$service->deleteRow('doc-id-here', 'table-id', 'row-id');
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
- A [Coda](https://coda.io) account with an API token

## License

MIT — see [LICENSE](LICENSE)
