# Integration: Bubble

> Bubble integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list, get, create, update, and delete records from your Bubble application. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full CRUD access to your Bubble application data. Query records with constraints, retrieve individual records, and create, update, or delete entries — all through the [Bubble Data API](https://manual.bubble.io/core-resources/api/data-api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Bubble tool lets AI agents interact with your no-code application's data — enabling automated workflows, data sync, and intelligent record management.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-bubble
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Bubble API token and your app URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'bubble' => [
        'api_key'  => env('BUBBLE_API_KEY'),
        'hostname' => env('BUBBLE_HOSTNAME', 'https://myapp.bubbleapps.io'),
    ],
];
```

### Generating an API Token

1. Open your Bubble editor
2. Go to **Settings → API**
3. Enable the **Data API**
4. Generate a new API token with the appropriate permissions

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `bubble_list_records` | read | List records from a data type with filters and pagination |
| `bubble_get_record` | read | Get a single record by ID |
| `bubble_create_record` | write | Create a new record with specified fields |
| `bubble_update_record` | write | Update an existing record (partial update) |
| `bubble_delete_record` | write | Delete a record by ID |

## Quick Start

```php
use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\Integrations\Bubble\Tools\BubbleListRecords;
use OpenCompany\Integrations\Bubble\Tools\BubbleCreateRecord;

// Create tools
$service = app(BubbleService::class);
$tools = [
    new BubbleListRecords($service),
    new BubbleCreateRecord($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all users created this week from our Bubble app');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('bubble');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Bubble\Tools\BubbleListRecords::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Bubble\BubbleService;

$service = app(BubbleService::class);

// List records
$users = $service->listRecords('User');

// Filter with constraints
$activeUsers = $service->listRecords('User', [
    ['key' => 'status', 'constraint_type' => 'equals', 'value' => 'active'],
], limit: 50);

// Get a single record
$user = $service->getRecord('User', '1704982345123x456789');

// Create a record
$newUser = $service->createRecord('User', [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
]);

// Update a record
$service->updateRecord('User', $newUser['id'], [
    'role' => 'admin',
]);

// Delete a record
$service->deleteRecord('User', $newUser['id']);
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
- A [Bubble](https://bubble.io) account with the Data API enabled

## License

MIT — see [LICENSE](LICENSE)
