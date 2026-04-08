# Integration: Snowflake

> Snowflake integration for the [Laravel AI SDK](https://github.com/laravel/ai) — execute SQL queries, manage databases, schemas, tables, and warehouses. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Snowflake data warehouse. Execute SQL queries, explore database schemas, inspect tables, and manage compute warehouses — all through the [Snowflake SQL REST API](https://docs.snowflake.com/en/developer-guide/sql-api/index).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Snowflake tool lets AI agents query your data warehouse, explore schemas, and manage compute resources — giving agents data-driven awareness of your organization's data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-snowflake
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Snowflake access token and account identifier.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'snowflake' => [
        'access_token' => env('SNOWFLAKE_ACCESS_TOKEN'),
        'account' => env('SNOWFLAKE_ACCOUNT'), // e.g., "orgname-accountname"
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `snowflake_execute_query` | write | Execute a SQL statement with optional warehouse, database, and schema context |
| `snowflake_list_databases` | read | List all databases in the account |
| `snowflake_get_database` | read | Get details for a specific database |
| `snowflake_list_schemas` | read | List schemas in a database |
| `snowflake_list_tables` | read | List tables in a database schema |
| `snowflake_describe_table` | read | Describe columns and metadata for a table |
| `snowflake_list_warehouses` | read | List all warehouses in the account |
| `snowflake_get_warehouse` | read | Get details for a specific warehouse |
| `snowflake_get_current_user` | read | Get the current authenticated user |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Snowflake\SnowflakeService;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeExecuteQuery;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeListDatabases;

// Create tools
$service = app(SnowflakeService::class);
$tools = [
    new SnowflakeExecuteQuery($service),
    new SnowflakeListDatabases($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all databases in our Snowflake account');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('snowflake');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Snowflake\Tools\SnowflakeExecuteQuery::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Snowflake\SnowflakeService;

$service = app(SnowflakeService::class);

// Execute a query
$result = $service->executeQuery('SELECT * FROM orders LIMIT 10', 'COMPUTE_WH', 'SALES_DB', 'PUBLIC');

// List databases
$databases = $service->listDatabases();

// Explore schemas and tables
$schemas = $service->listSchemas('ANALYTICS');
$tables = $service->listTables('ANALYTICS', 'PUBLIC');
$columns = $service->describeTable('ANALYTICS', 'PUBLIC', 'orders');

// Manage warehouses
$warehouses = $service->listWarehouses();
$warehouse = $service->getWarehouse('COMPUTE_WH');

// Check current user
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
- A [Snowflake](https://www.snowflake.com/) account with SQL REST API access

## License

MIT — see [LICENSE](LICENSE)
