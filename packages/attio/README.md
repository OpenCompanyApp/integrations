# Integration: Attio

> Attio CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage records, objects, attributes, lists, entries, notes, tasks, webhooks, and raw REST API calls. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents broad access to Attio CRM. Manage contacts, companies, deals, custom objects, list entries, notes, and tasks through the [Attio API](https://docs.attio.com/rest-api/endpoint-reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Attio integration lets AI agents interact with CRM data - looking up contacts, creating companies, querying deals, and more - giving agents real-time access to your customer relationships.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-attio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires an Attio API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'attio' => [
        'access_token' => env('ATTIO_ACCESS_TOKEN'),
        'base_url'     => env('ATTIO_BASE_URL', 'https://api.attio.com'),
    ],
];
```

## Available Tools

This package exposes 34 tools:

| Area | Tools |
|------|-------|
| Raw API | `attio_api_get`, `attio_api_post`, `attio_api_patch`, `attio_api_put`, `attio_api_delete` |
| Account and objects | `attio_list_workspaces`, `attio_get_current_user`, `attio_list_objects`, `attio_get_object` |
| Attributes | `attio_list_attributes`, `attio_get_attribute`, `attio_create_attribute` |
| Records | `attio_list_records`, `attio_get_record`, `attio_create_record`, `attio_update_record`, `attio_delete_record`, `attio_list_record_entries` |
| Lists and entries | `attio_list_lists`, `attio_get_list`, `attio_create_list`, `attio_update_list`, `attio_list_entries`, `attio_create_entry`, `attio_get_entry`, `attio_update_entry`, `attio_delete_entry` |
| Notes and tasks | `attio_list_notes`, `attio_create_note`, `attio_list_tasks`, `attio_create_task`, `attio_update_task`, `attio_delete_task` |
| Webhooks | `attio_list_webhooks` |

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

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

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

// List companies with filtering and sorting
$companies = $service->listRecords('companies', limit: 10, sorts: [
    ['attribute' => ['slug' => 'name'], 'direction' => 'asc'],
], filters: [
    '$and' => [
        ['attribute' => ['slug' => 'name'], 'condition' => 'contains', 'value' => 'Acme'],
    ],
]);

// Get a specific record
$record = $service->getRecord('people', 'record-uuid');

// Create a new company
$company = $service->createRecord('companies', [
    'name' => 'Acme Corp',
    'domains' => ['acme.com'],
]);

// List objects in workspace
$objects = $service->listObjects();

// Get object details
$object = $service->getObject('companies');

// List workspaces
$workspaces = $service->listWorkspaces();

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

MIT - see [LICENSE](LICENSE)
