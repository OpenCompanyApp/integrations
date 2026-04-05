# Integration: Attio

> Attio CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage records, objects, lists, notes and more. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents full access to your Attio CRM. Manage contacts, companies, deals, and custom objects — list, get, create, update, and delete records, browse lists, and attach notes — all through the [Attio API](https://developers.attio.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Attio integration lets AI agents interact with CRM data — looking up contacts, creating companies, updating deal stages, adding notes, and more — giving agents real-time access to your customer relationships.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-attio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Attio API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'attio' => [
        'api_key' => env('ATTIO_API_KEY'),
        'url'     => env('ATTIO_URL', 'https://api.attio.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `attio_list_records` | read | List records for an object type (people, companies, deals, etc.) |
| `attio_get_record` | read | Get a single record by ID |
| `attio_create_record` | write | Create a new record |
| `attio_update_record` | write | Update an existing record |
| `attio_delete_record` | write | Delete a record permanently |
| `attio_list_objects` | read | List all object types in the workspace |
| `attio_get_object` | read | Get details for a specific object type |
| `attio_list_lists` | read | List all lists in the workspace |
| `attio_get_list` | read | Get details for a specific list |
| `attio_list_entries` | read | List entries (records) in a specific list |
| `attio_create_note` | write | Create a note attached to a record |
| `attio_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\Integrations\Attio\Tools\AttioListRecords;
use OpenCompany\Integrations\Attio\Tools\AttioCreateRecord;

// Create tools
$service = app(AttioService::class);
$tools = [
    new AttioListRecords($service),
    new AttioCreateRecord($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all companies in our Attio workspace');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 12 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('attio');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Attio\Tools\AttioListRecords::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Attio\AttioService;

$service = app(AttioService::class);

// List companies
$companies = $service->listRecords('companies', limit: 10);

// Get a specific record
$record = $service->getRecord('people', 'record-uuid');

// Create a new company
$company = $service->createRecord('companies', [
    'name' => 'Acme Corp',
    'domains' => ['acme.com'],
]);

// Update a record
$updated = $service->updateRecord('companies', 'record-uuid', [
    'name' => 'Acme Corp (Updated)',
]);

// Delete a record
$service->deleteRecord('companies', 'record-uuid');

// List objects in workspace
$objects = $service->listObjects();

// List lists
$lists = $service->listLists();

// List entries in a list
$entries = $service->listEntries('list-uuid', limit: 10);

// Create a note
$note = $service->createNote('companies', 'record-uuid', 'Call follow-up scheduled for next week.');

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
- An [Attio](https://attio.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
