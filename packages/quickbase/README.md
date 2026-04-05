# Integration: QuickBase

> QuickBase low-code database integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list tables, query records, create records, and more. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your QuickBase low-code database. Query tables, search records with filters, retrieve individual records, and create new entries — all through the [QuickBase API](https://developer.quickbase.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This QuickBase tool lets AI agents query and manage data in your QuickBase applications — giving agents direct access to business data stored in low-code databases.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-quickbase
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a QuickBase user token and your realm hostname.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'quickbase' => [
        'access_token'   => env('QUICKBASE_ACCESS_TOKEN'),
        'realm_hostname' => env('QUICKBASE_REALM_HOSTNAME', 'mycompany.quickbase.com'),
        'base_url'       => env('QUICKBASE_BASE_URL', 'https://api.quickbase.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `quickbase_list_tables` | read | List all tables in a QuickBase application |
| `quickbase_get_table` | read | Get details for a specific table |
| `quickbase_list_records` | read | Query records from a table with filters and pagination |
| `quickbase_get_record` | read | Get a single record by ID |
| `quickbase_create_record` | write | Create a new record in a table |
| `quickbase_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseListTables;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseListRecords;

// Create tools
$service = app(QuickBaseService::class);
$tools = [
    new QuickBaseListTables($service),
    new QuickBaseListRecords($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all tables in app bqxxx and show me the first 10 records from the first table.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('quickbase');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\QuickBase\Tools\QuickBaseListRecords::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\QuickBase\QuickBaseService;

$service = app(QuickBaseService::class);

// List tables in an app
$tables = $service->listTables('bqxxx');

// Get table details
$table = $service->getTable('bqxxx');

// Query records with a filter
$records = $service->queryRecords('bqxxx', [
    'where' => '{3.EX.Complete}',
    'select' => [3, 6, 7, 8],
    'options' => ['skip' => 0, 'top' => 50],
]);

// Get a single record
$record = $service->getRecord('bqxxx', 42);

// Create a record
$newRecord = $service->createRecord('bqxxx', [
    ['fieldId' => 6, 'value' => 'New Project'],
    ['fieldId' => 7, 'value' => 42],
]);

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
- A [QuickBase](https://www.quickbase.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
