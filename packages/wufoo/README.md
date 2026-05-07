# Integration: Wufoo

> Wufoo API v3 integration for the [Laravel AI SDK](https://github.com/laravel/ai) — forms, fields, entries, reports, users, comments, and webhooks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to online form data. List forms, inspect fields, submit and count entries, view reports and widgets, manage webhooks, and get user information through the [Wufoo](https://wufoo.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Wufoo integration lets AI agents query form structures, retrieve and submit entries, inspect report output, and manage webhook callbacks.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wufoo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Wufoo API key and your subdomain-specific base URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wufoo' => [
        'api_key'  => env('WUFOO_API_KEY'),
        'base_url' => env('WUFOO_BASE_URL', 'https://yoursubdomain.wufoo.com/api/v3'),
    ],
];
```

### Getting Your Wufoo API Key

1. Log in to your Wufoo account.
2. Navigate to **Your Name → Account → API Information**.
3. Copy the API key.
4. Use your subdomain in the base URL: `https://{subdomain}.wufoo.com/api/v3`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wufoo_list_forms` | read | List all forms in your Wufoo account |
| `wufoo_get_form` | read | Get details for a specific form by ID |
| `wufoo_list_fields` | read | List field definitions for a form |
| `wufoo_list_entries` | read | List entries for a form (paginated, filterable) |
| `wufoo_count_entries` | read | Count entries for a form |
| `wufoo_get_entry` | read | Find a single entry by form ID and entry ID |
| `wufoo_submit_entry` | write | Submit a new form entry |
| `wufoo_list_form_comments` | read | List comments on form entries |
| `wufoo_count_form_comments` | read | Count comments on form entries |
| `wufoo_list_reports` | read | List all reports in your Wufoo account |
| `wufoo_get_report` | read | Get details for a report |
| `wufoo_list_report_entries` | read | List entries exposed by a report |
| `wufoo_count_report_entries` | read | Count entries exposed by a report |
| `wufoo_list_report_fields` | read | List fields used by a report |
| `wufoo_list_report_widgets` | read | List widgets configured on a report |
| `wufoo_list_users` | read | List account users |
| `wufoo_get_current_user` | read | Get the authenticated user's profile |
| `wufoo_add_webhook` | write | Add a webhook to a form |
| `wufoo_delete_webhook` | write | Delete a webhook from a form |
| `wufoo_api_get` / `wufoo_api_post` / `wufoo_api_put` / `wufoo_api_delete` | read/write | Call documented Wufoo API v3 endpoints not yet wrapped directly |

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
    ->prompt('Show me all forms and their latest 5 entries');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wufoo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Wufoo\Tools\WufooListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Wufoo\WufooService;

$service = app(WufooService::class);

// List all forms
$forms = $service->listForms();

// Get a specific form
$form = $service->getForm('q1w2e3r4t5y6');

// List entries with pagination
$entries = $service->listEntries('q1w2e3r4t5y6', page: 0, pageSize: 50);

// List entries with filters
$entries = $service->listEntries('q1w2e3r4t5y6', filters: [
    'Filter1' => 'Field1+Is+equal_to+value',
]);

// Submit an entry
$created = $service->submitEntry('q1w2e3r4t5y6', [
    'Field1' => 'Example Person',
    'Field2' => 'person@example.test',
]);

// Find a single entry within a form
$entry = $service->getEntry('q1w2e3r4t5y6', '12345');

// List reports
$reports = $service->listReports();

// List report widgets
$widgets = $service->listReportWidgets('r1w2e3r4');

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

Wufoo uses HTTP Basic Authentication. The API key is sent as the username, and the password is always set to `"footastic"`. This is handled automatically by the `WufooService`.

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
