# Integration: MongoDB Atlas

> MongoDB Atlas Data API integration for the [Laravel AI SDK](https://github.com/laravel/ai) — find, insert, update, delete documents, run aggregations, and list collections. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full access to MongoDB Atlas databases. Query documents with filters, insert and update records, run aggregation pipelines, and explore your data — all through the [MongoDB Atlas Data API](https://www.mongodb.com/docs/atlas/app-services/data-api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This MongoDB Atlas tool lets AI agents query, insert, update, and delete documents, run complex aggregation pipelines, and discover collection schemas — giving agents direct access to your application data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mongodb
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a MongoDB Atlas Data API key and cluster URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mongodb' => [
        'api_key'     => env('MONGODB_API_KEY'),
        'cluster_url' => env('MONGODB_CLUSTER_URL'),
    ],
];
```

### Getting your credentials

1. In MongoDB Atlas, go to **App Services** → Create or select an app
2. Enable the **Data API** under "Data Access"
3. Copy the **Endpoint URL** — this is your `cluster_url`
4. Create an **API Key** under "App Settings" → "API Keys"
5. Assign appropriate roles (read/write) to the key

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mongodb_find` | read | Query documents with filters, projection, sort, pagination |
| `mongodb_find_one` | read | Find a single document by filter |
| `mongodb_insert_one` | write | Insert a single document |
| `mongodb_insert_many` | write | Insert multiple documents in bulk |
| `mongodb_update_one` | write | Update a single document with operators ($set, $inc, etc.) |
| `mongodb_delete_one` | write | Delete a single document by filter |
| `mongodb_aggregate` | read | Run an aggregation pipeline ($match, $group, $lookup, etc.) |
| `mongodb_list_collections` | read | List collections in a database |
| `mongodb_get_current_user` | read | Verify connectivity and get session info |

## Quick Start

```php
use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBFind;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBInsertOne;

// Create tools
$service = app(MongoDBService::class);
$tools = [
    new MongoDBFind($service),
    new MongoDBInsertOne($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all active users in the myapp database');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mongodb');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MongoDB\Tools\MongoDBFind::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MongoDB\MongoDBService;

$service = app(MongoDBService::class);

// Find documents
$users = $service->find('myapp', 'users', ['status' => 'active'], [
    'sort' => ['createdAt' => -1],
    'limit' => 10,
]);

// Insert a document
$result = $service->insertOne('myapp', 'users', [
    'name' => 'Alice',
    'email' => 'alice@example.com',
    'status' => 'active',
]);

// Update a document
$service->updateOne('myapp', 'users',
    ['email' => 'alice@example.com'],
    ['$set' => ['status' => 'inactive']]
);

// Run an aggregation pipeline
$stats = $service->aggregate('myapp', 'orders', [
    ['$match' => ['status' => 'completed']],
    ['$group' => ['_id' => '$category', 'count' => ['$sum' => 1]]],
    ['$sort' => ['count' => -1]],
]);
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
- A [MongoDB Atlas](https://www.mongodb.com/atlas) account with Data API enabled

## License

MIT — see [LICENSE](LICENSE)
