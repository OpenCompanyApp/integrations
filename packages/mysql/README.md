# Integration: MySQL

> MySQL database integration for the [Laravel AI SDK](https://github.com/laravel/ai) — query databases, manage tables, and perform CRUD operations via HTTP REST bridge. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents direct access to MySQL databases. Execute queries, explore schemas, and perform insert, update, and delete operations — all through a secure HTTP REST bridge.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MySQL tool lets AI agents query and manage relational databases — giving agents data-driven access to your application data with full CRUD capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mysql
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a MySQL HTTP REST bridge API key and host URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mysql' => [
        'api_key' => env('MYSQL_API_KEY'),
        'host'    => env('MYSQL_HOST', 'https://mysql-api.example.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mysql_query` | read | Execute a raw SQL query |
| `mysql_list_databases` | read | List all accessible databases |
| `mysql_list_tables` | read | List all tables in a database |
| `mysql_describe_table` | read | Get column structure of a table |
| `mysql_insert` | write | Insert a row into a table |
| `mysql_update` | write | Update rows matching a filter |
| `mysql_delete` | write | Delete rows matching a filter |
| `mysql_get_current_user` | read | Get the authenticated database user |

## Quick Start

```php
use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\Integrations\MySQL\Tools\MySQLQuery;
use OpenCompany\Integrations\MySQL\Tools\MySQLListDatabases;

// Create tools
$service = app(MySQLService::class);
$tools = [
    new MySQLQuery($service),
    new MySQLListDatabases($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all databases and show the tables in the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mysql');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MySQL\Tools\MySQLQuery::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MySQL\MySQLService;

$service = app(MySQLService::class);

// Execute a query
$results = $service->query('SELECT * FROM users WHERE active = 1 LIMIT 10');

// List databases
$databases = $service->listDatabases();

// List tables
$tables = $service->listTables('my_app');

// Describe table
$schema = $service->describeTable('my_app', 'users');

// Insert a row
$service->insert('my_app', 'users', [
    'name' => 'Alice',
    'email' => 'alice@example.com',
]);

// Update rows
$service->update('my_app', 'users', ['id' => 42], ['name' => 'Bob']);

// Delete rows
$service->delete('my_app', 'sessions', ['expired' => true]);
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
- A MySQL HTTP REST bridge with API key authentication

## License

MIT — see [LICENSE](LICENSE)
