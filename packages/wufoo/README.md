# Integration: Wufoo

> Wufoo integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage forms, entries, fields and reports. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to online forms and collected data. List and inspect forms, retrieve entries, discover field definitions, submit new entries, and browse reports — all through the [Wufoo](https://wufoo.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Wufoo tool lets AI agents interact with online forms — collecting submissions, reviewing entries, and understanding form structure — giving agents the ability to process and act on form data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wufoo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Wufoo API key and your account subdomain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wufoo' => [
        'api_key'   => env('WUFOO_API_KEY'),
        'subdomain' => env('WUFOO_SUBDOMAIN'), // e.g., "mycompany" for mycompany.wufoo.com
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wufoo_list_forms` | read | List all forms in the Wufoo account |
| `wufoo_get_form` | read | Get details for a specific form |
| `wufoo_list_entries` | read | List entries submitted to a form (paginated) |
| `wufoo_get_entry` | read | Get a single form entry by ID |
| `wufoo_submit_entry` | write | Submit a new entry to a form |
| `wufoo_list_fields` | read | List all fields for a specific form |
| `wufoo_list_reports` | read | List all reports in the Wufoo account |

## Quick Start

```php
use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\Integrations\Wufoo\Tools\WufooListForms;
use OpenCompany\Integrations\Wufoo\Tools\WufooListEntries;

// Create tools
$service = app(WufooService::class);
$tools = [
    new WufooListForms($service),
    new WufooListEntries($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the latest entries from our contact form');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wufoo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Wufoo\Tools\WufooListEntries::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Wufoo\WufooService;

$service = app(WufooService::class);

// List all forms
$forms = $service->listForms();

// Get a specific form
$form = $service->getForm('z1k08xw1ubbvkt');

// List entries (paginated, newest first)
$entries = $service->listEntries('z1k08xw1ubbvkt', pageSize: 50, sort: 'DESC');

// Get a single entry
$entry = $service->getEntry('42');

// List fields for a form
$fields = $service->listFields('z1k08xw1ubbvkt');

// Submit a new entry
$result = $service->submitEntry('z1k08xw1ubbvkt', [
    'Field1' => 'John Doe',
    'Field2' => 'john@example.com',
    'Field3' => 'Hello!',
]);

// List reports
$reports = $service->listReports();
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
- A [Wufoo](https://wufoo.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
