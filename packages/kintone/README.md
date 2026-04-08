# Integration: Kintone

> Kintone integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage records, apps, spaces, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Kintone business applications. List and search records, create new entries, discover apps and spaces, and look up user profiles — all through the [Kintone](https://kintone.io) REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Kintone tool lets AI agents interact with business data stored in Kintone apps — querying records, creating entries, and exploring the app structure.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-kintone
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Kintone API token and your Kintone domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'kintone' => [
        'access_token' => env('KINTONE_ACCESS_TOKEN'),
        'domain'       => env('KINTONE_DOMAIN', 'example.cybozu.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `kintone_list_records` | read | Retrieve records from a Kintone app with filtering and pagination |
| `kintone_get_record` | read | Retrieve a single record by ID |
| `kintone_create_record` | write | Create a new record in a Kintone app |
| `kintone_list_apps` | read | List available Kintone apps |
| `kintone_get_app` | read | Get details of a specific Kintone app |
| `kintone_list_spaces` | read | List Kintone spaces |
| `kintone_get_current_user` | read | Get the profile of the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\Integrations\Kintone\Tools\KintoneListRecords;
use OpenCompany\Integrations\Kintone\Tools\KintoneGetRecord;

// Create tools
$service = app(KintoneService::class);
$tools = [
    new KintoneListRecords($service),
    new KintoneGetRecord($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all open tasks from the Tasks app');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('kintone');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Kintone\Tools\KintoneListRecords::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Kintone\KintoneService;

$service = app(KintoneService::class);

// List records with a query
$records = $service->listRecords(1, 'Status = "Open" order by Record_number asc', null, 20);

// Get a single record
$record = $service->getRecord(1, 42);

// Create a record
$result = $service->createRecord(1, [
    'Title'   => ['value' => 'New Task'],
    'Status'  => ['value' => 'Open'],
    'Number'  => ['value' => 123],
]);

// List apps
$apps = $service->listApps();

// Get app details
$app = $service->getApp(1);

// List spaces
$spaces = $service->listSpaces();

// Current user
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
- A [Kintone](https://kintone.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
