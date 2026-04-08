# Integration: Convex

> Convex backend platform integration for the [Laravel AI SDK](https://github.com/laravel/ai) — tables, documents, queries, and mutations. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Convex backend data. List and inspect tables, query documents with filtering and pagination, create and update records, and manage data — all through the [Convex](https://convex.dev) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Convex tool lets AI agents query and manage backend data stored in Convex — giving agents direct access to your application's data layer for reads and writes.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-convex
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Convex API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'convex' => [
        'access_token' => env('CONVEX_ACCESS_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `convex_list_tables` | read | List all tables in the Convex deployment |
| `convex_get_table` | read | Get metadata and schema for a specific table |
| `convex_query_documents` | read | Query documents from a table with filtering and pagination |
| `convex_create_document` | write | Create a new document in a table |
| `convex_update_document` | write | Update an existing document in a table |
| `convex_delete_document` | write | Delete a document from a table |
| `convex_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\Integrations\Convex\Tools\ConvexQueryDocuments;
use OpenCompany\Integrations\Convex\Tools\ConvexCreateDocument;

// Create tools
$service = app(ConvexService::class);
$tools = [
    new ConvexQueryDocuments($service),
    new ConvexCreateDocument($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active users from the users table');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('convex');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Convex\Tools\ConvexQueryDocuments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Convex\ConvexService;

$service = app(ConvexService::class);

// List tables
$tables = $service->listTables();

// Get table schema
$schema = $service->getTable('users');

// Query documents
$docs = $service->queryDocuments('users', ['limit' => 50]);

// Create a document
$newDoc = $service->createDocument('users', ['name' => 'John', 'email' => 'john@example.com']);

// Update a document
$updated = $service->updateDocument('users', 'doc_abc123', ['name' => 'Jane']);

// Delete a document
$deleted = $service->deleteDocument('users', 'doc_abc123');

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
- A [Convex](https://convex.dev) account with API access

## License

MIT — see [LICENSE](LICENSE)
